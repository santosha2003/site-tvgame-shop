
 <div class=title>Назначение пароля,скидки,менеджера клиенту</div>
 <hr>

 <table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td valign=top class=t><br>
 <hr color="cccccc" size="1" noshade>
Зарегистрированный клиент
 <hr color="cccccc" size="1" noshade>
</td>
</tr>
<tr>
<td valign=top class=t>
<table width="100%" cellspacing="0" cellpadding="1" border="0">
  <tr>
        <td class=tb bgcolor="#000000">
  <form action=index.php method=GET>
   <input type=hidden name=op value=starting>
   <input type=hidden name=action value=add>
   <table width="100%" cellspacing="0" cellpadding="3" border="0">
  <tr>
        <td class=tb bgcolor="#f0f0f0" >
        <select name=id class=t>
        <!-- BEGIN select -->
        <option value="{id}">{fio}, E-mail : {username}
         <!-- END select -->
        </select>
   </td></tr></table></td></tr></table>
        </td></tr>




        <tr>
<td valign=top class=t><br>
<hr color="cccccc" size="1" noshade>
Назначение скидки на товар
<hr color="cccccc" size="1" noshade>
</td>
</tr>
<tr>
<td valign=top class=t>
<table width="100%" cellspacing="0" cellpadding="1" border="0">
  <tr>
 <!-- BEGIN skidka -->
        <td class=tb bgcolor="#000000">
   <table width="100%" cellspacing="0" cellpadding="3" border="0">
  <tr>
        <td class=tb bgcolor="#f0f0f0">
  <input type=text name=skidka value="{skidka}" size="10"> %
   </td></tr></table></td></tr></table>
        </td></tr>
       </table>
   <!-- END skidka -->



  <table width="100%" cellspacing="0" cellpadding="3" border="0">
  <tr>
        <td class=tb><br>
  <input type=submit name=knopka value="Поехали!">
   </form></td></tr></table>
        </td></tr></table>