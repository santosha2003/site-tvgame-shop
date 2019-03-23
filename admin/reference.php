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
	$db1=$_POST['db'];
	  $db -> query("UPDATE items SET $db1 = '$statu' WHERE id = '$id'");
	  echo "window.opener.location.reload();";
	  echo "window.close();";
	} else {
	  echo "window.opener.document.send.".$db1.".value='$statu';";
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
	$db2=$_POST['db'];
	$sou=$_POST['source'];
	header("Location: index.php?op=$table&db=$db2");
  } else {
	header("Location: reference.php?db=$db2&source=$sou");
  }
	exit;


	break;

  case "edit":
	if(!empty($_FILES['photo']['name'])) {
	  require("../lib/class.SDImageUploading.php");
	  $iu = new SDImageUploading();
	  $db4=$_POST['db'];
	  $id4=$_POST['id'];
	  $img_path = '../images/pict/';
	  $img_upload = $_FILES['photo'];
	  $img_name = md5($_FILES['photo']['tmp_name']);
	  $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
	  if (!$image_ext) $error .= "<li>".$iu->error;
	  $photo = $_POST['photo'] = $img_name.$image_ext;
	  chmod($img_path.$_POST['photo'],0644);
	  $old_photo = $db -> getOne("SELECT photo FROM $db4 WHERE id='$id4'");
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
	header("Location: index.php?op=$table&db=$db4");
  } else {
        $source=$_POST['source'];
	header("Location: reference.php?db=$db4&source=$source");
  }
	exit;
	break;
}

if (!isset($_GET['action']))  $_GET['action']="";
switch ($_GET['action']) {
  case "vis":
        $db1=$_GET['db'];
        $id1=$_GET['id'];
	$result = $db -> query("UPDATE $db1 SET status='Y' WHERE id='$id1'");
  if(empty($_GET['source'])) {
	session_register('visible');
	header("Location: index.php?op=$table&db=$db1");
  } else {
        $source=$_GET['source'];
	header("Location: reference.php?db=$db1&source=$source");
  }
	exit;
	break;
  case "inv":
        $db2=$_GET['db'];
        $id2=$_GET['id'];
	$result = $db -> query("UPDATE $db2 SET status='N' WHERE id='$id2'");
  if(empty($_GET['source'])) {
	session_register('invisible');
	header("Location: index.php?op=$table&db=$db2");
  } else {
        $source1=$_GET['source'];
	header("Location: reference.php?db=$db2&source=$source1");
  }
	exit;
	break;
  case "delete":
        $db3=$_GET['db'];
        $id3=$_GET['id'];
	$row = $db -> getRow("SELECT * FROM $db3 WHERE id='$id3'");
	if(!empty($row['photo'])) @unlink("../logo/".$row['photo']);
	if(!empty($row['price'])) @unlink("../price/".$row['price']);
	if(!empty($row['filename'])) @unlink("../".$db3."/".$row['filename']);
	if($db3 == 'items_ref') {
	  $db -> query("DELETE FROM items_value WHERE rid='$id3'");
	}
	if($db3 == 'svva') {
	  $db -> query("UPDATE items SET svva=REPLACE(svaa,'|".$id3."|','|') WHERE svva LIKE '%|".$id3."|%'");
	}
	if($db3 == 'statu') {
	  $shops = $db -> getCol("SELECT id FROM shops ORDER BY id");
	  if(!empty($shops)) {
		foreach($shops as $val) {
		  $db -> query("UPDATE items SET statu=REPLACE(statu,'|".$id3."-".$val."|','|') WHERE statu LIKE '%|".$id3."-".$val."|%'");
		}
	  }
	}
	if($db3 == 'vendor') {
	  $db -> query("UPDATE items SET vendor='' WHERE vendor='$id3'");
	}
	$result = $db -> query("DELETE FROM $db3 WHERE id='$id3'");
  if(empty($_GET['source'])) {
	session_register('delete');
	header("Location: index.php?op=$table&db=$db3");
  } else {
        $source=$_GET['source'];
	header("Location: reference.php?db=$db3&source=$source");
  }
	exit;
	break;

  default:
 if (!isset($page)) $page="";
 if (!isset($_GET['source']))  $_GET['source']=""; 
 if (!isset($val)) $val="";
  if(!empty($_GET['db'])) {
    $db4=$_GET['db'];
    $page .= $tmpl -> get();
	$shops = $db -> getAll("SELECT id as shop_id,color FROM shops ORDER BY id");
	$tmpl -> loadTemplatefile("ref_".$db4.".inc",true,true);
	$query = "FROM $db4 ";
	$result = $db -> query("SELECT * ".$query." ORDER BY id DESC");
	if($result->numRows()) {
	  while ($row = $result -> fetchRow()) {
		if($row['status'] == 'Y') {
		  $tmpl -> setCurrentBlock("vis");
		  $tmpl -> setVariable("ids",$row['id']);
		  $tmpl -> setVariable('db',$db4);
	if (!empty ($_GET['source'])) {
                  $src1 = $_GET['source'];
		  $tmpl -> setVariable('sources',$src1);
         }
		  $tmpl -> parseCurrentBlock("vis");
		} else {
	  	  $tmpl -> setCurrentBlock("inv");
		  $tmpl -> setVariable("ids",$row['id']);
		  $tmpl -> setVariable('db',$db4);
	if (!empty ($_GET['source'])) {
		  $tmpl -> setVariable('sources',$_GET['source']);
                }
		  $tmpl -> parseCurrentBlock("inv");
		}
if(!empty($_GET['source'])) {
	if(!empty($shops)) {
	  foreach($shops as $val) {
		$check = strpos($_GET['val'],"|$row[id]-$val[shop_id]|");
		if($check !== false) $val['checked'] = ' checked';
		else $val['checked'] = '';
		$val[id] = $row[id];
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
	//	$tmpl -> free();
	  }
	} else {
	  $tmpl->touchBlock('no_list');
	}
		$tmpl -> setCurrentBlock("__global__");
	$tmpl -> setVariable('action',"add");
	$tmpl -> setVariable('db',$_GET['db']);
	$tmpl -> setVariable('url',"http://");
		$tmpl -> parseCurrentBlock();

  }
  break;
}
if (!isset($_GET['action']))  $_GET['action']="";
switch ($_GET['action']) {
  case "edit":
    $db1=$_GET['db'];
    $id1=$_GET['id'];
	if(session_is_registered('post')) {
		if(!empty($post['description'])) $post['description'] = nl2br($post['description']);
		if(!empty($post['shorttext'])) $post['shorttext'] = nl2br($post['shorttext']);
		if(!empty($post['bodytext'])) $post['bodytext'] = nl2br($post['bodytext']);
		if(!empty($post['tech'])) $post['tech'] = nl2br($post['tech']);
		$tmpl -> setCurrentBlock("__global__");

		$tmpl -> setVariable($post);

		$tmpl -> parseCurrentBlock();

		session_unregister('post');
	} else {
	  $row = $db -> getRow("SELECT * FROM $db1 WHERE id = '$id1'");
//	$row[title] = htmlspecialchars($row[title],ENT_QUOTES, cp1251);
	  if(!empty($row['description'])) $row['description'] = str_replace("<br />","",$row['description']);
	  if(!empty($row['shorttext'])) $row['shorttext'] = str_replace("<br />","",$row['shorttext']);
	  if(!empty($row['bodytext'])) $row['bodytext'] = str_replace("<br />","",$row['bodytext']);
	  if(!empty($row['tech'])) $row['tech'] = str_replace("<br />","",$row['tech']);
	  if(!empty($row['date'])) unset($row['date']);
	  if(!empty($row['author'])) unset($row['author']);
	  $row['action'] = "edit";
	  unset($row['photo']);
		$tmpl -> setCurrentBlock("__global__");

	  $tmpl -> setVariable($row);

		$tmpl -> parseCurrentBlock();

	  break;
	}
  case "add":
	if(session_is_registered('post')) {
		$post['description'] = nl2br($post['description']);
		$tmpl -> setCurrentBlock("__global__");

		$tmpl -> setVariable($post);

		$tmpl -> parseCurrentBlock();

		session_unregister('post');
	}
}


//if(!empty($_GET['source'])) {
//  $tmpl->setVariable($_GET);
//  $page=$tmpl->get();
//  echo $page;
//}

if (!isset($_GET['item_id']))  $_GET['item_id']="";
if(!empty($_GET['source'])) {
 $item_id=$_GET['item_id'];
 $source=$_GET['source'];
 $db1=$_GET['db'];
	$tmpl -> setCurrentBlock("__global__");
  $tmpl->setVariable($_GET);

  $select = $db -> getAssoc("SELECT id,name FROM $db1");
  if(!empty($select)) {
	$select_id=$select_name="";
	foreach($select as $key => $val) {
	  $select_id .= "\"$key\", ";
	  $select_name .= "\"$val\", ";
	}
	$tmpl -> setVariable('select_id', substr($select_id,0,-2));
	$tmpl -> setVariable('select_name', substr($select_name,0,-2));
  }
  $tmpl -> setVariable('description',$db->getOne("SELECT description FROM description WHERE id='$item_id' AND source='$source'"));
	$tmpl -> parseCurrentBlock();

  $page=$tmpl->get();
  echo $page;
}


?>