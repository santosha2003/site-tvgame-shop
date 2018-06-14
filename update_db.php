<?php
require_once('./lib/config.php');

$db->query("UPDATE shops SET name='Игровые товары',url='http://www.shedevr.ru/', color='D30000' WHERE id='1'");
$db->query("UPDATE shops SET name='Игровые товары',url='http://www.shedevr.ru/', color='FF6503' WHERE id='2'");

?>