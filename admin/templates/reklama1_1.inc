<html>
<head><link rel="stylesheet" type="text/css" href="style.css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
<script type="text/javascript" language="javascript">
<!--
  window.opener.document.send.{source}.value="{val}";

  function win_close(a) {
        if (a != 'add_item') {
          window.opener.location.reload();
        }
        window.close();
  }
-->
</script>
</head>

<body bgcolor=white>

<p class=th>Установка рекламного товара</p>
<hr>
<p class=t>Выберите каталог в котором находится интересующий Вас товар.</p>

<p align=center><input type=button value="Внести изменения" onClick="win_close('{call}');"></p>

<div class=t align=right width=100%><a href="javascript:win_close('{call}');">Вернуться к списку товаров</a></div>


<table width=100% border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">

<!-- BEGIN inter -->
<tr>
  <td class=tb nowrap colspan=2>{otstup}<a href="reklama1.php?action=step2&cid={id}&parent={parent}&item_id={item_id}&pages={pages}&source={source}&call={call}&val={val}">{clas}{name}{endclas}</a> <font class=t> ({total}/{total_filter})</font></td>
</tr>
<!-- END inter -->

</table>

<div class=t align=right width=100%><a href="javascript:win_close('{call}');">Вернуться к списку товаров</a></div>

<p align=center><input type=button value="Внести изменения" onClick="win_close('{call}');"></p>

</body>
</html>
