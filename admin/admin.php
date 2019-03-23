<?php
require_once('./auth.php');

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}

$result = $db -> query("SELECT * FROM admin");
if($result -> numRows()) {
  while ($row = $result -> fetchRow()) {
	$tmpl-> touchBlock($row['perm']);
	$tmpl -> setCurrentBlock("list");
	$tmpl -> setVariable($row);
	$tmpl -> parseCurrentBlock("list");
//	$tmpl-> free();
  }
}

if (!isset($_POST['action']))  $_POST['action']=""; 
if (!isset($_POST['username']))  $_POST['username']=""; 
$username=$_POST['username'];
switch($_POST['action']) {
  case 'add':
  $dupe = $db -> getOne("SELECT username FROM admin WHERE username='$username'");
  if(!empty($dupe)) {
    session_start();
	session_register('dupe');
	header("Location: index.php?op=admin");
	exit;
  }
  if(empty($_POST['password'])) {
    session_start();
	session_register('nopass');
	header("Location: index.php?op=admin&username=$username&fio=".urlencode(stripslashes($_POST['fio'])));
	exit;
  }
  if($_POST['password'] != $_POST['password1']) {
    session_start();
	session_register('mismatch');
	header("Location: index.php?op=admin&username=$username&fio=".urlencode(stripslashes($_POST['fio'])));
	exit;
  }
  $_POST['password'] = md5($_POST['password']);
  $_POST['id'] = $db->nextID('admin');
  $missing = array("op","password1","action","action2");
  $result = $form -> add("admin",$missing);   // FormProc into lib - $_POST $db  - Mysqli ADD .. table ' user'
  session_start();
  session_register('add');
  header("Location: index.php?op=admin");
  exit;
  break;

  case 'edit':
  if($_POST['password'] != $_POST['password1']) {
    session_start();
	session_register('mismatch');
	header("Location: index.php?op=admin&username=$username&fio=".urlencode(stripslashes($_POST['fio'])));
	exit;
  }
  if(empty($_POST['password'])) {
	unset($_POST['password']);
  } else {
	$_POST['password'] = md5($_POST['password']);
  }
  $missing = array("op","password1","action","id","action2");
  $where = array('id' => $_POST['id']);
  $result = $form -> update("admin",$missing,$where);
  session_start();
  session_register('update');
  header("Location: index.php?op=admin");
  exit;
  break;
}

if (!isset($_GET['action'])) $_GET['action']="";
if (!isset($_GET['id'])) $_GET['id']="";
$id=$_GET['id'];
switch($_GET['action']) {
  case 'del':
	$res = $db -> getOne("SELECT COUNT(*) FROM admin");
	if ($res != 1) {
	  $result = $db -> query("DELETE FROM admin WHERE id = '$id'");
	  session_start();
	  session_register('delete');
  	  header("Location: index.php?op=admin");
	  exit;
	} else {
	  session_start();
	  session_register('warning');
  	  header("Location: index.php?op=admin");
	  exit;
	}
	break;
  case 'edit':
	$res = $db -> getRow("SELECT id,username,fio,role,perm,email FROM admin WHERE id='$id'");
	$res['action'] = 'edit';
	$res[$res['perm']] = " selected";
	unset($res['perm']);
	$tmpl -> setVariable($res);
	break;
  default:
	$tmpl -> setVariable('action',"add");
}

if(!empty($_GET['username'])) {
  $tmpl -> setVariable('username',$_GET['username']);
  $tmpl -> setVariable('fio',htmlentities(stripslashes($_GET['fio'])));
}
?>
