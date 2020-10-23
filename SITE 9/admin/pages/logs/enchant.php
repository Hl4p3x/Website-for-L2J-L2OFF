<section class="content-header">
	<h1>
		Enchant Logs
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-file-text-o"></i> Logs</li>
		<li class="active">Enchant</li>
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
						
						<input type='hidden' name='page' value='enchant'/>
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
			
			Abaixo são exibidos os itens que foram encantados pelo sistema de enchant e seus detalhes.<br /><br />

			<table class="table table-bordered">
				<tr>
					<th style='width:32px;'></th>
					<th>Item</th>
					<th>ID</th>
					<th>Object ID</th>
					<th>Player</th>
					<th>Enchant antigo</th>
					<th>Novo enchant</th>
					<th>Valor</th>
					<th style='width: 140px'>Data</th>
				</tr>

				<?php
				$pagin['max_results'] = 50;
				$pagin['link'] = "?page=enchant&module=logs";
				$pagin['link'] .= (!empty($buscar) ? "&buscar=".$buscar : "");
				$pagin['atual'] = (!empty($_GET['pg']) && is_numeric($_GET['pg']) ? intval($_GET['pg']) : 1); $pagin['begin'] = ($pagin['atual']-1) * $pagin['max_results'];

				$consulta = Logs::countEnchantLogs($buscar);

				$pagin['total_results'] = $consulta[0]['quant'];
				$consulta = Logs::listEnchantLogs($pagin['begin'], $pagin['max_results'], $buscar);

				if(count($consulta) == 0) {
					echo'<tr><td colspan="9">Nenhum log encontrado!</td></tr>';
				} else {
					
					require($admref_ucp.'private/includes/itemlist.php');
					
					for($i=0, $c=count($consulta); $i < $c; $i++) {
						
						$itemID = $consulta[$i]['iid'];
						
						echo"
						<tr>
							<td>".(file_exists($admref_ucp.'icons/itens/'.intval($consulta[$i]['iid']).'.png') ? "<img width='32' height='32' src='".$admref_ucp."icons/itens/".intval($consulta[$i]['iid']).".png' />" : "<img width='32' height='32' src='".$admref_ucp."imgs/icons.php?type=1&id=".intval($consulta[$i]['iid'])."' />")."</td>
							<td>".$item[$itemID][0] . "&nbsp;" . (!empty($item[$itemID][1]) ? " <b>".$item[$itemID][1]."</b>" : "") . "</td>
							<td>".$consulta[$i]['iid']."</td>
							<td>".$consulta[$i]['oid']."</td>
							<td>".$consulta[$i]['char_name']."</td>
							<td>". ($consulta[$i]['ench_old'] > 0 ? '+' : '') . $consulta[$i]['ench_old']."</td>
							<td>". ($consulta[$i]['ench_new'] > 0 ? '+' : '') . $consulta[$i]['ench_new']."</td>
							<td>".$consulta[$i]['price'] . ' ' . $coinName_mini ."'s</td>
							<td>".date('d/m/Y \à\s H:i', $consulta[$i]['edate'])."</td>
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

