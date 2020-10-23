<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; } ?>

<h1><?php echo $LANG[12040]; ?></h1>

<div class='pddInner'>
		
	<?php
	
	require('private/classes/classAccount.php');
	
	Account::deleteForgotExpiredCodes();
	
	if((!isset($_GET['acc']))||(!isset($_GET['code']))) { echo "<script type='text/javascript'>document.location.replace('./');</script>"; exit; }
	
	$acc = vCode(urldecode($_GET['acc']));
	$code = vCode($_GET['code']);
	
	$checkCode = Account::checkForgotCode($acc, $code);
	if(count($checkCode) == 0) {
		fim($LANG[12046], 'ERROR', './');
	}
	
	?>
	
	<ul>
		<li style='margin-bottom: 10px;'><?php echo $LANG[12044]; ?></li>
		<li><?php echo $LANG[12045]; ?></li>
	</ul>
	
	<br /><br />
	
	<form class='usarJquery' method='POST' action='./?engine=recover_confirm&acc=<?php echo urlencode($acc)."&code=".urlencode($code); ?>'>
			
		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[12047]; ?>:</div>
				<div class='camp'><input type='password' maxlength='50' name='pass' /></div>
			</div>
		</label>
		
		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[12048]; ?>:</div>
				<div class='camp'><input type='password' maxlength='50' name='passr' /></div>
			</div>
		</label>
		
		<?php if(preg_match('/^all_/', $acc)) {
			echo "
			<label class='formpadrao'>
				<div>
					<div class='desc'>E-mail:</div>
					<div class='camp'><input type='text' disabled value='".substr($acc, 4)."' /></div>
				</div>
			</label>";
		} else {
			echo "
			<label class='formpadrao'>
				<div>
					<div class='desc'>Login:</div>
					<div class='camp'><input type='text' disabled value='".$acc."' /></div>
				</div>
			</label>
			";
		}
		?>
		
		<input style='margin: 20px auto; display: table;' type='submit' class='default dbig' value='<?php echo $LANG[12050]; ?>' />
		
	</form>

</div>
