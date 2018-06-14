

<?php

require_once("./auth.php");

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
  <title></title>
 <link rel=stylesheet href="style.css" type="text/css">
  </head>

<body>




 <script type="text/javascript" language="javascript">
 <!--
 function submitForm() {
  document.tablesForm.action[0].value = "";
  document.tablesForm.submit();
}

-->
</script>
<?
$q="SELECT * FROM items";
$res=mysql_query($q);
 $num_result = mysql_num_rows($res);
echo "<center>Всего найдено ".$num_result." записей.</center><br>";
 ?>


 <table border="0" cellpadding="0" cellspacing="0" width=100%>

  <tr>
        <td align=center width=100% bgcolor="#f2f2f2">
 <?
 if (isset($_GET['count'])){
$per_page=$_GET['count'];
}else $per_page=10;
 ?>

        <form action=countitems.php method=GET>
        Сколько товаров показывать на странице:&nbsp;&nbsp;
        <select name=count onChange="this.form.submit();">
         <option value=<?php print $per_page; ?>><?php print $per_page; ?>&nbsp;&nbsp;&nbsp;&nbsp;
         <option value="10">10&nbsp;&nbsp;&nbsp;&nbsp;
         <option value="20">20&nbsp;&nbsp;&nbsp;&nbsp;
          <option value="30">30&nbsp;&nbsp;&nbsp;&nbsp;
          <option value="40">40&nbsp;&nbsp;&nbsp;&nbsp;
          <option value="50">50&nbsp;&nbsp;&nbsp;&nbsp;
          </select>
        </form>
        </td>
</td></tr></table>
<br><br>
<table border="0" cellpadding="0" cellspacing="0" width=70% align=center>

  <tr>
        <td align=center bgcolor="#000000">
 <table border="0" cellpadding="2" cellspacing="1" width=100%>

  <tr>
        <td bgcolor="#ffffff">



        <?
// количество записей, выводимых на странице

// получаем номер страницы
if (isset($_GET['page'])) $page=($_GET['page']-1); else $page=0;
// вычисляем первый оператор для LIMIT
$start=abs($page*$per_page);
// составляем запрос и выводим записи
// переменную $start используем, как нумератор записей.

$q="SELECT * FROM items LIMIT $start,$per_page";
$res=mysql_query($q);
while($row=mysql_fetch_array($res)) {
  echo ++$start.". <a href=../index.php?id=".$row['id'].">".$row['name']." ".$row['mark']." ".$row['model']."</a><br>";
}
?>
</td></tr></table>
</td></tr></table>
<br><br>
Страницы:&nbsp;&nbsp;
<?
// дальше выводим ссылки на страницы:
$q="SELECT count(*) FROM items";
$res=mysql_query($q);
$row=mysql_fetch_row($res);
$total_rows=$row[0];

$num_pages=ceil($total_rows/$per_page);

for($i=1;$i<=$num_pages;$i++) {

  if ($i-1 == $page) {
    echo $i." ";

  } else {


    echo "<a href=".$_SERVER['PHP_SELF']."?count=".$_GET['count']."&page=".$i.">".$i."</a>&nbsp;&nbsp;";
  }

  }



?>
</body>

</html>
