<script type="text/javascript" language="javascript">
<!--

function pop_win(url, win, ht, wd, call) {
  if(call != "") {
        url = url + "&val=" + eval("document.send."+call+".value");
  }
  popwin = document.open(url,win,"width="+wd+",height="+ht+",toolbar=no,resizable=yes,scrollbars=yes");
}

function submitForm(id) {
  document.send.action2.value = id;
  document.send.submit();
}

function ValidData() {
  var missinginfo = "";

  if(document.send.name.value == "") {
        missinginfo += "\n     - Наименование";
  }

  if(document.send.price.value == "") {
        missinginfo += "\n     - Розничная цена";
  }

  if (missinginfo != "") {
        missinginfo ="Вы не заполнили одно из обязательных полей:\n" +
        "_____________________________\n" +
        missinginfo + "\n_____________________________" +
        "\n";
        alert(missinginfo);
        return false;
  }
  else return true;
}

-->
</script>
<!-- BEGIN head_edit -->
<div class=title>Редактирование товара
<!-- END head_edit -->
<!-- BEGIN head_add -->
<div class=title>Добавить новый товар
<!-- END head_add -->

<!-- BEGIN name -->
<font class=error>(Укажите наименование товара)</font>
<!-- END name -->
<!-- BEGIN title -->
<font class=error>(Уажите розничную цену)</font>
<!-- END title -->
</div>
<hr>
<p class=t><a href=index.php?op=item&parent={parent}&pages={pages}>Вернуться в каталог товаров</a></p>


<form action=item_add.php method=post enctype="multipart/form-data" name="send" onSubmit="return ValidData();">
<input type=hidden name=op value=item>
<input type=hidden name=action value={action}>
<input type=hidden name=parent value={parent}>
<input type=hidden name=id value={id}>
<input type=hidden name=pages value={pages}>
<input type=hidden name=tmpid value="">
<input type=hidden name=action2 value="">

<table border="1" cellpadding="4" cellspacing="2" bgcolor="#ffffff" bordercolor="#dddddd" style="border-collapse: collapse;" width=100%>

  <tr>
        <td class=tb colspan=2 align=center width=50% bgcolor="#F3F3F3">Наименование и описание товара</td>
        <td class=tb colspan=2 align=center width=50% bgcolor="#F3F3F3">Загрузка/редактирование изображения</td>
  </tr>

  <tr>
        <td class=tb align=right>Наименование: </td>
        <td class=t><input type=text name=name style="width: 230px;" value="{name}"></td>
        <td class=t align=right colspan=2>Уменьшеное изображение:&nbsp;&nbsp;&nbsp;
        <input type=file name=photo_small style="width: 230px;"><br>
        Ум. изображение чертежа:&nbsp;&nbsp;&nbsp;
        <input type=file name=photo_small1 style="width: 230px;"><br>
        Ум. изображение в природе:
        <input type=file name=photo_small2 style="width: 230px;" ></td>
  </tr>
  <tr>
        <td class=t align=right>Производитель : </td>
        <td class=t nowrap valign=bottom>
          <select name=vendor style="width: 230px;">
                <option value="">Выберите производителя из списка
<!-- BEGIN vendor -->
                <option value="{id}"{select}>{name}
<!-- END vendor -->
          </select>
          &nbsp;
          <a href="javascript:pop_win('reference.php?db=vendor&source=items', '', 600, 800, '');"><img src="images/right.gif" width="16" height="16" border="0" valign="middle"></a>
        </td>
  </tr>

  <tr>
        <td class=t align=right>Марка: </td>
        <td class=t><input type=text name=mark style="width: 230px;" value="{mark}"></td>

<!-- BEGIN no_small_photo -->

<!-- END no_small_photo -->
<!-- BEGIN no_small_photo1 -->

<!-- END no_small_photo1 -->
<!-- BEGIN no_small_photo2 -->

<!-- END no_small_photo2 -->
<td class=t rowspan=7 colspan=2 align=center>
<!-- BEGIN small_photo -->

          <img src=../images/photo/{small_foto} border=1 vspace=5><br>
          <a href="javascript:submitForm('small');" onClick="return confirm('Удалить фотографию?');">Удалить фотографию</a><br>
<!-- END small_photo -->


<!-- BEGIN small_photo1 -->
          <img src=../images/photo/{small_foto1} border=1 vspace=5><br>
          <a href="javascript:submitForm('small1');" onClick="return confirm('Удалить чертеж?');">Удалить чертеж</a><br>
<!-- END small_photo1 -->
<!-- BEGIN small_photo2 -->
          <img src=../images/photo/{small_foto2} border=1 vspace=5><br>
          <a href="javascript:submitForm('small2');" onClick="return confirm('Удалить фотографию в природе?');">Удалить фотографию в природе</a>


<!-- END small_photo2 -->
   </td>
  <tr>
        <td class=t align=right>Модель: </td>
        <td class=t><input type=text name=model value="{model}" style="width: 230px;"></td>
  </tr>

  <tr>
        <td class=t align=right>Артикул: </td>
        <td class=t><input type=text name=sku value="{sku}" style="width: 230px;"></td>
  </tr>


  <tr>
        <td class=tb align=right>Розничная цена: </td>
        <td class=t><input type=text name=price value="{price}" style="width: 230px;"></td>
  </tr>

  <tr>
        <td class=t align=right>Оптовая цена: </td>
        <td class=t><input type=text name=price_opt value="{price_opt}" style="width: 230px;"></td>
  </tr>
   <tr>
        <td class=t align=right>Код товара: </td>
        <td class=t><input type=text name=kod1c value="{kod1c}" style="width: 230px;"></td>
  </tr>
  <tr>
        <td class=t align=right valign=top>Я Маркет: </td>
        <td class=t> <input type=text name=market_show value="N" style="width: 230px;"></td>
  </tr>
  <tr>
        <td class=t align=right valign=top>Описание: </td>
        <td class=t valign=top><textarea name=description style="width: 230px;" rows=7 class="t">{description}</textarea></td>
  </tr>


  <tr>
        <td class=tb align=right>Магазины: </td>
        <td class=t valign=top colspan=3>
<!-- BEGIN shops -->
        <input type=checkbox name=shops[] value="{shops_id}" {checked} style="border: 1px solid #{color};">{name}
<!-- END shops -->
        </td>
  </tr>

  <tr>
        <td class=tb align=right>Характеристики товара: </td>
        <td class=t valign=top colspan=3>
<!-- BEGIN svva -->
        <input type=checkbox name=svva[] value="{svva_id}" {checked}><img src="../images/pict/{photo}" alt="{name}" title="{name}">
<!-- END svva -->
        </td>
  </tr>

<!--
  <tr>
        <td class=tb align=right>Свойства товара: </td>
        <td class=t valign=top colspan=3>
<!-- BEGIN statu -->
        <input type=checkbox name=statu[] value="{statu_id}" {checked}><img src="../images/pict/{photo}" alt="{name}" title="{name}">
<!-- END statu -->
        </td>
  </tr>
-->

  <input type=hidden name=statu value="{statu}">
  <tr>
        <td class=tb align=right>Свойства товара: </td>
        <td class=t valign=top colspan=3>
        <input type=button value="Назначить" onClick="pop_win('reference.php?db=statu&item_id={id}&parent={parent}&pages={pages}&source=items&call=add_item', '', 550, 600, 'statu');">
        </td>
  </tr>

  <input type=hidden name=article value="{article}">
  <tr>
        <td class=tb align=right>Тематические статьи: </td>
        <td class=t valign=top colspan=3>
        <input type=button value="Назначить" onClick="pop_win('reklama_cms.php?item_id={id}&parent={parent}&pages={pages}&source=article&call=add_item', '', 750, 600, 'article');">
        </td>
  </tr>

  <input type=hidden name=part value="{part}">
  <tr>
        <td class=tb align=right>Cвязанные товары: </td>
        <td class=t valign=top colspan=3>
        <input type=button value="Назначить" onClick="pop_win('reklama.php?item_id={id}&parent={parent}&pages={pages}&source=part&call=add_item', '', 750, 400, 'part');">
        </td>
  </tr>

  <input type=hidden name=spec value="{spec}">
  <tr>
        <td class=tb align=right>Рекомендованые товары: </td>
        <td class=t valign=top colspan=3>
        <input type=button value="Назначить" onClick="pop_win('reklama.php?item_id={id}&parent={parent}&pages={pages}&source=spec&call=add_item', '', 750, 400, 'spec');">
        </td>
  </tr>


  <tr>
        <td class=t align=center colspan=4><br>
            <input type=submit value="Внести изменения">
          <br><br>
        </td>
  </tr>


  <tr>
        <td class=tb align=center width=50% colspan=2 bgcolor="#F3F3F3">Технические характеристики</td>
        <td class=t align=right>Большое изображение:
        <input type=file name=photo_big style="width: 230px;"><br>
        Бол. изображение чертежа:
        <input type=file name=photo_big1 style="width: 230px;"><br>
        Бол. изображение в природе:
        <input type=file name=photo_big2 style="width: 230px;"><br>
        </td>
  </tr>

  <tr>
        <td class=tb align=center colspan=2 valign=top>
          <table>
                <!-- BEGIN item_row -->
            <tr>
                  <td class=ti align=center valign=center>
                        <select name=rn[] style="width: 200px;">
                          <option value={id_empty}>Выберите тип поля
                          <option value={id_empty}>Удалить этот параметр
                          <!-- BEGIN item_rselect -->
                          <option value={rid}{rselect}>{rname}
                          <!-- END item_rselect -->
                          <option value={id_empty}>Удалить этот параметр
                        </select><br>
                        <input type=text name=rnew[] style="width: 200px;" value="">
                  </td>
                  <td class=t valign=top><textarea name=rvalue[] style="width: 200px; height: 50px;" class="t">{rvalue}</textarea></td>
                </tr>
                <!-- END item_row -->
          </table>
        </td>
<!-- BEGIN no_big_photo -->

<!-- END no_big_photo -->
<!-- BEGIN no_big_photo1 -->

<!-- END no_big_photo1 -->
<!-- BEGIN no_big_photo2 -->

<!-- END no_big_photo2 -->




<td class=t colspan=2 align=center>
<!-- BEGIN big_photo -->

          <img src=../images/photo/{big_foto} border=1 vspace=5><br>
          <a href="javascript:submitForm('big');"  onClick="return confirm('Удалить фотографию?')">Удалить фотографию</a><br>

<!-- END big_photo -->
<!-- BEGIN big_photo1 -->

          <img src=../images/photo/{big_foto1} border=1 vspace=5><br>
          <a href="javascript:submitForm('big1');"  onClick="return confirm('Удалить чертеж?')">Удалить чертеж</a><br>

<!-- END big_photo1 -->
<!-- BEGIN big_photo2 -->

          <img src=../images/photo/{big_foto2} border=1 vspace=5><br>
          <a href="javascript:submitForm('big2');"  onClick="return confirm('Удалить фото в природе?')">Удалить фото в природе</a><br>

<!-- END big_photo2 -->
</td>
  </tr>


  <tr>
        <td class=t align=center colspan=4><br>
            <input type=submit value="Внести изменения"><br><br>
        </td>
  </tr>

</table>

<p class=t><a href=index.php?op=item&parent={parent}&pages={pages}>Вернуться в каталог товаров</a></p>
