<?php

 require_once("./lib/config.php");
  $tmpl -> loadTemplatefile("golos_show.inc",true,true);
  $query = "SELECT worker FROM golosovanie";
$result = mysql_query($query);
 $id = mysql_num_rows($result);
 //блок1
 $query1 = "SELECT worker FROM golosovanie WHERE s1='Y'";
$result1 = mysql_query($query1);

       $rows[worker1] = mysql_num_rows($result1);
       $rows[worker]=substr($rows[worker1]*100/$id, 0,5);

  //блок2
 $query2 = "SELECT gosslug FROM golosovanie WHERE s2='Y'";
$result2 = mysql_query($query2);
       $rows[gosslug1] = mysql_num_rows($result2);
       $rows[gosslug]=substr($rows[gosslug1]*100/$id, 0,5);
  //блок3
 $query3 = "SELECT manager FROM golosovanie WHERE s3='Y'";
$result3 = mysql_query($query3);
       $rows[manager1] = mysql_num_rows($result3);
       $rows[manager]=substr($rows[manager1]*100/$id, 0,5);
//блок4
$query4 = "SELECT student FROM golosovanie WHERE s4='Y'";
$result4 = mysql_query($query4);
       $rows[student1] = mysql_num_rows($result4);
       $rows[student]=substr($rows[student1]*100/$id, 0,5);
 //блок5
 $query5 = "SELECT director FROM golosovanie WHERE s5='Y'";
$result5 = mysql_query($query5);
       $rows[director1] = mysql_num_rows($result5);
       $rows[director]=substr($rows[director1]*100/$id, 0,5);
//блок6
 $query6 = "SELECT other FROM golosovanie WHERE s6='Y'";
$result6 = mysql_query($query6);
       $rows[other1] = mysql_num_rows($result6);
       $rows[other]=substr($rows[other1]*100/$id, 0,5);

// Вывод инфо
        $tmpl -> setVariable($rows);
?>