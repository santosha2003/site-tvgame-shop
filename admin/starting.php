<?php
require_once("./auth.php");


if (!isset($_GET['action'])) $_GET['action']="";
switch ($_GET['action']) {
 case "list":
 $tmpl -> loadTemplatefile("add_user_param.inc",true,true);
 $row = $db -> getAll("SELECT id,username,fio FROM users");

  if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('select');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('select');
         $tmpl -> free();
     }
     }

   break;

  case "view":
   $tmpl -> loadTemplatefile("add_user_param1.inc",true,true);

   $id = $_GET['id'];
   $row = $db -> getAll("SELECT username,fio,id FROM users WHERE id='$id'");

  if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('select');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('select');
         $tmpl -> free();
       }
       }


  $id = $_GET['id'];




  $row = $db -> getAll("SELECT skidka FROM users WHERE id='$id'");
  if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('skidka');
         $val['skidka']=$val['skidka']*100;

        $tmpl -> setVariable($val);

        $tmpl -> parseCurrentBlock('skidka');
         $tmpl -> free();
     }
     }

  break;


  case "add":

  $skidka = $_GET['skidka'];

  $id = $_GET['id'];
   $last = $skidka/100;
    $db -> query("UPDATE users SET skidka='$last' WHERE id='$id'");
   //$query = "UPDATE users SET username='$username', password='$password', password1='$password1' WHERE id=$id";
   $row = $db -> getAll("SELECT username,fio,id FROM users");
  $tmpl -> loadTemplatefile("add_user_param2.inc",true,true);
  if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('select');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('select');
         $tmpl -> free();
       }
       }
    $row = $db -> getAll("SELECT skidka FROM users WHERE id='$id'");

  if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('skid_info');
         $val['skidka']=$val['skidka']*100;

        $tmpl -> setVariable($val);

        $tmpl -> parseCurrentBlock('skid_info');
         $tmpl -> free();
     }
     }
   $row = $db -> getAll("SELECT username,fio FROM users WHERE id='$id'");
    if(!empty($row)) {
    foreach($row as $val) {
   $tmpl -> setCurrentBlock('select_add');
      $tmpl->setVariable('info','Для клиента :');
       $tmpl->setVariable('form',$val['fio']);
       $tmpl->setVariable('form1',$val['username']);
        $tmpl -> parseCurrentBlock('select_add');
         $tmpl -> free();
     }
     }
  break;
 }

 ?>