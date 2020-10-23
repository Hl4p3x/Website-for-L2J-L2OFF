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

<?php } } ?>
<!-- Countdown  FIM -->
<center><b>Time zone for countries Open Server:</b><p>
(Greece) Friday, October 20, 2017, 12:00 PM<p>
(Venezuela) Friday, October 20, 2017, 05:00 PM<p>
(Russia) Friday, October 20, 2017, 12:00 PM<p>
(Brazil - Brasilia) Friday, October 20, 2017, 19:00<p>
(Argentina) Friday, October 20, 2017, 06:00 PM<p></center>
<hr />
<div class='pddInner'>
<h2>Color System</h2>
<b>PvP Color Name: </b><font color="BEBEBE"><b>10</b></font> <font color="998877"><b>50</b></font> <font color="EEDFB2"><b>100</b></font> <font color="ED9564"><b>200</b></font> <font color="9AFA00"><b>300</b></font> <font color="32CD32"><b>400</b></font> <font color="00FFFF"><b>500</b></font> <font color="00D7FF"><b>600</b></font> <font color="B469FF"><b>700</b></font> <font color="D355BA"><b>800</b></font> 

<font color="8080F0"><b>900</b></font> <font color="FF00FF"><b>1000</b></font> <font color="006400"><b>1300</b></font> <font color="8000"><b>1500</b></font> <font color="20A5DA"><b>1800</b></font> <font color="9060CD"><b>2000</b></font> <font color="3333CD"><b>2300</b></font> <font color="2F3E8B"><b>2500</b></font> <font color="8FF6FF"><b>2800</b></font> <font color="8B658B"><b>3000</b></font> 

<font color="8B8B00"><b>3300</b></font> <font color="8B008B"><b>3500</b></font> <font color="00008B"><b>3800</b></font> <font color="90EE90"><b>4000</b></font> <font color="1D66CD"><b>4300</b></font> <font color="13458B"><b>4500</b></font> <font color="FF309B"><b>5000</b></font> <font color="EE2C91"><b>5300</b></font> <font color="FF82AB"><b>5500</b></font> 

<font color="3A3A8B"><b>5800</b></font> <font color="55738B"><b>6000</b></font> <font color="00758B"><b>6500</b></font> <font color="23C1FF"><b>7000</b></font> <font color="008B8B"><b>7500</b></font> <font color="8B2268"><b>8000</b></font> <font color="00C9EE"><b>8500</b></font> <font color="2FFFAD"><b>9000</b></font> <font color="FFFF00"><b>9500</b></font> <font color="1"><b>10000</b></font> <br><br>

<b>Pk Color Title: </b><font color="B48246"><b>50</b></font> <font color="A0E9F5"><b>100</b></font> <font color="3333CD"><b>150</b></font> <font color="2F3E8B"><b>200</b></font> <font color="FFFF00"><b>250</b></font> <font color="8B658B"><b>300</b></font> <font color="8B8B00"><b>350</b></font> <font color="8B008B"><b>400</b></font> <font color="00008B"><b>450</b></font> <font color="0000FF"><b>500</b></font> 

<font color="90EE90"><b>700</b></font> <font color="FF309B"><b>1000</b></font> <font color="EE2C91"><b>1300</b></font> <font color="55738B"><b>1500</b></font> <font color="23C1FF"><b>1800</b></font> <font color="8B2268"><b>2000</b></font> <font color="1"><b>2500</b></font> 


<hr />
	
	<?php echo $LANG[11002]; ?>
	


</div>