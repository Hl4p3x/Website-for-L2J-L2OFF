<?php

$protocolo = !empty($_GET['protocolo']) ? intval($_GET['protocolo']) : 0;

require('private/classes/classDonate.php');

$consulta = Donate::findDonation($protocolo);
if(count($consulta) == 0){
	fim('Doação inexistente!');
}

?>

<section class="content-header">
	<h1>
		Entregar doação
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-money"></i> Doações</li>
		<li class="active">Entregar</li>
	</ol>
</section>

<section class="content">
	
	<div class="box">
		
		<div class="box-body">
			
			Você tem certeza que deseja entregar e concluir a doação de protocolo <b><?php echo $consulta[0]['protocolo']; ?></b>?<br /><br />
			
			<table class="table table-bordered">
				
				<tr>
					<th>Protocolo</th>
					<th>Account</th>
					<!-- <th>Personagem</th> -->
					<th>Coin's</th>
					<th>Valor</th>
					<th>Método</th>
					<th>Data</th>
					<th>Status</th>
					<th>Ultima Alteração</th>
				</tr>
				
				<?php
					
				$mpxpl = explode('_', $consulta[0]['metodo_pgto']);
				$metodo = $mpxpl[0];
						
				echo"
				<tr>
					<td>".$consulta[0]['protocolo']."</td>
					<td>".$consulta[0]['account']."</td>
					<!--<td>".$consulta[0]['char_name']."</td>-->
					<td>".(intval($consulta[0]['quant_coins'])+intval($consulta[0]['coins_bonus']))." ".(!empty($consulta[0]['coins_bonus']) ? "<span style='font-size:12px;'>(".$consulta[0]['coins_bonus']."&nbsp;bônus)</span>" : "")."</td>
					<td>".obtainCurrencySymbol($consulta[0]['currency'])."&nbsp;".number_format(trim($consulta[0]['valor']), 2, ',', '.')."</td>
					<td style='font-size:13px;'>".$metodo."</td>
					<td style='font-size:13px;'>".date('d/m/Y H:i', ($consulta[0]['data']))."</td>
					<td>".obtainOrderStatusName($consulta[0]['status'])."</td>
					<td style='font-size:13px;'>".(empty($consulta[0]['ultima_alteracao']) ? 'Ainda não houve' : date('d/m/Y H:i', ($consulta[0]['ultima_alteracao'])))."</td>
				</tr>
				";
			
				?>
				
			</table>
			
			<div style='display: table; margin: 20px auto;'>
				<a class='btn btn-info' href='javascript:history.back();'>&laquo; Voltar</a>
				&nbsp;
				<a class='btn btn-success usarJquery' href='?engine=deliver&module=donate&protocolo=<?php echo $consulta[0]['protocolo']; ?>'>Entregar</a>
			</div>
			
		</div>
		
	</div>

</section>