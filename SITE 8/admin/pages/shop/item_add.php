<!-- iCheck -->
<link rel="stylesheet" href="layout/plugins/iCheck/flat/blue.css">

<section class="content-header">
	<h1>
		Cadastrar Item
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-shopping-cart"></i> Shop</li>
		<li class="active">Cadastrar Item</li>
	</ol>
</section>

<section class="content">

	<div class="box box-primary">

		<form class='atualstudio usarJquery' method='POST' action='./?engine=item_add&module=shop' >

			<div class="box-body">

				<div class='form-group'>
					<label>
						<div class='desc'>ID in-game</div>
						<input type='text' id='itemID' name='id_ingame' maxlength='11' class='form-control' />
					</label>
				</div>

				<div class='form-group'>
					<label>
						<div class='desc'>Quantidade</div>
						<input type='text' name='amount' maxlength='10' class='form-control' value='1' />
					</label>
				</div>

				<div class='form-group'>
					<b>Item Cumulativo?</b>
					<div class='radchk'>
						<label>
							<input type='radio' name='cumulativo' value='0' class='flat-blue' checked>
							Não
						</label>
						&nbsp;&nbsp;
						<label>
							<input type='radio' name='cumulativo' value='1' class='flat-blue'>
							Sim
						</label>
					</div>
					<p class='help-block' style='font-size: 13px;'>Itens cumulativos são aqueles que se acumulam no inventário.<br />A Mana Potion, por exemplo, é cumulativo, já uma weapon como a Arcana Mace não se acumula, ela usa 1 slot para cada Arcana Mace no inventário.</p>
				</div>

				<div class='form-group'>
					<label>
						<div class='desc'>Pacote</div>
						<select class='form-control select2' name='spack_id'>
							<option value=''>Selecione</option>
							<?php
							$pack = !empty($_GET['pack']) ? intval($_GET['pack']) : 0;
							require('private/classes/classShop.php');
							$consulta = Shop::listPacks();
							for($i=0, $c=count($consulta); $i < $c; $i++) {
								echo '<option value="'.$consulta[$i]['spack_id'].'"'.($pack == $consulta[$i]['spack_id'] ? ' selected' : '').'>'.$consulta[$i]['nome'].'</option>';
							}
							?>
						</select>
					</label>
				</div>

				<div class='form-group'>
					<label>
						<div class='desc'>Nome</div>
						<input type='text' id='itemName' name='nome' maxlength='70' class='form-control' />
					</label>
				</div>

				<div class='form-group'>
					<label>
						<div class='desc'>Special Abilities (SA)</div>
						<input type='text' id='itemSA' name='sa' maxlength='40' class='form-control' placeholder='(Opcional)' />
					</label>
				</div>

				<div class='form-group'>
					<label>
						<div class='desc'>Enchant</div>
						<input type='text' name='enchant' maxlength='5' class='form-control' value='0' />
					</label>
				</div>

				<div class='form-group'>
					<label>
						<div class='desc'>Valor (<?php echo "em ".strtolower($coinName)."'s"; ?>)</div>
						<input type='text' name='valor' maxlength='11' class='form-control' />
					</label>
				</div>

				<div class='box-footer'>
					<input type='submit' class='btn btn-primary' value='Cadastrar Item' />
				</div>

			</div>

		</form>

	</div>

</section>


<!-- iCheck 1.0.1 -->
<script src="layout/plugins/iCheck/icheck.min.js"></script>

<script>
	$(function () {
		
		$('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
		});
		
		$('#itemID').change(function(){
			var itemID = $('#itemID').val();
			$('#itemName, #itemSA').val('Aguarde...');
			$.ajax({
				type: 'POST',
				url: './?engine=item_find_name&module=shop&itemid='+itemID,
				cache: false,
				data: 'isJS=1',
				dataType: 'json',
				timeout: 5000,
				async: false,
				success: function(data)
				{
					
					if(data.name != '') {
						$('#itemName').val(data.name);
					} else {
						$('#itemName').val('');
					}
					
					if(data.sa != '') {
						$('#itemSA').val(data.sa);
					} else {
						$('#itemSA').val('');
					}
					
				}
			});
			
		});
	});
</script>
