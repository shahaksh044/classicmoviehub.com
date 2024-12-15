<?php
if($_GET['opt']=="today")
{
header("HTTP/1.1 301 Moved Permanently");
header("Location:/database/births/month/".strtolower(date("F-j"))."/");exit;
}
$flipped_state_names = array_flip($state_names);
$month_variants=array('january'=>'Jan', 'february'=>'Feb', 'march'=>'Mar', 'april'=>'Apr', 'may'=>'May', 'june'=>'Jun', 'july'=>'Jul', 'august'=>'Aug', 'september'=>'Sep', 'october'=>'Oct', 'november'=>'Nov', 'december'=>'Dec');
$flipped_month_variants=array_flip($month_variants);
$actual_url=$_SERVER['REQUEST_URI'];
if( (stripos($actual_url, "database.php") !== FALSE) )
{
$dates_keys=array("dm", "dy", "bm", "by");
$watch_get=array("dm"=>array("/deaths/month", "agatti_topics"), "dy"=>array("/deaths/year", "agatti_genre"), "bm"=>array("/births/month", ""), "by"=>array("/births/year", ""));
$opt=$_GET['opt'];
if(!empty($_GET['opt']))
foreach($watch_get as $key=>$value_)
{
if($key == $opt)
{
$header_location = $value_[0];
if(!empty($_GET[$opt]))
{
$opt_value=$_GET[$opt];
//date attributes
if(in_array($opt, $dates_keys))
{
if(preg_match('/^\d+$/', $opt_value))
{
$header_location .= '/'.$opt_value;
}
else
{
$opt_values=explode(" ", $opt_value);
$header_location .= '/'.$flipped_month_variants[$opt_values[0]].'-'.$opt_values[1];
}
}
else //place attributes
{
}
}
header("HTTP/1.1 301 Moved Permanently");
header("Location:/database".$header_location);exit;
}
}
header("HTTP/1.1 301 Moved Permanently");
header("Location:/database/");exit;
}
else
{
$actual_url=trim(preg_replace('/\?(.*)$/i', '', $actual_url), '/');
$actual_url_parts=explode("/", $actual_url);
if($actual_url_parts[count($actual_url_parts)-1] == "today")
{
header("HTTP/1.1 301 Moved Permanently");
header("Location:/database/births/month/".strtolower(date("F"))."-".date("d"));exit;
}
}
$obj='';
if(isset($_GET['obj']{0}))
$obj=$_GET['obj'];
$opt='';
if(isset($_GET['opt']{0}))
$opt=$_GET['opt'];
function reformat_date($in_date)
{
$abbreviated_months=array('Jan'=>1, 'Feb'=>2, 'Mar'=>3, 'Apr'=>4, 'May'=>5, 'Jun'=>6, 'Jul'=>7, 'Aug'=>8, 'Sep'=>9, 'Oct'=>10, 'Nov'=>11, 'Dec'=>12);
$abbreviated_months=array_flip($abbreviated_months);
$in_date=trim($in_date, "%");
$date_sql='select DATE_FORMAT("'.$in_date.'", "%b %e, %Y") as full, DATE_FORMAT("'.$in_date.'", "%b %Y") as medium, DATE_FORMAT("'.$in_date.'", "%Y") as small ';
$sql_date='select DATE("'.$in_date.'")';
$req_date=mysqli_query($GLOBALS['connection'], $sql_date);
$array_date=mysqli_fetch_row($req_date);
$date_mysql=$array_date[0];
if(preg_match('/[0-9]{4}\-[0-9]{2}\-00/', $date_mysql))
{
$date_parts=explode("-", $date_mysql);
return 'in '.$abbreviated_months[intval($date_parts[1])].' '.$date_parts[0];
}
else //day and month unknown
if(preg_match('/[0-9]{4}\-00\-00/', $date_mysql))
{
$date_parts=explode("-", $date_mysql);
return 'in '.$date_parts[0];
}
else //full date is known
if(preg_match('/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/', $date_mysql))
{
$date_parts=explode("-", $date_mysql);
return 'on '.$abbreviated_months[intval($date_parts[1])].' '.$date_parts[2].', '.$date_parts[0];
}
return NULL;
}
?>
<?php echo "<?xml";?> version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
   <?php
   $object_in_meta=array("people"=>"Actors, Actresses, Directors and Producers", "films"=>"Films");
   $object_in_meta_filters=array("people"=>"Birth Dates, Death Dates", "films"=>"bla bala ");
     $object_in_meta_filters2=array("bm"=>"Birth Dates", "dm"=>"Death Dates", "dy"=>"Death Years", "by"=>"Birth Years");
     $objects=array("people"=>array("by", "dy", "dm", "bm"), "films"=>array("release_date", "release_year", "national_registry", "studio_name"));
$array_title_tags=array('by'=>'Browse Birth Dates By Year', 'bm'=>'Browse Birth Dates By Month', 'dy'=>'Browse Death Dates By Year', 'dm'=>'Browse Death Dates By Month', 'dp'=>'Browse Death Locations By City', 'ds'=>'Browse Death Locations By State or Country', 'bp'=>'Browse Birth Locations By City', 'bs'=>'Browse Birth Locations By State or Country');
$array_label_active=array('by'=>'Born in ', 'bm'=>'Born on ', 'dy'=>'Died in ', 'dm'=>'Died on ');    		
$array_label=array('by'=>'Born in ', 'bm'=>'Born on ', 'dy'=>'Died in ', 'dm'=>'Died on ', 'dp'=>'Died in ', 'ds'=>'Died in ', 'bp'=>'Born in ', 'bs'=>'Born in ');
$first_label=array('by'=>'Classic Movie Stars ', 'bm'=>'Classic Movie Stars ', 'dy'=>'Classic Movie Stars Who ', 'dm'=>'Classic Movie Stars Who '); 
$array_label_suffix=array('by'=>'year', 'bm'=>'month', 'dy'=>'year', 'dm'=>'month', 'dp'=>'city/state(country)', 'ds'=>'state(country)', 'bp'=>'city/state(country)', 'bs'=>'state(country)');
$years_opt=array("by", "dy");
$months_opt=array("bm", "dm");
$common_fields=array("people"=>array(
"bm"=>array('concat("^Born ", "%", birthday,"%", "^")', 'concat(" in ", birth_city,", ", birth_state)', 'concat("<br/>~Died ", "%", died, "%", "*in*", death_city,", ", death_state, "~")'), 
"by"=>array('concat("^Born ", "%", birthday,"%", "^")', 'concat(" in ", birth_city,", ", birth_state)', 'concat("<br/>Died ", "%", died, "%", "*in*", death_city,", ", death_state)'), 
"dm"=>array('concat("Born %", birthday, "%")', 'concat(" in ", birth_city,", ", birth_state)', 'concat("<br/>^Died %", died, "%", "^*in*", death_city,", ", death_state)'), 
"dy"=>array('concat("Born ", "%", birthday, "%")', 'concat(" in ", birth_city,", ", birth_state)', 'concat("<br/>^Died %", died, "% ^*in*", death_city,", ", death_state)'),
"bs"=>array('concat("Born %", birthday, "%")', 'concat(" in ", birth_city,", ", "^", birth_state,"^")', 'concat("<br/>Died %", died, "%", "*in*", death_city,", ", death_state)'),
"bp"=>array('concat("Born %", birthday, "%")', 'concat(" in ", "^",birth_city,", ", birth_state,"^")', 'concat("<br/>Died %", died, "%", "*in*", death_city,", ", death_state)'),
"ds"=>array('concat("Born %", birthday, "%")', 'concat(" in ", birth_city,", ", birth_state)', 'concat("<br/>Died %", died, "%", "*in*", death_city,", ", "^",death_state,"^")'),
"dp"=>array('concat("Born %", birthday, "%")', 'concat(" in ", birth_city,", ", birth_state)', 'concat("<br/>Died %", died, "%", "*in*", "^", death_city,", ",death_state,"^")'),
 ),
 "films"=>array());
$alternative_fields=array("dy_"=>"died", "dm_"=>"died", "by_"=>"birthday", "bm_"=>"birthday");
echo $meta;
?>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <?php require_once("css.php"); ?>
     <link href="/styles/jscal.css" type=text/css rel=stylesheet>
    <script type="text/javascript" src="/scripts/prototype.js"></script>
    <script type="text/javascript" src="/scripts/scriptaculous.js"></script>
<script type="text/javascript" src="/scripts/jscal.js"></script>
<script type="text/javascript" src="/scripts/en.js"></script>

<script type="text/javascript">
var months_={"january":31, "february":29, "march":31, "april":30, "may":31, "june":30, "july":31, "august":31, "september":30, "october":31, "november":30, "december":31};
function ucfirst_(str)
	{
	return  str.charAt(0).toUpperCase() + str.slice(1);
	}
	function _show_months(select_box)
	{
	var select_box=document.getElementById(select_box);
	for(month in months_)
	{
	var option=document.createElement("option");
	option.value=month;
	var month_upper=ucfirst_(month);
	option.appendChild(document.createTextNode(month_upper));
	select_box.appendChild(option);
	} 
	}
	</script>
	<style type="text/css">
	#preview{float:right;border:2px solid #000; background:#bff;padding:5px;height:auto;}
	#preview_container{float:right;width:430px;margin:5px auto; height:auto;}
	#preview #wish{margin-top:5px;padding-top:0;padding-left:0;margin-left:5px;}
	#message {/*width:250px;height:50px;*/float:left;width:250px;min-height:170px;}
	#sender_{float:right;padding-top:10px;}
	#thumbail_{float:left;margin:5px;margin-right:10px;width:115px;height:170px; background:url("images/thumbs/default.jpg") no-repeat;border:1px solid #aaa;}
	#message_{width:inherit;}
	#preview small{color:#aaa}
	#container_people{overflow:auto;max-height:200px}
	</style>
  </head>
    		<?php
$array_tables=array('people'=>'agatti_people', 'films'=>'agatti_films');
$array_db_field=array('by'=>'DATE_FORMAT(birthday, "%Y")', 'bm'=>'DATE_FORMAT(birthday, "%b %e")', 'dy'=>'DATE_FORMAT(died, "%Y")', 'dm'=>'DATE_FORMAT(died, "%b %e")', 'dp'=>array('death_city', 'death_state'), 'ds'=>'death_state', 'bp'=>array('birth_city', 'birth_state'), 'bs'=>'birth_state');
$array_db_order=array('by'=>'birthday', 'bm'=>'birthday', 'dy'=>'died', 'dm'=>'died', 'dp'=>'death_city', 'ds'=>'death_city', 'bp'=>'birth_city', 'bs'=>'birth_city');
function get_years($field, $filter)
{
$sql='select YEAR('.$field.') as year_ from agatti_people  where active=1 and YEAR('.$field.') > 0 group by year_';
$response=mysqli_query($GLOBALS['connection'], $sql) or die(mysqli_error($GLOBALS['connection']));
$return='<select name="'.$filter.'" id="'.$filter.'" class="database_loader" obj="people">
<option value="">(Select a Year)</option>
';
while($response_array=mysqli_fetch_row($response))
$return .= '<option value="'.$response_array[0].'">'.$response_array[0].'</option>';
return $return.'</select>';
}
function get_months()
{
}
$query_strings=$_SERVER['QUERY_STRING'];
parse_str($query_strings, $assoc_);
?>
		<div id="container">
			<div class="clear"></div>
		<div id="main">
		<div id="main_area_new_right_col">

<?php
echo '<br/><h3 style="text-align:center">You can search CMH\'s massive Birthday Database by selecting one the options below:</h3>
<div id="dll_options" style="padding:10px;padding-left:220px;display:none">
';
$opt_database=$_GET['opt'];
$select_opt='<select id="opt_database" name="opt_database" >
<option value="">(Pick one)</option>
';
foreach($array_label_active as $key_label=>$value_label)
{
$selected='';
if($opt_database==$key_label)
$selected=' selected ';
$select_opt .= '<option value="'.$key_label.'" '.$selected.'>'.$value_label.' '.$array_label_suffix[$key_label].'</option>';
}
$select_opt .='</select> ';
echo $select_opt;
if(in_array($opt_database, $years_opt))
{
echo get_years($array_db_order[$opt_database], $opt_database);
}
else
if(in_array($opt_database, $months_opt))
{
echo ' <select name="'.$opt_database.'_month" id="'.$opt_database.'_month">
<option value="">(Select a Month)</option>
</select> 
<select name="'.$opt_database.'" id="'.$opt_database.'" style="display:none" class="database_loader" obj="people">
<option value="">(Select a Day)</option>
</select>
<script type="text/javascript">
_show_months("'.$opt_database.'_month");	
$("'.$opt_database.'_month").observe("change", function(e)
{
$("'.$opt_database.'").show();
$("'.$opt_database.'").innerHTML="";
var day=document.createElement("option");
day.value="";
day.appendChild(document.createTextNode("(Select a Day)"));
$("'.$opt_database.'").appendChild(day);
for(var i=1; i <= months_[$F("'.$opt_database.'_month")]; i++)
{
var day=document.createElement("option");
day.value=$F("'.$opt_database.'_month")+"-"+i;
day.appendChild(document.createTextNode(i));
$("'.$opt_database.'").appendChild(day);
}
});
</script>';
}
echo '</div>';
if(isset($_GET['obj']{0}))
{
$location_keys=array("ds", "dp", "bs", "bp");
foreach($assoc_ as $key=>$value)
{
if(array_key_exists($key, $array_label))
{
$label=$array_label[$key];
if(in_array($key, $location_keys))
{
if(preg_match('/\*[^\*]+$/', $value))
{
$split_location=explode("*", $value);
if(isset($flipped_state_names[ucwords($split_location[1])]))
$tmp_value = $split_location[0].' '.$flipped_state_names[ucwords($split_location[1])];
else
$tmp_value = $split_location[0].' '.$split_location[1];
$label .= ' '.urldecode($tmp_value);
}
else if(preg_match('/^[^\*]+$/', $value))
{
if(isset($flipped_state_names[ucwords($value)]))
$label .= ' '.$flipped_state_names[ucwords($value)];
else
$label .= ' '.urldecode($value);
}
}
else
$label .= ' '.urldecode($value);
if((in_array($key, $months_opt)) and (preg_match('/[a-z]+\-[0-9]{1,2}/', $value)))
{
$wheres=$array_db_field[$key];
$explode_key = explode("-", $value);
$value=$month_variants[$explode_key[0]]." ".$explode_key[1];
}
else
$wheres=$array_db_field[$key];
if(is_array($wheres))
{
$values=explode("*", $value);
$where = ' where ';
for($i=0; $i < count($wheres);  $i++)
{
$where .= ' '.$wheres[$i].' = "'.urldecode($values[$i]).'" and ';
}
$where = substr($where, 0, strlen($where) -4);
}
else
$where=' where '.$wheres.' = "'.urldecode($value).'" ';
$order=' order by '.$array_db_order[$key].' asc';
}
else if(array_key_exists($value, $array_tables))
{
$table=$array_tables[$value];
$object=ucfirst($value);
}
}
$where .= ' and '.$table.'.active=1';
$list_common_fields='';
$i=0;
foreach($common_fields[$obj][$opt] as $common_field )
{
$list_common_fields .= ' '.$common_field.'  as '.$opt.'_'.$i.', ';
$i++;
}
$list_common_fields=trim($list_common_fields, ', ');
$show_amount=30;
$page=1;
if(isset($_GET['page']{0}))	
$page=$_GET['page'];
if($page==1)
$start=0;
else
$start=($page-1)*$show_amount;
$sql='select *, '.$list_common_fields.' from '.$table.' '.$where.' '.$order.' limit '.$start.', '.$show_amount;
$response=mysqli_query($GLOBALS['connection'], $sql) or die(mysqli_error($GLOBALS['connection'])."<br/>".$sql);
$return ='';
$results_count=mysqli_num_rows($response);
$sql_split=explode(' limit ', $sql);
$sql_total=$sql_split[0];
$response_total=mysqli_query($GLOBALS['connection'], $sql_total) or die(mysqli_error($GLOBALS['connection']).'<br/>'.$sql_total);
$total=mysqli_num_rows($response_total);
$url=$_SERVER['REQUEST_URI'];
$url=preg_replace("/[\?|\&]page\=[0-9]{1,}/", "", $url);
$url=str_replace(array("?cache=0", "&cache=0"), "", $url);
$has_url_arguments=preg_match('/\?/', $url);
$pagination=_pagination($url, $total, $has_url_arguments, $page, $show_amount, 10);
while($response_array=mysqli_fetch_assoc($response))
{
if($obj=="people")
{
$object_url='bio/'.$response_array['u_name'];
$common_field_parsed='';
for($j=0; $j<=$i;  $j++)
{
if(isset($response_array[$opt.'_'.$j]{0}))
{
if(preg_match('/\sin\s/', $response_array[$opt.'_'.$j]))
{
if(preg_match('/\son\s/', $response_array[$opt.'_'.$j]))
$common_field_parsed .= str_replace(' in ', ' ', $response_array[$opt.'_'.$j]).' ';
else
$common_field_parsed .= $response_array[$opt.'_'.$j];
}
else if(preg_match('/Died/i', $response_array[$opt.'_'.$j]) and isset($response_array['died']{0}) )
{
$common_field_parsed .= $response_array[$opt.'_'.$j];
}
else
$common_field_parsed .= $response_array[$opt.'_'.$j];
}
$common_field_parsed=trim($common_field_parsed);
}
$common_field_parsed=_encode_to_fix_accented(str_replace(array("*in*"), array(" in "), $common_field_parsed));
preg_match_all('/\%([0-9]{4}\-[0-9]{2}\-[0-9]{2}\s[0-9]{2}\:[0-9]{2}\:[0-9]{2})\%/', $common_field_parsed, $match_date_to_reformat);
$match_date_to_reformat=$match_date_to_reformat[0];
foreach($match_date_to_reformat as $a_match)
{
if(preg_match('/0000\-00\-00/', $a_match))
{
$common_field_parsed=preg_replace('/\~(.*)0000\-00\-00(.*)\~/', '', $common_field_parsed);
continue;// 'Still Alive';
}
$new_date=reformat_date($a_match);
$common_field_parsed=str_replace($a_match, $new_date, $common_field_parsed);
}
$common_field_parsed=preg_replace('/\^(.*)\^/', '<strong style="color:red">$1</strong>', $common_field_parsed); 
$common_field_parsed=str_replace('~', '', $common_field_parsed);
$links='<a href="/bio/'.$response_array['u_name'].'/" class="to_left side_padded">Biography</a>';
$links .='<a href="/filmography/'.$response_array['u_name'].'/" class="to_left side_padded">Films</a>';
if($response_array['has_quotes']==1)
$links .= '<a href="/quotes/star/'.$response_array['u_name'].'/" class="to_left side_padded">Quotes</A>';
if($response_array['has_facts']==1)
$links .= '<a href="/facts-and-trivia/star/'.$response_array['u_name'].'/page/1/" class="to_left side_padded">Facts</A>';
if($response_array['has_travel']==1)
$links .= '<a href="/travel-sites/star/'.$response_array['u_name'].'/" class="to_left side_padded">Travel Sites</A>';
if($response_array['has_blog']==1)
$links .= '<a href="/blog-hub/star/'.$response_array['u_name'].'/page/1/" class="to_left side_padded">Hub Articles</A>';
$return .= '
<a style="display:block;float:left" href="'.$object_url.'"><img src="'.getThumbnail($response_array['id'], "thumbs").'" class="db_img to_left" width="115" border="0" />
<h3 class="to_left db">'._encode_to_fix_accented($response_array['name']).'</h3>
</a>
<div class="to_left"><h3 class="small_h3_db"><small style="color:#000;">('.ucfirst(getDefaultJobSimple($response_array['default_job'], $response_array['gender'])).')</small></h3></div>
<div class="to_right buttons" style="padding-top:10px">
<!--<a href="/bio/'.$response_array['u_name'].'#filmography" >Rate Films</a>
<a href="" class="amazon" title="'.urlencode($response_array['name']).' dvds*DVD" search_results="1">Buy DVDs</a>-->
</div>
<div style="clear:right"></div>
<div class="to_left db_details">
<span class="birthname mask_words"></span> '._encode_to_fix_accented($response_array['birthname']).'
<div class="clear3"></div>
 '.$common_field_parsed.'
<div class="clear3"></div>
Fan Favorite Films: '.getBestMoviesByPerson($response_array['id'], $response_array['name'], $response_array['u_name'], $response_array['default_job'], 5, true, false).'
<div class="clear"></div>
<h3 class="added_links" style="margin-left:0">'.$links.'</h3>
</div>
<div class="clear"><hr/></div>
';
}
else
{
}
}
$label=str_replace("*", " ", $label);
echo $pagination;
}
?>
	<div id="breadcrumb">
	</div><!--closed breadcrumb-->
		<div class="clear"></div>
    		<?php
			$label=ucwords(str_replace("-", " ", $label));
				if(isset($_GET['obj']{0}))
				   echo '<div class="db_center_middle"><h3 class="centered">'.$results_count.' '.$object.' '.$label.'</h3><hr/></div>';
					echo '<div class="db_center_middle">'.$return.'</div><p>'.$pagination.'</p><br/>';
				?>
			<div class="db_center_middle centered">
If you are using Safari 5.1 and/or if you encounter any problems using this interface (i.e. dropdown list doesn't work), please refresh the page, wait for it to completely re-load and try again. And please know that I\'m working on fixing this issue. :)
</div>
	</div> <!--closes main div-->
		</div><!--closes main area-->
			<div class="clear"></div>
	</div> <!--closes container-->
		<script src="/scripts/stats_box.js" type="text/javascript"></script>
			<script type="text/javascript">
			var match_obj={"dm":"deaths/month", "bm":"births/month", "dy":"deaths/year", "by":"births/year"};
			$$(".database_loader").each(function(k)
		{
		k.observe("change", function(e)
		{
		var obj=k.readAttribute("obj");
		var id=k.id;
		var value_k=$F(id);
		window.location.href="/database/"+match_obj[id]+"/"+value_k;//id+"="+value_k+"&obj="+obj+"&opt="+id;
		});
		});
	    	$("opt_database").observe("change", function(e)
		{
		 window.location.href="/database/"+match_obj[$F("opt_database")];
		});
		$("dll_options").show();
		</script>
    		<script type="text/javascript" src="/scripts/amazon_api.js"></script>
	</body>
</html>
<?php
include("end_cache.php");
?>