<SCRIPT language=JavaScript>
<!--

function CheckForm(UserForm)
{
    var is_ok = true;

    if (UserForm.mailer.value == '')
    {
    is_ok = false;
    alert("������� ��� ���������� E-mail!");
    UserForm.mailer.focus();
    }
   if (UserForm.link.value == '')
    {
    is_ok = false;
    alert("������� ��� ����� ������!");
    UserForm.link.focus();
    }
    if (UserForm.input_number.value == '')
    {
    is_ok = false;
    alert("������� ���, ��������� �� ��������!");
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
                <b>���������� ������</b></font></span></td>

              </tr>
            </table><br><br>
  <form action=sendlink.php method=POST onsubmit="return CheckForm(this)">
  <table width="95%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td bgcolor="#ffffff" align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">�������� ��������� ��� ����� ������:</span></font><br>
                <select name=cat>
                <!-- BEGIN select -->
                <option value="{namecat}">{namecat}&nbsp;&nbsp;</option>
                <!-- END select -->
                </select>
                <br><br>
                </td></tr>
                <tr>
                <td bgcolor="#ffffff" align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">������� ����� URL, ��� ����� �������� ������:</span></font><br>
                <input type=text name=url size=50>
                <br><br>
                </td></tr>
                <tr>
                <td bgcolor="#ffffff" align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">������� ��� ���������� E-mail:</span></font><br>
                <input type=text name=mailer size=50>
                <br><br>
                </td></tr>

                 <tr>
                <td bgcolor="#ffffff" align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">������� ��� ����� ������:</span></font><br>
                <textarea name=link rows=10 cols=38></textarea>
                <br><br></td></tr>
                <tr><td bgcolor="#ffffff" align=center>


 <table width=300 border="0" cellspacing="0" cellpadding="0">
<tr>
<td height=7 colspan=2> </td>
</tr>
<tr>

<td bgcolor="ffffff" colspan=2>
<span style="font-size:8pt"><font face="Tahoma">������� �����, ��������� �� ��������:</fomt></span>
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
                <input type=submit name=submit value="���������" class=knopka>
                <hr color="000000" size=1 noshade>
                <span style="font-size:10pt"><font face=Verdana><a href="index.php?op=linkscatalog">��������� � ������ ���������</a></span></font>
                </td></tr>
                </table>
               </form>