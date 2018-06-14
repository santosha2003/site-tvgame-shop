<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru"><script type="text/javascript" language="javascript">
</head>
<table border="0" cellpadding="0" cellspacing="0" width=100%>
<tr>
<td valign=top class=t>
	<p class=th>Групповые и Функциональные свойства товара
<!-- BEGIN name -->
<font class=error>(Заполните поле "Наименование")</font>
<!-- END name -->
<!-- BEGIN visible -->
<font class=warning>(Свойства товара доступено)</font>
<!-- END visible -->
<!-- BEGIN invisible -->
<font class=warning>(Свойства товара скрыто от посетителей)</font>
<!-- END invisible -->
<!-- BEGIN update -->
<font class=warning>(Данные о свойстве товара обновлены)</font>
<!-- END update -->
<!-- BEGIN add -->
<font class=warning>(Свойство добавлено)</font>
<!-- END add -->
<!-- BEGIN delete -->
<font class=warning>(Свойство удалено)</font>
<!-- END delete -->
</p>

<table border="0" cellpadding="4" cellspacing="2">
<form action=reference.php method=post name="send" onSubmit="return ValidData();" enctype="multipart/form-data">
<input type=hidden name=db value="{db}">
<input type=hidden name=action value="{action}">
<input type=hidden name=id value="{id}">

<tr>
  <td class=tb align=right nowrap>Наименование : </td>
  <td class=t colspan=5><input type=text name=name value="{name}" style="width: 550px;"></td>
</tr>

<tr>
  <td class=t align=right nowrap>Пиктограма:</td>
  <td class=t colspan=5><input type=file style="width: 550px;" name=photo value=""></td>
</tr>

<tr>
  <td class=t valign=top align=right nowrap>Описание : </td>
  <td class=t colspan=5><textarea name=description cols=50 rows=3 style="width: 550px;" class=t>{description}</textarea></td>
</tr>

<tr>
  <td class=t>&nbsp;</td>
  <td class=t colspan=5><input type=submit value="Подтвердить" class=button>&nbsp;&nbsp;&nbsp;<input type=reset value="Убрать изменения" class=button></td>
</tr>
</form>
</table>

<p class=th>Список свойств товара</p>

<table border="1" cellpadding="4" cellspacing="4" width=100% bgcolor="#FFFFFF" bordercolor="#dddddd" style="border-collapse: collapse;">
<tr bgcolor="#F3F3F3">
  <td class=tb>&nbsp;</td>
  <td class=tb>Пиктограма</td>
  <td class=tb>Наименование</td>
  <td class=tb>Описание</td>
</tr>

<!-- BEGIN list -->
<tr>
  <td class=t nowrap valign=top>
<!-- BEGIN vis -->
	<a href=reference.php?db={db}&action=inv&id={ids} onClick="return confirm('Скрыть этот статус?')"><img src="images/vis.gif" width="16" height="16" border="0" alt="Скрыть"></a>
<!-- END vis -->
<!-- BEGIN inv -->
	<a href=reference.php?db={db}&action=vis&id={ids} onClick="return confirm('Показать этот статус?')"><img src="images/inv.gif" width="16" height="16" border="0" alt="Показать"></a>
<!-- END inv -->
	<a href=index.php?op=reference&db={db}&action=edit&id={id}><img src="images/edit.gif" width="16" height="16" border="0" alt="Редактировать"></a>
	<a href=reference.php?db={db}&action=delete&id={id} onClick="return confirm('Удалить этот статус?')"><img src="images/delete.gif" width="16" height="16" border="0" alt="Удалить"></a>
  </td>
  <td class=tb valign=top align=center><img src="../images/pict/{photo}" border="0"></td>
  <td class=tb valign=top nowrap>&nbsp;&nbsp;&nbsp;{name}</td>
  <td class=t  valign=top align=justify width=100%>{description}</td>
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
function ValidData() {
  var missinginfo = "";

  if(document.send.name.value == "") {
	missinginfo += "\n     - Наименование";
  }

  if(document.send.photo.value == "" && document.send.action.value == 'add') {
	missinginfo += "\n     - Пиктограма";
  }

  if(document.send.description.value == "") {
	missinginfo += "\n     - Описание";
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
