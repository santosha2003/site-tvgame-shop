<?php
session_start();
require_once('./lib/config.php');

if(!empty($_POST["input_number"])){


    if($_SESSION['number']==$_POST['input_number']){

   $date = date("d M Y  H:m:s");
   $cat = $_POST['cat'];
   $url = htmlspecialchars($_POST['url'],ENT_QUOTES, cp1251);
   $mailer = htmlspecialchars($_POST['mailer'],ENT_QUOTES, cp1251);
   $links = $_POST['link'];
   $to = "shop@shedevr.ru";
   $textmail = '<br><hr color=cccccc size=1>Текущая дата и время - '.$date.'<hr color=cccccc size=1><br><br>Размещение в категорию - <b>'.$cat.'</b><br><br>Расположение ответной ссылки:&nbsp;&nbsp;&nbsp;<a href='.$url.'>'.$url.'</a><br><br>Код ссылки:<hr color=000000 size=1><br><textarea rows=8 cols=40>'.$links.'</textarea><br><hr color=000000 size=1><br>Письмо создано автоматической системой оповещения';
   sendmail($_POST['mailer'],$to,"Запрос на обмен ссылками из shedevr.ru",$textmail);
    header("Location: index.php?op=links_snx");

   }else
   header("Location: index.php?op=addlinks");
   }else{
  header("Location: index.php?op=addlinks");
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