 <script type="text/javascript" language="javascript">
<!--


function submitForm(id) {
  document.tablesForm.action[0].value = id;
  document.tablesForm.submit();
}

-->
</script>
 <div class=title>Ќазначение скидки клиенту</div>
 <hr>

 <table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td valign=top class=t><br>
 <hr color="cccccc" size="1" noshade>
¬ыберите зарегистрированного клиента
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
   <input type=hidden name=action value=view>
   <table width="100%" cellspacing="0" cellpadding="3" border="0">
  <tr>
        <td class=tb bgcolor="#f0f0f0" >
        <select name=id class=t onChange="this.form.submit();">
        <option value="2" class=t>—писок зарегистрированных пользователей
        <!-- BEGIN select -->
        <option value="{id}">{fio}, E-mail : {username}
         <!-- END select -->
        </select>
   </td></tr></table></td></tr></table>
        </td></tr>
</form>
        </td></tr></table>