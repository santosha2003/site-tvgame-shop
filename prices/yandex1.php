<?php
  if (file_exists("http://goodfishing.ru/admin/users/tov.xml")){
  $read=readfile("http://goodfishing.ru/admin/users/tov.xml");
 echo $read;
 }
?>