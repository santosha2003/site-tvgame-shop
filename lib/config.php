<?php
ini_set('include_path',':/var/www/shedevr/lib');
ini_set('log_errors', 1); 
ini_set('error_log', 'shedevr_error_log.txt'); 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
//header('Content-Type: text/html; charset=windows-1251', true);  into index move (after auth & session)
$_SERVER['HTTP_HOST'] = 'santoshapro.me:92';
$_SERVER['SERVER_NAME'] = 'santoshapro.me:92';

$shop_true_id = '1';

require_once 'PEAR.php';
require_once 'DB.php';
require_once 'Auth.php';
require_once 'HTML/Template/IT.php';
require_once 'Mail.php';
require_once 'formproc.php';
require_once 'HTTP/Session2.php';

$form = new FormProc;

//$tmpl = new IntegratedTemplate("./templates");
$tmpl = new HTML_Template_IT("./templates");

$dbhost = "localhost";
$dbuname = "u1";
$dbpass = "123";
$dbport = "3306";
$dbname = "shedevr_ru";
$dbtype = "mysqli";
$dsn = "$dbtype://$dbuname:$dbpass@$dbhost:$dbport/$dbname";

define('DEBUG_ENV', true);
function handle_pear_error($error_obj) {
  if('DEBUG_ENV') {
        echo ($error_obj->getMessage()); echo "<br>"; echo ($error_obj->getDebugInfo());//die($error_obj->getMessage()."<br>".$error_obj->getDebugInfo());
  } else {
	echo ("Запрос не выполнен. Повторите позже!");  // die("Запрос не выполнен. Повторите позже!");
  }
}
PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'handle_pear_error');

$db = DB::connect("$dbtype://$dbuname:$dbpass@$dbhost:$dbport/$dbname");
if (DB::isError($db)) echo ($db->getMessage()); //die ($db->getMessage());
$db->query("SET CHARACTER SET 'cp1251'");  //php 7.2 ok  Pear DB patched php7.2
$db->setFetchMode(DB_FETCHMODE_ASSOC);
//п╨п╬п╢п╦я─п╬п╡п╨п╟ я┐ я┬п╣п╢п╣п╡я─п╟ 1251
//mysql_query("SET NAMES 'utf-8'");
//mysql_query("SET NAMES 'cp1251'");
//mysql_query("SET CHARACTER SET 'cp1251'");
//mysql_set_charset("cp1251");

//php5.6+ $_SESSION
//session_start();
HTTP_Session2::setContainer('DB', array('dsn' => $dsn, 'table' => 'sessiondata'));
HTTP_Session2::useCookies(true);
//admin & www user -different
//HTTP_Session2::start('www_users_ing', uniqid('MyID'));

$params = array(
  "dsn" => "$dbtype://$dbuname:$dbpass@$dbhost:$dbport/$dbname",
  "table" => "admin",
  "usernamecol" => "username",
  "passwordcol" => "password"
);

$users_params = array(
  "dsn" => "$dbtype://$dbuname:$dbpass@$dbhost:$dbport/$dbname",
  "table" => "users",
  "usernamecol" => "username",
  "passwordcol" => "password"
);

//  php5+ register_globals off
if (! isset($PXM_REG_GLOB)) {

  $PXM_REG_GLOB = 1;

  if (! ini_get('register_globals')) {
 // echo "!!!!!! new php no register_globals";
    foreach (array_merge($_GET, $_POST, $_SESSION, $_COOKIE) as $key => $val) {
      global $$key;
        $$key = stripslashes ($val);
      //$$key = (get_magic_quotes_gpc()) ? $val : addslashes($val);
    }
  }
  array_walk_recursive($_POST, 'stripslashes');  //$_COOKIE,$_SESSION
  array_walk_recursive($_GET, 'stripslashes');
  array_walk_recursive($_COOKIE, 'stripslashes');
  array_walk_recursive($_SESSION, 'stripslashes');

  if (! get_magic_quotes_gpc()) {
    //foreach ($_POST as $key => $val) $_POST[$key] = addslashes($val);
    //foreach ($_GET as $key => $val)  $_GET[$key]  = addslashes($val);
    //foreach ($_SESSION as $key => $val) $_SESSION[$key] = addslashes($val);
  }
}

//that in php5.4

//You can just define the function if required
// Fix for removed Session functions 
if (!function_exists('session_register')) fix_session_register();

function fix_session_register(){
    function session_register(){
        $args = func_get_args();
        foreach ($args as $key){
         global $$key;
         
            $_SESSION[$key]=$GLOBALS[$key];
            if (!isset($_SESSION[$key]))  $_SESSION[$key] = $$key;
            //$$key=&$_SESSION[$key];
        array_walk_recursive($_SESSION, 'stripslashes');
        }
      //foreach ($_SESSION as $key => $val) $_SESSION[$key] = addslashes($val);
    }
    function session_is_registered($key){
        return isset($_SESSION[$key]);
    }
    function session_unregister($key){
        unset($_SESSION[$key]);
    }
}

//

//Fatal error: Cannot re-assign auto-global variable _POST
//Final Solution for php 5.4 and above version
/*
$a =  $_POST;
function add($_POST;){
echo $_POST['a'];
echo $_POST['b'];
}
add($a); */

//Some servers do not have register globals turned on. This loop converts $_BLAH into global variables.
/*foreach($_COOKIE as $key => $value) {
    if(!is_array($value)){
        ${$key} = trim(rawurldecode($value));
        //echo "$key $value<br>";
    }
    else{
        ${$key} = $value;
    }
}
foreach($_GET as $key => $value) { 
    if(!is_array($value)){
        ${$key} = trim(rawurldecode($value));
        //echo "$key $value<br>";
    }
    else{
        ${$key} = $value;
    }
}
foreach($_POST as $key => $value) { 
    if(!is_array($value)){
        ${$key} = trim(rawurldecode($value));
        //echo "$key $value<br>";
    }
    else{
        ${$key} = $value;
    }
}
foreach($_REQUEST as $key => $value) { 
    if(!is_array($value)){
        ${$key} = trim(rawurldecode($value));
        //echo "$key $value<br>";
    }
    else{
        ${$key} = $value;
    }
}
foreach($_SERVER as $key => $value) { 
    if(!is_array($value)){
        ${$key} = trim(rawurldecode($value));
        //echo "$key $value<br>";
    }
    else{
        ${$key} = $value;
    }
} */

?>
