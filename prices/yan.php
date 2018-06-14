<?
require_once("../lib/config.php");

//set_time_limit(0);

$offers = "";

// заголовок
$content = "<?xml version=\"1.0\" encoding=\"windows-1251\"?>
<!DOCTYPE yml_catalog SYSTEM \"shops.dtd\">
<yml_catalog date=\"".date("Y-m-d h:m")."\">
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

  $result = $db -> query("SELECT id,parent,name FROM category WHERE parent='$id' AND status='Y' ORDER BY updown");
  while($row = $result -> fetchRow()) {
        $list[] = $row;
  }
  if (!empty($list)) {
        foreach($list as $cat) {
                if($cat['parent'] != '2')  $ppparent = " parentId=\"$cat[parent]\"";
                else $ppparent = "";
            $content .= "
    <category id=\"$cat[id]\"".$ppparent.">".htmlspecialchars($cat[name],ENT_QUOTES)."</category>";
// список предложений
          $res = $db -> query("SELECT id,name,model,vendor,price,photo_small,description FROM items WHERE cid='$cat[id]' AND status='Y' AND shops LIKE '%|$shop_true_id|%'");
          if($res -> numRows()) {
                while($item = $res -> fetchRow()) {
                  if(!empty($item[vendor])) {
// определение производителя и типа модели поиска
                        $vendor = $db -> getOne("SELECT name FROM vendor WHERE id='$item[vendor]'");
                        if(!empty($vendor)) {
                          $vendor = htmlspecialchars($vendor,ENT_QUOTES);
                          $offers .= "
  <offer id=\"$item[id]\" type=\"vendor.model\">";

                        } else {
                          $offers .= "
  <offer id=\"$item[id]\">";
                        }
                  } else {
                        $vendor = "";
                        $offers .= "
  <offer id=\"$item[id]\">";
                  }
                  $offers .= "
        <url>http://$SERVER_NAME/index.php?id=$item[id]</url>
        <price>$item[price]</price>
        <currencyId>RUR</currencyId>
        <categoryId>$cat[id]</categoryId>";
                  if(!empty($item[photo_small])) $offers .= "
        <picture>http://$SERVER_NAME/images/photo/$item[photo_small]</picture>";
/*
                  $offers .= "
        <orderingTime>
          <ordering>Доставка по Москве в течении 1-3 дней от момента оформления заказа</ordering>
        </orderingTime>";
*/
                  if(strlen($item[name]) >= 255) $item[name] = substr($item[name], 0, 252)."...";
                  $offers .= "
        <typePrefix>".htmlspecialchars($item[name],ENT_QUOTES)."</typePrefix>";

                  if(!empty($vendor)) {
                        $offers .= "
        <vendor>$vendor</vendor>
        <model>".htmlspecialchars($item[model],ENT_QUOTES)."</model>";
                  }


                  if(!empty($item[description]))
                        if(strlen($item[description]) >= 255) $item[description] = substr($item[description], 0, 252)."...";
                        $offers .= "
        <description>".htmlspecialchars(strip_tags($item[description]),ENT_QUOTES)."</description>";
                  $offers .= "
  </offer>

";

                }
          }
          viewvetka($cat[id]);
        }
  }
}


?>