<?php
//============================
// Make Nav bar
//============================

//if (!isset ($query))  $query="";
$TotalLink = $db->getOne("SELECT COUNT(*) ".$query);

if(empty($c_pagenum)) $c_pagenum = 20;

$extra = "";
if(!empty($filter)) $extra .= "&filter=$filter";
if(!empty($nav)) $extra .= "&nav=$nav";
if(!empty($op)) $extra .= "&op=$op";
if(!empty($parent)) $extra .= "&parent=$parent";
if(!empty($extras)) $extra = $extras;

$page_num = ceil($TotalLink / $c_pagenum);

//if (!isset ($pages))  $pages=1;

if ($pages > $page_num) $pages = $page_num;

$pages = $pages ? $pages : 1;
$vstart = $c_pagenum * ($pages-1);
$page_start = floor(($pages-1)/ $c_pagenum ) * $c_pagenum; 
$page_end = $page_start + $c_pagenum; 

//if (!isset ($direct_bar))  $direct_bar=" ";
//if (!isset ($prev_list))  $prev_list=" ";
//if (!isset ($next_list))  $next_list=" ";
for ($p=$page_start+1 ; ($p <= $page_end) && ($p <= $page_num)  ; $p++ ) {
  if ($pages == $p)	$direct_bar .= " <font class=active>$p</font> ";
  else $direct_bar .= " <a href='?pages=$p$extra'>$p</a> ";
}
if ($TotalLink > $vstart+$c_pagenum ) {
  $next_p=$pages+1;
  $next_list = " <a href='?pages=$next_p$extra'>&rarr;</a>";
}
if ($pages>1) {
  $prev_p=$pages-1;
  $prev_list="<a href='?pages=$prev_p$extra'>&larr;</a> ";
}
$direct_bar = $prev_list.$direct_bar.$next_list;

?>