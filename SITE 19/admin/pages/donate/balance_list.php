<section class="content-header">
	<h1>
		Saldos
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-money"></i> Doações</li>
		<li class="active">Saldos</li>
	</ol>
</section>

<?php

$buscar = !empty($_GET['buscar']) ? vCode($_GET['buscar']) : '';

require('private/classes/classDonate.php');

?>

<section class="content">
	
	<div class='box-footer'>
		<a href='?page=balance_add&module=donate' class='btn btn-primary'>Adicionar Saldo</a>
	</div>
	
	<div class="box">
		
		<!-- busca -->
		<div class="box-header" style="padding-bottom:0;">
			<div class="box-tools">

				<form class='default' method='GET'>
					<div class="input-group" style="width: 250px;">

						<input type='hidden' name='page' value='balance_list'/>
						<input type='hidden' name='module' value='donate'/>

						<input type="text" name='buscar' value='<?php echo $buscar; ?>' class="form-control input-sm pull-right" placeholder="Pesquisar...">

						<div class="input-group-btn">
							<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						</div>
						
					</div>
				</form>
			</div>
		</div>

		<!-- listagem -->
		<div class="box-body">


			<table class="table table-bordered">

				<tr>
					<th>Account</th>
					<th>Saldo</th>
					<th style='width:50px;'>Opções</th>
				</tr>

				<?php
				$pagin['max_results'] = 50;
				$pagin['link'] = "?page=balance_list&module=donate";
				$pagin['link'] .= (!empty($buscar) ? "&buscar=".$buscar : "");
				$pagin['atual'] = (!empty($_GET['pg']) && is_numeric($_GET['pg']) ? intval($_GET['pg']) : 1); $pagin['begin'] = ($pagin['atual']-1) * $pagin['max_results'];

				$consulta = Donate::contBalances($buscar);

				$pagin['total_results'] = $consulta[0]['quant'];
				$consulta = Donate::listBalances($pagin['begin'], $pagin['max_results'], $buscar);

				if(count($consulta) == 0) {
					echo'<tr><td colspan="2">Nenhuma informação sobre saldo encontrado.</td></tr>';
				} else {
					for($i =0, $c=count($consulta);$i < $c; $i++) {
						echo"
						<tr>
							<td><a href='?page=balance_change&module=donate&account=".$consulta[$i]['account']."'>".$consulta[$i]['account']."</a></td>
							<td>".intval(trim($consulta[$i]['saldo']))."</span> ".$coinName."'s</td>
							<td><a href='?page=balance_change&module=donate&account=".$consulta[$i]['account']."' class='btn btn-default'>Alterar</a></td>
						</tr>
						";
					}
				}
				?>
			</table>

		</div>
		
		<?php
		require('private/paginate.php');
		?>

	</div>

	<div class='box-footer'>
		<a href='?page=balance_add&module=donate' class='btn btn-primary'>Adicionar Saldo</a>
	</div>
	
</section>
