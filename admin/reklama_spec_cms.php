<?
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}
if (!isset($_POST['action'])) $_POST['action']="";
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

$count = substr_count($part,"|")-1;
if($count == '-1') $count = '0';
//<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
//$dispruscod = '<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">' ;
echo "
<html>
<head>
<link rel=stylesheet type=text/css href=style.css> 
";
echo '<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">' ;
echo "
<script type=text/javascript language=javascript>
<!--
";

	if(empty($_POST['call'])) {
  	  $res = $db -> query("UPDATE spec SET $_POST[source]='$part' WHERE id='$_POST[spec_id]'");
	  echo "window.opener.location.reload();";
	  echo "window.close();";
	} else {
	  echo "window.opener.document.send.".$_POST['source'].".value='".$part."';";
	  echo "window.opener.document.send.".$_POST['source']."_count.value='".$count."';";
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

switch ($_GET['action']) {
  default:
	$tmpl -> loadTemplatefile("reklama_spec_cms.inc",true,true);
	if(empty($_GET['call'])) {
	  $stri = $db -> getOne("SELECT $_GET[source] FROM spec WHERE id='$_GET[spec_id]'");
	  $_GET['val'] = $stri;
	} else {
	  $stri = $_GET['val'];
	}
	viewvetka(1,$stri);
	$tmpl -> setVariable('call',$_GET['call']);
	$tmpl -> setVariable('val',$_GET['val']);
	$tmpl -> setVariable('source',$_GET['source']);
	$tmpl -> setVariable('spec_id',$_GET['spec_id']);
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
	  $check = strpos($stri,"|$res[id]|");
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