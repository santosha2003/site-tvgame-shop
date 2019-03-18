<?php

session_start();

define('STEP',10);
define('XS',150);
//$HTTP_SESSION_VARS
$_SESSION['number'] = rand(1000,9999);
 $qwer=$_SESSION['number']; //$HTTP_SESSION_VARS['number'];
$im = @ImageCreate(XS, 25) or die ("Cannot Initialize new GD image stream");

$background_color = ImageColorAllocate ($im, 242, 242, 242);
$text_color = ImageColorAllocate($im, 0, 0, 0);


ImageSetThickness($im, 1);
ImageRectangle($im,0,0,XS-1,24,$text_color);
for($j=-2; $j<imagesx($im)/STEP+1; $j++){
    //$cur_points_y[] = -rand(0,STEP);
    //$cur_points_x[] = rand($j*STEP+STEP/1.4,$j*STEP+STEP*1.4);
    $last=0;
    for($i=-2; $i<imagesy($im)/STEP+1; $i++)
    {
        $last = STEP*$i+rand(STEP/1.4,STEP*1.4);
        $cur_points_y[] = $last;
        $cur_points_x[] = rand($j*STEP+STEP/1.4,$j*STEP+STEP*1.4);
    }
    $cur_points_y[] = 25;
    $cur_points_x[] = rand($j*STEP+STEP/1.4,$j*STEP+STEP*1.4);
    for($i=1; $i<5; $i++)
    {
         }
    unset($prev_points_x);
    unset($prev_points_y);
    $prev_points_x = $cur_points_x;
    $prev_points_y = $cur_points_y;
    unset($cur_points_x);
    unset($cur_points_y);
}

$num = (string)$_SESSION['number'];

for($i = 0; $i < strlen($num); $i++)
{
    $cipher = substr($num, $i, 1);
    $psize = rand(imagesy($im)-8,imagesy($im)-3);
    $angle = rand(0,10)-5;
    $sizes = ImageTTFBBox($psize, $angle, "arbat.ttf", $cipher);
    $width = $sizes[2]-$sizes[0];
    $height = $sizes[1]-$sizes[7];
    $dh = (23-$height)/2;
    $px = (imagesx($im)/strlen($num))*$i+(imagesx($im)/strlen($num)-$width)/2;
    $py = ($height+$dh+1)+rand(-$dh, $dh);
    ImageTTFText ($im, $psize, $angle, $px, $py, $text_color, "arbat.ttf", $cipher);
}

ob_start();
ImagePng($im);
$content=ob_get_contents();
ob_end_flush();

Header("Accept-ranges: bytes");
Header("Content-length: ".strlen($content));
Header("Content-type: image/png");
echo $content;

?>