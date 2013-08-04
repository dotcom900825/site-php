<!doctype html>  

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 

<html lang="en" class="no-js"> 

<!--<![endif]-->

<head>

	<meta charset="utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	
	<!-- * Facebook Share Preview Optimization-->
	<meta property="fb:app_id" content="434872899943225" /> 
	<meta property="og:title" content="iPassStore - George's at the Cove"/>
	<meta property="og:type"  content="website" /> 
	<meta property="og:url" content="https://www.ipassstore.com/Client/SD_Restaurant_Georges_At_The_Cove/"/>
	<meta property="og:image" content="https://www.ipassstore.com/resource/image/iPassStore_icon.png"/>
	<meta property="og:description" content="George's at the Cove Passbook Program"/>


	<!-- * Title-->
	<title>iPassStore - George's at the Cove</title>
	
	
	<link type="text/css" href="../../src/style/store.css" rel="stylesheet" />


</head>

<body>




<header id="site">
	<nav id="navigation" class="clearfix">
		<ul>
			<li class="logo"><a href="https://www.ipassstore.com" title="iPassStore"><h1>iPassStore</h1></a></li>
		
			<li class="menu home">
				<a href="https://www.ipassstore.com" title="iPassStore Home">Home</a>
			</li>
		
			<li class="menu partner">
				<a href="https://www.ipassstore.com/partner.html" title="iPassStore Partner">Partner</a>
			</li>
			
			<li class="menu advertise">
				<a href="https://www.ipassstore.com/advertise.html" title="iPassStore Advertise">Advertise</a>
			</li>
		
		
			<li class="search">
				<form id="search" action="" method="get">
					<fieldset>
						<label for="q">Search</label>
						<input name="q" type="text" placeholder="Search&hellip;" value=""/>
						<button type="search">Go</button>
					</fieldset>
				</form>
			</li>
		</ul>
	</nav>
</header>

<section id="content">
	

	<section id="promotions">
		<section class="banners">
			<h3>Featured Cards</h3>
			<div id="promotion_1" class="promotion"><a href="" target="_blank"><img src="../../resource/image/ad_left.png" width="340" height="130" alt="Card Info"></a></div>
			<div id="promotion_2" class="promotion"><a href="" target="_blank"><img src="../../resource/image/ad_right.jpeg" width="340" height="130" alt="Card Info"></a></div>
		</section>
			
	
	<!-- * Pass Info-->		
	<section id="product-info" class="collection">
		<header>
			<h2>George's at the Cove</h2>
		</header>
		
		<div class="product-info-wrapper stacks">
			<article>
				<aside>
					<img src="image/logo.png" width="128" height="128" />

					<ul class="metadata">
						<li><strong>Release Date:</strong> Aug 20, 2013</li>
						<li><strong>Requires:</strong> 
								
								<br/>
								<br/>iOS Passbook or<br/>
								<br/>Android PassWallet
							    
						</li>
						<li>
							<br/>
							<strong>Category: </strong>
							<a href="" title="View Similar Cards">Restaurant</a>
						</li>
						
					</ul>
				</aside>
				<div class="description summary">
					<h2>George's at the Cove</h2>
					
					
					<!-- Mobile Detect -->
					<?php

						require_once '../../../lib/class/Mobile_Detect.php';
						$detect = new Mobile_Detect;
						$iOSVersionRequired = 6.0;
						
						if( $detect->isMobile() && !$detect->isTablet() ){
							
							if ($detect->isAndroidOS()){
								
								$imgText = "Download PassWallet from Google Play Store and then tab the button below to add the card to your PassWallet.";
								$imgSource = "image/Add_to_PassWallet_244x80.png";
								$imgLink = "getpass.php";
								$imgWidth = "180";
								$imgHeight = "60";
							
							}
							else if ($detect->isiOS()){
								$iPhoneVersion = $detect->version('iPhone');
								$iPodVersion = $detect->version('iPod'); 
								
								if( $iPhoneVersion >= $iOSVersionRequired or $iPodVersion >= $iOSVersionRequired){
									
									$imgText = "Tab the button below to add the card to your Passbook.";
									$imgSource = "image/Add_to_Passbook_US_UK_2x.png";
									$imgLink = "getpass.php";
									$imgWidth = "180";
									$imgHeight = "60";
		
								}
							}
						
						}
						else{
								$imgText = "Scan the QR code below on your iPhone and open the link in Safari, then the card will be automatically saved to your Passbook.";
								$imgSource = "image/qrcode.png";
								$imgLink = "";
								$imgWidth = "128";
								$imgHeight = "128";
						}

					?>
					
					<p><?php echo $imgText?></p>
					
					<a href="<?php echo $imgLink?>"><img src="<?php echo $imgSource?>"  width="<?php echo $imgWidth?>" height="<?php echo $imgHeight?>"/></a>
	
					<p>Very simply, George’s at the Cove is for people who believe in enjoying the San Diego lifestyle to its fullest. And that includes a great meal. If you want a fine dining experience unlike any other, a special evening awaits at California Modern, featuring unique tasting menus from one of San Diego’s most admired chefs, Trey Foshee. If you’re in the mood for a more casual dining experience try the Ocean Terrace, acclaimed as the region’s best rooftop dining, or George’s Bar, a relaxed setting where indoors and outdoors flow together. <br/><br/>
					   
					   With our digital membership card, members can get latest event information, announcements as well as discount updates for membership card holders.</p>
					
					

				</div>
				
				<div class="card_screenshots">
					<ul>
						
							<li id="image-1">
								<img width="196" src="image/card_front.png" alt="" />
							</li>
						
							<li id="image-2">
								<img width="196" src="image/card_back.png" alt="" />
							</li>
							

						
					</ul>
				</div><br/><br/>
				
				
				<!-- * Social Box Starts-->
				<div class='social_box'>
					
					<!-- * Facebook Like Button-->					
					<div class="fb-like" data-href="https://www.ipassstore.com/Client/SD_Restaurant_Georges_At_The_Cove/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
				
					<!-- * Twitter Tweet Button-->
					<div class='twitter'><a href="http://twitter.com/share" data-url="https://www.ipassstore.com/Client/SD_Restaurant_Georges_At_The_Cove/" class="twitter-share-button" data-text="@iPassStore - Fill your Passbook and Stay Connected. Check it out: iPassStore.com" data-count="horizontal">&nbsp;</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>

			    </div>
				<!-- Social Box Ends-->
				
				<br/>
				
			<!-- * Comment Box -->
			<script src="comments/backsnap/assets/js/backsnap.js" data-backsnap-path="comments"  data-backsnap-page="georgesAtTheCove"></script>	
				
			</article>
		</div>
	</section>
	
			<!--Facebook Like Box-->
		<section class="collection">
			<div class="collection-facebook">
			<div class="fb-like-box" data-href="https://www.facebook.com/iPassStore" data-width="292" data-show-faces="false" data-stream="false" data-show-border="true" data-header="true"></div>
			</div> 
			<div class="collection-facebookDescription">
			Become a fan of the iPassStore page on Facebook for exclusive offers, new Passes and more.
			</div>
		</section>
					

	</section>
	


	<aside>
		
		<section id="popular" class="collection">
			<header>
				<h2>What&#039;s Hot</h2>
			</header>
			<ol class="collection-list">
				
					
<li>
	<div class="wrapper stacks">
		<a href="https://www.ipassstore.com/Client/DAILY_APP_GAME_Card/" title="Find out more about Free App of the Day">
			<img src="Client/DAILY_APP_GAME_Card/image/logo.png" width="48" height="48" />
			<h3>Free App of the Day</h3>
			<p>Free App<br>Entertainment</p>
		</a>
		<div class="info-bar">
			<a class="price" href="https://www.ipassstore.com/Client/DAILY_APP_GAME_Card/" title="Download">Download</a>
			<a class="info" href="https://www.ipassstore.com/Client/DAILY_APP_GAME_Card/">Information</a>
		</div>
	</div>
</li>

				
					
<li>
	<div class="wrapper stacks">
		<a href="https://www.ipassstore.com/Client/UCSD_UTA_Membership_Card/" title="Find out more about">
			<img src="Client/UCSD_UTA_Membership_Card/image/logo.png" width="48" height="48" />
			<h3>UCSD UTA</h3>
			<p>Student Organization</p>
		</a>
		<div class="info-bar">
			<a class="price" href="https://www.ipassstore.com/Client/UCSD_UTA_Membership_Card/" title="Download">Download</a>
			<a class="info" href="https://www.ipassstore.com/Client/UCSD_UTA_Membership_Card/" title="Find out more about">Information</a>
		</div>
	</div>
</li>

				
					
<li>
	<div class="wrapper stacks">
		<a href="https://www.ipassstore.com/Client/SD_Restaurant_Georges_At_The_Cove/" title="Find out more about George's">
			<img src="Client/SD_Restaurant_Georges_At_The_Cove/image/logo.png" width="48" height="48"/>
			<h3>George's</h3>
			<p>Restaurant<br>La Jolla, CA</p>
		</a>
		<div class="info-bar">
			<a class="price" href="https://www.ipassstore.com/Client/SD_Restaurant_Georges_At_The_Cove/" title="Download">Download</a>
			<a class="info" href="https://www.ipassstore.com/Client/SD_Restaurant_Georges_At_The_Cove/">Information</a>
		</div>
	</div>
</li>

				
					
<li>
	<div class="wrapper stacks">
		<a href="https://www.ipassstore.com/Client/UCSD_CSSA_Membership_Card/" title="Find out more about">
			<img src="Client/UCSD_CSSA_Membership_Card/image/logo.png" width="48" height="48" />
			<h3>UCSD CSSA</h3>
			<p>Student Organization</p>
		</a>
		<div class="info-bar">
			<a class="price" href="https://www.ipassstore.com/Client/UCSD_CSSA_Membership_Card/" title="Download">Download</a>
			<a class="info" href="https://www.ipassstore.com/Client/UCSD_CSSA_Membership_Card/" title="Find out more">Information</a>
		</div>
	</div>
</li>


				
			</ol>
		</section>
		
		<div class="banners middle">
			<div id="promotion_side" class="bsarocks bsap"><a href="" title="" target="_blank"><img src="../../resource/image/ad_side.png" width="220" height="110"></a></div>
		</div>
		
		
	
		<section id="new" class="collection">
			<header>
				<h2>Apps for Passbook</h2>
			</header>
			<ol class="collection-list">
				
					
<li>
	<div class="wrapper stacks">
		<a href="https://itunes.apple.com/us/app/apple-store/id375380948?mt=8" title="Find out more about Apple Store">
			<img src="" width="48" height="48" />
			<h3>Apple Store</h3>
			<p>Lifestyle</p>
		</a>
		<div class="info-bar">
			<a class="price" href="https://itunes.apple.com/us/app/apple-store/id375380948?mt=8" title="Download">Download</a>
			<a class="info" href="https://itunes.apple.com/us/app/apple-store/id375380948?mt=8" title="Find out more">Information</a>
		</div>
	</div>
</li>

				
					
<li>
	<div class="wrapper stacks">
		<a href="https://itunes.apple.com/us/app/fandango-movies-times-tickets/id307906541?mt=8&ign-mpt=uo%3D2" title="Find out more about Fandango">
			<img src="" width="48" height="48" />
			<h3>Fandango</h3>
			<p>Movie Tickets</p>
		</a>
		<div class="info-bar">
			<a class="price" href="https://itunes.apple.com/us/app/fandango-movies-times-tickets/id307906541?mt=8&ign-mpt=uo%3D2" title="Download">Download</a>
			<a class="info" href="https://itunes.apple.com/us/app/fandango-movies-times-tickets/id307906541?mt=8&ign-mpt=uo%3D2" title="Find out more">Information</a>
		</div>
	</div>
</li>

				
					
<li>
	<div class="wrapper stacks">
		<a href="https://itunes.apple.com/us/app/starbucks/id331177714?mt=8" title="Find out more about Starbucks">
			<img src="" width="48" height="48" />
			<h3>Starbucks</h3>
			<p>Food & Drinks</p>
		</a>
		<div class="info-bar">
			<a class="price" href="https://itunes.apple.com/us/app/starbucks/id331177714?mt=8" title="Download">Download</a>
			<a class="info" href="https://itunes.apple.com/us/app/starbucks/id331177714?mt=8" title="Find out more">Information</a>
		</div>
	</div>
</li>

				
					
<li>
	<div class="wrapper stacks">
		<a href="https://itunes.apple.com/us/app/discover-mobile/id338010821" title="Find out more about Discover Mobile">
			<img src="" width="48" height="48" />
			<h3>Discover Mobile</h3>
			<p>Finance</p>
		</a>
		<div class="info-bar">
			<a class="price" href="https://itunes.apple.com/us/app/discover-mobile/id338010821" title="Download">Download</a>
			<a class="info" href="https://itunes.apple.com/us/app/discover-mobile/id338010821" title="Find out more">Information</a>
		</div>
	</div>
</li>

				
					
<li>
	<div class="wrapper stacks">
		<a href="https://itunes.apple.com/us/app/ticketmaster/id500003565?mt=8" title="Find out more about Ticketmaster">
			<img src="" width="48" height="48" />
			<h3>Ticketmaster</h3>
			<p>Tickets</p>
		</a>
		<div class="info-bar">
			<a class="price" href="https://itunes.apple.com/us/app/ticketmaster/id500003565?mt=8" title="Download">Download</a>
			<a class="info" href="https://itunes.apple.com/us/app/ticketmaster/id500003565?mt=8" title="Find out more about">Information</a>
		</div>
	</div>
</li>

				
			</ol>
		</section>
	</aside>

</section>

	
	
		<footer>
			<nav>
				<ul>
					<li><a href="" title="Login and manage your passes">Developer Login</a></li>
				</ul>
			</nav>			
			<section class="notice">
				<p><strong>Notice:</strong> iPassStore is providing links to these Passes as a courtesy, and makes no representations regarding the Passes or any information related thereto. Any questions, complaints or claims regarding the Pass contents must be directed to the appropriate Pass vendor.</p>
			</section>
		</footer>
	
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.js"></script>
	<script type="text/javascript" src="../../src/scripts/html5.js"></script>
<script type="text/javascript" src="../../src/scripts/store.js"></script>


<!-- Facebook JavaScript SDK BEGIN -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=434872899943225";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<!-- Facebook JS SDK END -->	
	
  
</body>
</html>

