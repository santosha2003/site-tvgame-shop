<div class=title>Менеджер страниц
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

  <p class=th>Страница "{title}"</p>


  <table border="0" cellpadding="4" cellspacing="2">
	<form action=index.php method=POST name=tablesForm>
	<input type=hidden name=id value={id}>
	<input type=hidden name=op value=cms>
	<input type=hidden name=action value={action}>
	<input type=hidden name=oldurl value="{oldurl}">
	<tr>
	  <td class=t align=right nowrap><b>Имя файла:</b></td>
	  <td class=t><input type=text name=url value="{url}" maxlenght=255 class=t style="width: 250px;"></td>
	</tr>

	<tr>
	  <td class=t align=right nowrap>Название в меню:</td>
	  <td class=t><input type=text name=shorttitle value="{shorttitle}" maxlenght=255 class=t style="width: 250px;"></td>
    </tr>

    <tr>
	  <td class=t align=right nowrap>Заголовок страницы:</td>
	  <td class=t><input type=text name=title value="{title}" maxlenght=255 class=t style="width: 250px;"></td>
	</tr>

	<tr>
	  <td class=t valign=top align=right nowrap>URL:</td>
	  <td class=t colspan=3><input type=text name=redirect value="{redirect}" maxlenght=255 style="width: 250px;"></td>
	</tr>

	<tr>
	  <td class=t align=right nowrap>Включить в меню</td>
	  <td class=t><input type="checkbox" name="menu" value="checked" {menu} class=t></td>
	</tr>

	<tr>
	  <td class=t align=right valign=top>Содержание:</td>
	  <td class=t><textarea id=ta style="width: 540px" name=text rows=15 cols=90 wrap=soft class=t>{text}</textarea></td>
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
	  <a href=index.php?op=cms>Вернуться на страницу списка файлов</a>
	</td>
	<td>
	  <img src=images/1p.gif width=1 height=25 valign=absmiddle>
	</td>
  </tr>
  </table>

</td>
</tr>
</table>
