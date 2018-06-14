 <div class=title>Добавление клиента</div>
 <hr>
 <br><br>

            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td bgcolor="666666">
                  <table width="100%" border="0" cellspacing="1" cellpadding="5">
                    <tr>
                      <td bgcolor="ffffff" class=smb>

                        <table border="0" cellspacing="0" cellpadding="5" align="center" width="100%">
<form action=index.php method=POST>
<input type=hidden name=op value="client_add">
                          <tr>
                            <td class=t align="right">E-mail :</td>
                            <td><input type="text" name="username" class=form size="30" style="width: 170px;"{disab}></td>
                          </tr>
                          <tr>
                            <td class=t align="right">Пароль :</td>
                            <td><input type="password" name="password" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=t align="right">Пароль еще раз :</td>
                            <td><input type="password" name="password1" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=t align="right">ФИО или название организации :</td>
                            <td><input type="text" name="fio" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=t align="right">Страна проживания :</td>
                            <td><input type="text" name="country" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=t align="right">Город проживания :</td>
                            <td><input type="text" name="city" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=t align="right">Телефон :</td>
                            <td><input type="text" name="phone" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=t align="right">Ближайшее метро :</td>
                            <td><input type="text" name="metro" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=t align="right">Адрес доставки по умолчанию :</td>
                            <td><textarea name="address" class=form style="width: 170px;"></textarea></td>
                          </tr>
                          <tr>
                            <td class=t align="right">Номер дисконтной карты: </td>
                            <td><input type="text" name="discont" class=form size="30" style="width: 170px;"></td>
                          </tr>

                          <tr>
                            <td colspan=2 align=center>
                              <input type="submit" value="Внести клиента" class=knopka>
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
            </form>