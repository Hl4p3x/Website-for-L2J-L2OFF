<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; }
if($logged != 1) { fim('', 'ERROR', './'); }
require('private/classes/classAccount.php');
$acc = Account::checkLoginExists($_SESSION['acc']);
?>

<h1><?php echo $LANG[12022]; ?></h1>

<div class='pddInner'>

	<?php echo $LANG[12090]; ?>

	<br /><br />

	<form class='usarJquery'  id='form' method='POST' action='./?engine=ucp_updatepass'>

		<label class='formpadrao'>
			<div>
				<div class='desc'>Login:</div>
				<div class='camp'><input type='text' disabled value='<?php echo $acc[0]['login']; ?>' /></div>
			</div>
		</label>

		<label class='formpadrao'>
			<div>
				<div class='desc'>E-mail:</div>
				<div class='camp'><input type='text' disabled value='<?php echo $acc[0]['email']; ?>' /></div>
			</div>
		</label>

		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[12037]; ?>:</div>
				<div class='camp'><input type='password' name='oldpass' autocomplete='off' /></div>
			</div>
		</label>

		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[12047]; ?>:</div>
				<div class='camp'><input type='password' maxlength='25' name='newpass' autocomplete='off' /></div>
			</div>
		</label>

		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[12048]; ?>:</div>
				<div class='camp'><input type='password' maxlength='25' name='newpass2' autocomplete='off' /></div>
			</div>
		</label>

		<input style='margin: 20px auto; display: table;' type='submit' class='default dbig' value='<?php echo $LANG[12022]; ?>' />
		
	</form>

</div>
