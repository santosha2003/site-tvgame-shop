<?php
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}

echo "<pre>" ;
 print_r ($_GET);
  echo "</pre>";

$tmpl -> loadTemplatefile('catalog.inc',false,false);

if (!isset ($_POST['action']))  $_POST['action']="";
 if (!isset ($_POST['parent']))  $_POST['parent']="2";
 $parent= $_POST['parent'];  //$_POST[parent] upper level in catalog tree

switch ($_POST['action']) {

  case "reshop":

        $shops = $db -> getCol("SELECT id FROM category WHERE parent='$parent' ORDER BY updown");
        $db -> query("UPDATE category SET shops='|1|2|3|4|' WHERE parent='$parent'");
        if(!empty($shops) AND is_array($shops)) {
          foreach($shops as $id) {
                $shp = "|";
                if(!empty($_POST['shops'][$id])) {
                  foreach($_POST['shops'][$id] as $key => $val) {
                        $shp .= "$key|";
                  }
                  $db -> query("UPDATE category SET shops='$shp' WHERE id='$id'");
                } else {
                  $db -> query("UPDATE items SET shops='|1|2|3|4|' WHERE id='$id'");
                }
          }
          session_register('update');
        }
        header("Location: index.php?op=catalog&parent=$parent");
        exit;
  break;

  case "updown":

        if(!empty($_POST['updown'])) {
          foreach($_POST['updown'] as $key => $val) {
                if(empty($key) OR empty($val)) continue;
                $db -> query("UPDATE category SET updown = '$val' WHERE id='$key'");
          }
        }
        header("Location: index.php?op=catalog&parent=$parent");
        break;

  case "add_cat":
 if(empty($_POST['parent'])) { $_POST['parent']="2"; }
 if($_POST['parent'] == "0") { $_POST['parent']="2"; }
 $parent= $_POST['parent'];
 $supertitle =$_POST['supertitle'];
 $id= $_POST['id'];
            if(empty($_POST['name'])) {
                session_start();
                session_register('add_name');
                $post = $_POST;
                session_register('post');
                header("Location: index.php?op=catalog&parent=$parent");
                exit;
          }
          $_POST['id'] = $db -> nextID("category");
          $_POST['status'] = "Y";
          $_POST['bottom'] = "Y";
          $_POST['updown'] = $db -> getOne("SELECT MAX(updown) FROM category WHERE parent='$parent'") + 10;
          $missing = array("action","submit","op");
          $result = $form -> add("category",$missing);
           $results = $db -> query("INSERT INTO category (supertitle) values('$supertitle') WHERE id='$id'");
        $resultss = $db -> query("INSERT INTO category (supertitle) values('$supertitle') WHERE parent='$id'");
//print_r ($missing);
          session_start();
          session_register('add');
          header("Location: index.php?op=catalog&parent=$parent");
        break;
  case "edit_cat":
$parent= $_POST['parent'];  //$_POST[parent]
$supertitle =$_POST['supertitle'];
$id= $_POST['id'];
          if(empty($_POST['name'])) {
                session_start();
                session_register('add_name');
                $post = $_POST;
                session_register('post');
                header("Location: index.php?op=catalog&action=edit_cat&parent=$parent");
                exit;
          }
        $missing = array("action","id","parent","submit","op");
        $where = array('id' => $_POST['id']);
        $result = $form -> update("category",$missing,$where);
        $results = $db -> query("UPDATE category SET supertitle='$supertitle' WHERE id='$id'");
        $resultss = $db -> query("UPDATE category SET supertitle='$supertitle' WHERE parent='$id'");

//        print_r ($missing);
//        print_r ($result); 
//        print_r ($results);
//        print_r ($resultss);
 
        if(empty($_POST['name'])) {
         session_start();
         session_register('update');
         }
        header("Location: index.php?op=catalog&parent=$parent");
        break;
}

if (!isset ($_GET['action'])) $_GET['action']="";
if (!isset ($_GET['id'])) $_GET['id']="";
  $id=$_GET['id'];
if (isset($_GET['parent'])) $parent=$_GET['parent'];
// drawing list of categories
if(!isset($row['parent'])) $row['parent']="";
if(!isset($_GET['parent']) OR $_GET['parent'] == 2) {
  $parent=2;
  $row['title'] = "";
} else {
  $row = $db -> getRow("SELECT * FROM category WHERE id='$parent'");
  $children['parent'] = $row['parent'];
  $row['title'] = $row['name'];
 if (isset ($children['id']) AND ( $children['id'] != 0)) {
   while ( $children['parent'] != 0) {
        $id1=$children['id'];
        $chilid1=$children['parent'];
        $chname=$children['name'];
        $children = $db -> getRow("SELECT * FROM category WHERE id='$chilid1'");
        $row['title'] = "<a href=index.php?op=catalog&parent=$id1></a> :: $chname ". $row['title'];
   }
  } 
  $row['title'] = $row['title'];               //??
  $tmpl -> setCurrentBlock('up_parent');
  $tmpl->setVariable('up_parent',$row['parent']);  //line 102  add (notice in log) ,the same name - block in template catalog.inc and variable name  ok?
  $tmpl -> parseCurrentBlock('up_parent');
  }

$row['count'] = $db -> getOne("SELECT COUNT(cid) FROM items WHERE cid = '1'");
$tmpl -> setCurrentBlock('header');
if (isset ($warning)) $row['warning'] = $warning;

print_r ($row);

$tmpl -> setVariable($row);
$tmpl -> parseCurrentBlock('header');
//$tmpl->free();   //php7.2 'page' not compose now

$shops = $db -> getAll("SELECT id as shop_id,color FROM shops ORDER BY id");
$result = $db -> query("SELECT * FROM category WHERE parent='$parent' ORDER BY updown");
while ($row = $result -> fetchRow()) {
  $row['count'] = $db -> getOne("SELECT COUNT(cid) FROM items WHERE cid='$row[id]'");
  $row['cat_count'] = $db -> getOne("SELECT COUNT(id) FROM category WHERE parent = '$row[id]'");
  if($row['status'] == "Y") {
        $tmpl -> setCurrentBlock("visible");
        $tmpl -> setVariable($row);
        $tmpl -> parseCurrentBlock("visible");
  } else {
        $tmpl -> setCurrentBlock("invisible");
        $tmpl -> setVariable($row);
        $tmpl -> parseCurrentBlock("invisible");
  }
  if($row['bottom'] == "Y") {
        $tmpl -> setCurrentBlock("bottom_on");
        $tmpl -> setVariable($row);
        $tmpl -> parseCurrentBlock("bottom_on");
  } else {
        $tmpl -> setCurrentBlock("bottom_off");
        $tmpl -> setVariable($row);
        $tmpl -> parseCurrentBlock("bottom_off");
  }
  if(!empty($shops) AND is_array($shops)) {
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
//  $tmpl -> free();
}


switch ($_GET['action']) {
  case "edit_cat":

          $rows = $db -> getRow("SELECT * FROM category WHERE id = '$id'");
          $rows['action'] = "edit_cat";
//          $tmpl -> setVariable($rows);
          $tmpl -> setCurrentBlock("submit_edit");
          $tmpl -> setVariable('sedit',"submit");
          $tmpl -> parseCurrentBlock("submit_edit");
//          $tmpl -> free();   //no auto add to page - php7.2 
          $tmpl -> setVariable('action',"edit_cat");
          $tmpl -> setVariable('parent',$rows['parent']);
          $tmpl -> setVariable('id',$rows['id']);
          $tmpl -> setVariable('name',htmlspecialchars($rows['name'], ENT_XML1, cp1251));
          $tmpl -> setVariable('description',$rows['description']);
          $tmpl -> setVariable('supertitle',$rows['supertitle']);
          $tmpl -> touchBlock('header_edit');
          if(session_is_registered('post')) {
                $tmpl -> setVariable($post);
                session_unregister('post');
          }
        break;

  case "del_cat":

    function viewvetka($id) {
      GLOBAL $db, $form;
          $result = $db -> query("SELECT * FROM category WHERE parent='$id'");
          while($row = $result -> fetchRow()) {
                $list[] = array($row['id']);
              }
          if (!empty($list)) {
                foreach($list as $item) {
                  $result = $db -> query("SELECT * FROM category WHERE parent='$item[0]'");
                  $missing = array();
                  $data = array("cid" => 2);
                  $where = array("cid" => $item[0]);
                  $result = $form -> update("items",$missing,$where,$data);
                  $missing = array("id" => $item[0]);
                  $result = $form -> del("category",$missing);
                  viewvetka($item[0]);
                }
          }
        }

      viewvetka($id);
      $missing = array( "id" => $id );
//        print_r ($missing);   
      $data = array("cid" => 2);
      $where = array("cid" => $id);
      $result = $form -> update("items",$missing,$where,$data);
//         print_r ($result);   
      $result = $form -> del("category",$missing);
//         print_r ($result); 
      session_start();
      session_register('delete');
      header("Location: index.php?op=catalog&parent=$parent");
      exit;
    break;

  case "vis_cat":

                function viewvetka_vis($id) {
                  GLOBAL $db, $form;
                  $result = $db -> query("SELECT * FROM category WHERE parent='$id'");
                  while($row = $result -> fetchRow()) {
                        $list[] = array($row['id']);
                  }
                  if (!empty($list)) {
                        foreach($list as $item) {
                          $result = $db -> query("UPDATE category SET status='Y' WHERE id='$item[0]'");
                          $result = $db -> query("UPDATE items SET status=tmp_status, tmp_status='' WHERE cid='$item[0]' AND tmp_status!=''");
                          viewvetka_vis($item[0]);
                        }
                  }
                }

          viewvetka_vis($_GET['id']);
          $result = $db -> query("UPDATE category SET status='Y' WHERE id='$id'");
          $result = $db -> query("UPDATE items SET status=tmp_status, tmp_status='' WHERE cid='$id' AND tmp_status!=''");
          header("Location: index.php?op=catalog&parent=$parent");
          exit;
        break;

  case "inv_cat":

                function viewvetka_inv($id) {
                  GLOBAL $db, $form;
                  $result = $db -> query("SELECT * FROM category WHERE parent='$id'");
                  while($row = $result -> fetchRow()) {
                        $list[] = array($row['id']);
                  }
                  if (!empty($list)) {
                        foreach($list as $item) {
                          $result = $db -> query("UPDATE category SET status='N' WHERE id='$item[0]'");
                          $result = $db -> query("UPDATE items SET tmp_status=status, status='N' WHERE cid='$item[0]' AND tmp_status=''");
                          viewvetka_inv($item[0]);
                        }
                  }
                }

          viewvetka_inv($id);
                          $result = $db -> query("UPDATE category SET status='N' WHERE id='$id'");
                          $result = $db -> query("UPDATE items SET tmp_status=status, status='N' WHERE cid='$id'");
          header("Location: index.php?op=catalog&parent=$parent");
          exit;
        break;

  case "bottom_off":

    $result = $db -> query("UPDATE category SET bottom='Y' WHERE id='$id'");
        header("Location: index.php?op=catalog&parent=$parent");
        exit;
        break;

  case "bottom_on":

    $result = $db -> query("UPDATE category SET bottom='N' WHERE id='$id'");
        header("Location: index.php?op=catalog&parent=$parent");
        exit;
        break;

  default:

           if (!isset($error)) $error="";
           $post = $_POST;
          $tmpl -> setVariable($post);
          //$tmpl -> free();
          $tmpl -> setCurrentBlock("submit_add");
          $tmpl -> setVariable('sadd',"submit");
          $tmpl -> parseCurrentBlock("submit_add");
          $tmpl -> free();
          $tmpl -> setVariable('action',"add_cat");
          $tmpl -> setVariable('parent',$parent);
          //$tmpl -> setVariable('warning',$error);
          $tmpl -> touchBlock('header_add');
          if(session_is_registered('post')) {
                $tmpl -> setVariable($post);
                session_unregister('post');
          }
          break;
}

?>