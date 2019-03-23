<?php
  require_once "HTML/Template/IT.php";

  $data = array
  (
    "0" => array("cvs_username" => "pajoye",
                 "realname" => "Pierre-Alain Joye"),
    "1" => array("cvs_username" => "dsp",
                 "realname" => "David Soria Parra")
  );

  $tpl = new HTML_Template_IT("./templates");

  $tpl->loadTemplatefile("cvsnames.tpl.htm", true, true);

  foreach($data as $name) {

     $tpl->setVariable("CVS_USERNAME", $name["cvs_username"]);
     $tpl->setVariable("REALNAME", $name["realname"]);

     $tpl->parse("row");
  }

  // show() parses the __global__ block and
  // print the output
  $tpl->show();

?>
