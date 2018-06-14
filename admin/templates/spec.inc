<script type="text/javascript" language="javascript">
<!--
function pop_win(url, win, ht, wd) {
  document.open(url,win,"width="+wd+",height="+ht+",toolbar=no,resizable=yes,scrollbars=yes");
}

function setCheckboxes(the_form, do_check) {
    var elts      = (typeof(document.forms[the_form].elements['spec_del[]']) != 'undefined')
                  ? document.forms[the_form].elements['spec_del[]']
                  : document.forms[the_form].elements['spec_del[]'];
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


<div class=title>Специальные предложения (верхние два товара)
<!-- BEGIN visible -->
<font class=warning>(Товар стал видим для посетителей)</font>
<!-- END visible -->
<!-- BEGIN novisible -->
<font class=warning>(Товар стал невидим для посетителей)</font>
<!-- END novisible -->
<!-- BEGIN update -->
<font class=warning>(Данные о товаре обновлены)</font>
<!-- END update -->
<!-- BEGIN add -->
<font class=warning>(Товар добавлен в текущую категорию)</font>
<!-- END add -->
<!-- BEGIN delete -->
<font class=warning>(Товар удален)</font>
<!-- END delete -->
</div>
<hr>

<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td valign=top class=t>

<table width="100%" cellspacing="2" cellpadding="0" border="0">
<tr>
  <td class=t><a href=index.php?op=spec&action=add>Добавить новое предложение</a></td>
  <td class=t align=right>{nav_bar}</td>
</tr>
</table>

<form action=index.php method=post name=tablesForm>
<input type=hidden name=op value=spec>
<input type=hidden name=pages value={pages}>

<table width="100%" cellspacing="4" cellpadding="4" border="1" bgcolor="#FFFFFF" bordercolor="#dddddd" style="border-collapse: collapse;">
<tr>
  <th class=tb>Действия</th>
  <th class=tb>Начало</th>
  <th class=tb>Окончание</th>
  <th class=tb>Наименование</th>
  <th class=tb colspan=2>Доп. опции</th>
</tr>

<!-- BEGIN tovar -->
<tr>
  <td class=t nowrap valign=middle>
	<img src=images/1p.gif width=2 height=1 border=0>
	<input type=checkbox name=spec_del[] value={id}>
	<img src=images/1p.gif width=2 height=1 border=0>
	<a href="index.php?op=spec&action=spec_edit&id={id}"><img src="images/edit.gif" width="16" height="16" border="0" alt="Редактировать" title="Редактировать"></a>
	<a href="index.php?op=spec&action=spec_delete&id={id}" onClick="return confirm('Удалить предложение?')"><img src="images/delete.gif" width="16" height="16" border="0" alt="Удалить" title="Удалить"></a>
<!-- BEGIN spec_visible -->
	<a href="index.php?op=spec&action=spec_inv&id={id}" onClick="return confirm('Сделать это предложение невидимым для посетителей?')"><img src="images/vis.gif" width="16" height="16" border="0" alt="Актуально" title="Актуально"></a>
<!-- END spec_visible -->
<!-- BEGIN spec_invisible -->
	<a href="index.php?op=spec&action=spec_vis&id={id}" onClick="return confirm('Сделать это предложение видимым для посетителей?')"><img src="images/inv.gif" width="16" height="16" border="0" alt="Неактуально" title="Неактуально"></a>
<!-- END spec_invisible -->
	<img src="images/1p.gif" width="2" height="1" border="0">
  </td>
  <td class=tr>{start_date}&nbsp;</td>
  <td class=tr>{end_date}&nbsp;</td>
  <td class=t width=100%>&nbsp;{name}</td>
  <td class=t nowrap><a href="javascript:pop_win('reklama_spec.php?spec_id={id}&source=items', 'items', 550, 400);">Товары</a> ({items_count})</td>
  <td class=t nowrap><a href="javascript:pop_win('reklama_spec_cms.php?spec_id={id}&source=article', 'article', 650, 600);">Статьи</a> ({article_count})</td>
</tr>
<!-- END tovar -->

<!-- BEGIN no_tovar -->
<tr>
  <td colspan=6 align=center class=th>Нет спецпредложений{nbsp}</td>
</tr>
<!-- END no_tovar -->


<!-- BEGIN group -->
<tr>
  <td class=t colspan=6 valign=middlle>
	<img src=images/1p.gif width=2 height=1 border=0>
	<img src=images/arrow_ltr.gif width=38 height=22>
	<a href="index.php?op=spec&checkall=1" onclick="setCheckboxes('tablesForm', true); return false;">Отметить все</a>
	&nbsp;|&nbsp;
	<a href="index.php?op=spec" onclick="setCheckboxes('tablesForm', false); return false;">Снять отметку</a>
	&nbsp;&nbsp;&nbsp;
	<select name="action" dir="ltr" class=t>
	  <option selected="selected">С отмеченными:</option>
	  <option value="spec_alldell">Удалить</option>
	  <option value="spec_allvis">Сделать актуальными</option>
	  <option value="spec_allinv">Сделать неактуальными</option>
	</select>
	<input type="submit" value="Выполнить" class="t" onClick="return confirm('Подтвердите выполнение групповой операции?')">
  </td>
</tr>
<!-- END group -->

</form>
</table>

<table width="100%" cellspacing="2" cellpadding="0" border="0">
<tr>
  <td class=t><a href=index.php?op=spec&action=add>Добавить новое предложение</a></td>
  <td class=t align=right>{nav_bar}</td>
</tr>
</table>


	</td>
  </tr>
</table>
