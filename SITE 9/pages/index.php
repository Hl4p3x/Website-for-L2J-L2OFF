	<?php
	if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; }

	require('private/classes/classIndex.php');

	$dirCache = 'cache/';
	$filesCache = glob("$dirCache{*.txt}", GLOB_BRACE);
	foreach($filesCache as $file){
		if(filemtime($file) < (time()-86400)) {
			unlink($file);
		}
	}

	?>
	<!-- Banners -->
	<div class='banners'>
		
		<div class='b1'>
			<a href='./?page=register'>
				Cadastrar Agora			<span>Jogue grátis no melhor Interlude</span>
			</a>
			<img src='imgs/banner1.jpg' />
		</div>
		
		<div class='b2'>
			<a href='./?page=donations'>
				Adquira Coins			<span>Se fortaleça e torne-se o melhor</span>
			</a>
			<img src='imgs/banner2.jpg' />
		</div>
		
	</div>

	<section>
				<aside>
			<!-- Banners -->
<script type='text/javascript'>
$(document).ready(function(){
	$('.banner > a:first-child').addClass('bvis');
	$('.banner .circles div:first-child').addClass('act');
	var rotateBannerAtualstudio = function() {
		if($('input#tempBanner').val() == '1') {
			var countA = $('.banner > a').length;
			var relAtual = $('.banner > a.bvis').attr('rel');
			var proxRel = parseInt(parseInt(relAtual)+1);
			if(proxRel > countA) {
				var proxRel = 1;
			}
			$('.banner > a').removeClass('bvis');
			$('.banner > a[rel='+proxRel+']').addClass('bvis');
			$('.banner .circles div').removeClass('act');
			$('.banner .circles div[rel='+proxRel+']').addClass('act');
		}
		  setTimeout(rotateBannerAtualstudio, <?php echo ((isset($bannerDelay) ? intval(trim($bannerDelay)) : 3) * 1000); ?>);
	}
	setTimeout(rotateBannerAtualstudio, <?php echo ((isset($bannerDelay) ? intval(trim($bannerDelay)) : 3) * 1000); ?>);
	$('.banner').hover(function(){
		$('input#tempBanner').val('2');
	}, function(){
		$('input#tempBanner').val('1');
	});
	$('.circles div').hover(function(){
		var relCircle = $(this).attr('rel');
		$('.banner .circles div').removeClass('act');
		$(this).addClass('act');
		$('.banner > a').removeClass('bvis');
		$('.banner > a[rel='+relCircle+']').addClass('bvis');
	});
});
</script>
<style>
	.banner, .banner > .imgs a, .banner > .imgs a img, .banner .bdetail { width: <?php echo $bnWidth; ?>px !important; height: <?php echo $bnHeight; ?>px !important; }
</style>
<?php
$banners = Index::Banners();
$countBanners = count($banners);
if($countBanners > 0) { ?>
<div class='banner'>
	<div class='circles'<?php echo ($countBanners == 1 ? "style='display:none;'" : "")?>>
		<?php for($i=1; $i <= $countBanners; $i++) {
			if($i=='1') {
				echo "<div rel='$i' class='act'></div>";
			} else {
				echo "<div rel='$i'></div>";
			}
		} ?>
	</div>
	<?php for($i=1, $ii=0; $i <= $countBanners; $i++, $ii++) {
		$bannerPT = trim($banners[$ii]['imgurl_pt']);
		$bannerEN = trim($banners[$ii]['imgurl_en']);
		$bannerES = trim($banners[$ii]['imgurl_es']);
		echo "
		<a rel='".$i."' href='".$banners[$ii]['link']."'".($banners[$ii]['target'] == '1' ? " target='_blank'" : "").($i == '1' ? " class='bvis'" : "").">
			<div class='bmask'></div>
			<img src='".($language == 'en' && strlen($bannerEN) > 0 ? ($dir_banners.$bannerEN) : ($language == 'es' && strlen($bannerES) > 0 ? ($dir_banners.$bannerES) : ($dir_banners.$bannerPT) ) )."' />
		</a>";
	} ?>
	<input type='hidden' id='tempBanner' value='1' />
</div>

<hr />



<?php } ?>



<!-- Countdown INI -->
<?php if($counterActived == 1) { $inauguracao = mktime($cHor,$cMin,0,$cMes,$cDia,$cAno); if(time() < $inauguracao) { ?>
<h1><?php echo $LANG[10999]; ?></h1>
<div style="font-size: 24px; text-align:center; padding: 0 0 0 25px;">
	<?php echo $cDia." ".date('F', $inauguracao).", ".$cAno." &bullet; ".$cHor.":".$cMin; ?> <span style='font-size:11px; font-weight:bold; font-style:italic; vertical-align: super;'>(UTC <?php echo $cGMT; ?>)</span>
</div>
<link href="css/soon.min.css" rel="stylesheet" />
<div class="atualstudioCountdown">
	<style>
		@import url(http://fonts.googleapis.com/css?family=Quicksand);
		#soon-glow { font-family: 'Quicksand', sans-serif; color: #fff; background: transparent; text-transform:lowercase; }
		#soon-glow .soon-label { color: #fff; text-shadow:0 0 .25rem rgba(0,0,0,.75); }
		#soon-glow .soon-ring-progress { color: #fff; background-color:rgba(0,75,75,.15); }
		#soon-glow>.soon-group { margin-bottom:-.5em; }
		.soon[data-layout*="group"] { padding-top: 20px; }
		.soon[data-face*="glow"] .soon-separator, .soon[data-face*="glow"] .soon-slot-inner { text-shadow: 0 0 .125em rgba(0,0,0,.75); }
	</style>
	<div class="soon" id="soon-glow" data-layout="group overlap" data-face="slot doctor glow" data-padding="false" data-scale-max="l" data-visual="ring color-light width-thin glow-progress length-70 gap-0 offset-65"></div>
</div>
<script>(function(){ var i=0,soons = document.querySelectorAll('.atualstudioCountdown .soon'),l=soons.length; for(;i<l;i++) { soons[i].setAttribute('data-due','<?php echo date("Y-m-d\TH:i:s", mktime(($cHor+$sumH), $cMin, 0, $cMes, $cDia, $cAno)); ?>'); soons[i].setAttribute('data-now','<?php echo date("Y-m-d\TH:i:s"); ?>'); } }());</script>
<script src="js/soon.min.js" data-auto="false"></script><script>var soons = document.querySelectorAll('.atualstudioCountdown .soon'); for(var i=0;i<soons.length;i++) { Soon.create(soons[i]); }</script>
<hr />
<?php } } ?>
<!-- Countdown  FIM -->
					
			<!-- Ranking -->
				<div class='box'>
				<div class='title'><?php echo $LANG[40001] ?></div>
				<div class='ct' style='padding-top:10px;'>
				
				<div class='multitables'>	
				<?php
				
				if($dpage['toppvp'] == 1) {
							$xml = @simplexml_load_file("cache/toppvp.xml"); $line = @$xml->line;
							if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
							if($asideRankCount > 0) {
								for($i=0, $c=$asideRankCount; $i < $c; $i++) {
									echo "<table border='0' cellpadding='0' cellspacing='0' class='pvp'>
								<tr>
									<th>Player</th>
									<th>PvP</th>
								</tr>
								<tr class='two'>
								<td>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name."</td> <td>".$line[$i]->pvp."</td> </table>";
								}
							} else {			
								for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 3); $i <= $c; $i++) {
									echo "<div>".$i."&ordm;&nbsp;&nbsp; Player <span>0 pvps</span></div>";
								}
							}
				}

				if($dpage['toppkp'] == 1) {
							$xml = @simplexml_load_file("cache/toppk.xml"); $line = @$xml->line;
							if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
							if($asideRankCount > 0) {
								for($i=0, $c=$asideRankCount; $i < $c; $i++) {
									echo "<table border='0' cellpadding='0' cellspacing='0' class='pk'>
								<tr>
									<th>Player</th>
									<th>PK</th>
								</tr>
								<tr class='two'>
								<td>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name."</td> <td>".$line[$i]->pk."</td> </table>";
								}
							} else {
								for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 3); $i <= $c; $i++) {
									echo "<div>".$i."&ordm;&nbsp;&nbsp; Player <span>0 pks</span></div>";
								}
							}
				}

				if($dpage['topcla'] == 1) {
							$xml = @simplexml_load_file("cache/topclan.xml"); $line = @$xml->line;
							if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
							if($asideRankCount > 0) {
								for($i=0, $c=$asideRankCount; $i < $c; $i++) {
								echo "<table border='0' cellpadding='0' cellspacing='0' class='clan'>
								<tr>
									<th>Clan</th>
									<th>Lv</th>
								</tr>
								<tr class='two'>
								<td>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name."</td> <td>".$line[$i]->level."</td> </table>";
								}
							} else {
								for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 3); $i <= $c; $i++) {
									echo "<div>".$i."&ordm;&nbsp;&nbsp; Clan <span>0 lvl</span></div>";
								}
							}
				}

				?>
				</div>

				<a class='moreranks' href='./?page=toppvp'>Ver mais rankings</a>
			</div>
		</div>
		<!-- Ranking -->
		
		
		
		
		<!-- Gallery -->
			<div class='box'>
					<div class='title'><?php echo $LANG[12026] ?></div>
					<div class='ct'>
					
					<div class='galleryBox'><div>
				
				<?php
				if($dpage['galler'] == 1) {
							$xml = @simplexml_load_file("cache/gallery.xml");
							$line = @$xml->line;
							$asideRankCount = (!empty($galleCount) ? intval($galleCount) : 6);
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
							for($i=$asideRankCount, $c=(!empty($galleCount) ? intval($galleCount) : 6); $i < $c; $i++) {
								echo "<a href='javascript:void(0)'></a>";
							}
				}
				?>
				<a class='moreranks' href='./?page=gallery'>ver mais</a>
			</div></div>
		</div>
	</div>
	<!-- Gallery -->



	




	

		</aside>

				
			
	<article>
	<!-- News -->	
	<h1><?php echo $LANG[13001]; ?></h1>
	<?php
	$news = Index::News(0, $inewsCount);
	$totalNews = count($news);
	if($totalNews > 0) {
		for($i=0; $i < $totalNews; $i++) {
			$newsImage = ((strlen(trim($news[$i]['img'])) > 0) ? (file_exists($dir_newsimg.trim($news[$i]['img'])) ? $dir_newsimg.trim($news[$i]['img']) : 'imgs/nm/no-img-new.jpg') : 'imgs/nm/no-img-new.jpg');
			$newTxt = strip_tags(($language == 'en' && strlen(trim($news[$i]['content_en'])) > 0 ? trim($news[$i]['content_en']) : ($language == 'es' && strlen(trim($news[$i]['content_es'])) > 0 ? trim($news[$i]['content_es']) : trim($news[$i]['content_pt']))));
			$newTitle = ($language == 'en' && strlen(trim($news[$i]['title_en'])) > 0 ? trim($news[$i]['title_en']) : ($language == 'es' && strlen(trim($news[$i]['title_es'])) > 0 ? trim($news[$i]['title_es']) : $news[$i]['title_pt']));
			echo "
			<div class='news'>
			
			<div>
			<a class='imgn' href='./?page=news&id=".$news[$i]['nid']."'><img src='".$newsImage."' /></a>
			<div class='contentn'>
			<a href='./?page=news&id=".$news[$i]['nid']."' class='titlen'>".$newTitle."</a>
			
					<div class='textn'>
						".(trim(substr($newTxt, 0, 180)).(strlen($newTxt) > 180 ? '...' : ''))."
					</div>
					
					<div class='finalinfo'>
						<div class='datan'>".date('d F, Y', $news[$i]['post_date'])."</div>
						<a class='lermaisn'  href='./?page=news&id=".$news[$i]['nid']."'>".$LANG[12991]." &raquo;</a>
					</div>
					
				</div>
			</div>
			<a href='?page=news&id=all' class='morenews'>Confira mais notícias</a>

		</div>
			".(($totalNews-1) != $i ? "<div class='shadownew stpPNG'></div>" : "");
		}
	} else {
		echo "<div style='text-align:center;'><b>".$LANG[12063]."</b></div>";
	}

	?>	
		
	<!-- Facebook Box -->
	<?php if($faceBoxOn == 1) { ?>
		<h1><?php echo $LANG[29002]; ?></h1>
		<div class='pddInner'>
			<?php echo $LANG[12998]; ?>
		</div>
		<style>
			.faceIndex { width: <?php echo $fbWidth; ?>px !important; }
		</style>
		<div class='faceIndex'>
			<div class="fb-page" data-href="<?php echo $facePage; ?>" data-width="<?php echo $fbWidth; ?>" data-height="<?php echo $fbHeight; ?>" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo $facePage; ?>"><a href="<?php echo $facePage; ?>"></a></blockquote></div></div>
		</div>
	<?php } ?>
	
	<aside>
<div class='box'>
				<div class='title'>Ajude-nos Votando</div>
				<div class='ct vote'>
					<footer>
				<a href="#" target="_blank"><img src="https://l2topzone.com/90x60.png"></a>
				<a href="#" target="_blank"><img src="https://hopzone.r.worldssl.net/img/_vbanners/lineage2/lineage2-90x60-1.gif"></a>
				<a href="#" target="_blank"><img src="https://l2network.eu/images/button2.png"></a>
		
	
	    <center>
				<a href="https://info.flagcounter.com/CSWO"><img src="https://s04.flagcounter.com/count2/CSWO/bg_000000/txt_FFF717/border_000000/columns_3/maxflags_19/viewers_0/labels_0/pageviews_0/flags_0/percent_0/" alt="Free counters!" border="0"></a>
				</center>
		
		
		</div>
	</div>
	
		</aside>
	</article>
	
	</section>	