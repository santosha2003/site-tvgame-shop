<script type="text/javascript" language="javascript">
<!--
function pop_win(url, win, ht, wd) {
  document.open(url,win,"width="+wd+",height="+ht+",toolbar=no,resizable=yes,scrollbars=yes");
}

function setCheckboxes(the_form, do_check) {
    var elts      = (typeof(document.forms[the_form].elements['item_del[]']) != 'undefined')
                  ? document.forms[the_form].elements['item_del[]']
                  : document.forms[the_form].elements['item_del[]'];
    var elts_cnt  = (typeof(elts.length) != 'undefined')
                  ? elts.length
                  : 0;

    if (elts_cnt) {
        for (var i=0;i<elts_cnt;i++) {
            elts[i].checked = do_check;
        }
    } else {
        elts.checked        = do_check;
    }

    return true;
}

function submitForm(id) {
  document.tablesForm.action[0].value = id;
  document.tablesForm.submit();
}

-->
</script>
<div class=title>�������� �������
<!-- BEGIN url -->
<font class=error>(���� "��� �����" ������ ���� ����������)</font>
<!-- END url -->
<!-- BEGIN update -->
<font class=warning>(������� ������� ���������)</font>
<!-- END update -->
<!-- BEGIN delete -->
<font class=warning>(�������� �������)</font>
<!-- END delete -->
<!-- BEGIN dupe -->
<font class=error>(����� ��� ����� ��� ������������)</font>
<!-- END dupe -->
</div>
<br>


<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td valign=top class=t>


          <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
          <td class=tb>:: <a href=index.php?op=cms&parent=1>������</a>  {path}</td>
          </tr>
          </table>
<br>
<div class=th>������ �������</div>

<table width="100%" border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">
<form action=index.php method=post name=tablesForm>
<input type=hidden name=op value=cms>

<tr bgcolor="#F3F3F3">
  <th class=tb>��������</th>
  <th class=tb>��� �����</th>
  <th class=tb>��������� � ����</th>
  <th class=tb>��������</th>
  <th class=tb>��������� �� ��������</th>
</tr>

<!-- BEGIN up_parent -->
<tr>
  <td class=tb>&nbsp;</td>
  <td class=tb colspan=3><a href=index.php?op=cms&parent={up_parent}>/.. �� ������� ����</a></td>
</tr>
<!-- END up_parent -->

<!-- BEGIN list -->
<tr>
  <td align="center" class=t nowrap width=130>
        <img src=images/1p.gif width=2 height=1 border=0>
        <input type=checkbox name=item_del[] value={id}>
        <img src=images/1p.gif width=2 height=1 border=0>
        <input type="text" name="updown[{id}]" value="{updown}" size=4 maxlength=4 style="width: 30px;">
        <img src=images/1p.gif width=2 height=1 border=0>
        <a href=index.php?op=cms&action=edit&id={id}><img src=images/edit.gif width=16 height=16 border=0 alt="�������������"></a>
        <a href=index.php?op=cms&action=del&id={id} onClick="return confirm('������� ��� ��������?')"><img src=images/delete.gif width=16 height=16 border=0 alt="�������"></a>
<!-- BEGIN vis -->
        <a href=index.php?op=cms&action=inv&id={ids} onClick="return confirm('������� �� ����?')"><img src=images/vis.gif width=16 height=16 border=0 alt="��������� �� ����"></a>
<!-- END vis -->
<!-- BEGIN inv -->
        <a href=index.php?op=cms&action=vis&id={ids} onClick="return confirm('�������� � ����?')"><img src=images/inv.gif width=16 height=16 border=0 alt="�������� � ����"></a>
<!-- END inv -->
        <img src=images/1p.gif width=2 height=1 border=0>
  </td>
  <td class=tb align=right><a href=?op=cms&parent={id}>{url}</a>&nbsp;&nbsp;</td>
  <td class=t>{shorttitle}&nbsp;&nbsp;</td>
  <td class=t align=center nowrap>
<!-- BEGIN shop -->
        <input type=checkbox name="shops[{id}][{shop_id}]" {checked} style="border: 1px solid #{color};">
<!-- END shop -->
  </td>
  <td class=t>{title}&nbsp;&nbsp;</td>
</tr>
<!-- END list -->

<!-- BEGIN group -->
<tr>
  <td class=t colspan=3 valign=middlle>
        <img src=images/1p.gif width=2 height=1 border=0>
        <img src=images/arrow_ltr.gif width=38 height=22>
        <a href="index.php?op=cms&checkall=1" onclick="setCheckboxes('tablesForm', true); return false;">�������� ���</a>
        &nbsp;|&nbsp;
        <a href="index.php?op=cms" onclick="setCheckboxes('tablesForm', false); return false;">����� �������</a>
        &nbsp;&nbsp;&nbsp;
        <select name="action" dir="ltr" class=t>
          <option value="reorder" selected="selected">� �����������:</option>
          <option value="alldell">�������</option>
          <option value="allvis">�������� � ����</option>
          <option value="allinv">������� �� ����</option>
          <option value="reorder">���������������</option>
        </select>
        <input type="submit" value="���������" class="t" onClick="return confirm('����������� ���������� ��������� ��������?')">
  </td>
  <td align=center>
        <input type="submit" value="����������" class="t" onClick="submitForm('reshop');">
  </td>
  <td></td>
</tr>
<!-- END group -->
</form>
</table>
<bR>
<!-- BEGIN add -->
<div class=th>�������� ��������</div>

<table width="100%" border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">
<form action=index.php method=POST>
<input type=hidden name=op value=cms>
<input type=hidden name=action value=add>
<input type=hidden name=menu value="">
<tr>
  <td class=tb align=right width=130 nowrap>��� ����� :&nbsp;&nbsp;</td>
  <td>&nbsp;&nbsp;<input type=text name=url style="width: 180px;">&nbsp;&nbsp;<input type=submit value="��������"></td>
</tr>
</table></form>
<!-- END add -->


</td>
</tr>
</table>
