<?php
require_once("./lib/config.php");

$tmpl -> loadTemplatefile("main.inc",true,true);

$limit = (int)$db ->getOne("SELECT value FROM settings WHERE id=80");
if(!$limit) $limit = 5;

$new = $db -> getAll("SELECT a.id,a.name,a.photo_small,a.price,a.model,a.cid FROM items a LEFT JOIN description b ON (a.id=b.id AND b.shop='$shop_true_id' AND b.source='ud_new') WHERE a.status='Y' AND a.new LIKE '%|$shop_true_id|%' AND a.shops LIKE '%|$shop_true_id|%' ORDER BY b.description LIMIT $limit");
$statu = $db -> getAll("SELECT a.id,a.name,a.photo_small,a.price,a.model,a.cid FROM items a RIGHT JOIN description b ON (a.id=b.id AND b.shop='$shop_true_id' AND b.source='ud_statu') WHERE a.status='Y' AND a.statu LIKE '%|$shop_true_id|%' AND a.shops LIKE '%|$shop_true_id|%' ORDER BY b.description LIMIT $limit");

//("SELECT id,name,photo_small,price,statu,model FROM items WHERE status='Y' AND statu LIKE '%-$shop_true_id|%' LIMIT $limit");

for($i=0; $i<$limit; $i++) {
  if(!empty($new[$i])) {

        $new[$i][photo_small] = photo_name($new[$i][photo_small]);

        $new[$i][wh] = photo_size($new[$i][photo_small],150,150);
        $new[$i][description] = $db -> getOne("SELECT description FROM description WHERE id='".$new[$i][id]."' AND shop='$shop_true_id' AND source='new'");
         $new[$i][imya] = $db -> getOne("SELECT name FROM category WHERE id='".$new[$i][cid]."'");
        $tmpl -> setCurrentBlock("list_new");
        $tmpl -> setVariable($new[$i]);
        $tmpl -> parseCurrentBlock("list_new");
  } else {
        unset($new);
  }
  if(!empty($statu[$i])) {
        $statu[$i][photo_small] = photo_name($statu[$i][photo_small]);
        $statu[$i][wh] = photo_size($statu[$i][photo_small],150,150);
        $statu[$i][description] = $db -> getOne("SELECT description FROM description WHERE id='".$statu[$i][id]."' AND shop='$shop_true_id' AND source='statu'");
        $statu[$i][imya] = $db -> getOne("SELECT name FROM category WHERE id='".$statu[$i][cid]."'");
        $tmpl -> setCurrentBlock("list_season");
        $tmpl -> setVariable($statu[$i]);
        $tmpl -> parseCurrentBlock("list_season");
  } else {
        unset($statu);
  }
  if(!isset($new) AND !isset($statu)) {
        if($i==0) {
          $tmpl -> touchBlock("no_list_new");
          $tmpl -> touchBlock("no_list_season");
        } else{
          $tmpl -> free();
        }
        break;
  } else {
        if(!isset($new)) $tmpl -> touchBlock("no_list_new");
        if(!isset($statu)) $tmpl -> touchBlock("no_list_season");
        $tmpl -> setCurrentBlock("main_first");
        $tmpl -> parseCurrentBlock("main_first");
        $tmpl -> free();
  }
}


$limit = (int)$db ->getOne("SELECT value FROM settings WHERE id=85");
if(!$limit) $limit = 4;


$spec = $db -> getAll("
  SELECT
        *
  FROM
        spec
  WHERE
        status='Y'
  AND
        shops LIKE '%|$shop_true_id|%'
  AND
        items != ''
  AND
        items != '|'
  AND
        start_date < now()
  AND
        (
          end_date > now()
        OR
          end_date='1970-01-01 00:00'
        )
  LIMIT $limit
");

if(!empty($spec)) {
for($i=0; $i<$limit; $i++) {
  if(!empty($spec[$i])) {

        $items = explode("|",$spec[$i][items]);
        $id = rand(1,sizeof($items)-2);
        $items = $db -> getRow("SELECT photo_small,price,id,cid FROM items WHERE id='$items[$id]' AND status='Y'");
        $spec[$i][price] = $items[price];
        $spec[$i][id]=$items[id];
       $spec[$i][cid] = $items[cid];


$spec[$i][photo_small] = photo_name($items[photo_small]);
        $spec[$i][wh] = photo_size($spec[$i][photo_small],150,150);
 $item = explode("|",$spec[$i][imya]);
 $item = $db -> getRow("SELECT name FROM category WHERE id='$items[cid]' AND status='Y'");
  $spec[$i][imya] = $item[name];


$tmpl -> setCurrentBlock("list_spec1");
        $tmpl -> setVariable($spec[$i]);

        $tmpl -> parseCurrentBlock("list_spec1");

 } else {
        unset($spec);
        $tmpl -> touchBlock("no_list_spec1");
  }
















  $i++;
  if(!empty($spec[$i])) {
        $items = explode("|",$spec[$i][items]);
        $id = rand(1,sizeof($items)-2);
        $items = $db -> getRow("SELECT photo_small,price,id,cid FROM items WHERE id='$items[$id]' AND status='Y'");
        $spec[$i][price] = $items[price];
        $spec[$i][photo_small] = photo_name($items[photo_small]);
        $spec[$i][wh] = photo_size($spec[$i][photo_small],150,150);
         $spec[$i][id]=$items[id];
        $spec[$i][cid] = $items[cid];
       $item = explode("|",$spec[$i][imya]);
 $item = $db -> getRow("SELECT name FROM category WHERE id='$items[cid]' AND status='Y'");
  $spec[$i][imya] = $item[name];
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
}

?>