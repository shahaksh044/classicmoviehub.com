<?php
$show_link=false;
$htaccess=$_GET['htaccess'];
if(($htaccess != 1) and (count($_GET)==0))
{
header("HTTP/1.1 301 Moved Permanently");
header("Location:http://www.classicmoviehub.com/films/genres");
exit;
}
session_start();
require_once("db.php");
$connection = connectMysql(SERVER, USER, PWD, DB);
include_once("config.php");
require_once("functions.php");
$f_u_name='';
if(isset($_GET['f_u_name']))
$f_u_name=$_GET['f_u_name'];
$film_id=NULL;
if(isset($_GET['film_id']{0}))
$film_id=$_GET['film_id'];
if( (empty($_GET['filter'])) and (empty($_GET['film_id'])) and (!empty($f_u_name))  )
{
$sql_get_film_id='select id, name from agatti_films where u_name="'.mysqli_real_escape_string($GLOBALS['connection'], $f_u_name).'"';
$response_get_film_id=mysqli_query($GLOBALS['connection'], $sql_get_film_id) or die(mysqli_error($GLOBALS['connection']));
$array_get_film_id=mysqli_fetch_row($response_get_film_id);
$film_id=$array_get_film_id[0];
$film_title=$array_get_film_id[1];
}
else if( (empty($_GET['filter'])) and (empty($f_u_name)) and (!empty($film_id)) )
{
$sql_get_film_u_name='select u_name from agatti_films where id='.$film_id;
$response_get_film_u_name=mysqli_query($GLOBALS['connection'], $sql_get_film_u_name) or die(mysqli_error($GLOBALS['connection']));
$array_get_film_u_name=mysqli_fetch_row($response_get_film_u_name);

$f_u_name=$array_get_film_u_name[0];
header("HTTP/1.1 301 Moved Permanently");
header("Location:/film/".$f_u_name);exit;
}
$actual_url=$_SERVER['REQUEST_URI'];
if( (stripos($actual_url, "films.php") !== FALSE) and (!empty($_GET['filter'])))
{
$get=$_GET;
$get_tb=array("topic"=>"agatti_topics", "genre"=>"agatti_genre", "award"=>"agatti_awards", "decade"=>'(select concat("19", substr(year, 3, 1), "0") as u_name, concat("19", substr(year, 3, 1), "0") as id from agatti_films where year like "19%" group by u_name ) as decades');
$watch_get=array("year"=>array("decade", "the_decade"), "alpha_name"=>array("alpha", "range"));
$sql__='select u_name from '.$get_tb[$_GET['filter']].' where id='.$_GET['value'];
$response__=mysqli_query($GLOBALS['connection'], $sql__) or die(mysqli_error($GLOBALS['connection']));
$array__=mysqli_fetch_row($response__);
if(empty($_GET['sort']))
{
if(!empty($array__[0]))
{
header("HTTP/1.1 301 Moved Permanently");
header("Location:/films/".$_GET['filter']."/".$array__[0]);exit;
}
}
else
{
foreach($watch_get as $key_get=>$array_value)
{
if($_GET['sort'] == $key_get)
{

header("HTTP/1.1 301 Moved Permanently");
header("Location:/films/".$_GET['filter']."/".$array__[0]."/".$array_value[0]."/".$_GET[$array_value[1]]);exit;
}
}
}
header("HTTP/1.1 301 Moved Permanently");
header("Location:/films");exit;
}
$default_sorter='alpha';
$request_uri=trim($_SERVER['REQUEST_URI'], '/');
$request_uri=preg_replace('/\?(.*)/', '', $request_uri);
if((!empty($_GET['filter'])) and (!empty($_GET['u_name'])) and (empty($_GET['page'])) )
{
$def_url=trim($request_uri, '/');
if(empty($_GET['sort']))
$def_url .= '/'.$default_sorter.'/all/';
if(empty($_GET['page']))
$def_url .= '/page/1/';
$def_url = '/'.$def_url;
$def_url=preg_replace('/\/+/', '/', $def_url); 
header("HTTP/1.1 301 Moved Permanently");
header("Location:".$def_url);
exit;
}
if(!empty($_GET['f_u_name']))
{
$table='agatti_films';
require_once("check_if_active.php");
}
$u_name='';
if(!empty($_GET['u_name']))
$u_name=$_GET['u_name'];
$tb_filter=array("topics"=>"agatti_topics", "genres"=>"agatti_genre", "awards"=>"agatti_awards");
$tb_filter_singular=array("topic"=>"agatti_topics", "genre"=>"agatti_genre", "award"=>"agatti_awards");
?>
<?php echo "<?xml";?> version="1.0" encoding="utf-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#">
  <head>
    <?php 
    
    include("min_max_ranges_array.php");
    
    include("title.php");
    ?>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <?php echo $meta; ?>
    <?php require_once("css.php"); ?>
		
	<script type="text/javascript" src="/scripts/prototype.js"></script>
	<script type="text/javascript" src="/scripts/ibox/ibox.js"></script>
		<?php
		
	if(isset($film_id{0}))
	{
	include_once("sampleSettings.php");
	}
	?>
	
	<style type="text/css">

<?php

if( (!empty($film_id)) and ($deviceType=="computer") )
echo '#main_area_new_right_col{width:670px !important} #main{padding:0 !important;float:none} ';

?>	

div[itemprop=aggregateRating] {margin-top:10px;font-weight:bold}
.rate_wrapper {margin-bottom:5px}

	</style>
  </head>
    
	<?php include("home_page_ad.php"); ?>
  
		<div id="container">
	
			<?php include("_logo.php"); ?>
						
			<?php include("_header.php"); ?>
			<div class="clear"></div>
			
			<?php include ("_navbar_one.php"); ?>
			<div id="main">
			<div id="main_area_new_right_col">
			<div id="breadcrumb">
			
			<?php
			$filter = $_GET['filter']; //award, topic, decade
			$name=$_GET['name']; //the name of the value of the filter parameter
			$array_picture=array();
			$array_actor=array();
			$array_other=array();
			$array_director=array();
				$image_folder = 'films';
				//$url_root = 'movie.php';
				$url_root = 'films.php';	
				if(!empty($filter))
				{
				$value=$_GET['value'];
				
				if( (empty($value)) and (!empty($u_name)) and ($filter != "decade") and ($filter != "user") )
				{
				$sql_value='select id from '.$tb_filter_singular[$filter].' where u_name="'.$u_name.'"';
				
				//die($sql_value);
				
				$response_value=mysqli_query($GLOBALS['connection'], $sql_value) or die(mysqli_error($GLOBALS['connection']).'<br/>'.$sql_value);
				
				$array_value=mysqli_fetch_row($response_value);
				$value=$array_value[0];
				}
				else //if decade the value is the same as the u_name because there's no decades table
				{
				$value=$u_name;
				//echo $value.'<hr/>';exit;
				}
				
				
				
				switch($filter)
				{
				
				//specific user rated movies
				case "user":
				{
				
				//die("<hr/>oops");
				
				$array_fields_to_show = array("name", "year", "director");
				
				//just for demo
				//$rater_user_id=$_SESSION['user_id'];
				
				$query='select agatti_films.id, agatti_films.name, agatti_films.u_name as f_u_name, agatti_films.year, agatti_people.name as the_person, agatti_people.id as the_person_id, agatti_people.u_name as the_person_u_name from agatti_films, agatti_people, agatti_film_ratings  where 
 
 
 agatti_film_ratings.film_id=agatti_films.id and agatti_film_ratings.user_id='.$rater_user_id.' and agatti_film_ratings.rating > 0 and agatti_film_ratings.rating is not NULL 
  
  
  and agatti_people.id = agatti_films.co_director0 and agatti_films.active=1 '.$range_where.'  '.$decade_where.' '.$this_year_where.'
 
 group by agatti_films.id';
 
 // die($query);
 
				
				}
				break;
				
				
				case "genre":
				{
				
				$array_fields_to_show = array("name", "year", "director");
				
				
				$query='select agatti_films.id, agatti_films.name, agatti_films.u_name as f_u_name, agatti_films.year, agatti_people.name as the_person, agatti_people.id as the_person_id, agatti_people.u_name as the_person_u_name from agatti_films, agatti_people where 
 
 
 (agatti_films.genre1='.$value.' or agatti_films.genre2 ='.$value.' or agatti_films.genre3 ='.$value.' or agatti_films.genre4 ='.$value.' or agatti_films.genre5 ='.$value.' or agatti_films.genre6 ='.$value.' or agatti_films.genre7 ='.$value.' or agatti_films.genre8 ='.$value.' or agatti_films.genre9 ='.$value.' or agatti_films.genre10= '.$value.') 
  
  
  and agatti_people.id = agatti_films.co_director0 and agatti_films.active=1 '.$range_where.'  '.$decade_where.' '.$this_year_where.'
 
 group by agatti_films.id';
 
				
				}
				break;
				
				case "decade":
				{
				
				$array_fields_to_show = array("name", "year", "director");
				
				$query = 'SELECT distinct(agatti_films.id), agatti_films.name,agatti_films.u_name as f_u_name, agatti_films.year, agatti_people.name as the_person,agatti_people.id as the_person_id,agatti_people.u_name as the_person_u_name 

FROM agatti_films, agatti_people where concat("19", substr(year,3,1), "0") = "'.$value.'" 

and agatti_people.id = agatti_films.co_director0 and agatti_films.active=1 '.$range_where.' '.$decade_where.' '.$this_year_where.'';
				
				//die($query);
				
				}
				break;
				case "topic":
				{
				
				$array_fields_to_show = array("name", "year", "director");
				$query = 'SELECT distinct(agatti_films.id), agatti_films.name,agatti_films.u_name as f_u_name, agatti_films.year, agatti_people.name as the_person, agatti_people.id as the_person_id, agatti_people.u_name as the_person_u_name

FROM agatti_films, agatti_people  where (topic1='.$value.' or topic2='.$value.' or topic3='.$value.' or topic4='.$value.' or topic5='.$value.' or topic6='.$value.' or topic7='.$value.' or topic8='.$value.' or topic9='.$value.' or topic10='.$value.')

and agatti_people.id = agatti_films.co_director0 and agatti_films.active=1 '.$range_where.' '.$decade_where.' '.$this_year_where.'';
				
				}
				break;
				
				
				//end of code I added
				
				
				case "award":
				{
				
				$array_picture = array(1);
				$array_actor = array(2,3,4,5);
				$array_director = array(6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,30);
				
				
				$array_director_labels = array(6=>"Director",7=>"Original Screenplay",8=>"Adapted Screenplay",9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,30);
				
				$array_other = array(27,28,29);
				
				//die($value);
				
				if(in_array($value, $array_picture))  // the 'value' is what clicked on, if they didn't click on anything, the value is null so this will move on to the next query, etc.
				{
				
				$array_fields_to_show = array("name", "year", "director");
				
				$query = 'select agatti_films.id, agatti_films.name, agatti_films.u_name as f_u_name,agatti_people.name as the_person, agatti_films.id, agatti_people.id as the_person_id,agatti_people.u_name as the_person_u_name,agatti_awardees.year

from agatti_films, agatti_awardees, agatti_people where (agatti_awardees.film_id = agatti_films.id and agatti_awardees.award_id = '.$value.' and agatti_people.id = agatti_films.co_director0 and agatti_films.active=1) '.$range_where.' '.$decade_where.' '.$this_year_where.' group by agatti_films.id';
				
				//die($query);
				}
				else if(in_array($value, $array_actor))
				{
				
				$array_fields_to_show = array("name", "year", "actor", "role");
			

				$query = 'select agatti_awardees.film_id as id, agatti_awardees.film_name as name, concat(agatti_awardees.first_name, " ", agatti_awardees.last_name) as the_person, agatti_awardees.person_id as the_person_id, agatti_people.u_name as the_person_u_name, agatti_awardees.role, agatti_awardees.year, agatti_films.u_name as f_u_name from 

 agatti_awardees, agatti_people, agatti_films  where (agatti_awardees.award_id = '.$value.') '.$range_where.' '.$decade_where.' '.$this_year_where.' and agatti_people.id=agatti_awardees.person_id and agatti_films.id=agatti_awardees.film_id group by agatti_awardees.film_id';
	
				//die($query);
				
				}
				else if(in_array($value, $array_director))
				{
				
				$array_fields_to_show = array("name", "year", "director");
				
				$query = 'select agatti_films.id, agatti_films.name, agatti_films.u_name as f_u_name,agatti_people.name as the_person, agatti_films.id, agatti_people.id as the_person_id,agatti_people.u_name as the_person_u_name,agatti_awardees.year

from agatti_films, agatti_awardees, agatti_people where (agatti_awardees.film_id = agatti_films.id and agatti_awardees.award_id = '.$value.' and agatti_people.id = agatti_films.co_director0 and agatti_films.active=1) '.$range_where.' '.$decade_where.' '.$this_year_where.' group by agatti_films.id';
				}
				}
				break;
				
				}//end of switch
				
				
				//die($query);
				}
				
				else
				{
				$query='SELECT  agatti_genre.id, agatti_genre.u_name, agatti_genre.description, count(agatti_films.id) as number_films, agatti_genre.name FROM `agatti_films`, agatti_genre WHERE agatti_genre.active=1 and  agatti_films.active=1 and (agatti_genre.id = agatti_films.genre1 or agatti_genre.id = agatti_films.genre2 or agatti_genre.id = agatti_films.genre3 or agatti_genre.id = agatti_films.genre4 or agatti_genre.id = agatti_films.genre5 or agatti_genre.id = agatti_films.genre6 or agatti_genre.id = agatti_films.genre7 or agatti_genre.id = agatti_films.genre8 or agatti_genre.id = agatti_films.genre9 or agatti_genre.id = agatti_films.genre10) group by name order by name asc';
				}
				
				if(isset($filter{0}))// is set, not empty
				{
				
				$sorting_query='order by agatti_films.alpha_name asc'; //defualt sorting parameter
				$sort=$_GET['sort'];
				
				if(!isset($sort{0}))
				$sort='alpha_name';//to reaffirm or desinate default sort parameter
				
				//die('lol '.$filter);
				
				if($filter=="award")
				{
				
				//die('lol '.$sort);
				
				if($sort=="alpha_name")
				{
				//$sorting_query='order by agatti_films.alpha_name asc';
				
				$sorting_query='order by agatti_awardees.alpha_name asc';
				}
				else if($sort=="year")
				{
				$sorting_query='order by agatti_awardees.year asc';
				}
				
				}
				else
				{
				//echo 'I have beeb through here';
				$sorting_query='order by agatti_films.'.$sort.' asc';
				}
				
				
				$query=$query.' '.$sorting_query; // the space is to seperate the order part of query from the select part
				}
				
				
				
				if(isset($_GET['person_name']{0}))
				echo '<a href="/ratings.php?id='.$_GET['person_id'].'">'.$_GET['person_name'].'</a>&nbsp;&gt;&nbsp;';
				
				if( isset($_GET['action']{0}) and $_GET['action'] == "reviewed")
				echo '<span id ="notice" >Thank you for submitting your review.</span>';
				
				  
				$filter_ = 'Genres';
				
				include("film_breadcrumb.php");
				if(!isset($film_id{0}))
				include("filter_parameters.php");
				
				?>
				
				</div><!-- closing breadcrumb-->
				
				
				<div class="clear2">&nbsp;</div>
								
				<?php
				
				
				
				 $increment=0;
				if(isset($film_id))
				{
				$query='select agatti_films.*, agatti_films.u_name as f_u_name,  concat(agatti_people.first_name, " ", agatti_people.last_name) as full_name, agatti_people.u_name as the_person_u_name, agatti_people.id as director_id, count(agatti_film_ratings.id) as number_ratings, avg(agatti_film_ratings.rating) as film_rating from agatti_films left join agatti_film_ratings on (agatti_film_ratings.film_id=agatti_films.id) left join agatti_people on (agatti_films.co_director0=agatti_people.id) where agatti_films.id='.$film_id.' and agatti_films.active=1 group by film_id';
				
				}
				if(!empty($_GET['page']))
					{
					
					$page=$_GET['page'];
					
					if($page==1)
					$start=0;
					else
					$start=($page-1)*$amount_per_page;
										
					$query .= ' limit '.$start.', '.$amount_per_page;
					}
				$response = mysqli_query($GLOBALS['connection'], $query) or die(mysqli_error($GLOBALS['connection'])."<br/>".$query);
				if(empty($film_id))
				{// step 1 and step2
				if($deviceType == "computer")
				$n_per_row = 5;
				else
				$n_per_row = 3;   //tells when get to 4 wrap to next line
				$i = 1;   //tells to count by 1
				if( ($filter=="user") and  ($_SESSION['username'] != $u_name))
				{
				 echo '<div class="padded_content wiki_wrapper thick_separator"><p>You cannot have access to this page because it is private.</p></div>';
				}
				else
				{
				
				echo '<div class="welcome_msg">
			<big>Rate your favorite films now!</big>
			<br/>
Your votes count. They generate our fan charts.<div class="clear2"></div>
			<button type="button" onclick="window.location=\'/charts/\';"  >Check out the charts.</button>
			</div>';
				while($info = mysqli_fetch_array($response)) /*$info = film or genre*/
				{
				if(empty($genre) and empty($filter) )
				{
				$url_argument = 'filter=genre&value='.$info['id'].'&name='.urlencode($info['name']).'';
				
				$film_full_url='/films/genre/'.$info['u_name'];
				
				$additional_info = '';
				$stats = '<big><br/><a href="'.$film_full_url.'">Browse '.$info['description'].'<br/>'.$info['number_films'].'<br/> Classic Movies<br/>Listed in the<br/>'.$info['name'].' Genre<br/>So Far</big>'; /* we don't know what the stats will be yet so it is empty*/
				$folder = 'genres';
				}  //ends this particular if loop, other if loop ends way below
				else
				{
				$url_argument = 'filter='.$filter.'&value='.$value.'&name='.urlencode($name).'&film_id='.$info['id'].'&genre='.$genre.'&film_title='.urlencode($info['name']);
				
				$film_full_url='/film/'.$info['f_u_name'];
				
				//$additional_info = ' ('.$info['year'].') ';
				
				
				//$stats = $info['year'];
				$year = $info['year'];
				$director = $info['full_name'];
				//die('ok');
				$stats = '';
				
				foreach($array_fields_to_show as $field_show)
				{
				
				if($field_show == "name")
				{
				$stats .= '<div class="break"></div><strong>';
				
				if($show_link)
				$stats .= '<a href="'.$film_full_url.'">'.$info['name'].'</a>';
				else
				$stats .= '';//$info['name'];
				
				$stats .='</strong><div class="break"></div>';
				}
				
				if($field_show == "year")
				{
				$stats .= '<span class="released mask_words"></span> '.$info['year'].'<div class="break"></div>';
				}
				else if($field_show == "actor")
				{
				
				if($value==3 or $value==5)
				{
				$stats .= '<strong>Actress: ';
				
				if($show_link)
				$stats .= '<a href="/bio/'.$info['the_person_u_name'].'">'.$info['the_person'].'</a>';
				else
				$stats .= $info['the_person'];
				
				$stats .='<br/><br/>Role: '.$info['role'].'</strong><div class="break"></div>';
				}
				
				else if($value==2 or $value==4)
				{
				$stats .= '<strong>Actor: ';
				
				if($show_link)
				$stats .= '<a href="/bio/'.$info['the_person_u_name'].'">'.$info['the_person'].'</a>';
				else
				$stats .= $info['the_person'];
				
				$stats .='<br/><br/>Role: '.$info['role'].'</strong><div class="break"></div>';
				}
				
				}
				
				else if($field_show == "director")
				{
				
				if(in_array($value, $array_director))
				{
				
				$stats .= $array_director_labels[$value].': ';
				
				if($show_link)
				$stats .= '<a href="/bio/'.$info['the_person_u_name'].'">'.$info['the_person'].'</a>';
				else
				$stats .= $info['the_person'];
				
				$stats .='<div class="break"></div>';
				
				}
				
				else
				{
				$stats .= '<strong>Director:<br/>';
				
				if($show_link)
				$stats .= '<a href="/bio/'.$info['the_person_u_name'].'">'.$info['the_person'].'</a>';
				else
				$stats .= $info['the_person'];
				
				$stats .= '</strong><div class="break"></div>';
				}
				
				
				}
				
				}
				$folder = 'films';
				}  //ends else
				if(isset($_GET['filter']{0}))//apply the stripping function here
				$__name=_shorten_name($info['name'], $info['year'], 30);
				else
				$__name=$info['name'];
				
				
				
				echo '<div class="thumb" commonality="'.$info['id'].'" > 
			
						<img src="'.getThumbnail($info['id'], $folder).'" border="0" title="'.$info['name'].'" width="115"  alt="'.$info['name'].'" class="bio_picture '.$info['id'].'" align="left" id="th_'.$increment.'"/>
						
						<div class="stats '.$info['id'].'" id="stats_'.$increment.'" style="display:none">'.$stats.'</div>
						<h4><a href="'.$film_full_url.'">'.$__name.'</a></h4>'; 
				
				if( (isset($info['id']{0})) and (isset($info['f_u_name']{0})) )
				{	
				echo '<a href="#" rel="ibox&target=_login.php&arg='.urlencode($_SERVER['REQUEST_URI']).'" title="Login" class="link_wrapper" film="'.$info['id'].'">'.getCurrentRating(NULL, NULL, $info['id'], $increment).'</a>';
				}

			
						echo '</div>'; /*closes thumb*/						
										
						if( $i%$n_per_row == 0) //+ / * - %  //for a example 5%2 = 1
						echo '<div class="clear"></div>';
				
						$i++;
						
				$increment++;
				} // end of while loop
				}
				$sql_without_limit=explode(" limit ", $query);
				
				$query = $sql_without_limit[0];
				
				//die($query);
				
				$response=mysqli_query($GLOBALS['connection'], $query) or die(mysqli_error($GLOBALS['connection']));
				$total=mysqli_num_rows($response);
				
				if($total ==0)
				{
				echo compose_no_return_msg_films();
				}
				else
				{
				
				$url=preg_replace('/\/page\/(.*)/', '', $_SERVER['REQUEST_URI']);
				
				
				echo '<div class="clear"></div><p>&nbsp;</p>'._pagination($url, $total, false, $page, $amount_per_page, 10).'';
				}
				
				} //closes FIRST if loop
				
				else
				{
				$film_info = mysqli_fetch_array($response);
				
				$nat_year=$film_info['nat_film_reg'];
				$nat_film_reg_class=$film_info['nat_film_reg_class'];
				$film_year=$film_info['year'];
				$director_id=$film_info['director_id'];
				$director_name=$film_info['full_name'];
				$director_u_name=$film_info['the_person_u_name'];
				$film_name=_encode_to_fix_accented($film_info['name']);		
				$producer_info=getFirstProducer($film_id);	
				$producer_id=$producer_info['id'];
				$producer_name=$producer_info['name'];
				$producer_u_name=$producer_info['u_name'];
$folder='films';

$url_argument='film_id='.$film_info['id'].'&film_title='.urlencode($film_name);
$film_full_url='/film/'.$film_info['u_name'];

//THIS IS THE STATS BOX for the Individual Film at the top of the Film page for that particular film
$director_role='Director';
$uncred_dir_bool_array=explode("*", $film_info['uncred_dir_bool']);

$assi_dir_bool_array=explode("*", $film_info['assi_dir_bool']);

$directors_array=explode("*", $film_info['directors']);

$film_rating=number_format($film_info['film_rating'], 2);

$number_ratings=($film_info['number_ratings']*100)+rand(1, 9);

$position=0;

foreach($directors_array as $each_director)
{

if($each_director==$film_info["full_name"])
break;

$position++;
}

$director_assistant=$assi_dir_bool_array[$position];
$director_uncredited=$uncred_dir_bool_array[$position];

if($director_assistant==1)
$director_role='Assistant Director';

if($director_uncredited==1)
$director_credit = '<br/>(uncredited)';

$stats = '<br/><br/><strong>'.$film_info['name'].'</strong><div class="break"></div>
<span class="released mask_words"></span><br/>

<span itemprop="datePublished" content="'.$film_info['year'].'">
'.$film_info['year'].'
</span>

<div class="break"></div><strong>'.$director_role.':<br/>

<span itemprop="director" itemscope itemtype="http://schema.org/Person">';

if($show_link)
$stats .='<a href="/bio/'.$film_info['the_person_u_name'].'" itemprop="name">'.$film_info['full_name'].'</a>';
else
$stats .= $film_info['full_name'];

$stats .= '</span>

</strong>'.$director_credit;

$name=_shorten_name2($film_name, 45);
$summary=_encode_to_fix_accented($film_info['wiki_summary']);

$img_film=getThumbnail($film_info['id'], $folder);

$array_passed=array();
$array_passed["summary"]=strip_tags($summary);
$array_passed["images"]=$img_film;
$array_passed["pinterest_description"]=$film_name.' ('.$film_year.'). Featured Cast: '.strip_tags(getFeaturedCast($film_id, 3, true));

$array_passed["title"]=$prefix;
echo '<div class="clear"></div>
<!--<div class="buttons" >
						
						
						<a href="#overview" onclick="return false;">Overview</a>
						<a href="#synopsis" onclick="return false;">Synopsis</a>
						<a href="#plot" onclick="return false;">Plot</a>
						<a href="#favorites" onclick="return false">Fan Favorites</a>
						<a href="#featuredcast" onclick="return false;">Featured Cast</a>
						<a href="#director" onclick="return false;">Director</a>
						<a href="#producer" onclick="return false;">Producer</a>
						<a href="#quotes" onclick="return false;">Quotes</a>
						<a href="#facts" onclick="return false;">Facts</a>
					</div>-->
					
					<div class="clear"></div>
					
					<div id="pagecontent" itemscope itemtype="http://schema.org/Movie">
				<article>	
				
			<div id="top_block">
<div id="featured_thumb" class="featured_thumb" commonality="'.$film_info['id'].'" > 
			
							<div class="img_bio" >
						<img src="'.$img_film.'" border="0" title="'.$film_name.'" width="115"  alt="'.$film_name.'" class="'.$film_info['id'].'" id="th_'.$increment.'" itemprop="image" />
						<div class="bio_buy_now">
						<a href="" class="amazon" title="'.urlencode($film_info['name']).'*'.$film_info['year'].'">
						<img src="/images/buy_dvd_now.png" class="_not_button" border="0" title="Buy '.$film_info['name'].' Now at Amazon" alt="Buy '.$film_info['name'].' Now at Amazon" align="center" />
						</a>
						</div>
						
						</div>
						<div class="agg_rating">
						<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="agg_rating_" >
  <span itemprop="ratingValue">'.$film_rating.'</span> out of <span itemprop="bestRating">10</span> stars from<br/>
  <span itemprop="ratingCount">'.$number_ratings.'</span> users
</div>

						'.getUserRating($film_id, $increment).'
						
						</div>
						
						<div class="clear"></div>
						</div>';
				$year_tr='';
				if(isset($film_info['year']{0}))
				$year_tr= ' ('.$film_info['year'].')';
				
				$increment++;
				echo '
							
				<div class="main_info_box2" style="width:450px;border:0" >
				
				<table border="0" class="career_stats" cellspacing="0" cellpadding="0">
				
				<tr><td valign="top" colspan="2">
				<h1 class="to_left look_like_h3 entity_title"><a href="'.$film_full_url.'" title="'.$film_name.'" itemprop="url"><span itemprop="name">'.$film_name.$year_tr.'</span></a>
						</h1>
						
						<div class="to_right solo_essential">'.getJustEssentialRating(NULL, $film_id, $increment, array("object"=>"films", "variable_name"=>NULL, "variable_value"=>NULL)).'</div>
						
						<div class="clear"></div>
						</td></tr>
				<tr><td valign="top"><b>Director(s)</b></td><td valign="top">'.getDirectors($film_id).'</td></tr>	
				<tr><td valign="top"><b>Producer(s)</b></td><td valign="top">'.getProducers($film_id, true).'</td></tr>
				
				<tr><td width="110" valign="top"><b>Top Genres</b></td><td valign="top">'.getGenresByFilm($film_id, 5, true, false).'</td></tr>
				<tr><td width="110" valign="top"><b>Top Topics</b></td><td valign="top">'.getTopicsByFilm($film_id).'</td></tr>
				
				</table>
				<div class="clear"></div>
				<br>
				
				<h3 style="margin:5px;margin-top:10px;margin-right:15px">
				<div class="to_left">Featured Cast:</div>
				<div class="to_right"><a href="/cast/'.$f_u_name.'/">See Full Cast</a></div>
				<div class="clear"></div>
				</h3>

				'.getFeaturedCast($film_id, 3).'
				</div>
			<div class="clear"></div></div>';
			$increment++;
						echo '<div class="clear"><br/></div>
					<script type="text/javascript">
					$$("div.buttons a").each(function(each_anchor){
					each_anchor.observe("click", function(e)
					{
					var current_link=(each_anchor.href).split("#");
					
					var element_to_go_to=$(current_link[1]);
					
					var y_=(element_to_go_to.cumulativeOffset().top)-100;
					
					window.scrollTo(y_, y_);
					
					});
					});
					</script>
					';					
			?>
		

		<div class="clear"></div>
<div class="clear"></div>
		<?php
						echo '
						<h3><a id="overview">'.$film_info['name'].' Overview:</a></h3>
						<div class="padded_content wiki_wrapper thick_separator"  style="margin-top:10px" itemprop="description">'.film_summary($film_id).'</div>
					<div class="clear"></div>
					<div style="width:485px;height:70px;padding-left:20px;padding-top:10px;margin-left:90px;">
			
			<!--kino-->
			
			<!--
			
		<a href="http://www.kinolorber.com/video-store.php?affiliate=clmh"><img  src="images/promotions/ClassicMovieHub_PioneerWomen_485x60.jpg" class="floatable_img" title="Kino Lorber DVDs"></a>	
		-->
			<!--sovrn-->
			<!--film 468x60-->	
			
				<script type="text/javascript" src="//ap.lijit.com/www/delivery/fpi.js?z=387941&u=classicmoviehub&width=468&height=60"></script>
	</div>
						<h3><a id="articles"><span class="mask_words '.str_replace(' ', '_', $film_name).'"></span> BlogHub Articles:</a> </h3>
								
					'.blog_article(array("object_type"=>"film", "object_id"=>$film_id,  "object_u_name"=>$f_u_name, 'object_name'=>$film_name), 5, false, false);
					?>
						<div class="clear"></div>
					
					
					<div style="width:485px;height:70px;padding-left:20px;padding-top:10px;margin-left:90px;">	
					<!--amazon echo ad-->
					<iframe src="http://rcm-na.amazon-adsystem.com/e/cm?t=classicmovi04-20&o=1&p=26&l=ur1&category=echo&banner=0PT9MRSRBA7EWW462H02&f=ifr&linkID=46BFYZPLBBUYJNMG" width="468" height="60" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
					</div>
			<h3><a id="quotes">Quotes from <?php echo '<span class="mask_words '.str_replace(" ", "_", $film_name).'"></span>'; ?> </a></h3>
			
					<div class="padded_content">
					<?php
					echo getQuotesByThings('film_id', $film_id, true, false, '', 3, false, false);
					?>
					</div>
					<div class="clear"> </div>
					
					<h3><a id="facts">Facts about <?php echo '<span class="mask_words '.str_replace(" ", "_", $film_name).'"></span>'; ?></a></h3>
					
					<div  class="padded_content">
					<?php
					echo getFactsByThings('film_id', $film_id, true, false, '', 3);
					?>
					</div>
			<div class="clear"> </div>
					
					
<!-- google responsive content ads film page -->		


<div  class="padded_content wiki_wrapper">			
					
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="autorelaxed"
     data-ad-client="ca-pub-4376916892217453"
     data-ad-slot="3939696855"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
			
	</div>
			
			<div class="clear"> </div>		
					
	<!--end of google responsive content ads film page -->				
		</article>
					
							
			<?php
			
			} 

				?>
				</div>
			
				</div>
					
		
			
			-->
			<?php
			if(!empty($film_id)) //for a single film
			include ("right_col_space_films.php");
			else //genres and films by genre
			include ("_right_col_films_ads.php");
			?>
			
				</div><!--closes main-->
			
			
			<?php include ("_footer.php"); ?>
			
	


	</div> <!--closes container-->
	


	<?php include("home_page_ad2.php"); ?>
	

<script type="text/javascript" src="/scripts/amazon_api.js"></script>


<script type="text/javascript" src="/scripts/ratings.js"> </script>
		
	<script src="/scripts/stats_box.js" type="text/javascript"></script>	
	
	
	<script type="text/javascript">
	$$(".read_mores").each(function(k)
	{
	k.observe("click", function(e)
	{
	var old_text=k.innerHTML;
	//alert("ok");return;
	
	var style_=$(k.id+"_").getStyle('display');
	
	if(style_=="none")
	{
	$(k.id+"_").show();
	k.innerHTML="read less";
	}
	else
	{
	$(k.id+"_").hide();
	k.innerHTML="read more";
	
	var element_id_to_scroll_to=k.readAttribute("for");
	
	if(element_id_to_scroll_to)
	{
	$(element_id_to_scroll_to).scrollTo();
	}
	
	
	}
	//alert(style_);
	});
	
	});
	
	
	
	//disable the default anchor behavior and force it to adjust the 100px when coming from a different page
	var current_url=window.location.href;
	
	var matches=current_url.match(/\#[a-z_!]*$/ig);
	if(matches)
	{
	var div_id=matches[0].substr(2, matches[0].length-1);
	
	//alert(div_id);
	
	var element_to_go_to=$(div_id);
					
	var y_=(element_to_go_to.cumulativeOffset().top)-100;
					
	window.scrollTo(y_, y_);
	}
	
	var height_top_block=$("top_block").getStyle("height").split("px")[0];	
	
	height_top_block= height_top_block-25;

if(deviceType=="computer")
$("featured_thumb").setStyle({"height": height_top_block+"px"});

	</script>
</html>
<?php
include("end_cache.php");
?>