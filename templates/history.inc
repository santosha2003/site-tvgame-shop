             <table width="100%" border="0" cellspacing="0" cellpadding="0" height="19">
              <tr>

                <td bgcolor="ffffff" class=white align="center">
                 <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>ПЕРСОНАЛЬНЫЕ ДАННЫЕ</b></font></span></td>

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
                <td><img src="images/1p.gif" width="1" height="10"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td class=sm>
                                  Уважаемый {mrfio}!<br>
                                  <br>
                                  На этой странице приведен <a href=#history>список всех покупок</a>,
                                  которые Вы совершали в нашем магазине и имеется возможность
                                  <a href=index.php?op=cngreg>изменить данные</a>, которые Вы указали при регистрации в нашем магазине.
                                </td>
              </tr>
            </table>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
              <tr>
                <td class=sm><img src="images/arrow_green.gif" width="7" height="7">
                  &nbsp;&nbsp;<a href=#history>История заказов</a></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
              <tr>
                <td class=sm><img src="images/arrow_green.gif" width="7" height="7">
                  &nbsp;&nbsp;<a href=index.php?op=cngreg>Изменение регистрационых данных</a></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
              <tr>
                <td class=sm><img src="images/arrow_green.gif" width="7" height="7">
                  &nbsp;&nbsp;<a href=index.php?op=cart>Корзина покупателя</a></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
              <tr>
                <td class=sm><img src="images/arrow_green.gif" width="7" height="7">
                  &nbsp;&nbsp;<a href="mailto:info@shedevr.ru?subject=form%20user%20ID#{muid}">Письмо администрации магазина</a></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="10"></td>
              </tr>
            </table>


<a name=history></a>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="19">
              <tr>
                <td bgcolor="ffffff" class=white align="center">
                 <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>ИСТОРИЯ ЗАКАЗОВ</b></font></span></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="10"></td>
              </tr>
            </table>
<!-- BEGIN list_orders -->
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td class=sm>&nbsp;&nbsp;{date_zid} | Заказ N {zid}</td>
              </tr>
            </table>
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td bgcolor="DFDFDF">
                  <table width="100%" border="0" cellspacing="1" cellpadding="3">
                    <tr bgcolor="F7F7F7">
                      <td align="center"><font class=catalog>Наименование</font></td>
                      <td bgcolor="F7F7F7" align="center"><font class=catalog>Цена</font></td>
                      <td bgcolor="F7F7F7" align="center"><font class=catalog>Кол-во</font></td>
                      <td bgcolor="F7F7F7" align="center" width="50"><font class=catalog>Сумма</font></td>
                    </tr>
<!-- BEGIN items -->
                    <tr bgcolor="#FFFFFF">
                      <td class=sm bgcolor="#FFFFFF">{name}<br>{mark}</td>
                      <td class=sm align="right" nowrap>{price}&nbsp;</td>
                      <td class=sm align="center">{quantity}</td>
                      <td class=sm align="right" nowrap>{price_summa}&nbsp;</td>
                    </tr>
<!-- END items -->
                    <tr bgcolor="#FFFFFF">
                      <td class=sm align="right" colspan="4">
                                                Стоимость доставки: {delivery_total} руб.<br>
                                                <b>Итого: {summa}</b> руб.
                                          </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td class=sm>&nbsp;&nbsp;<a href="mailto:{email}?subject=Order#{zid}">оставить отзыв</a></td>
              </tr>
            </table>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="10"></td>
              </tr>
            </table>
<!-- END list_orders -->
