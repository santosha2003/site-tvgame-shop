<?php
require_once('./auth.php');
if(!isset($_GET['action'])) $_GET['action']="";
switch($_GET['action']) {
  case 'vis':
	$result = $db -> query("UPDATE users SET status='Y' WHERE id = '$_GET[id]'");
  	header("Location: index.php?op=users");
	exit;
	break;
  case 'inv':
	$result = $db -> query("UPDATE users SET status='N' WHERE id = '$_GET[id]'");
  	header("Location: index.php?op=users");
	exit;
	break;
  case 'del':
	$result = $db -> query("DELETE FROM users WHERE id = '$_GET[id]'");
	header("Location: index.php?op=users");
	exit;
	break;
}


$result = $db -> query("SELECT *,date_format(date_log,'%d.%m.%Y (%H:%i:%s)') as date_login FROM users ORDER BY date_log DESC");
if($result -> numRows()) {
  while ($row = $result -> fetchRow()) {
	if($row['status'] == 'Y') {
	  $row['bgcolor'] = '#FFFFFF';
	  $tmpl -> setCurrentBlock("vis");
	  $tmpl -> setVariable("ids",$row['id']);
	  $tmpl -> parseCurrentBlock("vis");
	} else {
	  $row['bgcolor'] = '#F5F5F5';
	  if(!empty($row['username'])) {
		$tmpl -> setCurrentBlock("inv");
		$tmpl -> setVariable("ids",$row['id']);
		$tmpl -> parseCurrentBlock("inv");
	  }
	}
	$tmpl -> setCurrentBlock("list");
	$tmpl -> setVariable($row);
	$tmpl -> parseCurrentBlock("list");
	
  }
} else {
  $tmpl -> touchBlock("no_list");
}



?>
