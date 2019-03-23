<?php
require_once("./lib/config.php");

 $tmpl -> loadTemplatefile("links_add.inc",true,true);
$row = $db -> getAll("SELECT * FROM links_catalog");
if(!empty($row)) {
  foreach($row as $val) {
        $tmpl -> setCurrentBlock('select');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('select');
    //    $tmpl -> free();
  }
}

?>