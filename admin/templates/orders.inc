<div class=title>������</div>
<hr>

<table cellspacing=0 cellpadding=0 border=0 width=100%>
  <tr>
	<td valign=top class=t>

<table border="1" cellpadding="2" cellspacing="2" width=100% bgcolor="#F0F0F0" bordercolor="#000000" style="border-collapse: collapse;">
<tr><td>
  <table cellpadding=5>
	<tr>
	  <td class=tb><a href=index.php?op=orders&filter=process>� ���������</a></td>
	  <td class=tb> | </td>
	  <td class=tb><a href=index.php?op=orders&filter=success>������� ����������</a></td>
	  <td class=tb> | </td>
	  <td class=tb><a href=index.php?op=orders&filter=delete>��������</a></td>
	</tr>
  </table>
</td></tr>
</table>

<br>
<div class=th>������ {filter} �������</div>
<br>

<table width="100%" cellspacing="2" cellpadding="0" border="0">
<tr>
  <td class=t align=right>{nav_bar}</td>
</tr>
</table>

<!-- BEGIN list_orders -->
<fieldset>
<legend class=th>&nbsp;&nbsp;����� N {zid} | {date_zid}&nbsp;&nbsp;</legend>
<font class=t>
������ : <a href="javascript:pop_win('users_edit.php?id = {uid} ', '', 600, 600);">{fio}</a>&nbsp;&nbsp;&nbsp;&nbsp;[ <a href="mailto:{email}?subject=order#{zid}">�������� ������</a> ]<br>
����� ��������: {country}, {city}, {address}<br>
�������: {phone} {uid} <br>
���������: {date_delivery} {time_delivery}
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
                      <td class=tb align="center" colspan=2>������������</td>
                      <td class=tb align="center" width="75">����</td>
                      <td class=tb align="center" width="50">���-��</td>
                      <td class=tb align="center" width="75">�����</td>
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
                      <td class=tb align="right" colspan="5">��������� ��������: {delivery_total} ���.<br><b>�����: {summa}</b> ���.</td>
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
                <td class=tb>[<a href=index.php?op=orders&zid={zid}&status=success&old_status={status}&pages={pages}>��������</a>] [<a href=index.php?op=orders&zid={zid}&status=delete&old_status={status}&pages={pages}>�������</a>]</td>
              </tr>
            </table>

</fieldset>
<br>
<!-- END list_orders -->

<!-- BEGIN no_list -->
<div class=tb>��� ������� ��� ����� ������</div>
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