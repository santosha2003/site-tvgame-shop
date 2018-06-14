           <div class=title>Статистика посещений категории "{catname}" </div>
<hr><br>
 <table cellspacing=0 cellpadding=1 border=0 width=60% align=center>
<tr>
<td valign=top class=t bgcolor="999999">
<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td valign=top class=t bgcolor="ffffff" align=center><br>

<span style="font-size:16pt;"><b><font color="black" face="Tahoma">Количество посетителей &nbsp;</font></b></span>
<!-- BEGIN list_count -->
<span style="font-size:16pt;"><b><font color="red">{count}
</font></b></span>
<!-- END list_count -->
<br>
<hr color="666666" size=1 noshade>
<span style="font-size:12pt;"><b><font color="000000" face="Tahoma">IP-адреса посетителей</font></b></span>
<hr color="666666" size=1 noshade>
<!-- BEGIN list -->
<span style='font-size:12pt;'><font color='000000' face='Tahoma'>{ip}</font></span><br>
<!-- END list -->
<!-- BEGIN no_ip -->
<span style='font-size:12pt;'><font color='000000' face='Tahoma'>Нет посетителей :(</font></span><br>
<!-- END no_ip -->
<hr color="666666" size=1 noshade><br><br>
</td></tr></table>
 </td></tr></table><br>
 <center><a href="index.php?op=allstat&mode=delete&pid={pid}" class=navi>Сбросить счетчик и очистить базу IP-адресов</a></center>
 <br><br>


 <table border="0" cellpadding="0" cellspacing="0" width="100%" align=center>
  <tr>
        <td class=tb align=center><br>
   <form action=index.php method=GET>
   <input type=hidden name=op value=allstat>
 <hr color="666666" size=1 noshade>
   <input type=submit value="Вернуться к списку категорий">
 <hr color="666666" size=1 noshade>
   </form>
  </td>
  </tr>
</table>