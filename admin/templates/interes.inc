<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" language="javascript">
<!--
  function pop_win(url, win, ht, wd) {
  popwin = document.open(url,win,"width="+wd+",height="+ht+",toolbar=no,resizable=yes,scrollbars=yes");
}
-->
</script>

</head>
<body bgcolor=white>


<!-- BEGIN main_move -->
<font face=arial size=2>
<b><font size=3 color="gray">������� ������ � ������ �������</font></b>
<hr noshade>
������� ������ N {id} <a href="javascript:pop_win('../index.php?id={id}', '', 500, 550);"><font color="green">{name}</font></a> � ������ �������
<!-- END main_move -->

<!-- BEGIN main_allmove -->
<font face=arial size=2>
<b><font size=3>��������� ������� ������� � ������ �������</font></b>
<!-- END main_allmove -->

<!-- BEGIN main_interes -->
<font face=arial size=2>
<b><font size=3>���������� ������</font></b>
<hr noshade>
��������� "����������� ������" ��� <a href="javascript:pop_win('../index.php?id={id}', '', 500, 550);">{name}</a>
<!-- END main_interes -->

<!-- BEGIN main_category -->
<font face=arial size=2>
<b><font size=3>������� ������� �������� "{name}" � ������ ������ ��������</font></b>
<hr noshade>
��� �������� �������� ��� ������ � ������������ ����� ���� ����������.
</font>
<!-- END main_category -->


<!-- BEGIN acti -->
<form name=interes action=interes.php method=post>
<input type=hidden name=id value={id}>
<input type=hidden name=action value={action}>
<input type=hidden name=parent value={parent}>
<input type=hidden name=pages value={pages}>
<!-- END acti -->

<!-- BEGIN group -->
  <input type=hidden name=id[] value={id}>
<!-- END group -->

<hr noshade>
<input type=submit value="����������">
<input type=button value="������� ����" onClick="window.opener.location.reload();window.close();">

<hr noshade>

<table>
<!-- BEGIN inter -->
<tr>

<!-- BEGIN inter_empty -->
  <td class=t nowrap colspan=2><font color=red>{otstup}<input type=radio name=ops disabled><b>{name}</b></font></td>
<!-- END inter_empty -->

<!-- BEGIN inter_noempty -->
  <td class=t nowrap colspan=2>{otstup}<input type=radio name=ops value={id}>{name}</td>
<!-- END inter_noempty -->

<!-- BEGIN inter_noempty_interes -->
  <td class=t nowrap colspan=2>{otstup}<input type=checkbox name=ops[{id}]{checked}>{name}</td>
<!-- END inter_noempty_interes -->

</tr>
<!-- END inter -->
</table>

<hr noshade>
<table cellpadding=5 cellspacing=0 border=0>
<tr>
  <td><input type=submit value="����������"></td>
</form>
  <td><input type=button value="������� ����" onClick="window.close();"></td>
</tr>
</table>
</body>
</html>