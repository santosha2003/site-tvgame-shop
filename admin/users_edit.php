<? 
require_once('./auth.php');

$tmpl -> loadTemplatefile("users_edit.inc",true,true);
$error = false;

if(isset($_POST['id']) AND is_array($_POST)) {
  if(empty($_POST['password']) OR empty($_POST['password1'])) {
	$error = true;
	$tmpl -> touchBlock('nopassw');
  } else {
	if($_POST['password'] != $_POST['password1']) {
	  $error = true;
	  $tmpl -> touchBlock('noequiv');
	}
  }
  if(!isset($_POST['username'])) $_POST['username']="";
  $dupe = $db -> getOne("SELECT username FROM users WHERE username='$_POST[username]'");
  if(!empty($dupe)) {
	$error = true;
	$tmpl -> touchBlock('dupe');
  }

  if(!$error) {
	$_POST['password'] = md5($_POST['password']);
	$missing = array("op","action","id");
	$where = array("id" => $_POST['id']);
    $result = $form -> update("users",$missing,$where);
	echo "<HTML><HEAD><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"><meta http-equiv=\"Content-Language\" content=\"ru\"><SCRIPT>window.opener.location.reload(); self.close();</SCRIPT></HEAD><BODY></BODY></HTML>";
    exit;
  }
}
  

if($error) {
  $_GET['id'] = $_POST['id'];
}

$row = $db -> getRow("SELECT * FROM users WHERE id='$_GET[id]'");
if(!isset($row['business'])) $row['business']="";
$row['business'] = str_replace("|","<br>",$row['business']);
if(!isset($row['service'])) $row['service']="";
$row['service'] = str_replace("|","<br>",$row['service']);
$row['source'] = str_replace("|","<br>",$row['source']);
$row['password'] = $row['password1'];
if($row['status'] == 'Y') {
  unset($row['status']);
} else {
  $row['status'] = ' selected';
}

if($row['dealer'] == 'Y') {
  $row['dealer'] = ' selected';
} else {
  unset($row['dealer']);
}

$tmpl -> setVariable($row);

if($error) {
  $tmpl -> setVariable($_POST);
}

$page = $tmpl -> get();
echo $page;

?>
