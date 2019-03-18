<?php
require_once('./lib/configd.php');
$petia = 5;
session_register('petia');

$a = new Auth("DB",$users_params,false,false);
$a -> setSessionname("www_users_ing");
$a -> start();
if (!isset ($_POST['op'])) $_POST['op']="";
switch($_POST['op']) {
  case "search":
        $_GET['op'] = "search";
        break;


  case "order":
        include("./order_snx.php");
        break;
  case "order1":
        include("./order_snx1.php");
        break;
  case "cart":

        include("./cart.php");

        break;
  case "cart1":

        include("./cart1.php");

        break;
  case "cngreg":
        if ($a->getAuth()) {
          include("./register.php");
        } else {
          header("Location: index.php?op=reg");
          exit;
        }
        break;
  case "forgot":
          if(!empty($_POST['email'])) {
                $pass = $db -> getOne("SELECT password1 FROM users WHERE username='$_POST[email]'");
                if(!empty($pass)) {
                  $tmpl -> loadTemplatefile("forgot_mail.inc",true,true);
                  $tmpl -> setVariable('email',$_POST['email']);
                  $tmpl -> setVariable('password',$pass);
                  $page = $tmpl -> get();
                  sendmail($_POST['email'],$db->getOne("SELECT value FROM settings WHERE id='10'"),"Password from http://www.shedevr.ru/",$page);
                }
          }
          $pass = true;
          $_GET['op'] = "forgot";
        break;
  case "newreg":
        include("./register.php");
        break;
  case "auth":
        if ($a->getAuth()) {
          $username = $a -> getUsername();
          $_SESSION['auth']['id'] = $db -> getOne("SELECT id FROM users WHERE username='$username'");
          if(isset($_POST['username']))
                $db -> query("UPDATE users SET date_log=now() WHERE username='$username'");
          $_GET['op'] = "personal";
        } else
          $_GET['op'] = "reg";
        break;


  

        }

$tmpl -> loadTemplatefile("header.inc",true,true);
if ($a->getAuth())
  $tmpl -> touchBlock('register');
else
  $tmpl -> touchBlock('unreg');
if (!isset ($_GET['op'])) $_GET['op']="";
  if($_GET['op'] == 'catalog') {
  if(!empty($_GET['pid'])) $_GET['cid'] = $_GET['pid'];
  $row = $db -> getOne("SELECT name FROM category WHERE id='$_GET[cid]' AND status='Y'");
   $rows = $db -> getOne("SELECT supertitle FROM category WHERE id='$_GET[cid]' AND status='Y'");
  if(!empty($row))
        $tmpl->setVariable('title',$row." - ");
        $tmpl->setVariable('supertitle',$rows);
        } else {
  $tmpl->setVariable('title',"Все для геймеров,игровые приставки,игры,DVD,аккустические системы,акссесуары для CD и DVD");

  }

  if($_GET['op'] == 'linkscatalog') {
  if(!empty($_GET['idcat'])){
  $row = $db -> getOne("SELECT namecat FROM links_catalog WHERE idcat='$_GET[idcat]'");

  if(!empty($row))
        $tmpl->setVariable('title', "Каталог ссылок - ");
        $tmpl->setVariable('supertitle',$row." - Обмен ссылками");

        } else {
       $tmpl->setVariable('title', "Каталог ссылок - Обмен ссылками");
  }
  }

if(!empty($_GET['id'])){
  $rows = $db -> getOne("SELECT name FROM items WHERE id='$_GET[id]' AND status='Y'");
  $rowa = $db -> getOne("SELECT mark FROM items WHERE id='$_GET[id]' AND status='Y'");
  $rowz = $db -> getOne("SELECT model FROM items WHERE id='$_GET[id]' AND status='Y'");
  $rowcat = $db -> getOne("SELECT cid FROM items WHERE id='$_GET[id]' AND status='Y'");
  $rowcat1 = $db -> getOne("SELECT supertitle FROM category WHERE id='$rowcat' AND status='Y'");
  if(!empty($rows))
        $tmpl->setVariable('title',$rows." ".$rowa." ".$rowz." - ");
        $tmpl->setVariable('supertitle',$rowcat1);
        }

//"&nbsp;".$rowa."&nbsp;".$rowz.
//$rowa = $db -> getOne("SELECT mark, FROM items WHERE id='$_GET[id]' AND status='Y'");
  // $rowz = $db -> getOne("SELECT model, FROM items WHERE id='$_GET[id]' AND status='Y'");

  if($_GET['op'] == 'catalog') {
  if(!empty($_GET[pid])) $_GET[cid] = $_GET[pid];
  $tmpl -> setVariable('termometr',termometr($_GET['cid']));
}
if(!empty($_GET['id'])) {
  $tmpl -> setVariable('termometr',termometr($_GET['cid']));
}
$page = $tmpl -> get();

$tmpl -> loadTemplatefile("left.inc",true,true);
include("./left.php");
$page .= $tmpl -> get();



switch($_GET['op']) {
  case "order_snx":
// вывод страницы благодарности
        $tmpl -> loadTemplatefile("order_snx.inc",true,true);
        $tmpl -> setVariable($_POST);
        $row = $db -> getRow("SELECT *,date_format(date_zid,'%d.%m.%Y') as date_zid,date_format(date_delivery,'%d.%m.%Y') as date_delivery FROM orders WHERE zid='$_GET[zid]'");
        $time_delivery = explode("|",$row[time_delivery]);
        $size =  sizeof($time_delivery)-1;
        $row[time_delivery] = "";
        for($i = 1; $i < $size; $i++) {
          $row[time_delivery] .= $time_delivery[$i]."<br>";
        }
        $tmpl -> setVariable($row);

        break;
  case "order_snx1":
// вывод страницы благодарности
        $tmpl -> loadTemplatefile("order_snx1.inc",true,true);
        $row = $db -> getRow("SELECT *,date_format(date_zid,'%d.%m.%Y') as date_zid,date_format(date_delivery,'%d.%m.%Y') as date_delivery FROM orders WHERE zid='$_GET[zid]'");
        $time_delivery = explode("|",$row[time_delivery]);
        $size =  sizeof($time_delivery)-1;
        $row[time_delivery] = "";
        for($i = 1; $i < $size; $i++) {
          $row[time_delivery] .= $time_delivery[$i]."<br>";
        }
        $tmpl -> setVariable($row);
         $tmpl -> setVariable($_POST);

        break;
  case "order":
        include("./order.php");
        break;
  case "order1":
        include("./order1.php");
        break;
  case "cart":
        unset($_POST);
        require_once("./lib/shoppingcart.php");
   if (!empty($_SESSION['auth']['id'])){
        include("./cart.php");
        }else{
        include("./cart1.php");
       }
        break;
  case "cngreg":
        if ($a->getAuth()) {
          $tmpl -> loadTemplatefile("register.inc",true,true);
          $row = $db -> getRow("SELECT * FROM users WHERE id='".$_SESSION[auth][id]."'");
          $tmpl -> setVariable($row);
          $tmpl -> setVariable('action',"cngreg");
          $tmpl -> setVariable('disab'," disabled");
          $tmpl -> touchBlock('header_cngreg');
        } else {
          header("Location: index.php?op=reg");
          exit;
        }
        break;
  case "forgot":
        $tmpl -> loadTemplatefile("forgot.inc",true,true);
        if(!$pass)
          $tmpl -> touchBlock('forgot_begin');
        else
          $tmpl -> touchBlock('forgot_ok');
        break;
   case "discounts":
        $tmpl -> loadTemplatefile("discounts.inc",true,false);

        break;



  case "personal":
        if ($a->getAuth()) {
          if(isset($_SESSION['www_users_ing']['op'])) {
                header("Location: index.php?op=".$_SESSION['www_users_ing']['op']);
                unset($_SESSION['www_users_ing']['op']);
                exit;
          } else
                include("./history.php");
        } else {
          header("Location: index.php?op=reg");
          exit;
        }
        break;
  case "logout":
          $a->logout();
          header("Location: index.php?op=reg");
          exit;
        break;
  case "reg":
        $tmpl -> loadTemplatefile("enter.inc",true,false);
        break;
   case "nopage":
        $tmpl -> loadTemplatefile("nopage.inc",true,false);
        break;
  case "newreg":
        $tmpl -> loadTemplatefile("register.inc",true,true);
        $tmpl -> setVariable($_POST);
        $tmpl -> setVariable('action',"newreg");
        $tmpl -> touchBlock('header_newreg');
        break;
  case "contact":
        $tmpl -> loadTemplatefile("feedback.inc",true,false);
        break;
   case "contact_snx":
        $tmpl -> loadTemplatefile("feedback_snx.inc",true,false);
        break;
  case "new":
        include("./marketing.php");
      unset($_POST);
        unset($_GET);
        break;
  case "season":
        include("./marketing.php");
        unset($_POST);
        unset($_GET);
        break;
  case "spec":
        include("./marketing.php");
        break;
   case "showmode":
        include("./golos_show.php");
        break;
   case "logerror":
        $tmpl -> loadTemplatefile("iplogerror.inc",true,false);
        break;
  case "search":
        include("./search.php");
        break;
  case "catalog":
        include("./catalog.php");
        break;
  case "linkscatalog":
        include("./links_catalog.php");
        break;
   case "addlinks":
        include("./links_add.php");
        break;
   case "links_snx":
        $tmpl -> loadTemplatefile("links_snx.inc",true,false);
        break;



  default:
        if(isset($_GET['spec']) AND !empty($_GET['spec'])) {
          include("./sp.php");
        } elseif(isset($_GET['id']) AND !empty($_GET['id']))
          include("./item.php");
//        elseif(file_exists("./templates/".$_GET[op].".inc"))
//          $tmpl -> loadTemplatefile($_GET[op].".inc",true,false);
        else
          include("./cms.php");
}
$page .= $tmpl -> get();

include("./right.php");
$page .= $tmpl -> get();

$tmpl -> loadTemplatefile("footer.inc",true,false);
$content = $db -> getAll("SELECT url,shorttitle FROM content WHERE menu='checked' AND shops LIKE '%$shop_true_id%' ORDER BY updown");
if(!empty($content)) {
  foreach($content as $val) {
        $tmpl -> setCurrentBlock('list_menu');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('list_menu');
  }
}

//$content = $db -> getAll("SELECT id,parent,name FROM category WHERE bottom='Y' AND status='Y' AND shops LIKE '%$shop_true_id%' ORDER BY updown");
$content = $db -> getAll("SELECT id,parent,name FROM category WHERE bottom='Y' AND status='Y' ORDER BY updown");
if(!empty($content)) {
  $title = "";
  foreach($content as $val) {
        if($val['parent']=='2') $cid = "pid=$val[id]";
        else $cid = "cid=$val[id]";
        $title.='<a href="index.php?op=catalog&'. $cid .'">'. $val['name'] .'</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
  }
  $tmpl -> setVariable('title_bottom',substr($title,0,-25));
}
$page .= $tmpl -> get();

echo $page;

function photo_name($photo,$path="images/photo/") {
  $photo = $path.$photo;
  $wh = @GetImageSize($photo);
  if(empty($wh))
        $photo = "images/1p.gif";

  RETURN $photo;
}

function photo_size($photo,$width="",$height="") {
        $row = array();
        $wh = @GetImageSize($photo);
        if($wh[0] > $width) {
          $div = $wh[0]/$width;
          $wh[0] = ceil($wh[0]/$div);
          $wh[1] = ceil($wh[1]/$div);
          $wh[3] = 'width="'.$wh[0].'" height="'.$wh[1].'"';
        }

        if($wh[1] > $height) {
          $div = $wh[1]/$height;
          $wh[0] = ceil($wh[0]/$div);
          $wh[1] = ceil($wh[1]/$div);
          $wh[3] = 'width="'.$wh[0].'" height="'.$wh[1].'"';
        }

        if($wh[0] <= 1 AND $wh[1] <= 1)
          $wh[3] = 'width="'.$width.'" height="'.$height.'"';

        RETURN $wh[3];
}

function termometr($cid,$cut=false) {
  GLOBAL $db, $_GET;

  if(!empty($_GET['id'])) {
        $cid = $db->getOne("SELECT cid FROM items WHERE id='$_GET[id]'");
  }
  $row = $db -> getRow("SELECT * FROM category WHERE id='$cid'");
  $children[parent] = $row[parent];
  if(!$cut) {
        if(!empty($_GET['id']))
          $row[title] = "<a href=index.php?op=catalog&pid=".$db->getOne("SELECT cid FROM items WHERE id='$_GET[id]'").">$row[name]</a>";
        else
         $row[title] = $row[name];
  }

  if($children[parent] != 2) {
  while ( $children[parent] != 0) {
        $children = $db -> getRow("SELECT * FROM category WHERE id='$children[parent]'");
        if($children[parent] == '2') {
          $row[title] = " <a href=index.php?op=catalog&pid=$children[id]>$children[name]</a>&nbsp;|&nbsp;". $row[title];
        } else {
          $row[title] = " <a href=index.php?op=catalog&cid=$children[id]>$children[name]</a>&nbsp;|&nbsp;". $row[title];
        }
  }
  $row[title] = substr($row[title],53);
  }
  RETURN $row[title];
}

function sendmail($from,$to,$subj,$text) {


  $headers  = "Reply-To: $from\r\n";
  $headers .= "From: $from\r\n";
  $headers .= "Return-Path: $from\r\n";
  $headers .= "Content-Type: text/html; charset=windows-1251\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $subj = $subj;
  mail($to,$subj,$text,$headers);
}

?>