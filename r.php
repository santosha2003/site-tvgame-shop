<?php

if(isset($_GET['pid'])&&($_GET['pid']=='55')){
$count=@file("countip/count.txt");

$fp=fopen("countip/count.txt","w");
fwrite($fp,0);
fclose($fp);
$fp=fopen("countip/count.txt","w");
$count[0]++;
 fwrite($fp,$count[0]);
fclose($fp);
$log=fopen("countip/iplog.txt", "a+");
    fputs ($log,$REMOTE_ADDR."\n");
    fclose($log);
 }

?>