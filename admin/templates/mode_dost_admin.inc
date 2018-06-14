<table width="98%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td><br>
                <div class=title>Операции над условиями доставки</div>
 <hr>
                </td>
              </tr>
            </table><br>
 <table width="98%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td>


                </td>
              </tr>
            </table><br>




 <form action=index.php method=POST>
 <input type=hidden name=op value=deliverys>
 <input type=hidden name=mode value=updel>
 <table width="50%" border="1" cellspacing="0" cellpadding="0" bordercolorlight="999999" align=center>
              <tr>

                <td width=55% align=center bgcolor="999999">
<font class=t><b>
Габариты товара</b>
</font></td>
<td width=30% align=center bgcolor="999999">
<font class=t><b>
Цена доставки</b>
</font></td>

<td align=center bgcolor="999999" width=15%>
<font class=t><b>
Удалить</b>
</font></td>
</tr>

 <!-- BEGIN dost_razdel -->
 <tr>
 <td align=center>
 <input type=hidden name=idd[] value={idd}>
 <input type=text name=name_d[] value="{name_d}" size=35>
</td>
 <td align=center>
<input type=text size=15 name=cost[] value="{cost}">
 </td>




<td valign=top align=center>

<select name=select[]>
<option value="1">Нет</option>
<option value="2">Да</option>
</select>
</td>
  </tr>
<!-- END dost_razdel -->
 <!-- BEGIN no_dost_razdel -->
 <tr>
 <td align=center colspan=3 height=30>
<font class=error>Нет условий доставки</font>

</td>
  </tr>
<!-- END no_dost_razdel -->
  </table>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
 <tr>
<td valign=top align=center>
<br><br>
<span style="font-size:8pt"><font face="Verdana">Добавить категорию габаритов:</font></span>
<br>
<input type=text name=name_add size=35>
 <p>
<span style="font-size:8pt"><font face="Verdana">Цена при доставке:</font></span>
<br>
<input type=text name=name_cost size=15>


 </td></tr></table>


  <table width="98%" border="0" cellspacing="0" cellpadding="0" align=center>
 <tr>
<td valign=top align=center>
<br>
<hr color="cccccc" size=1 noshade>
<input type=submit value="Внести изменения">
<br>
<hr color="cccccc" size=1 noshade>
</td></tr>
</table>
</form>