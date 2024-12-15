			<div id="header">
				
			<div id="title_area">
				<h1>Classic Movie Hub</h1>
				<h3>Classic Movie Favorites by Fans for Fans!</h3>
			</div>
			
			<div id="sign_in_area">
			<?php
			
			$query=trim($_GET['q']);
			
			//echo $_SESSION['user_id']."<br/>";
			
			$beta_logout='';
			
			if(isset($_SESSION['beta_user']{0}))
			$beta_logout='<a href="beta_logout.php" style="background:red;color:#fff;">Beta logout</a>';
			
			echo '<a href="about.php">About Us</a> '.$beta_logout.'<br/>
			
			<div id="ajax_login_out"></div>';
			
		
			?>
			</div>
			
			
			
			<!--adding form here, IT WASN'T HERE BEFORE trying new div-->
			
			<div class="search_bar">
			
			<a href="http://www.facebook.com/pages/Classic-Movie-Hub/196277333745518#!/pages/Classic-Movie-Hub/196277333745518?sk=wall" class="fb"></a><a href="http://twitter.com/#!/ClassicMovieHub" class="twitter"></a><a href="http://classicmoviehub.tumblr.com/" class="tumblr"></a> <a href="http://www.youtube.com/channels?ytsession=DFb-AYXCWRCpvCh0Il-u0cjwOP8R1hrvGpLoKXlj2MeXGDyntINljJMlGspOS845oFtllquDNXQFskWa2jG4fXLQOh5fQjPP1UtB9YuVyS4ElcSdQ1J3xBCxufQAug0OJAiUuihAr87m8bzL5cIQ4bio0U_gqtk3CE56nslAv4HE06Uz5QE811c0d0yDVg90u_JHX1dunvN2QwsnpD-CgLE6b-j8AoqHVYbfyl0gZO2NCsoeVoJkH92JEszvd6zzezJQhQEfi8xad_5F-Njk8UfbO4G0Ox2b" class="yt"></a>
	
	<div class="clear"></div>
	
					<form name="frm" action="search.php" method="get" style="margin-top:10px;">
					<input type="text" name="q" id="q" value="<?php
					
					if(!isset($query{0})) echo 'Search site'; else echo $query;
					
					?>"
					
					onclick=" if(this.value=='Search site') this.value=''" onblur="if(this.value=='') this.value='Search site'" />
					
					<input type="submit" name="submit" id="submit" value="OK" />
					</form>
					
				</div> <!--closes search_bar div-->
			
			
			
			
			
			
			</div> <!--closes header-->
