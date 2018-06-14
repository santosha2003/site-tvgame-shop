<?
require_once("./auth.php");

if($_SESSION['auth']['perm'] != 'oper') {
  header("Location: index.php");
  exit;
}

if(!empty($_POST)) {
  $db -> query("DELETE FROM description WHERE id='$_POST[id]' AND shop='$_POST[shop]' AND source='$_POST[source]'");
  if(!empty($_POST[description])) {
        $db -> query("INSERT INTO description (id,shop,source,description) VALUES ('$_POST[id]','$_POST[shop]','$_POST[source]','$_POST[description]')");
  }
  if($_POST['source']='new'){
  header("Location: rating.php?action=$_POST[source]");
  }else{
  header("Location: rating1.php?action=$_POST[source]");
  }
exit;
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
<link rel=stylesheet href="style.css" type="text/css">
</head>
<body bgcolor=white onload="self.focus()">

<p class=th align=center>Ключевое свойство для товара "<?= $db -> getOne("SELECT CONCAT(name,' ',model) FROM items WHERE id='$_GET[id]'"); ?>"</p>
<table border=0 width=100%>
<form action=popup.php method=POST>
<input type="hidden" name="id"                value="<?= $_GET[id]?>">
<input type="hidden" name="shop"        value="<?= $_GET[shop]?>">
<input type="hidden" name="source"        value="<?= $_GET[source]?>">
<tr><td class=t align=center>
<textarea name=description class=t style="width: 500px; height: 150px;">
<?= $db -> getOne("SELECT description FROM description WHERE id='$_GET[id]' AND shop='$_GET[shop]' AND source='$_GET[source]'"); ?>
</textarea>
</td></tr>
</table>
<br>
<div align=center>
  <input type=submit value="Сохранить изменения">&nbsp;&nbsp;
  <input type=button value="Вернуться назад" onClick="history.back();">&nbsp;&nbsp;
  <input type=button value="Закрыть окно" onClick="self.close();">
</div>
</form>
</body>
</html>