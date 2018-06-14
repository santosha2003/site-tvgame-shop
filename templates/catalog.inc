           <br>

           <!-- BEGIN list_cat -->

            <table width="100%" border="0" cellspacing="0" cellpadding="7">
              <tr>
                <td class=t1><img src="images/arrow_green.gif" width="7" height="7">
                  &nbsp;&nbsp;<a href="index.php?op=catalog&cid={id}" class=b>{name}</a></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
            <!-- END list_cat -->

            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><h2>{name}</h2></td>
              </tr>
              <tr>
                <td class=sm>{description}</td>
              </tr>
            </table>


            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>

<!-- BEGIN hidden_list -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="10"></td>
              </tr>
            </table>
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td bgcolor="DFDFDF">
                  <table width="100%" border="0" cellspacing="1" cellpadding="3">
                    <tr bgcolor="F7F7F7">
                      <td align="center"><font class=catalog>Фото</font></td>
                      <td align="center"><font class=catalog>Наименование</font></td>
                      <td align="center" bgcolor="F7F7F7"><font class=catalog>Цена</font></td>
                      <td bgcolor="F7F7F7" align="center" width="50"><font class=catalog>Кол-во</font></td>
                      <td bgcolor="F7F7F7" align="center"><font class=catalog>Заказать</font></td>
                    </tr>
<!-- BEGIN list_items -->
<form action=index.php method=POST>
<input type=hidden name=op value=cart>
<input type=hidden name=id value={id}>
<input type=hidden name=action value=add>
<input type=hidden name=cid value={cid}>
                    <tr bgcolor="#FFFFFF">
                      <td class=sm align="center"><a href="index.php?id={id}"><img src="{photo_small}" alt="{name} {model}" {wh} border="0"></a></td>
                      <td class=t1 bgcolor="#FFFFFF"><a class=maing href="index.php?id={id}">{name} {model}</a></td>
                      <td class=sm align="center">{price}</td>
                      <td class=sm align="center">
                        <input type="text" name="qnt" size="3" value="1" class="form" style="text-align: right; padding-right: 5;">
                      </td>
                      <td class=sm align="center"><input type=image src="images/knopka_order.gif" width="53" height="15" border="0"></a></td>
                    </tr>
</form>
<!-- END list_items -->
                  </table>
                </td>
              </tr>
            </table>
  <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
                <td bgcolor="#ffffff" align=left>
   {hr}
   <span style="font-size:9pt"><font face="Verdana" color="000000">Страницы:&nbsp;&nbsp;</span></font>
   <!-- BEGIN list_nav -->
   {s}
   <!-- END list_nav -->
   {hr1}

                </td>
                </tr>
      </table>









<!-- END hidden_list -->