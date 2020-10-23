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
	
	User Panel Version 2.2
	
-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="keywords" content="<?php echo strtolower($server_name.', '.$server_chronicle); ?>, l2, lineage, lineage2, lineage 2, lainiege, laineage, lainiage, lineage dois, lineage ii, internacional, international, portuguese, english, espanish, espanol, espanhol, portugues, ingles, gringo, br, 1x, 5x, 10x, 30x, 50x, 70x, 100x, 150x, 200x, 300x, 1000x, free fun, diversao gratis, gratuito, gratuitamente, free fun, new server, novo servidor, o melhor servidor de lineage 2, o melhor servidor"/>
<meta name="description" content="<?php echo $server_name; ?>, the best server of Lineage 2 <?php echo $server_chronicle; ?>. Join us for free and play!"/>
<link rel="shortcut icon" href="./imgs/favicon.ico">
<title><?php echo $server_name." - ".$server_chronicle; ?></title>
<link rel="image_src" href="http://<?php echo $panel_url; ?>/imgs/image_src.jpg" />
<meta property="og:title" content="<?php echo $server_name." - ".$server_chronicle; ?>" />
<meta property="og:site_name" content="<?php echo $server_name; ?>" />
<meta property="og:url" content="http://<?php echo $panel_url; ?>" />
<meta property="og:description" content="<?php echo $server_name; ?>, the best server of Lineage 2 <?php echo $server_chronicle; ?>. Join us for free and play!" />
<meta property="og:type" content="website" />
<meta property="og:image" content="http://<?php echo $panel_url; ?>/imgs/image_src.jpg" />

<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/global.css?1" media="all" />

<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/global.js?1"></script>

</head>
<body>

<section class='<?php $themeAvailables = array('default', 'black', 'blue', 'red', 'green', 'purple'); echo $language.' '.(in_array($themeColor, $themeAvailables) ? $themeColor : 'default').(!$logged ? ' login' : ''); ?>'>
	
	<div class='langs'><?php $addp = "&url=http://".urlencode($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?>
		<a href='?changelang=en' class='en' title='English' onclick="document.location.replace('./index.php?changelang=en<?php echo $addp; ?>');return false;"></a>
		<a href='?changelang=pt' class='pt' title='Portugu&ecirc;s' onclick="document.location.replace('./index.php?changelang=pt<?php echo $addp; ?>');return false;"></a>
		<a href='?changelang=es' class='es' title='Espa&ntilde;ol' onclick="document.location.replace('./index.php?changelang=es<?php echo $addp; ?>');return false;"></a>
	</div>
	
	<?php
	$pagesExceptions = array('register', 'forgot', 'forgot_confirm'); 
	if(!$logged && $m == '' && in_array($p, $pagesExceptions)) {
		
		require('./pages/'.$p.'.php');
		
	} else if(!$logged) {
	?>
	
		<div class='indexTitle'><?php echo $LANG[39000]; ?></div>
		
		<div class='smallCenter'>
			
			<div style='text-align: center; font-weight: bold; color: #000;'><?php echo $LANG[39007]; ?></div><br />
		
			<form class='usarJquery' action='./?engine=login' method='POST'>
				
				<?php $_SESSION['lkey'] = md5(time().rand(100,999).$uniqueKey); echo "<input type='hidden' name='lkey' value='".$_SESSION['lkey']."' />"; ?>
				
				<label class='formpadrao'>
					<div>
						<div class='desc'>Login:</div>
						<div class='camp'><input type='text' name='ucp_login' autocomplete='off' value='' /></div>
					</div>
				</label>
				
				<label class='formpadrao'>
					<div>
						<div class='desc'><?php echo $LANG[12049]; ?>:</div>
						<div class='camp'><input type='password' name='ucp_passw' autocomplete='off' value='' /></div>
					</div>
				</label>
				
				<?php if(!empty($funct['forgot']) || !empty($link_forgot)) {
					
					echo "
					<div class='grayArea'>
						".$LANG[12020]." <a href='".(!empty($funct['forgot']) ? "./?page=forgot" : $link_forgot)."'>".$LANG[12034]."</a>
					</div>
					";
					
				}
				
				if(!empty($captcha_cp_on)) { ?>
				
					<label class='formpadrao captcha'>
						<div>
							<div class='desc'><img style='margin:5px 0 0 0;' class='captchaImage' src='captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>' /></div>
							<div class='camp'><input type='text' id='captchaInput' maxlength='5' name='captcha' autocomplete='off' /></div>
							<a tabindex='-1' href='#'><img src='captcha/refresh.png' /></a>
						</div>
					</label>
					
				<?php } ?>
				
				<div class='accessButton'>
					<input type='submit' class='default big' value='Login' />
				</div>
				
			</form>
			
			<?php if(!empty($funct['regist']) || !empty($link_regist)) {
				
				echo "
				<div class='grayArea'>
					".$LANG[12019]." <a href='".(!empty($funct['regist']) ? "./?page=register" : $link_regist)."'>".$LANG[12077]."</a>
				</div>
				";
				
			}
			
			?>
			
		</div>
		
	<?php } else { ?>
		
		<div class='loggedAs'>
			<div>
				<i class='fa fa-user'></i>&nbsp;&nbsp;<?php echo $_SESSION['acc']; ?>
				<div>
					<a href='./?module=configs&page=changedata' title='<?php echo $LANG[39012]; ?>' class='default'><i class='fa fa-cog'></i></a>
					<a href='./?engine=logout' title='<?php echo $LANG[12023]; ?>' class='default logout'><i class='fa fa-lock'></i></a>
				</div>
			</div>
		</div>
		
		<div class='grayBg'>
			
			<aside>
				
				<div class='saldo'>
					<div>
						<?php
						if(empty($port)) {
							$saldo = DB::Executa("SELECT saldo FROM site_balance WHERE account = '".$_SESSION['acc']."' LIMIT 1");
						} else {
							$saldo = DB::Executa("SELECT TOP 1 saldo FROM site_balance WHERE account = '".$_SESSION['acc']."'", "SITE");
						}
						if(count($saldo) == 0) { $saldo[0]['saldo'] = 0; }
						?>
						<div class='total'><?php echo $LANG[10068]; ?>: <span><span><?php echo intval(trim($saldo[0]['saldo']))."</span> ".$coinName_mini."'s" ; ?></span></div>
						<div class='bts'>
							<?php
							if(!empty($funct['donate'])) { echo "<a href='./?module=donate&page=add' class='default'>".$LANG[39009]."</a>"; }
							if(!empty($funct['trnsf1']) || !empty($funct['trnsf2'])) { echo "<a href='./?module=donate&page=transfer' class='default'>".$LANG[10013]."</a>"; }
							?>
						</div>
					</div>
				</div>
				
				<nav>
					
					<a href='./'<?php echo ($p == 'index' ? " class='actived'" : ""); ?>>
						<i class='fa fa-home'></i>Home
					</a>
					
					<span<?php echo ($m == 'donate/' ? " class='actived'" : ""); ?>>
						<span><i class='fa fa-money'></i><?php echo $LANG[12039]; ?></span>
						<div class='dropdown'>
							<?php
							if(!empty($funct['donate'])) { echo "<a href='./?module=donate&page=add'>".$LANG[39010]." ".$coinName_mini."'s"."</a>"; }
							echo "<a href='./?module=donate&page=orders'>".$LANG[39011]."</a>";
							if(!empty($funct['trnsf1']) || !empty($funct['trnsf2'])) { echo "
								<a href='./?module=donate&page=transfer'>".$LANG[10013]." ".$coinName_mini."'s"."</a>
								<a href='./?module=donate&page=transfers_list'>".$LANG[40037]."</a>"; }
							?>
						</div>
					</span>
					
					<?php
					
					if(!empty($funct['servic'])) {
						echo "
						<a href='./?module=services&page=list'".($m == 'services/' ? " class='actived'" : "").">
							<i class='fa fa-suitcase'></i>".$LANG[10010]."
						</a>
						";
					}
					
					if(!empty($funct['shopon'])) {
						echo "
						<a href='./?module=shop&page=list'".($m == 'shop/' ? " class='actived'" : "").">
							<i class='fa fa-shopping-cart'></i>Shop
						</a>
						";
					}
					
					if(!empty($funct['enchnt'])) {
						echo "
						<a href='./?module=enchant&page=chars'".($m == 'enchant/' ? " class='actived'" : "").">
							<i class='fa fa-magic'></i>Enchant Itens
						</a>
						";
					}
					
					if(!empty($funct['gamst1']) || !empty($funct['gamst2']) || !empty($funct['gamst3']) || !empty($funct['gamst4']) || !empty($funct['gamst5']) || !empty($funct['gamst6']) || !empty($funct['gamst7'])) {
						echo "
						<span".($m == 'stats/' ? " class='actived'" : "").">
							<span><i class='fa fa-bar-chart'></i>Game Stats</span>
							<div class='dropdown'>
								".(!empty($funct['gamst1']) ? "<a href='./?module=stats&page=toppvp'>Top PvP</a>" : "")."
								".(!empty($funct['gamst2']) ? "<a href='./?module=stats&page=toppk'>Top PK</a>" : "")."
								".(!empty($funct['gamst4']) ? "<a href='./?module=stats&page=toponline'>Top Online</a>" : "")."
								".(!empty($funct['gamst8']) ? "<a href='./?module=stats&page=toplevel'>Top Level</a>" : "")."
								".(!empty($funct['gamst9']) ? "<a href='./?module=stats&page=topadena'>Top Adena</a>" : "")."
								".(!empty($funct['gamst3']) ? "<a href='./?module=stats&page=topclan'>Top Clan</a>" : "")."
								".(!empty($funct['gamst5']) ? "<a href='./?module=stats&page=oly_rank'>Grand Olympiad</a>" : "")."
								".(!empty($funct['gamst6']) ? "<a href='./?module=stats&page=boss'>Boss Status</a>" : "")."
								".(!empty($funct['gams10']) ? "<a href='./?module=stats&page=boss_jewels_loc'>Boss Jewels Loc</a>" : "")."
								".(!empty($funct['gamst7']) ? "<a href='./?module=stats&page=siege'>Castle & Siege</a>" : "")."
							</div>
						</span>
						";
					}
					
					if(!empty($funct['galle1']) || !empty($funct['galle2']) || !empty($funct['galle3'])) {
						echo "
						<span".($m == 'gallery/' ? " class='actived'" : "").">
							<span><i class='fa fa-image'></i>".$LANG[40010]."</span>
							<div class='dropdown'>
								".(!empty($funct['galle3']) ? "<a href='./?module=gallery&page=view'>".$LANG[40035]."</a>" : "")."
								".(!empty($funct['galle1']) ? "<a href='./?module=gallery&page=send_screenshot'>".$LANG[40011]."</a>" : "")."
								".(!empty($funct['galle2']) ? "<a href='./?module=gallery&page=send_video'>".$LANG[40012]."</a>" : "")."
								".((!empty($funct['galle1']) || !empty($funct['galle2'])) ? "<a href='./?module=gallery&page=uploads'>".$LANG[40013]."</a>" : "")."
							</div>
						</span>
						";
					}
					
					if(!empty($funct['config'])) {
						echo "
						<a href='./?module=configs&page=changedata'".($m == 'configs/' ? " class='actived'" : "").">
							<i class='fa fa-cog'></i>".$LANG[39012]."
						</a>
						";
					}
					
					if(!empty($funct['frmacc'])) {
						echo "
						<a href='./?module=forum&page=create'".($m == 'forum/' ? " class='actived'" : "").">
							<i class='fa fa-user-plus'></i>Forum Account
						</a>
						";
					}
					
					?>
					
					<a href='../'>
						<i class='fa fa-arrow-circle-left'></i><?php echo $LANG[40045]; ?>
					</a>
					
					<a href='./?engine=logout'>
						<i class='fa fa-lock'></i><?php echo $LANG[12023]; ?>
					</a>
					
				</nav>
				
			</aside>
			
			<article>
				<?php require('./pages/'.$p.'.php'); ?>
			</article>
			
		</div>
		
	<?php } ?>
	
</section>

<footer>
	&copy; <?php echo date('Y'); ?> <?php echo $server_name; ?> - All rights reserved<br />
	<span>Atualstudio Lineage 2 User Panel 2.2</span>
	<a class='atualstudio' href='http://www.atualstudio.com' title='<?php echo $LANG[12028]; ?>' target='_blank'></a>
</footer>

<?php
if(!empty($_SESSION['aAlert_msg'])) {
	echo "<script>atualAlert('".$_SESSION['aAlert_msg']."', '".$_SESSION['aAlert_act']."', '".(isset($_SESSION['aAlert_url']) ? $_SESSION['aAlert_url'] : '')."');</script>";
	$_SESSION['aAlert_msg'] = ''; $_SESSION['aAlert_act'] = ''; $_SESSION['aAlert_url'] = ''; unset($_SESSION['aAlert_msg']); unset($_SESSION['aAlert_act']); unset($_SESSION['aAlert_url']);
}
?>

<!-- Important Terms to JS Scripts -->
<input type='hidden' id='l11015' value='<?php echo ($LANG[11015]); ?>' />
<input type='hidden' id='l11016' value='<?php echo ($LANG[11016]); ?>' />
<input type='hidden' id='l20001' value='<?php echo ($LANG[20001]); ?>' />
<input type='hidden' id='l12004' value='<?php echo ($LANG[12004]); ?>' />
<input type='hidden' id='l40044' value='<?php echo ($LANG[40044]); ?>' />

</body>
</html>
