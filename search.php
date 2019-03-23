<?php
//php5.6
require_once("./lib/config.php");
$op="search";
//$type="name";
$x=0;
$y=0;
//$search="";
echo "<pre>";
print_r ($_GET);
echo "</pre>";
if (isset ($_GET['pages'])) $pages =$_GET['pages']; else $pages=1;
if(isset ($_GET['search'])) { $search = $_GET['search']; }
elseif(isset($_POST['search'])) { $search = $_POST['search']; $pages= $_POST['pages']; }
elseif (isset($_SESSION['sess_search']['search'])) $search = $_SESSION['sess_search']['search'];
else $search = "items";

if(isset($_GET['type'])) { $type = $_GET['type']; $pages= $_GET['pages']; }
elseif(isset($_POST['type'])) { $type = $_POST['type']; $pages= $_GET['pages']; }
elseif (isset($_SESSION['sess_search']['type'])) $type = $_SESSION['sess_search']['type'];
else $type = "name";

if(isset($_GET['pages'])) $pages = $_GET['pages'];
elseif (isset($_SESSION['sess_search']['pages'])) $pages = $_SESSION['sess_search']['pages'];
//else //$pages = "1";

if(isset($_GET['logic'])) $logic = $_GET['logic'];
elseif(isset($_POST['logic'])) $logic = $_POST['logic'];
elseif (isset($_SESSION['sess_search']['logic'])) $logic = $_SESSION['sess_search']['logic'];
else $logic = "AND";

$_SESSION['sess_search'] = array(
  search => $search,
    type => $type,
   pages => $pages,
   logic => $logic
);

// подготовка строки поиска
$search = substr($search,0,64);
$search = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search);
$search1 = trim(preg_replace("/\s(\S{1,3})\s/", " ", preg_replace("/ +/", "  ",$search)));
$search1 = ereg_replace(" +", " ", $search1);
$search1 = explode(" ",$search1);
// подготовка запроса

$table = "items";
$where = "";
if($type == 'brand') {
  $where1 = "";
  foreach ($search1 as $sea) {
	$where1 .= " name LIKE '%$sea%' AND ";
  }
  if(!empty($where1)) $where1 = substr($where1,0,-4)." AND status='Y'";
  $ops = $db -> getCol("SELECT id FROM vendor WHERE ".$where1);
  if(!empty($ops)) {
	foreach($ops as $sea)
	  $where .= "vendor = '$sea' OR ";
	$where = substr($where,0,-4)." AND status='Y' AND shops LIKE '%|$shop_true_id|%'";
  } else $where = "vendor = '-1'";

} else {
  $items = array(
	name,
	description
  );
  foreach ($search1 as $sea) {
	$where1 = "";
	if(is_array($items)) {
	  foreach($items as $val) {
		$where1 .= $val." LIKE '%$sea%' OR ";
	  }
	}
	if(!empty($where1)) $where1 = substr($where1,0,-4);
	if(!empty($where1)) $where .= "(".$where1.") ".$logic." ";
  }
  if(!empty($where)) $where = substr($where,0,-4)." AND status='Y' AND shops LIKE '%|$shop_true_id|%'";
}

$tmpl -> loadTemplatefile('search.inc',true,true);

//echo $where;

$order = ' ORDER BY id DESC ';
$query = " FROM $table WHERE $where";

include("./nav_bar.php");
$res = $db -> query("SELECT * ".$query.$order." LIMIT $vstart,$c_pagenum");

if($res -> numRows()) {
  while($row = $res -> fetchRow()) {
	$row['site'] = "http://".$_SERVER['$HTTP_HOST'].$_SERVER['PHP_SELF'];
	if(strlen($row['description']) > 160) {
	  $row['description'] = wordwrap(strip_tags($row['description']),160);
	  $explo = explode("\n",$row['description']);
	  $row['description'] = $explo[0]." ...";
	}
	$id_vendor=$row['vendor'];
	$row['vendor'] = $db -> getOne("SELECT name FROM vendor WHERE id='$id_vendor' AND status='Y'");
    $tmpl -> setCurrentBlock("list");
    $tmpl -> setVariable($row);
    $tmpl -> parseCurrentBlock("list");
//    $tmpl -> free();
  }
} else {
  $tmpl -> touchBlock("no_list");
}

$tmpl -> setVariable('num',$TotalLink);
$tmpl -> setVariable('search',$search);
if ($direct_bar != " <font class=active>1</font> " AND !empty($direct_bar)) $tmpl -> setVariable('nav_bar',$direct_bar);


/*
SELECT 
  title, 
  IF(text like '%word1 word2 word3%', 3*10, 0) + 
  IF(text LIKE '%word1%', 9, 0) + 
  IF(text LIKE '%word2%', 9, 0) + 
  IF(text LIKE '%word3%', 9, 0) AS relevance 
FROM table 
WHERE 
  text LIKE '%word1%' 
  OR 
  text LIKE '%word2%' 
  OR 
  text LIKE '%word3%' 
*/

?>

