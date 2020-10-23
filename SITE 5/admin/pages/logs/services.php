<section class="content-header">
	<h1>
		Serviços Logs
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-file-text-o"></i> Logs</li>
		<li class="active">Serviços</li>
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
						
						<input type='hidden' name='page' value='services'/>
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
			
			Abaixo são exibidos os serviços utilizados, quem utilizou e seus detalhes.<br /><br />

			<table class="table table-bordered">
				<tr>
					<th>Account</th>
					<th>Personagem</th>
					<th>Ação</th>
					<th>Custo</th>
					<th style='width: 140px'>Data</th>
				</tr>

				<?php
				$pagin['max_results'] = 50;
				$pagin['link'] = "?page=services&module=logs";
				$pagin['link'] .= (!empty($buscar) ? "&buscar=".$buscar : "");
				$pagin['atual'] = (!empty($_GET['pg']) && is_numeric($_GET['pg']) ? intval($_GET['pg']) : 1); $pagin['begin'] = ($pagin['atual']-1) * $pagin['max_results'];

				$consulta = Logs::countServicesLogs($buscar);

				$pagin['total_results'] = $consulta[0]['quant'];
				$consulta = Logs::listServicesLogs($pagin['begin'], $pagin['max_results'], $buscar);

				if(count($consulta) == 0) {
					echo'<tr><td colspan="5">Nenhum log encontrado!</td></tr>';
				} else {
					for($i=0, $c=count($consulta); $i < $c; $i++) {
						
						echo"
						<tr>
							<td>".$consulta[$i]['log_account']."</td>
							<td>".$consulta[$i]['char_name']."</td>
							<td>".$consulta[$i]['log_value']."</td>
							<td>".$consulta[$i]['log_price']."</td>
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

