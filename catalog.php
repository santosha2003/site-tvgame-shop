<?php

require_once("./lib/config.php");
 /*
 if($REMOTE_ADDR!="83.242.166.154"){
$date=date('d M Y, H:i:s');
$count=@file("countip/c".$pid.".txt");

$fp=fopen("countip/c".$pid.".txt","w");
fwrite($fp,0);
fclose($fp);
$fp=fopen("countip/c".$pid.".txt","w");
$count[0]++;
 fwrite($fp,$count[0]);
fclose($fp);
$log=fopen("countip/iplog".$pid.".txt", "a+");

    fputs ($log,"<b>".$REMOTE_ADDR."</b>&nbsp;&nbsp;(".$date.")\n");
    fclose($log);
 }
 //путь перемещения

 $date=date('d M Y, H:i:s');

$log=fopen("countip/iplogfullstat.txt", "a+");

    fputs ($log,"<b>".$REMOTE_ADDR."</b>&nbsp;&nbsp;".$HTTP_REFERER."<b>-></b>".$REQUEST_URI."&nbsp;(".$date.")\n");
    fclose($log);
 */




$tmpl -> loadTemplatefile('catalog.inc',true,true);

// debug
//$tmpl ->show();

if(empty($_GET['cid'])) $_GET['cid'] = $_GET['pid'];

$c_id=$_GET['cid'];

$row = $db -> getAll("SELECT id,name FROM category WHERE parent='$c_id' AND status='Y' AND shops LIKE '%|$shop_true_id|%'");
if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('list_cat');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('list_cat');
        $tmpl -> free();
  }
}

  if(empty($_GET['page'])){
 $_GET['page']=1;
 }

 $pages=$_GET['page']-1;
  $per_page=60;
  $start=$pages * $per_page;

$row = $db -> getAll("SELECT id,cid,name,price,photo_small,model FROM items WHERE cid='$c_id' AND status='Y' AND shops LIKE '%|$shop_true_id|%' ORDER BY updown LIMIT $start,$per_page");
if(!empty($row)) {
  foreach($row as $val) {
        $val[photo_small] = photo_name($val[photo_small]);
        $val[wh] = photo_size($val[photo_small],81,50);
        $tmpl -> setCurrentBlock('list_items');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('list_items');
        $tmpl -> free();
  }
}

 $roww ="SELECT count(*) FROM items WHERE cid='$c_id' AND status='Y' AND shops LIKE '%|$shop_true_id|%'";

$tmpl -> setVariable('hr','<hr color="000000" size=1 noshade>');
 $res=mysql_query($roww);
$rows=mysql_fetch_row($res);

$total_rows=$rows[0];
$num_pages=ceil($total_rows/$per_page);

 for($i=1;$i<=$num_pages;$i++) {
  $tmpl -> setCurrentBlock('list_nav');
  if ($i-1 == $pages) {

    $tmpl -> setVariable('s',"<span style='font-size:10pt'><font color=000000 face=Verdana>".$i."</font></span>&nbsp;&nbsp;");


  } else {
    $tmpl -> setVariable('s','<span style="font-size:10pt"><font face=Verdana><a href="index.php?op=catalog&cid='.$c_id.'&page='.$i.'">'.$i.'</a></font></span>&nbsp;&nbsp;');
    }
   $tmpl -> parseCurrentBlock('list_nav');
   }
   $tmpl -> setVariable('hr1','<hr color="000000" size=1 noshade>');


$row = $db -> getRow("SELECT * FROM category WHERE id='$c_id' AND status='Y' AND shops LIKE '%|$shop_true_id|%'");
$tmpl -> setVariable($row);

if($pid==55){
$date=date('d M Y, H:i:s');
$count=@file("countip/count.txt");

$fp=fopen("countip/count.txt","w");
fwrite($fp,0);
fclose($fp);
$fp=fopen("countip/count.txt","w");
$count[0]++;
 fwrite($fp,$count[0]);
fclose($fp);
$log=fopen("countip/iplog.txt", "a+");
    fputs ($log,$REMOTE_ADDR."     (".$date.")\n");
    fclose($log);
 }


 ?>