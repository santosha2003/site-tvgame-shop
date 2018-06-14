<LINK REL="stylesheet" type="text/css" href="popcalendar.css" />
<script language='javascript' src='../lib/popcalendar.js'></script>
<script language='javascript'>
<!--
function pop_win(url, win, ht, wd, call) {
  if(call != "") {
	url = url + "&val=" + eval("document.send."+call+".value");
  }
  popwin = document.open(url,win,"width="+wd+",height="+ht+",toolbar=no,resizable=yes,scrollbars=yes");
}
-->
</script>

<div class=title>Редактирование специальных предложений
<!-- BEGIN url -->
<font class=error>(Поле "Имя файла" должно быть заполненшо)</font>
<!-- END url -->
<!-- BEGIN dupe -->
<font class=error>(Такое Имя файла уже используется)</font>
<!-- END dupe -->
</div>
<br>

<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td valign=top class=t>

  <p class=th>Предложение "{title}"</p>


  <table border="0" cellpadding="4" cellspacing="2">
	<form action=spec_add.php method=POST name=send>
	<input type=hidden name=id value={id}>
	<input type=hidden name=action value={action}>

	<tr>
	  <td class=t align=right nowrap>Наименование предложения:</td>
	  <td class=t><input type=text name=name value="{name}" maxlenght=255 class=t style="width: 250px;"></td>
    </tr>

	<tr>
	  <td class=t valign=top align=right nowrap>Дата начала:</td>
	  <td class=t colspan=3><input type=text name=start_date value="{start_date}" maxlenght=255 style="width: 230px;">
		<img src="images/cal.gif" width=16 height=16 border=0 onclick='popUpCalendar(this, send.start_date, "dd.mm.yyyy")'>
		</td>
	</tr>

	<tr>
	  <td class=t valign=top align=right nowrap>Дата окончания:</td>
	  <td class=t colspan=3><input type=text name=end_date value="{end_date}" maxlenght=255 style="width: 230px;">
		<img src="images/cal.gif" width=16 height=16 border=0 onclick='popUpCalendar(this, send.end_date, "dd.mm.yyyy")'>
	  </td>
	</tr>

	<input type=hidden name=items value="{items}">
	<tr>
	  <td class=t align=right>Товары предложения: </td>
	  <td class=t valign=top colspan=3>
	  <input type=button value="Назначить" onClick="pop_win('reklama_spec.php?spec_id={id}&source=items&call=add_item', '', 730, 500, 'items');">
	  <input type=text name="items_count" value="{items_count}" size="1" disabled style="text-align: right;">
	  </td>
	</tr>

	<input type=hidden name=article value="{article}">
	<tr>
	  <td class=t align=right nowrap>Статьи предложения:</td>
	  <td class=t><input type=button value="Назначить" onClick="pop_win('reklama_spec_cms.php?spec_id={id}&source=article&call=add_item', '', 750, 600, 'article');">
	  <input type=text name="article_count" value="{article_count}" size="1" disabled style="text-align: right;">
	  </td>
    </tr>

  <tr>
	<td class=t align=right>Магазины: </td>
	<td class=t>
<!-- BEGIN shops -->
	<input type=checkbox name=shops[] value="{shops_id}" {checked} style="border: 1px solid #{color};">{name}
<!-- END shops -->
	</td>
  </tr>

	<tr>
	  <td class=t align=right valign=top>Описание предложения:</td>
	  <td class=t>
	  <textarea style="width: 540px" name=description rows=20 cols=90 wrap=soft class=t>{description}</textarea></td>
	</tr>
	
	<tr>
	  <td>&nbsp;</td>
	  <td class=t><input type=submit value="Сохранить" class=t>&nbsp;<input type=reset value="Сброс" class=t></td>
	</tr>
  </form>
  </table>

  <table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
	<td class=t>
	  <a href=index.php?op=spec>Вернуться на страницу со списком специальных предложений</a>
	</td>
	<td>
	  <img src=images/1p.gif width=1 height=25 valign=absmiddle>
	</td>
  </tr>
  </table>

</td>
</tr>
</table>
