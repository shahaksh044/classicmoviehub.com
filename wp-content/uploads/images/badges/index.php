<?php


if(!isset($_GET['i']{0}))
exit;


//$base_id=trim(base64_decode(urldecode($_GET['i'])));

echo '/*var cmh_badge_real_url="'.$base_id.'.jpg";

var cmh_badge_link=document.getElementById("cmh_badge_link");
var cmh_badge_img=document.getElementById("cmh_badge_img");*/


var cmh_badge_blog=document.createElement("script");
var cmh_badge_blog_head=document.getElementsByTagName("head")[0];
cmh_badge_blog.src="http://badges.classicmoviehub.com/print/?i='.$_GET['i'].'&loc="+encodeURIComponent(window.location.href)+"";
cmh_badge_blog_head.appendChild(cmh_badge_blog);
';
/*if(!isset($_GET['i']{0}))
exit;

$website="<br/>lol ".$_SERVER['HTTP_REFERER']." ".$_SERVER['ORIG_PATH_INFO'];

print_r($_SERVER);

die($website);

$base_id=trim(base64_decode(urldecode($_GET['i'])));

$url=$base_id.'.jpg';

//die($url);

$img=file_get_contents($url);

header("Content-type:image/jpeg");
print $img;
exit;*/
?>