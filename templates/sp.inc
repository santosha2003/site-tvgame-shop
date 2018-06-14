            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="19">
              <tr>
                <td width=25> </td>
                <td width=9><img src=images/p1_l.gif width=9 height=19></td>
                <td bgcolor="007646" class=white align="center">СПЕЦИАЛЬНОЕ ПРЕДЛОЖЕНИЕ</td>
                <td width=9><img src=images/p1_r.gif width=9 height=19></td>
                <td width=25> </td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="4" height="27">
              <tr>
                <td bgcolor="F0F0F0" class=red>
<!-- BEGIN date_end -->
                                  &nbsp;&nbsp;&nbsp;Предложение действительно с {start_date_ru} по {end_date_ru}
<!-- END date_end -->
<!-- BEGIN date_all -->
                                  &nbsp;&nbsp;&nbsp;Предложение действительно до окончания товаров на складе
<!-- END date_all -->
                                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td bgcolor="DFDFDF"><img src="images/1p.gif" width="1" height="1"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><h2>{name}</h2></td>
              </tr>
              <tr>
                <td class=sm>{description}</td>
              </tr>
            </table>

<!-- BEGIN main_items -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="19">
              <tr>
                <td width=25> </td>
                <td width=9><img src=images/p1_l.gif width=9 height=19></td>
                <td bgcolor="007646" class=white align="center">ТОВАРЫ СПЕЦПРЕДЛОЖЕНИЯ</td>
                <td width=9><img src=images/p1_r.gif width=9 height=19></td>
                <td width=25> </td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="1"></td>
              </tr>
              <tr>
                <td bgcolor="479680"><img src="images/1p.gif" width="1" height="1"></td>
              </tr>
            </table>
<!-- BEGIN list_items -->
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
              <tr>
                <td class=sm><img src="images/arrow_green.gif" width="7" height="7">
                  &nbsp;&nbsp;<a href="index.php?id={id_items}" class=b>{name_items} {mark_items}</a></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td bgcolor="DFDFDF"><img src="images/1p.gif" width="1" height="1"></td>
              </tr>
            </table>
<!-- END list_items -->
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
<form action=index.php method=POST>
<input type=hidden name=op value=cart>
<input type=hidden name=action value=mass_add>
<input type=hidden name=id value={mass_id}>
              <tr>
                <td class=sm>Вы можете заказать ВСЕ товары, учавствующиие в спецпредложении:</td>
                <td class=sm><input type=image src="images/knopka_order.gif" width="53" height="15" border="0"></td>
              </tr>
</form>
            </table>
<!-- END main_items -->


<!-- BEGIN main_article -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="19">
              <tr>
                <td width=25> </td>
                <td width=9><img src=images/p1_l.gif width=9 height=19></td>
                <td bgcolor="007646" class=white align="center">СТАТЬИ СПЕЦПРЕДЛОЖЕНИЯ</td>
                <td width=9><img src=images/p1_r.gif width=9 height=19></td>
                <td width=25> </td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="1"></td>
              </tr>
              <tr>
                <td bgcolor="479680"><img src="images/1p.gif" width="1" height="1"></td>
              </tr>
            </table>
<!-- BEGIN list_article -->
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
              <tr>
                <td class=sm><img src="images/arrow_green.gif" width="7" height="7">
                  &nbsp;&nbsp;<a href="index.php?op={id_article}&source=spec" class=b>{name_article}</a></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td bgcolor="DFDFDF"><img src="images/1p.gif" width="1" height="1"></td>
              </tr>
            </table>
<!-- END list_article -->
<!-- END main_article -->
