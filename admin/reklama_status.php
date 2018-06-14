<?
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}

switch ($_POST[action]) {
  case "step2":
	$part = "";
	if(!empty($_POST[ids])) {
	  foreach($_POST[ids] as $val) {
		$check = strpos($part,"|".$val."|");
		if($check !== false) continue;
		if(empty($part)) $part = "|$val|";
		else $part .= "$val|";
	  }
	}

echo "
<html>
<head><link rel=stylesheet type=text/css href=style.css>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
<script type=text/javascript language=javascript>
<!--
";

	if(empty($_POST[call])) {
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

switch ($_GET[action]) {
  default:
	$tmpl -> loadTemplatefile("reklama_status.inc",true,true);
	if(empty($_GET[call])) {
	  $stri = $db -> getOne("SELECT $_GET[source] FROM items WHERE id='$_GET[item_id]'");
	  $_GET[val] = $stri;
	} else {
	  $stri = $_GET[val];
	}

	$res = $db -> query("SELECT * FROM statu ORDER BY id");
	if($res -> numRows()) {
	  while($row = $res -> fetchRow()) {
		$tmpl -> setCurrentBlock("list");
		$tmpl -> setVariable($row);
		$tmpl -> parseCurrentBlock("list");
		$tmpl -> free();
	  }
	} else {
	  $tmpl -> touchBlock("no_list");
	}

	$tmpl -> setVariable('call',$_GET[call]);
	$tmpl -> setVariable('val',$_GET[val]);
	$tmpl -> setVariable('source',$_GET[source]);
	$tmpl -> setVariable('parent',$_GET[parent]);
	$tmpl -> setVariable('pages',$_GET[pages]);
	$tmpl -> setVariable('item_id',$_GET[item_id]);
}


$tmpl->parse();
$tmpl->show();

?>