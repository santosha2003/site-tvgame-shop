<?php
require_once("./lib/config.php");
require_once("./lib/shoppingcart.php");

//if (!$a->getAuth()) {
//  $_SESSION['www_users_ing'][op] = 'order_snx1';
//  header("Location: index.php?op=reg");
//  exit;
// }


$cart = new Cart;
$content = $cart -> display_contents();

if(empty($content)) {
  header("Location: index.php?op=cart");
  exit;
 }

$tmpl -> loadTemplatefile("order_mail.html",true,true);

// ÎÏÍÅÒ ÚÁËÁÚÁ
  $zid = $db -> nextId('orders');
  $missing = array();

// ÓÏÈÒÁÎÅÎÉÅ ÄÁÎÎÙÈ Ï ÚÁËÁÚÁÎÙÈ ÐÒÏÄÕËÔÁÈ
  foreach($content as $val) {


        $item = $db -> getRow("SELECT id as tid,name,code,mark,model,sku,price,price_opt FROM items WHERE id='$val[id]'");
        $item[zid] = $zid;
        $item[uid] = "Íåçàðåãèñòðèðîâàííûé ïîêóïàòåëü";
        $item[quantity] = $val[quantity];


        $form -> add('orders_items',$missing,$item);
        $item[id] = $val[id];

        $sp = $db -> getRow("SELECT items FROM spec WHERE items LIKE '%|$val[id]|%' AND status='Y' AND shops LIKE '%|$shop_true_id|%' AND start_date < now() AND (end_date > now() OR end_date='1970-01-01 00:00')");
if(!empty($sp)) $item[sp] = " [Cð] ";
        $tmpl -> setCurrentBlock('list');
        $tmpl -> setVariable($item);
        $tmpl -> parseCurrentBlock('list');
  }
// ÓÏÈÒÁÎÅÎÉÅ ÄÁÎÎÙÈ Ï ÚÁËÁÚÅ
  $_POST[zid] = $zid;
  $_POST[uid] = "Íåçàðåãèñòðèðîâàííûé ïîêóïàòåëü";
  $_POST[date_zid] = date("Y-m-d H:i:s",time());
  $_POST[price_total] = $cart->cart_total();
  if($cart->cart_total() <= 200000) $_POST[delivery_total]="300.00";
  else $_POST[delivery_total]="0.00";

   $skidka_visual="0";
   $_POST[skidka_v] = $skidka_visual;

  $_POST[summa] = sprintf("%.2f",($_POST[delivery_total]+$cart->cart_total()));
  $_POST[status] = 'process';

  if(!empty($_POST[time_delivery])) {
    $delivery = "|";
        $time_deliv = "";
    foreach($_POST[time_delivery] as $val) {
            $delivery .= "$val|";
          $time_deliv = $val."<br>";;
        }
  }
  $_POST[time_delivery] = $delivery;

  $missing = array("op","select3","price_total","delivery_total");
  $form -> add('orders',$missing);
        $_POST[date_zid] =  date("d.m.Y (H:i:s)",time());
        //$_POST[date_delivery] = strtotime($_POST[date_delivery]);
        //$_POST[date_delivery] = date("d.m.Y",$_POST[date_delivery]);
        $_POST[date_delivery];
        $fio=$_POST[fio];
        $country=$_POST[country];
        $city=$_POST[city];
        $phone=$_POST[phone];
        $address=$_POST[address];
        $discont=$_POST[discont];
        $description=$_POST[description];
        $_POST[email];
        $_POST[data_zid] =  date("Y-m-d H:i:s",time());
        $tmpl -> setVariable($_POST);
   $db -> query("INSERT INTO orders ( zid, uid, date_zid, fio, country, city, phone, discont, address, metro, date_delivery, time_delivery, description, summa, status )
   values('$zid', '$_POST[uid]', '$_POST[data_zid]', '$fio', '$country', '$city', '$phone', '$discont', '$address', '$metro', '$_POST[date_delivery]', '$_POST[time_delivery]', '$description', '$_POST[summa]', '$_POST[status]')");
// ÕÄÁÌÅÎÉÅ ÔÏ×ÁÒÏ× ÉÚ ËÏÒÚÉÎÙ
  $cart -> clear_cart();

// ÏÔÐÒÁ×ËÁ ÎÁ e-mail ËÌÉÅÎÔÕ É ÏÐÅÒÁÔÏÒÕ


        $mail = $tmpl -> get();
        $admin_mail = $db->getOne("SELECT value FROM settings WHERE id='10'");
        $res = $db -> query("SELECT * FROM admin WHERE email != ''");
        if($res -> numRows()) {
         while($row = $res -> fetchRow()) {
                sendmails($_POST[email],$row[email],"Order # $_POST[zid] (http://www.shedevr.ru)",$mail);
         }
        } else {
          sendmails($_POST[email],$admin_mail,"Order # $_POST[zid] (http://www.shedevr.ru)",$mail);
        }
        sendmails($admin_mail,$_POST[email],"Order # $_POST[zid] (http://www.shedevr.ru)",$mail);
        
        sendmails($_POST[email],$doub,"Order # $_POST[zid] (http://www.shedevr.ru)",$mail);







  header("Location: index.php?op=order_snx1&zid=$_POST[zid]");
  exit;

function sendmails($from,$to,$subj,$text) {
  $headers  = "Reply-To: $from\r\n";
  $headers .= "From: $from\r\n";
  $headers .= "Return-Path: $from\r\n";
  $headers .= "Content-Type: text/plain; charset=windows-1251\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $subj = $subj;
  mail($to,$subj,$text,$headers);
 }

?>