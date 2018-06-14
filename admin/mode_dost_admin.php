<?php
require_once("./auth.php");

switch($_POST['mode']) {

  case "updel":
  if(isset($_POST['select'])){
          $a=$_POST['select'];
           $t=$_POST['name_d'];
           $z=$_POST['idd'];
           $d=$_POST['cost'];
           $q=count($a);
          for($i=0;$i<$q;$i++){
          if($a[$i]==2){
     $db -> query("DELETE FROM dost_name WHERE idd='$z[$i]'");

         }
     $db -> query("UPDATE dost_name SET name_d='$t[$i]', cost='$d[$i]' WHERE idd='$z[$i]'");
         }
         }

    if(!empty($_POST[name_add])&&($_POST[name_cost])){


    $db -> query("INSERT INTO dost_name (name_d,cost) VALUES('$_POST[name_add]','$_POST[name_cost]')");
    }

    Header("Location: index.php?op=deliverys");
     exit;
     break;


 default:



 $tmpl -> loadTemplatefile("mode_dost_admin.inc",true,true);



  $res1 = $db -> getAll("SELECT idd,name_d,cost FROM dost_name");
  if(!empty($res1)) {
        foreach($res1 as $row1) {
        $row1[fio1]=$row1[fio];
        $tmpl -> setCurrentBlock('dost_razdel');
        $tmpl -> setVariable($row1);
        $tmpl -> parseCurrentBlock('dost_razdel');

        }
      }else{
      $tmpl -> touchBlock('dost_no_razdel');

      }



   }




 ?>