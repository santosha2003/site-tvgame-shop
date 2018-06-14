<script type="text/javascript" language="javascript">
<!--
  function pop_win(url, win, wd, ht) {
  popwin = document.open(url,win,"width="+wd+",height="+ht+",toolbar=no,resizable=yes,scrollbars=no");
}
-->
</script>


            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td width="191" align="center" valign="middle" class="t">

                                  <a href="javascript:pop_win('{photo_big}', 'nwin', {width}, {height});"><img src="{photo_small}" {wh} border="0" alt="{name}"></a><br>
                                  <a href="javascript:pop_win('{photo_big}', 'nwin', {width}, {height});">увеличить изображение</a>
                                </td>
                <td valign="top">
                  <table width="98%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><img src="images/1p.gif" width="1" height="5"></td>
                    </tr>

<!-- BEGIN vendor -->
<form action=index.php method=POST>
<input type="hidden" name="op" value="search">
<input type="hidden" name="search" value="{vendor_name}">
<input type="hidden" name="type" value="brand">
                    <tr>
                      <td align=center><input type=image src="{vendor_pic}" {vendor_wh} border=0 alt="{vendor_name}" title="{vendor_name}"></td>
                                        </tr>
</form>
<!-- END vendor -->

                    <tr>
                      <td><img src="images/1p.gif" width="1" height="5"></td>
                    </tr>
                    <tr>
                      <td class=t1><b>Название: {name}</b></td>
                    </tr>
                    <tr>
                      <td><img src="images/1p.gif" width="1" height="10"></td>
                    </tr>
<!-- BEGIN nts -->
                    <tr>
                      <td bgcolor="FFFFFF" height="17">
                        <table width="100%" border="0" cellspacing="1" cellpadding="3">
                          <tr bgcolor="#FFFFFF" align="center">
<!-- BEGIN new -->
                                        <!-- <td><img src="images/icon_new.gif" width="25" height="25" alt="Подарок к праздникам" title="Подарок к праздникам"></td> -->
<!-- END new -->
<!-- BEGIN ts -->

                            <!-- <td><img src="images/icon_ts.gif" width="25" height="25" alt="Товар зимнего сезона" title="Товар зимнего сезона"></td> -->
<!-- END ts -->
<!-- BEGIN sp -->
                            <!--<td><img src="images/icon_sp.gif" width="25" height="25" alt="Учасник спецпредложения" title="Учасник спецпредложения"></td> -->
<!-- END sp -->

                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td><img src="images/1p.gif" width="1" height="10"></td>
                    </tr>
<!-- END nts -->
<!-- BEGIN mark -->
                    <tr>
                      <td class=t1>Марка : {mark}</td>
                    </tr>
<!-- END mark -->
<!-- BEGIN model -->
                    <tr>
                      <td class=t1>Модель : {model}</td>
                    </tr>
<!-- END model -->
<!-- BEGIN sku -->
                    <tr>
                      <td class=t1>Артикул : {sku}</td>
                    </tr>
<!-- END sku -->
                  </table>
                </td>
              </tr>
            </table>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>


                <td width=8% class=t1>

   <a class=pict href="javascript:pop_win('images/photo/{photo_big1}', 'nwin', {width1}, {height1});"><img src="images/photo/{photo_small1}" border="{border1}" width="{w1}" height="{h1}" style="border-color:black;" alt="{name}"></a>
     </td>




   <td width=8% class=t1>

   <a class=pict href="javascript:pop_win('images/photo/{photo_big2}', 'nwin', {width2}, {height2});"><img src="images/photo/{photo_small2}" border="{border2}" width="{w2}" height="{h2}" style="border-color:black;" alt="{name}"></a>
     </td>

    <td  class=t1>&nbsp;</td>
      </tr></table>
<!-- BEGIN svva -->
<!-- BEGIN list_svva -->
                        &nbsp;&nbsp;<a href="javascript:pop_win('popup.php?id={id_svva}', 'nwin', 320, 200);"><img src="{photo_svva}" {wh_svva} alt="{name}" title="{name}" border="0"></a>
<!-- END list_svva -->
<!-- END svva -->

            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td class=t1>{description}<br><br>
<!-- BEGIN list_ref -->
                  - {ref_name} - {ref_value}<br>
<!-- END list_ref -->
                                </td>
              </tr>
            </table>
           <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td class=sm>
                <span style="font-size:12px"><b><font color=009933 face=verdana>{nalich}</font></b></span>

               </td></tr></table>


            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td class=sm>
              <a href="display.php?id={idtov}"><img src="images/print.jpg" border="0"></a>&nbsp;&nbsp;<a class=maing href="print.php?display={idtov}">Версия для печати</a></td>
              </tr>
            </table>
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td bgcolor="DFDFDF">
                  <table width="100%" border="0" cellspacing="1" cellpadding="3">
                    <tr bgcolor="F7F7F7" align="center">
                      <td><font class=catalog>Цена :</font></td>
                      <td><font class=catalog>Количество :</font></td>
                      <td bgcolor="F7F7F7"><font class=catalog>Заказать</font></td>
                    </tr>
<form action=index.php method=POST>
<input type=hidden name=op value=cart>
<input type=hidden name=action value=add>
<input type=hidden name=id value={idtov}>
                    <tr bgcolor="#FFFFFF" align="center">
                      <td class=sm>{price} руб.</td>
                      <td class=sm><input type="text" name="qnt" size="3" class="form" value="1" style="text-align: right; padding-right: 5;"></td>
                      <td class=sm><input type=image src="images/knopka_order.gif" width="53" height="15" border="0"></td>
                    </tr>
</form>
                  </table>
                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td class=sm><a class=maing href="index.php?op=catalog&cid={cid}">Вернуться в каталог</a></td>
              </tr>
            </table>

<!-- BEGIN part -->
            <table width="95%" border="0" cellspacing="0" cellpadding="0" height="19" align=center>
              <tr>

                <td bgcolor="f2f2f2" class=white align="center">
                 <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>ТАКЖЕ С ЭТИМ ТОВАРОМ НАШИ КЛИЕНТЫ ПОКУПАЮТ:</b></font></span></td>

              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr><td><img src="images/1p.gif" width="1" height="1"></td></tr>
              <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
<!-- BEGIN list_part -->
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
              <tr>
                <td class=t1><img src="images/arrow_green.gif" width="7" height="7">
                  &nbsp;&nbsp;<a href="index.php?id={id_part}" class=b>{name_part} {model_part} {price_part}</a></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
<!-- END list_part -->
<!-- END part -->

<!-- BEGIN spec -->
            <table width="95%" border="0" cellspacing="0" cellpadding="0" height="19" align=center>
              <tr>

                <td bgcolor="f2f2f2" class=white align="center">
                 <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>СПИСОК РЕКОМЕНДОВАННЫХ ТОВАРОВ</b></font></span></td>

              </tr>
            </table>
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="1"></td>
              </tr>
              <tr>
          <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
              </tr>
            </table>
<!-- BEGIN list_spec -->
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
              <tr>
                <td class=t1><img src="images/arrow_green.gif" width="7" height="7">
                  &nbsp;&nbsp;<a href="index.php?id={id_spec}" class=b>{name_spec} {model_spec} {price_spec}</a></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
<!-- END list_spec -->
<!-- END  spec -->

<!-- BEGIN article -->
            <table width="95%" border="0" cellspacing="0" cellpadding="0" height="19" align=center>
              <tr>

                <td bgcolor="f2f2f2" class=white align="center">
                 <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>СПИСОК СВЯЗАННЫХ СТАТЕЙ</b></font></span></td>

              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/1p.gif" width="1" height="1"></td>
              </tr>
          <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
<!-- BEGIN list_article -->
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
              <tr>
                <td class=t1><img src="images/arrow_green.gif" width="7" height="7">
                  &nbsp;&nbsp;<a href="index.php?op={id_article}" class=b>{name_article}</a></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
                <td background="images/point3.gif" height="1" bgcolor="ffffff"><img src="images/1p.gif" height="1"></td>
              </tr>
            </table>
<!-- END list_article -->
<!-- END article -->
<br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" height="19" align=center>
              <tr>

                <td bgcolor="f2f2f2" class=white align="center">
                <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>ОТЗЫВЫ и ВОПРОСЫ</b></font></span></td>

              </tr>
            </table>

            <br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align=center>

<!-- BEGIN list_faq -->
<tr>

<td bgcolor="ffffff" width="95%">
<span style="font-size:8pt"><font face="Tahoma"><b>{datafaq}</b></font></span>
&nbsp;&nbsp;<a class=faqq href="mailto:{mailfaq}"><b>{namefaq}</b></a>
</td></tr>
<tr><td bgcolor="ffffff" width="400">
<span style="font-size:8pt"><font face="Tahoma">-> {messfaq}</font></span>
</td></tr>
<tr><td bgcolor="ffffff" width="400">
<span style="font-size:8pt"><font face="Tahoma" color="ff0000">{admin}&nbsp;&nbsp;{answer}</font></span>
</td>

</tr>
<tr>

<td bgcolor="ffffff">
<hr color="000000" noshade size=1>
</td>

</tr>
<!-- END list_faq -->

</table>
<!-- BEGIN no_list_faq -->

<center><span style="font-size:9pt"><font face="Tahoma">Отзывов и вопросов нет</font></span></center>

 <!-- END no_list_faq -->
<br>
<SCRIPT language=JavaScript>
<!--

function CheckForm(UserForm)
{
    var is_ok = true;

    if (UserForm.input_number.value == '')
    {
    is_ok = false;
    alert("Введите число, указанное на картинке!");
    UserForm.input_number.focus();
    }

   return is_ok;
}
// -->
</SCRIPT>




<table width="95%" border="0" cellspacing="0" cellpadding="0" height="19" align=center >
              <tr>

                <td bgcolor="f2f2f2" class=white align="center">
                 <span style="font-size:10pt"><font color="3879B3" face="Tahoma">
                <b>ВАШЕ СООБЩЕНИЕ</b></font></span></td>

              </tr>
            </table>
<br>
<form action="addfaq.php" method=POST onsubmit="return CheckForm(this)">

<input type=hidden name=idtov value={idtov}>
<input type=hidden name=cid value={cid}>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width=25> </td>
<td bgcolor="ffffff">
<span style="font-size:8pt"><font face="Tahoma">Ваше имя:</font></span><br>
<input type=text name="namefaq"><br>
<span style="font-size:8pt"><font face="Tahoma">Ваш email:</font></span><br>
<input type=text name="emailfaq"><br>
<span style="font-size:8pt"><font face="Tahoma">Сообщение:</font></span><br>
<textarea cols=30 rows=7 name="messfaq"></textarea>
<td width=25> </td>
</tr>
</table>
<table width="490" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height=7 colspan=3> </td>
</tr>
<tr>
<td width=25> </td>
<td bgcolor="ffffff" colspan=2>
<span style="font-size:8pt"><font face="Tahoma">Введите число, указанное на картинке:</fomt></span>
</td>
</tr>
<tr>
<td width=25> </td>
<td bgcolor=ffffff align=left width=154>
<img src="nnn.php"></td>
<td bgcolor=ffffff align=left>
<input type=text name="input_number"></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width=25> </td>
<td bgcolor="ffffff" colspan=2><br>
<input type=submit value="Добавить" class=knopka>
</tr>
</table>
</form>