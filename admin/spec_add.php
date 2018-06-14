<?php
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}
if (!isset ($_POST['action']))  $_POST['action']="";
switch ($_POST['action']) {

  case "add_item":
	$_POST['id'] = $db -> nextID("spec");
	$_POST['status'] = "Y";
	list ($day,$month,$year) = explode(".",$_POST['start_date']);
	$_POST['start_date'] = date("Y-m-d", mktime (0,0,0,$month,$day,$year));
	list ($day,$month,$year) = explode(".",$_POST['end_date']);
	$_POST['end_date'] = date("Y-m-d", mktime (0,0,0,$month,$day,$year));
	$ref = array(
	  shops // принадлежность к магазинам
	);

	foreach($ref as $r) {
	  if(!empty($_POST[$r])) {
		$ar = "|";
		foreach($_POST[$r] as $val)
		  $ar .= "$val|";
		$_POST[$r] = $ar;
	  } else {
		$_POST[$r] = "";
	  }
	}

	$missing = array("action","submit","op","article_count","items_count");
	$result = $form -> add("spec",$missing,$insert);
	header("Location: index.php?op=spec");
	exit;
	break;

  case "item_edit":
	list ($day,$month,$year) = explode(".",$_POST['start_date']);
	$_POST['start_date'] = date("Y-m-d", mktime (0,0,0,$month,$day,$year));
	list ($day,$month,$year) = explode(".",$_POST['end_date']);
	$_POST['end_date'] = date("Y-m-d", mktime (0,0,0,$month,$day,$year));
	$ref = array(
	  shops // принадлежность к магазинам
	);

	foreach($ref as $r) {
	  if(!empty($_POST[$r])) {
		$ar = "|";
		foreach($_POST[$r] as $val)
		  $ar .= "$val|";
		$_POST[$r] = $ar;
	  } else {
		$_POST[$r] = "";
	  }
	}

	$missing = array("action","submit","op","article_count","items_count");
	$where = array("id" => $_POST['id']);
	$result = $form -> update("spec",$missing,$where);
	header("Location: index.php?op=spec");
	exit;
	break;
}

if (!isset ($_GET['action']))  $_GET['action']="";
switch ($_GET['action']) {
  case "spec_edit":
	$rows = $db -> getRow("
	  SELECT 
		*, 
		date_format(start_date,'%d.%m.%Y') as start_date,
		date_format(  end_date,'%d.%m.%Y') as   end_date
	  FROM 
		spec 
	  WHERE 
		id = '$_GET[id]'
	");
//	$rows[name] = htmlspecialchars($rows[name], ENT_QUOTES);
//	$rows[title] = htmlspecialchars($rows[title], ENT_QUOTES);
//	$rows[description] = htmlspecialchars($rows[description], ENT_XML1, cp1251);
	if(!empty($rows['items'])) {
	  $rows['items_count'] = substr_count($rows['items'],"|")-1;
	} else $rows['items_count'] = 0;

	if(!empty($rows['article'])) {
	  $rows['article_count'] = substr_count($rows['article'],"|")-1;
	} else $rows['article_count'] = 0;

	$ref = array(
	  shops => color // принадлежность к магазинам
	);

	foreach($ref as $r => $b) {
	  $ra = $db -> getAll("SELECT id as ".$r."_id,name,$b FROM $r");
	  if(!empty($ra)) {
		foreach($ra as $val) {
		  $check = strpos($rows[$r],"|".$val[$r."_id"]."|");
		  if($check !== false) $val['checked'] = ' checked';
		  $tmpl -> setCurrentBlock($r);
		  $tmpl -> setVariable($val);
		  $tmpl -> parseCurrentBlock($r);
		}
	  }
	}


	$tmpl -> setVariable($rows);
	$tmpl -> setVariable('name', htmlspecialchars($rows['name']));
	$tmpl -> setVariable('title', $rows['name']);
	$tmpl -> setVariable('action',"item_edit");
	$tmpl -> touchBlock("item_edit");
	$tmpl -> touchBlock("head_edit");
	break;

  default:
	$ref = array(
	  'shops' => 'color' // принадлежность к магазинам
	);

	foreach($ref as $r => $b) {
	  $ra = $db -> getAll("SELECT id as ".$r."_id,$b,name,'checked' as checked FROM $r");
	  if(!empty($ra)) {
		foreach($ra as $val) {
		  $tmpl -> setCurrentBlock($r);
		  $tmpl -> setVariable($val);
		  $tmpl -> parseCurrentBlock($r);
		}
	  }
	}
	$tmpl -> setVariable('action',"add_item");
	$tmpl -> setVariable('items_count',"0");
	$tmpl -> setVariable('article_count',"0");
	$tmpl -> touchBlock('no_small_photo');
	$tmpl -> touchBlock('no_big_photo');
	$tmpl -> touchBlock('head_add');
	break;
}
if (!isset ($pages))  $pages="";
$tmpl -> setVariable('pages',$pages);

?>
