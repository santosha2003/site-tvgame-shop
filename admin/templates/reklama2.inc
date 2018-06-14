<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" language="javascript">
<!--

  function win_close(a) {
	if (a != 'add_item') {
	  window.opener.location.reload();
	}
	window.close();  
  }

function pop_win(url, win, ht, wd) {
  popwin = document.open(url,win,"width="+wd+",height="+ht+",toolbar=no,resizable=yes,scrollbars=yes");
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
-->
</script>

</head>
<body bgcolor=white>

<p class=th>Установка рекламного товара</p>
<hr>
<div class=t align=right width=100%><a href="javascript:win_close('{call}');">Вернуться к списку товаров</a></div>

<table width=100% border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">

<form action=reklama.php method=POST name=tablesForm>
<input type="hidden" name="action" value="step3">
<input type="hidden" name="parent" value="{parent}">
<input type="hidden" name="item_id" value="{item_id}">
<input type="hidden" name="pages" value="{pages}">
<input type="hidden" name="source" value="{source}">
<input type="hidden" name="call" value="{call}">
<input type="hidden" name="val" value="{val}">
<input type="hidden" name="cid" value="{cid}">
<tr>
  <th class=tb bgcolor="#F3F3F3">&nbsp;</th>
  <th class=tb bgcolor="#F3F3F3">Наименование</th>
  <th class=tb bgcolor="#F3F3F3">Цена</th>
</tr>

<!-- BEGIN tovar -->
<tr>
  <td class=tb align=center><input type=checkbox name=item_del[] value={id} {checked}></td>
  <td class=t width=100%>&nbsp;<a href="javascript:pop_win('../index.php?op=item&id={id}', '', 600, 800);">{name}</a></td>
  <td class=t align=right>{price}&nbsp;</td>
</tr>
<!-- END tovar -->

<!-- BEGIN no_tovar -->
<tr>
  <td colspan=3 align=center class=t>В данной категории товар отсуствует{nbsp}</td>
</tr>
<!-- END no_tovar -->

<tr>
  <td class=t colspan=3 valign=middlle>
	<img src=images/1p.gif width=2 height=1 border=0>
	<img src=images/arrow_ltr.gif width=38 height=22>
	<input type="submit" value="Выполнить" class="t">
	<a href="index.php?op=item&checkall=1" onclick="setCheckboxes('tablesForm', true); return false;">Отметить все</a>
	&nbsp;|&nbsp;
	<a href="index.php?op=item" onclick="setCheckboxes('tablesForm', false); return false;">Снять отметку</a>
	&nbsp;&nbsp;&nbsp;
  </td>
</tr>

</table>

<div class=t align=right width=100%><a href="javascript:win_close('{call}')">Вернуться к списку товаров</a></div>


</body>
</html>