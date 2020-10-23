<?php if((!$indexing) || ($logged != 1)) { exit; }
if($funct['donate'] != 1) { fim($LANG[40003], 'ERROR', './'); }
require('private/classes/classDonate.php');
?>

<ul class="breadcrumb">
	<li><a href='./?module=donate&page=add'><i class='fa fa-money'></i> <?php echo $LANG[12039]; ?></a></li>
	<li><?php echo $LANG[39010]; ?> <?php echo $coinName_mini; ?>'s</li>
</ul>

<h1><?php echo $LANG[39010]; ?> <?php echo $coinName_mini; ?>'s</h1>

<div class='pddInner'>
		
	<?php echo $LANG[10053].($bonusActived == 1 ? $LANG[40000] : ''); ?><br /><br />
	
	<div class='rulesbox' style='width:auto !important;'>
		<h1><?php echo $LANG[14000]; ?></h1>
		<?php echo $LANG[14001]; ?>
	</div>
	
	<label><input type='checkbox' id='acceptrules' value='1' /> <b><?php echo $LANG[10054]; ?></b></label>
	<br /><br /><br />
	
	<?php echo $LANG[10055]; ?><br />
	<br />
	
	<form method='POST' action='./?module=donate&engine=create_order' class='usarJquery'>
		
		<table class='donateBox' border='0' cellpadding='0' cellspacing='0'>
			
			<tr>
				<!--<th><i class='fa fa-user'></i> <?php echo $LANG[10056]; ?></th>-->
				<th><i class='fa fa-credit-card-alt'></i> <?php echo $LANG[10059]; ?></th>
				<th><i class='fa fa-cubes'></i> <?php echo $LANG[10057]; ?></th>
				<th><i class='fa fa-dollar'></i> <?php echo $LANG[10058]; ?></th>
			</tr>
			
			<tr>
				<?php /*
				<td>
					<select style='min-width: 160px;' name='personagem'>
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
				</td>
				*/ ?>
				<td>
					<select style='min-width: 160px;' name='metodo_pgto' id='metodo_pgto'>
						<?php
						if(!empty($G2APay['actived'])) { echo "<option data-symbol='".obtainCurrencySymbol($G2APay['currency'])."' value='G2APay'>G2APay</option>"; }
						if(!empty($PagSeguro['actived'])) { echo "<option data-symbol='R$' value='PagSeguro'>PagSeguro</option>"; }
						if(!empty($PayPal['actived'])) { echo "<option data-symbol='$' value='PayPal_USD'>PayPal (USD)</option><option data-symbol='R$' value='PayPal_BRL'>PayPal (BRL)</option><option data-symbol='€' value='PayPal_EUR'>PayPal (EUR)</option>"; }
						if(!empty($MercadoPago['actived'])) { echo "<option data-symbol='R$' value='MercadoPago'>MercadoPago</option>"; }
						if(!empty($PayGol['USD']['actived'])) { echo "<option data-symbol='$' value='PayGol_USD'>PayGol (USD)</option>"; }
						if(!empty($PayGol['BRL']['actived'])) { echo "<option data-symbol='R$' value='PayGol_BRL'>PayGol (BRL)</option>"; }
						if(!empty($PayGol['EUR']['actived'])) { echo "<option data-symbol='€' value='PayGol_EUR'>PayGol (EUR)</option>"; }
						if(!empty($WebMoney['actived'])) { echo "<option data-symbol='".obtainCurrencySymbol($WebMoney['currency'])."' value='WebMoney'>WebMoney</option>"; }
						if(!empty($Payza['actived'])) { echo "<option data-symbol='".obtainCurrencySymbol($Payza['currency'])."' value='Payza'>Payza</option>"; }
						if(!empty($Skrill['actived'])) { echo "<option data-symbol='".obtainCurrencySymbol($Skrill['currency'])."' value='Skrill'>Skrill</option>"; }
						if(!empty($Banking['actived'])) { echo "<option data-symbol='".obtainCurrencySymbol($Banking['currency'])."' value='Banking'>".$LANG[15003]."</option>"; }
						?>
					</select>
				</td>
				
				<td>
					<select style='min-width: 160px;' name='qtdCoins' id='qtdCoins'>
						<option value='0' selected><?php echo $LANG[12008]; ?></option>
						<?php
						for($i=10, $c=500; $i <= $c; $i++) { if($i%10==0) { echo "<option value='".$i."'>".$i." ".$coinName."'s</option>"; } }
						for($i=550, $c=1000; $i <= $c; $i++) { if($i%50==0) { echo "<option value='".$i."'>".$i." ".$coinName."'s</option>"; } }
						for($i=1500, $c=5000; $i <= $c; $i++) { if($i%500==0) { echo "<option value='".$i."'>".$i." ".$coinName."'s</option>"; } }
						?>
					</select>
					<div class='bonus'>+<span id='bonus'></span> (<?php echo $LANG[10060]; ?>)</div>
				</td>
				
				<td style='text-align:center;'>
					<span style='color:#237200'><b><span id='valor_symbol'>$</span> <span id='valor_total'>0,00</span></b></span>
				</td>
				
			</tr>
			
		</table>
		
		<input type='submit' class='default big' value='<?php echo $LANG[10061]; ?>' style='margin: 20px auto 0; display:table;' />
		
	</form>
	
</div>

<script type='text/javascript'>
$(document).ready(function(){
	
	$('select option:selected').removeAttr('selected');
	
	var dsymbol = $('select#metodo_pgto option:selected').attr('data-symbol');
	$('#valor_symbol').text(dsymbol);
	
	$('select#metodo_pgto').change(function(){
		
		var dsymbol = $('select#metodo_pgto option:selected').attr('data-symbol');
		$('#valor_symbol').text(dsymbol);
		
		if($('select#metodo_pgto').val() == 'PagSeguro') {
			var preco = "<?php echo (!empty($PagSeguro['coin_price']) ? $PagSeguro['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'Banking') {
			var preco = "<?php echo (!empty($Banking['coin_price']) ? $Banking['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayPal_USD') {
			var preco = "<?php echo (!empty($PayPal['USD']['coin_price']) ? $PayPal['USD']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayPal_BRL') {
			var preco = "<?php echo (!empty($PayPal['BRL']['coin_price']) ? $PayPal['BRL']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayPal_EUR') {
			var preco = "<?php echo (!empty($PayPal['EUR']['coin_price']) ? $PayPal['EUR']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'MercadoPago') {
			var preco = "<?php echo (!empty($MercadoPago['coin_price']) ? $MercadoPago['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayGol_USD') {
			var preco = "<?php echo (!empty($PayGol['USD']['coin_price']) ? $PayGol['USD']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayGol_BRL') {
			var preco = "<?php echo (!empty($PayGol['BRL']['coin_price']) ? $PayGol['BRL']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayGol_EUR') {
			var preco = "<?php echo (!empty($PayGol['EUR']['coin_price']) ? $PayGol['EUR']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'WebMoney') {
			var preco = "<?php echo (!empty($WebMoney['coin_price']) ? $WebMoney['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'Payza') {
			var preco = "<?php echo (!empty($Payza['coin_price']) ? $Payza['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'Skrill') {
			var preco = "<?php echo (!empty($Skrill['coin_price']) ? $Skrill['coin_price'] : 0); ?>";
		} else {
			var preco = "<?php echo (!empty($G2APay['coin_price']) ? $G2APay['coin_price'] : 0); ?>";
		}
		
		var valor = parseInt($('select#qtdCoins').val());
		
		<?php if($bonusActived == 1) { ?>
		
		var count1 = parseInt("<?php echo (isset($buyCoins['bonus_count'][1]) ? intval($buyCoins['bonus_count'][1]) : 0); ?>");
		var bonus1 = parseInt("<?php echo (isset($buyCoins['bonus_percent'][1]) ? intval($buyCoins['bonus_percent'][1]) : 0); ?>");
		var count2 = parseInt("<?php echo (isset($buyCoins['bonus_count'][2]) ? intval($buyCoins['bonus_count'][2]) : 0); ?>");
		var bonus2 = parseInt("<?php echo (isset($buyCoins['bonus_percent'][2]) ? intval($buyCoins['bonus_percent'][2]) : 0); ?>");
		var count3 = parseInt("<?php echo (isset($buyCoins['bonus_count'][3]) ? intval($buyCoins['bonus_count'][3]) : 0); ?>");
		var bonus3 = parseInt("<?php echo (isset($buyCoins['bonus_percent'][3]) ? intval($buyCoins['bonus_percent'][3]) : 0); ?>");
		
		if(valor >= count3) { var bonus = bonus3; }
		else if(valor >= count2) { var bonus = bonus2; }
		else if(valor >= count1) { var bonus = bonus1; }
		else { var bonus = '0'; }
		if(bonus > 0) {
			var calculado = parseInt((valor*bonus)/100);
			$('#bonus').text(calculado);
			$('.bonus').show();
		} else {
			$('#bonus').text('');
			$('.bonus').hide();
		}
		
		<?php } ?>
		
		var price = ((valor * preco).toFixed(2)).replace(".", ",");
		$('#valor_total').text(''+price+'');
		
	});
	
	$('select#qtdCoins').change(function(){
		
		if($('select#metodo_pgto').val() == 'PagSeguro') {
			var preco = "<?php echo (!empty($PagSeguro['coin_price']) ? $PagSeguro['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'Banking') {
			var preco = "<?php echo (!empty($Banking['coin_price']) ? $Banking['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayPal_USD') {
			var preco = "<?php echo (!empty($PayPal['USD']['coin_price']) ? $PayPal['USD']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayPal_BRL') {
			var preco = "<?php echo (!empty($PayPal['BRL']['coin_price']) ? $PayPal['BRL']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayPal_EUR') {
			var preco = "<?php echo (!empty($PayPal['EUR']['coin_price']) ? $PayPal['EUR']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'MercadoPago') {
			var preco = "<?php echo (!empty($MercadoPago['coin_price']) ? $MercadoPago['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayGol_USD') {
			var preco = "<?php echo (!empty($PayGol['USD']['coin_price']) ? $PayGol['USD']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayGol_BRL') {
			var preco = "<?php echo (!empty($PayGol['BRL']['coin_price']) ? $PayGol['BRL']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'PayGol_EUR') {
			var preco = "<?php echo (!empty($PayGol['EUR']['coin_price']) ? $PayGol['EUR']['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'WebMoney') {
			var preco = "<?php echo (!empty($WebMoney['coin_price']) ? $WebMoney['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'Payza') {
			var preco = "<?php echo (!empty($Payza['coin_price']) ? $Payza['coin_price'] : 0); ?>";
		} else if($('select#metodo_pgto').val() == 'Skrill') {
			var preco = "<?php echo (!empty($Skrill['coin_price']) ? $Skrill['coin_price'] : 0); ?>";
		} else {
			var preco = "<?php echo (!empty($G2APay['coin_price']) ? $G2APay['coin_price'] : 0); ?>";
		}
		
		var valor = parseInt($(this).val());
		
		<?php if($bonusActived == 1) { ?>
		
		var count1 = parseInt("<?php echo (isset($buyCoins['bonus_count'][1]) ? intval($buyCoins['bonus_count'][1]) : 0); ?>");
		var bonus1 = parseInt("<?php echo (isset($buyCoins['bonus_percent'][1]) ? intval($buyCoins['bonus_percent'][1]) : 0); ?>");
		var count2 = parseInt("<?php echo (isset($buyCoins['bonus_count'][2]) ? intval($buyCoins['bonus_count'][2]) : 0); ?>");
		var bonus2 = parseInt("<?php echo (isset($buyCoins['bonus_percent'][2]) ? intval($buyCoins['bonus_percent'][2]) : 0); ?>");
		var count3 = parseInt("<?php echo (isset($buyCoins['bonus_count'][3]) ? intval($buyCoins['bonus_count'][3]) : 0); ?>");
		var bonus3 = parseInt("<?php echo (isset($buyCoins['bonus_percent'][3]) ? intval($buyCoins['bonus_percent'][3]) : 0); ?>");
		
		if(valor >= count3) { var bonus = bonus3; }
		else if(valor >= count2) { var bonus = bonus2; }
		else if(valor >= count1) { var bonus = bonus1; }
		else { var bonus = '0'; }
		if(bonus > 0) {
			var calculado = parseInt((valor*bonus)/100);
			$('#bonus').text(calculado);
			$('.bonus').show();
		} else {
			$('#bonus').text('');
			$('.bonus').hide();
		}
		
		<?php } ?>
		
		var price = ((valor * preco).toFixed(2)).replace(".", ",");
		$('#valor_total').text(''+price+'');
		
	});
	
});
</script>
