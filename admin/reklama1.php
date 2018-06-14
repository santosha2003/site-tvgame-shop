<?php
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}

if (!isset($_POST['action'])) $_POST['action']="";
if (!isset($_POST['item_id'])) $_POST['item_id']="";
if (!isset($_POST['parent'])) $_POST['parent']="2";
if (!isset($_POST['pages'])) $_POST['pages']="1";
if (!isset($_POST['source'])) $_POST['source']="";  //new or statu or rating
if (!isset($_POST['val'])) $_POST['val']="";
if (!isset($_POST['cid'])) $_POST['cid']="";

  $source=$_POST['source'];
  $item_id=$_POST['item_id'];
  $parent=$_POST['parent'];
  $pages=$_POST['pages'];
 $val=$_POST['val'];
 $cid=$_POST['cid'];

switch( $_POST['action']) {

  case "step3":

  	switch($source) {
	case 'statu':
	case 'ratings':
	  if(empty($_POST['item_del'])) $_POST['item_del'] = array();
	  foreach($_POST['item_del'] as $id) {
		$max = $db -> getOne("SELECT MAX(b.description)+10 FROM description b LEFT JOIN items a ON (a.id=b.id AND a.rating LIKE '%|".$item_id."|%') WHERE b.shop='$item_id' AND b.source='ud_".$source."'");
		if(empty($max)) $max = 10;
		$res = $db -> query("DELETE FROM description WHERE shop='$item_id' AND source='ud_".$source."' AND id='$id'");
		$res = $db -> query("INSERT INTO description (id,shop,source,description) VALUES ('$id','$item_id','ud_".$source."','$max')");
		$res = $db -> query("
		  UPDATE 
			items 
		  SET 
			".$source."=REPLACE(".$source.",'|".$item_id."|',''), 
			".$source."=CONCAT(".$source.",'|".$item_id."|') 
		  WHERE 
			id = '$id' 
		");
	  }
	  $res = $db -> query("UPDATE items SET ".$source."=REPLACE(".$source.",'||','|') WHERE rating LIKE '%||%'");
	  $res = $db -> query("UPDATE items SET ".$source."='' WHERE ".$source." = '|'");
	  header("Location: rating1.php?action=$source");
	  exit;
	break;
	}

	$part = $val; //$_POST['val'];
	$items  = $db -> getCol("SELECT id FROM items WHERE cid='$cid' AND id!='$item_id'");
	if(empty($_POST['item_del'])) $_POST['item_del'] = array();
	if(!empty($items)) {
	  foreach($items as $val) {
		$check = strpos($part,"|".$val."|");
		if(in_array($val,$_POST['item_del'])) {
		  if($check !== false) continue;
		  if(empty($part)) $part = "|$val|";
		  else $part .= "$val|";
		} else {
		  if($check !== false) {
			$part = str_replace("$val|","",$part);
			$part = str_replace("|l","|",$part);
		  }
		}
	  }
	}
	if(empty($_GET['call'])) {
	   $item_id=$_POST['item_id'];
  	  $res = $db -> query("UPDATE items SET ".$source='$part'." WHERE id='$item_id'");
	}
	$_POST['val'] = $part;
	$_POST['source'] = $part;
	$val=$part;
	header("Location: reklama1.php?item_id=$item_id&parent=$parent&pages=$pages&source=$source&call=$call&val=$val");
	exit;
	break;
}

 if (!isset($_GET['action'])) $_GET['action']="";
 if (!isset($_GET['source'])) $_GET['source']="";
  if (!isset($_GET['parent'])) $_GET['parent']="2";
  if (!isset($_GET['pages'])) $_GET['pages']="1";
 if (!isset($_GET['item_id'])) $_GET['item_id']="";
 if (!isset($_GET['cid'])) $_GET['cid']="";
 if (!isset($_GET['call'])) $_GET['call']="";
 if (!isset($_GET['val'])) $_GET['val']="";
	$source = $_GET['source'];
	$parent = $_GET['parent'];
	$pages = $_GET['pages'];
	$item_id=$_GET['item_id'];
	$cid=$_GET['cid'];
	$call = $_GET['call'];
	$val=$_GET['val'];

switch ($_GET['action']) {

  case "step2":
	$tmpl -> loadTemplatefile("reklama2_1.inc",true,true);
	if(empty($call)) {
	  $part = $db ->getOne("SELECT $source FROM items WHERE id='$item_id'");
	} else {
	  $part = $val;
	}
if($source == 'statu') $wher = " AND shops LIKE '|%".$item_id."%|'";
if($source == 'ratings') $wher = " AND shops LIKE '|%".$item_id."%|'";
if (!isset($wher)) $wher="";
	$result = $db -> query("SELECT * FROM items WHERE cid='$cid' AND status='Y' AND id!='$item_id' ".$wher." ORDER BY updown");
	if ($result -> numRows()) {
	  while ($row = $result -> fetchRow()) {
		$check = strpos($part,"|".$row['id']."|");
		if($check !== false) $row['checked'] = ' checked';
		else $row['checked'] = "";
		$tmpl -> setCurrentBlock("tovar");
		$tmpl -> setVariable($row);
		$tmpl -> parseCurrentBlock("tovar");
	  }
	} else {
	  $tmpl -> touchBlock("no_tovar");
	}
if (!isset($row)) $row="";
	$tmpl -> setVariable($row);
	$tmpl -> setVariable('parent',$parent);
	$tmpl -> setVariable('pages',$pages);
	$tmpl -> setVariable('item_id',$item_id);
	$tmpl -> setVariable('source',$source);
	$tmpl -> setVariable('call',$call);
	$tmpl -> setVariable('val',$val);
	break;


  default:
 if (!isset($_GET['source'])) $_GET['source']="";
 if (!isset($_GET['item_id'])) $_GET['item_id']=""; 
	$tmpl -> loadTemplatefile("reklama1_1.inc",true,true);
	if(empty($_GET['call'])) {
	  $stri = $db -> getOne("SELECT $_GET[source] FROM items WHERE id='$_GET[item_id]'");
	  $_GET['val'] = $stri;
	} else {
	  $stri = $_GET['val'];
	}
	viewvetka(2,$stri);
	$tmpl -> setVariable('call',$_GET['call']);
	$tmpl -> setVariable('val',$_GET['val']);
	$tmpl -> setVariable('source',$_GET['source']);
}


$tmpl->parse();
$tmpl->show();



function viewvetka($id,$stri,$level=0) {
  GLOBAL $db, $opsa, $tmpl, $mesto, $parent, $_GET;

 if (!isset($_GET['source'])) $_GET['source']="";
 if (!isset ($_GET['item_id'])) $_GET['item_id']="";
 if (!isset($_GET['parent'])) $_GET['parent']="2";
 if (!isset ($_GET['pages'])) $_GET['pages']="1";
 if (!isset ($_GET['item_id'])) $_GET['item_id']="";
 if (!isset ($_GET['call'])) $_GET['call']="";
  $source =$_GET['source'];
  $parent =$_GET['parent'];
	$pages = $_GET['pages'];
	$item_id=$_GET['item_id'];
	$cid=$_GET['cid'];
	$call = $_GET['call'];
	$val=$_GET['val'];
	$call=$_GET['call'];

  $result = $db -> query("SELECT * FROM category WHERE parent='$id' ORDER BY updown");
  while($row = $result -> fetchRow()) {
	$list[] = array($row['parent'],$row['id'],$row['name']);
  }
  $i=0; $str = "";
  if (!empty($list)) {
	for($i=0; $i<$level; $i++) {
	  $str .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	foreach($list as $item) {
	  $i++;
	  $res = $db -> getRow("SELECT id,name FROM category WHERE id = '$item[1]'");
	  if($parent == $res['id']) {
		$res['clas'] = "<font color=red><b>";
		$res['endclas'] = "</b></font>";
	  } else {
		$res['clas'] = "";
		$res['endclas'] = "";
	  }
	  

if($source == 'statu') $wher = " AND shops LIKE '|%".$item_id."%|'";
if($source == 'ratings') $wher = " AND shops LIKE '|%".$item_id."%|'";
    if (!isset ($wher)) $wher="";
	  $res['total'] = $db -> getOne("SELECT COUNT(*) FROM items WHERE cid = '$item[1]'".$wher);
	  $res['total_filter'] = 0;
//$tt = $db -> getOne("SELECT $_GET[source] FROM items WHERE id='$_GET[item_id]'");
	  $tt = $db -> getCol("SELECT id FROM items WHERE cid = '$item[1]' AND id!='$item_id'");
	  if(!empty($tt)) {
		foreach($tt as $vv) {
		  $check = strpos($stri,"|$vv|");
		  if($check !== false) $res['total_filter']++;
		}	  
	  }
		$res['otstup'] = $str;
		$res['parent'] = $parent;
		$res['pages'] = $pages;
		$res['item_id'] = $item_id;
		$res['source'] = $source;
		$res['call'] = $call;
		$res['val'] = $val;
		$tmpl -> setCurrentBlock('inter');
		$tmpl -> setVariable($res);
		$tmpl -> parseCurrentBlock('inter');
	  viewvetka($item[1], $stri, $level+1);
	}
  }
}


?>