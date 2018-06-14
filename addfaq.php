<?php
//change v4 $HTTP_* to v5.6-v7 $_SESSION $_POST

// Backward compatible array creation. After this point, the
// PHP 4.1.0+ arrays can be used to access variables coming
// from outside PHP. But it should be noted that these variables
// are not necessarily superglobals, so they need to be global-ed!
//if (!isset($_SERVER))
//{
//    $_GET     = &$HTTP_GET_VARS;
//    $_POST    = &$HTTP_POST_VARS;
//    $_ENV     = &$HTTP_ENV_VARS;
//    $_SERVER  = &$HTTP_SERVER_VARS;
//    $_COOKIE  = &$HTTP_COOKIE_VARS;
//    $_REQUEST = array_merge($_GET, $_POST, $_COOKIE);
//}

//$PHP_SELF = $_SERVER['PHP_SELF'];
//
session_start();
require_once('./lib/config.php');



if(!empty($_POST['input_number'])){

    //$HTTP_SESSION_VARS
    if($_SESSION['number']==$_POST['input_number']){
   if(!empty($_POST['messfaq'])){
   $data=date("d-m-Y");
   if (!get_magic_quotes_gpc())
  {
   $namefaq = mysql_escape_string($_POST['namefaq']);
   $emailfaq = mysql_escape_string($_POST['emailfaq']);
   $messfaq = mysql_escape_string($_POST['messfaq']);
   }
   $post_idtov=$_POST['idtov'];
   $faq = $db -> getAll("SELECT * FROM items WHERE id='$post_idtov'");

//if(!empty($faq)) {
  $post_cid=$_POST['cid'];
  foreach($faq as $vals) {
  $faqcid = $db -> getOne("SELECT name FROM category WHERE id='$post_cid'");
  $data1=date("d-m-Y H:i:s");
  $temafaq="Дата и время письма : ".$data1."<hr color=666666 size=1 noshade><br>Категория: <b>".$faqcid."</b><br>Наименование товара: <b>".$vals[name]." ".$vals[mark]." ".$vals[model]."</b><br>E-mail автора: ".$emailfaq."<br>ФИО автора: ".$namefaq."<br><hr color=000000 size=1 noshade>Сообщение:<br>".$messfaq;
   $zag="Вопрос из Shedevr.ru";
    $tomail="shop@shedevr.ru";
   sendmail($emailfaq,$tomail,$zag,$temafaq);
  // }
   }
   $db -> query("INSERT INTO faqtov(idtov,cid,namefaq,mailfaq,messfaq,datafaq) VALUES('$post_idtov', '$post_cid', '$namefaq', '$emailfaq', '$messfaq', '$data')");
  }
   }
  }
header("Location: index.php?id=".$post_idtov);
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