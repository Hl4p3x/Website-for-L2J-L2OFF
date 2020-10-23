<section class="content-header">
	<h1>
		Relatório de doações
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-money"></i> Doações</li>
		<li class="active">Relatório de doações</li>
	</ol>
</section>

<section class="content">

	<?php
	$buscar = !empty($_GET['buscar']) ? vCode($_GET['buscar']) : '';
	require('private/classes/classDonate.php');
	?>

	<div class="box">


		<!-- Resultados -->
		<div class="box-body">

			<?php
			
			$valTotal = Donate::searchValTotal();
			if(count($valTotal) > 0) {
				for($i=0, $c=count($valTotal); $i < $c; $i++) {
					$curr = trim($valTotal[$i]['currency']);
					$valores[$curr] = trim($valTotal[$i]['val']);
				}
			}
			
			$reais = $valores['BRL']; $dolares = $valores['USD']; $euros = $valores['EUR']; 
			
			$concluidas = Donate::findConcluidas();

			$pagin['max_results'] = 50;
			$pagin['link'] = "?page=list_relat&module=donate";
			$pagin['link'] .= (!empty($buscar) ? "&buscar=".$buscar : "");
			$pagin['atual'] = (!empty($_GET['pg']) && is_numeric($_GET['pg']) ? intval($_GET['pg']) : 1); $pagin['begin'] = ($pagin['atual']-1) * $pagin['max_results'];

			$consulta = Donate::countDonations();

			$pagin['total_results'] = $consulta[0]['quant'];
			$consulta = Donate::listDonations($pagin['begin'], $pagin['max_results'], $buscar);

			echo "Foram geradas um total de <b>".intval($pagin['total_results'])." faturas (".intval($concluidas[0]['quant'])." concluídas)</b>, movimentando um total de <b>R$ ".number_format($reais, 2, ',', '.')."</b>, <b>$ ".number_format($dolares, 2, ',', '.')."</b> e <b>€ ".number_format($euros, 2, ',', '.')."</b>.<br /><br />";
			?>

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
				</tr>

				<?php
				if(count($consulta) == 0) {
					echo'<tr><td colspan="9">Nenhuma doação encontrada!</td></tr>';
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

