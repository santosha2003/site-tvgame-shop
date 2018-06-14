<?php
require_once("./lib/config.php");

$op=$_GET['op'];
	if(isset($_GET['source']))
	
	  $content = $db->getRow("SELECT * FROM content WHERE url='$op'");
	else
	  $content = $db->getRow("SELECT * FROM content WHERE url='$op' AND shops LIKE '%$shop_true_id%'");
	  if(!empty($content)) {
		if(!empty($content[redirect])) {
// в случае отсуствия URL делать redirect только один раз
//		  $old_path = parse_url($HTTP_REFERER);
//		  $new_path = parse_url($content[redirect]);
		  if($old_path != $new_path) {
			header("Location: index.php");
			exit;
		  } else {
			header("Location: $content[redirect]");
			exit;
		  }
		}

// определяем есть ли подкатегории у этой статьи
		$article = $db -> getAll("SELECT url,title,shorttitle FROM content WHERE pid='$content[id]' AND shops LIKE '%$shop_true_id%'");
		if(empty($article) AND $content[pid] == '1') {
		  $tmpl -> loadTemplatefile("content.inc",true,true);
		} else {
		  $tmpl -> loadTemplatefile("article.inc",true,true);
		  foreach($article as $val) {
			if(empty($val[title])) $val[title] = $val[shorttitle];
			$tmpl -> setCurrentBlock('list_other');
			$tmpl -> setVariable($val);
			$tmpl -> parseCurrentBlock('list_other');
			$tmpl -> free();
		  }
		  $tmpl -> setVariable('termometr',path());
		}
		if(empty($content[title])) $content[title] = $content[shorttitle];
		unset($content[url]);
		$tmpl -> setVariable($content);
	  } else
		include("./main.php");


function path() {
 $op=$_GET['op'];
  GLOBAL $db;
  
  $row = $db -> getRow("SELECT * FROM content WHERE url='$op'");
  $children[pid] = $row[pid];
  if(empty($row[shorttitle])) $row[shorttitle] = $row[title];
  $termonetr = $row[shorttitle];
  while ($children[pid] != 0) {
    $children = $db -> getRow("SELECT * FROM content WHERE id='$children[pid]'");
	if(empty($children[shorttitle])) $children[shorttitle] = $children[title];
    $termonetr = " <a href=index.php?op=$children[url]>$children[shorttitle]</a>&nbsp;|&nbsp;". $termonetr;  }
  RETURN $termonetr;
}
?>