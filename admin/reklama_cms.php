<?php
require_once("./auth.php");
/*  <form action  . method ='POST' ... action parent item_id pages source call [val] */

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}

if (!isset($_POST['action'])) $_POST['action']="";
if (!isset($_POST['source'])) $_POST['source']="";
if (!isset($_POST['item_id'])) $_POST['item_id']="";
if (!isset($_POST['ids'])) $_POST['ids']="";


switch ($_POST['action']) {
  case "step2":
	$part = "";
	if(!empty($_POST['ids'])) {
	  foreach($_POST['ids'] as $val) {
		$check = strpos($part,"|".$val."|");
		if($check !== false) continue;
		if(empty($part)) $part = "|$val|";
		else $part .= "$val|";
	  }
	}

echo "
<html>
<head><link rel=stylesheet type=text/css href=style.css>
";
echo '<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">' ;
echo "
<script type=text/javascript language=javascript>
<!--
";

	if(empty($_POST['call'])) {
  	  $res = $db -> query("UPDATE items SET $_POST[source]='$part' WHERE id='$_POST[item_id]'");
	  echo "window.opener.location.reload();";
	  echo "window.close();";
	} else {
	  echo "window.opener.document.send.".$_POST[source].".value='".$part."';";
	  echo "window.close();";
	
	}
echo "
-->
</script>
</head>
<body></body>
</html>
";

	exit;
	break;
}
if (!isset($_GET['action'])) $_GET['action']="";
if (!isset($_GET['source'])) $_GET['source']="";
if (!isset($_GET['item_id'])) $_GET['item_id']="";
if (!isset($_GET['call'])) $_GET['call']="";
if (!isset($_GET['val'])) $_GET['val']="";
if (!isset($_GET['parent'])) $_GET['parent']="";
if (!isset($_GET['pages'])) $_GET['pages']="";
$item_id=$_GET['item_id'];
$source=$_GET['source'];
$pages=$_GET['pages'];

switch ($_GET['action']) {
  default:
	$tmpl -> loadTemplatefile("reklama_cms.inc",true,true);
	if(empty($_GET['call'])) {
	  $stri = $db -> getOne("SELECT $_GET[source] FROM items WHERE id='$item_id'");
	  $_GET['val'] = $stri;
	} else {
	  $stri = $_GET['val'];
	}
	viewvetka(1,$stri);
	$r=[];
	$r['call']=$_GET['call'];
	$r['val']=$_GET['val'];
	$r['source']=$_GET['source'];
	$r['pages']=$_GET['pages'];
	$r['parent']=$_GET['parent'];
	$r['item_id']=$_GET['item_id'];
	$tmpl -> setVariable('call',$_GET['call']);
	$tmpl -> setVariable('val',$_GET['val']);
	$tmpl -> setVariable('source',$_GET['source']);
	$tmpl -> setVariable('parent',$_GET['parent']);
	$tmpl -> setVariable('pages',$_GET['pages']);
	$tmpl -> setVariable('item_id',$_GET['item_id']);
		$tmpl -> setCurrentBlock('reklama');
		$tmpl -> setVariable($r);  //php7.2 
		$tmpl -> parseCurrentBlock('reklama');	
}


$tmpl->parse();
$tmpl->show();




function viewvetka($id,$stri,$level=0) {

  GLOBAL $db, $opsa, $tmpl, $mesto, $parent, $_GET;
  $result = $db -> query("SELECT * FROM content WHERE pid='$id' ORDER BY updown");
  while($row = $result -> fetchRow()) {
	$list[] = array($row['pid'],$row['id'],$row['title']);
  }
  $i=0; $str = "";
  if (!empty($list)) {
	for($i=0; $i<$level; $i++) {
	  $str .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	foreach($list as $item) {
	  $i++;
	  $res = $db -> getRow("SELECT id,title FROM content WHERE id = '$item[1]'");

	  $res['total_filter'] = "";
	  $id1=$res['id'];
	  $check = strpos($stri,"|$id1|");
	  if($check !== false) $res['total_filter'] = "checked";
	  
	  $res['otstup'] = $str;
		$tmpl -> setCurrentBlock('inter');
		$tmpl -> setVariable($res);
		$tmpl -> parseCurrentBlock('inter');
	  viewvetka($item[1], $stri, $level+1);
	}
  }
}

?>