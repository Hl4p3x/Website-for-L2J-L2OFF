<section class="content-header">
	<h1>
		Doações Pendentes
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-money"></i> Doações</li>
		<li class="active">Doações Pendentes</li>
	</ol>
</section>

<section class="content">

	<?php
	$buscar = !empty($_GET['buscar']) ? vCode($_GET['buscar']) : '';
	require('private/classes/classDonate.php');
	?>

	<div class="box">

		<!-- Busca -->
		<div class="box-header" style="padding-bottom:0;">
			<div class="box-tools">
				<form class='default' method='GET'>
					<div class="input-group" style="width: 250px;">
						
						<input type='hidden' name='page' value='list_pending'/>
						<input type='hidden' name='module' value='donate'/>
						
						<input type="text" name='buscar' value='<?php echo $buscar; ?>' class="form-control input-sm pull-right" placeholder="Pesquisar...">
						
						<div class="input-group-btn">
							<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>

		<!-- Listagem -->
		<div class="box-body">

			<table class="table table-bordered">
				<tr>
					<th>#</th>
					<th>Prot.</th>
					<th>Account</th>
					<!--<th>Personagem</th>-->
					<th>Coin's</th>
					<th>Valor</th>
					<th>Método</th>
					<th>Data</th>
					<th>Status</th>
					<th>Ultima Alteração</th>
					<th style='width: 140px'>Opções</th>
				</tr>

				<?php
				$pagin['max_results'] = 15;
				$pagin['link'] = "?page=list_pending&module=donate";
				$pagin['link'] .= (!empty($buscar) ? "&buscar=".$buscar : "");
				$pagin['atual'] = (!empty($_GET['pg']) && is_numeric($_GET['pg']) ? intval($_GET['pg']) : 1); $pagin['begin'] = ($pagin['atual']-1) * $pagin['max_results'];

				$consulta = Donate::countPending($buscar);

				$pagin['total_results'] = $consulta[0]['quant'];
				$consulta = Donate::listPending($pagin['begin'], $pagin['max_results'], $buscar);

				if(count($consulta) == 0) {
					echo'<tr><td colspan="10">Nenhuma doação encontrada!</td></tr>';
				} else {
					
					for($i=0, $c=count($consulta); $i < $c; $i++) {
						
						$mpxpl = explode('_', $consulta[$i]['metodo_pgto']);
						$metodo = $mpxpl[0];
						
						echo"
						<tr>
							<td>".((($pagin['atual']-1)*$pagin['max_results'])+($i+1))."</td>
							<td>".$consulta[$i]['protocolo']."</td>
							<td>".$consulta[$i]['account']."</td>
							<!--<td>".$consulta[$i]['char_name']."</td>-->
							<td>".(intval($consulta[$i]['quant_coins'])+intval($consulta[$i]['coins_bonus']))." ".(!empty($consulta[$i]['coins_bonus']) ? "<span style='font-size:12px;'>(".$consulta[$i]['coins_bonus']."&nbsp;bônus)</span>" : "")."</td>
							<td>".obtainCurrencySymbol($consulta[$i]['currency'])."&nbsp;".number_format(trim($consulta[$i]['valor']), 2, ',', '.')."</td>
							<td style='font-size:13px;'>".$metodo."</td>
							<td style='font-size:13px;'>".date('d/m/Y H:i', ($consulta[$i]['data']))."</td>
							<td>".obtainOrderStatusName($consulta[$i]['status'])."</td>
							<td style='font-size:13px;'>".(empty($consulta[$i]['ultima_alteracao']) ? 'Ainda não houve' : date('d/m/Y H:i', ($consulta[$i]['ultima_alteracao'])))."</td>
							<td class='opcs'>
								<a href='?page=deliver&module=donate&protocolo=".$consulta[$i]['protocolo']."' title='Excluir' class='btn btn-info'>Entregar</a>
								<a href='?page=delete&module=donate&protocolo=".$consulta[$i]['protocolo']."' title='Excluir' class='btn btn-danger'><i class='fa fa-remove'></i></a>
							</td>
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

