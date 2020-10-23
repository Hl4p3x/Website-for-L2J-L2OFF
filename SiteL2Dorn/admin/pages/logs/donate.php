<section class="content-header">
	<h1>
		Doações Logs
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-file-text-o"></i> Logs</li>
		<li class="active">Doações</li>
	</ol>
</section>

<section class="content">

	<?php
	$buscar = !empty($_GET['buscar']) ? vCode($_GET['buscar']) : '';
	require('private/classes/classLogs.php');
	?>

	<div class="box">
		
		<div class="box-body">
			Visualize as doações efetuadas e seus detalhes na página de <a href='?page=list_relat&module=donate'>Relatório de doações</a>.
		</div>
		
	</div>
	
	<section class="content-header">
		<h1>
			Módulos automáticos
		</h1>
	</section>
	<br />

	<div class="box">
		
		<div class="box-body">
			Quando os intermediários de doações, como PagSeguro, PayPal, etc, enviam notificações para nós, recebemos e salvamos logs de todas as transações.<br />
			Abaixo são listados os arquivos de log existentes. Eles são armazenados separados por mês. Se o arquivo do mês que procura não existir, não recebemos transações naquele mês.<br /><br />
			<?php
			$pasta = $admref_ucp.'ipn/logs/';
			$arquivosLog = '';
			if(is_dir($pasta)) {
				$diretorio = dir($pasta);
				while(($arquivo = $diretorio->read()) !== false) {
					$xplEXT = explode('.', $arquivo);
					$ext = strtolower($xplEXT[(count($xplEXT)-1)]);
					if($ext == 'txt') {
						$xplClean = explode('__', $arquivo);
						$arquivosLog .= "<li><a target='_blank' href='".$pasta.$arquivo."'>".($xplClean[0])."</a></li>";
					}
				}
				$diretorio->close();
			}
			if(empty($arquivosLog)) {
				echo '<b>Não há arquivos de log por enquanto.</b>';
			} else {
				echo '<ul>'.$arquivosLog.'</ul>';
			}
			?>
		</div>
		
	</div>
	
	<section class="content-header">
		<h1>
			Transferências de <?php echo $coinName.'\'s'; ?> - Para outra conta
		</h1>
	</section>
	<br />

	<div class="box">
		
		<!-- Busca -->
		<div class="box-header" style="padding-bottom:0;">
			<div class="box-tools">
				<form class='default' method='GET'>
					<div class="input-group" style="width: 250px;">
						
						<input type='hidden' name='page' value='donate'/>
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
					<th>Quantidade</th>
					<th>Remetente</th>
					<th>Destinatário</th>
					<th style='width: 140px'>Data</th>
				</tr>

				<?php
				$pagin['max_results'] = 50;
				$pagin['link'] = "?page=donate&module=logs";
				$pagin['link'] .= (!empty($buscar) ? "&buscar=".$buscar : "");
				$pagin['atual'] = (!empty($_GET['pg']) && is_numeric($_GET['pg']) ? intval($_GET['pg']) : 1); $pagin['begin'] = ($pagin['atual']-1) * $pagin['max_results'];

				$consulta = Logs::countTransfDonateLogs($buscar);

				$pagin['total_results'] = $consulta[0]['quant'];
				$consulta = Logs::listTransfDonateLogs($pagin['begin'], $pagin['max_results'], $buscar);

				if(count($consulta) == 0) {
					echo'<tr><td colspan="4">Nenhum log encontrado!</td></tr>';
				} else {
					for($i=0, $c=count($consulta); $i < $c; $i++) {
						
						echo"
						<tr>
							<td>".$consulta[$i]['quantidade']."</td>
							<td>".$consulta[$i]['remetente']."</td>
							<td>".$consulta[$i]['char_name']." (Account: ".$consulta[$i]['destinatario'].")</td>
							<td>".date('d/m/Y \à\s H:i', strtotime($consulta[$i]['tdata']))."</td>
						</tr>
						";
					}
				}
				?>
			</table>

		</div>
		<?php require('private/paginate.php'); ?>

	</div>
	
	<section class="content-header">
		<h1>
			Transferências de <?php echo $coinName.'\'s'; ?> - Para personagem in-game
		</h1>
	</section>
	<br />

	<div class="box">
		
		<!-- Busca -->
		<div class="box-header" style="padding-bottom:0;">
			<div class="box-tools">
				<form class='default' method='GET'>
					<div class="input-group" style="width: 250px;">
						
						<input type='hidden' name='page' value='donate'/>
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
					<th>Quantidade</th>
					<th>Account</th>
					<th>Personagem</th>
					<th style='width: 140px'>Data</th>
				</tr>

				<?php
				$pagin['max_results'] = 50;
				$pagin['link'] = "?page=donate&module=logs";
				$pagin['link'] .= (!empty($buscar) ? "&buscar=".$buscar : "");
				$pagin['atual'] = (!empty($_GET['pg']) && is_numeric($_GET['pg']) ? intval($_GET['pg']) : 1); $pagin['begin'] = ($pagin['atual']-1) * $pagin['max_results'];

				$consulta = Logs::countConvDonateLogs($buscar);

				$pagin['total_results'] = $consulta[0]['quant'];
				$consulta = Logs::listConvDonateLogs($pagin['begin'], $pagin['max_results'], $buscar);

				if(count($consulta) == 0) {
					echo'<tr><td colspan="4">Nenhum log encontrado!</td></tr>';
				} else {
					for($i=0, $c=count($consulta); $i < $c; $i++) {
						
						echo"
						<tr>
							<td>".$consulta[$i]['quantidade']."</td>
							<td>".$consulta[$i]['account']."</td>
							<td>".$consulta[$i]['char_name']."</td>
							<td>".date('d/m/Y \à\s H:i', strtotime($consulta[$i]['cdata']))."</td>
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

