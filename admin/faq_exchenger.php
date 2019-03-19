<?php

require_once("./auth.php");

if (!isset($_POST['module']))  $_POST['module']="";
//if (!empty($_POST['module'])) $_POST['module']="";
switch($_POST['module']) {
  case "updel":

$page=$_POST['page'];
$cat=$_POST['cat'];
$id=$_POST['id'];
$del=$_POST['del'];
$messfaq=$_POST['messfaq'];
$answer=$_POST['answer'];

if(isset($del)){
          $a=$del;
          $z=$id;
          $s=$messfaq;
          $an=$answer;

           $q=count($a);
          for($i=0;$i<$q;$i++){
          if($a[$i]==2){
                                  // ("SELECT * FROM faqtov WHERE cid='$idtov')
     $db -> query("DELETE FROM faqtov WHERE id='$z[$i]'");
         }
         else {
 $db -> query("UPDATE faqtov SET messfaq='$s[$i]',answer='$an[$i]' WHERE id='$z[$i]'");
  }

         }
  }
//log_array($id);
header("Location: index.php?op=faqcatalog&page=$page&cat=$cat&id=$id&DEL=$del");
 exit;


break;
default:
  if (!isset($_GET['cat'])) $_GET['cat']="";
  if(!empty($_GET['cat'])){

 $pages=$_GET['page']-1;
 $page=$_GET['page'];

  $per_page=20;
  $start=$pages * $per_page;



  $tmpl -> loadTemplatefile("faq_exchenger1.inc",true,true);
 $idtov=$_GET['cat'];
  $rowr = $db -> getOne("SELECT name FROM category WHERE id='$idtov'");
if(!empty($rowr)) {


        $tmpl -> setVariable('namec', $rowr);

  }

 $tmpl -> setVariable('cat', $idtov);
 $tmpl -> setVariable('page', $page);

  $row = $db -> getAll("SELECT * FROM faqtov WHERE cid='$idtov' LIMIT $start,$per_page");
if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('list_cat');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('list_cat');

  }
}else{
    $tmpl -> touchBlock('no_list_cat');
    }

$roww ="SELECT count(*) FROM faqtov WHERE cid='$idtov'";

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
    $tmpl -> setVariable('s','<span style="font-size:9pt"><font face="Verdana" color="000000"><a href="index.php?op=faqcatalog&page='.$i.'cat='.$_GET['cat'].'">'.$i.'</a></font></span>&nbsp;&nbsp;');
    }
   $tmpl -> parseCurrentBlock('list_nav');
   }
   $tmpl -> setVariable('hr1','<hr color="000000" size=1 noshade>');

  }else{

$tmpl -> loadTemplatefile("faq_exchenger.inc",true,true);
$f = $db -> getAll("SELECT * FROM category WHERE status='Y'");
if(!empty($f)) {
  foreach($f as $vals) {

        $tmpl -> setCurrentBlock('list_catfaq');
        $tmpl -> setVariable($vals);
        $tmpl -> parseCurrentBlock('list_catfaq');
  }
}else{
        $tmpl -> touchBlock('no_list_catfaq');
 }
 }

}

?>