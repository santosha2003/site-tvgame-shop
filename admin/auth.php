<?php
//require_once("../lib/config_admin.php");
require_once("../lib/config_admin.php");
session_start ();   //php5.6 + init _SESSION var`s
//break auth session
//HTTP_Session2::start('shop_adm', uniqid('MyID'));
$a = new Auth("DB",$params,false,false);
$a -> setSessionname("shop_adm");
$a -> start();

if (isset($_GET['op'])) {
if($_GET['op']=='logout') $a -> logout();
   }
if ($a->getAuth()) {
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
echo 'username '; print_r ($username); echo 'role: ';
print_r ($perm);
//print_r ($_SESSION);


  }
} else {
  $tmpl -> loadTemplatefile("login.inc",true,false);
  $page = $tmpl -> get();
  echo $page;
  exit;
}
?>










