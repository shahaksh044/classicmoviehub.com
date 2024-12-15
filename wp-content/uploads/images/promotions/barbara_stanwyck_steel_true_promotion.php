<?php
session_start();

require_once("db.php"); /*this opens the db*/

$connection = connectMysql(SERVER, USER, PWD, DB);

include_once("config.php"); /*this sets the path for the image, sets the absolute path*/
require_once("functions.php"); /*this drives the drop down list functions*/


//$_SESSION['trial'] = 'patrick';

$array_non_canonical_url_arguments=array("from", "cache");

$script_file_name=explode("/", $_SERVER['SCRIPT_FILENAME']);

$script_file_name=$script_file_name[count($script_file_name)-1];

$canonical_url='http://www.classicmoviehub.com/'.$script_file_name.'?';

include("canonical_url_maker.php");
?>



<?php echo "<?xml";?> version="1.0" encoding="utf-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>"A Life of Barbara Stanwyck: Steel-True 1907-1940" Book Giveaway! : Classic Movie Hub (CMH)</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="styles/main.css" type=text/css rel=stylesheet>
    
<link rel="canonical"  href="<?php echo $canonical_url; ?>" />


    <link href="styles/jscal.css" type=text/css rel=stylesheet>
    
    <script type="text/javascript" src="scripts/prototype.js"></script>
    
     <script type="text/javascript" src="scripts/scriptaculous.js"></script>
			
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
			
			
			<div style="padding-left:30px; padding-top:0px;margin-top=0px"><span style="margin-left:40px"><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--Welcome to the -->"A Life of Barbara Stanwyck: Steel-True 1907-1940" Book Giveaway!</h3>
			
			<b><span style="color:red; font-size:larger">FROM MONDAY December 2 through FRIDAY December 27</b></span> Classic Movie Hub will be giving away a total of <b><span style="color:red">FOUR</span></b> copies of <b>
			<a href="http://www.amazon.com/gp/product/0684831686/ref=as_li_ss_tl?ie=UTF8&camp=1789&creative=390957&creativeASIN=0684831686&linkCode=as2&tag=classicmovi04-20">"A Life of Barbara Stanwyck: Steel-True 1907-1940"</a><img src="http://ir-na.amazon-adsystem.com/e/ir?t=classicmovi04-20&l=as2&o=1&a=0684831686" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />

</b> by Victoria Wilson, <br/>courtesy of <a href='http://books.simonandschuster.com/Life-of-Barbara-Stanwyck/Victoria-Wilson/9780684831688'>Simon and Schuster!</a> That's one book a week for four weeks!  
		
		
			
			</div>
				
		
			<div class="promo-images" style="margin:15px;margin-top:5px;padding-left:5px;padding-right:5px;height:400px;float:left">		
			
			
		<a href="http://www.amazon.com/gp/product/0684831686/ref=as_li_ss_il?ie=UTF8&camp=1789&creative=390957&creativeASIN=0684831686&linkCode=as2&tag=classicmovi04-20">
	<img src="images/promotions/stanwyckbook250w.jpg" style="float:left;margin-top:25px" /> 
<img src="http://ir-na.amazon-adsystem.com/e/ir?t=classicmovi04-20&l=as2&o=1&a=0684831686" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />

			
			
			
				
				</div>
				
				
					
				    <div class="promotion_box" style="width:460px; float:left; padding:10px;padding-left:0;padding-right:15px;">
					
				
	<!--	
	<span style=""><h3>Welcome to the AVA GARDNER: The Secret Conversations Book Giveaway!</h3>-->
	<!--	
		<b><span style="color:red; font-size:larger">FROM MONDAY July 1 through FRIDAY July 26: </b></span> <br/>Classic Movie Hub will be giving away a total of <b><span style="color:red">FOUR</span></b> copies of <b>
	
		
		
		<a href="http://www.amazon.com/gp/product/1451627696/ref=as_li_ss_tl?ie=UTF8&camp=1789&creative=390957&creativeASIN=1451627696&linkCode=as2&tag=classicmovi04-20">Ava Gardner: The Secret Conversations</a><img src="http://www.assoc-amazon.com/e/ir?t=classicmovi04-20&l=as2&o=1&a=1451627696" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
</b> by Peter Evans and Ava Gardner, courtesy of Simon and Schuster! That's one book a week for four weeks!  
		-->
		
		<!--<br/>-->
		<br/>
	<!--	<b>IN A NUTSHELL:</b> All you have to do to enter is follow <a href="https://twitter.com/ClassicMovieHub"><b>@ClassicMovieHub</b></a> on twitter, complete a few entry tasks during the week, and then tweet the answer to a special trivia question on Friday night*. The first person to successfully complete the entry tasks and correctly answer the trivia question wins a copy of the book! Then on Sunday, May 5 (after all five winners have been chosen), there will be a special drawing to determine which winner receives the exclusive autographed copy of the book.-->
		
	
	<b>IN A NUTSHELL:</b> All you have to do to enter is:<br/><br/>
	1) Follow <a href="https://twitter.com/ClassicMovieHub"><b>@ClassicMovieHub</b></a> on twitter (for further instructions)<br> 
	2) Successfully complete a qualifying entry task during the contest week<br>
	3) Tweet the correct answer to a special trivia question on Friday night <br/>
	
	
	
	
	
	<br/><b>TO WIN:</b> Be the FIRST PERSON to successfully complete the qualifying entry task AND correctly answer the trivia question for the given contest week.
	<br/><br/> <b>PRIZING:</b> One book will be given away each week during the contest period, for a total giveaway of four books within four weeks.  	
		
	
		<br/>
		
		
		<br/><b>BLOGHUB BLOGGERS:</b> YES, you ARE eligible to enter too!
		<br/>
		<br/><b>PLEASE NOTE:</b> Only Continental United States entries are eligible.
    			<br/>
		<br/><b>PRIZES:</b> All prizes will ship directly after the contest period is over.
	<br/><br/>	
	
		
	
				
					<a onclick="return false;" href="#terms" class="anchors">See Entry Rules</a> <span style="float:right; padding-right:50px"><a onclick="return false;" href="#description" class="anchors">More Info</a></span>
<br/>		
			
			<h4><a href="http://www.amazon.com/gp/product/0684831686/ref=as_li_ss_tl?ie=UTF8&camp=1789&creative=390957&creativeASIN=0684831686&linkCode=as2&tag=classicmovi04-20">Buy "A Life of Barbara Stanwyck: Steel-True 1907-1940"</a><img src="http://ir-na.amazon-adsystem.com/e/ir?t=classicmovi04-20&l=as2&o=1&a=0684831686" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />



				</h4>
			
			
			<!--
				
					<span style="">Sorry, Contest is Over! CONGRATULATIONS to the TEN LUCKY WINNERS! Your Doris Day <a onclick="return false;" href="#description" class="anchors">"With a Smile and a Song"</a> 2-CD Sets from Sony Masterworks will ship out shortly!<br/><br/>With a Smile and a Song features <a onclick="return false" href="#tracks" class="anchors">30 tracks</a> curated by Doris Day herself!</span><br/><br/>
					<span style="font-size:smaller><a href="#terms">Please Join or Log In above to Rate Movies Now!</a><br/><br/>
					<a onclick="return false;" href="#terms" class="anchors">Please see below for entry rules.</a></span>
					
					-->

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
					
				
				<h3>CMH is honored to present: An Interview with Victoria Wilson:</h3>
					
					<p>
					


<span style="color:blue">CMH:</span> You’ve spent much of your career on the ‘business’ side of publishing, most notably as Vice President and Senior Editor for Alfred A. Knopf. What compelled you to ‘turn’ author and write such an extensive biography about Barbara Stanwyck?
<br/>
<span style="color:blue">Victoria Wilson:</span> I’ve published many biographies over the years and enjoyed working with writers on their research, discussing it, thinking about it and how it revealed their subject – and one day the impulse came to me to write a life of someone.  I made a long list of possible subjects and Stanwyck was on the list.  I realized there had not been a serious book on her before and that she deserved one – and off I went into
Stanwyck-land… &nbsp;&nbsp;&nbsp;<b> <br/><br/><a href="http://www.classicmoviehub.com/blog/?p=6941">Read Full Interview Here: Steel-True and Blade-Straight: An Interview with Victoria Wilson</a></b>				
					</p>
					<br/>
					<hr/>
					
	<h3>About the book:</h3>
					
					<p><b>
					<a href="http://www.amazon.com/gp/product/0684831686/ref=as_li_ss_tl?ie=UTF8&camp=1789&creative=390957&creativeASIN=0684831686&linkCode=as2&tag=classicmovi04-20">A Life of Barbara Stanwyck: Steel-True 1907-1940</a><img src="http://ir-na.amazon-adsystem.com/e/ir?t=classicmovi04-20&l=as2&o=1&a=0684831686" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />


					</b><br/>
					<br/>
					<b>Frank Capra called her “The greatest emotional actress the screen has yet known.” She was one of its most natural, timeless, and underrated stars. Now, Victoria Wilson gives us the first full-scale life of Barbara Stanwyck, whose astonishing career in movies (eighty-eight in all) spanned four decades beginning with the coming of sound, and lasted in television from its infancy in the 1950s through the 1980s—a book that delves deeply into her rich, complex life and explores her extraordinary range of motion pictures, many of them iconic. Here is her work, her world, her Hollywood.</b>
					<br/><br/><b>
					Writing with the full cooperation of Stanwyck’s family and friends, and drawing on more than two hundred interviews with actors, directors, cameramen, screen­writers, costume designers, et al., as well as making use of letters, journals, and private papers, Victoria Wilson has brought this complex artist brilliantly alive. Her book is a revelation of the actor’s life and work. </b>
					<br/><br/>
					<b><a href='http://books.simonandschuster.com/Life-of-Barbara-Stanwyck/Victoria-Wilson/9780684831688'>Read More at Simon and Schuster</a></b>
					
				
				
				
				
				
				
				
				</p>

					
					
					</div>
					
					
					
					
					
					<a id="terms"></a>
					<div class="padded_content wiki_wrapper thick_separator" id="description" style="margin-top:10px"><b>Rules: </b><br/><br/>
					
					
					<b>TO ENTER:</b>
					<br/>
					
	
	
	1) Follow <a href="https://twitter.com/ClassicMovieHub"><b>@ClassicMovieHub</b></a> on twitter (for further instructions)<br> 
	2) Successfully complete a qualifying entry task during the contest week<br>
	3) Tweet the correct answer to a special trivia question on Friday night <br/>
	
	<br/><b>TO WIN:</b> Be the FIRST PERSON to successfully complete the qualifying entry task AND correctly answer the trivia question for the given contest week.
	<br/><br/> <b>PRIZING:</b> One book will be given away each week during the contest period, for a total giveaway of four books within four weeks.  
	
	
	
	
					<br/><br/>
					
					<b>ELIGIBILITY:</b>
					<br/>
					* Limited to Continental United States residents (excluding Alaska, Hawaii, and the territory of Puerto Rico).
					<br/>
					* Must be eighteen (18) years old and over as of the date of entry. 
				<br/>* Only one book per winner.

					
					<br/>* BlogHub Bloggers are eligible to enter. 

	
	
	
	

					
					<br/>
					
					
					
					* Giveaway starts Monday December 2, 2013 and ends on Friday December 27, 2013 at midnight EST or when all prizes are exhausted (whichever comes first). 
					<br/>
					* Each winner will be notified by email or DM and will have 48 hours to respond with their shipping information or a new winner may be chosen. If any Prize or Prize notification is returned as undeliverable, the winner may be disqualified, and an alternate winner may be selected. 
					<br/>
					* Prizes will ship directly after the contest period is over.  Please allow up to 2 to 4 weeks for prize delivery.Classic Movie Hub is not responsible for prizes lost or stolen. 
			
					
					<br/>
					* Friends and Family of Classic Movie Hub are not eligible for entry.
					<br/>
					* Classic Movie Hub was not paid for this giveaway or post. 
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
		
		<script src="scripts/stats_box.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="scripts/greetings.js"></script>
	</body>
	
</html>
<?php
include("end_cache.php");
?>


