<?php
require_once("./auth.php");
 if(isset($_GET['mode'])&&($_GET['mode']=='del')){
 unlink("../countip/iplog.txt");
 unlink("../countip/count.txt");
 header("Location: countstat.php");
 }else
 {
 $fp=fopen("../countip/count.txt","r");
$row=fread($fp,100000);


 ?>

  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" bgcolor='#F6F6F6'>

 <?php
 include("templates/menu_oper.inc");
 ?>


 </td></tr></table><br><br>
 <span style="font-size:16pt;"><b><font color="0099FF" face="Tahoma">Статистика посещений страницы "Все для пикника"</font></b></span>
 <hr><br><br>
 <table cellspacing=0 cellpadding=1 border=0 width=60% align=center>
<tr>
<td valign=top class=t bgcolor="999999">
<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td valign=top class=t bgcolor="ffffff" align=center><br>

<span style="font-size:16pt;"><b><font color="black" face="Tahoma">Количество посетителей &nbsp;</font></b></span>
<span style="font-size:16pt;"><b><font color="red">
<?
if($row==true){
print $row;
}else{
 print "0";
 }
 ?>
 </font></b></span>
<br>
<hr color="666666" size=1 noshade>
<span style="font-size:12pt;"><b><font color="000000" face="Tahoma">IP-адреса посетителей</font></b></span>
<hr color="666666" size=1 noshade>
<?
if (file_exists("../countip/iplog.txt")){
$con=file("../countip/iplog.txt");
$subdata=explode("][",$data);

foreach ($con as $line)
echo "<span style='font-size:12pt;'><font color='000000' face='Tahoma'>".$line."</font></span><br>";
}else{
echo "<span style='font-size:12pt;'><font color='000000' face='Tahoma'>Нет посетителей :(</font></span><br>";
}
?>
<hr color="666666" size=1 noshade><br><br>
</td></tr></table>
 </td></tr></table><br>
 <center><a href="countstat.php?mode=del" class=navi>Сбросить счетчик и очистить базу IP-адресов</a></center>
 <br><br>
 </body>
 </html>
 <?
 }
 ?>