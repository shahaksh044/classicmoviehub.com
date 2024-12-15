<?php
require_once("../../../db.php");   //is this repetitive?????

if(!isset($_GET['i']{0}) or !isset($_GET['loc']{0}))
exit;

$connection = connectMysql(SERVER, USER, PWD, DB);

$loc=$_GET['loc'];

$url_location=explode('/', $loc);

//print_r($url_location);exit;

$blog_domain_name=$url_location[2];
//query blog_domain_name against our database

$base_id=trim(base64_decode(urldecode($_GET['i'])));


$sql='select id from agatti_blogs where url like "%'.$blog_domain_name.'%" and active=1';

$response=mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($response) <= 0)
{
echo '
//alert("ok");
var cmh_badge_link=document.getElementById("cmh_badge_link");
var cmh_badge_img=document.getElementById("cmh_badge_img");

if(cmh_badge_link.href == "http://www.classicmoviehub.com/blog_hub.php?source=badge_cmh")
cmh_badge_img.src="http://badges.classicmoviehub.com/0.jpg";
';
//die("URL Not Allowed as Member");
}
else

echo 'var cmh_badge_real_url="'.$base_id.'.jpg";

var cmh_badge_link=document.getElementById("cmh_badge_link");
var cmh_badge_img=document.getElementById("cmh_badge_img");

if(cmh_badge_link.href == "http://www.classicmoviehub.com/blog_hub.php?source=badge_cmh")
cmh_badge_img.src="http://badges.classicmoviehub.com/"+cmh_badge_real_url;
';

?>