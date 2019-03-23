<?php
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}
  

//print_r($_GET);
//print_r($_POST);

(string) $cid;
if(empty($_GET["cid"])) $_GET["cid"] = 2;

$cid= $_GET["cid"];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
<link rel=stylesheet href="style.css" type="text/css"> 
</head>
<body bgcolor=white onload="self.focus();">

<p class=th align=center style="border: solid 1px;">Дерево каталога</p>
<table width=100% border=1 bgcolor="#FFFFFF" bordercolor="#F0F0F0" style="border-collapse: collapse;">
<?
if (!isset($str))  $str="";
echo "<tr><td>".$str."<a class=th href='#' onClick='javascript:window.opener.location.href=\"index.php?op=item&parent=".$cid."\"'>".$db -> getOne("SELECT name FROM category WHERE id = '$cid'")."</td></tr>";
$ree = $db -> getAll("SELECT * FROM items WHERE cid='$cid'");
if(!empty($ree)) {
  foreach($ree as $row) {
    if (!isset($str))  $str="";
    echo "<tr><td class=t>&nbsp;&nbsp;&nbsp;&nbsp;".$str."<a href='#' onClick='javascript:window.opener.location.href=\"index.php?op=item&action=item_edit&id=".$row['id']."&parent=".$row['cid']."\"'>".$row['name']." ".$row['model']." ".$row['article']."</a></td></tr>";
  }
}
viewvetka($cid);

?>
</table>
<p align=center><input type=button value="Закрыть окно" onClick="window.close();"></p>
<?

function viewvetka($id,$level=0) {
  GLOBAL $db, $cid;
  $result = $db -> query("SELECT * FROM category WHERE parent='$id' ORDER BY updown");
  while($row = $result -> fetchRow()) {
	$list[] = array($row['parent'],$row['id'],$row['name']);
  }
  $i=0; $str = "";
  if (!empty($list)) {
	for($i=0; $i<$level; $i++) {
	  $str .= "&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	foreach($list as $item) {
	  $i++;
	  echo "<tr><td>".$str."<a class=th href='#' onClick='javascript:window.opener.location.href=\"index.php?op=item&parent=".$item[1]."\"'>$item[2]</td></tr>";
	  $ree = $db -> getAll("SELECT * FROM items WHERE cid='$item[1]'");
	  if(!empty($ree)) {
		foreach($ree as $row) {
		  echo "<tr><td class=t>&nbsp;&nbsp;&nbsp;&nbsp;".$str."<a href='#' onClick='javascript:window.opener.location.href=\"index.php?op=item&action=item_edit&id=".$row['id']."&parent=".$row['cid']."\"'>".$row['name']." ".$row['model']." ".$row['sku']."</td></tr>";
		}
	  }
	  viewvetka($item[1], $level+1);
	}
  }
}


?>