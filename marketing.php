<?php
require_once("./lib/config.php");

$tmpl -> loadTemplatefile("marketing.inc",true,true);

switch($_GET[op]) {
  case "new":
        $spec = $db -> getAll("SELECT id,name,photo_small,price,mark FROM items WHERE status='Y' AND new LIKE '%|$shop_true_id|%' AND shops LIKE '%|$shop_true_id|%' ORDER BY mark");
        $url = "id=";
        $descr = "new";
        break;
  case "season":
        $spec = $db -> getAll("SELECT id,name,photo_small,price,statu,mark FROM items WHERE status='Y' AND statu LIKE '%-$shop_true_id|%' AND shops LIKE '%|$shop_true_id|%' ORDER BY statu");
        $url = "id=";
        $descr = "items";
        break;
  default:
        $spec = $db -> getAll("SELECT id,name,items FROM spec WHERE status='Y' AND shops LIKE '%|$shop_true_id|%' AND items != '' AND items != '|' AND start_date < now() AND (end_date > now() OR end_date='1970-01-01 00:00')");
        $url = "spec=";
        $descr = "";
        break;
}

$limit = sizeof($spec);
for($i=0; $i<$limit; $i++) {
  if(!empty($spec[$i])) {
        if($_GET[op] == 'spec') {
          $items = explode("|",$spec[$i][items]);
          $id = rand(1,sizeof($items)-2);
          $items = $db -> getRow("SELECT photo_small,price FROM items WHERE id='$items[$id]'");
          $spec[$i][price] = $items[price];
          $spec[$i][photo_small] = $items[photo_small];
        } else {
          $spec[$i][description] = $db -> getOne("SELECT description FROM description WHERE id='".$spec[$i][id]."' AND shop='$shop_true_id' AND source='$descr'");
        }
        $spec[$i][photo_small] = photo_name($spec[$i][photo_small]);
        $spec[$i][wh] = photo_size($spec[$i][photo_small],150,150);
        $spec[$i][id] = $url.$spec[$i][id];
        $tmpl -> setCurrentBlock("list_spec1");
        $tmpl -> setVariable($spec[$i]);
        $tmpl -> parseCurrentBlock("list_spec1");
  } else {
        unset($spec);
        $tmpl -> touchBlock("no_list_spec1");
  }
  $i++;
  if(!empty($spec[$i])) {
        if($_GET[op] == 'spec') {
          $items = explode("|",$spec[$i][items]);
          $id = rand(1,sizeof($items)-2);
          $items = $db -> getRow("SELECT photo_small,price FROM items WHERE id='$items[$id]'");
          $spec[$i][price] = $items[price];
          $spec[$i][photo_small] = $items[photo_small];
          $spec[$i][description] = $db -> getRow("SELECT description FROM description WHERE id='".$spec[$i][id]."' AND shop='$shop_true_id' AND source='$descr'");  
        } else {
          $spec[$i][description] = $db -> getOne("SELECT description FROM description WHERE id='".$spec[$i][id]."' AND shop='$shop_true_id' AND source='$descr'");
        }
        $spec[$i][photo_small] = photo_name($spec[$i][photo_small]);
        $spec[$i][wh] = photo_size($spec[$i][photo_small],150,150);
        $spec[$i][id] = $url.$spec[$i][id];
        $tmpl -> setCurrentBlock("list_spec2");
        $tmpl -> setVariable($spec[$i]);
        $tmpl -> parseCurrentBlock("list_spec2");
  } else {
        unset($spec);
        $tmpl -> touchBlock("no_list_spec2");
  }

  if(!isset($spec)) {
        if($i==0) {
          $tmpl -> setCurrentBlock("main_second");
          $tmpl -> parseCurrentBlock("main_second");
          $tmpl -> free();
        } elseif($i==1) {
          $tmpl -> setCurrentBlock("main_second");
          $tmpl -> parseCurrentBlock("main_second");
          $tmpl -> free();
        } else {
    $tmpl -> free();
        }
        break;
  } else {
        $tmpl -> setCurrentBlock("main_second");
        $tmpl -> parseCurrentBlock("main_second");
        $tmpl -> free();
  }
}

switch($_GET[op]) {
  case "new":
        $tmpl -> touchBlock('new');
        break;
  case "season":
        $tmpl -> touchBlock('season');
        break;
  default:
        $tmpl -> touchBlock('spec');
        break;
}

?>