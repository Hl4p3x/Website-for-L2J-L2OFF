<?php if((!$indexing) || ($logged != 1)) { exit; }

if($funct['servic'] != 1) { fim($LANG[40003], 'ERROR', './'); }

require('private/classes/classServices.php');
?>

<ul class="breadcrumb">
	<li><a href="./?module=services&page=list"><i class='fa fa-suitcase'></i> <?php echo $LANG[10010]; ?></a></li>
	<li><?php echo $LANG[40001]; ?></li>
</ul>

<h1><?php echo $LANG[10010]; ?></h1>

<div class='pddInner' style='padding-bottom:10px;'>
	<?php echo $LANG[10066]; ?>
</div>

<div class='mult'>
	
	<div class='selec'>
		<?php
		
		$findChars = Services::findChars($_SESSION['acc']);
		if(count($findChars) > 0) {
			for($i=0, $c=count($findChars); $i < $c; $i++) {
				$heroEndAtual[$i] = ((!empty($findChars[$i]['hero_end'])) ? (($heroMultMil == 1) ? (trim($findChars[$i]['hero_end'])/1000) : trim($findChars[$i]['hero_end'])) : 0);
				if($heroEndAtual[$i] > time()) { $heroEndAtual[$i] = date('d F, Y H:i', $heroEndAtual[$i]); } else { $heroEndAtual[$i] = 0; }
				$vipEndAtual[$i] = ((!empty($findChars[$i]['vip_end'])) ? (($vipMultMil == 1) ? (trim($findChars[$i]['vip_end'])/1000) : trim($findChars[$i]['vip_end'])) : 0);
				if($vipEndAtual[$i] > time()) { $vipEndAtual[$i] = date('d F, Y H:i', $vipEndAtual[$i]); } else { $vipEndAtual[$i] = 0; }
				echo "
				<div".($i == 0 ? " class='actived'" : "")." data-id='".$findChars[$i]['charId']."' data-hero='".$heroEndAtual[$i]."' data-vip='".$vipEndAtual[$i]."'>
					<img src='imgs/avatar/".genAvatar($findChars[$i]['base_class'], $findChars[$i]['sex'])."' />
					<div>".$findChars[$i]['char_name']."</div>
				</div>
				";
			}
		}
		for($i=1; $i <= intval(7-count($findChars)); $i++) {
			echo "<span></span>";
		}
		
		?>
	</div>
	
	<div class='opts'>
		
		<div class='charSelectedTxt'><?php echo $LANG[39016]; ?>: <b><?php echo trim($findChars[0]['char_name']); ?></b></div>
		
		<?php 
		
		if($service['actv']['removekarma'] == 1) { ?>
		<form action='./?module=services&engine=removekarma' class='service usarJquery'>
			<input type='hidden' name='cid' class='charSelected' value='<?php echo intval($findChars[0]['charId']); ?>' />
			<div class='title'><?php echo $LANG[39014]; ?>: <b>Remove Karma</b> <div class='costs'><?php echo $LANG[39015]; ?>: <b><?php echo "".intval(trim($service['cost']['removekarma']))." ".$coinName."'s"; ?></b></div></div>
			<div class='desc'><?php echo $LANG[39023]; ?>.</div>
			<div class='work'>
				<?php echo $LANG[39024]; ?><br />
				<div class='confirmChar invis'><?php echo $LANG[39016]; ?>: <b></b> <a href='#' class='default'><?php echo $LANG[10121]; ?></a></div>
			</div>
			<input type='submit' class='default executeService' value='<?php echo $LANG[39017]; ?>' />
		</form>
		<?php
		}
		
		if($service['actv']['changename'] == 1) { ?>
		<form action='./?module=services&engine=changename' class='service usarJquery'>
			<input type='hidden' name='cid' class='charSelected' value='<?php echo intval($findChars[0]['charId']); ?>' />
			<div class='title'><?php echo $LANG[39014]; ?>: <b>Character Nickname</b> <div class='costs'><?php echo $LANG[39015]; ?>: <b><?php echo "".intval(trim($service['cost']['changename']))." ".$coinName."'s"; ?></b></div></div>
			<div class='desc'><?php echo $LANG[39027]; ?></div>
			<div class='work'>
				<?php echo $LANG[39028]; ?><br /><br />
				<label class='formpadrao'>
					<div>
						<div class='desc'>Nickname:</div>
						<div class='camp'><input type='text' name='nickname' autocomplete='off' maxlength='16' /></div>
					</div>
				</label>
				<label class='formpadrao'>
					<div>
						<div class='desc'><?php echo $LANG[39029]; ?>:</div>
						<div class='camp'><input type='text' name='nickname2' autocomplete='off' maxlength='16' /></div>
					</div>
				</label>
				<div class='confirmChar invis'><?php echo $LANG[39016]; ?>: <b></b> <a href='#' class='default'><?php echo $LANG[10121]; ?></a></div>
			</div>
			<input type='submit' class='default executeService' value='<?php echo $LANG[39017]; ?>' />
		</form>
		<?php
		}
		
		if($service['actv']['clanname'] == 1) { ?>
		<form action='./?module=services&engine=clanname' class='service usarJquery'>
			<input type='hidden' name='cid' class='charSelected' value='<?php echo intval($findChars[0]['charId']); ?>' />
			<div class='title'><?php echo $LANG[39014]; ?>: <b>Clan Name</b> <div class='costs'><?php echo $LANG[39015]; ?>: <b><?php echo "".intval(trim($service['cost']['clanname']))." ".$coinName."'s"; ?></b></div></div>
			<div class='desc'><?php echo $LANG[39030]; ?></div>
			<div class='work'>
				<?php echo $LANG[39028]; ?> <?php echo $LANG[39031]; ?><br /><br />
				<div style='text-align:center;font-weight:bold;'><?php echo $LANG[11999]; ?></div><br />
				<label class='formpadrao'>
					<div>
						<div class='desc'><?php echo $LANG[10095]; ?>:</div>
						<div class='camp'><input type='text' name='name' autocomplete='off' maxlength='16' /></div>
					</div>
				</label>
				<label class='formpadrao'>
					<div>
						<div class='desc'><?php echo $LANG[39032]; ?>:</div>
						<div class='camp'><input type='text' name='name2' autocomplete='off' maxlength='16' /></div>
					</div>
				</label>
				<div class='confirmChar invis'><?php echo $LANG[39016]; ?>: <b></b> <a href='#' class='default'><?php echo $LANG[10121]; ?></a></div>
			</div>
			<input type='submit' class='default executeService' value='<?php echo $LANG[39017]; ?>' />
		</form>
		<?php
		}
		
		if($service['actv']['unstuck'] == 1) { ?>
		<form action='./?module=services&engine=unstuck' class='service usarJquery'>
			<input type='hidden' name='cid' class='charSelected' value='<?php echo intval($findChars[0]['charId']); ?>' />
			<div class='title'><?php echo $LANG[39014]; ?>: <b>Unstuck</b> <div class='costs'><?php echo $LANG[39015]; ?>: <b><?php echo "".intval(trim($service['cost']['unstuck']))." ".$coinName."'s"; ?></b></div></div>
			<div class='desc'><?php echo $LANG[39061]; ?></div>
			<div class='work'>
				<?php echo $LANG[39062]; ?><br />
				<div class='confirmChar invis'><?php echo $LANG[39016]; ?>: <b></b> <a href='#' class='default'><?php echo $LANG[10121]; ?></a></div>
			</div>
			<input type='submit' class='default executeService' value='<?php echo $LANG[39017]; ?>' />
		</form>
		<?php
		}
		
		if($service['actv']['basechange'] == 1) { ?>
		<form action='./?module=services&engine=changebaseclass' class='service usarJquery'>
			<input type='hidden' name='cid' class='charSelected' value='<?php echo intval($findChars[0]['charId']); ?>' />
			<div class='title'><?php echo $LANG[39014]; ?>: <b>Change Base Class</b> <div class='costs'><?php echo $LANG[39015]; ?>: <b><?php echo "".intval(trim($service['cost']['basechange']))." ".$coinName."'s"; ?></b></div></div>
			<div class='desc'><?php echo $LANG[39068]; ?></div>
			<div class='work'>
				<?php echo $LANG[39069]; ?><br /><br />
				<?php $class = array(88 => 'Duelist', 89 => 'Dreadnought', 90 => 'Phoenix Knight', 91 => 'Hell Knight', 92 => 'Sagittarius', 93 => 'Adventurer', 94 => 'Archmage', 95 => 'Soultaker', 96 => 'Arcana Lord', 97 => 'Cardinal', 98 => 'Hierophant', 99 => 'Eva Templar', 100 => 'Sword Muse', 101 => 'Wind Rider', 102 => 'Moonlight Sentinel', 103 => 'Mystic Muse', 104 => 'Elemental Master', 105 => 'Eva Saint', 106 => 'Shillien Templar', 107 => 'Spectral Dancer', 108 => 'Ghost Hunter', 109 => 'Ghost Sentinel', 110 => 'Storm Screamer', 111 => 'Spectral Master', 112 => 'Shillien Saint', 113 => 'Titan', 114 => 'Grand Khauatari', 115 => 'Dominator', 116 => 'Doomcryer', 117 => 'Fortune Seeker', 118 => 'Maestro', 131 => 'Doombringer', 132 => 'Male Soulhound', 133 => 'Female Soulhound', 134 => 'Trickster'); asort($class); ?>
				<label class='formpadrao'>
					<div>
						<div class='desc'>Class:</div>
						<div class='camp'>
							<select name='sclass'>
								<option value='0'><?php echo $LANG[12008]; ?></option>
								<?php foreach($class as $key => $value) {
									echo "<option value='".$key."'>".$value."</option>";
								} ?>
							</select>
						</div>
					</div>
				</label>

				<div class='confirmChar invis'><?php echo $LANG[39016]; ?>: <b></b> <a href='#' class='default'><?php echo $LANG[10121]; ?></a></div>
			</div>
			<input type='submit' class='default executeService' value='<?php echo $LANG[39017]; ?>' />
		</form>
		<?php
		}
		
		?>
		
	</div>
	
</div>

<input type='hidden' id='l39055' value='<?php echo $LANG[39055]; ?>' />
<input type='hidden' id='l39056' value='<?php echo $LANG[39056]; ?>' />
<input type='hidden' id='l39057' value='<?php echo $LANG[39057]; ?>' />

<script>
$(document).ready(function(){
	
	$('.executeService').click(function(){
		
		$('.confirmChar b').text($('.charSelectedTxt b').text());
		
		$('.confirmChar').addClass('invis');
		
		$('.executeService').removeClass('actived');
		$(this).addClass('actived');
		
		if($(this).val() == '<?php echo $LANG[39017]; ?>') {
			
			$('.executeService').val('<?php echo $LANG[39017]; ?>');
			$(this).val('<?php echo $LANG[39018]; ?>').removeClass('sucesso');
			
			$(this).parent().children('.work').children('.confirmChar').removeClass('invis');
			$(this).parent('form').removeClass('sucedido');
			
			return false;
			
		} else {
			
			$('.executeService').val('<?php echo $LANG[39017]; ?>');
			
		}
		
	});
	
	$('.confirmChar a').click(function(e){
		
		e.preventDefault();
		$('.confirmChar b').text($('.charSelectedTxt b').text());
		$('.confirmChar').addClass('invis');
		$('.executeService').removeClass('actived').val('<?php echo $LANG[39017]; ?>');
		
	});
	
});
</script>

<br />