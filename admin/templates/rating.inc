<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
  <link rel="stylesheet" href="style.css" type="text/css">
<script>
function pop_win(url, win, ht, wd) {
  document.open(url,win,"width="+wd+",height="+ht+",toolbar=no,resizable=yes,scrollbars=yes");
}
</script>
</head>

<body leftmargin="5" topmargin="5" marginheight="5" marginwidth="5" bgcolor='#F6F6F6' onLoad="self.focus()">

<p></p>
<p class=th>����� ������� ��� �������� ������</p>

<table width="100%" cellspacing="4" cellpadding="4" border="1" bgcolor="#FFFFFF" bordercolor="#dddddd" style="border-collapse: collapse;">
  <tr>
	<td colspan="{size}" align=center class=t><b>��������</b></td>
  </tr>
  <tr>
<!-- BEGIN shop -->
	<td class=t align=center bgcolor="{color}" width="{count}%"><b>{name}</b></td>
<!-- END shop -->
  </tr>
  
  <tr>
<!-- BEGIN rating -->
	<td class=t valign=top>
	  <table width="100%" cellspacing="4" cellpadding="4" border="1" bgcolor="#FFFFFF" bordercolor="#dddddd" style="border-collapse: collapse;">
	  <tr><td id='{tdid}' class=t align=center onClick="document.location.href='reklama.php?item_id={tdid}&source=rating'" onMouseOver="document.getElementById('{tdid}').style.cursor='pointer'">�������� �����</td></tr>
	  </table>
<!-- BEGIN list -->
<hr>
	  <a href="rating.php?action=del&id={ids}&shop={shop_id}&source=rating" onClick="return confirm('������� ����� �� �������� ������?')"><img src="images/delete.gif" width="16" height="16" border="0" alt="�������" titile="�������"></a>
	  <a href="popup.php?id={ids}&shop={shop_id}&source=rating"><img src="images/edit.gif" width="16" height="16" border="0" alt="������������� �������� ��������" titile="������������� �������� ��������"></a>
	  <a href="rating.php?action=down&id={ids}&shop={shop_id}&source=rating"><img src="images/down.gif" width="16" height="16" border="0" alt="����������� ����" titile="����������� ����"></a>
	  <a href="rating.php?action=up&id={ids}&shop={shop_id}&source=rating"><img src="images/up.gif" width="16" height="16" border="0" alt="����������� �����" titile="����������� �����"></a>
	  <a href="javascript:pop_win('../index.php?id={ids}', 'sample', 600, 800);">{names} {mark} {model}</a><br>
<!-- END list -->
<!-- BEGIN no_list -->
	  <div align=center><br>������� �� ����������</div>
<!-- END no_list -->
	</td>
<!-- END rating -->
  </tr>
</table>

<p align=center><input type=button value="������� ����" onClick="window.close()"></p>

</body>
</html>