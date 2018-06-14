<?
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}

//print_r($_POST);
//print_r($_SESSION);
if (!isset($_GET['action']))  $_GET['action']="";
switch ($_GET['action']) {
  case "add":
	$tmpl -> loadTemplatefile("spec_add.inc",true,true);
	include("spec_add.php");
	break;

  case "spec_edit":
	$tmpl -> loadTemplatefile("spec_add.inc",true,true);
	include("spec_add.php");
  break;

  case "spec_vis":
	  $result = $db -> query("UPDATE spec SET status='Y' WHERE id='$_GET[id]'");
	  session_register('visible');
	  header("Location: index.php?op=spec&parent=$_GET[parent]&pages=$_GET[pages]");
	break;

  case "spec_inv":
	  $result = $db -> query("UPDATE spec SET status='N' WHERE id='$_GET[id]'");
	  header("Location: index.php?op=spec&parent=$_GET[parent]&pages=$_GET[pages]");
	break;

  case "spec_delete":
	  $result = $db -> query("DELETE FROM spec WHERE id='$_GET[id]'");
	  session_register('delete');
	  header("Location: index.php?op=spec&parent=$_GET[parent]&pages=$_GET[pages]");
	break;
}
if (!isset($_POST['action']))  $_POST['action']="";
switch ($_POST['action']) {

  case "spec_alldell":
	if(is_array($_POST['spec_del'])) {
	  foreach($_POST['spec_del'] as $val) {
		$result = $db -> query("DELETE FROM spec WHERE id='$val'");
	  }
	}
	header("Location: index.php?op=spec&parent=$_POST[parent]&pages=$_POST[pages]");
	break;

  case "spec_allvis":
	if(is_array($_POST['spec_del'])) {
	  foreach($_POST['spec_del'] as $val) {
		$db -> query("UPDATE spec SET status='Y' WHERE id='$val'");
	  }
	}
	header("Location: index.php?op=spec&parent=$_POST[parent]&pages=$_POST[pages]");
	break;

  case "spec_allinv":
	if(is_array($_POST['spec_del'])) {
	  foreach($_POST['spec_del'] as $val) {
		$db -> query("UPDATE spec SET status='N' WHERE id='$val'");
	  }
	}
	header("Location: index.php?op=spec&parent=$_POST[parent]&pages=$_POST[pages]");
	break;
}

if($_GET['action'] != 'add' AND $_GET['action'] != 'spec_edit') {

if(empty($pages)) $pages = 1;

  include("./nav_bar.php");
  $result = $db -> query("
	SELECT 
	  *,
	  date_format(start_date,'%d.%m.%Y') as start_date,
	  date_format(  end_date,'%d.%m.%Y') as   end_date
	FROM 
	  spec
  ");
  if ($result -> numRows() != 0) {
	while ($row = $result -> fetchRow()) {
	if($row[status] == "Y") {
	  $tmpl -> setCurrentBlock("spec_visible");
	  $tmpl -> setVariable($row);
	  $tmpl -> parseCurrentBlock("spec_visible");
	} else {
	  $tmpl -> setCurrentBlock("spec_invisible");
	  $tmpl -> setVariable($row);
	  $tmpl -> parseCurrentBlock("spec_invisible");
	}

	if($row[start_date] == "01.01.1970") $row[start_date] = "";
	if($row[end_date] == "01.01.1970") $row[end_date] = "";

	if(!empty($row[items])) {
	  $row[items_count] = substr_count($row[items],"|")-1;
	} else $row[items_count] = 0;

	if(!empty($row[article])) {
	  $row[article_count] = substr_count($row[article],"|")-1;
	} else $row[article_count] = 0;

	$tmpl -> setCurrentBlock("tovar");
	$tmpl -> setVariable($row);
	$tmpl -> parseCurrentBlock("tovar");
	$tmpl -> free();
	}
    $tmpl -> touchBlock("group");	
  } else {
	  $tmpl -> setCurrentBlock("no_tovar");
	  $tmpl -> setVariable('nbsp',"&nbsp;");
	  $tmpl -> parseCurrentBlock("no_tovar");
  }
}

?>