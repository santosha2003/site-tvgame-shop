<?php
require_once("./lib/config.php");

if($_POST[op] != 'cngreg') {
// �������� ������� ������ ������
  if (!empty($_POST[username])) {
	$result = $db -> getOne("SELECT username FROM users WHERE username='$_POST[username]'");
	if ($result)
	  $_POST[error] .= "<li> ������������ � ����� e-mail ��� ���������������.";
  }
} else {
// ��������� ��������� ������ ��� ��������� �����
  $_POST[username] = $db -> getOne("SELECT username FROM users WHERE id='".$_SESSION[auth][id]."'");
// ���� ������ ������, �� ���������� �� � �������� :-)
  if(empty($_POST[password]) AND empty($_POST[password1])) {
	$_POST[password] = $_POST[password1] = $db -> getOne("SELECT password1 FROM users WHERE id='".$_SESSION[auth][id]."'");
  }
}

$opis = array (
  username	=> "E-Mail",
  password	=> "������",
  password1	=> "������ (��� ���)",
  fio		=> "��� ��� �������� �����������",
  country	=> "������ ����������",
  city		=> "����� ����������",
  phone		=> "�������",
  address	=> "����� �������� �� ���������"
);

foreach($opis as $key => $val) {
	if(empty($_POST[$key])) {
	  if($_POST[op] == "cngreg" AND ($key == "password" OR $key == "password1") AND empty($_POST[password]) AND empty($password1)) continue;
	  $_POST[error] .= "<li> ���������� ��������� ���� \"". $opis[$key] ."\"";
	}
}

// �������� ���������� �������
  if(!empty($_POST[password]) AND !empty($_POST[password1]))
	if($_POST[password] != $_POST[password1])
	  $_POST[error] .= "<li> �������� ������ �� ���������.";

// �������� ������������ �������� � ������
//	if( ord(substr(strtolower($_POST[username]),0,1)) < 97 OR ord(substr(strtolower($_POST[username]),0,1)) > 123) {
//	   $_POST[error] .= "<li>� E-Mail ������������ ������������ �������.";
//	}
	
	if(empty($_POST[error])) {
	  if($_POST[op] != "cngreg") {
		$_POST[date_reg] = $_POST[date_log] =date("Y-m-d H:i:s");
		$_POST[id] = $db -> nextID("users");
		$_POST[status] = "Y";
		$_POST[password] = md5($_POST[password]);
		$missing = array("action","submit","op","Submit");
		$result = $form -> add("users",$missing);
// ����������� �����
		$_SESSION['auth'] = array();
		$_SESSION['auth']['id'] = $_POST[id];
		$_SESSION['auth']['registered'] = true;
		$_SESSION['auth']['username']   = $_POST[username];
		$_SESSION['auth']['timestamp']  = time();
		$_SESSION['auth']['idle']       = time();
	  } else {
		$_POST[password] = md5($_POST[password]);
		$where = array("id" => $_SESSION[auth][id]);
		$missing = array("action","submit","op","Submit");
		$result = $form -> update("users",$missing,$where);
	  }
	  $_GET[op] = "personal";	
	} else {
	  $_GET[op] = "newreg";	
	}

?>