<script type="text/javascript" language="javascript">
<!--
function pop_win(url, win, ht, wd) {
  popwin = document.open(url,win,"width="+wd+",height="+ht+",toolbar=no,resizable=yes,scrollbars=yes");
}
function submitForm(id) {
  document.tablesForm.action.value = id;
  document.tablesForm.submit();
}
-->
</script>
<div class=title>���������� ���������

<!-- BEGIN add_name -->

<font class=error>(������� �������� ������� ��������)</font>

<!-- END add_name -->

<!-- BEGIN update -->

<font class=warning>(������ ������� �������� ���������)</font>

<!-- END update -->

<!-- BEGIN add -->

<font class=warning>(����� ������ �������� �������� � ���� ������)</font>

<!-- END add -->

<!-- BEGIN delete -->

<font class=warning>(������ �������� ������)</font>

<!-- END delete -->

</div>
<hr>
<table cellspacing=0 cellpadding=0 border=0>
<tr>
<td valign=top class=t>

<!-- BEGIN header_add -->

        <p class=th>�������� ����� ������ ��������</p>

<!-- END header_add -->

<!-- BEGIN header_edit -->

        <p class=th>������������� ������ ��������</p>

<!-- END header_edit -->

<table border="0" cellpadding="4" cellspacing="2">
<form action="index.php" method="POST">
<input type=hidden name=op value="catalog">
<input type=hidden name=action value="{action}">
<input type=hidden name=parent value="{parent}">
<input type=hidden name=id value="{id}">
<tr>
  <td class=tb align=right>��������: </td>
  <td class=t><input type=text style="width: 280px;" name=name value="{name}" class=t></td>
</tr>
<tr>
  <td class=t align=right valign=top>��������:</td>
  <td class=t><textarea style="width: 280px;" name=description rows=5 class=t>{description}</textarea></td>
</tr>
<tr>
  <td valign=top class=t align=right>���� ����� 2: </td>
  <td class=t><textarea style="width: 280px;" name=supertitle rows=5 class=t>{supertitle}</textarea></td>
</tr>
<tr>
  <td class=t>&nbsp;</td>

<!-- BEGIN submit_add -->

  <td class=t colspan=2><input type=submit name="{sadd}" value="�������� ���������"></td>

<!-- END submit_add -->

<!-- BEGIN submit_edit -->
  <td class=t colspan=2><input type=submit name="{sedit}" value="������ ���������"></td>
<!-- END submit_edit -->
</tr>
</form>
</table>
        <p class=th>������� ������ ��������</p>

<!-- BEGIN header -->

<table border="0" cellpadding="4" cellspacing="2">
  <tr>
        <td class=tb><a href=index.php?op=catalog&parent=2>������</a>{title}</td>
  </tr>
</table>

<!-- END header -->

        <p class=th>���������� ��������������</p>

<table border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">
<form action="index.php" method="POST" name="tablesForm">
<input type=hidden name=op value="catalog">
<input type=hidden name=action value="updown">
<input type=hidden name=parent value="{parent}">
<tr bgcolor="F3F3F3">
  <td class=tb align=center>&nbsp;</td>
  <td class=tb align=center>��������</td>
  <td class=tb align=center width=320>��������</td>
  <td class=tb align=center>��������</td>
</tr>

<!-- BEGIN up_parent -->
<tr>
  <td class=tb>&nbsp;</td>
  <td class=tb colspan=2><a href=index.php?op=catalog&parent={up_parent}>/.. �� ������� ����</a></td>
</tr>
<!-- END up_parent -->


<!-- BEGIN list -->
<tr>
  <td class=t nowrap valign=top>
        <img src="images/1p.gif" width="2" height="1">
        <input type="text" name="updown[{id}]" value="{updown}" size=4 maxlength=4>
        <img src=images/1p.gif width=2 height=1 border=0>
        <a href="javascript:pop_win('interes.php?action=cmove&id={id}&parent={parent}', '', 550, 400);"><img src="images/move.gif" width="16" height="16" border="0" alt="��������� � ������ �������" title="��������� � ������ �������"></a>
        <a href="index.php?op=catalog&action=edit_cat&id={id}&parent={parent}"><img src="images/edit.gif" width="16" height="16" border="0" alt="�������������" title="�������������"></a>
        <a href="catalog.php?action=del_cat&id={id}&parent={parent}" onClick="return confirm('������� ���������?')"><img src="images/delete.gif" width="16" height="16" border="0" alt="�������" titile="�������"></a>
<!-- BEGIN visible -->
        <a href="catalog.php?action=inv_cat&id={id}&parent={parent}" onClick="return confirm('������� ���� ������� ��������� ��� �����������?')"><img src="images/vis.gif" width="16" height="16" border="0" alt="������� ��������� ���������" titile="������� ��������� ���������"></a>
<!-- END visible -->
<!-- BEGIN invisible -->
        <a href="catalog.php?action=vis_cat&id={id}&parent={parent}" onClick="return confirm('������� ���� ������� ������� ��� �����������?')"><img src="images/inv.gif" width="16" height="16" border="0" alt="������� ��������� �������" title="������� ��������� �������"></a>
<!-- END invisible -->
<!-- BEGIN bottom_on -->
        <a href="catalog.php?action=bottom_on&id={id}&parent={parent}" onClick="return confirm('��������� ���� ������� �� ������ ����� �������?')"><img src="images/bottom_on.gif" width="16" height="16" border="0" alt="����� � ������ ����� ��������" titile="����� � ������ ����� ��������"></a>
<!-- END bottom_on -->
<!-- BEGIN bottom_off -->
        <a href="catalog.php?action=bottom_off&id={id}&parent={parent}" onClick="return confirm('�������� ���� ������� � ������ ����� �������?')"><img src="images/bottom_off.gif" width="16" height="16" border="0" alt="�� ����� � ������ ����� ��������" title="�� ����� � ������ ����� ��������"></a>
<!-- END bottom_off -->
        <img src="images/1p.gif" width="2" height="1">
  </td>
  <td class=t nowrap valign=top>
<!-- BEGIN shop -->
        <input type=checkbox name="shops[{id}][{shop_id}]" {checked} style="border: 1px solid #{color};">
<!-- END shop -->
  </td>
  <td class=t valign=top width=320>
        <a href="index.php?op=catalog&parent={id}"><b>{name}</b></a>&nbsp;({cat_count}/{count})<br><br>
    <center><b>���� �2</b><hr color=000000 width=100% noshade size=1>
    {supertitle}<hr color=000000 width=100% noshade size=1>
        </td>
  </td>
  <td class=t valign=top>{description}</td>
</tr>
<!-- END list -->
<tr bgcolor="F3F3F3">
  <td class=tb align=center><input type=submit value="���������������"></td>
  <td class=tb align=center><input type=submit value="����������" class="t" onClick="submitForm('reshop');"></td>
  <td colspan=2>&nbsp;</td>
</tr>
</table>

</form>


        </td>
  </tr>
</table>


