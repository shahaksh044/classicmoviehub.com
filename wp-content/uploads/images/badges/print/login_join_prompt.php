<?php

$url_to_go_tos=explode('/', $url_to_go_to);


//print_r($url_to_go_tos);exit;

$url_to_go_to=$url_to_go_tos[count($url_to_go_tos)-1];

$url_to_go_to=trim($url_to_go_to, '/');

if(strpos($url_to_go_to, "?") !== FALSE)
{
$url_to_go_tos=explode("?", $url_to_go_to);
$url_to_go_to=trim($url_to_go_tos[0]);
}

switch($url_to_go_to)
{
case "films.php":
{
$prompt=' to rate movies';
}
break;


case "easy_lists.php":
{
$prompt=' to create lists';
}
break;


case "index.php":
{
$prompt=' to rate movies';
}
break;


case "blog_hub_submit.php":
{
$prompt=' to submit your blog to BlogHub &trade; LOL  <p>best of the best in blog posts wehre you can rate</p><p>hits go to you yadda yadda yadda ..adasdadadasdadadsfadadasdfadfadfadsadfadfadadfadadfasdfafdf</p>';
}
break;


case "blog_hub.php":
{
$prompt=' to rate blog posts';
}
break;

case "bio.php":
{
$prompt=' to rate movies';
}
break;

case "blog_hubber.php":
{
$prompt=' to rate this blog post';
}
break;

//

}

?>