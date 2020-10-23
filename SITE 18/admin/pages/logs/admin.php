<section class="content-header">
	<h1>
		Admin Logs
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-file-text-o"></i> Logs</li>
		<li class="active">Admin</li>
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
						
						<input type='hidden' name='page' value='admin'/>
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
			
			<table class="table table-bordered">
				<tr>
					<th style='width: 140px'>Data</th>
					<th style='width: 120px'>IP</th>
					<th>Ação</th>
				</tr>

				<?php
				$pagin['max_results'] = 50;
				$pagin['link'] = "?page=admin&module=logs";
				$pagin['link'] .= (!empty($buscar) ? "&buscar=".$buscar : "");
				$pagin['atual'] = (!empty($_GET['pg']) && is_numeric($_GET['pg']) ? intval($_GET['pg']) : 1); $pagin['begin'] = ($pagin['atual']-1) * $pagin['max_results'];

				$consulta = Logs::countAdminLogs($buscar);

				$pagin['total_results'] = $consulta[0]['quant'];
				$consulta = Logs::listAdminLogs($pagin['begin'], $pagin['max_results'], $buscar);

				if(count($consulta) == 0) {
					echo'<tr><td colspan="3">Nenhum log encontrado!</td></tr>';
				} else {
					for($i=0, $c=count($consulta); $i < $c; $i++) {
						
						echo"
						<tr>
							<td>".date('d/m/Y \à\s H:i', strtotime($consulta[$i]['log_date']))."</td>
							<td>".$consulta[$i]['log_ip']."</td>
							<td>".$consulta[$i]['log_value']."</td>
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

