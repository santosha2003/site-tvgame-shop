<?php

  require_once("./auth.php");

   if(isset($_POST['del'])){
          $a=$_POST['del'];
          $z=$_POST['idlinks'];
           $q=count($a);
          for($i=0;$i<$q;$i++){
          if($a[$i]==2){
          $rt=$z[$i];
     $db -> query("DELETE FROM links_links WHERE idlinks='$rt'");
         }
         }
      Header("Location: index.php?op=linkscatalog"); 
         }

         //}




 if(!empty($_GET['idcat'])){

 $pages=$_GET['page']-1;

  $per_page=20;
  $start=$pages * $per_page;



  $tmpl -> loadTemplatefile("links_catalog1.inc",true,true);

  $rowr = $db -> getOne("SELECT namecat FROM links_catalog WHERE idcat='$_GET[idcat]'");
if(!empty($rowr)) {


        $tmpl -> setVariable('namecat', $rowr);

  }






  $row = $db -> getAll("SELECT * FROM links_links WHERE idcat='$_GET[idcat]' LIMIT $start,$per_page");
if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('list_cat');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('list_cat');

  }
}else{
    $tmpl -> touchBlock('no_list_cat');
    }

$roww ="SELECT count(*) FROM links_links WHERE idcat='$_GET[idcat]'";

$tmpl -> setVariable('hr','<hr color="000000" size=1 noshade>');
 $res=mysql_query($roww);
$rows=mysql_fetch_row($res);

$total_rows=$rows[0];
$num_pages=ceil($total_rows/$per_page);

 for($i=1;$i<=$num_pages;$i++) {
  $tmpl -> setCurrentBlock('list_nav');
  if ($i-1 == $pages) {

    $tmpl -> setVariable('s','<span style="font-size:9pt"><font face="Verdana" color="red">'.$i.'</font></span>&nbsp;&nbsp;');


  } else {
    $tmpl -> setVariable('s','<span style="font-size:9pt"><font face="Verdana" color="000000"><a href="index.php?op=linkscatalog&page='.$i.'&idcat='.$_GET[idcat].'">'.$i.'</a></font></span>&nbsp;&nbsp;');
    }
   $tmpl -> parseCurrentBlock('list_nav');
   }
   $tmpl -> setVariable('hr1','<hr color="000000" size=1 noshade>');

  }else{






  $tmpl -> loadTemplatefile("links_catalog.inc",true,true);
$row = $db -> getAll("SELECT * FROM links_catalog");
if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('list_cat');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('list_cat');
//        $tmpl -> free();
  }
}

 }

?>