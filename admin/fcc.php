<?

require_once("./auth.php");

 $tmpl -> loadTemplatefile("fcc.inc",true,true);

 if (file_exists("../countip/iplogfullstat.txt")){
$con=file("../countip/iplogfullstat.txt");

 foreach ($con as $line) {

 $tmpl -> setCurrentBlock('list');
        $tmpl -> setVariable('ip',$line);
        $tmpl -> parseCurrentBlock('list');
  }
  }else $tmpl -> touchBlock('no_ip');

 if(isset($_GET['mode'])&&($_GET['mode']=='del')){
  unlink("../countip/iplogfullstat.txt");

 header("Location: index.php?op=fcc");

  }



 ?>