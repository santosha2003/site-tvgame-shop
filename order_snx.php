< ?
require_once("./lib/config.php");
require_once("./lib/shoppingcart.php");

// if (!$a->getAuth()) {
 // $_SESSION['www_users_ing'][op] = 'cart';
//  header("Location: index.php?op=reg");
//  exit;
//  }

$cart = new Cart;
$content = $cart -> display_contents();

if(empty($content)) {
  header("Location: index.php?op=cart");
  exit;
 }

$tmpl -> loadTemplatefile("order_mail.html",true,true);

// номер заказа
  $zid = $db -> nextId('orders');
  $missing = array();

// сохранение данных о заказаных продуктах
  foreach($content as $val) {

        $item = $db -> getRow("SELECT id as tid,name,code,mark,model,sku,price,price_opt FROM items WHERE id='$val[id]'");
        $item[zid] = $zid;
        $item[uid] = $db -> getOne("SELECT id FROM users WHERE username='".$a -> getUsername()."'");
        $item[quantity] = $val[quantity];

        $form -> add('orders_items',$missing,$item);
        $item[id] = $val[id];
         //$item[total_discount] =$val[price]*$skidka_total;
         //$item[summa_poz] = $val[quantity]*$val[price]*$skidka_total;

        $sp = $db -> getRow("SELECT items FROM spec WHERE items LIKE '%|$val[id]|%' AND status='Y' AND shops LIKE '%|$shop_true_id|%' AND start_date < now() AND (end_date > now() OR end_date='1970-01-01 00:00')");
if(!empty($sp)) $item[sp] = " [CП] ";
        $tmpl -> setCurrentBlock('list');
        $tmpl -> setVariable($item);
        $tmpl -> parseCurrentBlock('list');
  }
// сохранение данных о заказе
  $_POST[zid] = $zid;
  $_POST[uid] = $_SESSION['auth']['id'];
  $_POST[date_zid] = date("Y-m-d H:i:s",time());
  $_POST[price_total] = $cart->cart_total();

 if($cart->cart_total() <= 200000) $_POST[delivery_total]="300.00";
  else $_POST[delivery_total]="0.00";

   $skidka= $db ->getOne("SELECT skidka FROM users WHERE id='".$_SESSION[auth][id]."'");
          $skidka_1=$skidka*100;
   $_POST[skidka_v] = $skidka_1;
  // $_POST[d_cart] = $d_cart;
  $_POST[summa] = sprintf("%.2f",($_POST[delivery_total]+$cart->cart_total()*(1-$skidka)));

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
        $_POST[date_delivery] = strtotime($_POST[date_delivery]);
        $_POST[date_delivery] = date("d.m.Y",$_POST[date_delivery]);
        $_POST[email] = $db -> getOne("SELECT username FROM users WHERE id='".$_SESSION[auth][id]."'");
        $tmpl -> setVariable($_POST);

// удаление товаров из корзины
  $cart -> clear_cart();

// отправка на e-mail клиенту и оператору

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
        


  header("Location: index.php?op=order_snx&zid=$_POST[zid]");
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