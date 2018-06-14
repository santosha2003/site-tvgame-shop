<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
<link rel="stylesheet" type="text/css" href="style.css"></head>
<body bgcolor=white>

<p class=th>Установка статей для специального предложения</p>
<hr>
<p class=t>Отметьте статьи которые ассоциируются с этим предложением.</p>

<form action=reklama_spec_cms.php method=POST>
<input type=hidden name=action value=step2>
<input type=hidden name=spec_id value={spec_id}>
<input type=hidden name=source value={source}>
<input type=hidden name=call value={call}>
<input type=hidden name=val value={val}>
<p align=center><input type=submit value="Внести изменения"></p>

<div class=t align=right width=100%><a href="javascript:window.close();">Вернуться к списку предложений</a></div>


<table width=100% border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">

<!-- BEGIN inter -->
<tr>
  <td class=tb nowrap colspan=2>{otstup}<input type=checkbox name=ids[] value="{id}" {total_filter}>{title}</td>
</tr>
<!-- END inter -->
</table>

<div class=t align=right width=100%><a href="javascript:window.close();">Вернуться к списку предложенией</a></div>

<p align=center><input type=submit value="Внести изменения"></p>
</form>

</body>
</html>