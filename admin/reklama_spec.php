<?
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}
if (!isset($_POST['action'])) $_POST['action']="";
switch ($_POST['action']) {
  case "step3":
	$part = $_POST['val'];
	$items  = $db -> getCol("SELECT id FROM items WHERE cid='$_POST[cid]'");
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
  	  $res = $db -> query("UPDATE spec SET $_POST[source]='$part' WHERE id='$_POST[spec_id]'");
	}
	$_POST[val] = $part;
	header("Location: reklama_spec.php?spec_id=$_POST[spec_id]&source=$_POST[source]&call=$_POST[call]&val=$_POST[val]");
	exit;
	break;
}
if (!isset($_GET['action'])) $_GET['action']="";
switch ($_GET['action']) {

  case "step2":
	$tmpl -> loadTemplatefile("reklama2_spec.inc",true,true);
	if(empty($_GET['call'])) {
	  $part = $db ->getOne("SELECT $_GET[source] FROM spec WHERE id='$_GET[spec_id]'");
	} else {
	  $part = $_GET['val'];
	}
	$result = $db -> query("SELECT * FROM items WHERE cid='$_GET[cid]' AND status='Y' ORDER BY updown");
	if ($result -> numRows()) {
	  while ($row = $result -> fetchRow()) {
		$check = strpos($part,"|".$row['id']."|");
		if($check !== false) $row[checked] = ' checked';
		else $row[checked] = "";
		$tmpl -> setCurrentBlock("tovar");
		$tmpl -> setVariable($row);
		$tmpl -> parseCurrentBlock("tovar");
	  }
	} else {
	  $tmpl -> touchBlock("no_tovar");
	}
	$tmpl -> setVariable($row);
	$tmpl -> setVariable('spec_id',$_GET['spec_id']);
	$tmpl -> setVariable('source',$_GET['source']);
	$tmpl -> setVariable('call',$_GET['call']);
	$tmpl -> setVariable('val',$_GET['val']);
	break;


  default:
	$tmpl -> loadTemplatefile("reklama1_spec.inc",true,true);
	if(empty($_GET['call'])) {
	  $stri = $db -> getOne("SELECT $_GET[source] FROM spec WHERE id='$_GET[spec_id]'");
	  $_GET[val] = $stri;
	} else {
	  $stri = $_GET['val'];
	}
	viewvetka(2,$stri);
$count = substr_count($stri,"|")-1;
if($count == '-1') $count = '0';

	$tmpl -> setVariable('call',$_GET['call']);
	$tmpl -> setVariable('items_count',$count);
	$tmpl -> setVariable('val',$_GET['val']);
	$tmpl -> setVariable('source',$_GET['source']);
}


$tmpl->parse();
$tmpl->show();




function viewvetka($id,$stri,$level=0) {
  GLOBAL $db, $opsa, $tmpl, $mesto, $parent, $_GET;
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
	  if($parent == $res[id]) {
		$res['clas'] = "<font color=red><b>";
		$res['endclas'] = "</b></font>";
	  } else {
		$res['clas'] = "";
		$res['endclas'] = "";
	  }
	  
	  $res['total'] = $db -> getOne("SELECT COUNT(*) FROM items WHERE cid = '$item[1]'");
	  $res['total_filter'] = 0;
//$tt = $db -> getOne("SELECT $_GET[source] FROM items WHERE id='$_GET[item_id]'");
	  $tt = $db -> getCol("SELECT id FROM items WHERE cid = '$item[1]' AND id!='$_GET[item_id]'");
	  if(!empty($tt)) {
		foreach($tt as $vv) {
		  $check = strpos($stri,"|$vv|");
		  if($check !== false) $res['total_filter']++;
		}	  
	  }
		$res['otstup'] = $str;
		$res['spec_id'] = $_GET['spec_id'];
		$res['source'] = $_GET['source'];
		$res['call'] = $_GET['call'];
		$res['val'] = $_GET['val'];
		$tmpl -> setCurrentBlock('inter');
		$tmpl -> setVariable($res);
		$tmpl -> parseCurrentBlock('inter');
	  viewvetka($item[1], $stri, $level+1);
	}
  }
}


?>