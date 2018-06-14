<table border="0" cellpadding="0" cellspacing="0" width=100%>
<tr>
<td valign=top class=t>
	<p class=th>Партнерские ссылки
<!-- BEGIN name -->
<font class=error>(Заполните поле "Ссылка")</font>
<!-- END name -->
<!-- BEGIN visible -->
<font class=warning>(Ссылка доступена посетителям)</font>
<!-- END visible -->
<!-- BEGIN invisible -->
<font class=warning>(Ссылка скрыта от посетителей)</font>
<!-- END invisible -->
<!-- BEGIN update -->
<font class=warning>(Данные о ссылке обновлены)</font>
<!-- END update -->
<!-- BEGIN add -->
<font class=warning>(Ссылка добавлена)</font>
<!-- END add -->
<!-- BEGIN delete -->
<font class=warning>(Ссылка удалена)</font>
<!-- END delete -->
</p>

<table border="0" cellpadding="4" cellspacing="2">
<form action=reference.php method=post name="send" onSubmit="return ValidData();">
<input type=hidden name=db value="{db}">
<input type=hidden name=action value="{action}">
<input type=hidden name=id value="{id}">

<tr>
  <td class=tb align=right nowrap>Тип ссылки : </td>
  <td class=t colspan=5>
	<select name=type style="width: 550px;">
	  <option value="Друзья">Друзья
	  <option value="Враги">Враги
	  <option value="Казлы">Казлы
	</select>
  </td>
</tr>
<tr>
  <td class=tb align=right valign=top nowrap>Ссылка : </td>
  <td class=t colspan=5><textarea name=description style="width: 550px; height: 100px;">{description}</textarea></td>
</tr>

<tr>
  <td class=t>&nbsp;</td>
  <td class=t colspan=5><input type=submit value="Подтвердить" class=button>&nbsp;&nbsp;&nbsp;<input type=reset value="Убрать изменения" class=button></td>
</tr>
</form>
</table>

<p class=th>Список ссылок</p>

<table border="1" cellpadding="4" cellspacing="4" width=100% bgcolor="#FFFFFF" bordercolor="#dddddd" style="border-collapse: collapse;">
<tr bgcolor="#F3F3F3">
  <td class=tb>&nbsp;</td>
  <td class=tb nowrap>Тип ссылки</td>
  <td class=tb>Ссылка</td>
</tr>

<!-- BEGIN list -->
<tr>
  <td class=t nowrap valign=top>
<!-- BEGIN vis -->
	<a href=reference.php?db={db}&action=inv&id={ids} onClick="return confirm('Скрыть эту ссылку от посетителей?')"><img src="images/vis.gif" width="16" height="16" border="0" alt="Скрыть"></a>
<!-- END vis -->
<!-- BEGIN inv -->
	<a href=reference.php?db={db}&action=vis&id={ids} onClick="return confirm('Показывать эту ссылку посетителям?')"><img src="images/inv.gif" width="16" height="16" border="0" alt="Показать"></a>
<!-- END inv -->
	<a href=index.php?op=reference&db={db}&action=edit&id={id}><img src="images/edit.gif" width="16" height="16" border="0" alt="Редактировать"></a>
	<a href=reference.php?db={db}&action=delete&id={id} onClick="return confirm('Удалить эту ссылку?')"><img src="images/delete.gif" width="16" height="16" border="0" alt="Удалить"></a>
  </td>
  <td class=tb valign=top nowrap>&nbsp;&nbsp;&nbsp;{type}&nbsp;&nbsp;&nbsp;</td>
  <td class=tb valign=top width=100%>{description}</td>
</tr>
<!-- END list -->

<!-- BEGIN no_list -->
<tr>
  <td class=tb colspan=4 align=center>Нет партнерских ссылок</td> 
</tr>
<!-- END no_list -->

</table>

<script type="text/javascript" language="javascript">
<!--
function ValidData() {
  var missinginfo = "";

  if(document.send.description.value == "") {
	missinginfo += "\n     - Ссылка";
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
