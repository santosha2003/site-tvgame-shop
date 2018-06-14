            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="19">
              <tr>

                <td bgcolor="ffffff" class=white align="center">
                 <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>ЗАБЫЛИ ПАРОЛЬ?</b></font></span></td>

              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="20"></td>
              </tr>
            </table>
<!-- BEGIN forgot_begin -->
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td bgcolor="DFDFDF">
                  <table width="100%" border="0" cellspacing="1" cellpadding="5">
                    <tr>
                      <td bgcolor="F7F7F7">
                        <table border="0" cellspacing="0" cellpadding="5" align="center" width="100%">
<form action=index.php method=POST name=send onSubmit="return ValidData(this);"
<input type=hidden name=op value="forgot">
                          <tr>
                            <td class=sm align="right">Ваш E-mail :</td>
                            <td><input type="text" name="email" class=form size="30"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" value="Получить пароль" class=knopka></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
</form>
                  </table>
                </td>
              </tr>
            </table>
<!-- END forgot_begin -->
<!-- BEGIN forgot_ok -->
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td class=t align="center">
                                  <img src="images/1p.gif" width="1" height="20"><b>Ваш Пароль выслан на указаный E-mail</b></td>
              </tr>
            </table>
<!-- END forgot_ok -->

<script type="text/javascript" language="javascript">
<!--
function ValidData(form) {
  var missinginfo = "";

  if ((form.email.value == "") ||
  (form.email.value.indexOf('@') == -1) ||
  (form.email.value.indexOf('.') == -1)) {
          missinginfo += "\n     -  введенное Вами очень отдалено\nнапоминаетE-Mail адрес";
  }
  if (missinginfo != "") {
        missinginfo ="Ошибка заполнения формы:\n" +
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