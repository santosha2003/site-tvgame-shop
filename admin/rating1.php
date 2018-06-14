<?php
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}

switch($_GET['action']) {
  case "del":
        $res = $db -> query("UPDATE items SET $_GET[source]=REPLACE($_GET[source],'|".$_GET[shop]."|','|') WHERE id = '$_GET[id]'");
        $res = $db -> query("UPDATE items SET $_GET[source]=REPLACE($_GET[source],'||','|') WHERE $_GET[source] LIKE '%||%'");
        $res = $db -> query("UPDATE items SET $_GET[source]='' WHERE $_GET[source] = '|'");
        $res = $db -> query("DELETE FROM description WHERE shop='$_GET[shop]' AND id='$_GET[id]' AND source='ud_".$_GET[source]."'");
        header("Location: rating1.php?action=$_GET[source]");
        exit;
        break;
  case "statu":
        $tmpl -> loadTemplatefile("statu.inc",true,true);
        $field = "statu";
          break;
  case "rating1":
        $tmpl -> loadTemplatefile("rating1.inc",true,true);
        $field = "ratings";
          break;
}

switch($_GET['action']) {
  case "up":
  $cur = $db -> getAssoc("SELECT id,description FROM description WHERE id='$_GET[id]' AND shop='$_GET[shop]' AND source='ud_".$_GET['source']."' ORDER BY description ASC");
  list($cur_id,$cur_descr) = each($cur);
  $result = $db -> getCol("SELECT id,description FROM description WHERE shop='$_GET[shop]' AND source='ud_".$_GET['source']."' ORDER BY description");
  $ups = array_search($_GET['id'],$result);
  $next_id = $result[$ups-1];
  $next_descr = $db -> getOne("SELECT description FROM description WHERE id='$next_id' AND shop='$_GET[shop]' AND source='ud_".$_GET['source']."' ORDER BY description");

if(!empty($next_id)) {
  $res = $db -> query("UPDATE description SET description='$cur_descr' WHERE id='$next_id' AND shop='$_GET[shop]' AND source='ud_".$_GET['source']."'");
  $res = $db -> query("UPDATE description SET description='$next_descr' WHERE id='$cur_id' AND shop='$_GET[shop]' AND source='ud_".$_GET['source']."'");
}
        $tmpl -> loadTemplatefile($_GET['source'].".inc",true,true);
        $field = $_GET['source'];
        $_GET['action'] = $_GET['source'];
        break;

  case "down":
  $cur = $db -> getAssoc("SELECT id,description FROM description WHERE id='$_GET[id]' AND shop='$_GET[shop]' AND source='ud_".$_GET['source']."'");
  list($cur_id,$cur_descr) = each($cur);
  $result = $db -> getCol("SELECT id,description FROM description WHERE shop='$_GET[shop]' AND source='ud_".$_GET['source']."' ORDER BY description");
  $ups = array_search($_GET['id'],$result);
  $next_id = $result[$ups+1];
  $next_descr = $db -> getOne("SELECT description FROM description WHERE id='$next_id' AND shop='$_GET[shop]' AND source='ud_".$_GET['source']."' ORDER BY description");

if(!empty($next_id)) {
  $res = $db -> query("UPDATE description SET description='$cur_descr' WHERE id='$next_id' AND shop='$_GET[shop]' AND source='ud_".$_GET['source']."'");
  $res = $db -> query("UPDATE description SET description='$next_descr' WHERE id='$cur_id' AND shop='$_GET[shop]' AND source='ud_".$_GET['source']."'");
}
        $tmpl -> loadTemplatefile($_GET['source'].".inc",true,true);
        $field = $_GET['source'];
        $_GET['action'] = $_GET['source'];
        break;

}

$shops = $db -> getAll("SELECT * FROM shops ORDER BY id");
$count = round((100/sizeof($shops)));
if(!empty($shops)) {
  foreach($shops as $shop) {
        $shop['count'] = $count;
        $tmpl -> setCurrentBlock("shop");
        $tmpl -> setVariable($shop);
        $tmpl -> parseCurrentBlock("shop");
        $res = $db -> query("SELECT a.id as ids,a.name as names,a.mark,a.model,b.description FROM items a LEFT JOIN description b ON (a.id=b.id AND b.shop='".$shop['id']."' AND b.source='ud_".$_GET['action']."') WHERE $field!='' AND $field LIKE '%|".$shop['id']."|%' ORDER BY b.description");
        if($res -> numRows()) {
          while($row = $res -> fetchRow()) {
                $row['shop_id'] = $shop['id'];
                $tmpl -> setCurrentBlock("list");
                $tmpl -> setVariable($row);
                $tmpl -> parseCurrentBlock("list");
          }
        } else {
          $tmpl -> touchBlock("no_list");
        }
        $tmpl -> setCurrentBlock("rating");
        $tmpl -> setVariable("tdid",$shop['id']);
        $tmpl -> parseCurrentBlock("rating");
        $tmpl -> free();
  }
}

$tmpl -> setVariable("size",sizeof($shops));
$tmpl->parse();
$tmpl->show();

?>