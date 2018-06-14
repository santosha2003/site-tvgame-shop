<SCRIPT language=JavaScript>
<!--

function CheckForm(UserForm)
{
    var is_ok = true;

    if (UserForm.mailer.value == '')
    {
    is_ok = false;
    alert("Введите Ваш контактный E-mail!");
    UserForm.mailer.focus();
    }
   if (UserForm.link.value == '')
    {
    is_ok = false;
    alert("Введите код Вашей ссылки!");
    UserForm.link.focus();
    }
    if (UserForm.input_number.value == '')
    {
    is_ok = false;
    alert("Введите код, указанный на картинке!");
    UserForm.input_number.focus();
    }





   return is_ok;
}
// -->
</SCRIPT>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" height="19">
              <tr>

                <td bgcolor="ffffff" class=white align="center">
                <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>ДОБАВЛЕНИЕ ССЫЛКИ</b></font></span></td>

              </tr>
            </table><br><br>
  <form action=sendlink.php method=POST onsubmit="return CheckForm(this)">
  <table width="95%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td bgcolor="#ffffff" align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">Выберите категорию для Вашей ссылки:</span></font><br>
                <select name=cat>
                <!-- BEGIN select -->
                <option value="{namecat}">{namecat}&nbsp;&nbsp;</option>
                <!-- END select -->
                </select>
                <br><br>
                </td></tr>
                <tr>
                <td bgcolor="#ffffff" align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">Введите адрес URL, где будет ответная ссылка:</span></font><br>
                <input type=text name=url size=50>
                <br><br>
                </td></tr>
                <tr>
                <td bgcolor="#ffffff" align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">Введите Ваш контактный E-mail:</span></font><br>
                <input type=text name=mailer size=50>
                <br><br>
                </td></tr>

                 <tr>
                <td bgcolor="#ffffff" align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">Введите код Вашей ссылки:</span></font><br>
                <textarea name=link rows=10 cols=38></textarea>
                <br><br></td></tr>
                <tr><td bgcolor="#ffffff" align=center>


 <table width=300 border="0" cellspacing="0" cellpadding="0">
<tr>
<td height=7 colspan=2> </td>
</tr>
<tr>

<td bgcolor="ffffff" colspan=2>
<span style="font-size:8pt"><font face="Tahoma">Введите число, указанное на картинке:</fomt></span>
</td>
</tr>
<tr>

<td bgcolor=ffffff align=left width=154>
<img src="nnn.php"></td>
<td bgcolor=ffffff align=left>
<input type=text name="input_number"></td>
</tr>
</table>







                </td>
                </tr>


                 <tr>
                <td bgcolor="#ffffff" align=center>
                 <hr color="000000" size=1 noshade>
                <input type=submit name=submit value="Отправить" class=knopka>
                <hr color="000000" size=1 noshade>
                <span style="font-size:10pt"><font face=Verdana><a href="index.php?op=linkscatalog">Вернуться к списку категорий</a></span></font>
                </td></tr>
                </table>
               </form>