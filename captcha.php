<?php
include("config.php");
session_set_cookie_params(0,$path);
session_start();
$font='LaBelleAurore.ttf'; //selects the fonts
$length=2;//length of word
$font1='Times New Roman.ttf'; //selects the fonts

header('Content-Type:image/png'); //creates and image

//fills the color
$im = imagecreatetruecolor(350,100);
$black = imagecolorallocate($im,0,0,0);
$yellow = imagecolorallocate($im,255,252,0);
$purple= imagecolorallocate($im,128,0,128);

$blue=ImageColorAllocate($im,0,255,255);
ImageAlphaBlending($im,false);
ImageFilledRectangle($im,0,0,350,100,$blue);
imagefilledrectangle($im,8,8,340,92,$yellow);
//Creats random captcha text
$text=substr(str_shuffle(md5(time())),0,$length);
imagettftext($im,25,20,50,42,$black,$font,$text);
$text1=substr(str_shuffle(md5(time())),0,$length);
imagettftext($im,25,-20,90,42,$black,$font,$text1);
$name = $text.$text1;
$_SESSION["captcha"]=$name;//stores the captcha in session

ImageAlphaBlending($im,True);
session_id();
$cap="Captcha: ".$name;//prints captcha on image
imagettftext($im,11,0,10,85,$black,$font1,$cap);
$ses = "Session id: ".session_id();//prints session id on image
imagettftext($im,11,0,10,70,$black,$font1,$ses);
//different loops for line and dots to create an distraction.
for($i=0;$i<3;$i++) 
{
    Imageline($im,15,rand()%50,200,rand()%90,$purple);
}
  for($i=0;$i<20;$i++) 
{
    $col_ellipse = imagecolorallocate($image, rand()%200,  rand()%200, rand()%100);
   imageellipse($im, rand()%150, rand()%80, 5 , 5, $col_ellipse);
}
imagepng($im);
imagedestroy($im);

?>
