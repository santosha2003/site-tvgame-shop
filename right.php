<?php
require_once("./lib/config.php");

if(empty($_GET) AND empty($_POST)) {
  $tmpl -> loadTemplatefile('right/main.inc',true,true);
  $res = $db -> query("SELECT a.id,a.name,a.model,a.price FROM items a LEFT JOIN description b ON (a.id=b.id AND b.source='ud_rating' AND b.shop='$shop_true_id') WHERE a.shops LIKE '%|$shop_true_id|%' AND a.rating LIKE '%|$shop_true_id|%' AND status='Y' ORDER BY b.description");
  if($res -> numRows()) {
        $count = 0;
        while($row = $res -> fetchRow()) {
          $row[count] = ++$count;
          if(empty($row[price])) unset($row[price]);
          $tmpl -> setCurrentBlock('list');
          $tmpl -> setVariable($row);
          $tmpl -> parseCurrentBlock('list');
        }
  } else {
        $tmpl -> touchBlock('no_list');
  }

} else {

  $tmpl -> loadTemplatefile('right/other.inc',true,true);
  $res = $db -> query("
SELECT
  a.id,
  a.name,
  a.price,
  a.photo_small,
  b.description
FROM
  items a
LEFT JOIN
  description b ON (a.id=b.id AND b.source='new' AND b.shop='$shop_true_id')
WHERE
  new LIKE '%|$shop_true_id|%'
  AND
  shops LIKE '%|$shop_true_id|%'
  AND
  status='Y'
ORDER BY RAND()
LIMIT 3
");
  if($res -> numRows()) {
        while($row = $res -> fetchRow()) {
          $row[photo_small] = photo_name($row[photo_small]);
          $row[wh] = photo_size($row[photo_small],150,150);
          $tmpl -> setCurrentBlock('list_news');
          $tmpl -> setVariable($row);
          $tmpl -> parseCurrentBlock('list_news');
        }
        $tmpl -> setCurrentBlock('news');
        $tmpl -> parseCurrentBlock('news');
        $tmpl -> free();
  }

  $res = $db -> query("SELECT a.id,a.name,a.price,a.photo_small,a.statu,b.description FROM items a LEFT JOIN description b ON (a.id=b.id AND b.source='items' AND b.shop='$shop_true_id') WHERE statu LIKE '%-$shop_true_id|%' AND shops LIKE '%|$shop_true_id|%' AND status='Y' ORDER BY RAND() LIMIT 3");
  if($res -> numRows()) {
        while($row = $res -> fetchRow()) {
          $statu = explode("|",$row[statu]);
          foreach($statu as $val) {
                if(empty($val)) continue;
                $val = (explode("-",$val));
                if($val[1] == "$shop_true_id") {
                  $row[statu] = $db->getOne("SELECT name FROM statu WHERE id='$val[0]'");
                  if(!empty($row[statu])) break;
                }
          }
          $row[photo_small] = photo_name($row[photo_small]);
          $row[wh] = photo_size($row[photo_small],150,150);
          $tmpl -> setCurrentBlock('list_season');
          $tmpl -> setVariable($row);
          $tmpl -> parseCurrentBlock('list_season');
        }
        $tmpl -> setCurrentBlock('season');
        $tmpl -> parseCurrentBlock('season');
        $tmpl -> free();
  }

  $res = $db -> query("SELECT id,name,items FROM spec WHERE status='Y' AND shops LIKE '%|$shop_true_id|%' AND items != '' AND items != '|' AND start_date < now() AND (end_date > now() OR end_date='1970-01-01 00:00')");
  if($res -> numRows()) {
        while($row = $res -> fetchRow()) {
          $items = explode("|",$row[items]);
          $id = rand(1,sizeof($items)-2);
          $items = $db -> getRow("SELECT id,photo_small,price FROM items WHERE id='$items[$id]' AND status='Y'");
          $row[price] = $items[price];
            $row[id] = $items[id];
          $row[photo_small] = photo_name($items[photo_small]);
          $row[wh] = photo_size($row[photo_small],150,150);
          $tmpl -> setCurrentBlock('list_spec');
          $tmpl -> setVariable($row);
          $tmpl -> parseCurrentBlock('list_spec');
          $tmpl -> free();
        }
        $tmpl -> setCurrentBlock('spec');
        $tmpl -> parseCurrentBlock('spec');
        $tmpl -> free();
  }

}

?>