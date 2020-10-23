<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; }
if($logged != 1 || $chaemail != 1) { fim('', 'ERROR', './'); }
require('private/classes/classAccount.php');
$acc = Account::checkLoginExists($_SESSION['acc']);
?>

<h1><?php echo $LANG[11014]; ?></h1>

<div class='pddInner'>

	<?php echo $LANG[12985]; ?>

	<br /><br />

	<form class='usarJquery'  id='form' method='POST' action='./?engine=ucp_emailchange'>

		<label class='formpadrao'>
			<div>
				<div class='desc'>Login:</div>
				<div class='camp'><input type='text' disabled value='<?php echo $acc[0]['login']; ?>' /></div>
			</div>
		</label>

		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[12986]; ?>:</div>
				<div class='camp'><input type='text' disabled value='<?php echo $acc[0]['email']; ?>' /></div>
			</div>
		</label>

		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[12988]; ?>:</div>
				<div class='camp'><input type='text' name='newemail' /></div>
			</div>
		</label>

		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[12987]; ?>:</div>
				<div class='camp'><input type='text' name='newemail2' /></div>
			</div>
		</label>

		<input style='margin: 20px auto; display: table;' type='submit' class='default dbig' value='<?php echo $LANG[11014]; ?>' />
		
	</form>

</div>
