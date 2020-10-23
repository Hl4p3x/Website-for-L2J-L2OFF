<?php if((!$indexing) || ($logged != 1)) { exit; }
if($funct['trnsf1'] != 1 && $funct['trnsf2'] != 1) { fim($LANG[40003], 'ERROR', './'); }
require('private/classes/classDonate.php');
?>

<ul class="breadcrumb">
	<li><a href='./?module=donate&page=add'><i class='fa fa-money'></i> <?php echo $LANG[12039]; ?></a></li>
	<li><?php echo $LANG[10013]; ?> <?php echo $coinName_mini; ?>'s</li>
</ul>

<h1><?php echo $LANG[10013]; ?> <?php echo $coinName_mini; ?>'s</h1>

<div class='pddInner'>
	
	<?php echo $LANG[10163]; ?><br />
	<ul>
		<li><b><?php echo $LANG[10168]; ?>:</b> <?php echo $LANG[10165]; ?></li>
		<li><b><?php echo $LANG[10167]; ?>:</b> <?php echo $LANG[10166]; ?></li>
	</ul>
	
	<br />
	
	<?php if($funct['trnsf1'] == 1) { ?>
	
	<h2><?php echo $LANG[10013]; ?> - <?php echo $LANG[40004]; ?></h2>
	
	<?php echo $LANG[40005]; ?><br /><br />
	
	<form id='form' method='POST' action='./?module=donate&engine=convert_balance' class='usarJquery'>
		
		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[10168]; ?>:</div>
				<div class='camp'><input type='text' name='count' autocomplete='off' id='countTransfer' /></div>
			</div>
		</label>
		
		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[10167]; ?>:</div>
				<div class='camp'>
					<select name='dest'>
						<?php
						$listChars = Donate::listChars($_SESSION['acc']);
						if(count($listChars) > 0) {
							echo "<option value='0' selected>".$LANG[12008]."</option>";
							for($i=0, $c=count($listChars); $i < $c; $i++) {
								echo "<option value='".$listChars[$i]['obj_Id']."'>".$listChars[$i]['char_name']."</option>";
							}
						} else { echo "<option value='0'>".$LANG[12100]."</option>"; }
						?>
					</select>
				</div>
			</div>
		</label>
		
		<br />
		
		<label class='formpadrao captcha'>
			<div>
				<div class='desc'><img style='margin:5px 0 0 0;' class='captchaImage' src='captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>' /></div>
				<div class='camp'><input type='text' id='captchaInput' maxlength='5' name='captcha' autocomplete='off' /></div>
				<a tabindex='-1' href='#'><img src='captcha/refresh.png' /></a>
			</div>
		</label>
		
		<input type='submit' class='default big' value='<?php echo $LANG[10170]; ?>' style='margin: 20px auto 0; display:table;' />
		
	</form>
	
	<br /><br />
	
	<?php }
	
	if($funct['trnsf2'] == 1) { ?>
	
	<h2><?php echo $LANG[10013]; ?> - <?php echo $LANG[40006]; ?></h2>
	
	<?php echo $LANG[40007]; ?><br /><br />
	
	<form id='form' method='POST' action='./?module=donate&engine=transfer_balance' class='usarJquery'>
		
		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[10168]; ?>:</div>
				<div class='camp'><input type='text' name='count' autocomplete='off' id='countTransfer' /></div>
			</div>
		</label>
		
		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[10167]; ?>:</div>
				<div class='camp'><input type='text' name='dest' autocomplete='off' /></div>
			</div>
		</label>
		
		<br />
		<div style='text-align:center;padding: 0 0 10px;font-weight:bold;'><?php echo $LANG[10169]; ?></div>
		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[10168]; ?>:</div>
				<div class='camp'><input type='text' name='count2' autocomplete='off' /></div>
			</div>
		</label>
		
		<label class='formpadrao'>
			<div>
				<div class='desc'><?php echo $LANG[10167]; ?>:</div>
				<div class='camp'><input type='text' name='dest2' autocomplete='off' /></div>
			</div>
		</label>
		
		<br />
		
		<label class='formpadrao captcha'>
			<div>
				<div class='desc'><img style='margin:5px 0 0 0;' class='captchaImage' src='captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>' /></div>
				<div class='camp'><input type='text' id='captchaInput' maxlength='5' name='captcha' autocomplete='off' /></div>
				<a tabindex='-1' href='#'><img src='captcha/refresh.png' /></a>
			</div>
		</label>
		
		<input type='submit' class='default big' value='<?php echo $LANG[10170]; ?>' style='margin: 20px auto 0; display:table;' />
		
	</form>
	
	<?php } ?>
	
</div>

