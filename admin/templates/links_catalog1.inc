<table width="100%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td><br>
                <div class=title>Операции над ссылками</div>
                <hr>
                </td>
              </tr>
            </table>
            <br>
 <form action=index.php method=POST>
 <input type=hidden name=op value=linkscatalog>
 <input type=hidden name=module value=delete>

 <table width="95%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td align=center>
  <hr color="000000" size=1 noshade>

  <span style="font-size:9pt"><font face="Verdana" color="000000"><b>Раздел: {namecat}</b></span></font>

    <hr color="000000" size=1 noshade>
               <br>
                </td>
                </tr>
       <tr>
                <td align=center>
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td bgcolor="#999999" width="70%" align=center>
                <span style="font-size:9pt"><font face="Verdana" color="ffffff"><b>Ссылка</b></font></span>
               </td>
               <td bgcolor="#999999" align=center>
               <span style="font-size:9pt"><font face="Verdana" color="ffffff"><b>Удалить</b></font></span>
               </td>
               </tr>
               </table>
  <!-- BEGIN list_cat -->
   <input type=hidden name=idlinks[] value="{idlinks}">
  <table width="80%" border="1" cellspacing="0" cellpadding="4" align=center bordercolordark="ffffff" bordercolorlight="999999">
              <tr>
                <td width="70%">
   <span style="font-size:9pt"><font face="Verdana" color="000000">{visuallinks}</font></span>
   </td>
   <td align=center>

    <select name=del[]>
    <option value=1>Нет&nbsp;&nbsp;&nbsp;</option>
    <option value=2>Да&nbsp;&nbsp;&nbsp;</option>
    </select>
    </td>
    </tr>
    </table>

  <!-- END list_cat -->
  <!-- BEGIN no_list_cat -->
 <span style="font-size:9pt"><font face="Verdana" color="000000">В этой категории нет ссылок</span></font><br><br>
  <!-- END no_list_cat -->
  <br><br>
                </td>
                </tr>
    <tr>
                <td align=center>
   {hr}
   <span style="font-size:9pt"><font face="Verdana" color="000000">Страницы:&nbsp;&nbsp;</span></font>
   <!-- BEGIN list_nav -->
   {s}
   <!-- END list_nav -->
   {hr1}

                </td>
                </tr>
     <tr>
                <td align=center><br>


      <input type=submit name=submit value="Удалить">
      <hr color="cccccc" size=1 noshade>
      </form>

          </td></tr>
                </table>