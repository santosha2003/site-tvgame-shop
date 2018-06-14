<?php
require_once("./lib/config.php");
if(empty($_COOKIE['ShoppingCart'])) {
  require_once("./lib/shoppingcart.php");
}


$scart = $_COOKIE['ShoppingCart'];
$_COOKIE['www_users_ing'] = HTTP_Session2::id();

$pos = strpos($_GET['url'], "?");
if ($pos === false) {
  $_GET[url] .= "?";
} else {
  $_GET[url] .= "&";
}

header("Location: http://" . $_GET['url'] . "scart=" . $_COOKIE['ShoppingCart'] . "&sid=" . $_COOKIE['www_users_ing']);
exit;
?>