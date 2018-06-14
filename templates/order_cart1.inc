            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="19">
              <tr>

                <td bgcolor="ffffff" class=white align="center">
              <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>В КОРЗИНЕ</b></font></span></td>
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
<!-- BEGIN list -->
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
<form action=index.php method=POST name=cart>
<input type=hidden name=op value=cart1>
<input type=hidden name=action value=alldell>
              <tr>
                <td bgcolor="DFDFDF">
                  <table width="100%" border="0" cellspacing="1" cellpadding="3">
                    <tr bgcolor="F7F7F7">
                      <td align="center"><font class=catalog>Фото</font></td>
                      <td align="center"><font class=catalog>Наименование</font></td>
                      <td bgcolor="F7F7F7" align="center"><font class=catalog>Кол-во</font></td>
                      <td bgcolor="F7F7F7" align="center" width="50"><font class=catalog>Цена</font></td>
                      <td bgcolor="F7F7F7" align="center"><font class=catalog>Удалить</font></td>
                    </tr>

<!-- BEGIN list_items -->
                    <tr bgcolor="#FFFFFF">
                      <td class=sm align="center"><a href="index.php?id={id}"><img src="{photo_small}" {wh} border="0"></a></td>
                      <td class=sm bgcolor="#FFFFFF"><a class=maing href="index.php?id={id}">{name}<br>{mark}</a> {sp} </td>
                      <td class=sm align="center"><input type="text" name="qnt[{scid}]" size="3" class="form" value="{quantity}" style="text-align: right; padding-right: 5;"></td>
                      <td class=sm align="center">{price}</td>
                      <td class=sm align="center"><input type="checkbox" name="alldel[{scid}]"></td>
                    </tr>
<!-- END list_items -->

                    <tr bgcolor="#FFFFFF">
                      <td class=sm align="right" colspan="3"><b>Итого:</b></td>
                      <td class=sm colspan="2"><b>{price_total}</b> руб.</td>
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
            <table border="0" cellspacing="0" cellpadding="10" align="center">
              <tr>
                <td align="center">
                  <input type="button" value="В каталог" class=knopka onClick="history.back();">
                </td>
                <td align="center">
                  <input type="submit" name="recalc" value="Обновить" class=knopka>
                </td>
                <td align="center">
                  <input type="submit" name="orders" value="Заказать" class=knopka onClick="submitForm('order1');">
                </td>
              </tr>
</form>
            </table>



<script type="text/javascript" language="javascript">
<!--
function submitForm(id) {
  document.cart.action.value = id;
  document.cart.submit();
}

-->
</script>
<!-- END list -->

<!-- BEGIN no_list -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="10"></td>
              </tr>
            </table>
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr bgcolor="#FFFFFF">
                <td align="center"><font class=catalog>Ваша корзина пуста</font></td>
              </tr>
                        </table>
<!-- END no_list -->