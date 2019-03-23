<?php
require_once("./lib/config.php");
$tmpl = new HTML_Template_IT('./templates');
//require_once("HTML/Template/IT.php");
//print_r ($tmpl -> getGlobalvariables ( ));
$tmpl -> loadTemplatefile('left.inc',false,true);
//$tmpl -> parse ('left');
if(isset($_GET['id']) AND !empty($_GET['id'])) {
  $_GET['cid'] = $db -> getOne("SELECT cid FROM items WHERE id='$_GET[id]'");
}

if(isset($_GET['cid']) AND !empty($_GET['cid'])) {
  $row = $db -> getRow("SELECT * FROM category WHERE id = '$_GET[cid]' AND status='Y' AND shops LIKE '%|$shop_true_id|%'");
  if(!empty($row)) {
	$children[parent] = $row[parent];
	while ( $children[parent] != 2) 
	  $children = $db -> getRow("SELECT id,parent FROM category WHERE id='$children[parent]'");
	$_GET['pid'] = $children[id];
  }
}

$res = $db -> query("SELECT id,name FROM category WHERE parent=2 AND status='Y' AND shops LIKE '%|$shop_true_id|%' ORDER BY updown");
if($res -> numRows()) {
  while($row = $res -> fetchRow()) {
if(!isset($_GET['pid'])) $_GET['pid']="";
	if($_GET['pid'] == $row['id']) $block_name = 'cat_main_minus';
	else $block_name = 'cat_main_plus';

	$tmpl -> setCurrentBlock($block_name);
	$tmpl -> setVariable($row);
	$tmpl -> parseCurrentBlock($block_name);
	if($row['id'] == $_GET['pid']) {
	  $result = $db -> query("SELECT id,name FROM category WHERE parent = '$_GET[pid]' AND status='Y' AND shops LIKE '%|$shop_true_id|%' ORDER BY updown");
	  if($result -> numRows()) {
		while($subrow = $result -> fetchRow()) {
		  $tmpl -> setCurrentBlock("cat_submain");
		  $tmpl -> setVariable($subrow);
		  $tmpl -> parseCurrentBlock("cat_submain");
		}
	  }
	}
	$tmpl -> touchBlock('cat_separator');
	$tmpl -> setCurrentBlock("list");
	$tmpl -> parseCurrentBlock("list");
//	$tmpl -> free();	
  }
} else {
  $tmpl -> touchBlock('cat_separator');
}


?>