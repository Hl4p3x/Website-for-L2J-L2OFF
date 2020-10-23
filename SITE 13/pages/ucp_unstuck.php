<?php if(!$indexing || $dpage['unstuk'] != 1) { echo "<script>document.location.replace('./');</script>"; exit; }
if($logged != 1) { fim('', 'ERROR', './'); }
?>

<h1>Unstuck Char</h1>

<div class='pddInner'>
	
	<?php echo $LANG[12095]; ?>
	
	<br /><br />
	
	<ul>
		<li><?php echo $LANG[12096]; ?></li>
	</ul>
	
	<br />
	
	<form class='usarJquery'  method="POST" action="./?engine=ucp_unstuck_move">
		
		<div style='text-align:center;'><b><?php echo $LANG[12101]; ?>:</b></div><br />
		
		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[29007]; ?>:</div>
				<div class='camp'>
					<select name='cid'>
						<?php
						require('private/classes/classAccount.php');
						$chars = Account::listChars($_SESSION['acc']);
						if(count($chars) > 0) {
							for($i=0; $i < count($chars); $i++) {
								echo "<option value='".$chars[$i]['obj_Id']."'>".$chars[$i]['char_name']."</option>";
							}
						} else {
							echo "<option value='0'>".$LANG[12100]."</option>";
						}
						?>
					</select>
				</div>
			</div>
		</label>
	
		<input style='margin: 20px auto; display: table;' type='submit' class='default dbig' value='Unstuck' />
	
	</form>

</div>
