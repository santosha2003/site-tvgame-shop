<?php
//change v4 $HTTP_* to v5.6-v7 $_SESSION $_POST
////session_register () add function into ./lib/config(_admin).php
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


//echo "<pre>";
//print_r ($_POST);
//print_r ($_GET);
//print_r ($_SESSION);
//echo "</pre>";


if (!isset($_GET['action']))  $_GET['action']="";
if (empty ($_GET['pages'])) $_GET['pages']= 1;
switch ($_GET['action']) {
  case "add":
        $tmpl -> loadTemplatefile("item_add.inc",true,true);
        include("item_add.php");
        break;

  case "item_edit":
        $tmpl -> loadTemplatefile("item_add.inc",true,true);
        include("item_add.php");
        break;

  case "item_vis":
  $id=$_GET['id'];
  $parent=$_GET['parent'];
  $pages=$_GET['pages'];

          $result = $db -> query("
                UPDATE items
                SET status=
                CASE
                  WHEN tmp_status=''
                  THEN 'Y'
                  ELSE status
                END ,
                tmp_status=
                CASE
                  WHEN tmp_status!=''
                  THEN 'Y'
                  ELSE tmp_status
                END
                WHERE id='$id'");
          session_register('visible');
          header("Location: index.php?op=item&parent=$parent&pages=$pages");
        break;

  case "item_inv":
  $id=$_GET['id'];
  $parent=$_GET['parent'];
  $pages=$_GET['pages'];

          $result = $db -> query("
                UPDATE items
                SET status=
                CASE
                  WHEN tmp_status=''
                  THEN 'N'
                  ELSE status
                END ,
                tmp_status=
                CASE
                  WHEN tmp_status!=''
                  THEN 'N'
                  ELSE tmp_status
                END
                WHERE id='$id'");
          header("Location: index.php?op=item&parent=$parent&pages=$pages");
        break;
 // Яндекс маркет
  case "item_ymly":
$id=$_GET['id'];
$parent=$_GET['parent'];
$pages=$_GET['pages'];
          $result = $db -> query("
                UPDATE items
                SET market_show='Y'
                WHERE id='$id'");
          header("Location: index.php?op=item&parent=$parent&pages=$pages");
        break;

  case "item_ymln":
$id=$_GET['id'];
$parent=$_GET['parent'];
$pages=$_GET['pages']; 
         $result = $db -> query("
                UPDATE items
                SET market_show='N'
                WHERE id='$id'");
          header("Location: index.php?op=item&parent=$parent&pages=$pages");
        break;
  case "item_delete":
  $id=$_GET['id'];
  $parent=$_GET['parent'];
  $pages=$_GET['pages'];

          item_delete($_GET['id']);
          session_register('delete');
          header("Location: index.php?op=item&parent=$parent&pages=$pages");
        break;
}

if (!isset($_POST['action']))  $_POST['action']="";
switch ($_POST['action']) {
  case "reshop":
  //$_POST [] op pages parent updown ($item_id=>$sort.. 1-x) shops($id=>$key=>"on" or empty) action="reshop"
  // if(empty($_POST['pages'])) $_POST['pages'] = 1;
 //if(empty($_POST[parent])) $_POST[parent] = 2;
 $parent= $_POST['parent'];  //$_POST[parent]
 $pages=$_POST['pages'];
 $op="item";
    $c_pagenum = $db->getOne("SELECT value FROM settings WHERE id='20'");
//$vstart defined in nav_bar.php, here no need to display
    $vstart = ($pages-1) * $c_pagenum;
        //$shops = $db -> getCol("SELECT id FROM category WHERE parent='$parent' ORDER BY updown");
    $shops = $db -> getCol("SELECT id FROM items WHERE cid='$parent' ORDER BY updown LIMIT $vstart,$c_pagenum");

        if(!empty($shops) AND is_array($shops)) {
          foreach($shops as $id) {
        $db -> query("UPDATE category SET shops='|1|2|3|4|' WHERE parent='$_POST[parent]'");
                $shp = "|";
                if(!empty($_POST['shops'][$id])) {
                  foreach($_POST['shops'][$id] as $key => $val) {
                        $shp .= "$key|";
                  }
                  $db -> query("UPDATE items SET shops='$shp' WHERE id='$id'");
                } else {
                  $db -> query("UPDATE items SET shops='|1|2|3|4|' WHERE id='$id'");
                }
          }
         session_register('update');
        }
        header("Location: index.php?op=$op&parent=$parent&pages=$pages");
        break;

  case "item_reorder":
 
 $parent=$_POST['parent'];
 $pages=$_POST['pages'];
        if(is_array($_POST['updown'])) {
          foreach($_POST['updown'] as $key => $val) {
                $db -> query("UPDATE items SET updown='$val' WHERE id='$key'");
          }
          header("Location: index.php?op=item&parent=$parent&pages=$pages");
        }
        break;

  case "item_alldell":
  
 $parent=$_POST['parent'];
 $pages=$_POST['pages'];
        if(is_array($_POST['item_del'])) {
          foreach($_POST['item_del'] as $val) {
                item_delete($val);
          }
        }
        header("Location: index.php?op=item&parent=$parent&pages=$pages");
        break;

  case "item_allvis":

 $parent=$_POST['parent'];
 $pages=$_POST['pages'];
        if(is_array($_POST['item_del'])) {
          foreach($_POST['item_del'] as $val) {
                $db -> query("
                UPDATE items
                SET status=
                CASE
                  WHEN tmp_status=''
                  THEN 'Y'
                  ELSE status
                END ,
                tmp_status=
                CASE
                  WHEN tmp_status!=''
                  THEN 'Y'
                  ELSE tmp_status
                END
                WHERE id='$val'");
          }
        }
        header("Location: index.php?op=item&parent=$parent&pages=$pages");
        break;

  case "item_allinv":

 $parent=$_POST['parent'];
 $pages=$_POST['pages'];
        if(is_array($_POST['item_del'])) {
          foreach($_POST['item_del'] as $val) {
                $db -> query("
                UPDATE items
                SET status=
                CASE
                  WHEN tmp_status=''
                  THEN 'N'
                  ELSE status
                END ,
                tmp_status=
                CASE
                  WHEN tmp_status!=''
                  THEN 'N'
                  ELSE tmp_status
                END
                WHERE id='$val'");
          }
        }
        header("Location: index.php?op=item&parent=$parent&pages=$pages");
        break;
//old $HTTP_POST_VARS
  case "item_unikum":

 $parent=$_POST['parent'];
 $pages=$_POST['pages'];
        $un = $db -> query("UPDATE items SET unikum='' WHERE cid='$parent'");
        if (!empty($_POST['unikum'])) {
          foreach($_POST['unikum'] as $key => $val) {
                $un = $db -> query("UPDATE items SET unikum='checked' WHERE id='$key'");
          }
        }
        header("Location: index.php?op=item&parent=$parent&pages=$pages");
        break;

  case "item_allmove":

 $parent=$_POST['parent'];
 $pages=$_POST['pages'];
        if(is_array($item_del)) {
      $url = "interes.php?action=allmove&parent=$parent";
          foreach($item_del as $val) {
                $url .= "&id[]=$val";
          }
          echo '<HTML><HEAD><meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru"><SCRIPT>document.open("'.$url.'","interes","width=550,height=600,toolbar=no,resizable=yes,scrollbars=yes");</SCRIPT></HEAD><BODY></BODY></HTML>';
        }
        break;

}

if (!isset($_GET['action']))  $_GET['action']="";
if($_GET['action'] != 'add' AND $_GET['action'] != 'item_edit') {

if(empty($_GET['parent'])) $_GET['parent'] = 2;
if(empty($_GET['pages'])) $_GET['pages'] = 1;

// принадлежность к магазинам
  $shops = $db -> getAll("SELECT id as shop_id,color FROM shops ORDER BY id");
 $parent = $_GET['parent'];
 $pages = $_GET['pages'];
  $query = "FROM items WHERE cid='$parent'";
  $c_pagenum = $db->getOne("SELECT value FROM settings WHERE id='20'");
  $op="item";
  //input op parent pages //output navi link bar
  include("./nav_bar.php");
  //$vstart in nav_bar.php
 // print_r ($direct_bar);
  $result = $db -> query("SELECT * ".$query." ORDER BY updown LIMIT $vstart,$c_pagenum");
 //$pages ... $pages;
  if ($result -> numRows() != 0) {
        while ($row = $result -> fetchRow()) {
          //if (!empty($_GET[pages])) $row[pages] = $_GET[pages] ;
          $row['pages'] = $pages ;
          //else $row[pages] = 1;
        $row['parent'] = $parent;
        if(!empty($row['tmp_status'])) $row['status'] = $row['tmp_status'];
        if($row['status'] == "Y") {
          $tmpl -> setCurrentBlock("item_visible");
          $tmpl -> setVariable($row);
          $tmpl -> parseCurrentBlock("item_visible");
        } else {
          $tmpl -> setCurrentBlock("item_invisible");
          $tmpl -> setVariable($row);
          $tmpl -> parseCurrentBlock("item_invisible");
        }
        if($row['market_show'] == "Y") {
          $tmpl -> setCurrentBlock("item_yml1");
          $tmpl -> setVariable($row);
          $tmpl -> parseCurrentBlock("item_yml1");
        } else {
          $tmpl -> setCurrentBlock("item_yml0");
          $tmpl -> setVariable($row);
          $tmpl -> parseCurrentBlock("item_yml0");
        }

        if(!empty($shops)) {
          foreach($shops as $val) {
                $check = strpos($row['shops'],"|$val[shop_id]|");   //"|1|3|"
                if($check !== false) $val['checked'] = ' checked';
                $val['id'] = $row['id'];
                $tmpl -> setCurrentBlock('shop');
                $tmpl -> setVariable($val);
                $tmpl -> parseCurrentBlock('shop');
          }
        }

        if(!empty($row['part'])) {
          $row['count_part'] = substr_count($row['part'],"|")-1;
        } else $row['count_part'] = 0;

        if(!empty($row['spec'])) {
          $row['count_spec'] = substr_count($row['spec'],"|")-1;
        } else $row['count_spec'] = 0;

        if(!empty($row['article'])) {
          $row['count_article'] = substr_count($row['article'],"|")-1;
        } else $row['count_article'] = 0;

        if(!empty($row['statu'])) {
          $row['count_statu'] = substr_count($row['statu'],"|")-1;
        } else $row['count_statu'] = 0;

        $tmpl -> setCurrentBlock("tovar");
        $row[parent] = $parent;
        $tmpl -> setVariable($row);
        $tmpl -> parseCurrentBlock("tovar");
        $tmpl -> free();
        }
    $tmpl -> touchBlock("group");
  } else {
//  $tmpl -> touchBlock("no_tovar");
          $tmpl -> setCurrentBlock("no_tovar");
          $tmpl -> setVariable('nbsp',"&nbsp;");
          $tmpl -> parseCurrentBlock("no_tovar");
  }

  if(!isset($parent) OR $parent == 2) {
        $parent=2;
        $row['title'] = "";
  } else {
        $row = $db -> getRow("SELECT * FROM category WHERE id='$parent' ORDER BY updown");
        $children[parent] = $row[parent];
        $row['title'] = $row['name'];
          if ($parent == 1) {
                $row['title'] = " / ".$row['title'];
                $sel1 = " selected";
//                  break;
          }
        while ($children[parent] != 0) {
         $id_parr = $children[parent];
          $children = $db -> getRow("SELECT * FROM category WHERE id='$id_parr' ORDER BY updown");
          $id_chil = $children['id'];
          $nam_chil = $children['name'];
          $row['title'] = "<a href=index.php?op=item&parent=$id_chil&$nam_chil</a> / ". $row['title'];
        }
        $row['title'] = $row['title'];

        $tmpl -> setCurrentBlock('up_parent');
        $tmpl->setVariable('up_parent',$row[parent]);
        $tmpl -> parseCurrentBlock('up_parent');
  }
  $row['count'] = $db -> getOne("SELECT COUNT(cid) FROM items WHERE cid = '1'");
  if (!isset($warning))  $warning="";
  $row['warning'] = $warning;
  unset($row['updown']);
  $tmpl -> setCurrentBlock('header');
  $tmpl -> setVariable($row);
  $tmpl -> parseCurrentBlock('header');
//  $tmpl -> free();

///
///
///
///
///
viewvetka(2);
///
///
///
///
///


  $tmpl -> setVariable('parent',$parent);
  if (!isset($sel1))  $sel1="";
  $tmpl -> setVariable('sel1',$sel1);

  if ($direct_bar != " <font class=active>1</font> " AND !empty($direct_bar)) $tmpl -> setVariable('nav_bar',$direct_bar);
  if (!empty($pages)) $tmpl -> setVariable('pages',$pages);
  else $tmpl -> setVariable('pages',1);
}


////////////////////////////////////////
//                                    //
//         FUNCTION AREA :-)          //
//                                    //
////////////////////////////////////////

function viewvetka($id,$level=0) {
  GLOBAL $db, $tmpl, $parent;
  $result = $db -> query("SELECT * FROM category WHERE parent='$id' ORDER BY updown");
  while($row = $result -> fetchRow()) {
        if (!isset($row['csku']))  $row['csku']="";
        $list[] = array($row[parent],$row['id'],$row['name'],$row['csku']);
  }
  $i=0; $str = "";
  if (!empty($list)) {
        for($i=0; $i<$level; $i++) {
          $str .= "&nbsp;&nbsp;&nbsp;";
        }
        foreach($list as $item) {
          $i++;
          $res['total'] = $db -> getOne("SELECT COUNT(*) FROM items WHERE cid = '$item[1]'");
          $res['id'] = $item[1];
          $res['name'] = " ".$item[2];
          $res['otstup'] = $str;
          $res['clas'] = "t";
          if ($_GET[parent] == $item[1]) {
                $res['selected'] = " selected";
                $res['clas'] = "tb";
          }
          else  $res['selected'] = "";
            $tmpl -> setCurrentBlock('select');
            $tmpl -> setVariable($res);
                $tmpl -> parseCurrentBlock('select');
          viewvetka($item[1], $level+1);
        }
  }
}

function item_delete($id) {
  GLOBAL $db;
// удаление фоток связанных с товаром
  $photo = $db -> getRow("SELECT photo_small,photo_big FROM items WHERE id='$id'");
  if(!empty($photo['photo_small']))
          @unlink("../images/photo/".$photo['photo_small']);
  if(!empty($photo['photo_big']))
          @unlink("../images/photo/".$photo['photo_big']);
// удаление данных о товаре
  $db -> query("DELETE FROM items WHERE id='$id'");
// удаление технических парметров
  $db -> query("DELETE FROM items_value WHERE id='$id'");
// удаление информации о товаре у "связанных" товаров
  $db -> query("UPDATE items SET part=REPLACE(part,'|".$id."|','|') WHERE part LIKE '%|".$id."|%'");
  $db -> query("UPDATE items SET spec=REPLACE(part,'|".$id."|','|') WHERE spec LIKE '%|".$id."|%'");
// удаление информации о товаре в спецпредложениях
  $db -> query("UPDATE spec SET items=REPLACE(items,'|".$id."|','|') WHERE items LIKE '%|".$id."|%'");

}

?>