<?php if(!$indexing) { exit; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--
	
	Desenvolvido pela Atualstudio
		RECODED: BY MEAVY
		RECODED-VERSION: 3.0
	   www.atualstudio.com
	
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

     <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-128986718-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-128986718-3');
    </script>


	<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '269508040478073');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=269508040478073&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

</head>
<body>
	
<?php if($faceBoxOn == 1) {
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
	<nav>
	<a href='./' class='o1'>HOME</a>
	<span class='o2'>
			<a href=''>Server</a>
			<div>
				<a href='?page=info'><?php echo $LANG[12996]; ?></a>
				<a href='?page=support'><?php echo $LANG[13005]; ?></a>
				<a href='?page=rules'><?php echo $LANG[12108]; ?></a>
				<a href='?page=donations'><?php echo $LANG[12039]; ?></a>
			</div>
		</span>
		<a href='./?page=download' class='o3'>DOWNLOAD</a>
		<span class='o4'>
			<a href='?page=register'>Account</a>
			<div>
				<a href='?page=register'><?php echo $LANG[12032]; ?></a>
				<a href='?page=changepass'><?php echo $LANG[12022]; ?></a>
				<a href='?page=forgot'><?php echo $LANG[12034]; ?></a>
			</div>
		</span>
		<span class='o5'>
			STATS
			<div style='left: -35px;'>
				
				<a href='./?page=toppvp'>Top PvP</a>
				<a href='./?page=toppk' class='ativa'>Top Pk</a>
				<a href='./?page=toponline'>Top Online</a>
				<a href='./?page=toplevel'>Top level</a>
				<a href='./?page=topadena'>Top Adenas</a>
				<a href='./?page=boss_jewels_loc'>Player Joia Boss</a>
				<a href='./?page=topclan'>Top Clan</a>
				<a href='./?page=oly_heroes'>Heroes</a>
				<a href='./?page=oly_rank'>Top Olly</a>
				<a href='./?page=siege'>Castle Siege</a>
				<a href='./?page=boss'>Boss Respawn</a>
							</div>
		</span>
		
		
		
	
		
	</nav>
	
	
	<div class='forum-wrapper'>
		<a href='./community' class='forum-button' target='_blank'><span></span><div>VISIT OUR FORUM</div></a>
	</div>
	<?php if($logged != 1) { ?>
				
				<div class='loginarea'>
					<img src='imgs/nm/loader.gif' style='width:0;height:0;display:none;' />
					<div class='avatar'>
					<span></span>
					<img src='imgs/avatar/human_female_fighter.jpg' />
					</div>
					
					
					<div class='fields'>
						<form id='login_form' action='<?php echo (file_exists('ucp/engine/login.php') ? "./ucp/?engine=login&fromsite" : "./?engine=login"); ?>' method='POST'>
							<?php
							$_SESSION['lkey'] = md5(time().rand(100,999).$uniqueKey); echo "<input type='hidden' name='lkey' value='".$_SESSION['lkey']."' />";
							if(isset($_GET['lerror'])) {
								echo "<div class='error'>".((intval($_GET['lerror']) == 1) ? $LANG[11979] : $LANG[11990])."</div>";
							}
							?>
							
							
								<label>
								<span class='icon-user'></span>
									<input type='text' name='ucp_login' class='inpt' placeholder='Login' title='Username' autocomplete='off' />
								</label>
								<label>
								<span class='icon-pass'></span>
									<input type='password' name='ucp_passw' class='inpt pass' placeholder='Password' title='Password' autocomplete='off' />
								</label>
								<?php if($captcha_cp_on == 1) {
									echo "<input type='button' onclick='opencaptcha();' class='gologin' value='Login' />";
								} else {
									echo "<input type='submit' class='gologin' value='Login' />";
								} ?>
								
							<div class='ess'><a href='./?page=forgot'><?php echo $LANG[12020]; ?></a></div>
							<input type='hidden' value='<?php echo md5(uniqid()) ?>' name='ucp_uniqid' id='ucp_uniqid' />
							<input type='hidden' value='' name='captcha' id='ucp_captcha' />
							</form>
					</div>
			</div>

			<?php } else { ?>
			<div class='loginarea'>
				   <div class='avatar'>
				   <span></span>
					<img src='imgs/avatar/human_female_fighter.jpg' />
					</div>
					<div class='fields user'>
					<div class='info'><span class='icon-user'></span><?php echo $LANG[12021]; ?> <span><?php echo $_SESSION['acc']; ?></span></div>
					<div class='opts'>
					
					<span>
						&Xi;&nbsp;&nbsp;OPTIONS
						<div>
							<a href='./ucp' class='default'>DASHBOARD</a>							
							<a href='./?page=ucp_changepass' class='default'>Alterar Senha</a>
							<?php if($dpage['unstuk'] == 1) { ?><a href='./?page=ucp_unstuck' class='default'>Unstuck Char</a><?php } ?>
						</div>
					</span>
					<a href='./?engine=logout'><?php echo $LANG[12023]; ?></a>
					</div>
					</div>
					</div>
				<?php } ?>
			
				
	
	

			<div class='langs'><?php $addp = "&url=http://".urlencode($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?>
			<a href='?changelang=en' class='en' title='English' onclick="document.location.replace('./index.php?changelang=en<?php echo $addp; ?>');return false;"></a>
			<a href='?changelang=pt' class='pt' title='Portugu&ecirc;s' onclick="document.location.replace('./index.php?changelang=pt<?php echo $addp; ?>');return false;"></a>
			<a href='?changelang=es' class='es' title='Espa&ntilde;ol' onclick="document.location.replace('./index.php?changelang=es<?php echo $addp; ?>');return false;"></a>
			</div>
			<?php
				if($forceGameStatus == 'on') { $serverStatus = 'on'; }
				elseif($forceGameStatus == 'off') { $serverStatus = 'off'; }
				else {
					$check_game = @fsockopen(''.$serverIp.'', ''.$gamePort.'', $errno, $errstr, 1);
					if($check_game){ $serverStatus = 'on'; } else { $serverStatus = 'off'; }
				}
			
				if ($ServerStatus = on)
				{
				  echo"<div class='server-status on' title='Server online'></div>";
				}
				 echo"<div class='server-status off' title='Server online'></div>";
				
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
						require("private/includes/playerson.php");
					}
					$playersOnline = $xml->players; $playersOnline = intval($playersOnline[0]->online);
				}
				?>
		<div class='players-online-icon on'></div>
		<div class='players-online'><?php echo $playersOnline; ?></div>
		
			<div class='banners'>
		
		<div class='b1'>
			<a href='./?page=register'>
				Cadastrar Agora				<span>Jogue grátis no melhor servidor</span>
			</a>
			<div></div>
			<mark></mark>
			<img src='imgs/dual1.jpg' />
		</div>
		
		<div class='b2'>
			<a href='./?page=donations'>
				Faça uma Doação				<span>Ajude a nos manter online</span>
			</a>
			<div></div>
			<mark></mark>
			<img src='imgs/dual2.jpg' />
		</div>
		
	</div>
		
		<section>
			<aside class='esq'>
				
				
					<div class='box'>
						<div class='title'>GAME STATS</div>
						<div class='hex-buttons'>
							<a href='./?page=siege' class='sie'><span><span></span></span><div><div></div><span>CASTLE & SIEGE</span></div></a>
							<a href='./?page=boss' class='bos'><span><span></span></span><div><div></div><span>BOSS STATUS</span></div></a>
							<a href='./?page=oly_rank' class='oly'><span><span></span></span><div><div></div><span>GRAND OLYMPIAD</span></div></a>
						</div>
					</div>
					<?php
					if($dpage['toppvp'] == 1) {
			echo "
			<div class='box type2'>
					<div class='ctt'>
						<div class='ranks-title'>TOP PVP <a href='./?page=toppvp'>ver mais</a></div>
						<div class='indexRank'>
					";
					$xml = @simplexml_load_file("cache/toppvp.xml"); $line = @$xml->line;
					if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
					if($asideRankCount > 0) 
					{
						for($i=0, $c=$asideRankCount; $i < $c; $i++) {
							echo "<div class='one'>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name." <span>".$line[$i]->pvp." pvps</span></div>";
						}
					} 
					else
					{
						for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 3); $i <= $c; $i++) 
						{
							echo "<div>".$i."&ordm;&nbsp;&nbsp; Player <span>5 pvps</span></div>";
						}
					}
					echo "
				</div>
			</div>
			";
			
			}
			
			
			if($dpage['toppkp'] == 1) {
			echo "
			<div class='ctt'>
						<div class='ranks-title'>TOP PK <a href='./?page=toppk'>ver mais</a></div>
						<div class='indexRank'>
					";
					$xml = @simplexml_load_file("cache/toppk.xml"); $line = @$xml->line;
					if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
					if($asideRankCount > 0) {
						for($i=0, $c=$asideRankCount; $i < $c; $i++) {
							echo "<div class='one'>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name." <span>".$line[$i]->pk." pks</span></div>";
						}
					} else {
						for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 3); $i <= $c; $i++) {
							echo "<div>".$i."&ordm;&nbsp;&nbsp; Player <span>0 pks</span></div>";
						}
					}
					echo "
				</div>
			</div>
			";
			}
			
			if($dpage['topcla'] == 1) {
			echo "
			<div class='ctt'>
						<div class='ranks-title'>TOP clan <a href='./?page=topclan'>ver mais</a></div>
						<div class='indexRank'>
					";
					$xml = @simplexml_load_file("cache/topclan.xml"); $line = @$xml->line;
					if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
					if($asideRankCount > 0) {
						for($i=0, $c=$asideRankCount; $i < $c; $i++) {
							echo "<div class='one'>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name." <span>".$line[$i]->pk." lvl</span></div>";
						}
					} else {
						for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 3); $i <= $c; $i++) {
							echo "<div>".$i."&ordm;&nbsp;&nbsp; Player <span>0 lvl</span></div>";
						}
					}
					echo "
				</div>
			</div>
			";
			}
			?>
					</div>				
			</aside>
	<article>
	
				<a href='?page=download' class='downloadButton'><span></span></a>
<?php
require('pages/'.$p.'.php');
?>
</article>

<aside class='dir'>
				
				<div class='box'>
					<div class='title'>VOTE</div>
					<div class='hex-buttons'>
						<a href='https://vgw.hopzone.net/site/vote/103360/1' class='vot' target='_blank'><span><span></span></span><div><div></div><span>Vote Hopzone</span></div></a>
						<a href='http://www.xtremetop100.com/in.php?site=1132366849' class='vot' target='_blank'><span><span></span></span><div><div></div><span>Vote Xtreme TOP 100</span></div></a>
						<a href='http://www.topgamesites.net/lineage2/vote50380' class='vot' target='_blank'><span><span></span></span><div><div></div><span>Top Gamesites</span></div></a>
						<a href='http://l2top.co/vote/server/NightmareL2' class='vot' target='_blank'><span><span></span></span><div><div></div><span>Vote L2top.co</span></div></a>
						<a href='http://www.top100arena.com/in.asp?id=94761' class='vot' target='_blank'><span><span></span></span><div><div></div><span>Top 100 Arena</span></div></a>
						<a href='https://l2topzone.com/vote/id/15879' class='vot' target='_blank'><span><span></span></span><div><div></div><span>Vote L2Topzone</span></div></a>
					</div>
				</div>
				
				
				<?php
			if($dpage['galler'] == 1) {
				
				echo "
				<div class='box type2'>
						<div class='ctt'>
							<div class='ranks-title'>Galeria <a href='./?page=gallery'>ver mais</a></div>
							<div class='galleryBox'><div>
						";
						$xml = @simplexml_load_file("cache/gallery.xml");
						$line = @$xml->line;
						$asideRankCountG = (!empty($galleCount) ? intval($galleCount) : 6);
						if(count($line) < $asideRankCountG) { $asideRankCountG = count($line); }
						if($asideRankCountG > 0) {
							for($i=0, $c=$asideRankCountG; $i < $c; $i++) {
								if(intval($line[$i]->isvideo) != '1') {
									echo "
									<a href='".$dir_gallery.$line[$i]->url."' rel='prettyPhoto[fullGallery]'>
										<div class='img' style='background: transparent url(".$dir_gallery."thumbnail/".$line[$i]->url.") no-repeat center center'></div>
										<span></span>
									</a>
									";
								} else {
									echo "
									<a href='//www.youtube.com/watch?v=".$line[$i]->url."&rel=0' class='iframe' rel='prettyPhoto[fullGallery]'>
										<div class='img isvideo'>
											<div><img src='".$dir_gallery."thumbnail/".$line[$i]->url.".jpg' width='89' width='50' /></div>
										</div>
										<div class='vplay'></div>
										<span></span>
									</a>
									";
								}
							}
						}
						for($i=$asideRankCountG, $c=(!empty($galleCount) ? intval($galleCount) : 6); $i < $c; $i++) {
							echo "<a href='javascript:void(0)'><div></div></a>";
						}
						echo "
					</div></div>

				</div>
				";
				
			}
			
			?>
				<div class='box'>
					<div class='title'>Suporte</div>
					<a class='support-button' href='./?page=support'>
						Problemas?<br /><span>Contate-nos</span>					</a>
				</div>
				
			</aside>
			
			<script type='text/javascript'>
			$(document).ready(function(){
				var lateralESQ = ($('aside.esq').height()+144);
				var lateralDIR = ($('aside.dir').height()+144);
				if(lateralDIR > lateralESQ) {
					$('article').css({ 'min-height': ''+(lateralDIR)+'px' });
				} else {
					$('article').css({ 'min-height': ''+(lateralESQ)+'px' });
				}
			});
			</script>
</section>
<script type='text/javascript'>
$(document).ready(function(){
	var lateralESQ = ($('aside.esq').height()-71);
	var lateralDIR = ($('aside.dir').height()-71);
	if(lateralDIR > lateralESQ) {
		$('article').css({ 'min-height': ''+(lateralDIR)+'px' });
	} else {
		$('article').css({ 'min-height': ''+(lateralESQ)+'px' });
	}
});
</script>

</div>
	
<footer>
	<div>
		
		<div class='linksPanel'>
			<div style='width: 160px; border-left: 0;'>
				<div>Account</div>
				<a href='?page=register'>Cadastrar</a>
				<a href='?page=changepass'>Alterar Senha</a>
				<a href='?page=forgot'>Recuperar</a>
			</div>
			<div style='width: 160px;'>
				<div>Server</div>
				<a href='?page=download'>Downloads</a>
				<a href='?page=info'>Informações</a>
				<a href='?page=support' class='noJquery'>Suporte</a>
				<a href='?page=rules'>Regras</a>
				<a href='?page=donations'>Doações</a>
				<a href='?page=gallery'>Galeria</a>
			</div>
			<div style='width: 160px; border-right: 0;'>
				<div>Stats</div>
				
				<a href='./?page=toplevel'>Top Level</a>
				<a href='./?page=toponline'>Top Online</a>
				<a href='./?page=siege'>Castle & Siege</a>
				<a href='./?page=oly_rank'>Grand Olympiad</a>
				<a href='./?page=boss'>Boss Status</a>
				
							</div>
		</div>
		
		<div class='r'>
			
			<div class='copyright'>
				<div class='logo'></div>
				<span>&copy; 2019 L2Nightmare - All rights reserved</span>
				LINEAGE II AND ALL ASSOCIATED LOGOS AND DESIGNS ARE TRADEMARKS OR REGISTERED TRADEMARKS OF NCSOFT CORPORATION. ALL OTHER TRADEMARKS OR REGISTERED TRADEMARKS ARE PROPERTY OF THEIR RESPECTIVE OWNERS.
				<br />
				<a class='atualstudio' href='http://www.atualstudio.com' title='Este site foi desenvolvido pela Atualstudio' target='_blank'></a>
			</div>
			
		</div>

	</div>
</footer>

<?php
if(!empty($_SESSION['aAlert_msg'])) {
	echo "<script>atualAlert('".$_SESSION['aAlert_msg']."', '".$_SESSION['aAlert_act']."', '".(isset($_SESSION['aAlert_url']) ? $_SESSION['aAlert_url'] : '')."');</script>";
	$_SESSION['aAlert_msg'] = ''; $_SESSION['aAlert_act'] = ''; $_SESSION['aAlert_url'] = ''; unset($_SESSION['aAlert_msg']); unset($_SESSION['aAlert_act']); unset($_SESSION['aAlert_url']);
}
?>


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
