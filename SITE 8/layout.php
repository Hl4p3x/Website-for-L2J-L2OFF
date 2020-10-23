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
<!-- Begin l2topzone.com vote code --> <a href="https://l2topzone.com/vote/id/15967" target="_blank" title="l2topzone" ><img src="https://l2topzone.com/vb/l2topzone-Lineage2-vote-banner-bottom-left-3.gif" style="position: fixed; z-index:99999; bottom: 0; left: 0;" alt="l2topzone.com" border="0"></a> 
	
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
				<a href='./?page=donations'>Donate</a>
			</div>
		</span>
		<span class='o4'>
			<span></span>
			<div>
				
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
		<a class='o5' href='ucp'><span></span></a>
	
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
				
				<div class='title'>Account Menu</div>
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
						<div class='avatar' style='background-image: url(imgs/avatar/human_male_fighter.jpg);'><span></span></div>
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
			
				
					<?php if(file_exists('ucp/index.php')) { ?><a href='./ucp' class='default'>DASHBOARD</a><?php } ?>
					<a href='./?page=ucp_changepass' class='default'><?php echo $LANG[12022]; ?></a>
					<?php if($chaemail == 1) { ?><a href='./?page=ucp_changeemail' class='default'><?php echo $LANG[11014]; ?></a><?php } ?>
					<?php if($dpage['unstuk'] == 1) { ?><a href='./?page=ucp_unstuck' class='default'>Unstuck Char</a><?php } ?>
					<a href='./?engine=logout' class='default'><?php echo $LANG[12023]; ?></a>
					
							<a class='default'><?php echo $LANG[12021]; ?> <span><?php echo $_SESSION['acc']; ?></span></a>
					</center>
				<?php } ?>
				
				
				<br>	
	
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
				<div class='title'>Lives Server</div>
				<center>
<iframe width="300" height="169" src="https://www.youtube.com/embed/UCTBYPaocU2a8z4jnCMcd5SQ/live" frameborder="0" allowfullscreen></iframe>
<div style="margin-top:15px;">
<script src="https://apis.google.com/js/platform.js"></script>

<div class="g-ytsubscribe" data-channelid="UCTBYPaocU2a8z4jnCMcd5SQ" data-layout="full" data-count="default"></div>

</div></center>
				<iframe src='https://player.twitch.tv/?channel=colocaaqui' class='livesBanner' frameborder='0' allowfullscreen='true' scrolling='no' height='140' width='310'></iframe><br><br>
			<iframe src='https://player.twitch.tv/?channel=colocaaqui' class='livesBanner' frameborder='0' allowfullscreen='true' scrolling='no' height='140' width='310'></iframe><br><br>
				
	
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
		<div class='box'>
	    <center>
				<a href="https://info.flagcounter.com/CSWO"><img src="https://s04.flagcounter.com/count2/CSWO/bg_000000/txt_FFF717/border_000000/columns_3/maxflags_19/viewers_0/labels_0/pageviews_0/flags_0/percent_0/" alt="Free counters!" border="0"></a>
				</center>
			</div>
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
		<aside>
	 <div class='box'>
				<div class='server_status'>
					<div><?php echo ($gameStatus == 'on' ? "<div class='on'>Online</div>" : "<div class='s2off'><font color=#ff0000>Offline</font></div>"); ?></div>
                    <span class='s2'><?php echo intval($playersOnline*$fakePlayers); ?></span></div>
	  <br>
	  <div class='box'>	
	<div class='title'>Ranking Status</div>
			<div class='statsIcons'>
			<a href='./?page=download' class='i1' title='Download Server Files'><span></span></a>
			<a href='./?page=oly_rank' class='i2' title='Grand Olympiad'><span></span></a>
			<a href='./?page=siege' class='i3' title='Castle & Siege'><span></span></a>
					</div>
					<div class='statsIcons2'>
			<a href='./?page=toppvp' class='i1' title='Top PvP'></a>
			<a href='./?page=oly_heroes' class='i2' title='Top Heroes'></a>
			<a href='./?page=topclan' class='i3' title='Top Clan'></a><span></span>
					</div>
					<div class='statsIcons3'>
			<a href='./?page=toppk' class='i1' title='Top Pk'></a>
			<a href='./?page=topadena' class='i2' title='Top Adenas'></a>
			<a href='./?page=boss' class='i3' title='RaidBoss Respawn'></a><span></span>
					</div>
					<div class='statsIcons4'>
			<a href='./?page=toplevel' class='i1' title='Top Level'></a>
			<a href='./?page=toponline' class='i2' title='Top Online'></a>
			<a href='./?page=boss_jewels_loc' class='i3' title='Player Joias Boss'></a><span></span>
					</div>	<br>		
				<div class='box'>
					<div class='title'>Top Players</div>
					<div class='dualRank'>
						<table border='0' cellpadding='0' cellspacing='0' class='indexRank'>
							<tr>
								<th>Nome</th>
								<th style='padding: 0;'>PVP</th>
							</tr>
<?php

$cacheFile = "cache/toppvp1.xml";
$genNew = 0;

if(!file_exists($cacheFile)) {
	$genNew = 1;
} else {
	
	$xml = simplexml_load_file($cacheFile);
	$configs = $xml->configs;
	$updated = intval($configs->updated);
	$delay = $cacheDelayMin;
	$rcount = intval($configs->rcount);
	
	if(($updated+($delay*60)) < time()) {
		$genNew = 1;
	}
	
	if($rcount != $countTopPVP1) {
		$genNew = 1;
	}
	
}

$dateReg = mktime($reg['hr'],$reg['min'],0,$reg['mes'],$reg['dia'],$reg['ano']);
if($showRankReg == 0 && time() < $dateReg) {
	$genNew = 1;
}

if($genNew) {
	
	if(!file_exists("cache")) { @mkdir("cache", 0775, true); @chmod("cache", 0775); }
	if(!file_exists("cache/index.html")) { $secIndexFile = fopen("cache/index.html","w+"); @fclose($secIndexFile); }
	if(!file_exists("cache/.htaccess")) { $secHtacsFile = fopen("cache/.htaccess","w+"); @fwrite($secHtacsFile, "Options -Indexes\ndeny from all"); @fclose($secHtacsFile); }
	
	$wFile = fopen($cacheFile,"w+");
	
	$updated = time();
	$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n<delay>".$cacheDelayMin."</delay>\n<rcount>".$countTopPVP1."</rcount>\n</configs>";
	
	if($showRankReg == 1 || ($showRankReg == 0 && time() > $dateReg)) {
		
		require_once('private/classes/classStats.php');
		
		$query = Stats::TopPvP1($countTopPVP1);
		if(count($query) > 0) {
			
			for($i=0, $c=count($query); $i < $c; $i++) {
				
				$dias = intval($query[$i]['onlinetime'] / 86400); $marcador = $query[$i]['onlinetime'] % 86400; $hora = intval($marcador / 3600); $marcador = $marcador % 3600; $minuto = intval($marcador / 60);
				
				$line .= "\n<line>\n";
				$line .= "<name>".$query[$i]['char_name']."</name>\n";
				$line .= "<pvp>".$query[$i]['pvpkills']."</pvp>\n";
				$line .= "</line>";
				
			}
			
		} else {
			$deleteCache = 1;
		}
	
	} else {
		$deleteCache = 1;
	}
	
	@fwrite($wFile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<ranking>".$line."\n</ranking>");
	@fclose($wFile);
	
	$xml = simplexml_load_file($cacheFile);
	
	if(isset($deleteCache) && file_exists($cacheFile)) {
		unlink($cacheFile);
	}
	
}

?>
				
				<?php
	
	               $line = $xml->line;
	
	             $countView = (!empty($countTopPVP1) ? intval($countTopPVP1) : 100);
	             if(count($line) < $countView) { $countView = count($line); }
	              for($i=0, $c=$countView; $i < $c; $i++) {
		
		         echo "
		         <tr".(($i % 2 == 0) ? " class='two'" : "").">
			     <td><b>".$line[$i]->name."</b></td>
			    <td class='foco' style='color: #006202;'>".$line[$i]->pvp."</td>
		    </tr>
		   ";
		
	     }
	
	      ?>
									
						</table>
						<table border='0' cellpadding='0' cellspacing='0' class='indexRank'>
							<tr>
								<th>Nome</th>
								<th style='padding: 0;'>PK</th>
							</tr>
<?php

$cacheFile = "cache/toppk1.xml";
$genNew = 0;

if(!file_exists($cacheFile)) {
	$genNew = 1;
} else {
	
	$xml = simplexml_load_file($cacheFile);
	$configs = $xml->configs;
	$updated = intval($configs->updated);
	$delay = $cacheDelayMin;
	$rcount = intval($configs->rcount);
	
	if(($updated+($delay*60)) < time()) {
		$genNew = 1;
	}
	
	if($rcount != $countTopPK1) {
		$genNew = 1;
	}
	
}

$dateReg = mktime($reg['hr'],$reg['min'],0,$reg['mes'],$reg['dia'],$reg['ano']);
if($showRankReg == 0 && time() < $dateReg) {
	$genNew = 1;
}

if($genNew) {
	
	if(!file_exists("cache")) { @mkdir("cache", 0775, true); @chmod("cache", 0775); }
	if(!file_exists("cache/index.html")) { $secIndexFile = fopen("cache/index.html","w+"); @fclose($secIndexFile); }
	if(!file_exists("cache/.htaccess")) { $secHtacsFile = fopen("cache/.htaccess","w+"); @fwrite($secHtacsFile, "Options -Indexes\ndeny from all"); @fclose($secHtacsFile); }
	
	$wFile = fopen($cacheFile,"w+");
	
	$updated = time();
	$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n<delay>".$cacheDelayMin."</delay>\n<rcount>".$countTopPVP."</rcount>\n</configs>";
	
	if($showRankReg == 1 || ($showRankReg == 0 && time() > $dateReg)) {
		
		require_once('private/classes/classStats.php');
		
		$query = Stats::TopPvP1($countTopPK1);
		if(count($query) > 0) {
			
			for($i=0, $c=count($query); $i < $c; $i++) {
				
				$dias = intval($query[$i]['onlinetime'] / 86400); $marcador = $query[$i]['onlinetime'] % 86400; $hora = intval($marcador / 3600); $marcador = $marcador % 3600; $minuto = intval($marcador / 60);
				
				$line .= "\n<line>\n";
				$line .= "<name>".$query[$i]['char_name']."</name>\n";
				$line .= "<pk>".$query[$i]['pkkills']."</pk>\n";
				$line .= "</line>";
				
			}
			
		} else {
			$deleteCache = 1;
		}
	
	} else {
		$deleteCache = 1;
	}
	
	@fwrite($wFile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<ranking>".$line."\n</ranking>");
	@fclose($wFile);
	
	$xml = simplexml_load_file($cacheFile);
	
	if(isset($deleteCache) && file_exists($cacheFile)) {
		unlink($cacheFile);
	}
	
}

?>
				
				<?php
	
	               $line = $xml->line;
	
	             $countView = (!empty($countTopPK1) ? intval($countTopPK1) : 100);
	             if(count($line) < $countView) { $countView = count($line); }
	              for($i=0, $c=$countView; $i < $c; $i++) {
		
		         echo "
		         <tr".(($i % 2 == 0) ? " class='two'" : "").">
			     <td><b>".$line[$i]->name."</b></td>
			    <td class='foco' style='color: #ba0d0d;'>".$line[$i]->pk."</td>
		    </tr>
		   ";
		
	     }
	
	      ?>
								
									
						</table>
					</div><br>
<div class='box'>
	    <center>
				<div class='title'><?php echo $LANG[40001]; ?></div>
		
				<iframe src="https://discordapp.com/widget?id=618173019923152941&theme=dark" width="305" height="450" allowtransparency="True" frameborder="0"></iframe>
								</center>
			</div>	
				</aside>
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
	Lineage II Stark 50x
	<a class='atualstudio' href='http://www.atualstudio.com' title='This site was developed by Atualstudio' target='_blank'></a>
</div></div>

<div class="footer-logos">
		<h1>COPYRIGHT &copy; <script type="text/javascript">var d = new Date(); document.write(d.getFullYear());</script> LINEAGE II Stark - SERVER CREATED Stark Team.</h1>
		<h1>Lineage II and all associated logos and designs are trademarks or registered trademarks of NCSOFT Corporation.
		All other trademarks or registered trademarks are property of Stark Team.</h1>
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
<!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "303234547049419", // Facebook page ID
            telegram: "", // Telegram bot username
            call_to_action: " help you?", // Call to action
            button_color: "#666666", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "facebook,telegram", // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->

</body>
</html>
