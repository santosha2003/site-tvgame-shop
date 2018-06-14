<?php
require_once("./auth.php");


//$old_status=$_GET['old_status'];
//if(empty($_GET['filter'])) $_GET['filter'] = 'process';
//$filter=$_GET['filter'];
$op=$_GET['op'];

echo "<pre>";
print_r($_GET);
print_r($_SESSION['catid']);
echo "</pre>";


if (!isset($_POST['mode'])) $_POST['mode']=""; //op mode id[] sku[] kod1c[] price[]
switch($_POST['mode']) {

  case "start":

//echo "<pre>";
//print_r($status);
//print_r($zid);
//print_r($pages);
//print_r($_POST);
//echo "</pre>";

$kod1c=$_POST['kod1c'];
$idarray=$_POST['id'];
$sku=$_POST['sku'];
$price=$_POST['price'];


 //if ((isset  ($listselect_id)) && (!empty  ($listselect_id))) $mode="listselect";
         if(isset($kod1c)){
          $a=$kod1c;
           $z=$idarray;
           $q=count($a);
          for($i=0;$i<$q;$i++){
    $item_id=$z[$i];
    $item_kod1c=$a[$i];

    $db -> query("UPDATE items SET kod1c='$item_kod1c' WHERE id='$item_id'");

         }
         }
         if(isset($sku)){
          $a=$sku;
           $z=$idarray;
           $q=count($a);
          for($i=0;$i<$q;$i++){
    $item_id=$z[$i];
    $item_sku=$a[$i];

    $db -> query("UPDATE items SET sku='$item_sku' WHERE id='$item_id'");

         }
         }
     if(isset($price)){

          $a=$price;
           $z=$idarray;
           $q=count($a);
          for($i=0;$i<$q;$i++){
    $item_id=$z[$i];
    $item_price=$a[$i];

    $db -> query("UPDATE items SET price='$item_price' WHERE id='$item_id'");

         }
         }

 $listselect_id=$_SESSION['catid'];
     Header("Location: index.php?op=select&mode=listselect&id=$listselect_id"); //$catid
 unset ($_SESSION['catid']);
      break;
     }




if (!isset($_GET['mode'])) $_GET['mode']="";
 //if ((isset  ($listselect_id)) && (!empty  ($listselect_id))) $mode="listselect";
  // else
    $mode=$_GET['mode'];
        switch($mode) {

  case "listcatalog":
  $tmpl -> loadTemplatefile('listcatalog.inc',true,true);

        $res = $db -> query("SELECT id,name FROM category WHERE status='Y' ORDER BY updown");
if($res -> numRows()) {
  while($row = $res -> fetchRow()) {
       $tmpl -> setCurrentBlock('list_items_cat1');
       $tmpl -> setVariable($row);
       $tmpl -> parseCurrentBlock('list_items_cat1');
         }
         }
      break;

     case "listselect":

       $tmpl -> loadTemplatefile('listselect.inc',true,true);
       $id=$_GET['id'];  //catalog id
//
	$catid =$id;
       global $$catid;
       $res = $db -> query("SELECT name FROM category WHERE id='$id'");
        if($res -> numRows()) {
       while($rows = $res -> fetchRow()){
       $tmpl -> setCurrentBlock('list_cat');
       $tmpl -> setVariable($rows);
       $tmpl -> parseCurrentBlock('list_cat');
         }
         }

       $result = $db -> query("SELECT * FROM items WHERE cid='$id'");
       if($result -> numRows()) {
       while($row1 = $result -> fetchRow()){

       $tmpl -> setCurrentBlock('list_items');
       $tmpl -> setVariable($row1);
       $tmpl -> parseCurrentBlock('list_items');
               }
            }

    $rest = $db -> query("SELECT id,name FROM category WHERE status='Y' ORDER BY updown");
 if($rest -> numRows()) {
  while($rowt = $rest -> fetchRow()) {
       $tmpl -> setCurrentBlock('list_items_cat1');
       $tmpl -> setVariable($rowt);
       $tmpl -> parseCurrentBlock('list_items_cat1');
//
    //   $tmpl->show();
         }
         }
  // log_array ($tmpl);
//  log_array ($rows);
 // log_array ($result);
 // log_array ($rest);
// $listselect_id=$id;
 $_SESSION['catid']=$id;
// global $$listselect_id;
    break;
   }

?>