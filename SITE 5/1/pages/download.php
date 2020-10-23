<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; } ?>

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
<hr />
<?php } } ?>
<!-- Countdown  FIM -->

<h1>Downloads</h1>

<div class='pddInner'>
	
	<?php echo $LANG[12038]; ?>
	
	<br /><br /><br /><hr />
	
	<h2>Download <?php echo $LANG[11001]; ?></h2>
	<br />
	
	
	<?php
	$desativarReg = 0;
	$dateReg = mktime($reg['hr'],$reg['min'],0,$reg['mes'],$reg['dia'],$reg['ano']);
	if($dateReg > time()) {
		echo "<div class='rmsg error'>".$LANG[12977]."<br /> ".date('d F, Y \- H:i', $dateReg)."</div>";
		$desativarReg = 1;
	
	}
	?>
     Arquivos para conectar ao nosso servidor .
    <br /><br /><br /><hr />
	<br />
	<div style='display:table;margin: 0 auto;'><a target='_blank' href=https://www.mediafire.com/file/x7ib32kxwwl3n8p/Patch_L2OriginsAT8.7.rar/file' class='default dbig'>Patch Completa</a></div>
	
	
	<br />
				
	
	
	<br /><br /><br /><hr />
	
	<h2>Download <?php echo $server_chronicle; ?> Client</h2>
	<br />
	<div style='display:table;margin: 0 auto;'><a target='_blank' href=https://gameborder.net/file/lineage-ii-interlude-client' class='default dbig'>gameborde</a></div>
	<br />
<hr />
</div>          