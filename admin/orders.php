<?php
// php5.6 pear-php HTTP-Template-IT  //client order list  //php7.2
require_once("./auth.php");


if(!isset($_GET['status'])) $_GET['status'] = '';
if(!isset($_GET['old_status'])) $_GET['old_status'] = '';
if(!isset($_GET['zid'])) $_GET['zid'] = '';
if(!isset($_GET['pages'])) $_GET['pages'] = '';

$status=$_GET['status'];
$zid=$_GET['zid'];
$pages=$_GET['pages'];
$old_status=$_GET['old_status'];
if(empty($_GET['filter'])) $_GET['filter'] = 'process';
$filter=$_GET['filter'];
$op=$_GET['op'];
echo "<pre>";
//print_r($status);
//print_r($zid);
//print_r($pages);
//print_r($_GET);

echo "</pre>";

if(isset($_GET['status']) AND !empty($_GET['status'])) {

  $db -> query("UPDATE orders SET status='$status' WHERE zid='$zid'");
  header("Location: index.php?op=orders&filter=$old_status&pages=$pages");
  exit;
}

$query = "FROM orders WHERE status='$filter'";
$c_pagenum = $db->getOne("SELECT value FROM settings WHERE id='30'");
//input op pages filter
include("./nav_bar.php");
$res = $db -> query("SELECT *,date_format(date_zid,'%d.%m.%Y (%H:%i:%s)') as date_zid,date_format(date_delivery,'%d.%m.%Y') as date_delivery ".$query." ORDER BY zid DESC LIMIT $vstart,$c_pagenum");
//print_r ($res);
if($res -> numRows()) {
  while($row = $res -> fetchRow()) {
//print_r ($row);
  $zid=$row['zid'];
  $uid=$row['uid'];
        $res_items = $db -> query("SELECT * FROM orders_items WHERE zid='$zid' AND uid='$uid'");
        if($res_items -> numRows()) {
          while($rows = $res_items -> fetchRow()) {
          $tid=$rows['tid'];
                $rows['price_summa'] = number_format($rows['quantity'] * $rows['price'],0,"","");
$sp = $db -> getRow("SELECT items FROM spec WHERE items LIKE '%|$tid|%' AND status='Y' AND start_date < now() AND (end_date > now() OR end_date='1970-01-01 00:00')");  //small picture
if(!empty($sp)) $rows['sp'] = "<img src=../images/icon_sp.gif width=25 height=25>";
                $tmpl -> setCurrentBlock("items");
                $tmpl -> setVariable($rows);
                $tmpl -> parseCurrentBlock();
//                $tmpl -> free();
          }
        }
        $row['email'] = $db -> getOne("SELECT username FROM users WHERE id='$uid'");;
        $part = explode("|",$row['time_delivery']);
        $size =  sizeof($part)-1;
        $time_delivery = "";
        for($i = 1; $i < $size; $i++) {
          $kum = explode("-",$part[$i]);
          $time_delivery .= "c ".$kum[0].":00 до ".$kum[1].":00 или ";
        }
        $row['time_delivery'] = substr($time_delivery,0,-5);

        if (!empty($_GET['pages'])) $row['pages'] = $_GET['pages'];
        else $row['pages'] = 1;

        $row['old_status'] = $_GET['status'];
$result_uid = $db->getOne("SELECT id FROM users WHERE phone LIKE '$row[phone]'");
print_r ($row['phone']);
print_r ($result_uid);
        $tmpl -> setCurrentBlock("list_orders");
        if($row['summa'] <= 30000) $row['delivery_total'] = "300.00";
        else $row['delivery_total'] = "0.00";
        $tmpl -> setVariable($row); // zid - id of order - if wrong =0 - try get from 'users' table
       if ($row['uid'] == 0) {
       $tmpl -> setVariable('uid',$result_uid);
	}
         $tmpl -> parseCurrentBlock();
 //        $tmpl -> parseCurrentBlock("list_orders");
//        $tmpl -> free();
  }
} else {
  $tmpl -> touchBlock("no_list");
}

switch ($_GET['filter']) {
  case "process": $tmpl->setVariable('filter',"обрабатываемых"); break;
  case "success": $tmpl->setVariable('filter',"выполненых"); break;
  case "delete":  $tmpl->setVariable('filter',"удаленых"); break;
}

  if ($direct_bar != " <font class=active>1</font> " AND !isset($direct_bar)) $tmpl -> setVariable('nav_bar',$direct_bar);

?>