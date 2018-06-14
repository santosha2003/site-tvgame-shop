<?
//ini_set('include_path',':/bhome/part3/03/shedevr/shedevr.ru/www/lib');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

$shop_true_id = '1';

require_once 'PEAR.php';
require_once 'DB.php';
require_once 'Auth/Auth.php';
require_once 'HTML/Template/IT.php';
require_once 'Mail.php';
require_once 'formproc.php';
require_once 'Session2.php';

$form = new FormProc;

//$tmpl = new IntegratedTemplate("./templates");
$tmpl = new HTML_Template_IT("./templates");

$dbhost = "localhost";
$dbuname = "shedevr_ru";
$dbpass = "S2m5rf3";
$dbport = "3306";
$dbname = "shedevr_ru";
$dbtype = "mysql";
$dsn = "$dbtype://$dbuname:$dbpass@$dbhost:$dbport/$dbname";
/*
define(DEBUG_ENV, true);
function handle_pear_error($error_obj) {
  if(DEBUG_ENV) {
        die($error_obj->getMessage()."<br>".$error_obj->getDebugInfo());
  } else {
        die("Запрос не выполнен. Повторите позже!");
  }
}
PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'handle_pear_error');
*/
$db = DB::connect("$dbtype://$dbuname:$dbpass@$dbhost:$dbport/$dbname");
if (DB::isError($db)) die ($db->getMessage());
$db->setFetchMode(DB_FETCHMODE_ASSOC);

HTTP_Session2::setContainer('DB', array('dsn' => $dsn, 'table' => 'sessiondata'));
HTTP_Session2::useCookies(true);
HTTP_Session2::start('www_users_ing', uniqid('MyID'));

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


?>