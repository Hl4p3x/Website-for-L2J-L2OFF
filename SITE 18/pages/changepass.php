<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; }
	
if($logged == 1) {
	fim('', 'ERROR', './?page=ucp_changepass');
}

?>

<span id='accLoc'></span>

<h1>Account</h1>

<div class='pddInner'>
	<?php echo $LANG[12031]; ?>
</div>

<hr />

<div class='horMenu'>
	<a href='?page=register#accLoc'><?php echo $LANG[12032]; ?></a>
	<a href='javascript:void(0);' class='act'><?php echo $LANG[12022]; ?></a>
	<a href='?page=forgot#accLoc'><?php echo $LANG[12034]; ?></a>
</div>

<div class='pddInner'>
	
	<div class='rmsg error'><?php echo $LANG[12035]; ?></div>
	
	<div style='font-weight:bold; text-align:center;'><?php echo $LANG[12036]; ?></div><br />
	
	<form method="POST" class="usarJquery" action="./?engine=login">
		
		<input type='hidden' name='lkey' value='<?php echo $_SESSION['lkey']; ?>' />
		
		<label class='formpadrao'>
			<div>
				<div class='desc'>Login:</div>
				<div class='camp'><input type='text' name='ucp_login' maxlength='14' autocomplete='off' /></div>
			</div>
		</label>
		
		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[12037]; ?>:</div>
				<div class='camp'><input type='password' maxlength='16' name='ucp_passw' autocomplete='off' /></div>
			</div>
		</label>
		
		<label class='formpadrao captcha'>
			<div>
				<div class='desc'><img style='margin:5px 0 0 0;' class='captchaImage' src='captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>' /></div>
				<div class='camp'><input type='text' id='captchaInput' maxlength='5' name='captcha' autocomplete='off' /></div>
				<a tabindex='-1' href='#'><img src='captcha/refresh.png' /></a>
			</div>
		</label>
		
		<input style='margin: 20px auto; display: table;' type='submit' class='default dbig' value='Login' />
	
	</form>

</div>