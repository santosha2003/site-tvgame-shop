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

viewvetka(2);

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
  GLOBAL $db, $offers, $shop_true_id, $SERVER_NAME;
  
  $result = $db -> query("SELECT id,parent,name FROM category WHERE parent='$id' AND status='Y' ORDER BY updown");
  while($row = $result -> fetchRow()) {
	$list[] = $row;
  }
  if (!empty($list)) {
	foreach($list as $cat) {
// список предложений
	  $res = $db -> query("SELECT id,name,model,vendor,price,photo_small,description FROM items WHERE cid='$cat[id]' AND status='Y' AND shops LIKE '%|$shop_true_id|%'");
	  if($res -> numRows()) {
		while($item = $res -> fetchRow()) {
		  if(strlen($item[name]) >= 255) $item[name] = substr($item[name], 0, 252)."...";
		  $offers .= "
<offer id=\"$item[id]\">
	<category>$cat[name]</category>
	<title>".htmlspecialchars($item[name],ENT_QUOTES)."</title>
	<price>$item[price]</price>
	<currencyId>RUR</currencyId>
	<url>http://$SERVER_NAME/index.php?id=$item[id]</url>";
		  if(!empty($item[photo_small])) $offers .= "
	<img>http://$SERVER_NAME/images/photo/$item[photo_small]</img>";
// определение производителя
		  if(!empty($item[vendor])) {
			$vendor = $db -> getOne("SELECT name FROM vendor WHERE id='$item[vendor]'");
			if(!empty($vendor)) {
			  $vendor = htmlspecialchars($vendor,ENT_QUOTES);
			  $offers .= "
	<produceby>$vendor</produceby>";
			}
		  }
		  if(!empty($item[description])) {
			if(strlen($item[description]) >= 255) $item[description] = substr($item[description], 0, 252)."...";
			$offers .= "
	<description>".htmlspecialchars(strip_tags($item[description]),ENT_QUOTES)."</description>";
		  }
		  $ref = $db -> query("SELECT a.name as ref_name, b.value as ref_value FROM items_ref a, items_value b WHERE b.id='$item[id]' AND b.rid=a.id AND a.status='Y' ORDER BY b.updown");
		  if($ref -> numRows()) {
			$i=0;
			while($arr = $ref -> fetchRow()) {
			  $offers .= "
	<param".$i.">".$arr[ref_name]." - ".$arr[ref_value]."</param".$i.">";
			  $i++;
			}
		  }
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