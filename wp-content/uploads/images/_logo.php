<?php

//mysqli_query($GLOBALS['connection'], "SET SQL_BIG_SELECTS=1");
//mysqli_query($GLOBALS['connection'], "SET SQL_MAX_JOIN_SIZE=10");

//die("lol");
//

?>
			<div id="logo">
			
			<?php
			if($deviceType=="computer")
			{
			?>
			
			<div style="margin-top:10px;margin-left:12px" >
			
			



<div style="float:left;width:133px;height:90px; margin-left: 5px; margin-right:0px; margin-top: 10px;">
	
	<a class="logo_link" href="http://www.classicmoviehub.com/" title="Classic Movie Hub (CMH)" alt="Classic Movie Hub (CMH)">
	
	<img src="/images/logo_110.jpg" border="0" title="Classic Movie Hub (CMH)" alt="Classic Movie Hub (CMH)" />
	
	</a></div>
	


<!-- 

<div class="alignleft">  
<iframe src="http://rcm-na.amazon-adsystem.com/e/cm?t=classicmovi04-20&o=1&p=20&l=ur1&category=music&banner=0VB7CHQ6P5VWBG2VC6G2&f=ifr&linkID=DNGQ36LN3COVALFP" width="120" height="90" scrolling="no" border="0" marginwidth="0" style="border:none;max-width:800px;max-height:600px;" frameborder="0"></iframe>


</div>


-->


</div>






<?php
}
else
{
echo '<div class="ten_p to_right new_logo"><a href="http://www.classicmoviehub.com/" title="Classic Movie Hub (CMH)" alt="Classic Movie Hub (CMH)"><img src="/images/logo.jpg" border="0" title="Classic Movie Hub (CMH)" alt="Classic Movie Hub (CMH)" /></a></div> <div class="ten_p to_left menu_trigger"></div>';
}
?>			

</div>	
			<!-- --closes header-->
