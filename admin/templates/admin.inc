<div class=title>Назначение администраторов
<!-- BEGIN nopass -->
<font class=error>(Укажите пароль администратора)</font>
<!-- END nopass -->
<!-- BEGIN mismatch -->
<font class=error>(Пароли не совпадают)</font>
<!-- END mismatch -->
<!-- BEGIN dupe -->
<font class=error>(Администратор с таким именем уже существует)</font>
<!-- END dupe -->
<!-- BEGIN update -->
<font class=warning>(Изменения внесены)</font>
<!-- END update -->
<!-- BEGIN add -->
<font class=warning>(Новый администратор добавлен)</font>
<!-- END add -->
<!-- BEGIN delete -->
<font class=warning>(Администратор удален)</font>
<!-- END delete -->
<!-- BEGIN warning -->
<font class=error>(Нельзя удалить последнего администратора)</font>
<!-- END warning -->
</div>
<hr>

<table cellspacing=0 cellpadding=0 border=0>
<tr>
<td valign=top class=t>

	<p class=th>Добавить нового администатора</p>

	<table border="0" cellpadding="4" cellspacing="2">
	<form action=index.php method=POST>
	<input type=hidden name=op value="admin">
	<input type=hidden name=action value="{action}">
	<input type=hidden name=id value="{id}">
	  <tr>
		<td class=tb align=right>Логин : </td>
		<td class=t><input type=text name=username class=t value="{username}" style="width: 150px;"></td>
	  </tr>
	  <tr>
		<td class=tb align=right>Пароль : </td>
		<td class=t><input type=password name=password class=t style="width: 150px;"></td>
	  </tr>
	  <tr>
		<td class=tb align=right>Пароль <span class=t>(подтверждение)</span> : </td>
		<td class=t><input type=password name=password1 class=t style="width: 150px;"></td>
	  </tr>
	  <tr>
		<td class=t align=right>ФИО : </td>
		<td class=t><input type=text name=fio class=t value="{fio}" style="width: 350px;"></td>
	  </tr>
	  <tr>
		<td class=t align=right>Должность : </td>
		<td class=t><input type=text name=role class=t value="{role}" style="width: 350px;"></td>
	  </tr>
	  <tr>
		<td class=t align=right>E-Mail : </td>
		<td class=t><input type=text name=email class=t value="{email}" style="width: 350px;"></td>
	  </tr>
	  <tr>
		<td class=t align=right>Статус : </td>
		<td class=t>
		  <select name=perm class=t style="width: 350px;">
			<option value="oper"{oper}>Оператор
			<option value="disp"{disp}>Диспетчер
		  </select>
		</td>
	  </tr>
	  <tr>
		<td class=t>&nbsp;</td>
		<td class=t><input type=submit class=t></td>
	  </tr>
	</form>
	</table>
	
	<p class=th>Список администраторов</p>
	
	<table border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">
	<tr bgcolor="#F3F3F3">
	  <td class="tb" nowrap>&nbsp;</td>
	  <td class="tb" nowrap>Логин</td>
	  <td class="tb" nowrap>Должность</td>
	  <td class="tb">ФИО</td>
	  <td class="tb" nowrap>E-Mail</td>
	  <td class="tb" nowrap>Статус</td>
	  <td class="tb" nowrap>Последний логин</td>
	</tr>
	
	<!-- BEGIN list -->
	<tr>
	  <td class="t" nowrap align=center>
		&nbsp;&nbsp;
		<a href="index.php?op=admin&action=edit&id={id}"><img src="images/edit.gif" width="16" height="16" border="0" alt="Редактировать" title="Редактировать"></a>
		<a href="admin.php?action=del&id={id}" onClick="return confirm('Удалить администратора {username}?')"><img src="images/delete.gif" width="16" height="16" border="0" alt="Удалить" title="Удалить"></a>
		&nbsp;&nbsp;
	  </td>
	  <td class="t">{username}</td>
	  <td class="t">{role}</td>
	  <td class="t">{fio}</td>
	  <td class="t" nowrap>{email}</td>
<!-- BEGIN oper -->
	  <td class="t" nowrap>Оператор</td>
<!-- END oper -->
<!-- BEGIN disp -->
	  <td class="t" nowrap>Диспетчер</td>
<!-- END disp -->
	  <td class="t" nowrap>{last}</td>
	</tr>
	
	<!-- END list -->
	</table>


</td>
</tr>
</table>
