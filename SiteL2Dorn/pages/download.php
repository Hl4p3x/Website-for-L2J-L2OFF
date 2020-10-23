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
	
	<h2>Download <?php echo $LANG[11001]; ?> UPDATE TWO</h2>
	<br />
	<div style='display:table;margin: 0 auto;'><a target='_blank' href='#' class='default dbig'>[ Soon ]</a></div>

	
	<br /><br /><br /><hr />
	
	<h2>Download <?php echo $LANG[11001]; ?>Custom Online until 01/09</h2>
	<br />
	<div style='display:table;margin: 0 auto;'><a target='_blank' href='FilesL2Boom.rar' class='default dbig'>DIRECT DOWNLOAD</a></div>
	<br />
	<div style='display:table;margin: 0 auto;'><a target='_blank' href='http://www.mediafire.com/file/og1b48bsw9b5xb4/Files+Lineage+2+Boom.rar' class='default dbig'>Media Fire 136.MB</a></div>
	<div style='display:table;margin: 0 auto;'><a target='_blank' href='https://yadi.sk/d/GKIrvek-3KvzKh' class='default dbig'>Yandex.Disk 140.1MB</a></div>
	
	<br /><br /><br /><hr />
	
	<h2>Download <?php echo $server_chronicle; ?> Client</h2>
	<br />
	<div style='display:table;margin: 0 auto;'><a target='_blank' href='https://mega.nz/#!apEWEJ6Y!NHvpzRPxsJGAbGuSXgEc16JfeuEVjtsW0X1_znQh5AI' class='default dbig'>MEGA</a></div>
	<div style='display:table;margin: 0 auto;'><a target='_blank' href='http://www.ausgamers.com/files/download/59001/lineage-2-the-chaotic-throne--interlude-client' class='default dbig'>Ausgamers</a></div>
	<br />
	 <center>
	 <h2>Tutorial para instalar em video.</h2>
	<iframe width="440" height="330" src="https://www.youtube.com/embed/kyNFPceYKno" frameborder="0" allowfullscreen></iframe>
	<br />
	1. - Baixar o cliente e instale pelo aplicativo Setup.exe<br>
				2. - (Importante) Faça o download e extraia nosso Patch na pasta padrão de instalação do seu Client L2 Interlude (C:/Arquivos de Programas/Lineage 2). <br>
				3. - Clica em subistuir todos arquivos<br>
				4. - Execute o jogo pelo arquivo L2.exe que fica localizado dentro da pasta System do seu jogo (C:/Arquivos de Programas/Lineage 2/System). <br>
				5. - Agora execute L2.exe arquivo da pasta system<br>
				6. - Se você está tendo problemas, entre em contato com o suporte <a>https://www.facebook.com/L2BoomOficial/</a><br>	<br /><hr />

</div>          