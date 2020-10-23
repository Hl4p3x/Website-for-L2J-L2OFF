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
	
	Website Version 4.2
	
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

<div class='all <?php echo $language; ?>'>	<div>

	<div class='menu'>
		<a href='./' class='o1'></a>
		<a href='./?page=register' class='o2'></a>
		<a href='./?page=download' class='o3'></a>
		<a href='./?page=info' class='o4'></a>
		<a href='./?page=support' class='o5'></a>
		<a href='./?page=rules' class='o6'></a>
		<a href='./?page=donations' class='o7'></a>
		<a href='./forum' class='o8'></a>
	</div>


	<div class='langs'><?php $addp = "&url=http://".urlencode($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?>
		<div class='bg'></div>
		<div class='links'>
			<a href='?changelang=en' class='en' title='English' onclick="document.location.replace('./index.php?changelang=en<?php echo $addp; ?>');return false;"></a>
			<a href='?changelang=pt' class='pt' title='Portugu&ecirc;s' onclick="document.location.replace('./index.php?changelang=pt<?php echo $addp; ?>');return false;"></a>
			<a href='?changelang=es' class='es' title='Espa&ntilde;ol' onclick="document.location.replace('./index.php?changelang=es<?php echo $addp; ?>');return false;"></a>
		</div>
	</div>
			
				
					<div class='content'><div><div>
		<div class='p921'>
			<div class='lateral esq'>
					
					<div class='box'>
						
						<div class='title'>
							<div class='sprites_PNG bg'></div>
							<div class='txt t1'></div>
						</div>
						

						
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
									echo "<input type='button' onclick='opencaptcha();' class='default gologin' value='Login' />";
								} else {
									echo "<input type='submit' class='default gologin' value='Login' />";
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

			<div class='box support'>
						<div class='title'>
							<div class='sprites_PNG bg'></div>
							<div class='txt t2'></div>
						</div>
						<a href='./?page=support'><img src='imgs/chat_ON.png' /></a>
					</div>
					
					<div class='box'>
						<div class='title'>
							<div class='sprites_PNG bg'></div>
							<div class='txt t3'></div>
						</div>
						<a class='donateIndexB' href='./?page=donations'>
							<div class='make'></div>
							<div class='desc sprites_PNG'>Contribua e Ganhe Recompensas</div>
						</a>
					</div>
					
					<div class='box'>
						<div class='title'>
							<div class='sprites_PNG bg'></div>
							<div class='txt t4'></div>
						</div>
						<a href='./?page=oly_heroes' class='default'><?php echo $LANG[12999]; ?></a>
						<a href='./?page=oly_allheroes' class='default'><?php echo $LANG[12025]; ?></a>
						<a href='./?page=oly_rank' class='default'>RANKING</a>
						<div class='vermais'>
								<a href='./?page=topclan'>ver mais &raquo;</a>
						
				</div></div>
		
		
				
				<?php
				if($dpage['galler'] == 1) {
				
				echo "
				<div class='box'>
					<div class='title'>
						<div class='bg sprites_PNG'></div>
						<div class='txt t5'></div>
					</div>
	
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
				<div class='central'><div><div>
					<div class='page'>
					<?php
					require('pages/'.$p.'.php');
					?>
					</div>
				</div></div></div>
				
				<div class='lateral dir'>
					
					<?php
			if($forceServerStatus == 'on') { $serverStatus = 'on'; }
			elseif($forceServerStatus == 'off') { $serverStatus = 'off'; }
			else {
				$check_game = @fsockopen(''.$serverIp.'', ''.$gamePort.'', $errno, $errstr, 1);
				if($check_game){ $serverStatus = 'on'; } else { $serverStatus = 'off'; }
			}
			?>
			<div class='server_status <?php echo $serverStatus; ?>'><div></div></div>

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
				echo "<div class='players_on'><span>".intval($playersOnline*$fakePlayers)."</span> Players Online</div>";
			}
			?>
					
					<div class='box'>
						<div class='title'>
							<div class='sprites_PNG bg'></div>
							<div class='txt t6'></div>
						</div>
						<a href='#' class='default'>TOP SERVER 200</a>
						<a href='#' class='default'>TOP L2JBRASIL</a>
						<a href='#' class='default'>GAMESITES200</a>
					
					</div>
					
					<a href='./?page=boss' class='specialb sprites_JPG boss'></a>
					<a href='./?page=siege' class='specialb sprites_JPG siege' style='margin-bottom:20px;'></a>
					<?php
					if($dpage['toppvp'] == 1) {
			echo "
			<div class='box'>
				<div class='title'>
					<div class='bg sprites_PNG'></div>
					<div class='txt t7'></div>
				</div>
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
			}
				if($dpage['toppkp'] == 1) {
			echo "
			<div class='box'>
				<div class='title'>
					<div class='bg sprites_PNG'></div>
					<div class='txt t8'></div>
				</div>
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
			
			if($dpage['topcla'] == 1) {
					echo "
					<div class='box'>
				<div class='title'>
					<div class='bg sprites_PNG'></div>
					<div class='txt t9'></div>
				</div>
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
					</div>	</div>		
			</div>			
			</div>			




	

	
	<script type='text/javascript'>
	$(document).ready(function(){
		var lateralESQ = ($('.lateral.E').height());
		var lateralDIR = ($('.lateral.D').height());
		var centralH = ($('.central').height());
		if(lateralDIR > lateralESQ && lateralDIR > centralH) {
			$('.central').css({ 'min-height': ''+(lateralDIR)+'px' })
		} else if(lateralDIR < lateralESQ && lateralESQ > centralH) {
			$('.central').css({ 'min-height': ''+(lateralESQ)+'px' })
		}
	});
	</script>

	<div class='rodape'>
		&copy; <?php echo date('Y'); ?> <?php echo $server_name; ?> - All rights reserved
		<a class='atualstudio sprites_PNG' href='http://www.atualstudio.com' title='<?php echo $LANG[12028]; ?>' target='_blank'></a>
	</div>

</div></div>


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


<!-- Control JS Flash Size -->
<script>
	$(function(){ $('section object').attr('width', $('article > .page').width()).attr('height', ((360 / 640) * $('article > .page').width())).children('embed').attr('width', $('article > .page').width()).attr('height', ((360 / 640) * $('article > .page').width())); });
</script>


</body>
</html>

