<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru"><script type="text/javascript" language="javascript">
</head>
<!--
function updateSelect() {
  var selectArray_name = new Array({select_name});
  var selectArray_id = new Array({select_id});
  var name = selectArray_name;
  var id = selectArray_id;
  var _F=window.opener.document.send;
  var current = _F.{db}.options.length;
  var sel = _F.{db}.options.selectedIndex;
  var ops = _F.{db}.options[sel].value;
  for (var j=current;j>0;j--) _F.{db}.options[j] = null;
  for (var i=0;i<name.length;i++) {
	if(id[i] == ops) {
	  _F.{db}.options[_F.{db}.options.length] = new Option(name[i],id[i],true);
	} else {
	  _F.{db}.options[_F.{db}.options.length] = new Option(name[i],id[i]);
	}
  }
  _F.{db}.options[0].text="Please select";
}


if(document.location.toString().indexOf("source=items")!= -1) {
  document.write('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">');
  document.write('<html><head>');
  document.write('<link rel="stylesheet" href="style.css" type="text/css">');
  document.write('<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">');
  document.write('</head>');
  document.write('<body leftmargin="7" topmargin="7" marginheight="7" marginwidth="7" bgcolor="#F6F6F6" onLoad="updateSelect();">');
}

-->
</script>

<table border="0" cellpadding="0" cellspacing="0" width=100%>
<tr>
<td valign=top class=t>
	<p class=th>Добавить/редактировать производителя
<!-- BEGIN name -->
<font class=error>(Поле "Название" должно быть заполнено)</font>
<!-- END name -->
<!-- BEGIN visible -->
<font class=warning>(Сделать видимым)</font>
<!-- END visible -->
<!-- BEGIN invisible -->
<font class=warning>(Сделать невидимым)</font>
<!-- END invisible -->
<!-- BEGIN update -->
<font class=warning>(Обновлено)</font>
<!-- END update -->
<!-- BEGIN add -->
<font class=warning>(Добавлено)</font>
<!-- END add -->
<!-- BEGIN delete -->
<font class=warning>(Удалено)</font>
<!-- END delete -->
</p>

<table border="0" cellpadding="4" cellspacing="2">
<form action=reference.php method=post name="send" onSubmit="return ValidData();" enctype="multipart/form-data">
<input type=hidden name=db value="{db}">
<input type=hidden name=action value="{action}">
<input type=hidden name=id value="{id}">
<input type=hidden name=source value="{source}">

<tr>
  <td class=tb align=right nowrap>Название : </td>
  <td class=t colspan=5><input type=text name=name value="{name}" style="width: 550px;"></td>
</tr>

<tr>
  <td class=t align=right nowrap>Логотип : </td>
  <td class=t colspan=5><input type=file style="width: 550px;" name=photo value=""></td>
</tr>

<tr>
  <td class=t>&nbsp;</td>
  <td class=t colspan=5><input type=submit value="Подтвердить" class=button>&nbsp;&nbsp;&nbsp;<input type=reset value="Сбросить" class=button></td>
</tr>
</form>
</table>

<p class=th>Список производителей</p>

<table border="1" cellpadding="4" cellspacing="4" width=100% bgcolor="#FFFFFF" bordercolor="#dddddd" style="border-collapse: collapse;">
<tr bgcolor="#F3F3F3">
  <td class=tb>&nbsp;</td>
  <td class=tb>Изображение</td>
  <td class=tb>Наименование</td>
</tr>

<!-- BEGIN list -->
<tr>
  <td class=t nowrap valign=top>
<!-- BEGIN vis -->
	<a href=reference.php?db={db}&action=inv&id={ids}&source={sources} onClick="return confirm('Сделать производителя невидимым?')"><img src="images/vis.gif" width="16" height="16" border="0" alt="Видим" title="Видим"></a>
<!-- END vis -->
<!-- BEGIN inv -->
	<a href=reference.php?db={db}&action=vis&id={ids}&source={sources} onClick="return confirm('Сделать производителя видимым?')"><img src="images/inv.gif" width="16" height="16" border="0" alt="Невидим" title="Невидим"></a>
<!-- END inv -->
<script type="text/javascript" language="javascript">
<!--
if(document.location.toString().indexOf("source=items")!= -1) {
  document.write('<a href="reference.php?db={db}&action=edit&id={id}&source=items"><img src="images/edit.gif" width="16" height="16" border="0" alt="Редактировать" title="Редактировать"></a>');
} else {
  document.write('<a href="index.php?op=reference&db={db}&action=edit&id={id}"><img src="images/edit.gif" width="16" height="16" border="0" alt="Редактировать" title="Редактировать"></a>');
}

-->
</script>

	<a href="reference.php?db={db}&action=delete&id={id}&source={source}" onClick="return confirm('Удалить этого производителя?')"><img src="images/delete.gif" width="16" height="16" border="0" alt="Удалить" title="Удалить"></a>
  </td>
  <td class=tb valign=top align=center><img src="../images/pict/{photo}" border="0"></td>
  <td class=tb valign=top width=100%>&nbsp;&nbsp;&nbsp;{name}&nbsp;&nbsp;&nbsp;</td>
</tr>
<!-- END list -->

<!-- BEGIN no_list -->
<tr>
  <td class=tb colspan=4 align=center>Нет производителей</td> 
</tr>
<!-- END no_list -->

</table>



<script type="text/javascript" language="javascript">
<!--

if(document.location.toString().indexOf("source=items")!= -1) {
  document.write('<br><div align=center><input type=button value="Close window" onClick="window.close();"></div>');
}

function ValidData() {
  var missinginfo = "";

  if(document.send.name.value == "") {
	missinginfo += "\n     - Наименование";
  }

  if (missinginfo != "") {
	missinginfo ="Вы не заполнили или заполнили непрвильно\n приведеные ниже поля:\n" +
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
