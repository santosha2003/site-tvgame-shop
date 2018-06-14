<?php
 require_once('./lib/config.php');
require_once("./lib/shoppingcart.php");
$ipLog='images/iplogfile4.txt';   // Your logfiles name here
$timeout='24';            // How many hours to block IP
//$goHere='golos.php?';   // Allowed pages name here
// $gohere1=$_POST['ask'];
 //$plus=$goHere.$gohere1;
 // PHP script by Dave Lauderdale
// Published at: www.digi-dl.com

function record($REMOTE_ADDR,$ipLog)
{
    $log=fopen("$ipLog", "a+");
    fputs ($log,$REMOTE_ADDR."][".time()."\n");
    fclose($log);

if(isset($_POST['ask'])&&($_POST['ask']=="worker")){
   $worker = htmlspecialchars($_POST[ask]);
  $query= "INSERT INTO golosovanie (worker,s1) values('1', 'Y')";
  //$query= "UPDATE users SET wor='$cenmagaz' WHERE id='".$_SESSION[auth][id]."'";
   $result =mysql_query($query);
     header("Location: index.php?op=showmode");
    exit;
   }else{
   header("Location: index.php");

    }
   if(isset($_POST['ask'])&&($_POST['ask']=="gosslug")){
   $gosslug = htmlspecialchars($_POST[ask]);
  $query= "INSERT INTO golosovanie (gosslug,s2) values('1', 'Y')";
  //$query= "UPDATE users SET wor='$cenmagaz' WHERE id='".$_SESSION[auth][id]."'";
   $result =mysql_query($query);
    header("Location: index.php?op=showmode");
     exit;
   }else{
   header("Location: index.php");
    }
 if(isset($_POST['ask'])&&($_POST['ask']=="manager")){
   $manager = htmlspecialchars($_POST[ask]);
  $query= "INSERT INTO golosovanie (manager,s3) values('1', 'Y')";
  //$query= "UPDATE users SET wor='$cenmagaz' WHERE id='".$_SESSION[auth][id]."'";
   $result =mysql_query($query);
     header("Location: index.php?op=showmode");
     exit;
   }else{
   header("Location: index.php");
    }

  if(isset($_POST['ask'])&&($_POST['ask']=="student")){
   $student = htmlspecialchars($_POST[ask]);
  $query= "INSERT INTO golosovanie (student,s4) values('1', 'Y')";
  //$query= "UPDATE users SET wor='$cenmagaz' WHERE id='".$_SESSION[auth][id]."'";
   $result =mysql_query($query);
     header("Location: index.php?op=showmode");
     exit;
   }else{
   header("Location: index.php");
    }

 if(isset($_POST['ask'])&&($_POST['ask']=="director")){
   $director = htmlspecialchars($_POST[ask]);
  $query= "INSERT INTO golosovanie (director,s5) values('1', 'Y')";
  //$query= "UPDATE users SET wor='$cenmagaz' WHERE id='".$_SESSION[auth][id]."'";
   $result =mysql_query($query);
    header("Location: index.php?op=showmode");
    exit;
   }else{
   header("Location: index.php");
    }
   if(isset($_POST['ask'])&&($_POST['ask']=="other")){
   $other = htmlspecialchars($_POST[ask]);
  $query= "INSERT INTO golosovanie (other,s6) values('1', 'Y')";
  //$query= "UPDATE users SET wor='$cenmagaz' WHERE id='".$_SESSION[auth][id]."'";
   $result =mysql_query($query);
     header("Location: index.php?op=showmode");
     exit;
   }else{
   header("Location: index.php");
    }
 }
 function check($REMOTE_ADDR,$ipLog,$timeout)
{
    global $valid; $ip=$REMOTE_ADDR;
    $data=file("$ipLog"); $now=time();

    foreach ($data as $record)
    {
        $subdata=explode("][",$record);
        if ($now < ($subdata[1]+3600*$timeout) && $ip == $subdata[0])
        {
            $valid=0; echo "Вы уже внесли данные.";
            break;
        }
    }
}
check($REMOTE_ADDR,$ipLog,$timeout);
if ($valid!="0") record($REMOTE_ADDR,$ipLog);



   ?>