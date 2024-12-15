<?php

if(!isset($_GET['type']{0}))
{
header("Location:people.php?type=actors");exit;
}

session_start();

require_once("db.php");   //is this repetitive?????
include_once("config.php");
require_once("functions.php");

$increment=0;
$connection = connectMysql(SERVER, USER, PWD, DB);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

	<head>
		<?php include("alpha_min_max_arranges.php"); include("title.php"); ?>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="styles/main.css" type=text/css rel=stylesheet>
		<script type="text/javascript" src="scripts/prototype.js"></script>
	</head>

  
	<?php include("home_page_ad.php"); ?>
  
		<div id="container">
	
			<?php include("_logo.php"); ?>
						
			<?php include("_header.php"); ?>
			<div class="clear"></div>
			
			<?php include ("_navbar_one.php"); ?>
			<!--<div class="clear"></div>	-->
				
	
			<div id="main">
			
				<?php include ("_left_col.php"); ?>
			
				<!--<div id="main_area">
				trying new format here, needed to comment out right nav bar and needed to change number of thumbs across the page BELOW not on the functions page but BELOW instead-->
				
				<div id="main_area_new">
				
				<div id="breadcrumb">
								
				<?php
				
				
				
				  //new code here ADDED SILENT and GRAUMANS
				
				if($type=="producers" or $type=="executives")
				// new code added studio head as type
				{
				$array_filter = array("0"=>"All", "1"=>"Legendary", "5"=>"Walk of Fame", "6"=>"Grauman's"  );
				}
				else
				if($type=="directors")
				// new code added studio head as type
				{
				$array_filter = array("0"=>"All", "1"=>"Legendary", "4"=>"Award Winners", "5"=>"Walk of Fame", "6"=>"Grauman's");
				}
				
				
				if(!isset($legend{0}))
				$legend=0; //default
				
				$breadcrumb='';
				
				$sorting_array = array('first'=>'First Name', 'last'=>'Last Name');
				
				
				
				//is this where we handle the ceremony number order
				
				if($legend == 4) 
				{
				$sorting_array = array('first'=>'First Name', 'last'=>'Last Name', 'year'=>'Year');
				}
				else
				if($legend == 5)
				{
				$sorting_array = array('first'=>'First Name', 'last'=>'Last Name', 'address'=>'Star Address');
				}
				
			//new code for 6 graumans here	
				else
				if($legend == 6)  //added 6 graumans
				{
				$sorting_array = array('first'=>'First Name', 'last'=>'Last Name',/* 'ceremony_number'=>'Ceremony Number',*/ 'ceremony_date'=>'Ceremony Date');  //added ceremnony number and year or should year be date tbd
				}

			//end new code here
				/*if($legend <4 or $legend==7)
				{*/
				

				
				$url_sorting='people.php?type='.$_GET['type'].'&legend='.$_GET['legend'];
				//getDDLSortersAlpha($array_ranges, $url, $argument_name, $argument_value)
				
				//}
				
				if($_GET['legend']==6)
				$array_ranges_dates=array("all"=>"All", "20"=>"&le; 1920's", "30"=>"1930's", "40"=>"1940's", "50"=>"1950's", "60"=>"1960's", "70"=>"1970's", "80"=>"1980's", "90"=>"1990's", "100"=>"&ge; 2000's");
				else
				$array_ranges_dates=array("all"=>"All", "20"=>"&le; 1920's", "30"=>"1930's", "40"=>"1940's", "50"=>"1950's", "60"=>"1960's");
				
				if($_GET['legend'] == 5)
				{
				$street_array=array("all"=>"All", "hollywood_blvd"=>"Hollywood Blvd.", "vine_st"=>"Vine St.");
				
				$street_sorter='<select id="__'.rand(0, 10000).'__" class="segmenter">';
				
				foreach($street_array as $key=>$value)
				{
				
				if($key==$_GET['street'])
				$street_sorter .= '<option value="'.urlencode($url_sorting.'&sort=address&street='.$key).'" selected="selected" class="'.$key.'">'.$value.'</option>';
				else
				$street_sorter .= '<option value="'.urlencode($url_sorting.'&sort=address&street='.$key).'" class="'.$key.'">'.$value.'</option>';
				}
				
				$street_sorter .= '</select>';
				
				}
				//getDDLSortersYear($year_array, $url, $argument_name, $argument_value)
				if($legend==6)
				$year_sorter=getDDLSortersYear($array_ranges_dates, $url_sorting, "the_decade", $_GET["the_decade"], "ceremony_date");
				else
				if($legend==4)
				$year_sorter=getDDLSortersYear($array_ranges_dates, $url_sorting, "the_decade", $_GET["the_decade"], "year");
				
				$filter_parameters='<ul class="breadcrumb_filters">';
				
				
				
				//lol2  take 2 out of legend field; add code for if legend==2; similar to silent
				
				
				foreach($array_filter as $key=> $filter)
				{				
				if($legend==$key)
				$filter_parameters .= '<li>'.$filter.'</li>';
				else
				$filter_parameters .= '<li><a href="people.php?type='.$type.'&legend='.$key.'">'.$filter.'</a></li>';
				}
				
				$filter_parameters .='</ul>';
				
				
				$sorters_parameters='<ul class="breadcrumb_filters">';
				foreach($sorting_array as $key=>$value)
				{
				
				if($key==$order and !isset($_GET['sort']{0}) )
				{
				$alpha_sorter=getDDLSortersAlpha($array_ranges, $url_sorting, "range_".$key."", $starting_letter, $key);
				
				$sorters_parameters .= '<li>By '.$value.' '.$alpha_sorter.'</li>';
				}
				else 
				if($key=="first" or $key=="last")
				{
				$alpha_sorter=getDDLSortersAlpha($array_ranges, $url_sorting, "range_".$key."", $_GET["range_".$key.""], $key);
				
				$sorters_parameters .= '<li>By '.$value.' '.$alpha_sorter.'</li>';
				}
				else if($key=="ceremony_date" or $key=="year")
				{
				$sorters_parameters .= '<li>By '.$value.' '.$year_sorter.'</li>';
				}
				else if($key=="address")
				{
				$sorters_parameters .= '<li>By '.$value.' '.$street_sorter.'</li>';
				}
				else
				{
				$sorters_parameters .= '<li><!--<a href="people.php?type='.$type.'&order='.$key.'&legend='.$legend.'">-->by '.$value.'<!--</a>--></li>';
				}
				}
				
				$sorters_parameters .= '</ul><input type="hidden" value="'.$url_sorting.'" id="url_current_for_sorting" />';
				
				$type_=$type;
				
				if($type=="executives")
				$type_='Studio Executives';
				
				$breadcrumb = '<div id="breadcrumb_left">'.ucfirst($type_).'&nbsp;&gt;&nbsp;</div>
				
				<div style="float:right"><div id="breadcrumb_right">'.$filter_parameters.'</div>
				<div id="breadcrumb_right_sorters">'.$sorters_parameters.'</div></div>
				<div class="clear2">&nbsp;</div>
				';
				
				echo $breadcrumb;
				
				if($legend==0)
				$legend=' 1 ';  //so if you show them all; equivalent to WHERE 1
				else if($legend==1)
				{
				$legend='legend=1';
				}
				else if($legend==2)
				{
				$legend='character_=1';
				}
				else if($legend==3)
				{
				$legend='supporting=1';
				}
				else if($legend==7)
				{
				$legend='silent=1';
				}
				
				
				
				
				
				
				
				
				//die('lol '.$starting_letter.' - '.$ending_letter);
				
				$where_range='';
				
				if($starting_letter!="all" and isset($ending_letter{0}) )
				{
				
				//die("here");
				
				$where_range=' and (';
				
				for($letter=$starting_letter; $letter<=$ending_letter; $letter++)
				{
				
				if(strlen($letter)==1)
				$where_range .= 'agatti_people.'.$order.'_name like "'.$letter.'%" or ';
				
				}//end for
				
				
				$where_range = substr($where_range, 0, strlen($where_range)-3);// -3 means we get OR out for the last condition
				
				$where_range .= ')';
				
				}
				
				else if($starting_letter!="all" and !isset($ending_letter{0}) )
				{
				$where_range=' and (agatti_people.'.$order.'_name like "'.$starting_letter.'%")';
				}
				
				
				$wof_street_where='';
				
				if( isset($_GET['street']{0}) and $_GET['street'] != "all")
				{
				$wof_street_where=' and agatti_wof.star_street="'.$street_array[$_GET['street']].'"';
				}
				
				$the_decade_where='';
				
				if($_GET['sort']=="year" and $_GET['sort'] != "all" and $_GET['legend']==4)
				{
				//die("here");
				if($_GET['the_decade'] == "20")//taking <=20
				$the_decade_where=' and ( concat(substr(agatti_awardees.year, 3, 1), "0")="10" or concat(substr(agatti_awardees.year, 3, 1), "0")="20")';
				
				else if($_GET['the_decade'] != "all")
				$the_decade_where=' and ( concat(substr(agatti_awardees.year, 3, 1), "0")="'.$_GET['the_decade'].'" )';
				
				//$the_decade_where=' and agatti_awardees.year="'.$_GET['the_decade'].'"';
				
				}
				else if($_GET['sort']=="ceremony_date" and $_GET['sort'] != "all" and $_GET['legend']==6)
				{
				//die("here");
				if($_GET['the_decade'] == "20")//taking <=20
				$the_decade_where=' and ( concat(substr(agatti_graumans.ceremony_date, 3, 1), "0")="10" or concat(substr(agatti_graumans.ceremony_date, 3, 1), "0")="20")';
				
				else if($_GET['the_decade'] == "100")//taking <=20
				$the_decade_where=' and YEAR(agatti_graumans.ceremony_date) >= 2000';
				
				else if($_GET['the_decade'] != "all")
				$the_decade_where=' and ( concat(substr(agatti_graumans.ceremony_date, 3, 1), "0")="'.$_GET['the_decade'].'" )';
				
				
				
				}
				
				//die('lol '.$where_range);
				
				?>
					
					
				
				</div><!--closed breadcrumb-->
				<!--<div class="clear"> </div> closed breadcrumb-->
			<div class="clear"> </div> 
				
					<?php
				
					//include ("_main_area.php");
				
					$gender='';
					$profession='';
					$array_awards=NULL;
					
				//for awards show thumbnail of MOVIE they won for; and the name of the person is in the h4 link under the pix
					
					switch($type)
						{
				
						case 'actors':
						{
						$gender=' and gender=1 ';
						$profession=' and (director = 0 or director = 2) ';
						
						$array_awards= array(2, 4);
						
						/*$query = 'select id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director from agatti_people where '.$legend.' and gender = 1 and (director = 0 or director = 2) order by '.$order.'_name asc';*/
						/*we used the my_sql built-in function and its arguments AND because we used that DATE_FORMAT function we had to give it an ALIAS because that function changed the name of the column once we ran the query SO we called it birth and death AND remember to adjust things when you run the query in addtion to select the query*/
						}
						break;
				
						case 'actresses':
						{
						$gender=' and gender=0 ';
						$profession=' and (director = 0 or director = 2) ';
						
						$array_awards= array(3, 5);
						
						/*$query = 'select id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director from agatti_people where '.$legend.' and gender = 0 and (director = 0 or director = 2) order by '.$order.'_name asc';*/
						}
						break;
				
						case 'directors':
						{
						$gender=' ';
						$profession=' and (director = 1 or director = 2) ';
						
						$array_filter = array("All", "Legend", "Award winners");
						
						$array_awards= array(6);
						/*$query = 'select id, name, birth_city, birth_state, birthname, death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director from agatti_people where '.$legend.' and (director = 1 or director = 2) order by '.$order.'_name asc';*/
						}
						break;
				
				
						case 'producers':
						{
						$gender=' ';
						$profession=' and producer=1 ';
						
						$array_filter = array("All", "Legend", "Award winners");
						
						$array_awards= array(1);
						/*$query = 'select id, name, birth_city, birth_state, birthname, death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director from agatti_people where '.$legend.' and producer=1  order by '.$order.'_name asc';
						*/
						}
						break;
				
		
		
		//new code here
		
		
						case 'executives':
						{
						$gender=' ';
						$profession=' and studio_head=1 ';
						
						$array_filter = array("All", "Legend", "Award winners");
						
						$array_awards= array(1, 6);
						/*$query = 'select id, name, birth_city, birth_state, birthname, death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director from agatti_people where '.$legend.' and producer=1  order by '.$order.'_name asc';
						*/
						}
						break;
						
		//new code ends here
		
				
				
				
						default:
						{
					
						}
				
					}
					
					
				
				//echo $filter_parameters;
				if($_GET['legend']==5)  //wof
				{
				
				if($order=="address")
				{
				$query='select agatti_people.id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, agatti_wof.full_address,category from agatti_people, agatti_wof where agatti_people.active=1 and agatti_people.id=agatti_wof.person_id '.$gender.' '.$profession.' '.$where_range.' '.$wof_street_where.' '.$the_decade_where.' order by agatti_wof.star_street, agatti_wof.star_number';
				
				//die($query);
				}
				else
				$query='select agatti_people.id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, agatti_wof.full_address,category from agatti_people, agatti_wof where agatti_people.active=1 and  agatti_people.id=agatti_wof.person_id '.$gender.'   '.$profession.' '.$where_range.' '.$wof_street_where.' '.$the_decade_where.' order by agatti_people.'.$order.'_name asc';
				
				//die($sql);
				}
				else
				
				if($_GET['legend']==4) //awards
				{
				
				/*
				spinning the array into sql where conditions
				*/
				$awards_where='';
				
				for($i=0; $i<count($array_awards); $i++)
				{
				
				$awards_where.='award_id='.$array_awards[$i].' or ';
				
				}
				
				
				/*echo $awards_where."<br/>";
				print_r($array_awards);*/
				//for actors $awards_where='award_id=2 or award_id=4 or '
				
				//now taking the last OR out
				$awards_where = substr($awards_where, 0, strlen($awards_where)-4);  //function called substring, you tell it to start at 0 then use stringlength and subtract 4 characters
				
				
				//for actors $awards_where='award_id=2 or award_id=4'
				
				$awards_where = 'and ('.$awards_where.')';
				
				if($order=="year")
				{
				/*$query='select agatti_people.id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director, agatti_awardees.year  from agatti_people, agatti_awardees where agatti_awardees.person_id=agatti_people.id '.$gender.' '.$profession.' '.$awards_where.' group by agatti_people.id   order by agatti_awardees.year asc';*/
				
				if($type=="directors")
				$query='select agatti_people.id, agatti_people.name,  agatti_awardees.year, agatti_films.name, agatti_awards.name as award_name
				
				from agatti_people, agatti_awardees, agatti_films, agatti_awards
				
				where
				agatti_people.active=1 and 
				agatti_awardees.person_id=agatti_people.id '.$gender.' '.$profession.' '.$awards_where.' 
				
				and agatti_films.id=agatti_awardees.film_id
								
				and agatti_awards.id=agatti_awardees.award_id '.$where_range.'  '.$wof_street_where.' '.$the_decade_where.'
				
				  order by agatti_awardees.year asc';
				  
				else
				
				$query='select agatti_people.id, agatti_people.name,  agatti_awardees.year, agatti_awardees.role, agatti_awardees.film_id as fid, agatti_awardees.film_name, agatti_awards.name as award_name
				
				from agatti_people, agatti_awardees, agatti_awards
				
				where
				agatti_people.active=1 and 
				agatti_awardees.person_id=agatti_people.id '.$gender.' '.$profession.' '.$awards_where.' 
				
				and agatti_awards.id=agatti_awardees.award_id '.$where_range.'  '.$wof_street_where.' '.$the_decade_where.'
				
				  order by agatti_awardees.year asc';
				}
				
				else
				{
				
				/*$query='select agatti_people.id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director from agatti_people, agatti_awardees where agatti_awardees.person_id=agatti_people.id '.$gender.' '.$profession.' '.$awards_where.' group by agatti_people.id   order by '.$order.'_name asc';*/
				if($type=="directors")
				$query='select agatti_people.id, agatti_people.name,  agatti_awardees.year, agatti_films.name, agatti_awards.name as award_name
				
				from agatti_people, agatti_awardees, agatti_films, agatti_awards
				
				where
				agatti_people.active=1 and 
				agatti_awardees.person_id=agatti_people.id '.$gender.' '.$profession.' '.$awards_where.' 
				
				and agatti_films.id=agatti_awardees.film_id
				
				and agatti_awards.id=agatti_awardees.award_id '.$where_range.'   '.$wof_street_where.' '.$the_decade_where.'
				
				order by agatti_people.'.$order.'_name asc';
				else
				$query='select agatti_people.id, agatti_people.name,  agatti_awardees.year, agatti_awardees.role, agatti_awardees.film_name, agatti_awardees.film_id as fid, agatti_awards.name as award_name
				
				from agatti_people, agatti_awardees, agatti_awards
				
				where
				agatti_people.active=1 and 
				agatti_awardees.person_id=agatti_people.id '.$gender.' '.$profession.' '.$awards_where.' 
				
				and agatti_awards.id=agatti_awardees.award_id '.$where_range.'  '.$wof_street_where.' '.$the_decade_where.'
				
				order by agatti_people.'.$order.'_name asc';
				}
				
				//die($query);
								
				}
				
				//new code here   query for legend 6 = grauman's  and legend 7 = silent = 1
				
				
				else
				
				if($_GET['legend']==6) //graumans
			
				{
				
				if($order=="ceremony_number")
				{
				$query='select agatti_people.id, agatti_people.name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, agatti_graumans.ceremony_number,     DATE_FORMAT(agatti_graumans.ceremony_date, "%b %e, %Y") as _ceremony_date from agatti_people, agatti_graumans where  agatti_people.active=1 and  agatti_people.id=agatti_graumans.person_id '.$gender.' '.$profession.' '.$where_range.'  '.$wof_street_where.' '.$the_decade_where.' order by agatti_graumans.ceremony_number';
				}
				
				else
				if($order=="ceremony_date")
				{
				$query='select agatti_people.id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, agatti_graumans.ceremony_number,     DATE_FORMAT(agatti_graumans.ceremony_date, "%b %e, %Y") as _ceremony_date from agatti_people, agatti_graumans where  agatti_people.active=1 and   agatti_people.id=agatti_graumans.person_id '.$gender.' '.$profession.' '.$where_range.'  '.$wof_street_where.' '.$the_decade_where.' order by agatti_graumans.ceremony_date';
				}
				
		// just a thought, ceremony date and ceremony number should be equal perfectly aligned so WHY DO two separate queries
			
				else
				$query='select agatti_people.id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, 
				agatti_graumans.ceremony_number,  
				DATE_FORMAT(agatti_graumans.ceremony_date, "%b %e, %Y") as _ceremony_date, 
				agatti_graumans.ceremony_date from agatti_people, agatti_graumans where agatti_people.active=1 and   agatti_people.id=agatti_graumans.person_id '.$gender.' '.$profession.' '.$where_range.'  '.$wof_street_where.' '.$the_decade_where.' order by agatti_people.'.$order.'_name asc';
				
				//die($sql);
				}
				
				//end of new code	
				
				/*else
				
				if($_GET['legend']==7) //silent
				{
				$query = 'select id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director from agatti_people where agatti_people.active=1 and  
				agatti_people.silent = 1 
				'.$gender.' '.$profession.' '.$where_range.'  '.$wof_street_where.' '.$the_decade_where.' 
				order by '.$order.'_name asc';
				}*/
				
				
			
			
			//end new code here
				
				
				
			//lol	
			//FOR EVERYTHING ELSE, CORRECT:	
				
				else
				$query = 'select id, name, birth_city, birth_state, birthname,death_city, death_state, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday , DATE_FORMAT(died, "%b %e, %Y") as _died, gender, director from agatti_people where agatti_people.active=1 and '.$legend.' '.$gender.' '.$profession.' '.$where_range.' '.$the_decade_where.'   '.$wof_street_where.' order by agatti_people.'.$order.'_name asc';
				
				
				
				//die($query);
				
				
					require_once("db.php");  //isn't this repetitive
				
					$connexion = connectMysql(SERVER, USER, PWD, DB);
				
					$response = mysql_query($query) or die(mysql_error()."<br/>".$query);
				
				//this is where I changed 4 thumbs in a row to 5 thumbs in a row based on new design
					$n_per_row = 5;
				
					$i = 1;
				
					//9 people in total
					//9%3 = 0
				
					while($person = mysql_fetch_array($response)) /*changed variable people to person*/
					//while there's something in the array, then do the while loop
					{
										
						/*$birth = $person['birthday'];
						$birth = date("M d, Y", strtotime($birth));
						$died = $person['died'];
						$died = date ("M d, Y", strtotime($died));
						if($died == date("M d, Y", strtotime("now"))) /*zero is always the present or now, a timestamp can be from yesterday
						$died = 'N/A';*/
									
						
						$birthname = $person ['birthname'];
						
						$_birthday = $person['_birthday'];
						
						$death_city = $person ['death_city'];
						$death_state = $person ['death_state'];
						$deathplace = htmlentities($death_city.', '.$death_state);
						$_died = $person['_died'].'<br/>'.$deathplace;
						
						$_year='';
						
						if(isset($person ['year']{0}))
						{
						$_year='<br/>('.$person ['year'].')';
						}
						
						$wof='';
						
						if($_GET['legend']==5) //wof
						{
						$wof='<br/>'.$person ['full_address'].'';
						}
					
						if($_GET['legend']==6) //graumans
						{
						
						if ($order == "ceremony_number")
						$ceremony_info ='<br/>Ceremony #'.$person ['ceremony_number'].'';
						
						else
						$ceremony_info ='<br/>'.$person ['_ceremony_date'].'';
						
					//end of new code
						
						//do i create the order way up top when i am defining the order variable  so I can h4 the ceremony number vs the ceremony date -- NO i think it goes here
						
						
						}
						
						
						if(!isset($_died{0})) //if there is NULL in the field i.e. it's not isset, the person is alive, if it was isset there would be a date in that field
						
						$_died = 'N/A';
						
						$birth_city = $person ['birth_city'];
						$birth_state = $person ['birth_state'];
						$birthplace = htmlentities($birth_city.', '.$birth_state);
						
						/*added separate month day and year in tables and as variables to solve date issues and make it sortable by month day and year*/
						
							
							$full_name= _encode_to_fix_accented(htmlentities($person['name']));
							
						if($_GET['legend']==4) //awards
						{
						$stats = '<div class="break">&nbsp;</div>Film: <a href="films.php?film_id='.$person['fid'].'&film_title='.urlencode($person['film_name']).'">'.$person['film_name'].'</a><br/><br/><a href="bio.php?person_id='.$person['id'].'&type='.$type.'">'.$full_name.'</a><br/>(as '.$person['role'].')<div class="break">&nbsp;</div>Award: '.$person['award_name'].'<br/>'.$person['year']. '<div class="break">&nbsp;</div>';
						}
						
						
						//new code here for graumans
						
						else //graumans
							
						if($_GET['legend']==6)
						{
						$stats = '<div class="break">&nbsp;</div><a href="bio.php?person_id='.$person['id'].'&type='.$type.'">'.$full_name.'</a><div class="break">&nbsp;</div>Graumans Chinese Theater<div class="break">&nbsp;</div>Footprints / Handprints Ceremony #: '.$person['ceremony_number'].'<div class="break">&nbsp;</div>Ceremony Date:<br/>'.$person['_ceremony_date']. '<div class="break">&nbsp;</div>';
						}
						
						//end of new code here for graumans
						
						else
						
						$stats = '<div class="break">&nbsp;</div>Birthname: <br/><a href="bio.php?person_id='.$person['id'].'&type='.$type.'">'._encode_to_fix_accented($birthname).'</a><div class="break">&nbsp;</div>Born: '.$_birthday.'<br/>'._encode_to_fix_accented($birthplace). '<div class="break">&nbsp;</div>Passed: '.$_died;

// before I used a br to create space between stats however Patrick created a small div in css that's 5px with a font for the nbsp at 0px the class of the div was break
						
				//you pulled all the info above, now you will show it in the div
					//see javascript below for thumb class instructions
					//bio picture class is part of this thumb div
					
						$folder = 'thumbs';
						
						
						
						echo '<div class="thumb" commonality="'.$person['id'].'">  
			
						<img src="'.getThumbnail($person['id'], $folder).'" border="0" title="'.$full_name.'" width="115" height="170" alt="'.$full_name.'" class="bio_picture '.$person['id'].'" align="left" id="th_'.$increment.'"/>
						
						<div class="stats '.$person['id'].'" id="stats_'.$increment.'"  style="display:none">'.$stats.'</div>
						<h4><a href="bio.php?person_id='.$person['id'].'&type='.$type.'">'.$full_name.'</a>'.$_year.$wof.$ceremony_info.'</h4>'; 
/*originally the img src size was width 115 not width 125*/

/*changed last three variables people to variable person; also closes thumb div*/				
			
						echo '</div>'; /*closes thumb*/						
										
						if( $i%$n_per_row == 0) //+ / * - %  //for a example 5%2 = 1
						echo '<div class="clear"> </div>';
						
				
						$i++;
				$increment++;
					}
				
					?>
				
				<!-- stats id in div = pop up stats for mouseover-->
						
				
				</div><!--closes main area-->
			
			</div><!--closes main, this is different than main area-->
			
			
			<?php include ("_footer.php"); ?>
		

		</div> <!--closes container-->
		
			
	<?php include("home_page_ad2.php"); ?>
	<script type="text/javascript">
$$(".segmenter").each(function(each_ddl)
{
each_ddl.observe("change", function(e)
{
//var _url=decodeURIComponent($F(each_ddl.id));
//alert(_url);
var _url=$F("url_current_for_sorting")+decodeURIComponent($F(each_ddl.id));

window.location.href=_url;
});
});
</script>
	<script src="scripts/stats_box.js" type="text/javascript"></script>
</html>
<?php
include("end_cache.php");
?>