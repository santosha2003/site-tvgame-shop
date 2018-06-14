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
<div class=title>Менеджер страниц
<!-- BEGIN url -->
<font class=error>(Поле "Имя файла" должно быть заполненшо)</font>
<!-- END url -->
<!-- BEGIN update -->
<font class=warning>(Таблица страниц обновлена)</font>
<!-- END update -->
<!-- BEGIN delete -->
<font class=warning>(Страница удалена)</font>
<!-- END delete -->
<!-- BEGIN dupe -->
<font class=error>(Такое Имя файла уже используется)</font>
<!-- END dupe -->
</div>
<br>


<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td valign=top class=t>


          <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
          <td class=tb>:: <a href=index.php?op=cms&parent=1>Корень</a>  {path}</td>
          </tr>
          </table>
<br>
<div class=th>Список страниц</div>

<table width="100%" border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">
<form action=index.php method=post name=tablesForm>
<input type=hidden name=op value=cms>

<tr bgcolor="#F3F3F3">
  <th class=tb>Действия</th>
  <th class=tb>Имя файла</th>
  <th class=tb>Заголовок в меню</th>
  <th class=tb>Магазины</th>
  <th class=tb>Заголовок на странице</th>
</tr>

<!-- BEGIN up_parent -->
<tr>
  <td class=tb>&nbsp;</td>
  <td class=tb colspan=3><a href=index.php?op=cms&parent={up_parent}>/.. На уровень выше</a></td>
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
        <a href=index.php?op=cms&action=edit&id={id}><img src=images/edit.gif width=16 height=16 border=0 alt="Редактировать"></a>
        <a href=index.php?op=cms&action=del&id={id} onClick="return confirm('Удалить эту страницу?')"><img src=images/delete.gif width=16 height=16 border=0 alt="Удалить"></a>
<!-- BEGIN vis -->
        <a href=index.php?op=cms&action=inv&id={ids} onClick="return confirm('Удалить из меню?')"><img src=images/vis.gif width=16 height=16 border=0 alt="Выключить из меню"></a>
<!-- END vis -->
<!-- BEGIN inv -->
        <a href=index.php?op=cms&action=vis&id={ids} onClick="return confirm('Добавить в меню?')"><img src=images/inv.gif width=16 height=16 border=0 alt="Добавить в меню"></a>
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
        <a href="index.php?op=cms&checkall=1" onclick="setCheckboxes('tablesForm', true); return false;">Отметить все</a>
        &nbsp;|&nbsp;
        <a href="index.php?op=cms" onclick="setCheckboxes('tablesForm', false); return false;">Снять отметку</a>
        &nbsp;&nbsp;&nbsp;
        <select name="action" dir="ltr" class=t>
          <option value="reorder" selected="selected">С отмеченными:</option>
          <option value="alldell">Удалить</option>
          <option value="allvis">Добавить в меню</option>
          <option value="allinv">Удалить из меню</option>
          <option value="reorder">Пересортировать</option>
        </select>
        <input type="submit" value="Выполнить" class="t" onClick="return confirm('Подтвердите выполнение групповой операции?')">
  </td>
  <td align=center>
        <input type="submit" value="Установить" class="t" onClick="submitForm('reshop');">
  </td>
  <td></td>
</tr>
<!-- END group -->
</form>
</table>
<bR>
<!-- BEGIN add -->
<div class=th>Добавить страницу</div>

<table width="100%" border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">
<form action=index.php method=POST>
<input type=hidden name=op value=cms>
<input type=hidden name=action value=add>
<input type=hidden name=menu value="">
<tr>
  <td class=tb align=right width=130 nowrap>Имя файла :&nbsp;&nbsp;</td>
  <td>&nbsp;&nbsp;<input type=text name=url style="width: 180px;">&nbsp;&nbsp;<input type=submit value="Добавить"></td>
</tr>
</table></form>
<!-- END add -->


</td>
</tr>
</table>
