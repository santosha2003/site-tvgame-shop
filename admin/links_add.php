<?php
 require_once("./auth.php");

if (!isset($_POST['mode']))  $_POST['mode']="";
  switch($_POST['mode']) {
  case "startlink":
   if(!empty($_POST['link'])){
  $cat = $_POST['cat'];
  $links = $_POST['link'];

  $q = $db -> query("INSERT INTO links_links(idcat,visuallinks) values('$cat', '$links')");
   }
   if(!empty($_POST['link1'])){
  $db -> query("INSERT INTO links_links(idcat,visuallinks) values('$_POST[cat]', '$_POST[link1]')");
   }
   if(!empty($_POST['link2'])){
  $db -> query("INSERT INTO links_links(idcat,visuallinks) values('$_POST[cat]', '$_POST[link2]')");
   }
   if(!empty($_POST['link3'])){
  $db -> query("INSERT INTO links_links(idcat,visuallinks) values('$_POST[cat]', '$_POST[link3]')");
   }
  if(!empty($_POST['link4'])){
  $db -> query("INSERT INTO links_links(idcat,visuallinks) values('$_POST[cat]', '$_POST[link4]')");
   }
  if(!empty($_POST['link5'])){
  $db -> query("INSERT INTO links_links(idcat,visuallinks) values('$_POST[cat]', '$_POST[link5]')");
   }
   if(!empty($_POST['newcat'])){
   $db -> query("INSERT INTO links_catalog(namecat) values('$_POST[newcat]')");


   }
   Header("Location: index.php?op=addlink&idcat=".$_POST['cat']);

 exit;
 break;
 }



 $tmpl -> loadTemplatefile("links_add.inc",true,true);

    if(!empty($_POST['cat'])){
   $tmpl -> setCurrentBlock('info');
   $tmpl -> setVariable('info','—сылка добавлена');
    $tmpl -> parseCurrentBlock('info');
    }

  $row = $db -> getAll("SELECT * FROM links_catalog");
if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('select');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('select');
    //    $tmpl -> free();
  }
}

?>