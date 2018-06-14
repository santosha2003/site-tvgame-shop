            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="19">
              <tr>

                <td bgcolor="ffffff" class=white align="center">
                 <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>ОФОРМЛЕНИЕ ЗАКАЗА</b></font></span></td>

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
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td class=sm align="center">У Вас в корзине:</td>
              </tr>
            </table>
<!-- BEGIN list -->
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td bgcolor="#DFDFDF">
                  <table width="100%" border="0" cellspacing="1" cellpadding="3">
                    <tr bgcolor="F7F7F7">
                      <td align="center"><font class=catalog>Фото</font></td>
                      <td align="center"><font class=catalog>Наименование</font></td>
                      <td bgcolor="F7F7F7" align="center"><font class=catalog>Кол-во</font></td>
                      <td bgcolor="F7F7F7" align="center" width="50"><font class=catalog>Цена</font></td>
                    </tr>
<!-- BEGIN list_items -->
                    <tr bgcolor="#FFFFFF">
                      <td class=sm align="center"><a href="index.php?id={id}"><img src="{photo_small}" {wh} border="0"></a></td>
                      <td class=sm bgcolor="#FFFFFF"><a class=maing href="index.php?id={id}">{name}<br>{mark}</a> {sp}</td>
                      <td class=sm align="center">{quantity}</td>
                      <td class=sm align="center">{price}</td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
<!-- END list_items -->

                    <tr bgcolor="#FFFFFF">
                      <td class=sm align="right" colspan="3"><b>Итого:</b></td>
                      <td class=sm nowrap><b>{price_total}</b> руб.</td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td class=sm align="right" colspan="3"><b>Ваша скидка составляет:</b></td>
                      <td class=sm colspan="2"><b>{skidka_v} %</b></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td class=sm align="right" colspan="3"><b>Стоимость доставки:</b></td>
                      <td class=sm colspan="2"><b>{delivery_total}</b> руб.</td>
                    </tr>

                    <tr bgcolor="#FFFFFF">
                      <td class=sm align="right" colspan="3"><b>Всего к оплате:</b></td>
                      <td class=sm colspan="2"><b>{order_total}</b> руб.</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
<!-- END list -->

<!-- BEGIN no_list -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="10"></td>
              </tr>
            </table>
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr bgcolor="#FFFFFF">
                <td class=smb align="center"><b>Ваша корзина пуста</b></td>
              </tr>
                        </table>
<!-- END no_list -->

<!-- BEGIN address_fields -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="15"></td>
              </tr>
            </table>
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td bgcolor="#000000">
                  <table width="100%" border="0" cellspacing="1" cellpadding="5">
<form action=index.php method=POST name=send onSubmit="return ValidData(this);">
<input type=hidden name=op value="order1">
                    <tr>
                      <td bgcolor="ffffff">
                        <table border="0" cellspacing="0" cellpadding="5" align="center" width="100%">
                          <tr>
                            <td class=sm colspan="2"><b>АДРЕС ДОСТАВКИ:</b> </td>
                          </tr>
                          <tr>
                            <td class=sm align="right">ФИО или название организации :</td>
                            <td><input type="text" name="fio" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Страна проживания :</td>
                            <td><input type="text" name="country" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Город проживания :</td>
                            <td><input type="text" name="city" class=form size="30" style="width: 170px;"></td>
                          </tr>
                           <tr>
                            <td class=sm align="right">Ближайшее метро :</td>
                            <td><input type="text" name="metro" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Email :</td>
                            <td><input type="text" name="email" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Телефон :</td>
                            <td><input type="text" name="phone" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Адрес доставки :</td>
                            <td><textarea name="address" class=form style="width: 170px; height: 75px;"></textarea></td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Номер дисконтной карты :</td>
                            <td><input type="text" name="discont" class=form size="30" style="width: 170px;"></td>
                          </tr>
                          <tr>
                            <td class=sm align="right" valign="top">Дата и время доставки:</td>
                            <td class=sm>
                              <select name="date_delivery" class=form>
<!-- BEGIN select_date -->
                                <option value="{date}">{date_ru}</option>
<!-- END select_date -->
                              </select>
                              <br>
                              <input type="checkbox" name="time_delivery[]" value="6-9">6-9<br>
                              <input type="checkbox" name="time_delivery[]" value="9-12">9-12<br>
                                                          <input type="checkbox" name="time_delivery[]" value="12-15">12-15<br>
                              <input type="checkbox" name="time_delivery[]" value="15-18">15-18<br>
                              <input type="checkbox" name="time_delivery[]" value="18-21">18-21
                                                        </td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Способ оплаты: </td>
                            <td>
                              <select name="select3" class=form>
                                          <option selected>Безналом</option>
                                <option selected>Наличными курьеру</option>

                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td class=sm align="right">Дополнительно :</td>
                            <td>
                              <textarea name="description" class="form" size="30" style="width: 170px;"></textarea>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="10" align="center">
              <tr>
                <td align="center" class=t>
Стоимость доставки составляет от 300 рублей.<br>
Если груз крупногабаритный - уточните условия у менеджера.<br>

                                </td>
                          </tr>
                        </table>
            <table border="0" cellspacing="0" cellpadding="10" align="center">
              <tr>
                <td align="center">
                  <input type="submit" value="Оформить заказ" class=knopka>
                </td>
              </tr>
            </table>
</form>

<!-- END address_fields -->

<script type="text/javascript" language="javascript">
<!--
function ValidData(form) {
  var missinginfo = "";

  if(form.fio.value == "") {
        missinginfo += "\n     - ФИО";
  }
  if(form.country.value == "") {
        missinginfo += "\n     - Страна проживания";
  }
  if(form.city.value == "") {
        missinginfo += "\n     - Город проживания";
  }
  if(form.phone.value == "") {
        missinginfo += "\n     - Телефон";
  }
  if(form.address.value == "") {
        missinginfo += "\n     - Адрес доставки по умолчанию";
  }

  if (missinginfo != "") {
        missinginfo ="Не все поля формы заполнены\nили указанный e-mail не cуществует:\n" +
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