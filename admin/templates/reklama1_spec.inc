<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" language="javascript">
<!--
  window.opener.document.send.{source}.value="{val}";
  window.opener.document.send.{source}_count.value="{items_count}";

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

<p class=th>Установка товаров для специального предложения</p>
<hr>
<p class=t>Выберите каталог в котором находится интересующий Вас товар.</p>

<p align=center><input type=button value="Закрыть окно" onClick="win_close('{call}');"></p>


<table width=100% border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;">

<!-- BEGIN inter -->
<tr>
  <td class=tb nowrap colspan=2>{otstup}<a href="reklama_spec.php?action=step2&cid={id}&spec_id={spec_id}&source={source}&call={call}&val={val}">{name}</a> <font class=t> ({total}/{total_filter})</font></td>
</tr>
<!-- END inter -->

</table>

<p align=center><input type=button value="Закрыть окно" onClick="win_close('{call}');"></p>

</body>
</html>