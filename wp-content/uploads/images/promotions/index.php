<?php
//APC CAHING
//die("oops");
//die("lol");
//die("debug");

if($_GET['cache'] != "0")
{
$script_uri=trim($_SERVER['REQUEST_URI'], '/');

if(!empty($script_uri))
{
header("HTTP/1.1 301 Moved Permanently");
header("Location:http://www.classicmoviehub.com/");exit;
}
}

//die($script_uri);exit;

session_start();
//die("debug");

require_once("db.php");
//die("debug");

$connection = connectMysql(SERVER, USER, PWD, DB);

include_once("config.php");
//die("debug");

require_once("states_array.php");
require_once("functions.php");

include_once("sampleSettings.php");
require_once 'AmazonECS.class.php';

//die("debug");
 
$full_date=date("Y_m_d");


	//echo 'alert("ok")';
		
		$increment=0;
		
		
		$astro=apc_fetch("homepage_astro_".$full_date);
		$birthday2=apc_fetch("new_homepage_birthday2_".$full_date);
		
		$first_birthday=apc_fetch("first_birthday_".$full_date);
		
		//the list of the ids associated with the 4 people showing on the top of the page
		$birthday_list_ids=apc_fetch("new_homepage_birthlist_ids_".$full_date);
		
		if(empty($astro) or empty($birthday_list_ids) or empty($birthday2) or empty($first_birthday))
		{
		
		$sql = 'SELECT legend, id, name, u_name, birth_city, birth_state, astrological, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday, default_job FROM agatti_people WHERE DAYOFMONTH(birthday) = DAYOFMONTH(NOW()) AND MONTH(birthday) = MONTH(NOW()) and active=1 order by legend desc, has_thumbnail desc, agatti_people.default_job asc  limit 0, 4 ';
		
		
	//$sql = 'SELECT legend, id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday, default_job FROM agatti_people WHERE DAYOFMONTH(birthday) = DAYOFMONTH("2013-05-05") AND MONTH(birthday) = MONTH("2013-05-05") and active=1 order by legend desc, has_thumbnail desc  limit 0, 4 ';
	
	//$sql = 'SELECT legend, id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday, default_job FROM agatti_people WHERE DAYOFMONTH(birthday) = DAYOFMONTH("2013-11-13") AND MONTH(birthday) = MONTH("2013-11-13") and active=1 order by legend desc, has_thumbnail desc  limit 0, 4 ';
		
		
		//die($sql);
		

		
		$query = mysql_query($sql) or die(mysql_error()."<br/>pick birthday<br/>".$sql);
		$folder='thumbs';
		
		
		
		$_index=0;
		
		
		
		/*$birthday2 = '</div><div class="clear">
		<div class="thumbnails_div" style="margin-left:10px">
		<h3 id="also_born">More Classic Movie Star Birthdays Today: </h3>';
		$folder='thumbs';*/
		
		
		$birthday2 = '<div class="clear"></div>
		<div class="thumbnails_div_home">
		<h2 id="also_born" class="to_left look_like_h3">Today\'s Classic Movie Birthdays: </h2> <h3 class="to_right no_padding" style="margin-right:10px"><a href="/database/births/month/'.strtolower(date("F")).'-'.date("j").'" >See more birthdays</a></h3><div class="clear"></div>';
		
		$folder='thumbs';
		
		
		//$birthday_list='';
		
		$number_birthdays=mysql_num_rows($query);
		
		//make the birthday either 5 or 10
		
		//$mod=$number_birthdays%5;
		
		if($number_birthdays >= 10)
		$number_birthdays=10;
		else
		$number_birthdays=5;
		
		$first_birthday='';
		
		while( $birthday = mysql_fetch_array($query))
		{
		
		//die('oops='.$birthday['name']);
		
		
		$astro=$birthday['astrological'];
		
		
		//only set the first_birthday only if the person is also a legend
		if($_index==0 and $birthday['legend']==1)
		{
		$first_birthday=$birthday['name'];
		}
		
		if($_index > $number_birthdays)
		continue;
		
		
		
		if($number_birthdays == $_index+1)
		{
		$birthday_list=trim($birthday_list, ', ');
		
		$birthday_list .= ' and <a href="bio/'.$birthday['u_name'].'">'.$birthday['name'].'</a>';
		}
		
		else
		
		$birthday_list .= '<a href="bio/'.$birthday['u_name'].'">'.$birthday['name'].'</a>, ';
		
			$birthname = $birthday['birthname'];
						
						$_birthday = $birthday['_birthday'];
						
						$death_city = $birthday['death_city'];
						$death_state = $birthday['death_state'];
						$deathplace = htmlentities($death_city.', '.$death_state);
						
						if(isset($birthday['_died']{0}))
						$_died = $birthday['_died'].'<br/>'.$deathplace;
						else
						$_died = 'N/A';
						
						
						$_year='';
						
						if(isset($birthday['year']{0}))
						{
						$_year='<br/>('.$birthday['year'].')';
						}
						
	
						
						
						$birth_city = $birthday['birth_city'];
						$birth_state = $birthday['birth_state'];
						$birthplace = htmlentities($birth_city.', '.$birth_state);

							$full_name= htmlentities($birthday['name']);
		
		
		
		
		//THESE ARE THE STATS BOXES FOR Also Born on This Day
		$stats = '<div class="break">&nbsp;</div>Birthname: <br/>'.$birthname.'<div class="break">&nbsp;</div>Born: '.$_birthday.'<br/>'.$birthplace. '<div class="break">&nbsp;</div>Passed: '.$_died;
		
		
		
		
						$birthday2.= '<a href="bio/'.$birthday['u_name'].'" class="thumb thumb_small black_text" commonality="'.$birthday['id'].'">  
			
						<img src="'.getThumbnail($birthday['id'], $folder).'" border="0" title="'.$full_name.'" width="115" height="170" alt="'.$full_name.'" class="bio_picture '.$birthday['id'].'" align="left" id="th_'.$increment.'"/>
						
						<div class="stats '.$birthday['id'].'" id="stats_'.$increment.'"  style="display:none">'.$stats.'</div>
						<h2 class="black_text"><span class="underlined">'._shorten_name2($full_name, 19).'</span><br/><span class="not_underlined">'.$_birthday.$_year.$wof.$ceremony_info.'</span></h2></a>'; 
						
						$increment++;
		//}
		$_index++;
		
		$birthday_list_ids[]=$birthday['id'];
		
		}
		
		//echo $birthday_list.'<br/>';
		
		$birthday2 .= '</div><div class="clear"></div><!-- closing thumbnails_div_home-->';
		
//	die($birthday2);
	
	clean_old_apc_object("homepage_birthday1_");
	clean_old_apc_object("homepage_birthday2_");
	clean_old_apc_object("homepage_birthlist_");
	
	//the first_birthday did not get set in the loop meaning that there is no legend born today
	if(empty($first_birthday))
	{
	
	//echo "No legend birthday today<br/>";
	
	$custom_legend_array=array(1, 2, 3, 4, 5, 6);
	
	$sql_custom_legend='select name from agatti_people where id in ('.implode(",", $custom_legend_array).') order by rand() limit 0,1';
	
	$response_custome_legend=mysql_query($sql_custom_legend) or die(mysql_error().'<br/>'.$sql_custom_legend);
	
	$array_legend=mysql_fetch_row($response_custome_legend);
	
	$first_birthday=$array_legend[0];
	
	//die($first_birthday);
	}
	
		apc_store("homepage_astro_".$full_date, $astro, 60*60*24);
		
		apc_store("new_homepage_birthday2_".$full_date, $birthday2, 60*60*24);
		
		apc_store("first_birthday_".$full_date, $first_birthday, 60*60*24);
		apc_store("new_homepage_birthlist_ids_".$full_date, $birthday_list_ids, 60*60*24);
		//"homepage_birthlist_".$full_date
		
	}
	

$before_legend_tribute='';
$before_deal_of_the_day='';
$before_fan_favorite='';
$before_blog_articles='';
$before_amazon_ad='';
$after_amazon_ad='';
$after_events_calendar='';


$deal_center_under_birthdays='';
$deal_right_side='';



$sql_floatable='select * from agatti_floatable_div where active=1';

$response_floatable=mysql_query($sql_floatable);

while($array_floatable=mysql_fetch_assoc($response_floatable))
{

//possible values for content_type in floatables are: blog_posts, rich_text_editor
if($array_floatable['content_type']=='blog_posts')
{

//echo $array_floatable['content'].'<hr/>';exit;

	$post_urls=explode(',', $array_floatable['content']);
	
	//print_r($post_urls);exit;
	
	${$array_floatable['position']} = apc_fetch("homepage_".$array_floatable['position']);
	
	if(empty(${$array_floatable['position']}))
	{
	
	${$array_floatable['position']}=get_homepage_blog_articles(NULL, $post_urls);
	
	apc_store("homepage_".$array_floatable['position'], ${$array_floatable['position']}, 60*60*24*365);
	
	}
	
	
} else

if($array_floatable['content_type']=='rich_text_editor')
{	
	${$array_floatable['position']}=stripslashes($array_floatable['content']).'<div class="clear"></div><hr class="no_margin_padding"/>';
	
}

else

if($array_floatable['content_type']=='deal_of_day')
{	

//hard code first birthday for now
//Johnny Weissmuller

//die('oops<br/>'.$first_birthday);

${$array_floatable['position']} = apc_fetch($array_floatable['position']);

	if(empty(${$array_floatable['position']}))
	{
	${$array_floatable['position']}=get_deal_of_day($first_birthday, $array_floatable['position']).'<div class="clear"></div>';
	
	apc_store($array_floatable['position'], ${$array_floatable['position']}, 60*60*6);
	}
}


//$buffer_var='';
}

//echo $before_legend_tribute.'<hr/>'.$before_deal_of_the_day;exit;

//die("debug");

//$_SESSION['trial'] = 'patrick';

function get_nat_registry()
{
$array_nat_reg_film_classes=array("serial_silent"=>"Silent Serial", "short"=>"Short Film", "short_silent"=>"Short Silent Film", "silent"=>"Silent Film", "sound"=>"Sound Film", "sound_short"=>"Short Sound Film");



$sql_nat_film='select id, name, u_name, year,nat_film_reg_class, nat_film_reg, directors, co_director0  from agatti_films where nat_film_reg <> "" and active=1 order by rand() limit 0, 1';

$response_nat_film=mysql_query($sql_nat_film) or die(mysql_error());

$response_array_nat_film=mysql_fetch_array($response_nat_film);

$film_name=$response_array_nat_film['name'];
$film_u_name=$response_array_nat_film['u_name'];
$film_id=$response_array_nat_film['id'];
$film_year=$response_array_nat_film['year'];
$film_nat_reg_year=$response_array_nat_film['nat_film_reg'];
$film_nat_reg_class=$response_array_nat_film['nat_film_reg_class'];
$how_many_years_ago=$film_nat_reg_year-$film_year;

$director_id=$response_array_nat_film['co_director0'];
$directors=explode("*", $response_array_nat_film['directors']);
$director=$directors[0];

$over_how_many_years_ago=$how_many_years_ago-($how_many_years_ago%5);

//10/3=3 and remaining=1
//the main cast

$sql_cast_nat='select person_id, person_name from agatti_cast where film_id='.$film_id.' order by id limit 0,1';

$req_cast_nat=mysql_query($sql_cast_nat) or die(mysql_error());

$array_cast_nat=mysql_fetch_array($req_cast_nat);
$person_name=$array_cast_nat['person_name'];
$person_id=$array_cast_nat['person_id'];



		
		$nat_auto_variants=array(
		'
		
		<h3>National Film Registry</h3>
		<img style="width:125px;height:185px;float:left;margin-right:10px;margin-left:5px" src="http://www.classicmoviehub.com/images/films/'.$film_id.'.jpg">	<a href="http://www.classicmoviehub.com/film/'.$film_u_name.'">'.$film_name.'</a>, starring the legendary '.$person_name.', was released in '.$film_year.'. In '.$film_nat_reg_year.', '.$how_many_years_ago.' years later, it was inducted into The National Film Registry. Thank you National Film Registry!<br/>
		<a href="http://www.classicmoviehub.com/facts.php?topic=nat_film_reg&topic_id=99&filter=all&order=year">see more National Film Registry inductees...</a>',
		
		
		'
		<h3>National Film Registry</h3>
		<img style="width:125px;height:185px;float:left;margin-right:10px;margin-left:5px" src="http://www.classicmoviehub.com/images/films/'.$film_id.'.jpg">
		In '.$film_nat_reg_year.', <a href="http://www.classicmoviehub.com/film/'.$film_u_name.'">'.$film_name.'</a> starring the legendary '.$person_name.', was inducted into The National Film Registry, '.$how_many_years_ago.' years after its initial release ('.$film_year.').<br/>
		<a href="http://www.classicmoviehub.com/facts.php?topic=nat_film_reg&topic_id=99&filter=all&order=year">see more National Film Registry inductees...</a>',
		
		'
		<h3>National Film Registry</h3>
		<img style="width:125px;height:185px;float:left;margin-right:10px;margin-left:5px" src="http://www.classicmoviehub.com/images/films/'.$film_id.'.jpg"><a href="http://www.classicmoviehub.com/film/'.$film_u_name.'">'.$film_name.'</a>, directed by the legendary '.$director.', was released in '.$film_year.'. In '.$film_nat_reg_year.', '.$how_many_years_ago.' years later, it was inducted into The National Film Registry. Thank you National Film Registry!<br/><a href="http://www.classicmoviehub.com/facts.php?topic=nat_film_reg&topic_id=99&filter=all&order=year">see more National Film Registry inductees</a>');
		
		
			/*
		
		$nat_auto_variants=array(
		'
		<h3>'.$film_name.'</h3>
		<img style="width:125px;height:185px;float:left;margin-right:10px;margin-left:5px" src="http://www.classicmoviehub.com/images/films/'.$film_id.'.jpg">	<a href="http://www.classicmoviehub.com/film/'.$film_u_name.'">'.$film_name.'</a>, starring the legendary '.$person_name.', was released in '.$film_year.'. In '.$film_nat_reg_year.', '.$how_many_years_ago.' years later, it was inducted into The National Film Registry. Thank you National Film Registry! &nbsp;&nbsp;<a href="http://www.classicmoviehub.com/facts.php?topic=nat_film_reg&topic_id=99&filter=all&order=year">see more...</a>',
		
		
		'<h3>'.$film_name.'</h3>
		<img style="width:125px;height:185px;float:left;margin-right:10px;margin-left:5px" src="http://www.classicmoviehub.com/images/films/'.$film_id.'.jpg">
		In '.$film_nat_reg_year.', <a href="http://www.classicmoviehub.com/film/'.$film_u_name.'">'.$film_name.'</a> starring the legendary '.$person_name.', was inducted into The National Film Registry, '.$how_many_years_ago.' years after its initial release ('.$film_year.'). &nbsp;&nbsp;<a href="http://www.classicmoviehub.com/facts.php?topic=nat_film_reg&topic_id=99&filter=all&order=year">see more...</a>',
		
		'<h3>'.$film_name.'</h3><img style="width:125px;height:185px;float:left;margin-right:10px;margin-left:5px" src="http://www.classicmoviehub.com/images/films/'.$film_id.'.jpg"><a href="http://www.classicmoviehub.com/film/'.$film_u_name.'">'.$film_name.'</a>, directed by the legendary '.$director.', was released in '.$film_year.'. In '.$film_nat_reg_year.', '.$how_many_years_ago.' years later, it was inducted into The National Film Registry. Thank you National Film Registry! &nbsp;&nbsp;<a href="http://www.classicmoviehub.com/facts.php?topic=nat_film_reg&topic_id=99&filter=all&order=year">see more...</a>');
		
		
		
		end old code for testing here  */
		
		
		$nat_auto_random_index=rand(0, count($nat_auto_variants)-1);
		
		
		return $nat_auto_variants[$nat_auto_random_index];
}
function get_mini_tribute()
{

//birthday
$sql='SELECT agatti_blog_posts_features.post_id, agatti_blog_posts_features.title, agatti_blog_posts_features.object_id, agatti_blog_posts_features.prefered_content, agatti_blog_posts.content,agatti_blog_posts.img_url, agatti_blog_posts.external_url, ABS(DATEDIFF(concat(YEAR(NOW()),"-", MONTH(agatti_people.birthday), "-", DAY(agatti_people.birthday)), DATE(NOW()))) as days_behind FROM agatti_blog_posts_features, agatti_people, agatti_blog_posts WHERE object_type="p"  and agatti_blog_posts_features.object_id=agatti_people.id and  agatti_blog_posts_features.title like "%mini tribute%"  and agatti_blog_posts.blog_id=39 and agatti_blog_posts.id=agatti_blog_posts_features.post_id having days_behind is not NULL  order by days_behind asc limit 0, 1';

$response=mysql_query($sql) or die(mysql_error());

$response_array=mysql_fetch_array($response);

//$full_title=trim(str_ireplace('classic movie', '', $response_array['title']));

$title_parts=explode(":", $response_array['title']);

$full_title="Mini Tribute ".trim($title_parts[1]);

if(!empty($response_array['prefered_content']))
$article_content=trim(str_replace("&nbsp;", " ",  mb_convert_encoding($response_array['prefered_content'], "UTF-8")));

else

$article_content=trim(str_replace("&nbsp;", " ", mb_convert_encoding($response_array['content'], "UTF-8")));

//http://blog-assets.classicmoviehub.com/'.md5($articles['img_url']).'.jpg

/*
with bio pictre_id
return '<h3>'._shorten_name2($full_title, 31).'</h3>
<img src="/images/thumbs/'.$response_array['object_id'].'.jpg" class="h3_image"/>'._shorten_name3($article_content, 600).'...&nbsp;&nbsp;<a href="'.$response_array['external_url'].'">read more...</a>';
*/

/*
return '<a href="'.$response_array['external_url'].'"><h3>'._shorten_name2($full_title, 31).'</h3>
<div class="to_left" style="margin-right:10px">
<img src="http://blog-assets.classicmoviehub.com/'.md5($response_array['img_url']).'.jpg" class="img_bordered_blog_post" /></div><div class="to_left blog_post_content">'._shorten_name3($article_content, 300).'...&nbsp;&nbsp;<span class="fakelink">read more...</span></div></a>';*/

return '<a href="'.$response_array['external_url'].'" class="not_underlined"><h3>'._shorten_name2($full_title, 50).'</h3></a>
<div class="to_left" style="width:150px;margin-right:10px">
<img src="http://blog-assets.classicmoviehub.com/'.md5($response_array['img_url']).'.jpg" class="img_bordered_blog_post" /></div><div class="to_left blog_post_content" >'._shorten_name3($article_content, 300).'...&nbsp;&nbsp;<a href="'.$response_array['external_url'].'"><span class="fakelink">read more...</span></div></a>';

}


function get_legend_tribute()
{

//birthday
$sql='SELECT agatti_blog_posts_features.post_id, agatti_blog_posts_features.title, agatti_blog_posts_features.object_id, agatti_blog_posts_features.prefered_content, agatti_blog_posts.content,agatti_blog_posts.img_url, agatti_blog_posts.external_url, ABS(DATEDIFF(concat(YEAR(NOW()),"-", MONTH(agatti_people.birthday), "-", DAY(agatti_people.birthday)), DATE(NOW()))) as days_behind FROM agatti_blog_posts_features, agatti_people, agatti_blog_posts WHERE object_type="p"  and agatti_blog_posts_features.object_id=agatti_people.id and ( agatti_blog_posts.title like "%Legends Tribute%" or agatti_blog_posts.title like "%Legend Tribute%")  and agatti_blog_posts.blog_id=39 and agatti_blog_posts.id=agatti_blog_posts_features.post_id and agatti_people.active=1 having days_behind is not NULL order by days_behind asc limit 0, 1';

$response=mysql_query($sql) or die(mysql_error());

$response_array=mysql_fetch_array($response);

/*$full_title=trim(str_ireplace(array('classic movie', 'legends'), array('', 'legend'), $response_array['title']));*/

$title_parts=explode(":", $response_array['title']);

$full_title='Legend Tribute: '.trim($title_parts[1]);

/*
if(!empty($response_array['prefered_content']))
$article_content=trim(str_replace('&nbsp;', ' ',  mb_convert_encoding($response_array['prefered_content'], "UTF-8")));

else
*/

$article_content=trim(str_replace('&nbsp;', ' ', mb_convert_encoding($response_array['content'], "UTF-8")));

/*
with bio picture_id
return '<h3>'._shorten_name2($full_title, 31).'</h3>
<img src="/images/thumbs/'.$response_array['object_id'].'.jpg" class="h3_image"/>'._shorten_name3($article_content, 600).'...&nbsp;&nbsp;<a href="'.$response_array['external_url'].'">read more...</a>';
*/

return '<a href="'.$response_array['external_url'].'" class="not_underlined"><h3>'._shorten_name2($full_title, 50).'</h3></a>
<div class="to_left" style="width:150px;margin-right:10px">
<img src="http://blog-assets.classicmoviehub.com/'.md5($response_array['img_url']).'.jpg" class="img_bordered_blog_post" /></div><div class="to_left blog_post_content" >'._shorten_name3($article_content, 300).'...&nbsp;&nbsp;<a href="'.$response_array['external_url'].'"><span class="fakelink">read more...</span></div></a>';

}

function get_random_wof()
{
$sql='SELECT  cast(group_concat(person_id) as CHAR) as people_ids, group_concat(agatti_people.name separator "|") as people_names, group_concat(concat(agatti_people.default_job, "*", gender) separator "*") as people_jobs, full_address, agatti_wof.star_street,count(agatti_wof.id) as cnt FROM agatti_wof, agatti_people WHERE agatti_people.id=agatti_wof.person_id and agatti_people.active=1 group by full_address having cnt >= 6 order by rand() limit 0, 1';
//return $sql;
$response=mysql_query($sql) or die(mysql_error());

$response_array=mysql_fetch_array($response);

$people_ids=explode(',', $response_array['people_ids']);

$people_names=explode('|', $response_array['people_names']);

$people_jobs=explode('*', $response_array['people_jobs']);

$return='';

$person_index=0;
/*
<img style="float:left;margin-right:10px;margin-left:5px" src="http://www.classicmoviehub.com/images/thumbs/1.jpg" width:125px;height:185px>Classic Movie Actress, Jean Arthur has a Star on the Hollywood Walk of Fame at 6333 Hollywood Blvd. So do Ed Wynn, Ann Rutherford and Richard Carlson.&nbsp;&nbsp;see more stars -->
*/

$only_show_n_people=4;


foreach($people_ids as $person)
{

if($person_index <= $only_show_n_people)
{
if($person_index==0)
{
$default_job=getDefaultJobSimple($people_jobs[0], $people_jobs[1]);
$return .= '<img src="http://www.classicmoviehub.com/images/thumbs/'.$person.'.jpg" style="float:left;margin-right:10px;margin-left:5px" width="125" height="185" /> <div style="padding:0 5px">'.ucfirst($default_job).',  '.mb_convert_encoding($people_names[$person_index], "UTF-8").', has a Star on the Hollywood Walk of Fame at '.$response_array['full_address'].'&nbsp;&nbsp;So do ';
}

else

$return .= mb_convert_encoding($people_names[$person_index], "UTF-8").', ';

$person_index++;
}
}

$return=trim($return, ', ');

//return $return;

return $return.'... &nbsp;<a href="http://www.classicmoviehub.com/wof.php?order=address&filter='.str_replace(array(" ", "st.", "."), array("_", "street", ""), strtolower($response_array['star_street'])).'">see more</a></div>';

}


function get_random_graumans()
{
$sql='SELECT cast(group_concat(agatti_graumans.person_id) as char) as people_ids,group_concat(agatti_people.name separator "|") as people_names, YEAR(ceremony_date) as _year, count(agatti_graumans.id) as cnt  FROM agatti_graumans, agatti_people WHERE agatti_people.id=agatti_graumans.person_id  group by _year having cnt > 2 order by rand() limit 0,1';
//return $sql;
$response=mysql_query($sql) or die(mysql_error());

$response_array=mysql_fetch_array($response);

$people_ids=explode(',', $response_array['people_ids']);

$people_names=explode('|', $response_array['people_names']);

$people_jobs=explode('*', $response_array['people_jobs']);

$return='';

$person_index=0;

$only_show_n_people=4;


foreach($people_ids as $person)
{

if($person_index <= $only_show_n_people)
{
if($person_index==0)
{
$default_job=getDefaultJobSimple($people_jobs[0], $people_jobs[1]);
$return .= '<img src="http://www.classicmoviehub.com/images/thumbs/'.$person.'.jpg" style="float:left;margin-right:10px;margin-left:5px" width="125" height="185" /> <div style="padding:0 5px">'.mb_convert_encoding($people_names[$person_index], "UTF-8").'\'s, Footprints & Handprints were "set in stone" in Grauman\'s famous forecourt in '.$response_array['_year'].'. So were ';
}

else

$return .= mb_convert_encoding($people_names[$person_index], "UTF-8").', ';

$person_index++;
}
}

$return=trim($return, ', ');


return $return.'... &nbsp;<a href="http://www.classicmoviehub.com/graumans-chinese-theater/all/ceremony-date/page/1/">see more</a></div>';

}

function getRandromTravelSite()
{

$sql='select agatti_travel.id, agatti_travel.name, agatti_travel.type, agatti_travel.city, agatti_travel.state, agatti_travel.description  from agatti_travel where agatti_travel.active=1 and agatti_travel.type not in ("site", "other") order by rand() limit 0, 1';

$response=mysql_query($sql) or die(mysql_error());

$array=mysql_fetch_array($response);

$location='';

if(isset($array['city']{0}))
$location = $array['city'];

if(isset($array['state']{0}))
{

if(!empty($location))
$location .= ', ';

$location .= $array['state'];
}

$article='a';

$array_vowels=array('a', 'u', 'e', 'i', 'o');

foreach($array_vowels as $vowel)
{
	if(strpos(strtolower($array['name']), $vowel) ===0)
	{
	$article='an';
	break;
	}
}

//LOL





return '<img style="float:left;margin-right:10px;margin-left:5px" src="http://www.classicmoviehub.com/images/travel/'.$array['id'].'.jpg">
		
		Did you know that there is '.$article.' <a href="http://www.classicmoviehub.com/travel.php?name='.urlencode($array['name']).'&travel_id='.$array['id'].'&filter='.$array['type'].'">'.$array['name'].'</a> in '.$location.'?
		
		<br/><br/>'.mb_convert_encoding(_shorten_name2($array['description'], 100), "UTF-8").' .. &nbsp;<a href="http://www.classicmoviehub.com/travel.php?name='.urlencode($array['name']).'&travel_id='.$array['id'].'&filter='.$array['type'].'">read more</a>';


}
?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#">

  <head>
    <title>Classic Movie Hub (CMH) -Best Source for Everything Classic Movies</title>
    <meta name="google-site-verification" content="buDDh4x8vxbhD14lH505xFBlzvHkW7KToFG8BKvmfRg" />
    
  <meta name="msvalidate.01" content="75D595BCA122F44D5ABC135E4FE919BB" />
    
    
    <meta name="title" content="CMH - Classic Movie Hub - Best Source for Everything Classic Movies"/>
    
    <meta name="keywords" content="CMH, classic movie hub, classic movies, films, cinema, movie hub, movie database, actors, actresses, directors, producers, hollywood, stars, old movies, filmographies, golden age of hollywood"/>
    
     <meta name="description" content="Classic Movie Hub: The Best Source for Everything Classic Movies. Fan favorite films, movie stars, events, trivia, fun facts, quotes, travel sites and more!"/>
     
     
     <LINK REL="SHORTCUT ICON" HREF="/favicon.png">

<link href="/apple-touch-icon.png" rel="apple-touch-icon" />
<link href="/apple-touch-icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
<link href="/apple-touch-icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
<link href="/apple-touch-icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />

     <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27358402-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   // ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
   
   ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
   
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

     <style type="text/css">
     .advertisement img:nth-child(1){display:block;width:120px;margin:0 auto}
     .right_side_home_div{float:left;margin-right:0;margin-left:5px;border:2px solid #000;padding:5px;height:146px;max-height:146px;width:240px;background:white}
     </style>
    
    <?php 
    
    //include("title.php"); 
    
    ?>
    
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    
    <?php echo $meta; ?>
    
    <link href="/styles/main.css" type=text/css rel=stylesheet>
	
		<script type="text/javascript" src="/scripts/prototype.js"></script>
			<script type="text/javascript" src="/scripts/ibox/ibox.js"></script>

		<script type="text/javascript" src="/scripts/scriptaculous.js"></script>
		
		<script type="text/javascript" src="/scripts/effects.js"></script>
		
		<script type="text/javascript" src="/scripts/carousel.js"></script>

<style type="text/css">

.right_side_object{background:#fff}

.right_side_object .side_link{width:175px;max-width:175px}

.tools_urls{
display:block;
background:#ca0808;
padding:5px;
padding-left: 10px;
color:#fff;
font-weight:bold;
border:1px solid #000;
text-decoration:none
}

.tools_urls:hover {
background:#ccc;
color:#000;
}

#container, #main, #main_area_homepage{background:#eee}
.columns{float:left;/*border:1px solid #000;*/min-height:600px;padding:5px}
	
	#first_column{width:210px;background:#eee}
	#second_column{width:507px;background:#fff;padding-left:10px}
	#third_column{width:255px;max-width:255px;background:#eee}


._text{float:left;width:400px;background:#fff;padding:5px;margin-left:5px}
._img{float:left;width:240px;min-height:165px;height:auto;background:#fff url(http://assets.classicmoviehub.com/thumbs/default.jpg) top center no-repeat;margin-right:10px}

/*neither of these work*/
div.feature{float:left;width:300px; min-height: 250px; background:#fff; padding:5px; margin-left:5px;}

h3, h2.look_like_h3{font-size:16px}

/*h2{font-size:20px}*/

.just_padded{padding:5px}

.solo_bold{display:block;margin:5px 0}

.thumb_small{width:120px !important;margin: 0 3px !important}

.stats{width:110px !important;margin:5px !important}

#main{padding:0 5px}

.see_all{display:none}

ol{margin: 5px 0;
padding: 0;
padding-left: 25px;
list-style-position: outside;margin-bottom:15px}

ol > li {padding:2px 0}

ol > li a {text-decoration:none}

h3, h2.look_like_h3, h1.look_like_h3{margin-left:0}
</style>
		<?php
	
	
	
	
		?>
  </head>
    
    
    <?php
    //die("debug");
    include("home_page_ad.php");
    ?>
		
	
		
		<div id="container">
	
			<?php include("_logo.php"); ?>
						
			<?php 
			//echo "lol ". $_SESSION['email']."<br/>";
			include("_header.php"); ?>
			<div class="clear"></div>
			
			<?php include ("_navbar_one.php"); ?>		
					
			<div id="main">
			
				
							
				<div id="main_area_homepage">

		<div class="clear"></div>
		
	
	
<div id="first_column" class="columns" style="padding:0"><div style="margin-right:5px;background:#fff;padding:5px" >


<div class="_feature_text">




<a href="http://www.classicmoviehub.com/blog/its-cary-grant-month-on-cmh-dvd-giveaway/"><h3 style="margin-left:15px">&nbsp;&nbsp;&nbsp;Enter to Win</a><br/>Cary Grant DVDs!</h3>
<img  src="images/promotions/cary_grant_dvd_giveaway_180.jpg" class="floatable_img" >

<p style="margin-left:5px">We're celebrating Cary Grant's Birthday this month with a Fabulous DVD Giveaway!   

</p>
			

<hr/>

</div>

<div class="_feature_text" style="margin-top:5px;display:block;color:#fff;background: #a80d0d;padding:5px;font-weight:bold;font-size:16px" >


ALL CMH Charts are Fan-Driven so Your Votes Count! <br/><a href='http://www.classicmoviehub.com/films/genre/comedy/alpha/a/page/1/'><span class="smaller_font underlined" style="color:white">Start Rating Films Now!</span></a>

</div>


<?php

$decade_chart=apc_fetch("homepage_decade_chart_".$full_date);
if(empty($decade_chart))
{
$decade_chart=getRandomChart("decade", 10);
apc_store("homepage_decade_chart_".$full_date, $decade_chart, 60*60*24);
}

echo $decade_chart;
?>

<br/>


<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Link_List_Index_Left_180x90 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:180px;height:90px"
     data-ad-client="ca-pub-4376916892217453"
     data-ad-slot="7957274179"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<br/><br/>


<?php


$genre_chart=apc_fetch("homepage_genre_chart_".$full_date);
if(empty($genre_chart))
{
$genre_chart=getRandomChart("genre", 10);
apc_store("homepage_genre_chart_".$full_date, $genre_chart, 60*60*24);
}

echo $genre_chart.'<div class="clear"></div><hr/>';

$topic_chart=apc_fetch("homepage_topic_chart_".$full_date);
if(empty($topic_chart))
{
$topic_chart=getRandomChart("topic", 10);
apc_store("homepage_topic_chart_".$full_date, $topic_chart, 60*60*24);
}

echo $topic_chart.'<hr/>';












echo plugin_talked_about_people(array("people_type"=>"legend"), 10, false).'

<hr/>

'.plugin_talked_about_people(array("people_type"=>"character"), 5, false);
?>




<br/><br/>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Link_List_2_Left_Nav_180x90 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:180px;height:90px"
     data-ad-client="ca-pub-4376916892217453"
     data-ad-slot="4585005371"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>





</div>



 </div> 
 
 
 
 
 
 
 
 </div>		
<div id="second_column" class="columns" style="border-left:0">
<?php

//die('lol='.$first_birthday);

//echo $deal_center_under_birthdays;

/*
$deal_of_the_day=apc_fetch("deal_of_the_day_".$full_date);

//if it hasn't been cached yet
if(empty($deal_of_the_day))
{
//call the function that fetches it from amazon
//first birthday may contain someone that is not even born today since the variable was initially created for the get_deal_of_day function

$deal_of_the_day=get_deal_of_day($first_birthday);

//store for 24 hours
apc_store("deal_of_the_day_".$full_date, $deal_of_the_day, 60*60*24);
}*/


		echo $birthday2.'<div class="clear"></div>';
?>
		<div id="before_deal_of_the_day">
		<?php echo $before_deal_of_the_day; ?>
		</div>

		
		<div class="clear5"></div>
		
		<?php
		echo $deal_center_under_birthdays;
		?>
	
<hr/>

<?php

$press_release_index = apc_fetch("homepage_press_release_index");

if(empty($press_release_index))
{
$press_release_index = show_press_releases(array("news"/*, "dvd", "contests"*/), 4);

apc_store("homepage_press_release_index", $press_release_index, 60*60*4);
}

echo $press_release_index;
?>

<div class="clear_rule"></div>



<!--warner bros affiliate ad -->
<div style="width:485px;height:70px;padding-left:20px;padding-top:10px">	
<script type="text/javascript" language="javascript" src="http://www.kqzyfj.com/placeholder-13415250?target=_top&mouseover=N"></script>
</div>

<!--
<br/>
<hr>
-->

<div id="before_legend_tribute">
<?php echo $before_legend_tribute; ?>
</div>

<?php
$legend_tribute=apc_fetch("new_homepage_legend_tribute_".$full_date);
	
if(empty($legend_tribute))
{
$legend_tribute=get_legend_tribute();
clean_old_apc_object("new_homepage_legend_tribute_");
apc_store("new_homepage_legend_tribute_".$full_date, $legend_tribute, 60*60*24);
}
	
echo $legend_tribute;
?>

<div class="clear_rule"></div>

<!--<hr/>-->

<?php
$mini_tribute=apc_fetch("new_homepage_mini_tribute_".$full_date);
		
if(empty($mini_tribute))
{
$mini_tribute=get_mini_tribute();
clean_old_apc_object("new_homepage_mini_tribute_");
apc_store("new_homepage_mini_tribute_".$full_date, $mini_tribute, 60*60*24);
}
		
echo $mini_tribute;
?>

<div class="clear_rule"></div>

<!--<hr/>-->


<br/>
	
	<div id="before_blog_articles"> 
		<?php
		
		 echo $before_blog_articles;
		
		 ?>
		</div>	
		
<div style="width:485px;height:70px;padding-left:20px;padding-top:10px">		
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- homepage_468_banner -->
<ins class="adsbygoogle"
     style="display:inline-block;width:468px;height:60px"
     data-ad-client="ca-pub-4376916892217453"
     data-ad-slot="2832966976"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
	
	</div>
			
	<!--	<hr/>  
		-->
		
		
	<br/>

		<?php
		
		$homepage_blog_articles=apc_fetch("new_homepage_blog_articles_".$full_date);
	
if(empty($homepage_blog_articles))
{

$homepage_blog_articles=get_homepage_blog_articles(5);
clean_old_apc_object("new_homepage_blog_articles_");
apc_store("new_homepage_blog_articles_".$full_date, $homepage_blog_articles, 60*60*4);
}
	
echo $homepage_blog_articles;

	?>
	
	<div id="before_fan_favorite"> 
		<?php echo $before_fan_favorite; ?>
		</div>
		
	<?php
		
		
		$chart_types=array("topic", "genre"/*, "topic", "topic"*/);
		
		$chart_tables=array("topic"=>"agatti_topics", "genre"=>"agatti_genre");
		
		$array_charts=array("topic"=>array(115, 228, 154, 173, 215, 9, 54, 125, 162, 127, 4, 15, 1, 18),/*the topics we want charts for;  advertising, angels, animals, baseball, beach, detectives, coming of age, college, courtroom, gambling, ghosts, mistaken identity, pirate, secretaries  */
							"genre"=>array());	/*genres */
		
		$chart_type=$chart_types[rand(0, sizeof($chart_types)-1)];
		
		$possible_charts=$array_charts[$chart_type];
		
		
		$sql_chart='select id, name, u_name from '.$chart_tables[$chart_type].' where active=1';
		
		if(sizeof($possible_charts) >0)
		$sql_chart .= ' and id in ('.implode(',', $possible_charts).')';
		
		$sql_chart .= ' order by rand() limit 0, 1';
		
		//echo $sql_chart."<br/>";
		
		$response_chart=mysql_query($sql_chart) or die(mysql_error()."<br/>".$sql_chart);
		$array_chart=mysql_fetch_assoc($response_chart);
		
		$object_name=$array_chart['name'];
		
		if(stripos($object_name, "film") === FALSE)//if the topic of genre already has the word film in it, dont add films to it
		{
		$object_name .= ' Films';
		}
		
	
	
	
	
	
	
	
	
	
	
		
		
		echo '<a href="/films/'.$chart_type.'/'.$array_chart['u_name'].'/alpha/all/page/1"><h3 class="to_left">Fan Favorite '.$object_name.'</h3></a>
		<div class="clear"></div>
		'.getChartWithImage($chart_type, $array_chart['id'], 4, '', false).'
	
		<div class="clear"></div>
		
		<h3 class="to_left no_padding" style="margin-right:10px"><a href="/films/'.$chart_type.'/'.$array_chart['u_name'].'/alpha/all/page/1">Rate '.$object_name.'</a></h3> <h3 class="to_right no_padding" style="margin-right:10px"><a href="/chart/'.$chart_type.'/'.$array_chart['u_name'].'">See Full Chart</a></h3>
		
		<div class="clear5"></div>
		';
		


		?>
		
</div>	

				<div id="third_column" class="columns" style="padding:0;border-left:0">	
				
				<?php
				if(!empty($deal_right_side))
				echo $deal_right_side.'<hr class="no_margin_padding" />';
				?>
				
				
				
				
				
				
				<!--this is where before amazon ad AND amazon ad AND after amazon ad WAS ALL CODE was BELOW THIS  NOW I left before amazon ad HERE and moved the amazon ad and after amazon ad to below space under the events calendar-->
				
				
			
			<div id="before_amazon_ad"> 
		<?php echo $before_amazon_ad; ?>
		</div>
			
			
			
			
	<!--this is where before amazon ad AND amazon ad AND after amazon ad WAS (all code was ABOVE THIS) but only moved ad and after ad to under the events calendar -->
	
					
		<?php
		///$events_calendar='lol<br/>'.show_events_short();
		
		$events_calendar=apc_fetch("homepage_events_calendar_".$full_date);
		
		if(empty($events_calendar))
		{
		$events_calendar=show_events_short();
		
		apc_store("homepage_events_calendar_".$full_date, $events_calendar, 60*60*24);
		}
		
		echo '<div class="_feature_text" style="width:240px">'.$events_calendar.'</div>';
		
		?>
		 
		<div id="after_events_calendar"> 
		<?php echo $after_events_calendar; ?>
		</div>
		
		<div class="clear_rule"></div>
	
	
	
	
	
	<!--THIS WAS where TCM Schedule WAS (directly below Events Calendar)  BUT now I INSERTED the RANDOM AD HERE (amazon ad and AFTER amazon ad) NOTE I left before amazon ad above where it was before-->
	
		
				
		
<div class="_feature_text">
		<?php
		$random_ad=apc_fetch("homepage_random_ad");
	
	if(empty($random_ad))
	{
	$random_ad=getRandom();	
	apc_store("homepage_random_ad", $random_ad, 60*60*4);
	}
	
	echo $random_ad;

		?>
</div>	
<div class="clear_rule"></div>

<div id="after_amazon_ad"> 
		<?php echo $after_amazon_ad; ?>
		</div>
	
	<div class="clear_rule"></div>
	
	
	
	<!--END of insertion of Random Ad (amazon ad before and after as well) above -->
	
		
		
		<?php
		
		$home_tcm_schedule=apc_fetch("homepage_tcm_schedule");
		
		if(empty($home_tcm_schedule))
		{
		
		$home_tcm_schedule=tcm_now(3);
		
		apc_store("homepage_tcm_schedule", $home_tcm_schedule, 60*60);
		}
		
		echo '<div class="_feature_text" style="width:240px"><h3 class="header">Now playing on TCM</h3>'.$home_tcm_schedule.'</div>';
		
		?>
		
		<div class="clear_rule"></div>
		


<div style="width:250px;height:250px;margin-left:5px">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- homepage_250_square -->
<ins class="adsbygoogle"
     style="display:inline-block;width:250px;height:250px"
     data-ad-client="ca-pub-4376916892217453"
     data-ad-slot="7171571772"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

</div>

<!-- astro plugin -->



<div>
<?php
echo plugin_astro(array('astro'=>$astro, 'object_id'=>$birthday_list_ids), 4, true);
?>
</div>


</div>

<div class="clear"></div>
						
		<br/>
		<div style="float:left;width:728px;min-height:90px;margin-left:50px; margin-top: 5px;margin-bottom:0">
		<iframe src="http://rcm.amazon.com/e/cm?t=classicmovi04-20&o=1&p=48&l=ur1&category=entcollect&banner=1KKZ7RZANAYA61H9PK02&f=ifr" width="728" height="90" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>

		</div>
		
		<div style="float:left;width:120px;min-height:90px;margin-left:25px; margin-top: 5px;margin-bottom:0">
		
		                                                <a href="http://click.linksynergy.com/fs-bin/click?id=A3bk5n2DNwI&subid=0"><IMG alt="PersonalWine.com" border="0"   width="120" height="90" src="http://ad.linksynergy.com/fs-bin/show?id=A3bk5n2DNwI&bids=209195.10001307+241091.3+141003.10000053+141003.10000065+141003.10000235+239662.867+284188.10000849+232125.80+227259.10000275+193025.10000445+193025.10000479+189673.10000076&gridnum=5&subid=0"></a>										
		</div>
		
		
		
		<!--three equal squares  -->
		
		
			<!--
		<div style="float:left;width:307px;min-height:250px;margin:10px; margin-top: 20px; margin-left:0;margin-bottom:5px;border:2px solid #000; background:#fff">
		
	
		<div class="just_padded">
		<h3>Hollywood Walk of Fame</h3>
		
		<?php
		
		$random_wof=apc_fetch("homepage_random_wof");
	
	if(empty($random_wof))
	{
	$random_wof=get_random_wof();
	apc_store("homepage_random_wof", $random_wof, 60*60*24);
	}
	
	echo $random_wof;

		?>
		
		</div>
		</div>-->
		
		
		
		
		
		
		
		
		
		
		
		<div style="float:left;width:307px;height:250px;margin-top: 15px; margin-right:0;margin-left:18px;margin-bottom:5px;border:2px solid #000; background:#fff;overflow:hidden">
		
	
	
		<div class="just_padded">
		<h3>Classic Movie Travel Sites</h3>
		
		<?php
		echo getRandromTravelSite();// "lol";
		?>
		</div>	
		</div>
	
		
		
		<div style="float:left;width:307px;min-height:250px;margin:10px; margin-top: 15px; margin-bottom:0; border:2px solid #000; background:#fff">
		
		<div class="just_padded">

<?php
$national_registry=apc_fetch("homepage_national_regsitry");

if(empty($national_registry))
{
$national_registry=get_nat_registry();
apc_store("homepage_national_regsitry", $national_registry, 60*60*24);
}

echo $national_registry;
?>
		</div>
		</div>
			

		
		<div style="float:left;width:307px;height:250px;margin:10px; margin-top: 15px; margin-left:0;border:2px solid #000; background:#fff;overflow:hidden">
		
	
	
		<div class="just_padded">
		<h3>Grauman's Chinese Theater</h3>
		
		<?php
		
		$random_graumans=apc_fetch("homepage_random_graumans");
		
		if(empty($random_graumans))
		{
		$random_graumans=get_random_graumans();
		apc_store("homepage_random_graumans", $random_graumans, 60*60*24);
		}
		
		echo $random_graumans;
		?>
		
		</div>
		</div>
		
		
	
		<div class="clear"></div>		
		
		<div style="margin-left:150px;margin-bottom:10px">				
				
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Link_Units_bottom_page -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:15px"
     data-ad-client="ca-pub-4376916892217453"
     data-ad-slot="6942524013"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

</div>


			
			<div class="clear"></div>
						
			
	
			<!--End of Articles-->
			
					<!--<hr class="thick_separator"/>-->
					
					<!--
					<h3>Classic Movie Quotes of the Day:</h3>
					<div class="padded_content">
					<?php
					 echo getQuotesByThings(NULL, NULL, NULL);
					?>
					</div>
					-->
					<!--<hr class="thick_separator"/>-->
					<!--
					<h3>Classic Movie Facts of the Day:</h3>
					<div class="padded_content">
					<?php
					 echo getFactsByThings(NULL, NULL, NULL);
					?>
					</div>
					-->
					
				</div><!--closes main_area-->
						
			</div><!--closes main-->
			
			<?php include ("_footer.php"); ?>
		
		</div> <!--closes container-->
		
		<?php 
		//profiler();
		?>
		
		<?php include("home_page_ad2.php"); ?>
		
		<script type="text/javascript">
					$$("a.anchors").each(function(each_anchor){
					each_anchor.observe("click", function(e)
					{
					var current_link=(each_anchor.href).split("#");
					
					var element_to_go_to=$(current_link[1]);
					
					var y_=(element_to_go_to.cumulativeOffset().top)-100;
					
					window.scrollTo(y_, y_);
					
					});
					});
					</script>
					
		<script type="text/javascript" src="/scripts/ratings.js"> </script>

	<script src="/scripts/stats_box.js" type="text/javascript"></script>
	

</html>
<?php
//for page caching
include("end_cache.php");
?>