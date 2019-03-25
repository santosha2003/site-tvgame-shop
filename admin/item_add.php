<?php
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}
echo "<pre>";
print_r ($_POST);
//print_r ($_GET);
//print_r ($_SESSION);
echo "</pre>";

if (!isset($_POST['action'])) $_POST['action']="";
if (!isset($_POST['id'])) $_POST['id']="";
if (!isset($_POST['parent'])) $_POST['parent']="";
if (!isset($_POST['pages'])) $_POST['pages']="";

$id1=$_POST['id'];                     // for edit action
$addr_r2=  $_POST['parent'];
$addr_r3=  $_POST['pages'];

switch ($_POST['action']) {

// добавить товар
  case "add_item":
$parent=$_POST['parent'];
        $error = false;
// загрузка маленькой фотографии
        if(!empty($_FILES['photo_small']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_small'];
          $img_name = md5($_FILES['photo_small']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_small'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_small'],0644);
        } else {
          $_POST['photo_small'] = "";
        }

       // загрузка чертежа
        if(!empty($_FILES['photo_small1']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_small1'];
          $img_name = md5($_FILES['photo_small1']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_small1'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_small1'],0644);
        } else {
          $_POST['photo_small1'] = "";
        }

     // загрузка фото в природе
        if(!empty($_FILES['photo_small2']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_small2'];
          $img_name = md5($_FILES['photo_small2']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_small2'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_small2'],0644);
        } else {
          $_POST['photo_small2'] = "";
        }




// загрузка большой фотографии
        if(!empty($_FILES['photo_big']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_big'];
          $img_name = md5($_FILES['photo_big']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_big'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_big'],0644);
        } else {
          $_POST['photo_big'] = "";
        }
   // загрузка большого чертежа
        if(!empty($_FILES['photo_big1']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_big1'];
          $img_name = md5($_FILES['photo_big1']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_big1'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_big1'],0644);
        } else {
          $_POST['photo_big1'] = "";
        }

        // загрузка большой фото в натуре
        if(!empty($_FILES['photo_big2']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_big2'];
          $img_name = md5($_FILES['photo_big2']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_big2'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_big2'],0644);
        } else {
          $_POST['photo_big2'] = "";
        }



        $ref = array(
          'shops', // принадлежность к магазинам
          'svva' // характеристики товара
//          'statu' // свойства товара
        );

        foreach($ref as $r) {
          if(!empty($_POST[$r])) {
                $ar = "|";
                foreach($_POST[$r] as $val)
                  $ar .= "$val|";
                $_POST[$r] = $ar;
          } else {
          $ar = "";
                $_POST[$r] = $ar;

          }
        }

// сохранение данных от товаре
        $_POST['id'] = $db -> nextID("items");
        $_POST['status'] = "Y";
        $_POST['updown'] = $db -> getOne("SELECT MAX(updown) FROM items WHERE cid=$parent") + 10;   // sorting order
        $_POST['cid'] = $_POST['parent'];
        $missing = array("action","submit","addtitle","addurl","parent","item_name","item_description","pages","op","unique","tmpid","rn","rnew","rvalue","action2");
        if (!isset($insert)) $insert="";
 //print_r ($_POST);
        $result = $form -> add("items",$missing,$insert);  //FormProc.php lib

// сохранение технических характеристик
        ref_items();                    //$_POST  .. id cid 

        header("Location: index.php?op=item&parent=$parent&pages=$pages");  //debug (comment line) - add market_show for Yandex into template form
        break;

/////////////////////////////
//                         //
// редактировать товар
//                       //
//////////////////////////
  case "item_edit":


// запрос на удаление фотографии
        if(!empty($_POST['action2'])) {
          $old_photo = $db -> getOne("SELECT photo_".$_POST['action2']." FROM items WHERE id='$id1'");
          if(!empty($old_photo))
                @unlink("../images/photo/".$old_photo);
          $db -> query("UPDATE items SET photo_".$_POST['action2']."='' WHERE id='$id1'");
        }

// загрузка маленькой фотографии
        if(!empty($_FILES['photo_small']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_small'];
          $img_name = md5($_FILES['photo_small']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_small'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_small'],0644);
//удаление старой фотографии, если загружена новая
          $old_photo = $db -> getOne("SELECT photo_small FROM items WHERE id='$id1'");
          if(!empty($old_photo))
                @unlink("../images/photo/".$old_photo);
        } else {
          unset($_POST['photo_small']);
        }
 // загрузка чертежа
        if(!empty($_FILES['photo_small1']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_small1'];
          $img_name = md5($_FILES['photo_small1']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_small1'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_small1'],0644);
//удаление старого, если загружен новый
          $old_photo1 = $db -> getOne("SELECT photo_small1 FROM items WHERE id='$id1'");
          if(!empty($old_photo1))
                @unlink("../images/photo/".$old_photo1);
        } else {
          unset($_POST['photo_small1']);
        }
        // загрузка фото в природе
        if(!empty($_FILES['photo_small2']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_small2'];
          $img_name = md5($_FILES['photo_small2']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_small2'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_small2'],0644);
//удаление старой, если загружена новая
          $old_photo2 = $db -> getOne("SELECT photo_small2 FROM items WHERE id='$id1'");
          if(!empty($old_photo2))
                @unlink("../images/photo/".$old_photo2);
        } else {
          unset($_POST['photo_small2']);
        }

// загрузка большой фотографии
        if(!empty($_FILES['photo_big']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_big'];
          $img_name = md5($_FILES['photo_big']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_big'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_big'],0644);
//удаление старой фотографии, если загружена новая
          $old_photo = $db -> getOne("SELECT photo_big FROM items WHERE id='$id1'");
          if(!empty($old_photo))
                @unlink("../images/photo/".$old_photo);
        } else {
          unset($_POST['photo_big']);
        }
    // загрузка большого чертежа
        if(!empty($_FILES['photo_big1']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_big1'];
          $img_name = md5($_FILES['photo_big1']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_big1'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_big1'],0644);
//удаление старого большого чертежа если загружен новый
          $old_photo1 = $db -> getOne("SELECT photo_big1 FROM items WHERE id='$id1'");
          if(!empty($old_photo1))
                @unlink("../images/photo/".$old_photo1);
        } else {
          unset($_POST['photo_big1']);
        }

        // загрузка большой фото в натуре
        if(!empty($_FILES['photo_big2']['name'])) {
          require_once("../lib/class.SDImageUploading.php");
          $iu = new SDImageUploading();
          $img_path = '../images/photo/';
          $img_upload = $_FILES['photo_big2'];
          $img_name = md5($_FILES['photo_big2']['tmp_name'].time());
          $image_ext = $iu->doUpload($img_path,$img_upload,$img_name);
          if (!$image_ext) $error .= "<li>".$iu->error;
          $_POST['photo_big2'] = $img_name.$image_ext;
          chmod($img_path.$_POST['photo_big2'],0644);
//удаление старого большой если загружена новая
          $old_photo2 = $db -> getOne("SELECT photo_big2 FROM items WHERE id='$id1'");
          if(!empty($old_photo2))
                @unlink("../images/photo/".$old_photo2);
        } else {
          unset($_POST['photo_big2']);
        }



        $ref = array(
          'shops', // принадлежность к магазинам
          'svva' // характеристики товара
//          'statu' // свойства товара
        );

        foreach($ref as $r) {
          if(!empty($_POST[$r])) {
                $ra = "|";
                foreach($_POST[$r] as $val) {
                  $ra .= "$val|";
                }
                $_POST[$r] = $ra;
          } else {
           $ra = "";
                $_POST[$r] = $ra;  // '|1|||4|'
          }
        }

//обновление информации о товаре в базе
        $missing = array("action","submit","addtitle","addurl","parent","item_name","item_description","pages","op","unique","tmpid","rn","rnew","rvalue","action2");
        $where = array("id" => $_POST['id']);
        $result = $form -> update("items",$missing,$where);

// сохранение технических характеристик
        $db -> query("DELETE FROM items_value WHERE id='$id1'");
        ref_items();

        if(!empty($_POST['action2'])) {
          //возврат на страницу редактирования товара
          header("Location: index.php?op=item&action=item_edit&id=$id1&parent=$addr_r2&pages=$addr_r3");
        } else {
          //редирект на обновленную страницу с товарами
          header("Location: index.php?op=item&parent=$addr_r2&pages=$addr_r3");
        }
        break;
}

if (!isset($_GET['action'])) $_GET['action']="";
  $id=$_GET['id'];

switch ($_GET['action']) {
  case "item_edit":

                $tmpl -> setCurrentBlock('__global__');

        $tmpl -> setVariable('action',"item_edit");
        $tmpl -> setVariable('parent',$_GET['parent']);
//                $tmpl -> parseCurrentBlock();

// технические характеристики
        $rr = $db -> getAssoc("SELECT id,name FROM items_ref");
        $right = $db -> getAll("SELECT name,value FROM items_ref a, items_value b WHERE a.id=b.rid AND b.id='$id' ORDER BY b.updown");
        $for = sizeof($right) + 4;

        for($i=0; $i <=$for; $i++) {   //$i=1 wrong
          foreach($rr as $key => $val) {
                $item_select['rid'] = $key;
                $item_select['rname'] = $val;
          //err in 326 line if i=0 chg for($i=0.. for($i=1 PHP Notice:  Undefined offset:  0...1 ..4 in item_add.php on line 322
                 if (!isset($right[$i]['name'])) $right[$i]['name']="";
                if($val == $right[$i]['name']) {
                  $item_select['rselect'] = " selected";
                  $item_select['rvalue'] = $right[$i]['value'];
                } else $item_select['rselect'] = "";
                $tmpl -> setCurrentBlock('item_rselect');
                $tmpl -> setVariable($item_select);
                $tmpl -> parseCurrentBlock('item_rselect');
                unset($item_select);
          }
          $tmpl -> setCurrentBlock('item_row');
          $tmpl -> setVariable("id_empty","0");
          $tmpl -> parseCurrentBlock('item_row');
        }

        $rows = $db -> getRow("SELECT * FROM items WHERE id = '$id'");

        $ref = array(
          'shops' => 'color', // принадлежность к магазинам
          'svva'  => 'photo' // характеристики товара
//          'statu' => 'photo' // свойства товара
        );

        foreach($ref as $r => $b) {
          $ra = $db -> getAll("SELECT id as ".$r."_id,name,$b FROM $r");
          if(!empty($ra)) {
                foreach($ra as $val) {
                  $check = strpos($rows[$r],"|".$val[$r."_id"]."|");
                  if($check !== false) $val['checked'] = ' checked';
                  $tmpl -> setCurrentBlock($r);
                  $tmpl -> setVariable($val);
                  $tmpl -> parseCurrentBlock($r);
                }
          }
        }

        $res = $db -> query("SELECT id,name FROM vendor WHERE status='Y' ORDER by name");
        if($res -> numRows()) {
          while($row = $res -> fetchRow()) {
                if($rows['vendor'] == $row['id']) $row['select'] = ' selected';
                $tmpl -> setCurrentBlock("vendor");
                $tmpl -> setVariable($row);
                $tmpl -> parseCurrentBlock("vendor");
          }
        }

        if(!empty($rows['photo_small'])) {
                $tmpl -> setCurrentBlock("small_photo");
                $tmpl -> setVariable('small_foto',$rows['photo_small']);
                $tmpl -> parseCurrentBlock("small_photo");
        } else {
                $tmpl -> touchBlock("no_small_photo");
        }

        if(!empty($rows['photo_small1'])) {
                $tmpl -> setCurrentBlock("small_photo1");

                $tmpl -> setVariable('small_foto1',$rows['photo_small1']);

                $tmpl -> parseCurrentBlock("small_photo1");
        } else {
                $tmpl -> touchBlock("no_small_photo1");
        }
        if(!empty($rows['photo_small2'])) {
                $tmpl -> setCurrentBlock("small_photo2");

                $tmpl -> setVariable('small_foto2',$rows['photo_small2']);

                $tmpl -> parseCurrentBlock("small_photo2");
        } else {
                $tmpl -> touchBlock("no_small_photo2");
        }






        if(!empty($rows['photo_big'])) {
                $tmpl -> setCurrentBlock("big_photo");
                $tmpl -> setVariable('big_foto',$rows['photo_big']);
                $tmpl -> parseCurrentBlock("big_photo");
        } else {
                $tmpl -> touchBlock("no_big_photo");
        }
        if(!empty($rows['photo_big1'])) {
                $tmpl -> setCurrentBlock("big_photo1");
                $tmpl -> setVariable('big_foto1',$rows['photo_big1']);
                $tmpl -> parseCurrentBlock("big_photo1");
        } else {
                $tmpl -> touchBlock("no_big_photo1");
        }
        if(!empty($rows['photo_big2'])) {
                $tmpl -> setCurrentBlock("big_photo2");
                $tmpl -> setVariable('big_foto2',$rows['photo_big2']);
                $tmpl -> parseCurrentBlock("big_photo2");
        } else {
                $tmpl -> touchBlock("no_big_photo2");
        }



//print_r ($rows);
        //$rows['name'] = htmlspecialchars($rows['name']);
        if (!isset($rows['title'])) $rows['title']="";
        //$rows['title'] = htmlspecialchars($rows['title']);
        $rows['description'] = htmlspecialchars($rows['description'], ENT_XML1, 'cp1251');

                $tmpl -> setCurrentBlock('__global__');

        $tmpl -> setVariable($rows);
        $tmpl -> setVariable('name', $rows['name']);
        $tmpl -> touchBlock("item_edit");
        $tmpl -> touchBlock("head_edit");
                $tmpl -> parseCurrentBlock();
        break;

  default:
// технические характеристики
        $right = $db -> getAssoc("SELECT id,name FROM items_ref");
        for($i=1; $i <=10; $i++) {
          foreach($right as $key => $val) {
                $item_select['rid'] = $key;
                $item_select['rname'] = $val;
                $tmpl -> setCurrentBlock('item_rselect');
                $tmpl -> setVariable($item_select);
                $tmpl -> parseCurrentBlock('item_rselect');
          }
          $tmpl -> setCurrentBlock('item_row');
          $tmpl -> parseCurrentBlock('item_row');
        }

        $ref = array(
          'shops' => 'color', // принадлежность к магазинам
          'svva'  => 'photo' // характеристики товара
//          'statu' => 'photo' // свойства товара
        );

        foreach($ref as $r => $b) {
          $ra = $db -> getAll("SELECT id as ".$r."_id,$b,name,'checked' as checked FROM $r");
          if(!empty($ra)) {
                foreach($ra as $val) {
                  if($r == 'svva') $val['checked'] = '';
                  $tmpl -> setCurrentBlock($r);
                  $tmpl -> setVariable($val);
                  $tmpl -> parseCurrentBlock($r);
                }
          }
        }

//name of manufact.
        $res = $db -> query("SELECT id,name FROM vendor WHERE status='Y' ORDER by name");
        if($res -> numRows()) {
          while($row = $res -> fetchRow()) {
          	    if (!isset($rows['vendor'])) $rows['vendor']="";
                if($rows['vendor'] == $row['id']) $row['select'] = ' selected';
                $tmpl -> setCurrentBlock("vendor");
                $tmpl -> setVariable($row);
                $tmpl -> parseCurrentBlock("vendor");
          }
        }

        if (!isset($_GET['parent'])) $_GET['parent']="";

                $tmpl -> setCurrentBlock('__global__');

        $tmpl -> setVariable('action',"add_item");
        $tmpl -> setVariable('parent',$_GET['parent']);
        $tmpl -> touchBlock('no_small_photo');
        $tmpl -> touchBlock('no_big_photo');
        $tmpl -> touchBlock('head_add');
                  $tmpl -> parseCurrentBlock();

        break;
}
if (!isset($pages)) $pages="";
$tmpl -> setVariable('pages',$pages);


function ref_items() {
        GLOBAL $_POST, $form, $db;

        $i = 0;
        $missing = array();
        foreach($_POST['rn'] as $id => $val) {
          $i++;
          if(!empty($val)) {
//                if(empty($_POST['rvalue'][$id])) continue;
                  $item_r = array(
                        id => $_POST['id'],
                        rid => $val,
                        value => $_POST['rvalue'][$id],
                        updown => $i
                  );
                  $result = $form -> add("items_value",$missing,$item_r);
          } else {
                if(empty($_POST['rvalue'][$id])) continue;
                if(empty($_POST['rnew'][$id])) continue;
// проверка на наличие такого параметра
                  $item_ref        = array (
                        id => $db -> nextID('items_ref'),
                        name => $_POST['rnew'][$id]
                  );
                  $result = $form -> add("items_ref",$missing,$item_ref);

                  $item_r = array(
                        id => $_POST['id'],
                        rid => $item_ref['id'],
                        value => $_POST['rvalue'][$id],
                        updown => $i
                  );
                  $result = $form -> add("items_value",$missing,$item_r);
          }
        }
}

?>