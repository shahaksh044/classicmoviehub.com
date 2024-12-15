<?php

//print_r($_GET);exit;

$common_title='Classic Movie Hub (CMH)';

$common_meta='classic movie hub, CMH, classic movies, classic movie curator, love classic movies, fan favorite movies, classic films, movie hub, classic movie database, movies, films, actors, actresses, directors, producers, hollywood, classic cinema, old movies, golden age of hollywood, hollywood stars, hollywood icons, classic movie information';

if(isset($starting_letter{0}) and isset($ending_letter{0}))
$min_max='('.strtoupper($starting_letter).'-'.strtoupper($ending_letter).')';

if(isset($the_decade{0}))
$min_max='('.$the_decade.'&rsquo;s)';

if(isset($_GET['this_year']{0}))
$min_max='('.$_GET['this_year'].')';

if(isset($_GET['page']{0}))
$min_max='(p'.$_GET['page'].')';


$type_object='article';
$image_url='http://www.classicmoviehub.com/logo.jpg';


//die($script_processed);

switch($script_processed)
{
case "films.php":
{


print_r($_GET);exit;

//$film_id=$_GET['film_id'];
//$film_title=stripslashes(urldecode($_GET['film_title']));

$filter=$_GET['filter'];
$value=$_GET['value'];
$name=stripslashes(urldecode($_GET['name']));

//
$u_name=$_GET['u_name'];

//films
if( empty($u_name) and empty($filter))
{

//changed this
$prefix='Film Genres : ';

$meta_keywords='film genres, Action, Adventure, Animation, B-movies, Biography, Comedy, Crime, Drama, Epic, Family Films, Fantasy Films, Film Adaptation, Film noir, Historical Films, Horror Films, Musicals, Mystery, Lost Films, Public Domain Movies, Romance, Science Fiction, Movie Serials, Short Films, Silent Films, Talkies, Sports Movies, Thrillers, Suspense Films, War Movies, Westerns, World Cinema, Foreign Films';

$meta_desc='Browse over 20 Classic Movie Film Genres at Classic Movie Hub (CMH). In all, over 10,000 Movies to Explore, Rate and Share. Sort by Genres, Topics, Academy Awards, Decades and More.';

$description=$meta_desc;

}
else ////film/gone-with-the-wind-1939
if(isset($film_id{0}) and isset($film_title{0}))
{
$sql='select year, directors, producers from agatti_films where id='.$film_id;

$response=mysql_query($sql) or die(mysql_error());
$response_array=mysql_fetch_array($response);

$year=$response_array[0];
$wiki_summary=_encode_to_fix_accented($response_array[1]);

$description=substr(strip_tags($wiki_summary), 0, 200);
$image_url='http://www.classicmoviehub.com/images/films/'.$film_id.'.jpg';

$_extra_title_array=array("genre"=>"", "topic"=>"Topic: ", "decade"=>"from ", "award"=>""); 

$_extra_title="";

if(isset($filter{0}) and isset($name{0}))
{

$_name_=$name;
if($filter=="decade")
$_name_=strtolower($name);

$_extra_title = " (".$_extra_title_array[$filter]."".$_name_.")";
}


//$prefix=$film_title.' ('.$year.') '.$_extra_title.'- Synopsis, Cast, Directors, Producers: ';

$prefix=$film_title.' ('.$year.') : ';

$directors=str_replace("*", ", ", $response_array['directors']);
$producers=str_replace("*", ", ", $response_array['producers']);

$sql_actors='select person_name from agatti_cast where film_id='.$film_id.'  order by id asc limit 0,8';

$req_actors=mysql_query($sql_actors) or die(mysql_error());

$actors='';
while($array_actors=mysql_fetch_array($req_actors))
$actors .= $array_actors['person_name'].', ';

$actors=trim($actors);

$meta_keywords=$film_title.','.$directors.','.$producers.', '.$actors.' synopsis, plot summary, featured cast';

$meta_desc=$film_title.' ('.$year.') - Directed by '.$directors.', produced by '.$producers.' and starring '.$actors.'and more...';

$type_object='video.movie';

}




else
////films/genre/comedy
if(isset($filter{0}) and isset($u_name{0}))
{

//$filter_name=$filters_list[$filter];

//get the name of the filter using its u_name/// we call it filter_name

if(($filter != "decade") and ($filter != "user"))
{

if($filter == "award")
$sql_filter_name='select agatti_awards.id, agatti_awards.name, agatti_festivals.short_name as fest_name from agatti_awards, agatti_festivals where agatti_awards.u_name="'.$u_name.'" and agatti_awards.festival_id=agatti_festivals.id';

else

$sql_filter_name='select id, name from '.$tb_filter_singular[$filter].' where u_name="'.$u_name.'"';

$response_filter_name=mysql_query($sql_filter_name) or die(mysql_error());

$array_filter_name=mysql_fetch_assoc($response_filter_name);
$filter_value_name=$array_filter_name['name'];

if(!empty($array_filter_name['fest_name']))
{
$filter_value_name = $filter_value_name.' '.$array_filter_name['fest_name'];
}


//die($sql_filter_name."<hr/>");
}
else
{


$filter_value_name=$u_name;

//die("here<br/>".$filter_value_name);
}


$title_name=$filter_value_name;
$desc_name=$filter_value_name.' Movies';

if($filter == "decade")
{
$title_name=$title_name."'s";//str_replace("The ", "", $title_name."'s");
$desc_name= "Movies From ".$filter_value_name;
}

if($filter == "user")
{
$title_name=$title_name."'s Film Ratings ";//str_replace("The ", "", $title_name."'s");
$desc_name= "Film Ratings From ".$filter_value_name;

//get rater_user_id
//this is only need because we might allow the public to see a user's film ratings

$sql_rater_user_id='select id from agatti_visiters where username="'.$u_name.'"';

$response_rater_user_id=mysql_query($sql_rater_user_id) or die(mysql_error());

$array_rater_user_id=mysql_fetch_row($response_rater_user_id);
$rater_user_id = $array_rater_user_id[0];

//var_dump($rater_user_id);exit;
}


$prefix=$title_name.' Movies '.$min_max.' : ';


$meta_keywords='classic '.$title_name.' movies';

$meta_desc='Browse Classic '.$desc_name.' at Classic Movie Hub (CMH). Explore your favorites by titles, decades and more.';

$description=$meta_desc;

/*
//what is special about awards or them to singled out?

else if($filter=="award")
{

$prefix=$name.' - Academy Award Winning Films '.$min_max.' : ';

//added this  THIS IS APPEARING IN THE WRONG PLACE
$meta_keywords=$name.' Academy Award Winning Films, Oscars';

$meta_desc='Browse '.$name.' Academy Award Winning Films at Classic Movie Hub (CMH).';

$description=$meta_desc;

}
*/


}


}
break;



case "blog_hub.php":
{

//print_r($_GET);exit;

//$name=stripslashes(urldecode($_GET['name']));



if(!empty($_GET['source']))
{
$prefix='Articles from '.$name.' '.$min_max.' : ';
$meta_desc='Discover, Rate and Share your Favorite Blog Posts from '.$name.' '.$min_max.' at Classic Movie Hub';
}

else if(!empty($_GET['holiday']))
{
$prefix='Articles about '.$name.' '.$min_max.' : ';
$meta_desc='Discover, Rate and Share your Favorite Blog Posts from '.$name.' '.$min_max.' at Classic Movie Hub';
}

else if(!empty($_GET['person']))
{
$prefix='Articles on '.$name.' '.$min_max.' : ';
$meta_desc='Discover, Rate and Share your Favorite Blog Posts from '.$name.' '.$min_max.' at Classic Movie Hub';
}

else if(!empty($_GET['film']))
{
$prefix='Articles about '.$name.' '.$min_max.' : ';
$meta_desc='Discover, Rate and Share your Favorite Blog Posts from '.$name.' '.$min_max.' at Classic Movie Hub';
}

else

{
$prefix='Classic Movie BlogHub '.$min_max.' : ';
$meta_desc='Discover, Rate and Share your Favorite Blog Posts from the Best Classic Movie Bloggers '.$min_max.' at Classic Movie Hub';
}




$meta_keywords='Classic movie bloghub top rated blogs';


$description=$meta_desc;

}
break;

case "travel.php":
{
$filter=$_GET['filter'];

$type=$_GET['type'];
$u_name=$_GET['u_name'];


//Films adapted from literary sources



if (!empty($filter))
{
$_filter_=$array_filter[$filter];

if($filter=="other")
$_filter_="Churches, Theaters and More";


$meta_keywords='classic movie travel sites '.$_filter_;

$meta_desc='Browse Classic Movie Travel Sites ('.$_filter_.') at Classic Movie Hub';


$prefix='Classic Movie Travel Sites ('.$_filter_.') : ';
}

else if (!empty($type))
{
if ($type == "star")
{


$meta_keywords = $the_object_name.' classic movie travel sites';

$prefix='Classic Movie Travel Sites about '.$the_object_name.' : ';


$meta_desc = $prefix;

//'Read about '.$name.' ('.$array_filter_singular[$filter].') at Classic Movie Hub';
}
else
if ($type == "film")
{


$meta_keywords = $the_object_name.' classic movie travel sites';

$prefix='Classic Movie Travel Sites about '.$the_object_name.' : ';


$meta_desc = $prefix;

//'Read about '.$name.' ('.$array_filter_singular[$filter].') at Classic Movie Hub';
}




}

else if (!empty($u_name))
{


$meta_keywords='classic movie travel sites '.$the_object_name;

$meta_desc='See '.$the_object_name.' and browse many other Classic Movie Travel Sites at Classic Movie Hub';


$prefix= $the_object_name.' - Classic Movie Travel Sites : ';
}

else {
$prefix='Classic Movie Travel Sites : ';

$meta_keywords='classic movie travel sites museums, statues, birth places, homes, theaters, studios, churches, film locations';

$meta_desc='Browse Classic Movie Travel Sites Including Museums, Film locations, Statues, Birth places, Homes, Theaters, Studios, Churches and More  at Classic Movie Hub';
}

$description=$meta_desc;


}
break;

case "database.php":
{

//the initial state
if(!isset($_GET['opt']{0}))
{

$meta_keywords='Classic Movie Hub DataBase CMHDB';

$meta_desc="You can search Classic Movie Hub's massive Database to Find Actor and Actress Birth Dates, Death Dates and More.";

}

if(isset($_GET['opt']{0}))
{

//print_r($objects);
//$object=array_search($_GET['opt'], $objects);

//$all_objects=$objects[$_GET['opt']];

$object='';

foreach($objects as $key_object=>$each_object)
{
//$object=array_search($_GET['opt'], $each_object);

if(in_array($_GET['opt'], $each_object))
{
$object=$key_object;
break;
}
}


//die("lol=".$object);

$prefix = $array_title_tags[$_GET['opt']].' : ';

$meta_keywords='Classic Movie Hub DataBase CMHDB';

$meta_desc="You can search Classic Movie Hub's massive Database to Find ".$object_in_meta[$object]." ".$object_in_meta_filters2[$_GET['opt']]." by ".$array_label_suffix[$_GET['opt']]."  and More.";
}


if(isset($_GET['obj']{0}))//people, films
{

//Classic movie Start Born on xyz
//
$prefix = $first_label[$_GET['opt']]." ".$array_label_active[$_GET['opt']]." ".$_GET[$_GET['opt']].' : ';


$meta_keywords='Classic Movie Hub DataBase CMHDB';

$meta_desc='See '.$first_label[$_GET['opt']]." ".$array_label_active[$_GET['opt']]." ".$_GET[$_GET['opt']].' at Classic Movie Hub Database (CMHDB).';
}

$description=$meta_desc;

}
break;

case "books.php":
{

$filter=$_GET['filter'];
$value=$_GET['value'];
$name=stripslashes(urldecode($_GET['name']));

$books_array_titles=array("novel"=>"Books made into Films", "short_story"=>"Magazine Articles made into Films", "play"=>"Plays made into Films", "biography"=>"Biographies made into Films", "newspaper"=>"Newspaper Articles made into Films", "other"=>"Comics, Poems and More made into Films", "all"=>"Literary Works made into Films");

//Films adapted from literary sources

//die($filter."<hr/>");


if (!isset($filter{0}))//we show all the thumbs
{
$prefix= 'Film Adaptations : ';

$meta_keywords='classic movie film adaptations from books, plays, magazines, biographies, comics, newspapers';

$meta_desc='Browse Classic Movie Film Adaptations from Books, Plays, Magazines, Biographies, Comics, Newspapers and More at Classic Movie Hub';

}
else
if (isset($filter{0}))
{

//$prefix= $books_array_titles[$filter].' (Film Adaptations) : ';

$_filter_=$array_filter[$filter];

if($filter=="other")
$_filter_="Comics, Poems and More";


$prefix= $books_array_titles[$filter].' (Film Adaptations) : ';


$meta_keywords='classic movie film adaptations from '.$_filter_;

$meta_desc='Browse Classic Movie Film Adaptations from '.$_filter_.' at Classic Movie Hub';
}


if (!empty($_GET['u_name']))//each literary
{

$u_name=$_GET['u_name'];

$sql_u_name='select name, type from agatti_literary where u_name="'.$u_name.'"';
$response_u_name=mysql_query($sql_u_name) or die(mysql_error());

$array_u_name=mysql_fetch_row($response_u_name);

$filter=$array_u_name[1];//mysql_fetch_row($response_u_name);


$prefix=$array_u_name[0].' ('.$array_filter_singular[$filter].' made into film) : ';

$meta_keywords=$array_filter_singular[$filter].' '.$name.' classic movie film adaptations';


$meta_desc='Read about the Classic Movie Adaptation from the '.$array_filter_singular[$filter].' '.$name.' at Classic Movie Hub';
}


$description=$meta_desc;

}
break;

case "facts.php":
{

$big_filter=$_GET['_filter'];
if(empty($big_filter))
$big_filter="topics";

$big_filter_=$big_filter;//create a copy of big_filter

$preposition='by';

if($big_filter=="people")
{
$big_filter_="Actors and Actresses";
$preposition='about';
}

/*
if(empty($topic) and !empty($_GET['topic']))
$topic=$_GET['topic'];
*/

if(empty($topic_id) and !empty($_GET['topic_id']))
$topic_id=$_GET['topic_id'];

if(empty($filter) and !empty($_GET['filter']))
$filter_name=$_GET['filter'];

if(empty($order) and !empty($_GET['order']))
{
$order_name_=$_GET['order'];
//die("<br/>oopsw".$order_name_."<hr/>".$_GET['order']);
}

if(isset($order_name_{0}))
{
$order_name_= 'by '.$facts_array[$topic]["sorters"][$order_name_];
//die("oops>".$topic);
}

$array_bad_topics=array("sgt_pepper", "knights", "military");

if(in_array($topic, $array_bad_topics))
{
$filter_name=$facts_array[$topic]["filters"][$filter_name];
}
else
if(isset($filter_name{0}))
$filter_name= ucfirst($filter_name);

$dash='';
if(isset($order_name_{0}) or isset($filter_name{0}))
$dash=' - ';

if(isset($big_filter{0}) and !isset($topic_id{0}) )
$prefix='Facts '.$preposition.' '.ucfirst($big_filter_).' '.$order_name.' '.$min_max.' : ';

else
{
if(isset($topic_id{0}))
{
$sql='select name from agatti_facts_topics where id='.$topic_id;
$response=mysql_query($sql) or die(mysql_error());
$response_array=mysql_fetch_row($response);
$name=$response_array[0];
}

//note NOT consistent with Quotes title tags (by person vs by people; by film vs by films; by topic vs by topics
$prefix = $filter_name.' '.$order_name_.$dash.$name.' - Classic Movie Actors and Actresses'.$min_max.' : ';
}


$meta_keywords=trim("Classic Movie ".$prefix, ': ');

//facts for films and people

if(isset($big_filter{0}))
$meta_desc='Browse Fun Facts and Trivia '.$preposition.' '.$big_filter_.' '.$min_max.' at Classic Movie Hub (CMH).';

else
$meta_desc='Browse Fun Facts and Trivia about '.$name.' '.$min_max.' at Classic Movie Hub (CMH).';


//facts by topics
if(isset($facts_array[$topic]["meta"]{0}))
{
$meta_desc=$facts_array[$topic]["meta"];
}

$description=$meta_desc;//for OG facebook
}
break;

case "facts_films_people.php":
{
$name=stripslashes(urldecode($_GET['name']));
$key=$_GET['key'];
$value=$_GET['value'];

$prepositions=array("person"=>"about", "film"=>"about");

if($key=="film")
$prefix='Facts '.$prepositions[$key].' &quot;'.$name.'&quot; '.$min_max.' : ';
else
$prefix='Facts '.$prepositions[$key].' '.$name.' '.$min_max.' : ';

$meta_keywords=trim("Classic Movie ".$prefix, ': ');

//facts for films and people

$meta_desc='Browse Fun Facts and Trivia about '.$name.' '.$min_max.'
 at Classic Movie Hub (CMH).';


}
break;

//deleted the word Browse on all of the below; replaced with Classic Movie

case "films_awards.php":
{

if(!isset($_GET{0}))
{
$prefix='Academy Awards : ';
}

$meta_keywords='Academy Awards, Oscars, Academy Award for Best Picture, Academy Award for Best Director, Academy Award for Best Actress, Academy Award for Best Actor, Academy Award for Best Supporting Actor, Academy Award for Best Supporting Actress';

$meta_desc='Browse Academy Awards at Classic Movie Hub (CMH). Sort and Explore Movies by Best Picture, Best Director, Best Actor, Best Actress, Best Supporting Actor, Best Supporting Actress, Titles and Decades.';

$description=$meta_desc;

}
break;

case "user_profile.php":
{
$prefix= $username."'s profile : ";

$meta_keywords= $username.' public user profile, Classic Movie Hub user profile';

$meta_desc= $username.' Classic Movie Hub public user profile';

$description=$meta_desc;
}
break;

case "films_topics.php":
{

if(!isset($_GET{0}))
{
$prefix='Film Topics : ';
}

$meta_keywords='Classic Movie Film Topics';

$meta_desc='Browse over 150 Classic Movie Topics at Classic Movie Hub (CMH). Explore, Rate and Share over 10,000 Movies. You can sort by Genres, Topics, Academy Awards, Decades and More.';

$description=$meta_desc;

}
break;

case "films_decades.php":
{

if(!isset($_GET{0}))
{
$prefix='Film Decades : ';
}

$sql_decades='select concat("19", substr(year, 3, 1), "0") as decade from agatti_films where active=1 group by decade';

$response_decades=mysql_query($sql_decades) or die(mysql_error());

$decades='';

while($array_decades=mysql_fetch_array($response_decades))
{
$decades .= $array_decades['decade']."'s, ";
}

//$decades=trim($decades, ", ");

$meta_keywords='Films from '.$decades.' golden age of hollywood';

$meta_desc='Browse Classic Movies by Decades at Classic Movie Hub (CMH).';

$description=$meta_desc;

}
break;

case "quotes_films.php":
{

if(!isset($_GET{0}))
{
//$prefix='Browse Film Quotes : ';
$prefix='Classic Movie Quotes by Film '.$order_name.' '.$min_max.' : ';
}

$meta_keywords='Memorable Quotes by Film, Gone With The Wind, Captain Blood, Wuthering Heights, The Black Swan, The Ten Commandments, Pride and Prejudice ';

$meta_desc='Browse Thousands of Memorable Movie Quotes categorized by Film at Classic Movie Hub (CMH).';

$description=$meta_desc;
}
break;

case "quotes_persons.php":
{

if(!isset($_GET{0}))
{
$prefix='Classic Movie Quotes by Actors & Actresses '.$order_name.' '.$min_max.' : ';
}

$meta_keywords='Film Quotes by Actors & Actresses, Clark Gable, Vivien Leigh, Tyrone Power, Olivia DeHavilland, Bette Davis, Gary Cooper, Audrey Hepburn, Katharine Hepburn, Cary Grant, Spencer Tracy, Joan Crawford, Eric Blore, Edward Arnold, Charlie Chaplin';

$meta_desc='Browse Thousands of Memorable Film Quotes categorized by Actors and Actresses at Classic Movie Hub (CMH).';

$description=$meta_desc;

}
break;

case "quotes_topics.php":
{

if(!isset($_GET{0}))
{
$prefix='Classic Movie Quotes by Topic : ';
}



$meta_keywords='Memorable Film Quotes by Topic';

$meta_desc='Browse Thousands of Memorable Film Quotes categorized by over 150 Topics at Classic Movie Hub (CMH).';

$description=$meta_desc;
}
break;



case "quotes.php":
{

$prepositions=array("person"=>"by", "topic"=>"about", "film"=>"from");
$images_folder=array("person"=>"films", "topic"=>"thumbs", "film"=>"thumbs");
$images_query=array("person"=>"film_id", "topic"=>"person_id", "film"=>"person_id");

$u_name=$_GET['u_name'];

$key=$_GET['key'];

if(isset($_GET['q_id']{0}))
{
$q_id=preg_split('/_/', $_GET['q_id']);
$q_id=trim($q_id[1]);

$sql='select quote, '.$images_query[$key].' from agatti_quotes where id='.$q_id;
$response=mysql_query($sql) or die(mysql_error() ."<br/>".$sql);
$response_array=mysql_fetch_row($response);

$description=substr(strip_tags($response_array[0]), 0, 400);
}

//$prefix= $array_filter[$legend].' '.ucfirst($type).' by '.ucfirst($order).' Name '.$min_max.' : ';

//change film to classic movie

if(!empty($u_name))
{


//die($key);

if($key=="film")
{
$sql_u_name='select name, year from agatti_films where u_name="'.$u_name.'"';

$response_u_name=mysql_query($sql_u_name) or die(mysql_error());

$array_u_name=mysql_fetch_assoc($response_u_name);

$name=$array_u_name['name'].' ('.$array_u_name['year'].')';
}
else if($key=="person")
{
$sql_u_name='select name from agatti_people where u_name="'.$u_name.'"';

$response_u_name=mysql_query($sql_u_name) or die(mysql_error());

$array_u_name=mysql_fetch_assoc($response_u_name);

$name=$array_u_name['name'];//.' ('.$array_u_name['year'].')';

}

else if($key=="topic")
{

//echo "opo<br/>";

$sql_u_name='select name from agatti_quotes_topics where u_name="'.$u_name.'"';

//die($sql_u_name);

$response_u_name=mysql_query($sql_u_name) or die(mysql_error());

$array_u_name=mysql_fetch_assoc($response_u_name);

$name=$array_u_name['name'];//.' ('.$array_u_name['year'].')';

}


//echo $name.'<hr/>';exit;
}

if($key=="film")
{
$prefix='Film Quotes from '.$name.' '.$min_max.' : ';
}

else
$prefix='Film Quotes '.$prepositions[$key].' '.$name.' '.$min_max.' : ';


//$prefix='Classic Movie Quotes '.$prepositions[$key].' '.$name.' '.$min_max.' : ';



if(isset($images_folder[$key]{0}))
{
$_img_path='images/'.$images_folder[$key].'/'.$response_array[1].'.jpg';

if(is_file($_img_path) and filesize($_img_path)>0 )
$image_url='http://www.classicmoviehub.com/'.$_img_path;
else
$image_url='http://www.classicmoviehub.com/logo.jpg';

}
else
$image_url='http://www.classicmoviehub.com/logo.jpg';//for topic

$meta_keywords=trim($prefix, ': ');

$meta_desc='Browse Memorable Film Quotes '.$prepositions[$key].' '.$name.' '.$min_max.' at Classic Movie Hub (CMH).';

//$description=$meta_desc;
}
break;

case "graumans.php":
{

//print_r($_GET);exit;

$sorting_array = array('first-name'=>'First Name', 'last-name'=>'Last Name', 'ceremony-number'=>'Ceremony Number', 'ceremony-date'=>'Ceremony Date');

$sorting_array_for_title = array('first-name'=>'First Name', 'last-name'=>'Last Name', 'ceremony-number'=>'Ceremony Number', 'ceremony-date'=>'Ceremony Date', 'first'=>'First Name', 'last'=>'Last Name', 'ceremony_number'=>'Ceremony Number', 'ceremony_date'=>'Ceremony Date');


$order=$_GET['order'];
$filter=$_GET['filter'];
	
if(empty($order))
$order='last';//this is the default sort
				
if(!isset($filter{0}))
$filter="all"; //default

//var_dump($order);exit;

if($filter=="all")
$prefix= 'Browse by '.$sorting_array_for_title[$order].' - Grauman&rsquo;s Chinese Theater : ';

else

$prefix= 'Browse '.ucfirst($filter).' by '.$sorting_array_for_title[$order].' - Grauman&rsquo;s Hollywood Chinese Theater : ';

}
break;

case "wof.php":
{

$array_filter_for_title = array("all"=>"Stars", "actors"=>"Actors", "actresses"=>"Actresses", "directors"=>"Directors", "producers"=>"Producers", "hollywood-blvd"=>"Stars on Hollywood Blvd.", "vine-street"=>"Stars on Vine St.");


$array_filter = array("all"=>"All", "actors"=>"Actors", "actresses"=>"Actresses", "directors"=>"Directors", "producers"=>"Producers", "hollywood-blvd"=>"Hollywood Blvd.", "vine-street"=>"Vine St.");

$sorting_array = array('first-name'=>'First Name', 'last-name'=>'Last Name', 'star-address'=>'Star Address', 'category'=>'Category');

$sorting_array_for_title = array('first-name'=>'First Name', 'last-name'=>'Last Name', 'star-address'=>'Star Address', 'category'=>'Category', 'first'=>'First Name', 'last'=>'Last Name');


$order=$_GET['order'];
$filter=$_GET['filter'];
	
if(empty($order))
$order='last';//this is the default sort
				
if(!isset($filter{0}))
$filter="all"; //default

//if($filter=="all")
//$prefix= 'Browse by '.$sorting_array[$order].' - Hollywood Walk of Fame : ';

//else

if(isset($filter))
$prefix= 'Browse '.$array_filter_for_title[$filter].' ';


if(isset($order))
$prefix .= 'by '.$sorting_array_for_title[$order].' ';

$prefix .= '- Hollywood Walk of Fame : ';

//$prefix .= 'Browse '.$array_filter[$filter].' Addresses by '.$sorting_array[$order].' - Hollywood Walk of Fame : ';

}
break;


case "people.php":
{

//deleted browse replaced with classic movie


//var_dump($get_legend);exit;

$title_prefix=$array_filter[$get_legend];

if($get_legend == 4)
$title_prefix = 'Award Winning';

else if($get_legend == 5)
$title_prefix = 'Hollywood Walk of Fame';


if($order=="year")

$prefix= $title_prefix.' '.ucfirst($type).' ('.$_GET['the_decade'].'\'s) '.$min_max.' : ';

else

$prefix= $title_prefix.' '.ucfirst($type).' by '.ucfirst($order).' Name '.$min_max.' : ';

if(empty($get_legend))
$get_legend=0;

//die("lol ".$legend);
//min_max
//print_r($array_ranges);exit;

$limits=trim($min_max, '()');

$letters=explode("-", strtolower($limits));
//print_r($letters);
//
$min=$letters[0];
$max=$letters[1];

	if($get_legend==0)
				$mysql_legend=' and 1 '; 
				 //so if you show them all; equivalent to WHERE 1
				else if($get_legend==1)
				{
				$mysql_legend=' and legend=1';
				}
				else if($get_legend==2)
				{
				$mysql_legend=' and character_=1';
				}
				else if($get_legend==3)
				{
				$mysql_legend=' and supporting=1';
				}
				else if($get_legend==7)
				{
				$mysql_legend=' and silent=1';
				}
				else if($get_legend==5)//wof
				$mysql_legend=' and legend=1';
				
				//die('<hr/>'.$mysql_legend);

$sql_people='select name from agatti_people where active=1  '.$mysql_legend.' and  (';

//echo $sql_people.'<hr/>';

for($letter_number=ord($min); $letter_number<=ord($max); $letter_number++)
{

$letter=chr($letter_number);

$sql_people .= ' substr(last_name, 1,1) ="'.$letter.'" or ';

}

//echo $sql_people.'<hr/>';

$sql_array=reverseDefaultJob($type);

//print_r($sql_array);exit;

$sql_parameters = ' and ';
foreach($sql_array as $field_name=>$field_value)
{
$sql_parameters .= ' '.$field_name.'="'.$field_value.'" and ';
}

//echo $sql_parameters.'<hr/>';//exit;

$sql_parameters = substr($sql_parameters, 0, strlen($sql_parameters)-4);

if($legend != "4" and $legend !="6") //graumans and award winners
{


$sql_people = substr($sql_people, 0, strlen($sq_people)-3).') ';

$sql_people = preg_replace('/ and\)/', ' ', $sql_people);

$sql_people .= $sql_parameters.' limit 0, 40';

//echo $sql_people.'<hr/>';exit;

$response_people=mysql_query($sql_people) or die(mysql_error()." <br/>".$sql_people);


$people='';

while($array_people=mysql_fetch_array($response_people))
{
$people .= mb_convert_encoding(stripslashes($array_people['name']), "UTF-8").', ';
}

$people=trim($people, ', ');

$meta_desc='Browse Classic Movie '.$array_filter[$legend].' '.ucfirst($type).' at Classic Movie Hub (CMH).';

}
else if($legend == "4")//awards winners
{
$people='Lionel Barrymore, Humphrey Bogart, Walter Brennan';// add award winners here

$meta_desc="Browse Academy Award Winning Classic Movie ".ucfirst($type)." at Classic Movie Hub (CMH).";
}
else if($legend == "6")//Graumans 
{
//
$people='Bud Abbott, Don Ameche, Julie Andrews, Edward Arnold, Fred Astaire, Charlie Chaplin, Lou Costello, Irene Dunne, Doris Day, Gary Cooper, Bing Crosby, Jean Harlow, Bob Hope, Jack Lemmon, Shirley MacLaine, Dean Martin, Tom Mix, Marilyn Monroe, Mary Pickford, George Raft, Ginger Rogers, Norman Shearer, Elizabeth Taylor, Shirley Temple, John Wayne';//add graumans 

$meta_desc="Browse Classic Movie ".ucfirst($type)." with Footprints or Handprints at Hollywood's Grauman's Chinese Theater at Classic Movie Hub (CMH).";
}


$meta_keywords='Classic Movie '.$array_filter[$legend].' '.ucfirst($type).' '.$people;



$description=$meta_desc;
}
break;


case "list.php":
{
//$list_id=$_GET['list_id'];


$thumbs_folders=array("agatti_people"=>"thumbs", "agatti_films"=>"films", "agatti_cast"=>"thumbs");

$sql='select name, description, cat_table, items from agatti_lists where u_name="'.$u_name.'"';

$response=mysql_query($sql) or die(mysql_error());
$response_array=mysql_fetch_array($response);

//print_r($response_array);exit;

$prefix= _encode_to_fix_accented($response_array['name']).' : ';
$description=_encode_to_fix_accented($response_array['description']);
$cat_table=$response_array['cat_table'];



$items=explode(",", $response_array['items']);
$item=$items[0];


if($cat_table=="agatti_cast")
{
$sql_='select person_id from agatti_cast where id='.$item;

$response_=mysql_query($sql_);// or die(mysql_error());
$response_array_=mysql_fetch_array($response_);

$folder='thumbs';

$image_url="http://www.classicmoviehub.com/".getThumbnail($response_array_['person_id'], $folder);
				
}
else
{
$folder=$thumbs_folders[$cat_table];
				
$image_url="http://www.classicmoviehub.com/".getThumbnail($item, $folder);
}

}
break;

case "bio.php":
{

//$person_id=$_GET['person_id'];

$sql='select id, name, gender, default_job, DATE_FORMAT(birthday, "%b %e, %Y") as _birthday, DATE_FORMAT(died, "%b %e, %Y") as _died from agatti_people where id='.$person_id;

$response=mysql_query($sql) or die(mysql_error());
$response_array=mysql_fetch_array($response);



//

$job_verb='';

/*
if(isset($_GET['type']{0}))
$type=$_GET['type'];
else*/

if(empty($type))
$type=getDefaultJob($response_array['id'], $response_array);


$type_part_of_the_title='';

if(isset($type{0}))
{
$type_part_of_the_title=' ('.ucfirst(singularJob($type)).') ';
}

$prefix= _encode_to_fix_accented($response_array['name']).' : ';

//.$type_part_of_the_title.' Overview - Biography, Filmography and More : ';

//die("lol ".$type);

if($type=="actors" or $type=="actresses" )
{
$job_verb='starred in';
} else if($type=="directors")
{
$job_verb='directed';
}
else if($type=="producers")
{
$job_verb='produced';
}
//actress
$stats_job=preg_replace("/(s|es)$/", "", ucfirst($type));
//getting the filmography
$films='';

if($type=="actors" or $type=="actresses" )
{
$sql_films='select film_name from agatti_cast where person_id='.$response_array['id'].' limit 0, 10';
}

else 
{
//die("oops<br/>");
//$sql_films='select film_name from agatti_films where 1';

if(!empty($type))
$sql_films='select name as film_name from agatti_films where '.$type.' like "%'.$response_array['name'].'%" limit 0, 10';

else
$sql_films='select film_name from agatti_films where 0 limit 0, 1';



//die($sql_films);

}


$req_films=mysql_query($sql_films) or die(mysql_error()."<br/>".$sql_films);


while($array_films=mysql_fetch_array($req_films))
{
$films .= stripslashes($array_films['film_name']).', ';
}

$films=trim($films, ' ,');

$meta_keywords=$response_array['name'].' classic movie '.$stats_job.' '.$films;

$wiki_summary=_encode_to_fix_accented($response_array['wiki_summary']);

$type_object='video.movie';
$description=$stats_job.' '.$response_array['name'].', born on '.$response_array['_birthday'].'';//substr(strip_tags($wiki_summary), 0, 200);

if(isset($response_array['_died']{0}))
$description .= ' and died on '.$response_array['_died'];

$description  .= ' '.$job_verb.' '.$films;

$meta_desc=$description;
$image_url='http://www.classicmoviehub.com/images/thumbs/'.$person_id.'.jpg';

$image_secure_url='https://trialclassic.jolome.com/thumbs/'.$person_id.'.jpg';

}
break;

case "about.php":
{

$prefix='About : ';

}
break;

case "blog_hubber.php":
{

$prefix=substr($title, 0, 43).' : ';

$meta_keywords='Classic movie bloghub top rated blogs';

$meta_desc='Read, Rate and Share the Classic Movie Blog Post "'.$title.'"';

$description=$meta_desc;

}
break;

case "login.php":
{

$prefix='Log In : ';

}
break;

case "join.php":
{

$prefix='Join : ';

}
break;

case "event.php":
case "events.php":
{


$event_u_name=$_GET['event_u_name'];
//$event_name=$_GET['name'];
//$venue_name=$_GET['venue_name'];
$venue_u_name=$_GET['venue_u_name'];
$event_state_u_name=$_GET['state_u_name'];
$event_city_u_name=$_GET['city_u_name'];
$event_type_u_name=$_GET['type_u_name'];
$event_country_u_name=$_GET['country_u_name'];


//print_r($_GET);exit;


unset($_GET['from']);unset($_GET['cache']);

if( count($_GET) <=0 )
{
//main page for Events
$prefix='Classic Movie Event Calendar : ';
}

else if(!empty($event_u_name))
{

//get the city, event_type for this event

$sql_single_event='select agatti_events.name as event_name, agatti_event_venues.city, agatti_event_types.name as event_type_name from agatti_events, agatti_event_venues, agatti_event_types where agatti_events.u_name="'.$event_u_name.'" and agatti_events.venue_id=agatti_event_venues.id and agatti_event_types.id=agatti_events.event_type_id';

$response_single_event = mysql_query($sql_single_event);

$array_single_event=mysql_fetch_assoc($response_single_event);

$prefix=$array_single_event['event_name'].' in '.$array_single_event['city'].' ('.$array_single_event['event_type_name'].') : ';

}
else
{

//show events by state
 if(!empty($event_city_u_name) and !empty($event_state_u_name) )
{
$sql_events_by_type='select states.name as state_name, cities.name as city_name  from  states, cities where states.u_name= "'.$event_state_u_name.'" and cities.u_name="'.$event_city_u_name.'"';

//die($sql_events_by_type);


$response_events_by_type = mysql_query($sql_events_by_type);

$array_events_by_type=mysql_fetch_assoc($response_events_by_type);

$prefix='Classic Movie Events in '.$array_events_by_type['city_name'].', '.$array_events_by_type['state_name'].' : ';

}


//show events by state
else  if(!empty($event_state_u_name))
{


$sql_events_by_type='select states.name as state_name, country_id  from  states where states.u_name= "'.$event_state_u_name.'"';

//die($sql_events_by_type);

$response_events_by_type = mysql_query($sql_events_by_type);

$array_events_by_type=mysql_fetch_assoc($response_events_by_type);

$prefix='Classic Movie Events in '.$array_events_by_type['state_name'].', '.strtoupper($array_events_by_type['country_id']).' : ';

}

//show events by country
else if(!empty($event_country_u_name))
{
$sql_events_by_type='select name from  country where u_name="'.$event_country_u_name.'"';

$response_events_by_type = mysql_query($sql_events_by_type);

$array_events_by_type=mysql_fetch_assoc($response_events_by_type);

$prefix='Classic Movie Events in '.$array_events_by_type['name'].' : ';
}



//show events by type
else if(!empty($event_type_u_name))
{
$sql_events_by_type='select agatti_event_types.name as event_type_name from  agatti_event_types where agatti_event_types.u_name="'.$event_type_u_name.'"';

$response_events_by_type = mysql_query($sql_events_by_type);

$array_events_by_type=mysql_fetch_assoc($response_events_by_type);

$prefix='Classic Movie Events ('.$array_events_by_type['event_type_name'].') : ';
}

//show events by venue
else if(!empty($venue_u_name))
{
$sql_events_by_type='select agatti_event_venues.name as event_venue_name from  agatti_event_venues where agatti_event_venues.u_name="'.$venue_u_name.'"';

$response_events_by_type = mysql_query($sql_events_by_type);

$array_events_by_type=mysql_fetch_assoc($response_events_by_type);

$prefix='Classic Movie Events at '.$array_events_by_type['event_venue_name'].' : ';
}

}

}
break;

case "chart.php":
{
//print_r($_GET);exit;

$type=$_GET['type'];
$u_name=$_GET['u_name'];

if($type == "best-all-time-classic-movies")
{
$prefix='Top 100 All Time Classic Movies - Movie Charts : ';

}
else if($type == "decade")
{
$prefix='Top 100 Classic Movies of the '.$u_name.'’s - Movie Charts : ';

}
else if($type == "topic")
{
$prefix='Top Classic '.$object_name.' Movies - Movie Charts : ';
}
else if($type == "genre")
{
$prefix='Top 100 Classic '.$object_name.' Movies - Movie Charts : ';
}

}
break;

case "charts.php":
{

//print_r($_GET);exit;

$__obj_=$_GET['obj'];
$__name_=$_GET['name'];
$__value_=$_GET['value'];
$__type_=$_GET['type'];


if(empty($__type_))
$prefix='Best Movies - Top 100 Movie Charts : ';
else
{

if($__type_=='decade')
{
$prefix='Best 100 Movies from '.$__value_.'&rsquo;s : ';
}
else
if($__type_=='genre')
{

if(stripos($__obj_, "Film") === FALSE)
$__obj_ .= ' Movies';

$prefix='Best 100 '.$__obj_.' : ';
}
else
if($__type_=='topic')
{
$prefix='Best Movies about '.$__obj_.' : ';
}
else
if($__type_=='all_time')
{
$prefix='Best 100 Classic Movies of All Time : ';
}

}

/*if(!isset($__type_{0}))
{
if($__filter_=="all" or $__filter_=="")
$prefix='Top Classic Movie Charts : ';
else if($__filter_=="other")
$prefix='Other Classic Movie Charts : ';
else
$prefix='Top Classic Movie Charts by '.ucfirst($__filter_).': ';
}
else
{
if($__type_=="essentials" or $__type_=="topic")
$prefix='Top &quot;'.$__name_.'&quot; Classic Movie Charts : ';
else
$prefix='Top '.$__name_.' Classic Movie Charts : ';
}*/

}
break;

case "search.php":
{

$keywords=urldecode($_GET['q']);

$prefix='Search &quot;'.$keywords.'&quot; : ';

}
break;

default:{}

}

$meta .= '

<LINK REL="SHORTCUT ICON" HREF="favicon.png">
<meta name="title" content="'.$prefix.$common_title.'"/>

<meta name="keywords" content="'.$meta_keywords.'"/>

<meta name="description" content="'.$meta_desc.'"/>

<meta property="fb:app_id" content="207851312655126" />
<meta property="fb:admins" content="1082497677" />

<meta property="og:title" content="'.$prefix.$common_title.'"/>
    <meta property="og:type" content="'.$type_object.'"/>
    <meta property="og:url" content="http://www.classicmoviehub.com'.$_SERVER['REQUEST_URI'].'"/>
    <meta property="og:image" content="'.$image_url.'"/>
    <meta property="og:site_name" content="Classic Movie Hub - CMH"/>
    <meta property="og:description"
          content="'.$description.'"/>';

//$prefix=$.'-'.$_SERVER['SCRIPT_NAME']." : ";



if($script_processed=="blog_hubber.php")
$common_title='Classic Movie Hub (CMH)';
else
if($script_processed=="database.php")
$common_title='Classic Movie Hub DataBase (CMHDB) ';

?>

<title><?php echo $prefix.$common_title; ?></title>

<?php
//die("merde");
$page_enabled_for_json_rating=array("bio.php"=>1, "index.php"=>1, "films.php"=>array("filter", "f_u_name", "user"), "user_profile.php"=>1);

$page_enabled_for_json_blog_rating=array("blog_hub.php"=>1, "blog_hubber.php"=>1);
//

//print_r($page_enabled_for_json_rating);exit;

$enable_json_rating="false";

$enable_json_blog_rating="false";


if (isset($page_enabled_for_json_blog_rating[$script_processed]))
{

$value=$page_enabled_for_json_blog_rating[$script_processed];


//var_dump($value);exit;
//print_r($value);exit;

if($value==1)
{
$enable_json_blog_rating="true";
}
else if (is_array($value))
{
//die("ok");
$array_value=$value;

//print_r($array_value);

foreach($array_value as $each_url_argument)
{

//echo $each_url_argument.'<br/>';
if(isset($_GET[$each_url_argument]{0}))
{
$enable_json_blog_rating="true";
break;
}

}

}

}

if (isset($page_enabled_for_json_rating[$script_processed]))
{

$value=$page_enabled_for_json_rating[$script_processed];


//var_dump($value);exit;
//print_r($value);exit;

if($value==1)
{
$enable_json_rating="true";
}
else if (is_array($value))
{
//die("ok");
$array_value=$value;

//print_r($array_value);

foreach($array_value as $each_url_argument)
{

//echo $each_url_argument.'<br/>';
if(isset($_GET[$each_url_argument]{0}))
{
$enable_json_rating="true";
break;
}

}

}

}
//exit;

//script_processed
//
if(!isset($_SESSION['user_id'])) // if the person is not logged in
	{
	echo '<script type="text/javascript">var c_url="'.urlencode($_SERVER['REQUEST_URI']).'", _logged_in=false, enable_json_rating='.$enable_json_rating.', enable_json_blog_rating='.$enable_json_blog_rating.';</script>';
	}//using js here because instead of going to another page to login like on the people page, you want a popup window to appear asking people to login instead, so javascript creates that dynamically, you are using php in order to echo the javascript
	else
	{
	echo '<script type="text/javascript">var c_url="'.$script_processed.'", _logged_in=true, enable_json_rating='.$enable_json_rating.', enable_json_blog_rating='.$enable_json_blog_rating.';</script>';
	}
?>

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


<?php

//die('lol<br/>'.$_SERVER['REQUEST_URI']);
/*

if(stripos($_SERVER['REQUEST_URI'], "/final/") === FALSE)
{
//base with local 
echo '<base href="http://www.classicmoviehub.com/" />';
}

*/

include("canonical_url_maker.php");

?>

<base href="http://www.classicmoviehub.com/" />
