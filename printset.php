<?php
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}

switch ($_GET[action]) {
 case "list":
 $tmpl -> loadTemplatefile("preview.inc",true,true);
 $row = $db -> getAll("SELECT magaz,city,id FROM users");

  if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('select');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('select');
    //     $tmpl -> free();
     }
     }

   break;

  case "view":
   $tmpl -> loadTemplatefile("preview.html",true,true);
   $row = $db -> getAll("SELECT * FROM users WHERE id='$id'");

  if(!empty($row)) {
  foreach($row as $val) {

        $tmpl -> setVariable($val);

       }
       }
   break;


 }

 ?>