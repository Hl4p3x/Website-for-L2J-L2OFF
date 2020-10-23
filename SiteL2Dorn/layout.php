<?php if(!$indexing) { exit; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--
	
	Desenvolvido pela Atualstudio
	www.atualstudio.com

          ##########
       ################
    ######          ######
   #####              #####
  ####         ....    ####
 ####        ########  ####
 ####       ########## ####
  ####      ########## ####
  #####       ######## ####
   #####        ****** ####
     ######################
         ################
	
	Website Version 4.0
	
-->
<?php require('private/seo.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="keywords" content="<?php echo strtolower($server_name.', '.$server_chronicle); ?>, l2, lineage, lineage2, lineage 2, lainiege, laineage, lainiage, lineage dois, lineage ii, internacional, international, portuguese, english, espanish, espanol, espanhol, portugues, ingles, gringo, br, 1x, 5x, 10x, 30x, 50x, 70x, 100x, 150x, 200x, 300x, 1000x, free fun, diversao gratis, gratuito, gratuitamente, free fun, new server, novo servidor, o melhor servidor de lineage 2, o melhor servidor"/>
<meta name="description" content="<?php echo $SEO['description']; ?>"/>
<link rel="shortcut icon" href="./imgs/favicon.ico">
<title><?php echo $SEO['title']; ?></title>
<link rel="image_src" href="http://<?php echo $server_url; ?>/imgs/image_src.jpg" />
<meta property="og:title" content="<?php echo $SEO['title']; ?>" />
<meta property="og:site_name" content="<?php echo $server_name; ?>" />
<meta property="og:url" content="http://<?php echo $server_url; ?>" />
<meta property="og:description" content="<?php echo $SEO['description']; ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="http://<?php echo $server_url; ?>/imgs/image_src.jpg" />

<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/global.css?1" media="all" />

<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/global.js?1"></script>



<script id="_wauw5z">var _wau = _wau || [];
_wau.push(["tab", "6sk25jlcs0jz", "w5z", "right-middle"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="//widgets.amung.us/tab.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();</script>
<!-- Begin l2topzone.com vote code --> <a href="https://l2topzone.com/vote/id/14702" style="position: fixed; z-index:99999; bottom: 0; right: 0;" target="_blank" title="l2topzone" ><img src="https://l2topzone.com/rbbanner2.png" alt="New server Lineage 2, the list of servers, announcements of Lineage 2" title="New server Lineage 2, the list of servers, announcements of Lineage 2" border="0"></a> <!-- End l2topzone.com vote code -->

	
</head>
<body>
  
	

<?php if($faceBoxOn == 0) {
echo "
<div id=\"fb-root\"></div>
<script>
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = \"//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.7&appId=577018195656213\";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
";
}
?>

<div class='all <?php echo $language; ?>'>
	
	<div class='langs'><?php $addp = "&url=http://".urlencode($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?>
		<div class='bg'></div>
		<div class='links'>
			<a href='?changelang=en' class='en' title='English' onclick="document.location.replace('./index.php?changelang=en<?php echo $addp; ?>');return false;"></a>
			<a href='?changelang=pt' class='pt' title='Portugu&ecirc;s' onclick="document.location.replace('./index.php?changelang=pt<?php echo $addp; ?>');return false;"></a>
			<a href='?changelang=es' class='es' title='Espa&ntilde;ol' onclick="document.location.replace('./index.php?changelang=es<?php echo $addp; ?>');return false;"></a>
		</div>
	</div>
	
	
		
		<nav>
		<a class='o1' href='./'><span></span></a>
		<span class='o2'>
			<span></span>
			<div>
				<a href='./?page=register'>Register</a>
				<a href='./?page=changepass'>Change Password</a>
				<a href='./?page=forgot'>Recover</a>
			</div>
		</span>
		<span class='o3'>
			<span></span>
			<div>
				<a href='./?page=download'>Downloads</a>
				<a href='./?page=info' target='_blank'>Informations</a>
				<a href='./?page=support'>Support</a>
				<a href='./?page=rules'>Rules</a>
				<a href='./?page=donations'>Donations</a>
			</div>
		</span>
		<span class='o4'>
			<span></span>
			<div>
				
				<a href='./?page=toppvp'>Top PvP</a>
				<a href='./?page=toppk' class='ativa'>Top Pk</a>
				<a href='./?page=toponline'>Top Online</a>
				<a href='./?page=topclan'>Top Clan</a>
				<a href='./?page=oly_rank'>Grand Olympiad</a>
				<a href='./?page=boss'>Boss Status</a>
				<a href='./?page=siege'>Castle & Siege</a>
							</div>
		</span>
		<a class='o5' href='ucp/index.htm'><span></span></a>
		<a class='o6' href='../lineage2dorn.com/forum/index.htm' target='_blank'><span></span></a>
	</nav>
	
	<div class='central_top_banners'>
		<div>
			<a href='./?page=register' class='b1'><span></span></a>
			<a href='./?page=donations' class='b2'><span></span></a>
		</div>
	</div>
			
			
			
		<section>
		
		<aside>
			
			<div class='box'>
				
				
				<?php if($logged != 1) { ?>
				
					<div class='loginarea'>
						<img src='imgs/nm/loader.gif' style='width:0;height:0;display:none;' />
						<form id='login_form' action='<?php echo (file_exists('ucp/engine/login.php') ? "./ucp/?engine=login&fromsite" : "./?engine=login"); ?>' method='POST'>
							<?php
							$_SESSION['lkey'] = md5(time().rand(100,999).$uniqueKey); echo "<input type='hidden' name='lkey' value='".$_SESSION['lkey']."' />";
							if(isset($_GET['lerror'])) {
								echo "<div class='error'>".((intval($_GET['lerror']) == 1) ? $LANG[11979] : $LANG[11990])."</div>";
							}
							?>
						<div class='avatar' style='background-image: url(imgs/avatar/dark_male.jpg);'><span></span></div>
							<div class='fieldsBox'>
								<label>
									<input type='text' name='ucp_login' class='inpt user' placeholder='Login' title='Username' autocomplete='off' />
									<div class='acc_icon user'></div>
								</label>
								<label>
									<input type='password' name='ucp_passw' class='inpt pass' placeholder='Password' title='Password' autocomplete='off' />
								</label>
								<?php if($captcha_cp_on == 1) {
									echo "<input type='button' onclick='opencaptcha();' class='gologin' value='' />";
								} else {
									echo "<input type='submit' class='gologin' value='' />";
								} ?>
								
								<div class='ess'><a href='./?page=forgot'>Forgot your password?</a></div>
							</div>
							<input type='hidden' value='<?php echo md5(uniqid()) ?>' name='ucp_uniqid' id='ucp_uniqid' />
							<input type='hidden' value='' name='captcha' id='ucp_captcha' />
						</form>
					</div>
					
				<?php } else { ?>
				<center>
				    <div class='title'>Account Menu</div>
				
					<?php if(file_exists('ucp/index.php')) { ?><a href='./ucp' class='default'>DASHBOARD</a><?php } ?>
					<a href='./?page=ucp_changepass' class='default'><?php echo $LANG[12022]; ?></a>
					<?php if($chaemail == 1) { ?><a href='./?page=ucp_changeemail' class='default'><?php echo $LANG[11014]; ?></a><?php } ?>
					<?php if($dpage['unstuk'] == 1) { ?><a href='./?page=ucp_unstuck' class='default'>Unstuck Char</a><?php } ?>
					<a href='./?engine=logout' class='default'><?php echo $LANG[12023]; ?></a>
					
							<a class='default'><?php echo $LANG[12021]; ?> <span><?php echo $_SESSION['acc']; ?></span></a>
					</center>
				<?php } ?>
				
				
					
			</div>

	
	
			
			<?php
			
			if($forceLoginStatus == 'on') { $loginStatus = 'on'; }
			elseif($forceLoginStatus == 'off') { $loginStatus = 'off'; }
			else {
				$check_game = @fsockopen(''.$serverIp.'', ''.$loginPort.'', $errno, $errstr, 1);
				if($check_game){ $loginStatus = 'on'; } else { $loginStatus = 'off'; }
			}
			
			if($forceGameStatus == 'on') { $gameStatus = 'on'; }
			elseif($forceGameStatus == 'off') { $gameStatus = 'off'; }
			else {
				$check_game = @fsockopen(''.$serverIp.'', ''.$gamePort.'', $errno, $errstr, 1);
				if($check_game){ $gameStatus = 'on'; } else { $gameStatus = 'off'; }
			}
			
			if($showPlayersOn == '1') {
				$cacheFile = "cache/playerson.xml";
				$genNew = 0;
				if(!file_exists($cacheFile)) { $genNew = 1; } else {
					$xml = simplexml_load_file($cacheFile);
					$configs = $xml->configs;
					$updated = intval($configs->updated);
					$delay = 1;
					if(($updated+($delay*60)) < time()) {
						$genNew = 1;
					}
				}
				if($genNew == 1) {
					require("private/playerson.php");
				}
				$playersOnline = $xml->players; $playersOnline = intval($playersOnline[0]->online);
				echo "";
			}
			?>


	
	        <div class='box'>
				<div class='server_status'>
					<span class='s1 off'>OFFLINE</span><span class='s2'><?php echo intval($playersOnline*$fakePlayers); ?></span>				</div>
			</div>
	
	
	
	
	<div class='box'>
				<div class='title'>Donations</div>
				<a href='./?page=donations' class='donateBanner'><span></span></a>
			</div>
			
	<div class='box'>
	    <center>
				<div class='title'><?php echo $LANG[40001]; ?></div>
				<?php
				echo "
				".($dpage['toppvp'] == 1 ? "<a href='./?page=toppvp' class='default'>Top PvP</a>" : "")."
				".($dpage['toppkp'] == 1 ? "<a href='./?page=toppk' class='default'>Top Pk</a>" : "")."
				".($dpage['toponl'] == 1 ? "<a href='./?page=toponline' class='default'>Top Online</a>" : "")."
				".($dpage['topcla'] == 1 ? "<a href='./?page=topclan' class='default'>Top Clan</a>" : "")."
				".($dpage['csiege'] == 1 ? "<a href='./?page=siege' class='default'>Castle & Siege</a>" : "")."
				".($dpage['bosstt'] == 1 ? "<a href='./?page=boss' class='default'>Boss Status</a>" : "")."
				";
				?>
				
				</center>
			</div>
			
			
				<?php
			if($dpage['galler'] == 1) {
				echo "
				<div class='box'>
				
				<center>
					<div class='title'>".$LANG[12026]."</div>
					<div class='galleryBox'><div>
						";
						$xml = @simplexml_load_file("cache/gallery.xml");
						$line = @$xml->line;
						$asideRankCount = (!empty($galleCount) ? intval($galleCount) : 4);
						if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
						if($asideRankCount > 0) {
							for($i=0, $c=$asideRankCount; $i < $c; $i++) {
								if(intval($line[$i]->isvideo) != '1') {
									echo "
									<a href='".$dir_gallery.$line[$i]->url."' rel='prettyPhoto[fullGallery]'>
										<img src='".$dir_gallery."thumbnail/".$line[$i]->url."' />
										<div></div>
									</a>
									";
								} else {
									echo "
									<a href='//www.youtube.com/watch?v=".$line[$i]->url."&rel=0' class='iframe' rel='prettyPhoto[fullGallery]'>
										<img src='".$dir_gallery."thumbnail/".$line[$i]->url.".jpg' />
										<div></div>
										<span></span>
									</a>
									";
								}
							}
						}
						for($i=$asideRankCount, $c=(!empty($galleCount) ? intval($galleCount) : 4); $i < $c; $i++) {
							echo "<a href='javascript:void(0)'><div></div></a>";
						}
						echo "
					</div></div>
					<a style='margin-top:4px;' class='default' href='./?page=gallery'>".$LANG[12027]."</a>
				</center>	</div>";
			}
			?>

	</aside>
		
	<div class='borderArticle'>
			<article>
			    
			<div class='page'>
				<?php
				require('pages/'.$p.'.php');
				?>
			</div>
			</div>
		</article>
		
	
	

	
	
			<div class='statsIcons'>
			<a href='./?page=download' class='i1' title='Download Server Files'><span></span></a>
			
			<a href='./?page=oly_rank' class='i2' title='Grand Olympiad'><span></span></a>
			<a href='./?page=siege' class='i3' title='Castle & Siege'><span></span></a>
			<a href='./?page=boss' class='i4' title='Boss Status'><span></span></a>
			<a href='./?page=topclan' class='i5' title='Top Clan'><span></span></a>
					</div>
					
				</div>		
	</section>

		

		
<script type='text/javascript'>
$(document).ready(function(){
	$('article').css({ 'min-height': ''+($('aside').height())+'px' });
});
</script>



<footer>
	
	<hr />
	
	<div style='display: table; width: 100%;'>
	
		<div class='l'>
			
			<div class='vote'>
				<a href="#" target="_blank"><img src="https://l2topzone.com/90x60.png"></a>
				<a href="#" target="_blank"><img src="https://hopzone.r.worldssl.net/img/_vbanners/lineage2/lineage2-90x60-1.gif"></a>
				<a href="#" target="_blank"><img src="https://l2network.eu/images/button2.png"></a>
				<span></span>
			</div>
			
		
		</div>
		
	
		
		
	</div>
	
</footer>




<div class='copyright'><div>
	Lineage II Dorn - x100
	<a class='interlude2' href='http://www.atualstudio.com' title='This site was developed by Atualstudio' target='_blank'></a>
	<a class='atualstudio' href='http://www.atualstudio.com' title='This site was developed by Atualstudio' target='_blank'></a>
</div></div>

<div class="footer-logos">
		<h1>COPYRIGHT &copy; <script type="text/javascript">var d = new Date(); document.write(d.getFullYear());</script> LINEAGE II DORN - SERVER CREATED by =TREMERE=.</h1>
		<h1>Lineage II and all associated logos and designs are trademarks or registered trademarks of NCSOFT Corporation.
		All other trademarks or registered trademarks are property of their respective owners.</h1>
	</div>
</div>
<div class="footer1"></div>

<!-- PrettyPhoto -->
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script><script type="text/javascript" charset="utf-8">$(document).ready(function(){ $("a[rel^='prettyPhoto']").prettyPhoto({ theme: 'atualstudio', social_tools: '', markup: '<div class="pp_pic_holder"><div class="ppt">&nbsp;</div><div class="pp_top"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div><div class="pp_content_container"><div class="pp_left"><div class="pp_right"><div class="pp_content"><div class="pp_loaderIcon"></div><div class="pp_fade"><a href="#" class="pp_expand" title="Expand the image">Expand</a><div class="pp_hoverContainer"><a class="pp_next" href="#">next</a><a class="pp_previous" href="#">previous</a></div><div id="pp_full_res"></div><div class="pp_details"></div></div></div></div></div></div><div class="pp_bottom"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div></div><div class="pp_overlay"></div>' }); });</script>

<!-- Important Terms to JS Scripts -->
<input type='hidden' id='l11015' value='<?php echo ($LANG[11015]); ?>' /><input type='hidden' id='l12055' value='<?php echo ($LANG[12055]); ?>' /><input type='hidden' id='l11017' value='<?php echo ($LANG[11017]); ?>' /><input type='hidden' id='l11018' value='<?php echo ($LANG[11018]); ?>' /><input type='hidden' id='l20001' value='<?php echo ($LANG[20001]); ?>' /><input type='hidden' id='l40044' value='<?php echo ($LANG[40044]); ?>' />


<!-- Facebook PopUp -->
<?php if($facePopupOn == 1) {
echo "
<div id='fanback'><div id='fan-exit'></div><div id='fanbox'><div id='fanclose'></div><iframe src='//www.facebook.com/plugins/likebox.php?href=".$facePage."&amp;width=402&amp;height=255&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23E2E2E2&amp;stream=false&amp;header=false&amp;appId=577018195656213' scrolling='no' frameborder='0' allowTransparency='true'></iframe></div></div>
<script src='js/jquery.cookie.js' type='text/javascript'></script>
<script type='text/javascript'>
	$(function() { if($.cookie('atualstudioPopup') != 'yes'){ $('#fanback').delay(100).fadeIn('medium'); $('#fanclose, #fan-exit').click(function(){ $('#fanback').stop().fadeOut('medium'); }); } $.cookie('atualstudioPopup', 'yes', { path: '/', expires: ".intval(trim($fbPopupDelay))." }); });
</script>";
} ?>

<!-- Control JS Flash Size -->
<script>
	$(function(){ $('section object').attr('width', $('article > .page').width()).attr('height', ((360 / 640) * $('article > .page').width())).children('embed').attr('width', $('article > .page').width()).attr('height', ((360 / 640) * $('article > .page').width())); });
</script>


</body>
</html>
