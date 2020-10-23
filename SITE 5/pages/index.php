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
		#soon-glow { font-family: 'Quicksand', sans-serif; color: #000; background: transparent; text-transform:lowercase; }
		#soon-glow .soon-label { color: #000; text-shadow:0 0 .25rem rgba(0,0,0,.75); }
		#soon-glow .soon-ring-progress { color: #000; background-color:rgba(0,0,0,.15); }
		#soon-glow>.soon-group { margin-bottom:-.5em; }
		.soon[data-layout*="group"] { padding-top: 20px; }
		.soon[data-face*="glow"] .soon-separator, .soon[data-face*="glow"] .soon-slot-inner { text-shadow: 0 0 .125em rgba(0,0,0,.75); }
	</style>
	<div class="soon" id="soon-glow" data-layout="group overlap" data-face="slot doctor glow" data-padding="false" data-scale-max="l" data-visual="ring color-light width-thin glow-progress length-70 gap-0 offset-65"></div>
</div>
<script>(function(){ var i=0,soons = document.querySelectorAll('.atualstudioCountdown .soon'),l=soons.length; for(;i<l;i++) { soons[i].setAttribute('data-due','<?php echo date("Y-m-d\TH:i:s", mktime(($cHor+$sumH), $cMin, 0, $cMes, $cDia, $cAno)); ?>'); soons[i].setAttribute('data-now','<?php echo date("Y-m-d\TH:i:s"); ?>'); } }());</script>
<script src="js/soon.min.js" data-auto="false"></script><script>var soons = document.querySelectorAll('.atualstudioCountdown .soon'); for(var i=0;i<soons.length;i++) { Soon.create(soons[i]); }</script>

<?php } } ?>
<!-- Countdown  FIM -->

<center><b>Time zone for countries Open Server:</b><p>
(Greece) Friday, October 20, 2017, 12:00 PM<p>
(Venezuela) Friday, October 20, 2017, 05:00 PM<p>
(Russia) Friday, October 20, 2017, 12:00 PM<p>
(Brazil - Brasilia) Friday, October 20, 2017, 19:00<p>
(Argentina) Friday, October 20, 2017, 06:00 PM<p></center>


<hr />
<!-- News -->
<h1><?php echo $LANG[13001]; ?> <a href='?page=news&id=all'><?php echo $LANG[12027]; ?> &raquo;</a></h1>
<?php
$news = Index::News(0, $inewsCount);
$totalNews = count($news);
if($totalNews > 0) {
	for($i=0; $i < $totalNews; $i++) {
		$newsImage = ((strlen(trim($news[$i]['img'])) > 0) ? (file_exists($dir_newsimg.trim($news[$i]['img'])) ? $dir_newsimg.trim($news[$i]['img']) : 'images/nm/no-img-new.jpg') : 'images/nm/no-img-new.jpg');
		$newTxt = strip_tags(($language == 'en' && strlen(trim($news[$i]['content_en'])) > 0 ? trim($news[$i]['content_en']) : ($language == 'es' && strlen(trim($news[$i]['content_es'])) > 0 ? trim($news[$i]['content_es']) : trim($news[$i]['content_pt']))));
		$newTitle = ($language == 'en' && strlen(trim($news[$i]['title_en'])) > 0 ? trim($news[$i]['title_en']) : ($language == 'es' && strlen(trim($news[$i]['title_es'])) > 0 ? trim($news[$i]['title_es']) : $news[$i]['title_pt']));
		echo "
		<div class='news'>
			<a class='imgn' href='./?page=news&id=".$news[$i]['nid']."'><img src='".$newsImage."' /></a>
			<div class='contentn'>
				<a href='./?page=news&id=".$news[$i]['nid']."' class='titlen'>".$newTitle."</a>
				<div class='textn'>
					".(trim(substr($newTxt, 0, 180)).(strlen($newTxt) > 180 ? '...' : ''))."
				</div>
				<div class='finalinfo'>
					<div class='datan'>".date('d F, Y', $news[$i]['post_date'])."</div>
					<div class='lermaisn'><a href='./?page=news&id=".$news[$i]['nid']."'>".$LANG[12991]." &raquo;</a></div>
				</div>
			</div>
		</div>
		".(($totalNews-1) != $i ? "<div class='shadownew stpPNG'></div>" : "");
	}
} else {
	echo "<div style='text-align:center;'><b>".$LANG[12063]."</b></div>";
}
?>
 

<!-- Facebook Box -->
<?php if($faceBoxOn == 1) { ?>
	<hr />
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
