<table width="100%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td><br>
                <div class=title>Редактирование FAQ</div>
                <hr>
                </td>
              </tr>
            </table>
            <br>
 <form action=index.php method=POST>
 <input type=hidden name=op value=faqcatalog>
 <input type=hidden name=module value=updel>
 <input type=hidden name=page value="{page}">
 <input type=hidden name=cat value="{cat}">
 <input type=hidden name=id value="{id}">
 <input type=hidden name=messfaq value="{messfaq}">
 <input type=hidden name=answer value="{answer}">
 <input type=hidden name=del value="{del}">


 <table width="95%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td align=center>
  <hr color="000000" size=1 noshade>

  <span style="font-size:9pt"><font face="Verdana" color="000000"><b>Категория: {namec}</b></span></font>

    <hr color="000000" size=1 noshade>
               <br>
                </td>
                </tr>
       <tr>
                <td align=center>

  <!-- BEGIN list_cat -->
   <input type=hidden name=id[] value="{id}">
  <table width="100%" border="1" cellspacing="0" cellpadding="4" align=center bordercolordark="ffffff" bordercolorlight="999999">
              <tr>
                <td width="30%">
   <span style="font-size:8pt"><font face="Verdana" color="000000"><b>Дата:</b> {datafaq}</font></span><br>
   <span style="font-size:8pt"><font face="Verdana" color="000000"><b>Имя:</b> {namefaq}</font></span><br>
   <span style="font-size:8pt"><font face="Verdana" color="000000"><b>E-mail:</b> {mailfaq}</font></span><br>
   </td>

   <td width="60%">
    <span style="font-size:8pt"><font face="Verdana" color="000000">Вопрос:</font></span><br>
   <textarea name=messfaq[] cols=40 rows=4>{messfaq}</textarea>
   <br>
   <span style="font-size:8pt"><font face="Verdana" color="000000">Ответ:</font></span><br>
   <textarea name=answer[] cols=40 rows=4>{answer}</textarea>


   </td>


   <td align=center><p>Удалить?</p>

    <select name=del[]>
    <option value=1>Нет&nbsp;&nbsp;&nbsp;</option>
    <option value=2>Да&nbsp;&nbsp;&nbsp;</option>
    </select>
    </td>
    </tr>
    </table>

  <!-- END list_cat -->
  <!-- BEGIN no_list_cat -->
 <span style="font-size:9pt"><font face="Verdana" color="000000">В этой категории нет отзывов</span></font><br><br>
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


      <input type=submit name=submit value="Внести изменения">
      <hr color="cccccc" size=1 noshade>
      <span style="font-size:9pt"><font face="Verdana" color="000000"><b><a href="index.php?op=faqcatalog"><<< Вернуться к каталогу</a></b></span></font>

      </form>

          </td></tr>
                </table>