<?php
require_once ("./lib/config.php");

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);


?>
<html>
<head>
<style>
body, td {
    font-family: Verdana, Arial, sans-serif;
    font-size: 11px;
}
A:link { color:#003399; text-decoration: none; }
A:visited { color:#6699CC; text-decoration: none; }
A:hover { text-decoration: underline; }
</style>
<title>HTTP Session</title>
</head>
<body style="margin: 5px;">
<?php

/*
if (!isset($variable)) {
    $variable = 0;
    echo("The variable wasn't previously set<br>\n");
} else {
    $variable++;
    echo("Yes, it was set already<br>\n");
}
*/

switch (@$_GET['action']) {
    case 'setvariable':
        HTTP_Session2::set('variable', 'Test string');
        //HTTP_Session::register('variable');
        break;
    case 'unsetvariable':
        HTTP_Session2::set('variable', null);
        //HTTP_Session::unregister('variable');
        break;
    case 'clearsession':
        HTTP_Session2::clear();
        break;
    case 'destroysession':
        HTTP_Session2::destroy();
        break;
}

HTTP_Session2::setExpire(60);
HTTP_Session2::setIdle(5);

//echo("session_is_registered('variable'): <b>'" . (session_is_registered('variable') ? "<span style='color: red;'>yes</span>" : "no") . "'</b><br>\n");
//echo("isset(\$GLOBALS['variable']): <b>'" . (isset($GLOBALS['variable']) ? "<span style='color: red;'>yes</span>" : "no") . "'</b><br>\n");

echo("------------------------------------------------------------------<br>\n");
echo("Session name: <b>'" . HTTP_Session2::name() . "'</b><br>\n");
echo("Session id: <b>'" . HTTP_Session2::id() . "'</b><br>\n");
echo("Is new session: <b>'" . (HTTP_Session2::isNew() ? "<span style='color: red;'>yes</span>" : "no") . "'</b><br>\n");
echo("Is expired: <b>'" . (HTTP_Session2::isExpired() ? "<span style='color: red;'>yes</span>" : "no") . "'</b><br>\n");
echo("Is idle: <b>'" . (HTTP_Session2::isIdle() ? "<span style='color: red;'>yes</span>" : "no") . "'</b><br>\n");
//echo("Variable: <b>'" . HTTP_Session2::get('variable') . "'</b><br>\n");
echo("Session valid thru: <b>'" . (HTTP_Session2::sessionValidThru() - time()) . "'</b><br>\n");
echo("------------------------------------------------------------------<br>\n");

if (HTTP_Session2::isNew()) {
    //HTTP_Session::set('var', 'value');
    //HTTP_Session::setLocal('localvar', 'localvalue');
    //blah blah blah
}

$petia = 5;
session_register('petia');

?>
<div style="background-color: #F0F0F0; padding: 15px; margin: 5px;">
<pre>
$_SESSION:
<?php
print_r($_SESSION);
?>
</pre>
</div>
</body>
</html>