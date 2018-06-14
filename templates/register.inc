            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="19">
<!-- BEGIN header_newreg -->
              <tr>

                <td bgcolor="ffffff" class=white align="center">
                <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>РЕГИСТРАЦИЯ НОВОГО ПОЛЬЗОВАТЕЛЯ</b></font></span></td>

              </tr>
<!-- END header_newreg -->
<!-- BEGIN header_cngreg -->
              <tr>

                <td bgcolor="ffffff" class=white align="center">
                <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>ИЗМЕНЕНИЕ ДАННЫХ ПОЛЬЗОВАТЕЛЯ</b></font></span></td>

              </tr>
<!-- END header_cngreg -->
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
                <td bgcolor="ffffff"><img src="images/1p.gif" width="1" height="1"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr>
                <td class=sm align="center">
                                  Введите, пожалуйста, Ваши данные в приведеную ниже форму.
                                  Все поля формы обязательны для заполнения.
                                  Усли у Вас возникли какие-то вопросы по поводу заполнения
                                  регистрационой формы - свяжитесь с оператором нашего магазина
                                  <a href="mailto:info@shedevr.ru">info@shedevr.ru</a>
                                </td>
              </tr>
            </table>
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td bgcolor="000000">
                  <table width="100%" border="0" cellspacing="1" cellpadding="5">
                    <tr>
                      <td bgcolor="ffffff" class=smb>
                                          <font color=red>{error}</font>
                        <table border="0" cellspacing="0" cellpadding="5" align="center" width="100%">
<form action=index.php method=POST name=send onSubmit="return ValidData(this);">
<input type=hidden name=op value={action}>
                          <tr>
                            <td class=sm align="right">E-mail :</td>
                            <td><input type="text" name="username" value="{username}" class=form size="30" style="width: 170px;"{disab}></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Пароль :</td>
                            <td><input type="password" name="password" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Пароль (ещё раз) :</td>
                            <td><input type="password" name="password1" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">ФИО или название организации :</td>
                            <td><input type="text" name="fio" value="{fio}" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Страна проживания :</td>
                            <td><input type="text" name="country" value="{country}" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Город проживания :</td>
                            <td><input type="text" name="city" value="{city}" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Телефон :</td>
                            <td><input type="text" name="phone" value="{phone}" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Ближайшее метро :</td>
                            <td><input type="text" name="metro" value="{metro}" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Адрес доставки по умолчанию :</td>
                            <td><textarea name="address" class=form style="width: 170px;">{address}</textarea></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Номер дисконтной карты: </td>
                            <td><input type="text" name="discont" value="{discont}" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Откуда узнали о нашем сайте : </td>
                            <td><input type="text" name="source" value="{source}" class=form size="30" style="width: 170px;"></td>
                          </tr>

                          <tr>
                            <td colspan=2 align=center>
                              <input type="submit" value="Регистрация" class=knopka>
                              <input type="reset"  value="Сброс" class=knopka>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

<script type="text/javascript" language="javascript">
<!--
function ValidData(form) {
  var missinginfo = "";

  if ((form.username.value == "") ||
  (form.username.value.indexOf('@') == -1) ||
  (form.username.value.indexOf('.') == -1)) {
          missinginfo += "\n     -  E-mail";
  }
  else return true;
}
-->
</script>