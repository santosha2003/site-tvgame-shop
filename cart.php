<?php
require_once("./lib/config.php");
require_once("./lib/shoppingcart.php");

$cart = new Cart;

switch($_POST[action]) {
  case "order":
        $_GET[op] = 'order';
        break;
  case "add":
        $cart -> add_item($_POST[id],$_POST[qnt]);
        header("Location: index.php?op=cart");
        exit;
        break;
  case "mass_add":
        $mass = $db -> getOne("SELECT items FROM spec WHERE id = '$_POST[id]' AND items != '' AND items != '|'");
        if(!empty($mass)) {
          $mass = explode("|",$mass);
          $size =  sizeof($mass)-1;
          for($i = 1; $i < $size; $i++) {
                $cart -> add_item($mass[$i]);
          }
        }
        header("Location: index.php?op=cart");
        exit;
        break;
  case "alldell":
          if(!empty($_POST[qnt])) {
                foreach($_POST[qnt] as $key => $val)
                  $cart -> modify_quantity($key, $val);
          }
          if(!empty($_POST[alldel])) {
                foreach($_POST[alldel] as $key => $val)
                  $cart -> delete_item($key);
          }
        header("Location: index.php?op=cart");
        exit;
        break;
  default:
        $tmpl -> loadTemplatefile("order_cart.inc",true,true);
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
          $skidka = $db ->getOne("SELECT skidka FROM users WHERE id='".$_SESSION[auth][id]."'");
          $skidka_v=$skidka*100;
          $tmpl->setVariable('price_total',$cart->cart_total());
          $tmpl->setVariable('skidka_v',$skidka_v);
          $tmpl->setVariable('delivery_total',$delivery_total);

          $tmpl->setVariable('order_total',sprintf("%.2f",($delivery_total+$cart->cart_total()*(1-$skidka))));

        } else {
          $tmpl ->touchBlock("no_list");
        }
}

?>