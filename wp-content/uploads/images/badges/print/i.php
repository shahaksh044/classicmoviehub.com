<?php

if(!isset($_GET['i']{0}))
exit;

// Set the content-type
header('Content-Type: image/png');

$year=$_GET['year'];
$type_text=$_GET['t'];
$i=$_GET['i'];


$color='#00000';

if(isset($_GET['color']{0}))
$color=$_GET['c'];

//convert hexadecimal color is RGB//



// Create the image
/*$im = imagecreatetruecolor(400, 30);

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 399, 29, $white);*/

$i="http://badges.classicmoviehub.com/".$i.".jpg";

$im=imagecreatefromjpeg($i);

// The text to draw
//$text = 'Testing...';

$color = imagecolorallocate($im, 255, 4, 4);


if(isset($type_text{0}) or isset($year{0}))
{


$array_text=array(
"member_since"=>array("10", "80", "12", "Member since ".$year)
);


// Replace path by your own font path
$font = 'Vera.ttf';

$x=$array_text[$type_text][0];
$y=$array_text[$type_text][1];
$font_size=$array_text[$type_text][2];
$text=$array_text[$type_text][3];


//die($x." - ".$y." - ".$font_size." - ".$text);

//imagettftext($im, 12, 0, 10, 80, $color, 'Vera.ttf', $text);
ImageString($im, 12, 10, 80, $text, $color); 

}

// Add some shadow to the text

// Add the text
//imagettftext($im, 20, 0, 10, 20, $black, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
imagejpeg($im, "", 100);
imagedestroy($im);
?>