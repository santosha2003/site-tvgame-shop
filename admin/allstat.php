<?php

require_once("./auth.php");
switch($_GET['mode']) {
  case "statistic":
 $pid=$_GET['pid'];
 $tmpl -> loadTemplatefile("constat.inc",true,true);
 $catname = $db -> getOne("SELECT name FROM category WHERE id='$pid'");
   $tmpl -> setVariable('catname',$catname);
  $fp=fopen("../countip/c".$pid.".txt","r");
$row[count]=fread($fp,100000);
if($row[count]!=true){
$row[count]="0";
}
$tmpl -> setCurrentBlock('list_count');
        $tmpl -> setVariable($row);
        $tmpl -> parseCurrentBlock('list_count');

 if (file_exists("../countip/iplog".$pid.".txt")){
$con=file("../countip/iplog".$pid.".txt");
 //$rows[line]=fread($fp,100000);
 foreach ($con as $line) {
 //$line[line]=$line;
 $tmpl -> setCurrentBlock('list');
        $tmpl -> setVariable('ip',$line);
        $tmpl -> parseCurrentBlock('list');
  }
  }else $tmpl -> touchBlock('no_ip');

  $tmpl -> setVariable('pid',$pid);

  break;
 case "delete":
 $pid=$_GET['pid'];
 unlink("../countip/iplog".$pid.".txt");
 unlink("../countip/c".$pid.".txt");
 header("Location: index.php?op=allstat&mode=statistic&pid=".$pid);
  exit;
  break;

  default:




$tmpl -> loadTemplatefile("allstat.inc",true,true);


$row = $db -> getAll("SELECT id,name FROM category WHERE status='Y' AND parent='2' ORDER BY updown");
if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('list_cat');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('list_cat');
        $tmpl -> free();
  }
}

 }



?>