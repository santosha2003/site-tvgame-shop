<table width="100%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td><br>
                <div class=title>Добавление ссылок</div>
                <hr>
                </td>
              </tr>
            </table>
            <br>
     <!-- BEGIN info -->
            <span style="font-size:10pt"><font face="Verdana" color="000000"><b>{info}</b></font></span><br>
       <!-- END info -->



    <form action=index.php method=POST>
  <input type=hidden name=op value=addlink>
  <input type=hidden name=mode value=startlink>
  <table width="95%" border="0" cellspacing="0" cellpadding="0" align=center>
              <tr>
                <td align=center colspan=2>
               <hr color="cccccc" size=1 noshade>
                <span style="font-size:8pt"><font face="Verdana" color="000000">Выберите категорию для добавления ссылки:</span></font><br>
                <select name=cat>
                <!-- BEGIN select -->
                <option value="{idcat}">{namecat}&nbsp;&nbsp;</option>
                <!-- END select -->
                </select>
                <br><hr color="cccccc" size=1 noshade>
                </td></tr>
 <tr>
                <td align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">Введите код ссылки1:</span></font><br>
                <textarea name=link rows=10 cols=38></textarea>
                <br><br></td>


                <td align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">Введите код ссылки2:</span></font><br>
                <textarea name=link1 rows=10 cols=38></textarea>
                <br><br></td></tr>
 <tr>
                <td align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">Введите код ссылки3:</span></font><br>
                <textarea name=link2 rows=10 cols=38></textarea>
                <br><br></td>


                <td align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">Введите код ссылки4:</span></font><br>
                <textarea name=link3 rows=10 cols=38></textarea>
                <br><br></td></tr>
<tr>
                <td align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">Введите код ссылки5:</span></font><br>
                <textarea name=link4 rows=10 cols=38></textarea>
                <br><br></td>

                <td align=center>
<span style="font-size:8pt"><font face="Verdana" color="000000">Введите код ссылки6:</span></font><br>
                <textarea name=link5 rows=10 cols=38></textarea>
                <br><br></td></tr>



              <tr>
                <td align=center colspan=2>
               <hr color="cccccc" size=1 noshade>
                <span style="font-size:8pt"><font face="Verdana" color="000000">Добавить новую категорию:</span></font><br>
                <input type=text name=newcat size=50>
                <br><br>
                </td></tr>
                 <tr>
                <td align=center colspan=2>
                 <hr color="000000" size=1 noshade>
                <input type=submit name=submit value="Добавить">
                <hr color="000000" size=1 noshade>
                </td></tr>
                </table>
               </form>