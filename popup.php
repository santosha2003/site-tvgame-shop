<?php
require_once("./lib/config.php");
?>
<html>
<head>
<link rel=stylesheet href="style.css" type="text/css"> 
</head>
<body bgcolor=white onload="self.focus()">
<table border=0 width="300" height="300">
<tr width="300" height="300"><td class=t width="300" height="300">
<? $id=$_GET['id']; $row = $db -> getRow("SELECT * FROM svva WHERE id='$id'"); ?>
<img src=images/pict/<?= $row['photo'] ?> width="300" height="300" hspace=3 align=center><b><?= $row['name'] ?></b><br><?= $row['description']; ?>
</td></tr>
</table>
<br><div align=center><input type=button value="Закрыть окно" onClick="self.close();"></div>
</body>
</html>