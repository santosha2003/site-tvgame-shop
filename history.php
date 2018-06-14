<?php
require_once("./lib/config.php");

$tmpl -> loadTemplatefile("history.inc",true,true);

$res = $db -> query("SELECT * FROM orders WHERE uid='".$_SESSION[auth][id]."' ORDER BY zid");
if($res -> numRows()) {
  while($row = $res -> fetchRow()) {
	$res_items = $db -> query("SELECT * FROM orders_items WHERE zid='$row[zid]' AND uid='$row[uid]'");
	if($res_items -> numRows()) {
	  while($rows = $res_items -> fetchRow()) {
		$rows[price_summa] = number_format($rows[quantity] * $rows[price],2,"","");
		$tmpl -> setCurrentBlock("items");
		$tmpl -> setVariable($rows);
		$tmpl -> parseCurrentBlock("items");
		$tmpl -> free();
	  }
	}
	$row[email] = $a -> getUsername();
	if($row[summa] < 30000) $row[delivery_total] = "300.00";
	else $row[delivery_total] = "0.00";
	$tmpl -> setCurrentBlock("list_orders");
	$tmpl -> setVariable($row);
	$tmpl -> parseCurrentBlock("list_orders");
	$tmpl -> free();
  }
} else {
  $tmpl -> touchBlock("no_list");
}


$tmpl -> setVariable('mrfio',$db -> getOne("SELECT fio FROM users WHERE id='".$_SESSION[auth][id]."'"));
$tmpl -> setVariable('muid',$db -> getOne("SELECT id FROM users WHERE id='".$_SESSION[auth][id]."'"));



?>