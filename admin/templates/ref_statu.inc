<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru"><script type="text/javascript" language="javascript">
</head>
<script type="text/javascript" language="javascript">
<!--
if(document.location.toString().indexOf("source=items")!= -1) {
  document.write('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">');
  document.write('<html><head>');
  document.write('<link rel="stylesheet" href="style.css" type="text/css">');
  document.write('<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">');
  document.write('</head>');
  document.write('<body leftmargin="7" topmargin="7" marginheight="7" marginwidth="7" bgcolor="#F6F6F6" onload="self.focus()">');
}

-->
</script>


<table border="0" cellpadding="0" cellspacing="0" width=100%>
<tr>
<td valign=top class=t>
<script>
if(document.location.toString().indexOf("source=items")== -1) {

  document.write('	<p class=th>Статусы товара ');
  document.write('<!-- BEGIN name --> ');
  document.write('<font class=error>(Заполните поле "Наименование")</font> ');
  document.write('<!-- END name --> ');
  document.write('<!-- BEGIN visible --> ');
  document.write('<font class=warning>(Статус доступен)</font> ');
  document.write('<!-- END visible --> ');
  document.write('<!-- BEGIN invisible --> ');
  document.write('<font class=warning>(Статус скрыт от посетителей)</font> ');
  document.write('<!-- END invisible --> ');
  document.write('<!-- BEGIN update --> ');
  document.write('<font class=warning>(Данные о статусе обновлены)</font> ');
  document.write('<!-- END update --> ');
  document.write('<!-- BEGIN add --> ');
  document.write('<font class=warning>(Статус добавлен)</font> ');
  document.write('<!-- END add --> ');
  document.write('<!-- BEGIN delete --> ');
  document.write('<font class=warning>(Статус удален)</font> ');
  document.write('<!-- END delete --> ');
  document.write('</p> ');

  document.write('<table border="0" cellpadding="4" cellspacing="2"> ');
  document.write('<form action=reference.php method=post name="send" onSubmit="return ValidData();" enctype="multipart/form-data"> ');
  document.write('<input type=hidden name=db value="{db}"> ');
  document.write('<input type=hidden name=action value="{action}"> ');
  document.write('<input type=hidden name=id value="{id}"> ');
  document.write(' ');
  document.write('<tr> ');
  document.write('  <td class=tb align=right nowrap>Наименование : </td> ');
  document.write('  <td class=t colspan=5><input type=text name=name value="{name}" style="width: 450px;"></td> ');
  document.write('</tr> ');
  document.write(' ');
  document.write('<tr> ');
  document.write('  <td class=t align=right nowrap>Пиктограма:</td> ');
  document.write('  <td class=t colspan=5><input type=file style="width: 450px;" name=photo value=""></td> ');
  document.write('</tr> ');
  document.write('<tr> ');
  document.write('  <td class=t>&nbsp;</td> ');
  document.write('  <td class=t colspan=5><input type=submit value="Подтвердить" class=button>&nbsp;&nbsp;&nbsp;<input type=reset value="Убрать изменения" class=button></td> ');
  document.write('</tr> ');
  document.write('</form> ');
  document.write('</table> ');
}
</script>

<p class=th>Список статусов товара</p>

<table border="1" cellpadding="4" cellspacing="4" width=100% bgcolor="#FFFFFF" bordercolor="#dddddd" style="border-collapse: collapse;">
<tr bgcolor="#F3F3F3">
<script>
if(document.location.toString().indexOf("source=items")== -1) {
  document.write('    <td class=tb></td>');
}
</script>

  <td class=tb>Пиктограма</td>

<script>
if(document.location.toString().indexOf("source=items")!= -1) {
  document.write('    <td class=tb>Магазины</td>');
}
</script>

  <td class=tb>Наименование</td>
</tr>

<form action=reference.php method=post name="send">
<input type=hidden name=db value="{db}">
<input type=hidden name=action value="mass_add">
<input type=hidden name=item_id value="{item_id}">
<input type=hidden name=source value="{source}">
<input type=hidden name=call value="{call}">


<!-- BEGIN list -->
<tr>
<script>
if(document.location.toString().indexOf("source=items")== -1) {

  document.write('  <td class=t nowrap> ');
<!-- BEGIN vis -->
  document.write('	<a href=reference.php?db={db}&action=inv&id={ids} onClick="return confirm(\'Скрыть этот статус?\')"><img src="images/vis.gif" width="16" height="16" border="0" alt="Скрыть"></a> ');
<!-- END vis -->
<!-- BEGIN inv -->
  document.write('	<a href=reference.php?db={db}&action=vis&id={ids} onClick="return confirm(\'Показать этот статус?\')"><img src="images/inv.gif" width="16" height="16" border="0" alt="Показать"></a> ');
<!-- END inv -->
  document.write('	<a href=index.php?op=reference&db={db}&action=edit&id={id}><img src="images/edit.gif" width="16" height="16" border="0" alt="Редактировать"></a> ');
  document.write('	<a href=reference.php?db={db}&action=delete&id={id} onClick="return confirm(\'Удалить этот статус?\')"><img src="images/delete.gif" width="16" height="16" border="0" alt="Удалить"></a> ');
  document.write('  </td> ');
}
</script>
  <td class=tb valign=top align=center><img src="../images/pict/{photo}" border="0"></td>

<script>
if(document.location.toString().indexOf("source=items")!= -1) {
  document.write('<td class=t nowrap>');
<!-- BEGIN shop -->
  document.write('<input type=checkbox name="shops[{id}][{shop_id}]" {checked} style="border: 1px solid #{color};">');
<!-- END shop -->
  document.write('</td>');
}
</script>
  <td class=tb width=100%>&nbsp;&nbsp;&nbsp;{name}</td>
</tr>
<!-- END list -->

<!-- BEGIN no_list -->
<tr>
  <td class=tb colspan=4 align=center>Нет статусов товара</td> 
</tr>
<!-- END no_list -->
</table>

<script type="text/javascript" language="javascript">
<!--
if(document.location.toString().indexOf("source=items")!= -1) {
  document.write('<p align=center class=th>Ключевое свойство<br>');
  document.write('<textarea name=description style="width: 350px; height: 150px;" class=t>{description}</textarea></p>');
  document.write('<p align=center><input type=submit value="Установить">&nbsp;&nbsp;<input type="button" value="Закрыть окно" onClick="window.close();"></p>');
}

function ValidData() {
  var missinginfo = "";

  if(document.send.name.value == "") {
	missinginfo += "\n     - Наименование";
  }

  if(document.send.photo.value == "" && document.send.action.value == 'add') {
	missinginfo += "\n     - Пиктограма";
  }

  if (missinginfo != "") {
	missinginfo ="Заполните следющие поля формы:\n" +
	"_____________________________\n" + 
	missinginfo + "\n_____________________________" +
	"\n";
	alert(missinginfo);
	return false;
  }
  else return true;
}
-->
</script>
</form>
