<div class=title>Заказы</div>
<hr>

<table cellspacing=0 cellpadding=0 border=0 width=100%>
  <tr>
	<td valign=top class=t>

<table border="1" cellpadding="2" cellspacing="2" width=100% bgcolor="#F0F0F0" bordercolor="#000000" style="border-collapse: collapse;">
<tr><td>
  <table cellpadding=5>
	<tr>
	  <td class=tb><a href=index.php?op=orders&filter=process>В обработке</a></td>
	  <td class=tb> | </td>
	  <td class=tb><a href=index.php?op=orders&filter=success>Успешно выполненые</a></td>
	  <td class=tb> | </td>
	  <td class=tb><a href=index.php?op=orders&filter=delete>Удаленые</a></td>
	</tr>
  </table>
</td></tr>
</table>

<br>
<div class=th>Список {filter} заказов</div>
<br>

<table width="100%" cellspacing="2" cellpadding="0" border="0">
<tr>
  <td class=t align=right>{nav_bar}</td>
</tr>
</table>

<!-- BEGIN list_orders -->
<fieldset>
<legend class=th>&nbsp;&nbsp;Заказ N {zid} | {date_zid}&nbsp;&nbsp;</legend>
<font class=t>
Клиент : <a href="javascript:pop_win('users_edit.php?id = {uid} ', '', 600, 600);">{fio}</a>&nbsp;&nbsp;&nbsp;&nbsp;[ <a href="mailto:{email}?subject=order#{zid}">написать письмо</a> ]<br>
Адрес доставки: {country}, {city}, {address}<br>
Телефон: {phone} {uid} <br>
Доставить: {date_delivery} {time_delivery}
</font>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/1p.gif" width="1" height="5"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr> 
                <td bgcolor="DFDFDF"> 
                  <table width="100%" border="0" cellspacing="1" cellpadding="3">
                    <tr bgcolor="F7F7F7"> 
                      <td class=tb align="center" colspan=2>Наименование</td>
                      <td class=tb align="center" width="75">Цена</td>
                      <td class=tb align="center" width="50">Кол-во</td>
                      <td class=tb align="center" width="75">Сумма</td>
                    </tr>
<!-- BEGIN items -->
                    <tr bgcolor="#FFFFFF"> 
                      <td class=t align="center" width="30">{sp}</td>
                      <td class=t><a href="javascript:pop_win('../index.php?id={tid}', '', 600, 800);">{name}</a></td>
                      <td class=t align="right" nowrap>{price}&nbsp;</td>
                      <td class=t align="center">{quantity}</td>
                      <td class=t align="right" nowrap>{price_summa}&nbsp;</td>
                    </tr>
<!-- END items -->
                    <tr bgcolor="#FFFFFF"> 
                      <td class=tb align="right" colspan="5">Стоимость доставки: {delivery_total} руб.<br><b>Итого: {summa}</b> руб.</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/1p.gif" width="1" height="5"></td>
              </tr>
              <tr> 
                <td class=tb>[<a href=index.php?op=orders&zid={zid}&status=success&old_status={status}&pages={pages}>выполнен</a>] [<a href=index.php?op=orders&zid={zid}&status=delete&old_status={status}&pages={pages}>удалить</a>]</td>
              </tr>
            </table>

</fieldset>
<br>
<!-- END list_orders -->

<!-- BEGIN no_list -->
<div class=tb>Нет заказов для этого фильра</div>
<!-- END no_list -->

<table width="100%" cellspacing="2" cellpadding="0" border="0">
<tr>
  <td class=t align=right>{nav_bar}</td>
</tr>
</table>

<script type="text/javascript" language="javascript">
<!--
function pop_win(url, win, ht, wd) {
  document.open(url,win,"width="+wd+",height="+ht+",toolbar=no,resizable=yes,scrollbars=yes");
}
-->
</script>