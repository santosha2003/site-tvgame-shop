<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" bgcolor='#F6F6F6'>

<table cellspacing=0 cellpadding=8 border=0 width=100%>
<tr>
<td valign=top class=t align=center>

	<div class=th>������ �������</div>
	
<!-- BEGIN dupe -->
  <div class="error">����� ��� ������������ ��� ������������</div>
<!-- END dupe -->
<!-- BEGIN noname -->
  <div class="error">������� ��� ������������</div>
<!-- END noname -->
<!-- BEGIN nopassw -->
  <div class="error">�� ��������� ���� �� ����� "������"</div>
<!-- END nopassw -->
<!-- BEGIN noequiv -->
  <div class="error">���� "������" �� ���������</div>
<!-- END noequiv -->
	
	<table border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;" width=90%>
<form action=users_edit.php method=post>
<input type="hidden" name="id" value="{id}">
  <tr>
	<td class="tb">E-Mail (�����)<a href="mailto:{username}">{username}</a></td></td>
	<td class="t"><input type="text" name="username" value="{username}" maxlenght="128" class="t" style="width: 200px;"></td>
  </tr>
  <tr>
	<td class="tb">������</td>
	<td class="t"><input type="text" name="password" value="{password}" maxlenght="64" class="t" style="width: 200px;"></td>
  </tr>
  <tr>
	<td class="tb">������ <font class="t">(��� ���)</font></td>
	<td class="t"><input type="text" name="password1" value="{password1}" maxlenght="64" class="t" style="width: 200px;"></td>
  </tr>
  <tr>
	<td class="tb">���</td>
	<td class="t"><input type="text" name="fio" value="{fio}" maxlenght="128" class="t" style="width: 200px;"></td>
  </tr>
  <tr>
	<td class="tb">�������</td>
	<td class="t"><input type="text" name="phone" value="{phone}" maxlenght="128" class="t" style="width: 200px;"></td>
  </tr>
  <tr>
	<td class="tb">������</td>
	<td class="t"><input type="text" name="zip" value="{zip}" maxlenght="6" class="t" style="width: 200px;"></td>
  </tr>
  <tr>
	<td class="tb">������</td>
	<td class="t"><input type="text" name="country" value="{country}" maxlenght="128" class="t" style="width: 200px;"></td>
  </tr>
  <tr>
	<td class="tb">�����</td>
	<td class="t"><input type="text" name="city" value="{city}" maxlenght="128" class="t" style="width: 200px;"></td>
  </tr>
  <tr>
	<td class="tb">�����</td>
	<td class="t"><textarea name="address" class="t" style="width: 200px; height: 120px">{address}</textarea></td>
  </tr>
  <tr>
	<td class="tb" valign=top>������ �� ������ � ����� �������</td>
	<td class="t"><input type="text" name="source" value="{source}" maxlenght="255" class="t" style="width: 200px;"></td>
  </tr>
  <tr>
	<td class="tb" valign=top>������� ������</td>
	<td class="t">
	  <select name=dealer>
		<option value='N'> ������� ������������
		<option value='Y' {dealer}> ������� ����������
	  </select>
	</td>
  </tr>
  <tr>
	<td class="tb" valign=top>������ (%)</td>
	<td class="t"><input type="text" name="perc" value="{perc}" maxlenght="255" class="t" style="width: 200px;"></td>
  </tr>
  <tr>
	<td class="tb">������</td>
	<td class="t">
	  <select name=status>
		<option value='Y'> �������
		<option value='N' {status}> ��������
	  </select>
	</td>
  </tr>
  <tr>
	<td class="tb">��������� �����</td>
	<td class="t">{date_log}</td>
  </tr>
  <tr>
	<td class="t" colspan=2 align=center><input type=submit value="���������">&nbsp;&nbsp;&nbsp;&nbsp;<input type=button value="�������" onClick="javascript:window.close();"></td>
  </tr>

</form>
</table>


</td>
</tr>
</table>

</body>
</html>
