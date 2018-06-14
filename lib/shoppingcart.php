<?php
$a = new Auth("DB",$users_params,false,false);
$a -> setSessionname("www_users_ing");
$a -> start();



if ($a->getAuth()) {
  $session = md5($a -> getUsername());
  if($_COOKIE[ShoppingCart] != $session) {
	if(!empty($_COOKIE[ShoppingCart])) 
  	  $res = $db -> query("UPDATE shoppingcart SET session='$session' WHERE session='$_COOKIE[ShoppingCart]'");
	$_COOKIE[ShoppingCart] = $session;
	SetCookie( "ShoppingCart", $_COOKIE[ShoppingCart], time()+31536000);
	$ar = $db -> getAll("SELECT product,MAX(quantity) as quantity FROM shoppingcart WHERE session='$session' GROUP BY product");
	$res = $db -> query("DELETE FROM shoppingcart WHERE session='$session'");
	if(!empty($ar) AND is_array($ar)) {
	  $cart = new Cart;
	  foreach($ar as $val)
		$cart -> add_item($val[product],$val[quantity]);
	}
  }
} elseif(empty($_COOKIE[ShoppingCart])) {
  $session = $_COOKIE[ShoppingCart] = md5(uniqid(rand()));	//creates a random session value
  SetCookie( "ShoppingCart", $_COOKIE[ShoppingCart], time()+31536000);
} else {
  $session = $_COOKIE[ShoppingCart];
}

class Cart {  

  function add_item($product,$quantity = "1") {
    GLOBAL $db,$session;
    $row = $db -> getRow("SELECT * FROM shoppingcart WHERE session='$session' AND product='$product'");
    if (empty($row)) {
	  $id = $db->nextID("shoppingcart");
	  $result = $db -> query("INSERT INTO shoppingcart (id,session,product,quantity,date) VALUES ('$id','$session','$product','$quantity',now())");
    } else {
//	  $quantity = $quantity + $row[quantity];
	  if($quantity == '1') $quantity = $row[quantity];
	  $result = $db -> query("UPDATE shoppingcart SET quantity = '$quantity', date = now() WHERE id='$row[id]'");
	}
	return;
  }

  function delete_item($id) {
	GLOBAL $db,$session;
   	$result= $db -> query("DELETE FROM shoppingcart WHERE session='$session' AND id='$id'");
	return;
  }

  function modify_quantity($id, $quantity) {
	GLOBAL $db,$session,$cart;
	if($quantity > 0) {
    	$result= $db -> query("UPDATE shoppingcart SET quantity='$quantity' WHERE session='$session' AND id='$id'");
	} else {
	  $cart -> delete_item($product);
	}
	return;
  }

  function clear_cart() {
	GLOBAL $db,$session;
   	$result= $db -> query("DELETE FROM shoppingcart WHERE session='$session'");
	return;
  }

  function cart_total() {
    GLOBAL $db,$session;
    $result= $db->query("SELECT * FROM shoppingcart WHERE session='$session'");
    if ($result -> numRows() != 0) {
  	  while ($row = $result->fetchRow()) {
		  $row[cash] = $db -> getOne("SELECT price FROM items WHERE id='$row[product]'");
//		  $price = price($row[product]);
//		  $price = $price[cash];
//		  $total = $total + $price * $row[quantity];
		  $total = $total + $row[cash] * $row[quantity];
	  }
    } else {
	  $total=0.00;
    }
    return sprintf("%.2f", $total);
  }

  function item_id($id) {
    GLOBAL $db,$session;
    $res = $db->getOne("SELECT product FROM shoppingcart WHERE session='$session' AND id='$id'");
    return $res;
  }

  function item_total() {
    GLOBAL $db,$session;
    $total = $db->getOne("SELECT COUNT(*) FROM shoppingcart WHERE session='$session'");
    return $total;
  }

  function display_contents() {
	GLOBAL $db,$session;
  	$count = 0;
	$row = array();
	$result = $db -> query("SELECT * FROM shoppingcart WHERE session='$session'");
	if ($result -> numRows() != 0) {
	  while ($row=$result->fetchRow()) {
        $val = $db -> getRow("SELECT * FROM items WHERE id='$row[product]'");
		$val[photo_small] = photo_name($val[photo_small]);
		$val[wh] = photo_size($val[photo_small],85,50);
		$contents[$count] = $val;
        $contents[$count]["scid"]	= $row[id];
        $contents[$count]["quantity"] = $row[quantity];
        $contents[$count]["total"]	= sprintf("%.2f", $val[cash]*$row[quantity]);
        $count ++;
	  }
	}
	return $contents;
  }

}
?>