<?php
session_start();

require_once("db.php"); /*this opens the db*/

$connection = connectMysql(SERVER, USER, PWD, DB);

include_once("config.php"); /*this sets the path for the image, sets the absolute path*/
require_once("functions.php"); /*this drives the drop down list functions*/


//$_SESSION['trial'] = 'patrick';


$script_file_name=explode("/", $_SERVER['SCRIPT_FILENAME']);

$script_file_name=$script_file_name[count($script_file_name)-1];


?>



<?php echo "<?xml";?> version="1.0" encoding="utf-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>Buster Keaton Shorts Collection DVD Giveaway : Classic Movie Hub (CMH)</title>
    
     <script type="text/javascript">
    var deviceType="<?php echo $deviceType; ?>";
    </script>
    
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <?php require_once("css.php"); ?>
    

    <link href="/styles/jscal.css" type=text/css rel=stylesheet>
    
    <script type="text/javascript" src="/scripts/prototype.js"></script>
    
     <script type="text/javascript" src="/scripts/scriptaculous.js"></script>
			
	<style type="text/css">
	
	#preview{float:right;border:2px solid #000; background:#bff;padding:5px;height:auto;}
	
	#preview_container{float:right;width:430px;margin:5px auto; height:auto;}
	
	#preview #wish{margin-top:5px;padding-top:0;padding-left:0;margin-left:5px;}
	
	#message {/*width:250px;height:50px;*/float:left;width:250px;min-height:170px;}
	
	#sender_{float:right;padding-top:10px;}
	
	#thumbail_{float:left;margin:5px;margin-right:10px;width:115px;height:170px; background:url("images/thumbs/default.jpg") no-repeat;border:1px solid #aaa;}
	
	#message_{width:inherit;}
	
	#preview small{color:#aaa}
	
	#container_people{overflow:auto;max-height:200px;
}
	</style>
  </head>
    
	 <?php
    include("home_page_ad.php");
    ?>
  
		<div id="container">
	
			<?php include("_logo.php"); ?>
						
			<?php include("_header.php"); ?>
			<div class="clear"></div>
			
			<?php include ("_navbar_one.php"); ?>
			<!--<div class="clear"></div>	-->
			
								
			<div id="main">
			
				<div id="main_area_new_right_col">
			

<!-- WHY DOES BREADCRUMB GO AFTER THE GET SECTION in the main section, shouldn't it go before???-->

				<div id="breadcrumb">
							<div id="breadcrumb_left">	
				Promotions &gt; 
				
				
					
					<!--Top Movie Charts (Fan Favorites) &gt; 
					-->
					
					
					</div>
					
					

					
				</div><!--closed breadcrumb-->				
				
				<div class="clear"></div>
				
				
				<!--
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
				
				-->
				
			<div class="big_box" style="width800px;height:auto;margin-left:10px;margin-top:20px;background:#fff;padding-bottom:10px;border:solid 1px">
			
			
			<div style="padding-left:30px; padding-top:0px;margin-top=0px"><span style="margin-left:40px"><h3>Welcome to the "Buster Keaton: The Shorts Collection 1917-1923" DVD/Blu-Ray Giveaway!</h3>
			
			<b>From <span style="color:red; font-size:larger">MONDAY September 25 </span>through <span style="color:red; font-size:larger">SATURDAY October 29</b></span> Classic Movie Hub will be giving away a total of <b><span style="color:red">SIX/span></b> DVD or Blu-Ray copies of <b>
			<a rel="nofollow" href="http://amzn.to/28K6BMk">Buster Keaton: The Shorts Collection 1917-1923</a>





</b> courtesy of Kino Lorber!  
		
		
			
			</div>
				
		
			<div class="promo-images" style="margin:15px;margin-top:5px;padding-left:5px;padding-right:5px;height:400px;float:left">		
			
			
	
	<!--big image here, typically 250 w x 352 ish h-->		
		
	<a rel="nofollow" href="http://amzn.to/28K6BMk">	<img src="/images/promotions/keaton_dvd_250_px.jpg" style="float:left;margin-top:25px" /> </a>
		
	
			
				
				</div>
				
				
					
				    <div class="promotion_box" style="width:460px; float:left; padding:10px;padding-left:0;padding-right:15px;">
					
				
	
		<br/>
	
	
	<b>HERE's HOW YOU CAN ENTER:</b><br/><br/>
	
	<b><span style="color:red">TO ENTER via TWITTER (Six Chances to Win):</span></b>
	<br/>
	1) Follow <a href="https://twitter.com/ClassicMovieHub"><b>@ClassicMovieHub</b></a> on twitter for the contest announcements.<br/> 
	2) Successfully complete a qualifying entry task during the specified contest week.<br/>
	3) One winner will be chosen at random at the end of each specified contest week and announced on Twitter the following day.<br/>
	4) One Prize will be given away each specified contest week during the contest period, for a total giveaway of five Prizes within five weeks. 
		

	
		<br/>
		<br/>
		
		
		<b><span style="color:red">TO ENTER via FACEBOOK or the CMH Blog (One Chance to Win):</span></b>
		<br/>
	1) Visit us on <a href='https://www.facebook.com/ClassicMovieHub'>Facebook</a> or <a href='http://www.classicmoviehub.com/blog/'>the CMH Blog </a> for the contest announcement.<br> 
	2) Successfully complete a qualifying entry task during the specified contest period.<br>
	3)  One winner will be chosen at random at the end of the contest period and announced on Facebook and the Blog the following day.<br/>
    4)  One Prize will be given away during the contest period, for a total giveaway of one prize within four weeks.  	
	
	
	
		</br><br/><b>PLEASE NOTE for all prizing:</b> Sorry, but only Continental United States (excluding Alaska, Hawaii, and the territory of Puerto Rico) are eligible.
    			<br/>
		
	<br/><br/>	
	<b><span style="color:red">Can't wait to win? Buy it here:</span></b><br/><a rel="nofollow" href="http://amzn.to/2cx7Sbp">Buster Keaton: The Shorts Collection 1917-1923</a>


<br/>
	<p><b><span style="color:red">For more information </span>about these and other titles, you can visit Kino Lorber on their <a href='http://www.kinolorber.com/video-store.php?affiliate=clmh'>website</a>, on <a href='https://twitter.com/KinoLorber'>Twitter @KinoLorber</a> or on <a href='https://www.facebook.com/kinolorberinc'>Facebook</a>.</b>
	<br/><br/>		
	<br/><br/>		
					<a onclick="return false;" href="#terms" class="anchors">See Entry Rules</a> <span style="float:right; padding-right:50px"><a onclick="return false;" href="#description" class="anchors">More Info</a></span>
</p>		
<br/>		
			
			
			
			

					</div><!--closes promo box-->
					
					
					<div class="clear"></div>
					
<!--					
					<div style="margin: 0pt 0pt 0pt 20px; float: left; width: 400px; padding-top: 7px;" class="buttons">
						
						
						
						<a onclick="return false;" href="#description" class="anchors">Description</a>
						
						
						<a onclick="return false" href="#tracks" class="anchors">Tracks</a>
				
						<a onclick="return false;" href="#terms" class="anchors">Rules</a>
					</div>
					
				-->	
				
					
					
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
					
				
					
					<div class="clear"></div>
					
			
			
			
			
			
			
			
					
					<div class="padded_content wiki_wrapper thick_separator" id="description" style="margin-top:10px; width=800px;">
					
				
								
				
			


	
					
	<h3>About the Prize:</h3>
					
					<p><b>
					<a rel="nofollow" href="http://amzn.to/2cx7Sbp">Buster Keaton: The Shorts Collection 1917-1923</a>





					</b><br/>
					<br/>
					
					
					As new generations discover the magic of silent cinema, Buster Keaton has emerged as one of the era's most admired and respected artists. Behind the deadpan expression and trademark porkpie hat was a filmmaking genius who conceived and engineered some of the most breathtaking stunts and feats of visual trickery, while never losing sight of slapstick cinema's primary objective: laughter.
<br/><br/>
Produced by Lobster Films, BUSTER KEATON: THE SHORTS COLLECTION includes all 32 of Keaton's extant silent shorts (thirteen of which were produced under the tutelage of comedian Roscoe "Fatty" Arbuckle). These 2k restorations were performed utilizing archival film elements from around the world, and promises to be the definitive representation of Keaton's early career. Watching these films in succession, one witnesses the evolution of an artist -- from broad knockabout comedian into a filmmaker of remarkable visual sophistication.
<br/><br/>
Complete List of Films Contained in This Collection:
<br/><br/>
The Arbuckle-Keaton comedies, 1917-1920 <br/>
All films directed by Roscoe Arbuckle. <br/>
The Butcher Boy (1917)<br/> 
The Rough House (1917)<br/> 
His Wedding Night (1917) <br/>
Oh Doctor! (1917) <br/>
Coney Island (1917) <br/>
Out West (1918)<br/> 
The Bell Boy (1918) <br/>
Moonshine (1918) <br/>
Good Night, Nurse! (1918) <br/>
The Cook (1918) <br/>
Back Stage (1919) <br/>
The Hayseed (1919) <br/>
The Garage (1920)<br/>
<br/>
The Keaton silent short comedies, 1920-1923 <br/>
All films directed by Buster Keaton and Eddie Cline unless otherwise noted.<br/> 
One Week (1920) <br/>
Convict 13 (1920) <br/>
The Scarecrow (1920) <br/>
Neighbors (1920) <br/>
The Haunted House (1921) <br/>
Hard Luck (1921)<br/> 
The "High Sign" (1921) <br/>
The Goat (1921) (directed by Buster Keaton and Malcolm St. Clair) <br/>
The Play House (1921) <br/>
The Boat (1921) <br/>
The Paleface (1922) <br/>
Cops (1922) <br/>
My Wife's Relations (1922) <br/>
The Blacksmith (1922) (directed by Buster Keaton and Malcolm St. Clair) <br/>
The Frozen North (1922) <br/>
The Electric House (1922) <br/>
Day Dreams (1922) <br/>
The Balloonatic (1923) <br/>
The Love Nest (1923)<br/>
<br/>
The films in this collection are presented with orchestral scores by Frank Bockius, Neil Brand, Timothy Brock, Antonio Coppola, Stephen Horne, Robert Israel, The Mont Alto Motion Picture Orchestra, Dennis Scott, and Donald Sosin. 
<br/><br/>
Special Features: <br/>
* 24-page booklet with detailed film notes and essay by Jeffrey Vance, author of Buster Keaton Remembered<br/>
* The Blacksmith - Newly rediscovered alternate version of the 1922 comedy, containing four minutes of previously unseen material<br/>
* Coney Island - alternate (politically incorrect) ending
* My Wife's Relations - alternate ending<br/>
* Introduction by film preservationist Serge Bromberg (6 min.)<br/>
* Life with Buster Keaton (1951, excerpt) - Keaton reenacts Roscoe Arbuckle's "Salomé dance", first performed in The Cook<br/>

					
					

<br/>
					<br/>
					
					
					
		
					
					
			
				
				</p>

					
					
					</div>
					
					
					
					
					
					<a id="terms"></a>
					<div class="padded_content wiki_wrapper thick_separator" id="description" style="margin-top:10px"><b>Rules: </b><br/><br/>
					
					<b>TO ENTER via TWITTER (Five Chances to Win):</b>
	<br/>
	1) Follow <a href="https://twitter.com/ClassicMovieHub"><b>@ClassicMovieHub</b></a> on twitter for further instructions<br> 
	2) Successfully complete a qualifying entry task during the contest week<br>	
	<b>TO WIN:</b>One winner will be chosen at random at the end of each specified contest week. The winner will be announced on Twitter the day after the contest week ends 
	<br/><b>PRIZING:</b> One Prize will be given away each specified contest week during the contest period, for a total giveaway of five Prizes within five weeks.	Winners will have the choice of either DVD or Blu-Ray format for their Prize.
		
	
	
	
	
	
	
		<br/>
		<br/>
		
		
		<b>TO ENTER via FACEBOOK or the CMH Blog (One Chance to Win):</b>
		<br/>
	1) Visit us on <a href='https://www.facebook.com/ClassicMovieHub'>Facebook</a> or <a href='http://www.classicmoviehub.com/blog/'>the CMH Blog </a> for further instructions on how to enter. <br> 
	2) Successfully complete a qualifying entry task during the specified contest period.<br>
	
	<b>TO WIN:</b> One winner will be chosen at random at the end of the contest period. The winner will be announced on Facebook and the Blog one day after the contest period ends.
	<br/> <b>PRIZING:</b> One prize will be given away during the contest period, for a total giveaway of one prize within four weeks.  	
		
		
		
		
		
		
		
	<br/><br/>	
	
	
	
					
					<b>ELIGIBILITY for both versions of contest (Twitter and Facebook/Blog):</b>
					<br/>
					* Limited to Continental United States (excluding Alaska, Hawaii, and the territory of Puerto Rico) only.
					<br/>
					* Must be eighteen (18) years old and over as of the date of entry. 
				<br/>* Only one Prize per winner.

					
					<br/>* BlogHub Bloggers are eligible to enter. 

	
	
	
	

					
					<br/>
		
					
					* Giveaway starts Monday June 27, 2016 and ends on Saturday July 30, 2016 at midnight EST or when all Prizes are exhausted (whichever comes first). 
					<br/>
					* Each winner will be notified by email, Twitter DM or Facebook and will have 48 hours to respond with their shipping information or a new winner may be chosen. If any Prize or Prize notification is returned as undeliverable, the winner may be disqualified, and an alternate winner may be selected. 
					<br/>
					* Prizes will ship directly after the contest period is over.  Please allow up to 2 to 4 weeks for Prize delivery.Classic Movie Hub is not responsible for Prizes lost or stolen. 
			
					
					<br/>
					*Family of Classic Movie Hub are not eligible for entry.
					<br/>
					
				
				
			<br/>
		
		<br/>
			

					</div>
					
					</div><!--closes big box-->
				
	</div> <!--closes main div-->
			
			
				<!--
			-->
			
			<?php
			include ("_right_col_films_ads.php");
			?>
				<div class="clear"></div>
			
			
				</div><!--closes main-->
			
			
			<?php include ("_footer.php"); ?>
			
	


	</div> <!--closes container-->
		
			<?php include("home_page_ad2.php"); ?>
		
		<script src="/scripts/stats_box.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="/scripts/greetings.js"></script>
	</body>
	
</html>
<?php
include("end_cache.php");
?>


