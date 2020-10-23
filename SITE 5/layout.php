<?php if(!$indexing) { exit; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#">
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
		 
-->
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="keywords" content="<?php echo L2NAME; ?>, l2, lineage, lineage2, lineage 2, lainiege, laineage, lainiage, lineage dois, lineage ii, <?php echo L2CHRO; ?>, 1x, 5x, 10x, 30x, 50x, 70x, 100x, 1000x, free fun, diversao gratis, gratuito, gratuitamente, free fun, new server, novo servidor, o melhor servidor de lineage 2, o melhor servidor"/>
<meta name="description" content="<?php echo L2NAME; ?>, the best server of Lineage 2 <?php echo L2CHRO; ?>. Join us for free and play!"/>
<link rel="shortcut icon" href="./imgs/favicon.ico">
<title><?php echo L2NAME; ?> - <?php echo L2CHRO; ?></title>
<link rel="image_src" href="http://<?php echo L2SURL; ?>/imgs/image_src.jpg" />
<meta property="og:title" content="<?php echo L2NAME; ?> - <?php echo L2CHRO; ?>" />
<meta property="og:site_name" content="<?php echo L2NAME; ?>" />
<meta property="og:image" content="http://<?php echo L2SURL; ?>/imgs/image_src.jpg" />
<meta property="og:type" content="website" />
<meta property="og:description" content="<?php echo L2NAME; ?>, the best server of Lineage 2 <?php echo L2CHRO; ?>. Join us for free and play!" />
<meta property="og:url" content="http://<?php echo L2SURL; ?>" />

<link rel="stylesheet" type="text/css" href="css/global.css?4" media="all" />

<script type="text/javascript" src="js/jquery-1.11.3.min.js" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery.cookie.js?2"></script>
<script type="text/javascript" src="js/global.js?2"></script>

<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css?2" media="screen" />

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




<div class='all <?php echo $language; ?>'><div>
	
	<div class='langs'><?php $addp = "&url=http://".urlencode($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?>
		<a href='?changelang=en' class='en' title='English' onclick="document.location.replace('./index.php?changelang=en<?php echo $addp; ?>');return false;"></a>
		<a href='?changelang=pt' class='pt' title='Portugu&ecirc;s' onclick="document.location.replace('./index.php?changelang=pt<?php echo $addp; ?>');return false;"></a>
		<a href='?changelang=es' class='es' title='Espa&ntilde;ol' onclick="document.location.replace('./index.php?changelang=es<?php echo $addp; ?>');return false;"></a>
	</div>
	
	<div class='menu'>
		<a href='./' class='o1'></a>
		<a href='./?page=register' class='o2'></a>
		<a href='./?page=download' class='o3'></a>
		<a href='./?page=info' class='o4'></a>
		<a href='./?page=support' class='o5'></a>
		<a href='./?page=rules' class='o6'></a>
		<a href='./?page=donations' class='o7'></a>
		<a href='forum' target='_blank' class='o8'></a>
	</div>

	<?php
			if($forceServerStatus == 'on') { $serverStatus = 'on'; }
			elseif($forceServerStatus == 'off') { $serverStatus = 'off'; }
			else {
				$check_game = @fsockopen(''.$serverIp.'', ''.$gamePort.'', $errno, $errstr, 1);
				if($check_game){ $serverStatus = 'on'; } else { $serverStatus = 'off'; }
			}
			?>
			<div class='server_status <?php echo $serverStatus; ?>'><div></div></div>

			
	<div class='content'>
		
		
		<div class='lateral esq'>
			
			<div class='box'>
				<div class='title t1 sprites_JPG'><span></span></div>
				<div class='con'>
					
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
							<div class='fieldsBox'>
								<label>
									<input type='text' name='ucp_login' class='inpt' placeholder='Login' title='Username' autocomplete='off' />
									<div class='acc_icon user'></div>
								</label>
								<label>
									<input type='password' name='ucp_passw' class='inpt pass' placeholder='Password' title='Password' autocomplete='off' />
									<div class='acc_icon pass'></div>
								</label>
							<?php if($captcha_cp_on == 1) {
										echo "<input type='button' onclick='opencaptcha();' class='sacc sprites_JPG' value=' ' />";
									} else {
										echo "<input type='submit' class='sacc sprites_JPG' value=' ' />";
									} ?>
							</div>
							<div class='ess'><a href='./?page=forgot'><?php echo $LANG[12020]; ?></a></div>
							<input type='hidden' value='<?php echo md5(uniqid()) ?>' name='ucp_uniqid' id='ucp_uniqid' />
							<input type='hidden' value='' name='captcha' id='ucp_captcha' />
							<div class='anpc'><?php echo $LANG[12019]; ?> <a href='./?page=register'><?php echo $LANG[12077]; ?></a></div>
						</form>
						
					</div>
					
				<?php } else { ?>
					
					<div class='logged'><?php echo $LANG[12021]; ?> <span><?php echo $_SESSION['acc']; ?></span></div>
					<?php if(file_exists('ucp/index.php')) { ?><a href='./ucp' class='default'>DASHBOARD</a><?php } ?>
					<a href='./?page=ucp_changepass' class='default'><?php echo $LANG[12022]; ?></a>
					<?php if($chaemail == 1) { ?><a href='./?page=ucp_changeemail' class='default'><?php echo $LANG[11014]; ?></a><?php } ?>
					<?php if($dpage['unstuk'] == 1) { ?><a href='./?page=ucp_unstuck' class='default'>Unstuck Char</a><?php } ?>
					<a href='./?engine=logout' class='default'><?php echo $LANG[12023]; ?></a>
					
				<?php } ?>
					
			</div>	
			<?php
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
				if($serverStatus == 'off' && $srvOffZeroPl == 1) { $playersOnline = 0; }
				echo "<div class='players_on'><span>".intval($playersOnline*$fakePlayers)."</span> Players Online				</div>";
			}
			?>
			<br></div>
		

			<a href='./?page=donations' class='specialb s1'>
				<div class='desc'><?php echo $LANG[12992]; ?></div>
			</a>
			
			<a href='./?page=siege' class='specialb sprites_JPG s2'>
				<div class='desc'><?php echo $LANG[12024]; ?></div>
			</a>
			
			<a href='./?page=boss' class='specialb sprites_JPG s3'>
				<div class='desc'><?php echo $LANG[12993]; ?></div>
				<div class='valakas sprites_PNG'></div>
			</a>
			
			
			<div class='box'>
				<div class='title t2 sprites_JPG'><span></span></div>
				<div class='con'>
					<a href='./?page=toppvp' class='default'>TOP PVP</a>
					<a href='./?page=toppk' class='default'>TOP PK</a>
					<a href='./?page=toponline' class='default'>TOP ONLINE</a>
					<a href='./?page=toplevel'class='default'>Top Level</a>
		            <a href='./?page=topadena'class='default'>Top Adena</a>
                    <a href='./?page=boss_jewels_loc'class='default'>Boss Jewels Loc</a>
					<a href='./?page=topclan' class='default'>TOP CLAN</a>
					<a href='./?page=oly_rank' class='default'>Olympiad Ranking</a>
					<a href='./?page=oly_heroes' class='default'><?php echo $LANG[12999]; ?></a>
					<a href='./?page=oly_allheroes' class='default'><?php echo $LANG[12025]; ?></a>
				
				<div class='vermais'>
						<a href='./?page=gallery'>ver mais &raquo;</a>
					
				</div>
				</div>
			</div>
			
			<div class='box'>
				<div class='title t3 sprites_JPG'><span></span></div>
				<div class='con'>
					<a href='http://top.l2jbrasil.com/index.php?a=in&u=jacksonfelipe' target='_blank' class='default'>TOP L2JBRASIL</a>
					<a href='http://www.topgs200.com/lineage2/votar/109540' target='_blank' class='default'>TOPGS200</a>
					<a href='http://www.topservers200.com/in.php?id=16037' target='_blank' class='default'>TOPSERVERS200</a>
					<a href='http://www.top100arena.com/in.asp?id=88514' target='_blank' class='default'>TOP100ARENA</a>
				</div>
			</div>
			
		</div>
		
		
		<div class='central'><div><div>
			<div class='ctt'>
				<?php
				require('pages/'.$p.'.php');
				?>
			</div>
		</div></div></div>
		
		
		<div class='lateral dir'>
			
			<?php
				if($dpage['galler'] == 1) {
				
				echo "
				<div class='box'>
					<div class='title t4 sprites_JPG'><span></span></div>
				<div class='con'>
	
					<div class='gallery_box'><div>
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
					<div class='vermais'>
						<a href='./?page=gallery'>".$LANG[12027]." &raquo;</a>
					
				</div></div>

				";
				
			}
			
			?>
			
			</div>
			<?php
					if($dpage['toppvp'] == 1) {
			echo "
			<div class='box'>
		
				<div class='title t5 sprites_JPG'><span></span></div>
				<div class='con'>
					<div class='indexRank'>
					";
					$xml = @simplexml_load_file("cache/toppvp.xml"); $line = @$xml->line;
					if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
					if($asideRankCount > 0) {
						for($i=0, $c=$asideRankCount; $i < $c; $i++) {
							echo "<div>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name." <span>".$line[$i]->pvp." pvps</span></div>";
						}
					} else {
						for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 3); $i <= $c; $i++) {
							echo "<div>".$i."&ordm;&nbsp;&nbsp; Player <span>0 pks</span></div>";
						}
					}
					echo "
				</div>
				<div class='vermais'>
					<a href='./?page=toppvp'>".$LANG[12027]." &raquo;</a>
				</div>
			</div>
		
			";
			}?>
			</div>
			<?php
				if($dpage['toppkp'] == 1) {
			echo "
			<div class='box'>
				<div class='title t6 sprites_JPG'><span></span></div>
				<div class='con'>
					<div class='indexRank'>
					";
					$xml = @simplexml_load_file("cache/toppk.xml"); $line = @$xml->line;
					if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
					if($asideRankCount > 0) {
						for($i=0, $c=$asideRankCount; $i < $c; $i++) {
							echo "<div>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name." <span>".$line[$i]->pk." pks</span></div>";
						}
					} else {
						for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 3); $i <= $c; $i++) {
							echo "<div>".$i."&ordm;&nbsp;&nbsp; Player <span>0 pks</span></div>";
						}
					}
					echo "
				</div>
				<div class='vermais'>
					<a href='./?page=toppk'>".$LANG[12027]." &raquo;</a>
				</div>
			</div>
			";
			}
				?>
				</div><?php
			if($dpage['topcla'] == 1) {
					echo "
					<div class='box'>
				<div class='title t7 sprites_JPG'><span></span></div>
				<div class='con'>
					<div class='indexRank'>
							";
							$xml = @simplexml_load_file("cache/topclan.xml"); $line = @$xml->line;
							if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
							if($asideRankCount > 0) {
								for($i=0, $c=$asideRankCount; $i < $c; $i++) {
									echo "<div>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name." <span>".$line[$i]->level." lvl</span></div>";
								}
							} else {
								for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 3); $i <= $c; $i++) {
									echo "<div>".$i."&ordm;&nbsp;&nbsp; Clan <span>0 lvl</span></div>";
								}
							}
							echo "
							</div>
							<div class='vermais'>
								<a href='./?page=topclan'>".$LANG[12027]." &raquo;</a>
							</div>
						</div>
					</div>";
				}
			?>

<?php if(CHATON == 1) { ?>
			<div class='box'>
				<div class='title t8 sprites_JPG'><span></span></div>
				<div class='con support'>
					<a href='./?page=support'><img src='imgs/chat_on.jpg' /></a>
				</div>
			</div>
			<?php } ?>
			
		</div>
		
		<div class='end'></div>
	</div>
	
	<div class='rodape'>
		&copy; <?php echo date('Y'); ?> <?php echo L2NAME; ?> - All rights reserved
		<a class='atualstudio sprites_PNG' href='http://www.atualstudio.com' title='<?php echo $LANG[12028]; ?>' target='_blank'></a>
	</div>
	
	<script type='text/javascript'>
		$(document).ready(function(){
			var lateralESQ = ($('.content > .esq').height() + 6);
			var lateralDIR = ($('.content > .dir').height() + 6);
			var centralH = ($('.content > .central').height());
			if(lateralDIR > lateralESQ && lateralDIR > centralH) {
				$('.content .central .ctt').css({ 'min-height': ''+(lateralDIR-100)+'px' })
			} else if(lateralDIR < lateralESQ && lateralESQ > centralH) {
				$('.content .central .ctt').css({ 'min-height': ''+(lateralESQ-100)+'px' })
			}
		});
	</script>
	
</div></div>
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
<div id='backblack' style='display:none;'></div>
<div id='loginmodal'></div>

<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" charset="utf-8">$(document).ready(function(){ $("a[rel^='prettyPhoto']").prettyPhoto({ theme: 'atualstudio', social_tools: '', markup: '<div class="pp_pic_holder"><div class="ppt">&nbsp;</div><div class="pp_top"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div><div class="pp_content_container"><div class="pp_left"><div class="pp_right"><div class="pp_content"><div class="pp_loaderIcon"></div><div class="pp_fade"><a href="#" class="pp_expand" title="Expand the image">Expand</a><div class="pp_hoverContainer"><a class="pp_next" href="#">next</a><a class="pp_previous" href="#">previous</a></div><div id="pp_full_res"></div><div class="pp_details"></div></div></div></div></div></div><div class="pp_bottom"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div></div><div class="pp_overlay"></div>' }); });</script>

</body>
</html>

<?php @mysql_close($conexao); ?>