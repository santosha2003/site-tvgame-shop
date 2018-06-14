            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="19">
              <tr>

                <td bgcolor="ffffff" class=white align="center">
                <span style="font-size:10pt"><font color="3879B3" face="Tahoma">

                <b>ќЅ–ј“Ќјя —¬я«№</b></span></font></td>

              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td bgcolor="#ffffff" height=2></td>
              </tr>
              <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="20"></td>
              </tr>
            </table>
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td bgcolor="#000000">
                  <table width="100%" border="0" cellspacing="1" cellpadding="5">
                    <tr>
                      <td bgcolor="ffffff">
                        <table border="0" cellspacing="0" cellpadding="5" align="center" width="100%">
<form name=sendmail.php method=POST name=send onSubmit="return ValidData(this);">

                          <tr>
                            <td class=sm align="right" width="30%" height="36">¬аше им€ :</td>
                            <td height="36"><input type="text" name="fio" class=form size="30"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">E-mail :</td>
                            <td><input type="text" name="email" class=form size="30"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right" valign="top">—ообщение :</td>
                            <td><textarea name="text" class="form" cols="35" rows="10"></textarea></td>
                          </tr>
                          <tr><td></td>
                          <td>
                          <table width=300 border="0" cellspacing="0" cellpadding="0">
<tr>
<td height=7 colspan=2> </td>
</tr>
<tr>

<td bgcolor="ffffff" colspan=2>
<span style="font-size:8pt"><font face="Tahoma">¬ведите число, указанное на картинке:</fomt></span>
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
                            <td>&nbsp;</td>
                            <td><input type="submit" name="Submit" value="ќтправить" class=knopka></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
</form>
                  </table>
                </td>
              </tr>
            </table>

<script type="text/javascript" language="javascript">
<!--
function ValidData(form) {
  var missinginfo = "";

  if(form.fio.value == "") {
        missinginfo += "\n     - ‘»ќ";
  }

  if(form.text.value == "") {
        missinginfo += "\n     - —ообщение";
  }

  if ((form.email.value == "") ||
  (form.email.value.indexOf('@') == -1) ||
  (form.email.value.indexOf('.') == -1)) {
          missinginfo += "\n     -  E-mail";
  }
  if(form.input_number.value == "") {
        missinginfo += "\n     - ¬ведите число, указанное на картинке";
  }




  if (missinginfo != "") {
        missinginfo ="Ќе все пол€ формы заполнены\nили указанный e-mail не cуществует:\n" +
        "_____________________________\n" +
        missinginfo + "\n_____________________________" +
        "\n";
        alert(missinginfo);
        return false;
  }
  else return true;
}
-->
</script>
