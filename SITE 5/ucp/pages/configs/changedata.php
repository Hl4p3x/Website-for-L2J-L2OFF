<?php if((!$indexing) || ($logged != 1)) { exit; }

if($funct['config'] != 1) { fim($LANG[40003], 'ERROR', './'); }

require('private/classes/classConfigs.php');

$accData = Configs::accData($_SESSION['acc']);
if(count($accData) == 0) {
	require("private/classes/classAccess.php");
	Access::logout();
}

?>

<ul class="breadcrumb">
	<li><a href="./?module=configs&page=changedata"><i class='fa fa-cog'></i> <?php echo $LANG[39012]; ?></a></li>
</ul>

<h1><?php echo $LANG[39012]; ?></h1>

<div class='pddInner'>
	
	<?php echo $LANG[12090]; ?>
	
	<br /><br />
	
	<form method='POST' action='./?module=configs&engine=changedata' class='usarJquery'>
		
		<label class='formpadrao'>
			<div>
				<div class='desc'>Login:</div>
				<div class='camp'><input type='text' disabled value='<?php echo $accData[0]['login']; ?>' /></div>
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
				<div class='camp'><input type='password' maxlength='16' name='newpass' autocomplete='off' /></div>
			</div>
		</label>
		
		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[12048]; ?>:</div>
				<div class='camp'><input type='password' maxlength='16' name='newpass2' autocomplete='off' /></div>
			</div>
		</label>
		
		<input type='submit' class='default big' value='<?php echo $LANG[10003]; ?>' style='margin: 20px auto 0; display:table;' />
		
	</form>
	
</div>


<h1><?php echo $LANG[11014]; ?></h1>

<div class='pddInner'>

	<?php echo $LANG[12985]; ?>

	<br /><br />

	<form method='POST' action='./?module=configs&engine=emailchange' class='usarJquery'>

		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[12986]; ?>:</div>
				<div class='camp'><input type='text' disabled value='<?php echo $accData[0]['email']; ?>' /></div>
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

		<input type='submit' class='default big' value='<?php echo $LANG[11014]; ?>' style='margin: 20px auto 0; display:table;' />
		
	</form>

</div>

<br /><br />