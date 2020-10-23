<section class="content-header">
	<h1>
		Shop Logs
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-file-text-o"></i> Logs</li>
		<li class="active">Shop</li>
	</ol>
</section>

<section class="content">

	<?php
	$buscar = !empty($_GET['buscar']) ? vCode($_GET['buscar']) : '';
	require('private/classes/classLogs.php');
	?>

	<div class="box">

		<!-- Busca -->
		<div class="box-header" style="padding-bottom:0;">
			<div class="box-tools">
				<form class='default' method='GET'>
					<div class="input-group" style="width: 250px;">
						
						<input type='hidden' name='page' value='shop'/>
						<input type='hidden' name='module' value='logs'/>
						
						<input type="text" name='buscar' value='<?php echo $buscar; ?>' class="form-control input-sm pull-right" placeholder="Pesquisar...">
						
						<div class="input-group-btn">
							<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>

		<!-- Resultados -->
		<div class="box-body">
			
			Abaixo são exibidos os itens adquiridos através do shop, quem adquiriu e seus detalhes.<br /><br />

			<table class="table table-bordered">
				<tr>
					<th style='width:32px;'></th>
					<th>Item</th>
					<th>ID</th>
					<th>Object ID</th>
					<th>Pack ID</th>
					<th>Account</th>
					<th>Personagem</th>
					<th>Valor</th>
					<th style='width: 140px'>Data</th>
				</tr>

				<?php
				$pagin['max_results'] = 50;
				$pagin['link'] = "?page=shop&module=logs";
				$pagin['link'] .= (!empty($buscar) ? "&buscar=".$buscar : "");
				$pagin['atual'] = (!empty($_GET['pg']) && is_numeric($_GET['pg']) ? intval($_GET['pg']) : 1); $pagin['begin'] = ($pagin['atual']-1) * $pagin['max_results'];

				$consulta = Logs::countShopLogs($buscar);

				$pagin['total_results'] = $consulta[0]['quant'];
				$consulta = Logs::listShopLogs($pagin['begin'], $pagin['max_results'], $buscar);

				if(count($consulta) == 0) {
					echo'<tr><td colspan="9">Nenhum log encontrado!</td></tr>';
				} else {
					for($i=0, $c=count($consulta); $i < $c; $i++) {
						
						echo"
						<tr>
							<td>".(file_exists($admref_ucp.'icons/itens/'.intval($consulta[$i]['log_item_id']).'.png') ? "<img width='32' height='32' src='".$admref_ucp."icons/itens/".intval($consulta[$i]['log_item_id']).".png' />" : "<img width='32' height='32' src='".$admref_ucp."imgs/icons.php?type=1&id=".intval($consulta[$i]['log_item_id'])."' />")."</td>
							<td>".$consulta[$i]['log_item_name'] . "&nbsp;" . (!empty($consulta[$i]['log_item_sa']) ? " <b>".$consulta[$i]['log_item_sa']."</b>&nbsp;" : "") . (!empty($consulta[$i]['log_enchant']) ? " <b>+".$consulta[$i]['log_enchant']."</b>&nbsp;" : "") . "(".$consulta[$i]['log_amount'].")</td>
							<td>".$consulta[$i]['log_item_id']."</td>
							<td>".$consulta[$i]['log_item_objs_id']."</td>
							<td><a href='?page=pack_change&module=shop&pack=".$consulta[$i]['log_pack_id']."'>".$consulta[$i]['log_pack_id']."</a></td>
							<td>".$consulta[$i]['log_account']."</td>
							<td>".$consulta[$i]['char_name']."</td>
							<td>".(($consulta[$i]['by_full_pack'] == '1') ? "<span style='color: #ff6600; border-bottom: 1px dotted #000;' title='Comprou todos os itens do pacote por este valor'>".$consulta[$i]['by_full_pack_price']."</span>" : $consulta[$i]['log_price'])."</td>
							<td>".date('d/m/Y \à\s H:i', strtotime($consulta[$i]['log_date']))."</td>
						</tr>
						";
					}
				}
				?>
			</table>

		</div>
		<?php require('private/paginate.php'); ?>

	</div>
	
</section>

