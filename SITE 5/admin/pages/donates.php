<?php if($indexing != 1) { exit; } ?>

<h1>Doações</h1>

<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=donates_all' class='atualstudio_button'>Ver todas</a></div>

<?php

if(isset($_GET['go']) && is_numeric($_GET['go'])) {
	$query = mysql_query("SELECT * FROM ".DBNAME.".site_donations WHERE protocolo = '".$_GET['go']."' AND coins_entregues = '0' LIMIT 1", $conexao);
	if(mysql_num_rows($query) > 0) {
		while($o=mysql_fetch_array($query)) {
			
			$coinsEntregar = intval($o['quant_coins'] + $o['coins_bonus']);
			$coins_entregues = $o['coins_entregues'];
			$personagem = $o['personagem'];
			$t_ref = $o['protocolo'];
			
			$verifyOnline = mysql_query("SELECT online FROM ".DBNAME.".characters WHERE charId = '".$personagem."' AND online = '0' LIMIT 1", $conexao);
			if(mysql_num_rows($verifyOnline) != 0) {
				
				$searchItemExit = mysql_query("SELECT object_id FROM ".DBNAME.".items WHERE owner_id = '".$personagem."' AND item_id = '".COINID."' AND loc = 'INVENTORY' LIMIT 1", $conexao);
				if(mysql_num_rows($searchItemExit) > 0) {
					
					$object_id = mysql_result($searchItemExit, 0, 0);
					$insertCoins = mysql_query("UPDATE ".DBNAME.".items SET count = (count+".$coinsEntregar.") WHERE object_id = '".$object_id."' LIMIT 1", $conexao);
					
				} else {
					
					$searchLastID = mysql_query("SELECT object_id FROM ".DBNAME.".items ORDER BY object_id DESC LIMIT 1", $conexao);
					$itemID = intval(mysql_result($searchLastID, 0, 0)) + 1;
					
					$searchLastLOC = mysql_query("SELECT loc FROM ".DBNAME.".items WHERE owner_id = '".$personagem."' ORDER BY loc DESC LIMIT 1", $conexao);
					$theLOC = intval(mysql_result($searchLastLOC, 0, 0)) + 1;
					
					$insertCoins = mysql_query("INSERT INTO ".DBNAME.".items 
					(object_id, owner_id, item_id, count, enchant_level, loc, loc_data, first_owner_id) VALUES 
					(".$itemID.", ".$personagem.", ".COINID.", ".$coinsEntregar.", 0, 'INVENTORY', ".$theLOC.", ".$personagem.")", $conexao);		
					
				}
				
				if($insertCoins != 1) {
					echo "<script type='text/javascript'>alert('Não foi possível entregar. Ocorreu algum erro! Entre em contato com a Atualstudio.');</script>";
				} else {
					
					$updateOrder = mysql_query("UPDATE ".DBNAME.".site_donations SET ultima_alteracao = '".time()."', coins_entregues = '".$coinsEntregar."', status_code = '3', status_text = 'Delivered' WHERE protocolo = '".$t_ref."' LIMIT 1", $conexao);
					if($updateOrder != 1) {
						echo "<script type='text/javascript'>alert('As coins foram entregues, mas houve um erro ao atualizar status da doação. Entre em contato com a Atualstudio.');</script>";
					}
					
				}
				
			} else { echo "<script type='text/javascript'>alert('Não foi possível entregar pois o personagem está online!');</script>"; }
			
		}
	} else {
		echo "<script type='text/javascript'>alert('Essa doação não está pendente!');</script>";
	}
}

if(isset($_GET['success'])) { echo "<div class='notificacao'>Operação realizada com sucesso!</div>"; }

?>

Abaixo são exibidas apenas as <b>doações pendentes</b>, ou seja, doações realizadas através do painel de usuário que ainda não foram finalizadas. Para ver todas, <a href='?id=donates_all'>clique aqui</a>.<br />





<?
$link_pg = "?id=donates";
if(!isset($_GET['pg'])) { $_GET['pg'] = 1; } elseif(!is_numeric($_GET['pg'])) { $_GET['pg'] = 1; } $npage = addslashes(($_GET['pg'] - 1));
$numreg = 10; $inicial = $npage * $numreg;

$dsearch = mysql_query("SELECT D.*, C.char_name FROM ".DBNAME.".site_donations AS D LEFT JOIN ".DBNAME.".characters AS C ON C.charId = D.personagem WHERE status_code = '1' OR status_code = '3' AND coins_entregues = '0' ORDER BY data DESC LIMIT ".$inicial.", ".$numreg."", $conexao);
$queryselect_count = mysql_query("SELECT * FROM ".DBNAME.".site_donations WHERE coins_entregues = '0'", $conexao);
$quantreg = mysql_num_rows($queryselect_count);

if(mysql_num_rows($dsearch) > 0) {
	
	echo "<br />Ao clicar em \"Finalizar e Entregar\" a doação será finalizada e o item entregue ao jogador.<br /><br />";
	
	$i=1;

	$LANG[10029] = 'Protocolo';
	$LANG[10030] = ITEMNA.'\'s Compradas';
	$LANG[10031] = ITEMNA.'\'s Bônus';
	$LANG[10032] = 'Total de '.ITEMNA.'\'s a receber';
	$LANG[10033] = 'Personagem';
	$LANG[10034] = 'Valor a ser pago';
	$LANG[10035] = 'Data do pedido';
	$LANG[10036] = 'Última atualização';
	$LANG[10037] = 'Método de Pagamento';
	$LANG[10038] = 'Status';
	
	$status["Canceled_Reversal"] = "Reversão cancelada";
	$status["Completed"] = "Paga";
	$status["Denied"] = "Negado";
	$status["Expired"] = "Expirado";
	$status["Failed"] = "Fracassado";
	$status["In-Progress"] = "Em Progresso";
	$status["Partially_Refunded"] = "Parcialmente Reembolsado";
	$status["Pending"] = "Aguardando Pagamento";
	$status["Processed"] = "Processado";
	$status["Refunded"] = "Reembolsado";
	$status["Reversed"] = "Invertida";
	$status["Voided"] = "Anulado";
	$status["Aguardando Pagamento"] = $status["Pending"];
	
	$status["2"] = "Paga";
	$status["0"] = "Aguardando Pagamento";
	$status["-1"] = "Cancelada";
	$status["-2"] = "Falhou";
	$status["-3"] = "Cobrar de volta";

	$status["Delivered"] = "Entregue";
	
	while($d=mysql_fetch_array($dsearch)) {
		
		$thisStatus = trim($d['status_text']);
		
		echo "
		<hr /><br />
		<div style='display:table;width:100%;'>
			<div style='float:left;width:50%;'>
				<b>".$LANG[10029].":</b> ".$d['protocolo']."<br />
				<b>".$LANG[10030].":</b> ".$d['quant_coins']."<br />
				<b>".$LANG[10031].":</b> ".$d['coins_bonus']."<br />
				<b>".$LANG[10032].":</b> ".($d['quant_coins']+$d['coins_bonus'])."<br />
				<b>".$LANG[10033].":</b> ".$d['char_name']."<br />
				<b>Account:</b> ".$d['account']."<br />
			</div>
			<div style='float:left;width:50%;'>
				<b>".$LANG[10034].":</b> ".$d['valor'].",00 ".(trim($d['metodo_pgto']) == 'PayPal' ? $PayPal['currency'] : 'R$')."<br />
				<b>".$LANG[10035].":</b> ".date('d/m/Y H:i', $d['data'])."<br />
				<b>".$LANG[10036].":</b> ".(!empty($d['ultima_alteracao']) ? date('d/m/Y H:i', $d['ultima_alteracao']) : $LANG[10039])."<br />
				<b>".$LANG[10037].":</b> ".$d['metodo_pgto']."<br />
				<b>".$LANG[10038].":</b> ".(isset($status[$thisStatus]) ? $status[$thisStatus] : $d['status_text'])."
			</div>
		</div>
		<div style='display:table;width:90%;padding:10px 0 0;'>
			<div style='float:right;'><a style='float:right;' href='?id=donates&go=".$d['protocolo']."' class='atualstudio_button'>Finalizar e Entregar</a></div>
		</div>
		<br />
		";
		
		$i++;
	}
	
	echo "<hr />";
	
	include("./engine/paginacao.php");

} else { echo "<br><br><br><center><b>Nenhuma doação pendente.</b></center><br><br><br>"; }
?>

