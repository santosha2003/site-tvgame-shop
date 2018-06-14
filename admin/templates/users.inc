<script type="text/javascript" language="javascript">
<!--
function pop_win(url, win, ht, wd) {
  document.open(url,win,"width="+wd+",height="+ht+",toolbar=no,resizable=yes,scrollbars=yes");
}
-->
</script>
<div class=title>Клиенты</div>
<hr>

<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td valign=top class=t>

	<p class=th>Список клиентов</p>
	
	<table border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;" width=100%>
	<tr>
	  <td class="tb" nowrap align=center>Действия</td>
	  <td class="tb" nowrap>Последний логин</td>
	  <td class="tb" nowrap>Логин</td>
	  <td class="tb" width=100%>ФИО</td>
	  <td class="tb" nowrap>Телефон</td>
	  <td class="tb" nowrap>Страна</td>
	  <td class="tb" nowrap>Город</td>
	  <td class="tb" nowrap>Опт</td>
	  <td class="tb" nowrap>Скидка</td>
	</tr>
	
	<!-- BEGIN list -->
	<tr bgcolor="{bgcolor}">
	  <td class="t" nowrap>
		<a href="javascript:pop_win('users_edit.php?id={id}', '', 600, 600);" class="th"><img src=images/edit.gif width=16 height=16 border=0 alt="Редактировать" title="Редактировать"></a>
		<a href="users.php?action=del&id={id}" onClick="return confirm('Удалить клиента {username}?')" class="th"><img src=images/delete.gif width=16 height=16 border=0 alt="Удалить" title="Удалить"></a>
<!-- BEGIN vis -->
	<a href=users.php?action=inv&id={ids} onClick="return confirm('Запретить логин клиента?')"><img src="images/vis.gif" width="16" height="16" border="0" alt="Скрыть"></a>
<!-- END vis -->
<!-- BEGIN inv -->
	<a href=users.php?action=vis&id={ids} onClick="return confirm('Разрешить логин клиента?')"><img src="images/inv.gif" width="16" height="16" border="0" alt="Показать"></a>
<!-- END inv -->
	  </td>
	  <td class="t" nowrap>{date_login}</td>
	  <td class="t" nowrap><a href=mailto:{username}>{username}</a></td>
	  <td class="t" nowrap>{fio}</td>
	  <td class="t" nowrap>{phone}</td>
	  <td class="t" nowrap>{country}</td>
	  <td class="t" nowrap>{city}</td>
	  <td class="t" nowrap>{dealer}</td>
	  <td class="t" nowrap>{perc}</td>
	</tr>
	<!-- END list -->

	<!-- BEGIN no_list -->
	  <tr>
		<td colspan=9 class=th align=center>Нет зарегистрированых пользователей</td>
	  </tr>
	<!-- END no_list -->

	</table>


</td>
</tr>
</table>
