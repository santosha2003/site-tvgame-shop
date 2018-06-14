<?php
require_once("../lib/config.php");

//set_time_limit(0);

$offers = "";
if (!isset($SERVER_NAME)) or (empty($SERVER_NAME))  $SERVER_NAME= "shedevr.ru";
// заголовок
$content = "<?xml version=\"1.0\" encoding=\"windows-1251\"?>
<!DOCTYPE yml_catalog SYSTEM \"shops.dtd\">
<yml_catalog date=\"".date("Y-m-d H:m")."\">
<shop>
  <name>Shedevr.ru</name>
  <company>ООО \"Классификатор\"</company>
  <url>http://www.shedevr.ru/</url>
  <currencies>
    <currency id=\"RUR\" rate=\"1\"/>
  </currencies>
";

// список категорий
$content .= "
  <categories>";

viewvetka(2);

$content .= "
  </categories>

";

// список предложений
$content .= "
<offers>".
$offers
."</offers>";


$content .= "
</shop>
</yml_catalog>";

echo $content;


function viewvetka($id) {
  GLOBAL $db, $content, $offers, $shop_true_id, $SERVER_NAME;

  $result = $db -> query("SELECT id,parent,name FROM category WHERE parent='$id' AND status='Y' AND market_show='Y' ORDER BY updown");
  while($row = $result -> fetchRow()) {
        $list[] = $row;
  }
  if (!empty($list)) {
        foreach($list as $cat) {
	$c_id=$cat['id'];
	$c_name=$cat['name'];
	$c_parr=$cat['parent'];
                if($cat['parent'] != '2')  $ppparent = " parentId=\"$c_parr\"";
                else $ppparent = "";
            $content .= "
    <category id=\"$c_id\"".$ppparent.">".htmlspecialchars($c_name,ENT_QUOTES)."</category>";
// список предложений
          $res = $db -> query("SELECT id,name,model,vendor,price,photo_small,description FROM items WHERE cid='$c_id' AND status='Y' AND market_show='Y' AND shops LIKE '%|$shop_true_id|%'");
          if($res -> numRows()) {
                while($item = $res -> fetchRow()) {
                  if(!empty($item['vendor'])) {
// определение производителя и типа модели поиска
		    $item_ven=$item['vendor'];
                        $vendor = $db -> getOne("SELECT name FROM vendor WHERE id='$item_ven'");
                        if(!empty($vendor)) {
                          $vendor = htmlspecialchars($vendor,ENT_QUOTES);
                          $offers .= "
  <offer available=\"true\" id=\"$item['id']\" type=\"vendor.model\">";

                        } else {
                          $offers .= "
  <offer available=\"true\" id=\"$item['id']\" type=\"vendor.model\">";
                        }
                  } else {
                        $vendor = "Не указан";
                        $offers .= "
  <offer available=\"true\" id=\"$item['id']\" type=\"vendor.model\">";
                  }
                  $offers .= "
        <url>http://$SERVER_NAME/index.php?id=$item['id']</url>
        <price>$item[price]</price>
        <currencyId>RUR</currencyId>
        <categoryId>$cat[id]</categoryId>";
                  if(!empty($item['photo_small'])) $offers .= "
        <picture>http://$SERVER_NAME/images/photo/$item[photo_small]</picture>";
/*
                  $offers .= "
        <orderingTime>
          <ordering>Доставка по Москве в течении 1-3 дней от момента оформления заказа</ordering>
        </orderingTime>";
*/
                  if(strlen($item['name']) >= 255) $item['name'] = substr($item['name'], 0, 252)."...";
                  $offers .= "
        <typePrefix>".htmlspecialchars($item['name'],ENT_QUOTES)."</typePrefix>";

                  if(!empty($vendor)) {
                        $offers .= "
        <vendor>$vendor</vendor>
         <model>".htmlspecialchars($item['model'],ENT_QUOTES)."</model>";
                  }else{
                 $offers .= "
        <vendor>$vendor</vendor>
        <model>Не указана</model>";
                }

                  if(!empty($item['description'])){
                        if(strlen($item['description']) >= 255) $item['description'] = substr($item['description'], 0, 252)."...";
                        $offers .= "
        <description>".htmlspecialchars(strip_tags($item['description']),ENT_QUOTES)."</description>";
                  $offers .= "


  </offer>

";
 }else{
 $offers .= "
        <description>Не указан</description>";
                  $offers .= "


  </offer>

";

 }


                }
          }
          viewvetka($cat['id']);
        }
  }
}


?>