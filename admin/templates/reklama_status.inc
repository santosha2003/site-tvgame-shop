<html>
<head><link rel="stylesheet" type="text/css" href="style.css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
</head>

<body bgcolor=white>

<p class=th>Установка статусов для товара</p>
<hr>
<p class=t>Отметьте статусы которые ассоциируются с этим товаром.</p>

<form action=reklama_cms.php method=POST>
<input type=hidden name=action value=step2>
<input type=hidden name=parent value={parent}>
<input type=hidden name=item_id value={item_id}>
<input type=hidden name=pages value={pages}>
<input type=hidden name=source value={source}>
<input type=hidden name=call value={call}>
<input type=hidden name=val value={val}>

<p align=center><input type=submit value="Внести изменения"></p>

<div class=t align=right width=100%><a href="javascript:window.close();">Вернуться к списку товаров</a></div>

<table width=100% border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">

<tr>
  <td class=tb nowrap colspan=4></td>
  <td class=tb valign=top align=center><img src="../images/pict/{photo}" border="0"></td>
  <td class=tb valign=top width=100%>&nbsp;&nbsp;&nbsp;{name}</td>
</tr>


<!-- BEGIN list -->
<tr>
  <td class=tb nowrap colspan=2>
  <input type=checkbox name=ids[] value="{id}"></td>
  <td class=tb valign=top align=center><img src="../images/pict/{photo}" border="0"></td>
  <td class=tb valign=top width=100%>&nbsp;&nbsp;&nbsp;{name}</td>
</tr>
<!-- END list -->
</table>

<div class=t align=right width=100%><a href="javascript:window.close();">Вернуться к списку товаров</a></div>

<p align=center><input type=submit value="Внести изменения"></p>
</form>

</body>
</html>