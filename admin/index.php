<?php
// go php5 28.08.2009
// go php7.2 28.03.2019
require_once('./auth.php');
session_regenerate_id(true);

$se= session_save_path();

echo 'username '; print_r ($username); echo 'role: ';

//print_r ($_SESSION);
//print_r ($sessionConfig);
//print_r ($session_status);

if (isset($_SESSION['auth']['perm'])) {
     $au=$_SESSION['auth']['perm'];
     $gsid=$_SESSION['_auth_shop_adm']['challengekey'];
}

 if (session_status()==2)  {
  echo "<br /> проверка пройдена‚, <b>{$au}</b> sessia {$gsid}<br />"; //{($_SESSION[_auth_shop_adm][challengekey])}
 echo "Session path {$se} /tmp ? chmod 777 <br />"; // may do not work if not empty (default empty is OK) 
 $nam_sess = session_name();
   echo "<br />  {$se} ";
   echo "<br />  {$nam_sess} ";
   echo "<br /> previous  {$previous_name}";
  echo "<br /> store to {$sess_save_p}";
  echo "<br /> cookie path (relative to site root) {$cookieParam['path']} <br /> "; 
 } else {
 echo "<br /> проверка пройдена‚, <b>SHOP_ADM</b> sessia BROKEN <br />"; //{($_SESSION[_auth_shop_adm][challengekey])
    echo "Здравствуйте‚, <b>гость</b><br />";
    echo "Ваш код?";
 }

//print_r (session_status()); // 2 if active

//session_start();
//if (!isset($_SESSION['auth']['perm'])) {  $_SESSION['auth']['perm']=""; echo "!!!!!!!!!!!!!"; }
//echo "_login_ perm: ";
// echo ($_SESSION['auth']['perm']);
//echo " . ";


header('Content-Type: text/html; charset=windows-1251', true); // move to index after session

//$tmpl = new HTML_Template_IT('./templates');

$tmpl -> loadTemplatefile("header.inc",true,false);
$page = $tmpl -> get();
$tmpl -> loadTemplatefile("menu_".$_SESSION['auth']['perm'].".inc",true,false);  //menu_oper.inc
$page .= $tmpl -> get();


if (isset($_POST['username'])) {
 switch($_POST['username']) {
  case "shedevr":
//   print_r ($_POST);
   echo " _SHEDEVR_ .";
   break;


  }
}


echo "<pre>"; print_r ($_SESSION['auth']['perm']); echo "</pre>";   //small font

//						edit add actions ("POST" forms) -store in db 
if (isset($_POST['op'])) {
 switch($_POST['op']) {
  case "settings":
        $missing = array("op","id");
        $where = array("id" => "'".$_POST['id']."'");
        $result = $form -> update("settings",$missing,$where);
        $_GET['op'] = "settings";
        $update = true;
        break;
  case "update_speed_tov":
        include("./update_speed_tov.php");
        break;
  case "select":
        include("./listcatalog.php");
        break;
  case "addlink":
        include("./links_add.php");
        break;
  case "linkscatalog":
        include("./links_catalog.php");
        break;
  case "faqcatalog":
        include("./faq_exchenger.php");
        break;
  case "catalog":
        include("./catalog.php");
        break;
  case "item":
        include("./item.php");
        break;
  case "cms":
        include("./cms.php");
        break;
  case "admin":
        include("./admin.php");
        break;
  case "client_add":
        include("./regnewclient.php");
        break;
  case "deliverys":
       include("./mode_dost_admin.php");
       break;
 }
}


if (isset($_GET['op'])) {
 switch($_GET['op']) {
  case "faqcatalog":
   include("./faq_exchenger.php");
   break;

  case "starting":
   include("./starting.php");
   break;

  case "client_add":
   $tmpl -> loadTemplatefile("regnewclient.inc",true,false);
   break;
  case "client_snx":
   $tmpl -> loadTemplatefile("newclientsnx.inc",true,false);
   break;

  case "deliverys":
   include("./mode_dost_admin.php");
   break;

  case "spec":
   $tmpl -> loadTemplatefile("spec.inc",true,true);
   include("./spec.php");
    if(session_is_registered('name')) {
     $tmpl->touchBlock("name");
     session_unregister('name');
     }
    if(session_is_registered('title')) {
     $tmpl->touchBlock("title");
     session_unregister('title');
     }
    if(session_is_registered('update')) {
     $tmpl->touchBlock("update");
     session_unregister('update');
     }
    if(session_is_registered('visible')) {
     $tmpl->touchBlock("visible");
     session_unregister('visible');
     }
   break;

  case "reference":
   $tmpl -> loadTemplatefile("reference.inc",true,true);
   include("./reference.php");
    if(session_is_registered('add')) {
     $tmpl->touchBlock("add");
     session_unregister('add');
     }
    if(session_is_registered('update')) {
     $tmpl->touchBlock("update");
     session_unregister('update');
     }
    if(session_is_registered('delete')) {
     $tmpl->touchBlock("delete");
     session_unregister('delete');
     }
   break;

  case "pref":
   $tmpl -> loadTemplatefile("pref.inc",true,true);
   include("./pref.php");
    if(session_is_registered('add')) {
     $tmpl->touchBlock("add");
     session_unregister('add');
     }
    if(session_is_registered('update')) {
     $tmpl->touchBlock("update");
     session_unregister('update');
     }
    if(session_is_registered('delete')) {
     $tmpl->touchBlock("delete");
     session_unregister('delete');
     }
   break;

  case "orders":
   $tmpl -> loadTemplatefile("orders.inc",true,true);
   include("./orders.php");
   break;

  case "users":
   $tmpl -> loadTemplatefile("users.inc",true,true);
   include("./users.php");
    if(session_is_registered('vis')) {
     $tmpl->touchBlock("visible");
     session_unregister('vis');
     }
    if(session_is_registered('inv')) {
     $tmpl->touchBlock("novisible");
     session_unregister('inv');
     }
    if(session_is_registered('add')) {
     $tmpl->touchBlock("add");
     session_unregister('add');
     }
    if(session_is_registered('update')) {
     $tmpl->touchBlock("update");
     session_unregister('update');
     }
    if(session_is_registered('delete')) {
     $tmpl->touchBlock("delete");
     session_unregister('delete');
     }
   break;

  case "cms":
   include("./cms.php");
   break;

  case "allstat":
   include("./allstat.php");
   break;

  case "fcc":
   include("./fcc.php");
   break;

  case "update_speed_tov":
   include("./update_speed_tov.php");
   break;

  case "select":
  $listselect_id=$_GET['id'];
   include("./listcatalog.php");
   break;

  case "addlink":
   include("./links_add.php");
   break;

  case "linkscatalog":
   include("./links_catalog.php");
   break;

  case "count":
   header("Location: countstat.php");
   break;

  case "item":
   $tmpl -> loadTemplatefile("item.inc",true,true);
   include("./item.php");
    if(session_is_registered('name')) {
     $tmpl->touchBlock("name");
     session_unregister('name');
     }
    if(session_is_registered('title')) {
     $tmpl->touchBlock("title");
     session_unregister('title');
     }
    if(session_is_registered('update')) {
     $tmpl->touchBlock("update");
     session_unregister('update');
     }
    if(session_is_registered('visible')) {
     $tmpl->touchBlock("visible");
     session_unregister('visible');
     }
   break;

  case "catalog":
//   $tmpl -> loadTemplatefile('catalog.inc',true,true);
   include("./catalog.php");
    if(session_is_registered('add_name')) {
     $tmpl->touchBlock('add_name');
     session_unregister('add_name');
     }
    if(session_is_registered('add')) {
     $tmpl->touchBlock('add');
     session_unregister('add');
     }
    if(session_is_registered('update')) {
     $tmpl->touchBlock('update');
     session_unregister('update');
     }
    if(session_is_registered('delete')) {
     $tmpl->touchBlock('delete');
     session_unregister('delete');
     }
   break;
  case "settings":
   $tmpl -> loadTemplatefile("settings.inc",true,true);
   $res = $db -> query("SELECT * FROM settings ORDER BY id");
    while($row = $res->fetchRow()) {
     $tmpl -> setCurrentBlock("list");
     $tmpl -> setVariable($row);
     $tmpl -> parseCurrentBlock("list");
//     $tmpl->free();
     }
    if (isset($update)) {
      if($update) {
       $tmpl -> touchBlock("update");
      }
    }
   break;

  case "admin":
   $tmpl -> loadTemplatefile("admin.inc",true,true);
   include("./admin.php");
    if(session_is_registered('update')) {
     $tmpl->touchBlock("update");
     session_unregister('update');
     }
    if(session_is_registered('nopass')) {
     $tmpl->touchBlock("nopass");
     session_unregister('nopass');
     }
    if(session_is_registered('mismatch')) {
     $tmpl->touchBlock("mismatch");
     session_unregister('mismatch');
     }
    if(session_is_registered('dupe')) {
     $tmpl->touchBlock("dupe");
     session_unregister('dupe');
     }
    if(session_is_registered('add')) {
     $tmpl->touchBlock("add");
     session_unregister('add');
     }
    if(session_is_registered('delete')) {
     $tmpl->touchBlock("delete");
     session_unregister('delete');
     }
    if(session_is_registered('warning')) {
     $tmpl->touchBlock("warning");
     session_unregister('warning');
     }
   break;   
   default:
  $tmpl -> loadTemplatefile("body.inc",true,true);
 }

}
//                                                 first open page - was error - display adm panel twice
if (isset($_GET['op'])) {
$page .= $tmpl -> get();
}
//                                                  now ok (santosha)

$_SESSION["firstname"] = $au;
$_SESSION["lastname"] = $gsid;

$user1=$_SESSION["firstname"];
$pw1=$_SESSION["lastname"];

$tmpl -> loadTemplatefile("body.inc",true,true);

echo 'Hi, ' . $user1 . ' ' . $pw1 . '   ';
      // $tmpl -> touchBlock("usess");
          //$tmpl -> parseCurrentBlock("usess");
           $tmpl -> setCurrentBlock("usess");
          $tmpl -> parseCurrentBlock();
     $tmpl -> setVariable('user1',$user1);
     $tmpl -> setVariable('pw1',$pw1);
register_globals ();

//print_r ($GLOBALS);
session_commit ();

$page .= $tmpl -> get();
$tmpl -> loadTemplatefile("footer.inc",true,true);
$page .= $tmpl -> get();

echo $page;


function register_global_array( $sg ) {
    Static $superGlobals    = array(
        'n' => '_ENV'       ,
        'g' => '_GET'       ,
        'p' => '_POST'      ,
        'c' => '_COOKIE'    ,
        'r' => '_REQUEST'   ,
        's' => '_SERVER'    ,
        'e' => '_SESSION'    ,
        'f' => '_FILES'
    );
   
    Global ${$superGlobals[$sg]};
   
    foreach( ${$superGlobals[$sg]} as $key => $val ) {
        $GLOBALS[$key]  = $val;
    }
}
 
function register_globals( $order = 'gpce' ) {
    $_SERVER;       //See Note Below
    $_ENV;
    $_REQUEST;
    $_SESSION;
 
    $order  = str_split( strtolower( $order ) );
    array_map( 'register_global_array' , $order );
}


?>







