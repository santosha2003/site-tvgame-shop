<div class=title>���������� ���������������
<!-- BEGIN nopass -->
<font class=error>(������� ������ ��������������)</font>
<!-- END nopass -->
<!-- BEGIN mismatch -->
<font class=error>(������ �� ���������)</font>
<!-- END mismatch -->
<!-- BEGIN dupe -->
<font class=error>(������������� � ����� ������ ��� ����������)</font>
<!-- END dupe -->
<!-- BEGIN update -->
<font class=warning>(��������� �������)</font>
<!-- END update -->
<!-- BEGIN add -->
<font class=warning>(����� ������������� ��������)</font>
<!-- END add -->
<!-- BEGIN delete -->
<font class=warning>(������������� ������)</font>
<!-- END delete -->
<!-- BEGIN warning -->
<font class=error>(������ ������� ���������� ��������������)</font>
<!-- END warning -->
</div>
<hr>

<table cellspacing=0 cellpadding=0 border=0>
<tr>
<td valign=top class=t>

	<p class=th>�������� ������ �������������</p>

	<table border="0" cellpadding="4" cellspacing="2">
	<form action=index.php method=POST>
	<input type=hidden name=op value="admin">
	<input type=hidden name=action value="{action}">
	<input type=hidden name=id value="{id}">
	  <tr>
		<td class=tb align=right>����� : </td>
		<td class=t><input type=text name=username class=t value="{username}" style="width: 150px;"></td>
	  </tr>
	  <tr>
		<td class=tb align=right>������ : </td>
		<td class=t><input type=password name=password class=t style="width: 150px;"></td>
	  </tr>
	  <tr>
		<td class=tb align=right>������ <span class=t>(�������������)</span> : </td>
		<td class=t><input type=password name=password1 class=t style="width: 150px;"></td>
	  </tr>
	  <tr>
		<td class=t align=right>��� : </td>
		<td class=t><input type=text name=fio class=t value="{fio}" style="width: 350px;"></td>
	  </tr>
	  <tr>
		<td class=t align=right>��������� : </td>
		<td class=t><input type=text name=role class=t value="{role}" style="width: 350px;"></td>
	  </tr>
	  <tr>
		<td class=t align=right>E-Mail : </td>
		<td class=t><input type=text name=email class=t value="{email}" style="width: 350px;"></td>
	  </tr>
	  <tr>
		<td class=t align=right>������ : </td>
		<td class=t>
		  <select name=perm class=t style="width: 350px;">
			<option value="oper"{oper}>��������
			<option value="disp"{disp}>���������
		  </select>
		</td>
	  </tr>
	  <tr>
		<td class=t>&nbsp;</td>
		<td class=t><input type=submit class=t></td>
	  </tr>
	</form>
	</table>
	
	<p class=th>������ ���������������</p>
	
	<table border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">
	<tr bgcolor="#F3F3F3">
	  <td class="tb" nowrap>&nbsp;</td>
	  <td class="tb" nowrap>�����</td>
	  <td class="tb" nowrap>���������</td>
	  <td class="tb">���</td>
	  <td class="tb" nowrap>E-Mail</td>
	  <td class="tb" nowrap>������</td>
	  <td class="tb" nowrap>��������� �����</td>
	</tr>
	
	<!-- BEGIN list -->
	<tr>
	  <td class="t" nowrap align=center>
		&nbsp;&nbsp;
		<a href="index.php?op=admin&action=edit&id={id}"><img src="images/edit.gif" width="16" height="16" border="0" alt="�������������" title="�������������"></a>
		<a href="admin.php?action=del&id={id}" onClick="return confirm('������� �������������� {username}?')"><img src="images/delete.gif" width="16" height="16" border="0" alt="�������" title="�������"></a>
		&nbsp;&nbsp;
	  </td>
	  <td class="t">{username}</td>
	  <td class="t">{role}</td>
	  <td class="t">{fio}</td>
	  <td class="t" nowrap>{email}</td>
<!-- BEGIN oper -->
	  <td class="t" nowrap>��������</td>
<!-- END oper -->
<!-- BEGIN disp -->
	  <td class="t" nowrap>���������</td>
<!-- END disp -->
	  <td class="t" nowrap>{last}</td>
	</tr>
	
	<!-- END list -->
	</table>


</td>
</tr>
</table>
