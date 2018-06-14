<?php
require_once("./lib/config.php");

$tmpl -> loadTemplatefile("sp.inc",true,true);

$row = $db -> getRow("SELECT *, date_format(start_date,'%d.%m.%Y') as start_date_ru, date_format(  end_date,'%d.%m.%Y') as end_date_ru FROM spec WHERE id='$_GET[spec]' AND status='Y' AND shops LIKE '%|$shop_true_id|%' AND start_date < now() AND (end_date > now() OR end_date='1970-01-01 00:00')");
if(!empty($row)) {
  if($row[end_date_ru] == '01.01.1970' OR $row[end_date_ru] == '') {
	unset($row[start_date_ru]);
	unset($row[end_date_ru]);
	$tmpl -> touchBlock('date_all');
  }

  bottom_block($row[items],"items");
  bottom_block($row[article],"article","content","shorttitle");	// связаные статьи

  $tmpl -> setVariable($row);

  if(!empty($row['items'])) $tmpl->setVariable('mass_id',$row[id]);

} else {
// редирект на страницу каталога из которого товар
  header("Location: index.php");
  exit;
}

function bottom_block($str,$field,$table='items',$title='name') {
  GLOBAL $db, $tmpl;
  
  if(!empty($str)) {
	$part = explode("|",$str);
	$size =  sizeof($part)-1;
	for($i = 1; $i < $size; $i++) {
	  $name = $db -> getOne("SELECT $title FROM $table WHERE id='$part[$i]' AND status='Y'");
	  if($table=='content') {
		if(empty($name)) $name = $db -> getOne("SELECT title FROM $table WHERE id='$part[$i]' AND status='Y'");
		$part[$i] = $db -> getOne("SELECT url FROM $table WHERE id='$part[$i]' AND status='Y'");
	  }
	  if(empty($name)) continue;
	  $tmpl -> setCurrentBlock("list_".$field);
	  $tmpl -> setVariable("id_".$field,$part[$i]);
	  $tmpl -> setVariable("name_".$field,$name);
	  $tmpl -> setVariable("mark_".$field,$mark);
	  $tmpl -> parseCurrentBlock("list_".$field);
	}
  }
  RETURN true;
}

?>