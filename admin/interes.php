<?php
//change v4 $HTTP_* to v5.6-v7 $_SESSION $_POST

// Backward compatible array creation. After this point, the
// PHP 4.1.0+ arrays can be used to access variables coming
// from outside PHP. But it should be noted that these variables
// are not necessarily superglobals, so they need to be global-ed!
//if (!isset($_SERVER))
//{
//    $_GET     = &$HTTP_GET_VARS;
//    $_POST    = &$HTTP_POST_VARS;
//    $_ENV     = &$HTTP_ENV_VARS;
//    $_SERVER  = &$HTTP_SERVER_VARS;
//    $_COOKIE  = &$HTTP_COOKIE_VARS;
//    $_REQUEST = array_merge($_GET, $_POST, $_COOKIE);
//}

//$PHP_SELF = $_SERVER['PHP_SELF'];
//
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}
//quotes v5.6
$tmpl -> loadTemplatefile('interes.inc',true,true);


echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";

 if (!isset($_POST['action']))  $_POST['action']="";
 if (isset($_GET['id'])) $tovid = $_GET['id'];

switch ($_POST['action']) {

  case "allmove":
 $id = $_POST['id'];
 $parent = $_POST['parent'];
 $pages = $_POST['pages'];
 $ops= $_POST['ops'];

	if (!empty($ops)) {
	  foreach ($id as $val) {
		$result = $db -> query("UPDATE items SET cid=$ops WHERE id='$val'");
	  }
	}
	echo "<HTML><HEAD><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"><SCRIPT>window.opener.location.replace('index.php?op=item&parent=$parent&pages=$pages'); self.close();</SCRIPT></HEAD><BODY></BODY></HTML>";
//	echo "<HTML><HEAD><SCRIPT>window.opener.location.reload(); self.close();</SCRIPT></HEAD><BODY></BODY></HTML>";
	break;
  case "move":
 $id = $_POST['id'];
 $parent = $_POST['parent'];
 $pages = $_POST['pages'];
 $ops= $_POST['ops'];
	if (!empty($ops)) {
	  $result = $db -> query("UPDATE items SET cid=$ops WHERE id='$id'");
	}
	echo "<HTML><HEAD><SCRIPT>window.opener.location.reload(); self.close();</SCRIPT></HEAD><BODY></BODY></HTML>";
	break;
  case "cmove":
 $id = $_POST['id'];
 $parent = $_POST['parent'];
 $pages = $_POST['pages'];
 $ops= $_POST['ops'];
	if (!empty($ops)) {
	  if($ops != '2') {
		$parent = $db -> getOne("SELECT id FROM category WHERE id='$ops'");
	  } else $parent=2;
	  $result = $db -> query("UPDATE category SET parent=$parent WHERE id='$id'");
	}
	echo "<HTML><HEAD><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"><meta http-equiv=\"Content-Language\" content=\"ru\"<SCRIPT>window.opener.location.reload(); self.close();</SCRIPT></HEAD><BODY></BODY></HTML>";
	$_GET['action'] = "cmove";
	$_GET['id'] = $id; //$_POST['id']
	break;
}

//$opsas = $db -> getCol("SELECT cid FROM interes WHERE tid='$tovid'");

if (!isset($_GET['action']))  $_GET['action']="";
switch ($_GET['action']) {
  case "allmove":
 $id = $_GET['id'];
 $parent=$_GET['parent'];
	$tmpl -> touchBlock('main_allmove');
	foreach ($id as $val) {
	  $tmpl -> setCurrentBlock('group');
	  $tmpl -> setVariable('id',$val);
	  $tmpl -> parseCurrentBlock('group');
	}
	break;
  case "move":
  if (isset($_GET['id']))  $tovid=$_GET['id'];
// $id = $_GET['id'];  $tovid ..  items(id)
	$result = $db->getRow("SELECT id,name FROM items WHERE id='$tovid'");
	break;
  case "cmove":
  $id = $_GET['id'];
	$result = $db->getRow("SELECT id,name FROM category WHERE id='$id'");
	$tmpl -> setCurrentBlock('main_category');
	$tmpl -> setVariable($result);
	$tmpl -> parseCurrentBlock('main_category');
	break;
  default:
if (isset($_GET['id']))  $id=$_GET['id'];
if (isset($_GET['parent']))  $parent=$_GET['parent'];  //parent category
	$result = $db->getRow("SELECT id,name FROM items WHERE id='$tovid'");
	$tmpl -> setCurrentBlock('main_interes');
	$tmpl -> setVariable($result);
	$tmpl -> parseCurrentBlock('main_interes');
	$_GET['action'] = "interes";
}

if (isset($_GET['id']))  $id=$_GET['id'];
if (isset($_GET['parent']))  { $parent=$_GET['parent']; } else $parent=2;  //parent category

if ($_GET['action'] != "cmove") {

  $_GET['id'] = $db -> getOne("SELECT cid FROM items WHERE id='$id'");
} else {
  $cid = $_GET['id'];
}
viewvetka($parent);


$tmpl -> setVariable('action',$_GET['action']);
if (!isset ($id)) $id="";
$tmpl -> setVariable('id',$id);
if (!isset($parent))  $parent=2; //=""; //parent category
$tmpl -> setVariable('parent',$parent);
$tmpl -> setVariable('pages',$pages);

$tmpl->parse();
$tmpl->show();

function viewvetka($id,$level=0) {
  GLOBAL $db, $opsa, $tmpl, $_GET, $opsas, $cid;
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
	$id_item=$item[1];
	  if ($item[0] == $cid) continue;
	  $i++;
	  $res = $db -> getRow("SELECT id,name FROM category WHERE id = '$id_item'");
	  $res['otstup'] = $str;
	  if($_GET['id'] == $item[1]) {
		$tmpl -> setCurrentBlock('inter_empty');
		$tmpl -> setVariable('otstup',$res['otstup']);
		$tmpl -> setVariable('name',$res['name']);
		$tmpl -> parseCurrentBlock('inter_empty');
		$tmpl->free();
	  } else {
		if($_GET['action'] == 'interes') {
			if(is_array($opsas)) {        //error in-array</a>]: Wrong datatype for second argument
		   if(in_array($res['id'],$opsas)) $res['checked'] = " checked";
		   else $res['checked'] = "";
		  } 
		  else $res['checked'] = "";
		  $tmpl -> setCurrentBlock('inter_noempty_interes');
		  $tmpl -> setVariable($res);
		  $tmpl -> parseCurrentBlock('inter_noempty_interes');
		  $tmpl->free();
		} else {
		  $tmpl -> setCurrentBlock('inter_noempty');
		  $tmpl -> setVariable($res);
		  $tmpl -> parseCurrentBlock('inter_noempty');
		  $tmpl->free();
		}
	  }
	  $tmpl -> setCurrentBlock('inter');
	  $tmpl -> parseCurrentBlock('inter');
	  $tmpl->free();
	  viewvetka($item[1], $level+1);
	}
  }
}


?>