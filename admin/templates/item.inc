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


<div class=title>Каталог продукции
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
        <p class=th>Выбор категории</p>


  <table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="black">
  <tr>
        <td class=tb bgcolor="#f0f0f0" width=100%>
<table width="100%" cellspacing="1" cellpadding="3" border="0">
<tr>
        <form action=index.php method=get>
        <input type=hidden name=op value=item>
  <td>
        <select name=parent class=t onChange="this.form.submit();">
        <option value="2" class=t>Корень
        <!-- BEGIN select -->
        <option value="{id}"{selected} class={clas}>{otstup}{name} ({total})
        <!-- END select -->
        </select>
<!--        <input type=submit value="Просмотреть" class=t> -->
  </td>
        </form>
<td align=right>
  <input type="button" value="Дерево товаров" onClick="pop_win('tree.php?cid={parent}', 'tree', '700', '500');">
  <input type="button" value="Правый нижний (2 шт.)" onClick="pop_win('rating1.php?action=statu', 'statu', '500', '800');">
    <input type="button" value="Левый нижний (2 шт.)" onClick="pop_win('rating.php?action=new', 'new', '500', '800');">
  <input type="button" value="Рейтинги продаж" onClick="pop_win('rating.php?action=rating', 'rating', '500', '800');">
</td>
</tr>
</table>
        </td>
  </tr>
  </table>

<br>




<p class=th>
<!-- BEGIN header -->
          <table cellspacing="0" cellpadding="0" border="0">
          <tr>
          <td class=tb><span class=th>Товары категории</span>&nbsp;&nbsp;::&nbsp;&nbsp;<a href=index.php?op=item&parent=2>Корень</a>  {title}</td>
          <td class=t bgcolor="#f0f0f0" nowrap align=right>&nbsp;</td>
          </tr>
          </table>
<!-- END header -->
</p>

<table width="100%" cellspacing="2" cellpadding="0" border="0">
<tr>
  <td class=t><a href=index.php?op=item&action=add&parent={parent}&pages={pages}>Добавить новый товар в текущую категорию</a></td>
  <td class=t align=right>{nav_bar}</td>
</tr>
</table>

<form action=index.php method=post name=tablesForm>
<input type=hidden name=op value=item>
<input type=hidden name=pages value={pages}>
<input type=hidden name=parent value={parent}>

<table width="100%" cellspacing="4" cellpadding="4" border="1" bgcolor="#FFFFFF" bordercolor="#dddddd" style="border-collapse: collapse;">
<tr>
  <th class=tb>Действия</th>
  <th class=tb>Наименование</th>
  <th class=tb>Модель</th>
  <th class=tb>Артикул</th>
  <th class=tb>Цена<br>роз.</th>
  <th class=tb>Цена<br>опт.</th>
  <th class=tb>Магазины</th>
  <th class=tb colspan=4>Дополнительные<br>опции</th>
</tr>

<!-- BEGIN up_parent -->
<tr>
  <td class=tb>&nbsp;</td>
  <td class=tb colspan=8><a href=index.php?op=item&parent={up_parent}>/.. На уровень выше</a></td>
</tr>
<!-- END up_parent -->

<!-- BEGIN tovar -->
<tr>
  <td class=t nowrap valign=middle>
        <img src=images/1p.gif width=2 height=1 border=0>
        <input type=checkbox name=item_del[] value={id}>
        <img src=images/1p.gif width=2 height=1 border=0>
        <input type="text" name="updown[{id}]" value="{updown}" size=4 maxlength=4>
        <img src=images/1p.gif width=2 height=1 border=0>
        <a href="javascript:pop_win('interes.php?action=move&id={id}&pages={pages}', '', 550, 400);"><img src="images/move.gif" width="16" height="16" border="0" alt="Перенести в другой каталог" title="Перенести в другой каталог"></a>
        <img src="images/1p.gif" width="2" height="1" border="0">
        <a href="index.php?op=item&action=item_edit&id={id}&parent={parent}&pages={pages}"><img src="images/edit.gif" width="16" height="16" border="0" alt="Редактировать" title="Редактировать"></a>
        <a href="index.php?op=item&action=item_delete&id={id}&parent={parent}&pages={pages}" onClick="return confirm('Удалить товар?')"><img src="images/delete.gif" width="16" height="16" border="0" alt="Удалить" title="Удалить"></a>
<!-- BEGIN item_visible -->
        <a href="index.php?op=item&action=item_inv&id={id}&parent={parent}&pages={pages}" onClick="return confirm('Сделать этот товар невидимым для посетителей?')"><img src="images/vis.gif" width="16" height="16" border="0" alt="Сделать товар невидимым" title="Сделать товар невидимым"></a>
<!-- END item_visible -->
<!-- BEGIN item_invisible -->
        <a href="index.php?op=item&action=item_vis&id={id}&parent={parent}&pages={pages}" onClick="return confirm('Сделать этот товар видимым для посетителей?')"><img src="images/inv.gif" width="16" height="16" border="0" alt="Сделать товар видимым" title="Сделать товар видимым"></a>
<!-- END item_invisible -->
        <img src="images/1p.gif" width="2" height="1" border="0">
<!-- BEGIN item_yml1 -->
        <a href="index.php?op=item&action=item_ymln&id={id}&parent={parent}&pages={pages}"><img src="images/ym1.gif" width="16" height="16" border="0" alt="убрать из Маркета" title="убрать из Маркета"></a>
<!-- END item_yml1 -->
<!-- BEGIN item_yml0 -->
        <a href="index.php?op=item&action=item_ymly&id={id}&parent={parent}&pages={pages}"><img src="images/ym0.gif" width="16" height="16" border="0" alt="Показывать на Yandex Маркет" title="Показывать на Yandex Маркет"></a>
<!-- END item_yml0 -->
        <img src="images/1p.gif" width="2" height="1" border="0">
  </td>
  <td class=t width=100%>&nbsp;<a href="javascript:pop_win('../index.php?id={id}', '', 600, 800);">{name}</a></td>
  <td class=tr>{model}&nbsp;</td>
  <td class=tr>{sku}&nbsp;</td>
  <td class=tr>{price}&nbsp;</td>
  <td class=tr>{price_opt}&nbsp;</td>
  <td class=t nowrap>
<!-- BEGIN shop -->
        <input type=checkbox name="shops[{id}][{shop_id}]" {checked} style="border: 1px solid #{color};">
<!-- END shop -->
  </td>
  <td class=t nowrap><a href="javascript:pop_win('reklama_cms.php?item_id={id}&parent={parent}&pages={pages}&source=article', 'article', 650, 600);">Статьи</a> ({count_article})</td>
  <td class=t nowrap><a href="javascript:pop_win('reklama.php?item_id={id}&parent={parent}&pages={pages}&source=part', 'part', 550, 400);">Связаные</a> ({count_part})</td>
  <td class=t nowrap><a href="javascript:pop_win('reklama.php?item_id={id}&parent={parent}&pages={pages}&source=spec', 'spec', 550, 400);">Рекоменд.</a> ({count_spec})</td>
  <td class=t nowrap><a href="javascript:pop_win('reference.php?db=statu&item_id={id}&source=items&val={statu}', 'statu', 650, 600);">Свойства</a> ({count_statu})</td>
</tr>
<!-- END tovar -->

<!-- BEGIN no_tovar -->
<tr>
  <td colspan=8 align=center class=th>В данной категории товар отсуствует{nbsp}</td>
</tr>
<!-- END no_tovar -->


<!-- BEGIN group -->
<tr>
  <td class=t colspan=6 valign=middlle>
        <img src=images/1p.gif width=2 height=1 border=0>
        <img src=images/arrow_ltr.gif width=38 height=22>
        <a href="index.php?op=item&checkall=1" onclick="setCheckboxes('tablesForm', true); return false;">Отметить все</a>
        &nbsp;|&nbsp;
        <a href="index.php?op=item" onclick="setCheckboxes('tablesForm', false); return false;">Снять отметку</a>
        &nbsp;&nbsp;&nbsp;
        <select name="action" dir="ltr" class=t>
          <option selected="selected">С отмеченными:</option>
          <option value="item_alldell">Удалить</option>
          <option value="item_allmove">Перенести</option>
          <option value="item_allvis">Сделать видимыми</option>
          <option value="item_allinv">Сделать невидимыми</option>
          <option value="item_reorder">Пересортировать</option>
        </select>
        <input type="submit" value="Выполнить" class="t" onClick="return confirm('Подтвердите выполнение групповой операции?')">
  </td>
  <td>
        <input type="submit" value="Установить" class="t" onClick="submitForm('reshop');">
  </td>
  <td colspan=3>&nbsp;</td>
</tr>
<!-- END group -->

</form>
</table>

<table width="100%" cellspacing="2" cellpadding="0" border="0">
<tr>
  <td class=t><a href=index.php?op=item&action=add&parent={parent}&pages={pages}>Добавить новый товар в текущую категорию</a></td>
  <td class=t align=right>{nav_bar}</td>
</tr>
</table>


        </td>
  </tr>
</table>
