<?php
require_once("./auth.php");
 $tmpl -> loadTemplatefile('update_speed_tov.inc',true,true);
  switch($_POST['mode']) {
  case "start":
         if(isset($kod1c)){
          $a=$kod1c;
           $z=$id;
           $q=count($a);
          for($i=0;$i<$q;$i++){
    $item_id=$z[$i];
    $item_kod1c=$a[$i];

    $res= $db -> query("UPDATE items SET kod1c='$item_kod1c' WHERE id='$item_id'");

         }
         }

     if(isset($price)){
          $a=$price;
           $z=$id;
           $q=count($a);
          for($i=0;$i<$q;$i++){
    $item_id=$z[$i];
    $item_price=$a[$i];

    $res= $db -> query("UPDATE items SET price='$item_price' WHERE id='$item_id'");

         }
         }

     Header("Location: index.php?op=update_speed_tov");
      break;

  default:


       $result = $db -> query("SELECT id,cid,name,mark,model,sku,kod1c,price FROM items");
       if($result -> numRows()) {
       while($row1 = $result -> fetchRow()){

       $tmpl -> setCurrentBlock('list_items');
       $tmpl -> setVariable($row1);
       $tmpl -> parseCurrentBlock('list_items');
               }
                }


   }

?>