

<table width="100%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td><br>
                <div class=title>Быстрое редактирование товаров (код, цена)</div>
                <hr>
                </td>
              </tr>
            </table>




             <!-- BEGIN hidden_list -->



  <form action=index.php method=POST>

                <input type=hidden name=op value=select>
                <input type=hidden name=mode value=start>

            <!-- BEGIN list_cat -->
             <table width="100%" border="1" cellspacing="1" cellpadding="0" align="center" bordercolor=000000>

              <tr>
                <td class=tb bgcolor="#cccccc" height="20" align="center"><b>{name}</b></td>
              </tr>
            </table>
              <!-- END list_cat -->




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


                    <td class=t align="center"><input type=text name=sku[] value="{sku}"></td>

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

  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td align="left">
               <font class=nameglav><b>Категории</b></font>
               <hr color="000000" size=1 noshade>
      <!-- BEGIN list_items_cat1 -->
                <font class=nameglav><a href="index.php?op=select&mode=listselect&id={id}">{name}</a></font>
<br>
    <!-- END list_items_cat1 -->
    <hr color="000000" size=1 noshade>
                </td>
              </tr>
            </table><br>


 <!-- END hidden_list -->
 <br>



            </td></tr></table>