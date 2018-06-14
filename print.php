<?php

require_once('./lib/config.php');
if(!empty($_GET['display'])){
$tn=htmlspecialchars($_GET['display'], ENT_XML1, cp1251);     }
if(!empty($_GET['id'])){
$tn=htmlspecialchars($_GET['id'], ENT_XML1, cp1251);     }

 $query = "SELECT * FROM items WHERE id='$tn' AND status='Y'";
$result = mysql_query($query);
$num_result = mysql_num_rows($result);


for($i=0; $i<$num_result; $i++)
 {
 $row = mysql_fetch_array($result);

echo "
 <HTML><HEAD><TITLE>Версия для печати&nbsp;-";
 echo '&nbsp;' . $row['name'] . '&nbsp;' . $row['mark'] . '&nbsp;' . $row['model'];
 echo "</TITLE>

<META content='MSHTML 6.00.2900.2180' name=GENERATOR><LINK
href='printstyle.css' type=text/css rel=stylesheet>
</HEAD>
<BODY>
<TABLE border=0 cellpadding=0 cellspacing=0 width=563>
    <TR><TD>
<HR color='000000'>
</TD></TR></TABLE>
<TABLE border=0 cellpadding=0 cellspacing=0 width=563>
    <TR>
    <TD ALIGN=center width=263  rowspan=3>

       <IMG src='./images/photo/";
           echo stripslashes($row['photo_small']);
           echo "' border=0>
                          </TD>
    <TD class=name><center>";
    echo stripslashes($row['name']);
      echo "  </center></TD></TR>
    <tr>
    <TD VALIGN=top class=model><center>";
  echo stripslashes($row['mark']);
 echo "&nbsp;:&nbsp;";
  echo stripslashes($row['model']);
echo "</center><HR color='000000'>        </TD></TR>";
echo "<TR>
    <TD VALIGN=top class=descript>";
$query = "SELECT * FROM items_value WHERE id='$tn' ORDER BY updown";
$result = mysql_query($query);
$num_result = mysql_num_rows($result);
for($i=0; $i<$num_result; $i++)
 {
 $row = mysql_fetch_array($result);
$queryz = "SELECT name FROM items_ref WHERE id='$row[rid]'" ;
$resultz = mysql_query($queryz);
 $rowz = mysql_fetch_array($resultz);
echo "-&nbsp;";
echo $rowz['name'];

echo "&nbsp;-&nbsp;";

echo $row['value'];

echo "<br>";

}



echo "<HR color='000000' height='1'></TD></TR>";
}
$queryz = "SELECT description, price FROM items WHERE id='$tn' AND status='Y'";
$resultz = mysql_query($queryz);
$num_resultz = mysql_num_rows($resultz);


for($i=0; $i<$num_resultz; $i++)
 {
 $rowz = mysql_fetch_array($resultz);


        echo "<TR>
     <TD class=descript width=563 colspan=2>";
   echo stripslashes($rowz['description']);


   echo " </TD></TR>
    <TR>
    <TD class=cen align=right width=563 height=34 colspan=2>
        <HR color='000000'><BR>
           Цена: <FONT color=red>";
echo stripslashes($rowz['price']);
echo "</FONT>&nbsp;р.
                      </TD></TR></TABLE>";


 }
echo "</BODY></HTML>";

?>