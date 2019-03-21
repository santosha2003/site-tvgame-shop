<?php
require_once("../lib/config_admin.php");
//require_once("../lib/config.php");

if (session_status() !== PHP_SESSION_ACTIVE) {my_session_start();}   //name _authsession if comment this line //php5.6 + init _SESSION var`s  // working - session_start(); 
// now session_start() (now line below) by Pear Auth  - & may uncomment upper line - if session path  + name set correctly before start session, Auth working OK.

//break auth session  (storage handle .. into DB not by cookie)
//HTTP_Session2::start('shop_adm', uniqid('MyID'));
$a = new Auth("DB",$params,'',false);
$a -> setSessionname("shop_adm");
$a -> start();

if (isset($_GET['op'])) {
if($_GET['op']=='logout') $a -> logout();
   }
if ($a->checkAuth()) {  //get
  $username = $a -> getUsername();
  if(isset($_POST['username'])) {
	$db -> query("UPDATE admin SET last=now() WHERE username='$username'");
	$perm = $db -> getOne("SELECT perm FROM admin WHERE username='$username'");
	if(!empty($perm)) $_SESSION['auth']['perm'] = $perm;
	else {
	  $a -> logout();
	  header("Location: index.php");
	  exit;
	}
  }
} else {
  $tmpl -> loadTemplatefile("login.inc",true,false);
  $page = $tmpl -> get();
  echo $page;
  exit;
}
?>










