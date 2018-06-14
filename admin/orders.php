<?php
// php5.6 pear-php HTTP-Template-IT  //client order list
require_once("./auth.php");



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
print_r($_GET);

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

if($res -> numRows()) {
  while($row = $res -> fetchRow()) {
        $res_items = $db -> query("SELECT * FROM orders_items WHERE zid='$row[zid]' AND uid='$row[uid]'");
        if($res_items -> numRows()) {
          while($rows = $res_items -> fetchRow()) {
                $rows[price_summa] = number_format($rows[quantity] * $rows[price],0,"","");
$sp = $db -> getRow("SELECT items FROM spec WHERE items LIKE '%|$rows[tid]|%' AND status='Y' AND start_date < now() AND (end_date > now() OR end_date='1970-01-01 00:00')");
if(!empty($sp)) $rows[sp] = "<img src=../images/icon_sp.gif width=25 height=25>";
                $tmpl -> setCurrentBlock("items");
                $tmpl -> setVariable($rows);
                $tmpl -> parseCurrentBlock("items");
                $tmpl -> free();
          }
        }
        $row[email] = $db -> getOne("SELECT username FROM users WHERE id='$row[uid]'");;
        $part = explode("|",$row[time_delivery]);
        $size =  sizeof($part)-1;
        $time_delivery = "";
        for($i = 1; $i < $size; $i++) {
          $kum = explode("-",$part[$i]);
          $time_delivery .= "c ".$kum[0].":00 до ".$kum[1].":00 или ";
        }
        $row[time_delivery] = substr($time_delivery,0,-5);

        if (!empty($_GET['pages'])) $row['pages'] = $_GET['pages'];
        else $row[pages] = 1;

        $row['old_status'] = $_GET['status'];

        $tmpl -> setCurrentBlock("list_orders");
        if($row[summa] <= 30000) $row[delivery_total] = "300.00";
        else $row[delivery_total] = "0.00";
        $tmpl -> setVariable($row);
        $tmpl -> parseCurrentBlock("list_orders");
        $tmpl -> free();
  }
} else {
  $tmpl -> touchBlock("no_list");
}

switch ($_GET['filter']) {
  case "process": $tmpl->setVariable('filter',"обрабатываемых"); break;
  case "success": $tmpl->setVariable('filter',"выполненых"); break;
  case "delete":  $tmpl->setVariable('filter',"удаленых"); break;
}

  if ($direct_bar != " <font class=active>1</font> " AND !empty($direct_bar)) $tmpl -> setVariable('nav_bar',$direct_bar);

?>