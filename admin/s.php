<?php


//session_abort();
require_once ('../lib/config_admin.php');

sess_logout ();
print_r ($_SESSION);
require_once('./auth.php');

?>
