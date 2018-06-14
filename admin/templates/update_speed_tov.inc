

<table width="100%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td><br>
                <div class=title>Быстрое редактирование товаров (код, цена)</div>
                <hr>
                </td>
              </tr>
            </table>




             <!-- BEGIN hidden_list -->

    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td align="left">
<font class=nameglav></font>
<br>
                </td>
              </tr>
            </table><br>

  <form action=index.php method=POST name=catprint>

                <input type=hidden name=op value=update_speed_tov>
                <input type=hidden name=mode value=start>




             

            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td bgcolor="#000000">
                  <table width="100%" border="0" cellspacing="1" cellpadding="3">
                    <tr bgcolor="f2f2f2">
                     <td width="10%" class=t align="center"><b>Артикул</b></td>
                      <td width="60%" class=t align="center"><b>Наименование</b></td>
                      <td width="15%" class=t align="center" width="100"><b>Код</b></td>

                      <td width="15%" class=t align="center" width="100"><b>Цена</b></td>
                    </tr>


  <!-- BEGIN list_items -->

               <input type=hidden name=id[] value={id}>
                    <tr bgcolor="#FFFFFF">


                    <td class=t align="center">{sku}</td>

                      <td class=t bgcolor="#FFFFFF">{name} {mark} {model}</td>


         <td class=t bgcolor="#FFFFFF" align=center><input type=text name=kod1c[] value="{kod1c}" size=24></td>
         <td class=t bgcolor="#FFFFFF" align=center><input type=text name=price[] value="{price}" size=10></td>
                    </tr>


    <!-- END list_items -->


            </table>
             </td>
              </tr>
            </table><br>



 <br><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>

 <td align="center" bgcolor="f2f2f2">
  <hr color="000000" size="1" noshade>
 <input type=submit value="Внести изменения!">
  <hr color="000000" size="1" noshade>
 </td>


                       </tr></table></form>

 <br>

 <!-- END hidden_list -->
 <br>



            </td></tr></table>