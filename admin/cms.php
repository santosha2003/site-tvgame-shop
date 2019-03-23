<?php
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}

$table = "sess_cms";

if(isset($_GET['parent'])) $parent = $_GET['parent'];
elseif (isset($_SESSION[$table]['parent'])) $parent = $_SESSION[$table]['parent'];
else $parent = 1;

$$table = array(
  'parent' => $parent
);
session_register($table);
if (!isset($_POST['action'])) $_POST['action']="";
switch ($_POST['action']) {

  case "add":
        if(empty($_POST['url'])) {
          session_start();
          session_register('url');
          header("Location: index.php?op=cms");
          exit;
        }
        $dupe = $db->getOne("SELECT id FROM content WHERE url='$_POST[url]'");
        if(!empty($dupe)) {
          session_start();
          session_register('dupe');
          header("Location: index.php?op=cms");
          exit;
        }
        $_POST['id'] = $db -> nextID("content");
        $_POST['pid'] = $parent;
        $_POST['updown'] = $db -> getOne("SELECT MAX(updown) FROM content WHERE pid='$parent'") + 10;
        $missing = array("op","submit","action");
        $res = $form -> add("content",$missing);
          header("Location: index.php?op=cms");
        exit;
        break;
  case "updateall":
        if(empty($_POST['url'])) {
          session_start();
          session_register('url');
          $post = $_POST;
          session_register('post');
          header("Location: index.php?op=cms&action=edit&id=$id");
          exit;
        }
        if($_POST['url'] != $_POST['oldurl']) {
          $dupe = $db->getOne("SELECT id FROM content WHERE url='$_POST[url]'");
          if(!empty($dupe)) {
                session_start();
                session_register('dupe');
                $post = $_POST;
                session_register('post');
                header("Location: index.php?op=cms&action=edit&id=$id");
                exit;
          }
        }
        $_POST['author'] = $a->getUsername();

        $missing = array("op","submit","action","id","oldurl","globals");
        if(!isset($_POST['menu'])) $_POST['menu'] = '';
        $where = array('id' => $_POST['id']);
        $res = $form -> update("content",$missing,$where);
          header("Location: index.php?op=cms");
        exit;
        break;


  case "reshop":
        $shops = $db -> getCol("SELECT id FROM content WHERE pid='$parent' ORDER BY updown");
        foreach($shops as $id) {
          $shp = "|";
          if(!empty($_POST['shops'][$id])) {
                foreach($_POST['shops'][$id] as $key => $val) {
                  $shp .= "$key|";
                }
                $db -> query("UPDATE content SET shops='$shp' WHERE id='$id'");  // 1||3|    test php7.2 ( shop ID where goods present)
          } else {
                $db -> query("UPDATE content SET shops='' WHERE id='$id'");
          }
        }
        session_register('update');
        header("Location: index.php?op=cms&parent=$parent");
        exit;
        break;

  case "reorder":
        if(!empty($_POST['updown'])) {
          foreach($_POST['updown'] as $key => $val) {
                if(empty($key) OR empty($val)) continue;
                $db -> query("UPDATE content SET updown = '$val' WHERE id='$key'");
          }
        }
        header("Location: index.php?op=cms");
        exit;
        break;

  case "allvis":
        if(is_array($_POST['item_del'])) {
          foreach($_POST['item_del'] as $val) {
                $db -> query("UPDATE content SET menu='checked' WHERE id='$val'");
          }
        }
        header("Location: index.php?op=cms");
        exit;
        break;

  case "allinv":
        if(is_array($_POST['item_del'])) {
          foreach($_POST['item_del'] as $val) {
                $db -> query("UPDATE content SET menu='' WHERE id='$val'");
          }
        }
        header("Location: index.php?op=cms");
        exit;
        break;

  case "alldell":
        if(is_array($_POST['item_del'])) {
          foreach($_POST['item_del'] as $val) {
                $result = $db -> query("DELETE FROM content WHERE pid = '$val'");
                $result = $db -> query("DELETE FROM content WHERE id = '$val'");
          }
        }
        header("Location: index.php?op=cms");
        exit;
        break;
}
if (!isset($_GET['action'])) $_GET['action']="";
switch ($_GET['action']) {
  case "vis":
          $result = $db -> query("UPDATE content SET menu='checked' WHERE id='$id'");
          header("Location: index.php?op=cms");
          exit;
        break;

  case "inv":
          $result = $db -> query("UPDATE content SET menu='' WHERE id='$id'");
          header("Location: index.php?op=cms");
          exit;
        break;



  case "edit":
        $tmpl -> loadTemplatefile("content_page.inc",true,true);
        $row = $db -> getRow("SELECT * FROM content WHERE id='$_GET[id]'");
        $row[oldurl] = $row[url];
        $tmpl -> setVariable($row);
        if(empty($_GET['id'])) $tmpl -> setVariable("action","add");
        else $tmpl -> setVariable('action',"updateall");

        if(session_is_registered('post')) {
          if(session_is_registered('url')) {
                $tmpl->touchBlock("url"); session_unregister('url');
          }
          if(session_is_registered('dupe')) {
                $tmpl->touchBlock("dupe"); session_unregister('dupe');
          }
          $post['shorttitle'] = htmlspecialchars($post['shorttitle'], ENT_XML1, cp1251);
          $post['title'] = htmlspecialchars($post['title'], ENT_XML1, cp1251);
          $post['text'] = htmlspecialchars($post['text'], ENT_XML1, cp1251);
          $tmpl -> setVariable($post);
          session_unregister('post');
          session_unregister('url');
        }
        break;

  case "del":
        cms_delete($_GET['id']);
    header("Location: index.php?op=cms");
        exit;
        break;

  default:
        $tmpl -> loadTemplatefile("content.inc",true,true);

// принадлежность к магазинам
    $shops = $db -> getAll("SELECT id as shop_id,color FROM shops ORDER BY id");

        $result = $db -> query("SELECT * FROM content WHERE pid='$parent' ORDER BY updown ASC");
        while ($row = $result -> fetchRow()) {
          if($row['menu'] == 'checked') {
                $tmpl -> setCurrentBlock('vis');
                $tmpl -> setVariable('ids',$row['id']);
                  $tmpl -> parseCurrentBlock('vis');
          } else {
                $tmpl -> setCurrentBlock('inv');
                $tmpl -> setVariable('ids',$row['id']);
                  $tmpl -> parseCurrentBlock('inv');
          }
          if(!empty($shops)) {
                foreach($shops as $val) {
                  $check = strpos($row['shops'],"|$val[shop_id]|");
                  if($check !== false) $val['checked'] = ' checked';
                  $val['id'] = $row['id'];
                  $tmpl -> setCurrentBlock('shop');
                  $tmpl -> setVariable($val);
                  $tmpl -> parseCurrentBlock('shop');
                }
          }
          $tmpl -> setCurrentBlock("list");
          $tmpl -> setVariable($row);
            $tmpl -> parseCurrentBlock("list");
        }
        $tmpl->touchBlock('group');
}

if($parent == 1) {
  $title = "";
} else {
  $row = $db -> getRow("SELECT * FROM content WHERE id='$parent'");
  $children['pid'] = $row['pid'];
  $path = " / ".$row['url'];
  while ( $children['pid'] != 1) {
        $chi = $children['pid'];
        $childid = $children['id'];
        $childurl = $children['url'];
        $children = $db -> getRow("SELECT * FROM content WHERE id='$chi'");
        $path = " / <a href=index.php?op=cms&parent=$childid>$childurl</a>". $path;
  }
  $tmpl->setVariable('up_parent',$row['pid']);
}
if (!isset($path)) $path="";
$tmpl -> setVariable('path',$path);

$tmpl -> touchBlock('add');

////////////////////////////////////////
//                                    //
//         FUNCTION AREA :-)          //
//                                    //
////////////////////////////////////////

function cms_delete($id) {
  GLOBAL $db;
// удаление данных о статье
  $db -> query("DELETE FROM content WHERE id='$id'");
  $db -> query("DELETE FROM content WHERE pid = '$id'");
// удаление информации о статьях из "связанных" таблиц
  $db -> query("UPDATE items SET article=REPLACE(article,'|".$id."|','|') WHERE article LIKE '%|".$id."|%'");
  $db -> query("UPDATE spec  SET article=REPLACE(article,'|".$id."|','|') WHERE article LIKE '%|".$id."|%'");

}



?>