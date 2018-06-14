<?php
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}

if(empty($_GET['db'])) $_GET['db'] = "statu";
$table="reference";
$tmpl -> loadTemplatefile($table.".inc",true,false);

if (!isset($_POST['action']))  $_POST['action']="";
switch ($_POST['action']) {
  case "mass_add":

	if(!empty($_POST['shops'])) {
 $id=$_POST['item_id'];
 $source=$_POST['source'];
 $descr=$_POST['description'];
 $postdb=$_POST['db'];
	  $db -> query("DELETE FROM description WHERE id='$id' AND source='$source'");
	  $statu = "|";
	  foreach($_POST['shops'] as $key => $val) {
		foreach($val as $ss => $sss) {
		  $statu .= "$key-$ss|";
		  $db -> query("INSERT INTO description (id,shop,source,description) VALUES ('$id','$ss','$src','$descr')");
		}
	  }
	} else {
	  $statu = "";
	}

echo "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"><meta http-equiv=\"Content-Language\" content=\"ru\">
<link rel=stylesheet type=text/css href=style.css>
<script type=text/javascript language=javascript>
<!--
";

	if(empty($_POST['call'])) {
	$postdb=$statu;
	$_POST['db']=$postdb;
	  $db -> query("UPDATE items SET $_POST[db] = '$statu' WHERE id = '$id'");
	  echo "window.opener.location.reload();";
	  echo "window.close();";
	} else {
	  echo "window.opener.document.send.".$_POST['db'].".value='$statu';";
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

  case "add":
// загрузка изображений
	if(!empty($_FILES['photo']['name'])) {
	  require("../lib/class.SDImageUploading.php");
	  $iu = new SDImageUploading();
	  $img_path = '../images/pict/';
	  $img_upload = $_FILES['photo'];
	  $img_name = md5($_FILES['photo']['tmp_name']);
	  $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
	  if (!$image_ext) $error .= "<li>".$iu->error;
	  $_POST['photo'] = $img_name.$image_ext;
	  chmod($img_path.$_POST['photo'],0644);
	}

	$_POST['id'] = $db -> nextID($_POST['db']);
	if(!empty($_POST['description'])) $_POST['description'] = nl2br($_POST['description']);
	$missing = array("op","action","db","submit","db","item_id","source","call","val");
	$result = $form -> add($_POST['db'],$missing);

  if(empty($_POST['source'])) {
	session_register('add');
	header("Location: index.php?op=$table&db=$_POST[db]");
  } else {
	header("Location: reference.php?db=$_POST[db]&source=$_POST[source]");
  }
	exit;


	break;

  case "edit":
	if(!empty($_FILES['photo']['name'])) {
	  require("../lib/class.SDImageUploading.php");
	  $iu = new SDImageUploading();
	  $img_path = '../images/pict/';
	  $img_upload = $_FILES['photo'];
	  $img_name = md5($_FILES['photo']['tmp_name']);
	  $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
	  if (!$image_ext) $error .= "<li>".$iu->error;
	  $photo = $_POST['photo'] = $img_name.$image_ext;
	  chmod($img_path.$_POST['photo'],0644);
	  $old_photo = $db -> getOne("SELECT photo FROM $_POST[db] WHERE id='$_POST[id]'");
	  if(!empty($old_photo)) {
		@unlink("../images/pict/".$old_photo);
	  }
	} else {
	  unset($_POST['photo']);
	}

	if(!empty($_POST['description'])) $_POST['description'] = nl2br($_POST['description']);
	$missing = array("action","db","id","submit","db","source");
	$where = array("id" => $_POST['id']);
	$result = $form->update($_POST['db'],$missing,$where);
  if(empty($_POST['source'])) {
	session_register('update');
	header("Location: index.php?op=$table&db=$_POST[db]");
  } else {
	header("Location: reference.php?db=$_POST[db]&source=$_POST[source]");
  }
	exit;
	break;
}

if (!isset($_GET['action']))  $_GET['action']="";
switch ($_GET['action']) {
  case "vis":
	$result = $db -> query("UPDATE $_GET[db] SET status='Y' WHERE id='$_GET[id]'");
  if(empty($_GET['source'])) {
	session_register('visible');
	header("Location: index.php?op=$table&db=$_GET[db]");
  } else {
	header("Location: reference.php?db=$_GET[db]&source=$_GET[source]");
  }
	exit;
	break;
  case "inv":
	$result = $db -> query("UPDATE $_GET[db] SET status='N' WHERE id='$_GET[id]'");
  if(empty($_GET['source'])) {
	session_register('invisible');
	header("Location: index.php?op=$table&db=$_GET[db]");
  } else {
	header("Location: reference.php?db=$_GET[db]&source=$_GET[source]");
  }
	exit;
	break;
  case "delete":
	$row = $db -> getRow("SELECT * FROM $_GET[db] WHERE id='$_GET[id]'");
	if(!empty($row['photo'])) @unlink("../logo/".$row['photo']);
	if(!empty($row['price'])) @unlink("../price/".$row['price']);
	if(!empty($row['filename'])) @unlink("../".$_GET['db']."/".$row['filename']);
	if($_GET['db'] == 'items_ref') {
	  $db -> query("DELETE FROM items_value WHERE rid='$_GET[id]'");
	}
	if($_GET['db'] == 'svva') {
	  $db -> query("UPDATE items SET svva=REPLACE(svaa,'|".$_GET['id']."|','|') WHERE svva LIKE '%|".$_GET['id']."|%'");
	}
	if($_GET['db'] == 'statu') {
	  $shops = $db -> getCol("SELECT id FROM shops ORDER BY id");
	  if(!empty($shops)) {
		foreach($shops as $val) {
		  $db -> query("UPDATE items SET statu=REPLACE(statu,'|".$_GET['id']."-".$val."|','|') WHERE statu LIKE '%|".$_GET['id']."-".$val."|%'");
		}
	  }
	}
	if($_GET['db'] == 'vendor') {
	  $db -> query("UPDATE items SET vendor='' WHERE vendor='$_GET[id]'");
	}
	$result = $db -> query("DELETE FROM $_GET[db] WHERE id='$_GET[id]'");
  if(empty($_GET['source'])) {
	session_register('delete');
	header("Location: index.php?op=$table&db=$_GET[db]");
  } else {
	header("Location: reference.php?db=$_GET[db]&source=$_GET[source]");
  }
	exit;
	break;

  default:
 if (!isset($page)) $page="";
  
  if(!empty($_GET['db'])) {
    $page .= $tmpl -> get();
	$shops = $db -> getAll("SELECT id as shop_id,color FROM shops ORDER BY id");
	$tmpl -> loadTemplatefile("ref_".$_GET['db'].".inc",true,true);
	$query = "FROM $_GET[db] ";
	$result = $db -> query("SELECT * ".$query." ORDER BY id DESC");
	if($result->numRows()) {
	  while ($row = $result -> fetchRow()) {
		if($row['status'] == 'Y') {
		  $tmpl -> setCurrentBlock("vis");
		  $tmpl -> setVariable("ids",$row['id']);
		  $tmpl -> setVariable('db',$_GET['db']);
		  $tmpl -> setVariable('sources',$_GET['source']);
		  $tmpl -> parseCurrentBlock("vis");
		} else {
	  	  $tmpl -> setCurrentBlock("inv");
		  $tmpl -> setVariable("ids",$row['id']);
		  $tmpl -> setVariable('db',$_GET['db']);
		 if (!isset($_GET['source']))  $_GET['source']=""; 
		  $tmpl -> setVariable('sources',$_GET['source']);
		  $tmpl -> parseCurrentBlock("inv");
		}
 if (!isset($val)) $val="";
if(!empty($_GET['source'])) {
	if(!empty($shops)) {
	  foreach($shops as $val) {
		$check = strpos($_GET['val'],"|$row[id]-$val[shop_id]|");
		if($check !== false) $val['checked'] = ' checked';
		else $val['checked'] = '';
		$val['id'] = $row['id'];
		$tmpl -> setCurrentBlock('shop');
		$tmpl -> setVariable($val);
		$tmpl -> parseCurrentBlock('shop');
	  }
	}
}
  if (!isset($_GET['db']))  $_GET['db']="";
		$row['db'] = $_GET['db'];
		$row['source'] = $_GET['source'];
		$tmpl -> setCurrentBlock("list");
		$tmpl -> setVariable($row);
		$tmpl -> parseCurrentBlock("list");
		$tmpl -> free();
	  }
	} else {
	  $tmpl->touchBlock('no_list');
	}
	$tmpl -> setVariable('action',"add");
	$tmpl -> setVariable('db',$_GET['db']);
	$tmpl -> setVariable('url',"http://");
  }
  break;
}
if (!isset($_GET['action']))  $_GET['action']="";
switch ($_GET['action']) {
  case "edit":
	if(session_is_registered('post')) {
		if(!empty($post['description'])) $post['description'] = nl2br($post['description']);
		if(!empty($post['shorttext'])) $post['shorttext'] = nl2br($post['shorttext']);
		if(!empty($post['bodytext'])) $post['bodytext'] = nl2br($post['bodytext']);
		if(!empty($post['tech'])) $post['tech'] = nl2br($post['tech']);
		$tmpl -> setVariable($post);
		session_unregister('post');
	} else {
	  $row = $db -> getRow("SELECT * FROM $_GET[db] WHERE id = '$_GET[id]'");
//	$row[title] = htmlspecialchars($row[title],ENT_QUOTES, cp1251);
	  if(!empty($row['description'])) $row['description'] = str_replace("<br />","",$row['description']);
	  if(!empty($row['shorttext'])) $row['shorttext'] = str_replace("<br />","",$row['shorttext']);
	  if(!empty($row['bodytext'])) $row['bodytext'] = str_replace("<br />","",$row['bodytext']);
	  if(!empty($row['tech'])) $row['tech'] = str_replace("<br />","",$row['tech']);
	  if(!empty($row['date'])) unset($row['date']);
	  if(!empty($row['author'])) unset($row['author']);
	  $row['action'] = "edit";
	  unset($row['photo']);
	  $tmpl -> setVariable($row);
	  break;
	}
  case "add":
	if(session_is_registered('post')) {
		$post['description'] = nl2br($post['description']);
		$tmpl -> setVariable($post);
		session_unregister('post');
	}
}


//if(!empty($_GET['source'])) {
//  $tmpl->setVariable($_GET);
//  $page=$tmpl->get();
//  echo $page;
//}

if (!isset($_GET[item_id]))  $_GET[item_id]="";
if(!empty($_GET['source'])) {
  $tmpl->setVariable($_GET);
  $select = $db -> getAssoc("SELECT id,name FROM $_GET[db]");
  if(!empty($select)) {
	$select_id=$select_name="";
	foreach($select as $key => $val) {
	  $select_id .= "\"$key\", ";
	  $select_name .= "\"$val\", ";
	}
	$tmpl -> setVariable('select_id', substr($select_id,0,-2));
	$tmpl -> setVariable('select_name', substr($select_name,0,-2));
  }
  $tmpl -> setVariable('description',$db->getOne("SELECT description FROM description WHERE id='$_GET[item_id]' AND source='$_GET[source]'"));
  $page=$tmpl->get();
  echo $page;
}


?>