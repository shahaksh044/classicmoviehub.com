<?php
/*
Plugin Name: Custom Birthday Plugin
Description: Displays birthdays for classic movie stars, includes custom URL routing, dropdowns, and date reformatting.
Version: 1.3
Author: Your Name
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Step 1: Initialization
add_action('init', 'custom_birthday_plugin_init');
function custom_birthday_plugin_init() {
    // Redirect logic for 'cache' parameter
    if (isset($_GET['cache']) && $_GET['cache'] != "0") {
        wp_redirect('https://www.classicmoviehub.com/', 301);
        exit;
    }

    // More specific and flexible rewrite rules
    add_rewrite_tag('%custom_page%', '([^&]+)');
    add_rewrite_tag('%month_date%', '([^&]+)');

    // Add multiple rewrite rules to catch different URL patterns
    add_rewrite_rule(
        '^custom-birthday-plugin/births/month/([^/]+)/?$',  
        'index.php?custom_page=1&month_date=$matches[1]', 
        'top'
    );

    add_rewrite_rule(
        '^index.php/custom-birthday-plugin/births/month/([^/]+)/?$',  
        'index.php?custom_page=1&month_date=$matches[2]', 
        'top'
    );
}

register_activation_hook(__FILE__, 'custom_birthday_plugin_activate');
function custom_birthday_plugin_activate() {
    custom_birthday_plugin_init();
    flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'custom_birthday_plugin_deactivate');
function custom_birthday_plugin_deactivate() {
    flush_rewrite_rules();
}

// Step 2: Query Vars
add_filter('query_vars', 'custom_birthday_plugin_query_vars');
function custom_birthday_plugin_query_vars($vars) {
    $vars[] = 'custom_page';
    $vars[] = 'month_date';
    return $vars;
}

// Step 3: Template Redirect
add_action('template_redirect', function () {
    // Extensive logging for debugging
   // error_log('DEBUG: Full _GET = ' . print_r($_GET, true));
   // error_log('DEBUG: Full query vars = ' . print_r(get_query_var(), true));
   // error_log('Template Redirect: custom_page = ' . get_query_var('custom_page'));
   // error_log('Template Redirect: month_date = ' . get_query_var('month_date'));

    // Multiple conditions to catch different routing scenarios
    $is_custom_page = (
        get_query_var('custom_page') == '1' || 
        isset($_GET['custom_page']) || 
        isset($_GET['month'])
    );

    if ($is_custom_page) {
        // Try to get month_date from different sources
        $month_date = get_query_var('month_date');
        
        if (empty($month_date) && isset($_GET['month']) && isset($_GET['year'])) {
            $month_date = strtolower($_GET['month']) . '-' . $_GET['year'];
        }
        if (empty($month_date) && isset($_GET['day']) && isset($_GET['year'])) {
            $month_date = strtolower($_GET['day']) . '-' . $_GET['year'];
        }
        
        if ($month_date) {
            // Include the custom birthdays template
            include plugin_dir_path(__FILE__) . 'templates/custom-birthdays.php';
            exit;
        }

        // Fallback redirect if no valid month_date is found
        wp_redirect(home_url('/database/'), 301);
        exit;
    }
});

/*add_action('init', 'debug_rewrite_rules');
function debug_rewrite_rules() {
    if (is_admin() && current_user_can('manage_options')) {
        global $wp_rewrite;
        echo '<pre>';
        print_r($wp_rewrite->rules);
        echo '</pre>';
    }
}*/

// Step 4: Birthday List Shortcode
add_shortcode('birthday_list', 'custom_birthday_plugin_display_birthdays');
function custom_birthday_plugin_display_birthdays() {
    global $wpdb;

    // Get filter parameters
    $selected_month = isset($_GET['month']) ? sanitize_text_field($_GET['month']) : date('F');
    $selected_year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
    $selected_day = isset($_GET['day']) ? intval($_GET['day']) : 0;

    // Months mapping
    $months = [
        'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4, 
        'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8, 
        'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
    ];

    // Validate month
    if (!isset($months[$selected_month])) {
        $selected_month = date('F');
    }

    // Validate year
    $current_year = date('Y');
    if ($selected_year < 1800 || $selected_year > $current_year) {
        $selected_year = $current_year;
    }

    // Validate day
    if ($selected_day < 0 || $selected_day > 31) {
        $selected_day = 0;
    }

// Prepare query conditions
$query_conditions = [];
$query_params = [];

// Month condition (required)
$query_conditions[] = "MONTH(birthday) = %d";
$query_params[] = $months[$selected_month];

// Handle year condition
if($selected_year == 2024) 
{

}
elseif (!empty($selected_year)) {
    // If year is selected, add year condition
    $query_conditions[] = "YEAR(birthday) = %d";
    $query_params[] = $selected_year;
}

// Handle day condition
if ($selected_day == 0) {
    // If day is 0, it means all days of the selected month (and year if specified)
    // No additional day condition needed
} elseif ($selected_day > 0) {
    // If a specific day is selected, add day condition
    $query_conditions[] = "DAY(birthday) = %d";
    $query_params[] = $selected_day;
}

// Combine conditions
$where_clause = implode(' AND ', $query_conditions);

// Query birthdays
$query = $wpdb->prepare("
    SELECT DISTINCT SQL_CALC_FOUND_ROWS
           legend, id, name, u_name, birth_city, birth_state, astrological, birthname,has_Facts,has_quotes,has_blog,has_travel,
           death_city, death_state, DATE_FORMAT(birthday, '%%b %%e, %%Y') AS _birthday,
           DATE_FORMAT(died, '%%b %%e, %%Y') AS _died, gender, director, default_job,
           YEAR(birthday) AS birth_year
    FROM agatti_people
    WHERE {$where_clause} 
      AND active = 1
    ORDER BY birth_year, legend DESC, has_thumbnail DESC, default_job ASC
", $query_params);

    $results = $wpdb->get_results($query, ARRAY_A);
    $total_count = $wpdb->get_var("SELECT FOUND_ROWS()");

    // Output buffer
    $output = '';

    // Filter Form
    $output .= "
    <form method='get' action='" . esc_url(home_url('index.php/custom-birthday-plugin/births/month/')) . "' class='birthday-filter-form'>
        <input type='hidden' name='custom_page' value='1'>
        <div class='filter-row'>
            <select name='month' class='birthday-filter-select'>";
    
    foreach ($months as $month => $month_num) {
        $selected = ($month === $selected_month) ? 'selected' : '';
        $output .= "<option value='{$month}' {$selected}>{$month}</option>";
    }
    
    $output .= "</select>
        
        <select name='year' class='birthday-filter-select'>
        $selected = ($current_year == $selected_year) ? 'selected' : '';
        <option value='$current_year' {$selected}>All Years</option>";
    
    for ($year = $current_year - 1; $year >= 1800; $year--) {
        $selected = ($year == $selected_year) ? 'selected' : '';
        $output .= "<option value='{$year}' {$selected}>{$year}</option>";
    }
    
    $output .= "</select>
        
        <select name='day' class='birthday-filter-select'>
            <option value='0'>All Days</option>";
    
    for ($day = 1; $day <= 31; $day++) {
        $selected = ($day == $selected_day) ? 'selected' : '';
        $output .= "<option value='{$day}' {$selected}>{$day}</option>";
    }
    
    $output .= "</select>
        
        <input type='submit' value='Filter' class='birthday-filter-submit'>
    </form>";

    // No results handling
    if (!$results) {
        $output .= '<p>No birthdays found for the selected criteria.</p>';
        return $output;
    }

    // Results header
    $output .= "<div class='db_center_middle'>";
    $output .= "<h3 class='centered'>{$total_count} People Born in {$selected_month} " . 
               ($selected_day > 0 ? "on {$selected_day}" : "in {$selected_year}") . "</h3>";

    // Iterate through results
    foreach ($results as $birthday) {
        $name = esc_html($birthday['name']);
        $birthname = esc_html($birthday['birthname']);
        $default_job = esc_html($birthday['default_job']);
        $u_name = esc_attr($birthday['u_name']);    
        $birthday_date = esc_html($birthday['_birthday']);
        $died = esc_html($birthday['_died']);
        $birthplace = esc_html(trim($birthday['birth_city'] . ', ' . $birthday['birth_state'], ', '));
        $deathplace = esc_html(trim($birthday['death_city'] . ', ' . $birthday['death_state'], ', '));
        $thumbnail_url = esc_url(geat_thumbnail_url($birthday['id']));
        $birth_year = esc_html($birthday['birth_year']);

        // Links
        $links = '<a href="' . esc_url(home_url("index.php/bio/{$u_name}/")) . '" class="to_left side_padded">Biography</a>';
        $links .= '<a href="' . esc_url(home_url("index.php/filmography/{$u_name}/")) . '" class="to_left side_padded">Films</a>';
        
        // Individual entry
        $output .= "
          <div class='db_center_middle'>
                <a href='" . esc_url(home_url("/{$u_name}")) . "' class='to_left' style='display:block;float:left'>
                    <img src='{$thumbnail_url}' class='db_img to_left' width='115' alt='{$name}' /><div class='to_left db_details'>
                    <h3 class='to_left db'>{$name}</h3>
                </a><div class='clear'> <span class='birthname mask_words'>Birthname: </span>{$birthname}</div>
                                 
                    <strong style='color:red'><br>Born on </strong>{$birthday_date} in {$birthplace}</br>
                    " . (!empty($died) ? "<p>Died on {$died} in {$deathplace}</p>" : "") . "
                    
                    <div class='entry_links'>{$links}</div>
                
                    </div>
                <div class='clear'></div>
            </div>
            <hr>";
    }

    $output .= '</div>';    
    return $output;
}

// Step 5: Helper for Thumbnails
function geat_thumbnail_url($id) {
    // Construct the image path using WordPress plugin directory functions
    $upload_dir = wp_upload_dir();
    $thumbnail_path = trailingslashit($upload_dir['baseurl']) . "images/thumbs/{$id}.jpg";
    $thumbnail_file = trailingslashit($upload_dir['basedir']) . "images/thumbs/{$id}.jpg";

    // Check if the thumbnail file exists
    if (file_exists($thumbnail_file)) {
        return $thumbnail_path;
    }

    // Fallback to a default thumbnail
    return trailingslashit($upload_dir['baseurl']) . "images/thumbs/default.jpg";
}

// Step 6: Enqueue Styles for Filter
add_action('wp_enqueue_scripts', 'custom_birthday_plugin_styles');
function custom_birthday_plugin_styles() {
    ?>
    
    <style>
    .birthday-filter-form {
        margin-bottom: 5px;
        background-color: #f4f4f4;
        padding: 15px;
        border-radius: 5px;
        text-align: left;
    }
    .birthday-thumbnail {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 20px;
}
    .filter-row {
        display: flex;
        justify-content: left;
        align-items: center;
        flex-wrap: wrap;
    }

    .birthday-filter-select {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .birthday-filter-submit {
        padding: 8px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .birthday-entry {
    display: flex;
    align-items: start;
    margin-bottom: 20px;
    padding: 15px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}
.birthday-details {
    flex-grow: 1;
    align:left;
}
    .birthday-filter-submit:hover {
        background-color: #0056b3;
    }
    @media (max-width: 768px) {
        .filter-row {
            flex-direction: column;
            align-items: stretch;
        }
        
        .birthday-filter-select,
        .birthday-filter-submit {
            width: 100%;
            margin-bottom: 10px
        }

       
        
    }
    /*.home{padding-left:20px;height:15px;background:url(../images/home1.png) no-repeat;margin-top:3px;display:block;font-size:0.9em;}*/
.db_details {
width: 550px;
}

tr.header_title td {background:#eee;color:#000;padding:5px;border-bottom:1px solid #aaa}
		
tr.cell td{padding:5px;background:#fff;border-bottom:1px solid #aaa}
		
tr.cell2 td{padding:5px;background:#fff}		
		
.white{color:white}

.big_favorite{width:30px;height:30px;background:url(../images/un_love_people.png) no-repeat}


.big_favorited{width:30px;height:30px;background:url(../images/love_people.png) no-repeat}


.entity_title{width:400px}
.solo_essential{width:30px;height:30px;margin-right:15px;margin-top:-5px}

#top_block{padding-bottom:10px;background:#fff;margin-left:10px;border:1px solid #000;width:667px}

/*highlights oscar winner*/
.is_winner{background:#e2fbd7}
.current_object{background:#f5fcf2}

#first_ad_right{/*float:right;*/position:relative;z-index:0;background:#fff;width:300px;height:250px;margin-top:10px;text-align:center}

.google_300_250{position:relative;z-index:0;background:#fff;width:300px;height:250px;margin-top:10px;text-align:center}

.career_stats{font-weight:normal;font-size:12px}
.career_stats td {padding-top:5px;margin-top:5px}
	
.main_info_box2 .thumb {margin-left: 5px;padding: 2px}
.main_info_box2 h4 {height: 15px !important}
	
.right_side_object{background:#eee;padding:5px;border:1px solid #aaa;margin-top:10px}


.gallery_tag{ background:url(../images/close.png) no-repeat right #eee;color:#000;padding:2px;padding-right:20px;margin:3px;float:left;border:1px solid #000}

#pagecontent{margin-top:6px}

.black_text{color:#000}

h2.black_text{font-size:12px;font-weight:normal;text-align:center}

.not_underlined, a .not_underlined {text-decoration:none}

.underlined{text-decoration:underline}

h2 {font-size: 16px}

h3 > a {font-size:20px}

h3.no_margin > a, h3.no_padding > a {font-size: inherit;margin-top: 5px}

.right_col_ad_space{margin-top:22px}

.clear_right{clear:right}
.clear_left{clear:left}
.no_margin {margin:0}
.no_padding {padding:0}

.right_side_object .side_link{max-width:220px;width:220px}

table.new_stats {font-size:12px;font-weight:normal}

td.spaced{padding-top:8px}

td.attribute_name{padding-left:5px}

.bio_buy_now{float:left;margin-left:30px;margin-top:-10px;margin-bottom:10px}

.featured_thumb h1 {text-align: center;font-size: 14px;margin: 3px}

/*span.mask_words{display:block}*/

#upload_new_picture{position:absolute;padding-top:10%;z-index:4;top:0;padding-left:20%}

#my_profile{margin-left:10px;height:200px;overflow:hidden;border:1px solid #000}

#upload_now_{background-color:#eee;padding:5px;max-width:180px;margin:5px auto;margin-left:-18%;border:1px solid #000}

.db_img {
margin-right: 20px;
float: left;
border:1px solid #000;
margin-bottom:8px;
}

h3.header{background: #2e42a6;
color: #fff;
margin: 0;
padding: 5px}

h3.feature_event{text-align: center;
padding: 0;
margin: 10px 0;
font-size: 13px;}

.feature_box{float:right;width:235px;height:270px;margin:5px; margin-top: 0; margin-left:5px;border:2px solid #000;padding:5px;padding-left:10px;background:#fff}

.home {
padding-left: 20px;
/*height: 15px;*/
background: url(../images/home1.png) no-repeat left;
margin-top: 1px;
display: inline-block;
font-size: 0.9em;
padding-right: 20px;
}

.event_location{font-size:0.9em;padding-left:20px;padding-top:1px;background: url(../images/event_location.png) no-repeat left;height:17px
}

#the_list{padding-left: 0px}
.draggables {list-style-position: inside;background: #eee;border: 1px solid #000;padding: 5px;margin: 5px}

#new_venue {border:4px solid #aaa;padding:10px;background:#fff}
#frm_new_venue input[type=text]{width:300px}

#div_auto_venue{width:600px;margin-left:160px;background:#fff;border:1px solid #000;border-top:0}

#div_auto_venue .auto_info{float:inherit}


#div_auto_venue ._band, #div_auto_venue ._band_all_results{cursor:pointer}

#div_auto_venue .auto_info small{font-weight:normal;float:left;margin-top: 1px;padding-left: 10px;}

#div_auto_venue .auto_info span{float: left;font-weight:bold}

.to_left{float:left}

.to_right{float:right}

.col{background:#fcfbf6;overflow:hidden}

#div_auto {
background:#fff;
border:1px solid #000;
border-top:0;
}


.bio_films{float:left;margin-right:10px;margin-top:5px}

.quotes_facts{float:left;margin-right:10px;margin-top:5px}

._band, ._band_all_results{
display:block;
padding:4px;
width:494px;
color:blue;
float:left;
}

._band_all_results
{
background:#7A8BD0;
}

._band_all_results a {color:#000; font-weight:bold}

.auto_info{
float:right;
width:430px;
text-decoration:none;
font-weight:bold;
}


._band small{color:#000; font-weight:normal;display:block;margin-top:5px;font-size:12px}

.auto_thumb img {border:1px solid #aaa}

._band:hover{ background:#ff0}

.auto_thumb{float:left; margin-right:3px;}
._not_button{background:inherit}

.quote_wrapper{padding:5px;}

.centered
{
display:block;
text-align:center
}

#ajax_login_out
{
height:60px;margin-right:10px;
text-align:right;
}

#ajax_login_out ul, #ajax_login_out li {list-style-type:none; list-style:none}

#ajax_login_out li {padding:0;font-size:14px;}

h1.kill_size{font-size:inherit;font-weight:normal;margin:0;padding:0}


/*#ajax_login_out a {display:block}*/
h3, h2.look_like_h3, h1.look_like_h3 {margin-left:15px;  /*12.8.11 changed from 10px to 15px because main went from 795 to 800*/
color:#2e42a6;font-size:18px
/* alternate color #3D50B2*/
}

h1.look_like_h3{margin-left:0;margin-top:0}

.look_like_h3 a{color:#2e42a6;text-decoration:none}

h1.in_cell{margin-top:5px;margin-bottom:5px}

body, html {
margin:0;padding:0;
	/*background-color:black;*/
}

div.clear {
	clear: both;
}

div.clear2
{
clear:both; margin-top:4px;height:1px;
}

hr.auto_hr{position:relative;clear:both;color:#ddd;margin:0;padding:0;}

div.clear3
{
clear:both; margin-top:14px;height:1px;
}

div.clear4
{
clear:both; margin-top:7px;height:1px;
}

div.clear5
{
clear:both; margin-top:9px;height:1px;
}

div, table{
	/*border:1px solid #fffff0;*/
	font-family: arial;
	font-size: 14px;
	}  
	/*use so that you can see everything, then delete*/
	
#container
	{
	position:relative;
	margin:0 auto;
	width:1000px;
	min-height:1000px; /*lol changed from 1000 to 1500 px 12.8.11*/
	height:auto;
	z-index:1;
	background:#fcfbf6;
	/*border: 3px solid #a05220d*/
	}
	
	.right_ad{margin: auto;margin-top: 13px;}
	
	#shadow_container
	{
	position:relative;
	top:100px;
	margin:0 auto;
	width:1000px;
	min-height:1000px;
	height:auto;
	z-index:2;
	}

#logo
	{
	float: left;
	height: 110px;  /*was 125 in old format, then slim format 105; was nice at 115 but a little spaceous maybe revisit later*/
	width: 132px;
	/*background:#fffff0;*/
	background:#7a8bd0;
	/*border-bottom: 2px solid #a0522d;
	opacity:0.5;*/
	}
	
#header
	{
	position:relative;
	float: left;
	height:110px;  /*was 125 in old format, then 105 in new slim format; was nice at 115 but a little spaceous maybe revisit later*/
	width: 868px;
	/*background:#fffff0;*/
	background:#7a8bd0;
	z-index:1000;
	/*border-bottom: 2px solid #a0522d;
	opacity:0.5;*/
	}
		
		.button > a {color:#000; font-weight:bold; padding:5px 8px; background:#fcfbf6; text-decoration:none;border:0;font-size:inherit;}
		
		.button > a:hover {color:#000;background:#eee}
		
		
		A.hovered {color:#000;background:#eee}
		
		div#navbar_one{ position: relative;z-index: 2;height:40px;max-height: 23px;
border-bottom: 1px solid #000;
}

		ul.sub_menu{position:absolute;z-index:10;width:120px;background:#eee}



ul.sub_menu a {display:block;width:inherit;padding:2px 8px;color:#000;background:#eee;text-decoration:none}

ul.sub_menu a:hover {text-decoration:underline}

div#main{position:relative;z-index:0}
		
		#left_col a, #left_col a:visited {color:#FFFFF0; text-decoration:none}
		
		#sign_in_area a, #sign_in_area a:visited {color:#fff; text-decoration:none;/* font-weight:bold*/}
#title_area
	{
	float: left;
	width: 610px;
	font-family: scripts;
	font-size: 16px;
	}
	
	#q{width:420px}  /*search box itself was 450 changed to 420 to fix IE issue BUT THEN CHANGED BACK AGAIN*/
#sign_in_area
	{
	float:right;
	width:195px;
	margin-top:10px; /*  10px was absolutely perfect when there is no smm logo section  when SEARCH BOX was in NAV ONE, then SIGNIN AREA top margin was 50px, changed it to 20px to make room for SEARCHBBOX for new format; last version was 8px; THEN changed to 14 after took search bar out of that area*/
	/*margin-left:10px; last version was 8px*/
	margin-right:10px;
	}
	
#navbar_one
	{
	background:#7a8bd0;
	height:30px;
	padding-left:12px;
	padding-top: 5px;
	}


	
	#main
	{
	float:left;
	background:#fcfbf6; /*#fcfbf6 off white*/ /*efeada amazon beige*/
	/*  fffff0  original yellow*/
	min-height:1500px;  /*lol added 12.8.11 TO GIVE MORE ROOM TO LEFT COL FOR AD SPACE*/
	padding: 0 10px;
	height:auto;

	}
	
#left_col
	{
	float:left;
	background:#7a8bd0;
	/*min-height:590px;*/
	width:160px; /*originally 180, but added 10 padding*/
	padding: 10px 5px 10px 10px; /*left padding 10px but right padding 5 px WAS ORIGINALLY 10px all around needed to find space for pages with right cols/
	/*added the above on 12.8.11 for ad space*/
	/*min-height:1500px;  lol added this 12.8.11 WAS 1000px*/
	height:auto;  /*lol added this 12.8.11  THIS IS DRIVEN BY THE MAIN MIN OF 1500PX NOW*/
	/*height:100%; lol 12.8.11 this was here before i needed extra space for ads*/
	/*border-top: 2px solid #a0522d;*/
	/*opacity:0.5;*/
	}

	
.dd_list /*this div aka dropdown list is to contain top ten lists*/
	{
	float:left;
	width:135px;/*was 115px
	min-height:133px;
	height:auto;
	/*padding:2px; /*was 2*/
	border:1px solid #000;
	/*margin-top:3px;
	/*margin-left:3px; /*was 5 all the way around; without brown main area borders, used 21*/
	}
	
	
	
	
	
	/*eventually this will be defunct*/
	#main_area
	{
	float:left;
	background:#fcfbf6;
	/* background:#efeada; amazon beige very nice but issues with right col amazon ad which is same color */
	/* lighter beige nice too #fcfbf6 */
	
	/*original yellow #fffff0*/
	min-height:800px;  /*changed from 800 to 1500px 12.8.11*/
	width:638px;  /*was 615*/
	/*border-top: 2px solid #a0522d;
	border-left: 2px solid #a0522d;
	border-right: 2px solid #a0522d;*/
	/*padding-right: 10px; /*this is for the actors page, cause not in div; NO this screws everything up*/
	/*opacity:0.5;*/
	}
	
	#right_col
	{
	position:relative;
	z-index:0;
	float:right;
	/*background:#efeada; amazon beige*/
	/*background:#7a8bd0; blue*/
	/* was brown #d2b48c;*/
	height:auto; /* lol added this 12.8.11*/
	/*min-height:1500px; lol was orig 590 changed to 1500 12.8.11*/
	width:160px; 
	padding: 0px 5px; /*was 10px for top padding; remember right_col is a class given to all right column code pages*/
	/*padding-left:1px;was originally 160 pus 20 padding ; but had to add more space to main area and took out some left col space*/
	/*padding:3px;*/
	/*opacity:0.05*/
	
	background:#fcfbf6;
	}
	
	
	
	
	
	
	
	
	
	
	
	/*ADDED THIS SECTION TO TRY OUT NEW TEMPLATE WITHOUT RIGHT NAV BAR*/
	/*at some point will need to delete mainarea above*/
	#main_area_new
	{
	float:left;
	background:#fcfbf6;
	min-height:800px;
	height:auto;
	width:800px;
	}
	
	
	#main_area_new_right_col
	{
	float:left;
	background:#fcfbf6;
	min-height:1480px;  /*was 800*/
	height:auto;
	width:790px;
	/*padding-left:5px;*/ /*was 15px without any margin at all*/
	padding-right: 10px;
	padding-bottom: 20px;
	/*margin-left: 10px; *//*if no margin, then increase padding by 10px*/
	}
	
	
/*	DIV.merch_page_ads
	{float:left;
	width:165px;
	height:170px;
	padding-left:10px;
	padding-top:15px;
	margin-left: 15px;
	margin-bottom: 10px;
	margin-top: 10px;
	border:1px solid #000;
	background:#ffffff;
	}
	was using this BEFORE formatting similar to other pages; before ads were larger NOW ads are 125 x 125*/
	
	
	DIV.merch_page_ads /*these specs should be the same as the div class thumb specs  EXCEPT padding which is slightly more and width which is 125 instead of 135 due to extra padding*/
	{
	border: 1px solid #000000;
    float: left;
    background:#ffffff; /*this is white around thumb area stats box*/
   /* background:#efeada;  amazon beige*/
    /*ecedf0  nice grey */
    /*fcfbf6 lighter beige*/
    /* light beige works well background:#fcfbf6;  */
    /* ffffff is white */
    margin-left: 1px;  /*was 10px for thumbs*/
    margin-right: 9px;  /*added this*/
    margin-top: 10px;   
    min-height: 215px;
    height: auto;
    padding: 10px;  /*padding was 5px for thumbs */
    width: 125px;  /*width was 135px for thumbs */
	}
	
	DIV.merch_page_ads > h4  /*these specs should be the same as the div class thumb specs*/
	{
	font-size:12px;
	font-weight:normal;
	margin:0px;
	text-align:center; /*name under pix*/
	height:30px;
	max-height:30px;
	overflow:visible;
	clear:both;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

#breadcrumb
	{
	padding:2px;
	margin-top:5px;
	margin-left:8px;
	width:790px;
	float:left;
	font-weight:bold
	}
	

#breadcrumb_right_col
	{
	/*padding:2px;*/
	padding-left: 10px;
	padding-top: 5px;
	margin-top:5px;
	width:790px;
	float:left;
	font-weight:bold
	}
	
#breadcrumb_ad_space_pages
	{
	padding:2px;
	margin-top:5px;
	margin-left:8px;
	width:638px;
	float:left;
	}
	
	
	
#breadcrumb_left
{
position:relative;
float: left;
z-index:10;
font-weight:bold
}

#breadcrumb_right, #breadcrumb_right_sorters
{
position:relative;
text-align: right; margin-right: 20px;z-index:9;}

#breadcrumb_right_sorters {margin-top:10px;}

.toggle_button
	{float:right;
	margin-right:2px;
	font-size:11px;
	}
	
	
	
	#main_area strong
	{
	margin-left: 140px;
	}
	
	#spotlight
	{
	margin-top: 10px;
	margin-left:10px;
	font-weight: bold;
	height:30px;
	}
	
	#image_box  /* on individual film pages*/
	{
	float:left;
	margin-left: 10px;
	width:215px;
	height:230px; /*was 280 -- may need to shorten*/
	/*background:#fffff0;
	background:url();*/
	border:1px solid red
	}

/*this stats_big section is new*/	
	#stats_big  /* on individual film pages*/
	{
	float:left;
	margin-left: 10px;
	width:215px;
	height:230px; /*was 280 -- may need to shorten*/
	background:#fffff0;
	border:1px solid red
	}

	.bio_picture_big
	{
	margin-right:10px;
	margin-bottom:10px;
	float:left;
	border:1px solid #fff; /*this is the star's pix*/
	}
	
	#stats_big /*pop up stats*/
	{
	width:215px;
	height:230px;
	display:none;
	border:1px solid #000;
	text-align:center; /*this is the box that pops up with info*/
	}
	
	.stats_big /*pop up stats*/
	{
	width:215px;
	height:230px;
	margin-right:10px;
	margin-bottom:10px;
	border:1px solid #000;
	text-align:center; /*this is the box that pops up with info*/
	}
	

	/*.discussion_button
	{margin-top: 10px;
	margin-left:290px;
	margin-bottom:20px;
	border:1px solid #000;
	}
	this worked well if the discussion button was UNDER the description div
	*/
	
	/*this is the style if the discussion button is INSIDE the description div*/
	.discussion_button
	{
	padding-top:20px;
	padding-bottom:20px;
	border:1px solid #000;
	}
	
	
	#_txt
	{
	width:300px;
	height:150px;
	}
	
	._threadtitle
	{
	float:left;
	width:375px;
	font-size:13px;
	}
	.thread
	{
	border:1px solid #f00;
	background:#ccc;
	padding:5px;
	margin:5px;
	
	}
	.details
	{
	float:right;
	font-size:12px;
	}
	
	.description
	{
	float:left;
	margin-left:20px;
	margin-top:10px;
	}
	
	#notice
	{
	border:1px solid red;
	background:#ccc;
	color:red;
	width:250px;
	/*padding:2px;
	margin-left:auto;
	margin-right:auto;
	margin-bottom:10px;*/
	}
	
	.comment
	{
	display:block;
	background:url(../images/comment.jpg) no-repeat;
	padding-left:35px;
	padding-top:10px;
	margin-bottom:10px;
	}
	
	#review_area
	{
	float:left;
	width:350px;
	height:250px; /*may need to shorten*/
	margin-left: 15px; 
	background:#fffff0;
	}
	
	
	

	
	#purchase_dvd
	{
	height:150px;
	background:#d2b48c;
	}
	
#footer
	{
	background:#efeada;
	text-align:center;
	font-size:12px;
	padding:10px 0;
	}
	
.button
	{
	float:left;
	padding:2px; /*was 20 BEFORE THAT WAS 3, need to decrease width now*/
	width:auto;
	/*width: 62px; was 96*/
	/*border:solid black 1px;*/
	}	
	
#legal_lines
{
	padding-top:5px;
	font-size:12px;
	
	}
	
	.welcome_msg{background:#78334c;color:#fff;padding:10px;margin:10px 30px}
	
	
.welcome_msg_not_centered{background:#78334c;color:#fff;padding:10px;margin:0;margin-top:10px; margin-bottom:5px; width:710px}

.chart_welcome{width:770px}

.sort_cell{margin-top:5px}

.search_bar
	{
	margin-top: 13px;
	margin-left: 80px;
	width:500px;
	position:relative;
	z-index:1000;
	}
	
	
	.div_block{float:left;width:678px;/*height:250px;*/margin-right:10px; margin-top: 0; margin-left:10px;border:2px solid #000; background:#fff;overflow:hidden;padding-left:10px}	


/*THIS IS THE THUMB/STATS/PIX SECTION FOR ALL PAGES*/
	
	.thumb /*these are the actor/actresses/director photos and film dvd pix too*/
	{
	border: 1px solid #000000;
    float: left;
    background:#ffffff;
    margin-left: 10px;
    margin-top: 10px;
    min-height: 215px;
    height: auto;
    padding: 5px;
    width: 135px;
    text-decoration:none
	}
	
	.featured_thumb /*these are the actor/actresses/director photos and film dvd pix too*/
	{
	border: 1px solid #000000;
    float: left;
    background:#eee;
    margin-left: 10px;
    margin-top: 10px;
    min-height: 215px;
    height: auto;
    padding: 5px!important;
    width: 185px !important;
	}
	
	.thumb_small /*these are the actor/actresses/director photos and film dvd pix too*/
	{
	/*border: 1px solid #000000;*/
    float: left;
    background:#ffffff;
    /*margin-left: 10px;*/
    margin-top: 10px;
    min-height: 215px;
    height: auto;
    /*padding: 5px;*/
    width: 130px;
    margin:2px;
    padding:0;
    border:0;
	}
	
	.thumb  h4, .thumb_small  h4,  .featured_thumb  h4 , .thumb  h2, .thumb_small  h2,  .featured_thumb  h2 /*name of actor or film inside the div*/
	{
	font-size:12px;
	font-weight:normal;
	margin:0px;
	text-align:center; /*name under pix*/
	height:30px;
	max-height:30px;
	overflow:visible;
	clear:both;
	}
	
	.thumb_small  h4, .thumb_small  h2{height:auto;max-height:auto;width:120px}
	
	div.fan_rating{
	font-size:11px;
	font-weight:normal;
	margin:0px;
	text-align:center; /*name under pix*/
	padding:1px;
	margin-top:2px;
	}
	
	.thumb  a  /*anchor in the thumb*/
	{
	color:black; /*link is black font vs blue*/
	}
	
	
	
	
	
	
	
	
	
	#search
	{
	width:120px;
	}
	
	form#frm
	{
	border:1px solid #000;
	margin:auto;
	width:400px;
	margin-top:10px;
	margin-bottom:10px;
	min-height:100px;
	height:auto;
	padding:20px;
	}
		
	DIV.break
	{
	clear:both;
	padding-top:9px;
	height:1px;
	/*font-size:0px;*/
	}
	
	form#_comment
	{
	/*float:left;*/
	width:300px;
	height:200px;
	padding:5px;
	border:1px solid #000;
	}
	#_comment_text
	{
	width:290px;
	}
	form#_rate
	{
	float:left;
	width:250px;
	height:200px;
	padding:5px;
	border:1px solid #000;
	}
	
	.inputs
	{
	border:1px solid #000;
	}
	
	label
	{
	float: left;
    margin-right: 10px;
    text-align: right;
    width: 150px;
	}
	
	
	form#_frm_
	{
	margin:10px;
	border:1px solid #000;
	padding:10px;
	}
	
	#_frm_ input[type=text], #_frm_ textarea
	{
	width:400px;
	}
	
	#_frm_ textarea
	{
	height:400px;
	}
	
	#video
	{
	float:left;
	width:320px;
	height:265px;
	margin-left: 10px;
	background:d2b48c;
	}
	
	#quote_facts
	{
	float:left;
	width:25;
	0px; /*from 295*/
	background:#fffff0;
	height:265px;
	}
	
	#quote
	{
	float: left;
	width:250px; /*from 295*/
	height:132px;
	margin-left: 10px;
	margin-right: 10px;
	/*background:f5f5dc;*/
	}

	#bio_name
	{
	margin-top: 10px;
	margin-left: 12px;
	margin-bottom: 5px;
	font-weight: bold; /*this is the star's name above the photo*/
	}
	
	
	/*the width and height of the bio picture is changed via the people php page in the display section AND in the film php page  DID NOT change in the bio php or any other section yet*/
	.thumb .bio_picture   /*this is just the picture thumbnail*/
	{
	border: 1px solid #000000;  /*was white border #ffffff changed 12.8.11*/
    height: 170px;
    margin: 5px 10px;
    width: 115px;
	}
	
	.featured_thumb .bio_picture   /*this is just the picture thumbnail*/
	{
	border: 1px solid #000000;  /*was white border #ffffff changed 12.8.11*/
    height: 213px !important;
    margin: 5px 20px;
    width: 145px !important;
	}
	
	.thumb_small .bio_picture   /*this is just the picture thumbnail*/
	{
	border: 1px solid #000000;  /*was white border #ffffff changed 12.8.11*/
    height: 170px;
    margin: 5px !important;
    width: 110px;
	}
	
	/*this may not be applicable anymore*/
	#stats /*pop up stats*/
	{
	width:115px;
	height:133px;
	display:none;
	border:1px solid #000;
	/*font-size: smaller;*/
	text-align:center; /*this is the box that pops up with info*/
	}
	
	/*I used the below class stats for bio and people page, I did not use the id above for the mouseover mouseout although the id info is in the div section*/
	
	/*CLASS for stats boxes*/
	.stats /*pop up stats*/
	{
	float:left;
    border: 1px solid #000000;
    background:#eeeada; /*amazon beige*/
    font-size: 11px;
    height: 170px;
    margin: 5px 10px;
    text-align: center;
    width: 113px;
    clear:both;
	}
	/*tried copying margins and fonts and aligns to above stats id but made no diffence to the stats and image mouseovers
	
	/*what's the difference between stats and bio_stats*/
	
	/*I took the id bio stats out of the bio page mouseover mouseout and related code, I used the stats class insted, so the following code is moot*/
	
	
	/*OR IS THIS THE STATS BOX*/
	#bio_stats
	{
	width:125px;
	/*width:115px;*/
	/*this stats box was 115 width since the beginning, nice aspect ratio*/
	height:133px;
	/*height:133px;*/
	/*this stats box was 133 height since the beginning, nice aspect ratio*/
	float:left;
	 /*this is the pix area, does not affect bio info next to pix*/
	 /*if I delete margins it gets rid of the entire thumb with actors name on the bio page*/
	}
	
	DIV.comments
	{
	display:block;
	margin-left:20px;
	padding:10px;
	background:#f5f5dc;
	border-bottom:1px dotted #a0522d;
	margin-right:20px;
	}
	
	.rate /*this is the blank star*/
	{
	cursor:pointer;  /*only need to put this here because all options have the rate class; note the pointer in css is really the hand*/
	float:left;
	width:13px;
	height:13px;
	background:url(../images/_rate__.png) no-repeat;
	}
	
	.rate_over /*this is the yellow star*/
	{
	float:left;
	width:13px;
	height:13px;
	background:url(../images/_rate_over__.png) no-repeat;
	}
	
	.rate_done /*this is the read star*/
	{
	margin-top:-1px;
	float:left;
	width:13px;
	height:13px;
	background:url(../images/_rate_done__.png) no-repeat bottom; /*the word bottom tells css not to clip off the image at the bottom because this image had an extra pixel*/
	}
	
	.saving
	{
	float:left;
	width:90px;
	font-style:italic;
	height:18px;
	text-align:center;
	}
	
	img.no
	{
	cursor:pointer;
	float:left;
	margin-left:5px;
	}
	
	.essential
	{
	float:left;
	width:30px;height:30px;
	background:url(../images/essential.png) no-repeat bottom;
	cursor:pointer;
	}
	
	.essential_done
	{
	float:left;
	width:30px;height:30px;
	background:url(../images/essential_done.png) no-repeat bottom;
	cursor:pointer;
	}
	
	.favorite
	{
	float:left;
	width:16px;
	height:16px;
	background:url(../images/favorite.png) no-repeat bottom;
	cursor:pointer;
	margin-left:5px;
	}
	
	
	.favorite:hover
	{
	background:url(../images/favorited.png) no-repeat bottom;
	}
	
	.favorite_done
	{
	float:left;
	width:16px;
	height:16px;
	background:url(../images/favorited.png) no-repeat bottom;
	cursor:pointer;
	margin-left:5px;
	}
	
	.rate_wrapper
	{
	width:130px;
	margin:0 auto;
	margin-top:3px
	/*border:1px solid #000;*/
	}
	
	._top_chart
	{
	font-size:15px;
	margin:0px;
	padding:0;
	}
	
	.my_list, .my_list * /*asterisk = ALL - since it comes after my_list it means all the children of my-list*/
	{
	font-size:12px; 
	}
	
	ul
	{
	margin-top:5px;
	margin-bottom:15px;
	font-size:12px;
	margin-left:0;
	}
	
	ul.breadcrumb_filters
	{
	font-size:inherit;
	}
	
	ul, ul > li
	{
	padding:2px 0;
	list-style-position:inside;
	list-style:none;
	margin-left:0;
	}
	
	ul.breadcrumb_filters > li
	{
	padding:2px 5px;
	}
	
	A.range_{/*padding:2px 5px;  */font-size:12px;}

.buttons
{
margin: 20px 10px;text-align:center;
}

.to_right.buttons
{
margin:0;text-align:center;
}

.buttons a.amazon
{
background-image:url(../images/amazon_button_small.png);
background-repeat:no-repeat;
background-position:left;padding-left:30px;
}

.buttons a
{
padding:4px;
margin:2px 5px;
background-color:#b7c1ea;
text-decoration:none;
color:#000;
font-weight:bold;
}
.buttons a:hover
{
background-color:#807fcb;
}

blockquote{margin:0;padding:0;}

.read_more{display:block;margin:4px 0;margin-left:31px;font-weight:normal}

.main_info_box, .main_info_box2, .film_info_box
{
float:left;
width: 425px;   /*was 575px  */
height: 204px;   /* was 165 px  */
float: left;
margin-top:10px;
font-size:14px;
font-weight:bold;
margin-left:10px;
border: 1px solid #000000;   /*was AAAAAA*/
/*background-color: #7a8bd0; */
/*this is the outer portion of the film box outside the content wrapper but inside the main*/
}

.main_info_box2
{border:0;height:auto;border:1px solid #aaa;background:#fff}


.film_info_box
{
width: 580px;   /*was 575px  */
height: 217px;   /* was 165 px  */
float: left;
margin-top:10px;
font-size:14px;
font-weight:bold;
margin-left: 20px;
margin-right: 20px;
margin-bottom; 10px;
padding: 10px;
border: 1px solid #000000;   
background-color: #7a8bd0;  

}


.read_more
{font-size: 12px;

}


big.quote{font-size:18px;}

#birthday2{font-size:smaller}

ul.breadcrumb_filters
{
padding:0;
margin:0;
display:inline;
}
ul.breadcrumb_filters li {display:inline;}
li.breadcrumb_list {float:right}

.div_in_list{float:left; width: 130px; font-size: 13px; padding:2px 0;}

.chart_list{height:auto;border:0px solid #000;overflow:hidden;font-size:13px}

#email, #password {width:150px;}

.numbers{float:left;height:auto;width:20px;font-size:12px;color:#FFFFF0;padding:2px 0;}

#charts_div{margin-left:15px; margin-right: 15px; padding: 10px; background-color:#efeada; border:5px solid #000}

#charts_div .numbers{ margin-right:5px; text-align:right;
float:left;height:auto;width:20px;font-size:12px; color:#000;padding:2px 0;
}


#charts_div .div_in_list{float:left; width:auto; font-size: 13px; padding:2px 0;text-align:right}

.social_links{position: relative;
width:730px !important;
z-index: 1000;
height: 10px !important;
margin-right: 0px;}

div.main_info_box .content_wrapper{border:0px solid #000;margin:0;height:inherit;padding:10px 15px}

div.film_info_box .content_wrapper{border:0px solid #000;margin:0;height:inherit;padding:10px 15px}


.yt, .fb, .twitter, .tumblr, .wordpress, .pinterest {float:left;margin:0 4px;}

.yt{background:url(../images/icons/yt.png) no-repeat bottom;margin-left: 3px; height:29px;width:70px;
}

.fb{background:url(../images/icons/fb.png) no-repeat bottom;height:32px;width:32px;
}

.twitter{background:url(../images/icons/twitter.png) no-repeat bottom;height:34px;width:34px;
}

.tumblr{background:url(../images/icons/tumblr.png) no-repeat bottom; margin-left: 3px; margin-bottom: 2px; height:33px;width:33px;
}

.wordpress{background:url(../images/icons/wordpress.png) no-repeat bottom; margin-left: 3px; margin-bottom: 2px; height:32px;width:32px;
}

.pinterest{background:url(../images/icons/pinterest.png) no-repeat bottom;margin-left: 3px; height:33px;width:33px;
}


.smm_logos
{float:right;margin-top:9px; margin-right: 8px;} /*was 5 px but increased to 10px after took search bar out */

.yt2, .fb2, .twitter2, .tumblr2, .wordpress2, .pinterest2, .g2 {float:left;margin:0 4px;}

.yt2{background:url(../images/icons/yt3.png) no-repeat bottom;margin-left: 3px; height:20px;width:48px;
}
/*image yt2 png was 16x38  image yt3 is 48x20*/

.fb2{background:url(../images/icons/fb3.png) no-repeat bottom;height:20px;width:20px;
}
/*image fb2 png was 16x16 image fb3 is 20x20*/

.twitter2{background:url(../images/icons/twitter3.png) no-repeat bottom;height:21px;width:21px;
}
/*image twitter2 png was 17x17 image twitter3 is 21x21*/

.tumblr2{background:url(../images/icons/tumblr3.png) no-repeat bottom; margin-left: 3px; margin-bottom: 2px; height:20px;width:20px;
}
/*image tumblr2 png was 16x16 image tumblr2 is 20x20*/

.wordpress2{background:url(../images/icons/wordpress3.png) no-repeat bottom; margin-left: 3px; margin-bottom: 2px; height:21px;width:21px;
}
/*image wordpress2 png was 17x17 image wordpress3 is 21x21*/

.pinterest2{background:url(../images/icons/pinterest3.png) no-repeat bottom; margin-left: 3px; margin-bottom: 2px; height:20px;width:20px;
}
/*image pinterest2 png does not exist image pinterest3 is 20x20*/

.g2{background:url(../images/icons/g3.png) no-repeat bottom; margin-left: 3px; margin-bottom: 2px; height:21px;width:21px;
}
/*g3 is 22x22*/


#footer_container{width:300px;margin:0 auto;padding-top:5px;}

.padded_content{margin-left:0px;}  /*was 10px but main went from 795 to 800 */

.padded_content2{margin-left:10px;padding:0 5px;}

.side_padded{padding:0 5px}

.padded{padding:5px}

.thick_separator{margin-top:20px;}

hr.thick_separator{position:relative;z-index:0;margin-top:20px;}

.thumbnails_div_home{padding-left:2px}

.thumbnails_div{}

.content_wrapper,.content_wrapper2, .wiki_wrapper{border:1px solid #aaa;margin-right:10px; margin-left:10px;margin-bottom:10px;  background-color:#ffffff; }

/* background-color:#fcfbf6; this is a nice light beige works well*/
/* ffffff is white */
/* background:#efeada; amazon beige very nice but issues with right col amazon ad which is same color */
/*the 175 height allows the inside white box to appear*/
/*had to do min and max heights so white inside box wouldnt exceed blue outside from info box or film box above */
/*made these changes 12.8.11*/

.content_wrapper{padding:20px;  min-height: 165px;}
.content_wrapper2{padding:20px;  min-height: 165px;}

.content_wrapper2{padding-top:40px}

.wiki_wrapper{padding:20px;padding-top:10px; height: auto;}
/*
@media all and (min-width: 0) {
#main_area_new {
width:995px;
}

#container {
width:1075px;
}
}*/
p.margined_p{margin-left:10px;}
form#_frm_genre, form#_frm_top_topics, form#_frm_genre2
{
margin:0;padding:0;
}

div.margined_p
{
margin:0;padding:0 40px 20px 20px;
}

/*for pagination*/

a.next, a.prev, a.page, a.paged{float:left;margin:0 2px;width:20px;text-align:center;text-decoration:none;padding:2px 0;}

.browse_by_box{float:left;width:227px;height:250px;margin:20px; margin-left:10px;margin-right:0px;border:2px solid #000; background:#fff;overflow:hidden}


a.next, a.prev {float:left;margin:0 2px;width:20px;text-align:center;text-decoration:none;height:20px}


a.next{background:url(../images/_next.png) no-repeat;}
a.prev{background:url(../images/_prev.png) no-repeat;}

a.next_{background:url(../images/_next_gray.png) no-repeat;}
a.prev_{background:url(../images/_prev_gray.png) no-repeat;}

a.page {color:#000}

a.paged {color:#f00}

.separator{width:100%;margin:30px auto;border-bottom:1px dotted #999;}

h3.title_top{margin:0;padding:0;padding-bottom:10px}

#main_area_homepage
	{
	float:left;
	background:#fcfbf6;
	min-height:800px;
	height:auto;
	/*width:800px;*/
	}

.h3_image{width:125px;height:185px;float:left;margin-right:10px;margin-left:5px;margin-bottom:5px}

.highlighted{background:blue;color:white}
.highlighted * {color:white}

.required{color:red}
h3.db{margin:0;margin-top:5px}
    </style>
    <?php
}



