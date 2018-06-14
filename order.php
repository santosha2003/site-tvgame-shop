<?php
require_once("./lib/config.php");
require_once("./lib/shoppingcart.php");

$cart = new Cart;

if (!$a->getAuth()) {
  $_SESSION['www_users_ing'][op] = 'cart';
  header("Location: index.php?op=reg");
  exit;
}

$tmpl -> loadTemplatefile("order_checkout.inc",true,true);
$content = $cart -> display_contents();
if(!empty($content)) {
  foreach($content as $val) {
$sp = $db -> getRow("SELECT items FROM spec WHERE items LIKE '%|$val[id]|%' AND status='Y' AND shops LIKE '%|$shop_true_id|%' AND start_date < now() AND (end_date > now() OR end_date='1970-01-01 00:00')");
if(!empty($sp)) $val[sp] = "<img src=images/icon_sp.gif width=25 height=25>";
        $tmpl -> setCurrentBlock('list_items');
        $tmpl -> setVariable($val);
        $tmpl -> parseCurrentBlock('list_items');
  }
  if($cart->cart_total() <= 200000) $delivery_total="300.00";
          else $delivery_total="0.00";
          /*
          if($cart->cart_total() < 15000) {  $skidka_total="1";
          $skidka_visual="0";}
          if(($cart->cart_total() >= 15000) AND ($cart->cart_total() < 25000)){  $skidka_total="0.97";
          $skidka_visual="3";}
          if(($cart->cart_total() >= 25000) AND ($cart->cart_total() < 30000)){  $skidka_total="0.93";
          $skidka_visual="7"; }
          if($cart->cart_total() >= 30000) { $skidka_total="0.90";
          $skidka_visual="10";}
          */
          $tmpl->setVariable('price_total',$cart->cart_total());

           $skidka= $db ->getOne("SELECT skidka FROM users WHERE id='".$_SESSION[auth][id]."'");
          $skidka_v=$skidka*100;
          $tmpl->setVariable('skidka_v',$skidka_v);
          $tmpl->setVariable('delivery_total',$delivery_total);
          $tmpl->setVariable('order_total',sprintf("%.2f",($delivery_total+$cart->cart_total()*(1-$skidka))));
} else {
  $tmpl ->touchBlock("no_list");
}

if(!empty($content)) {
  $row = $db -> getRow("SELECT * FROM users WHERE id='".$_SESSION[auth][id]."'");
  for($i=0; $i <= 5; $i++) {
        $date = mktime(0,0,0,date('n'),date('j')+$i,date('Y'));
        $value[date] = date("Y-m-d 00:00:00",$date);
        $value[date_ru] = date("d.m.Y",$date);
        $tmpl -> setCurrentBlock('select_date');
        $tmpl -> setVariable($value);
        $tmpl -> parseCurrentBlock('select_date');
  }
  $tmpl -> setVariable($row);
}