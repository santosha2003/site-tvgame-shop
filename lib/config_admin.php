<?php
ini_set('include_path',':/var/www/shedevr/lib');  // Pear folder - code edit - works with PHP 7.2
// Russian cyrillic text - unix cp1251, mysql 5.7 set by Pear DB, set by sending headers, works w Firefox Chrome
//$sess_save_p=realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../shsession');  // do not work - FreeBSD 12 (sessions works! stored into /tmp by session_commit() )
$sess_save_p= '/var/www/shsession'; //'/var/www/shsession';  //Works // do not work - FreeBSD 12 (sessions works! stored into /tmp by session_commit() )
session_save_path($sess_save_p);
$cookieParam = session_get_cookie_params();
$cookieParam["lifetime"]= 1200;
$cookieParam["path"] = '../shsession'; //'/tmp';// relative to site root OK // '/var/www/shsession' do not work;
//session_set_cookie_params($cookieParam["lifetime"], $cookieParam["path"]);
session_set_cookie_params($cookieParam["lifetime"],$cookieParam["path"],$cookieParam["domain"],$cookieParam["secure"],$cookieParam["httponly"] );
ini_set('session.use_trans_sid', 0);
ini_set('session.use_cookies', 1);
ini_set('session.gc_maxlifetime', 1500);
//ini_set('session.save_handler', '');   //files DB
ini_set('session.save_handler', 'files');
//unset($sessionConfig['ini']['session.save_handler']);
$previous_name = session_name("shop_adm");  // php7.2 equ session.name ini
ini_set('session.gc_probability', 1);
// session logic (php 7.2 session extension)  set params, session_start() before send http headers,
// may use session $_SESSION global vars, session_commit() write to disk , suspend, session_start() resume - browser send cookies.
// use fnction my_session_start here - from comments to php.net session manual
ini_set('error_log','/var/www/adm_error_log.txt'); 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1); 
//header('Content-Type: text/html; charset=windows-1251', true); // move to index after session
$_SERVER['HTTP_HOST'] = 'santoshapro.me:92';
$_SERVER['SERVER_NAME'] = 'santoshapro.me:92';
$_SERVER['HOME'] = '/';

$shop_true_id = '1';

require_once 'PEAR.php';
require_once 'DB.php';
require_once 'Auth.php';
require_once 'HTML/Template/IT.php';  // now works partially - _global_ template region throw error, php 7.2
require_once 'Mail.php';
require_once 'formproc.php';
require_once 'HTTP/Session2.php';

$form = new FormProc;

//$tmpl = new IntegratedTemplate("./templates");
$tmpl = new HTML_Template_IT("./templates");  //.admin/templates

$dbhost = "localhost";
$dbport = "3306";
$dbuname = "mysqluser";
$dbpass = "mysqlpass";
$dbname = "shedevr_ru";
$dbtype = "mysqli";
$dsn = "$dbtype://$dbuname:$dbpass@$dbhost:$dbport/$dbname";

define('DEBUG_ENV', true);
function handle_pear_error($error_obj) {
  if('DEBUG_ENV') {
        echo ($error_obj->getMessage()); echo "<br>"; echo ($error_obj->getDebugInfo());//die($error_obj->getMessage()."<br>".$error_obj->getDebugInfo());
  } else {
	echo ("������ �� ��������. ��������� �����!");  // die("������ �� ��������. ��������� �����!");
  }
}
PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'handle_pear_error');

$db = DB::connect("$dbtype://$dbuname:$dbpass@$dbhost:$dbport/$dbname");
if (DB::isError($db)) echo ($db->getMessage()); //die ($db->getMessage());
$db->query("SET CHARACTER SET 'cp1251'");  //php 7.2 ok  Pear DB patched php7.2
$db->setFetchMode(DB_FETCHMODE_ASSOC);
//кодировка у шедевра 1251
//mysql_query("SET NAMES 'utf-8'");        // mysql removed out now mysqli php7
//mysql_query("SET NAMES 'cp1251'");
//mysql_query("SET CHARACTER SET 'cp1251'");
//mysql_set_charset("cp1251");

//php5.6+ $_SESSION   // ! session_start into admin auth.php , here set params only (php7.2)
//session_start();
//HTTP_Session2::setContainer('DB', array('dsn' => $dsn, 'table' => 'sessiondata'));  fail w php7.2 - runs session_start- false start
//HTTP_Session2::useCookies(true);
//admin & www user -different
//HTTP_Session2::start('www_users_ing', uniqid('MyID'));

include 'mysql.php';

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
 // echo "!!!!!! new php no register_globals";   $_SESSION,   //php7.2 test session starting ?? more error checking (session must start into Pear-Auth, not before)
    foreach (array_merge($_GET, $_POST, $_COOKIE) as $key => $val) {
      global $$key;
        $$key = stripslashes ($val);
      //$$key = (get_magic_quotes_gpc()) ? $val : addslashes($val);
    }
  }
//  array_walk_recursive($_POST, 'stripslashes');  //$_COOKIE,$_SESSION 
//  array_walk_recursive($_GET, 'stripslashes');
//  array_walk_recursive($_COOKIE, 'stripslashes');
   //array_walk_recursive($_SESSION, 'stripslashes');


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


function my_session_start() {
    session_start();
    if (isset($_SESSION['destroyed'])) {
       if ($_SESSION['destroyed'] < time()-300) {
           // Обычно это не должно происходить. Это может быть атакой или результатом нестабильной сети.
           // Удаляем все статусы аутентификации пользователей этой сессии.
           remove_all_authentication_flag_from_active_sessions($_SESSION['userid']);
           throw(new DestroyedSessionAccessException);
       }
       if (isset($_SESSION['new_session_id'])) {
           // Срок действия ещё не полностью истёк. Cookie могли быть потеряны из-за нестабильной сети.
           // Заново пытаемся установить правильный cookie идентификатора сессиии.
           // ЗАМЕЧАНИЕ: Не пытайтесь заново установить идентификатор сессии если, вы предпочитаете
           // удалить флаг аутентификации.
           session_commit();
           session_id($_SESSION['new_session_id']);
           // Новый идентификатор сессии должен существовать.
           session_start();
           return;
       }
   }
}

function my_session_regenerate_id() {
    // Новый идентификатор сессии необходим для установки правильного идентификатора сессии,
    // когда идентификатор сессии не был установлен из-за нестабильной сети.
    $new_session_id = session_create_id();
    $_SESSION['new_session_id'] = $new_session_id;
    
    // Устанавливаем временную метку удаления.
    $_SESSION['destroyed'] = time();
    
    // Записываем и закрываем текущую сессию.
    session_commit();

    // Стартуем сессию с новым идентификатором.
    session_id($new_session_id);
    ini_set('session.use_strict_mode', 0);
    session_start();
    ini_set('session.use_strict_mode', 1);
    
    // Новой сессии не нужно это.
    unset($_SESSION['destroyed']);
    unset($_SESSION['new_session_id']);
}
function sess_logout() {
    $_SESSION = array();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]);
    session_destroy();
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
