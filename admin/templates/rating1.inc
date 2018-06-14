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
<p class=th>Выбор товаров для РЕЙТИНГА ПРОДАЖ</p>

<table width="100%" cellspacing="4" cellpadding="4" border="1" bgcolor="#FFFFFF" bordercolor="#dddddd" style="border-collapse: collapse;">
  <tr>
        <td colspan="{size}" align=center class=t><b>Магазины</b></td>
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
          <tr><td id='{tdid}' class=t align=center onClick="document.location.href='reklama1.php?item_id={tdid}&source=ratings'" onMouseOver="document.getElementById('{tdid}').style.cursor='pointer'">Добавить товар</td></tr>
          </table>
<!-- BEGIN list -->
<hr>
          <a href="rating1.php?action=del&id={ids}&shop={shop_id}&source=ratings" onClick="return confirm('Удалить товар из рейтинга продаж?')"><img src="images/delete.gif" width="16" height="16" border="0" alt="Удалить" titile="Удалить"></a>
          <a href="popup1.php?id={ids}&shop={shop_id}&source=ratings"><img src="images/edit.gif" width="16" height="16" border="0" alt="Редактировать ключевое свойство" titile="Редактировать ключевое свойство"></a>
          <a href="rating1.php?action=down&id={ids}&shop={shop_id}&source=ratings"><img src="images/down.gif" width="16" height="16" border="0" alt="Переместить вниз" titile="Переместить вниз"></a>
          <a href="rating1.php?action=up&id={ids}&shop={shop_id}&source=ratings"><img src="images/up.gif" width="16" height="16" border="0" alt="Переместить вверх" titile="Переместить вверх"></a>
          <a href="javascript:pop_win('../index.php?id={ids}', 'sample', 600, 800);">{names} {mark} {model}</a><br>
<!-- END list -->
<!-- BEGIN no_list -->
          <div align=center><br>Рейтинг не установлен</div>
<!-- END no_list -->
        </td>
<!-- END rating -->
  </tr>
</table>

<p align=center><input type=button value="Закрыть окно" onClick="window.close()"></p>

</body>
</html>
