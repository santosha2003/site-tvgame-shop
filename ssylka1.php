<?
require_once('./lib/config.php');
$petia = 5;
session_register('petia');

$a = new Auth("DB",$users_params,false,false);
$a -> setSessionname("www_users_ing");
$a -> start(); ?>





<p><a href="http://www.shedevr.ru/print.php?id=126">ссылка на id=126</a></p>