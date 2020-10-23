<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; } ?>

<span id='accLoc'></span>

<h1>Account</h1>

<hr />

<div class='horMenu'>
	<a href='?page=register#accLoc'><?php echo $LANG[12032]; ?></a>
	<a href='?page=changepass#accLoc'><?php echo $LANG[12022]; ?></a>
	<a href='javascript:void(0);' class='act'><?php echo $LANG[12034]; ?></a>
</div>

<div class='pddInner'>
	
	<?php echo $LANG[12043]; ?>

	<br /><br />
	
	<form class='usarJquery' method='POST' action='./?engine=recover'>
		
		<?php $_SESSION['key'] = md5(time().rand(100,999).$uniqueKey); echo "<input type='hidden' name='key' value='".$_SESSION['key']."' />"; ?>
		
		<label class='formpadrao'>
			<div>
				<div class='desc'>E-mail:</div>
				<div class='camp'><input type='text' maxlength='100' name='email' autocomplete='off' /></div>
			</div>
		</label>
		
		<label class='formpadrao captcha'>
			<div>
				<div class='desc'><img style='margin:5px 0 0 0;' class='captchaImage' src='captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>' /></div>
				<div class='camp'><input type='text' id='captchaInput' maxlength='5' name='captcha' autocomplete='off' /></div>
				<a tabindex='-1' href='#'><img src='captcha/refresh.png' /></a>
			</div>
		</label>
		
		<input style='margin: 20px auto; display: table;' type='submit' class='default dbig' value='<?php echo $LANG[12034]; ?>' />
		
	</form>

</div>
