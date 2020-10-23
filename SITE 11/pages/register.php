<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; } ?>

<span id='accLoc'></span>

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

	<?php
	$desativarReg = 0;
	$dateReg = mktime($reg['hr'],$reg['min'],0,$reg['mes'],$reg['dia'],$reg['ano']);
	if($dateReg > time()) {
		echo "<div class='rmsg error'>".$LANG[12977]."<br /> ".date('d F, Y \- H:i', $dateReg)."</div>";
		$desativarReg = 1;
	}
	?>

	<div class='rulesbox'>
		<?php require('pages/rules.php'); ?>
	</div>

	<form class='usarJquery registerForm' method='POST' action='./?engine=create_account'>
		
		<?php $_SESSION['key'] = md5(time().rand(100,999).$uniqueKey); echo "<input type='hidden' name='key' value='".$_SESSION['key']."' />"; ?>
		
		<label class='rmsg warn'>
			<input type='checkbox' id='acceptrules' value='1' /> <b><?php echo $LANG[12994]; ?></b>
		</label>

		<?php echo $LANG[12067]; ?>

		<br /><br />

		<label class='formpadrao accr_login'>
			<div>
				<div class='desc'>* Login:</div>
				<div class='camp'><input type='text' name='login' id='login' maxlength='14' value='<?php echo ((isset($_GET['l'])) ? vCode($_GET['l']) : ''); ?>' autocomplete='off' /></div>
			</div>
		</label>

		<?php if($suffixActive == 1) { ?>
			
			<style>#finalLogin { font-weight: bold; font-size: 15px; }</style>
			<label class='formpadrao' id='the_suffix'>
				<div>
					<div class='desc'>Login - <?php echo $LANG[10997]; ?>:</div>
					<div class='camp'>
						<select name='suffix' id='suffix'>
							<?php
							$subLetter = array(0 => 'C', 1 => 'D', 2 => 'Y', 3 => 'H', 4 => 'K', 5 => 'N', 6 => 'R', 7 => 'S', 8 => 'Z', 9 => 'X');
							echo "
							<option>".(rand(100,996)+1)."</option>
							<option>".(rand(100,996)+2)."</option>
							<option>".(rand(100,996)+3)."</option>
							<option>".strtr(rand(100,996)+1, $subLetter)."</option>
							<option>".strtr(rand(100,996)+2, $subLetter)."</option>
							<option>".strtr(rand(100,996)+3, $subLetter)."</option>
							";
							?>
						</select>
					</div>
				</div>
			</label>
			
			<div class='rmsg warn' style='margin-bottom: 2px;'>
				<?php
				echo "<span id='sfxMsg1'>".$LANG[10995]."</span><span id='sfxMsg2' style='display:none;'>".$LANG[29004]."</span><br />";
				if($forceSuffix != 1) { ?>
					<label><input id='disableSuffix' type='checkbox' name='nosuffix' value='1' /> <i><?php echo $LANG[10996]; ?></i></label>
				<?php } ?>
				<script>
					$(function() {
						
						$('#disableSuffix').prop('checked', false);
						
						$('select#suffix option').eq(<?php echo intval(rand(0, 5)); ?>).attr('selected', 'selected');
						
						$('#finalLogin').text('_____'+$('select#suffix').val());
						
						$('select#suffix').change(function(){
							if($('#login').val().length != 0) { var loginAtual = $('#login').val(); } else { var loginAtual = '_____'; }
							$('#finalLogin').text(loginAtual+$('select#suffix').val());
						});
						
						$('input#login').keyup(function(){
							if($('#login').val().length != 0) { var loginAtual = $('#login').val(); } else { var loginAtual = '_____'; }
							$('#finalLogin').text(loginAtual+$('select#suffix').val());
						});
						
						$('#disableSuffix').change(function() {
							if(!$('#the_suffix').hasClass('escondido')) {
								$('#login').attr('maxlength', '14');
								$('#the_suffix').addClass('escondido').css({ 'display': 'none' });
								$('#sfxMsg1').css({ 'display': 'none' });
								$('#sfxMsg2').css({ 'display': 'inline-block' });
							} else {
								$('#login').attr('maxlength', '11');
								$('#the_suffix').removeClass('escondido').css({ 'display': 'table' });
								$('#sfxMsg2').css({ 'display': 'none' });
								$('#sfxMsg1').css({ 'display': 'inline-block' });
							}
						});
						
					});
				</script>
			</div>

		<?php } ?>

		<label class='formpadrao accr_pass'>
			<div>
				<div class='desc'>* <?php echo $LANG[12049]; ?>:</div>
				<div class='camp'><input type='password' maxlength='25' name='pass' autocomplete='off' /></div>
			</div>
		</label>

		<label class='formpadrao accr_pass'>
			<div>
				<div class='desc'>* <?php echo $LANG[12048]; ?>:</div>
				<div class='camp'><input type='password' maxlength='25' name='pass2' autocomplete='off' /></div>
			</div>
		</label>

		<label class='formpadrao accr_email'>
			<div>
				<div class='desc'>* E-mail:</div>
				<div class='camp'><input type='text' maxlength='100' name='email' value='<?php echo ((isset($_GET['l'])) ? vCode($_GET['e']) : ''); ?>' autocomplete='off' /></div>
			</div>
		</label>

		<label class='formpadrao accr_email'>
			<div>
				<div class='desc'>* <?php echo $LANG[12010]; ?>:</div>
				<div class='camp'><input type='text' maxlength='100' name='email2' value='' autocomplete='off' /></div>
			</div>
		</label>

		<?php if($captcha_register_on == 1) { ?>
		<label class='formpadrao captcha'>
			<div>
				<div class='desc'><img style='margin:5px 0 0 0;' class='captchaImage' src='captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>' /></div>
				<div class='camp'><input type='text' id='captchaInput' maxlength='5' name='captcha' autocomplete='off' /></div>
				<a tabindex='-1' href='#'><img src='captcha/refresh.png' /></a>
			</div>
		</label>
		<?php } ?>

		<input type='submit' class='default dbig' value='<?php echo $LANG[12077]; ?>' style='margin: 20px auto; display: table;<?php echo ($desativarReg == 1) ? " opacity: 0.6; cursor: default;' disabled" : "'"; ?> />

	</form>
	
	<input type='hidden' id='l12004' value='<?php echo $LANG[12004]; ?>' />

</div>

<?php
if($desativarReg == 1) {
	echo "<div class='rmsg error'>".$LANG[12977]."<br /> ".date('d F, Y \- H:i', $dateReg)."</div>";
}
?>

<br /><br />
