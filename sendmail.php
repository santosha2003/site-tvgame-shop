<?php
session_start();
require_once('./lib/config.php');

if(!empty($_POST["input_number"])){


    if($_SESSION['number']==$_POST["input_number"]){

   if(!empty($_POST['email']) AND !empty($_POST['text'])) {
          sendmail($_POST['email'],$db->getOne("SELECT value FROM settings WHERE id='10'"),"Contact us from http://www.shedevr.ru/",$_POST['text']);
          header("Location: index.php?op=contact_snx");
//no spam
          //$_GET['op'] = "contact_snx";
        } else
          header("Location: index.php?op=contact");
          //$_GET['op'] = "contact";

   }
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