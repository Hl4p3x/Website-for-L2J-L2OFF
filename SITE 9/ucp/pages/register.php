<?php if(!$indexing) { exit; } ?>

<div class='indexTitle'><?php echo $LANG[12077]; ?></div>

<div class='smallCenter'>

	<?php
	$desativarReg = 0;
	$dateReg = mktime($reg['hr'],$reg['min'],0,$reg['mes'],$reg['dia'],$reg['ano']);
	if($dateReg > time()) {
		echo "<div class='rmsg error'>".$LANG[12977]."<br /> ".date('d F, Y \- H:i', $dateReg)."</div>";
		$desativarReg = 1;
	}
	?>

	<form class='usarJquery registerForm' method='POST' action='./?engine=create_account'>
		
		<?php $_SESSION['key'] = md5(time().rand(100,999).$uniqueKey); echo "<input type='hidden' name='key' value='".$_SESSION['key']."' />"; ?>
		
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
				<div class='camp'><input type='text' maxlength='100' name='email' value='' autocomplete='off' /></div>
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

		<input type='submit' class='default big' value='<?php echo $LANG[12077]; ?>' style='margin: 20px auto; display: table;<?php echo ($desativarReg == 1) ? " opacity: 0.6; cursor: default;' disabled" : "'"; ?> />

	</form>
	
</div>

<?php
if($desativarReg == 1) {
	echo "<div class='rmsg error'>".$LANG[12977]."<br /> ".date('d F, Y \- H:i', $dateReg)."</div>";
}
