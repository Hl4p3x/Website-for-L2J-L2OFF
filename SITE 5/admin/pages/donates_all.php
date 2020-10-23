<?php if($indexing != 1) { exit; } ?>

<h1>Doações</h1>

<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=donates' class='atualstudio_button'>Ver apenas pendentes</a></div>

Abaixo são exibidas <b>todas as doações</b> realizadas através do painel do usuário. Para ver apenas as pendentes, <a href='?id=donates'>clique aqui</a>.<br />


<?
$buscar = (isset($_GET['buscar']) ? vCode($_GET['buscar']) : '');
?>
<br /><br />
<form method="GET">
	<input type='hidden' name='id' value='donates_all' />
	<div style='display:table;width:100%;'>
		<label class='formpadrao'>
			<div class='desc' style='width:130px;'>Pesquisar:</div>
			<div class='camp'><input type='text' name='buscar' value='<?=$buscar;?>' style='width:335px;' /></div>
		</label>
	</div>
	<div style='padding: 10px 0; display:table;width:100%;'><div style='display:table;margin: 0 28px 0 0; float: right;'>
		<input type="submit" class='atualstudio_button' value="Pesquisar &raquo;" />
	</div></div>
</form>

<?
$link_pg = "?id=donates";
if(!isset($_GET['pg'])) { $_GET['pg'] = 1; } elseif(!is_numeric($_GET['pg'])) { $_GET['pg'] = 1; } $npage = addslashes(($_GET['pg'] - 1));
$numreg = 10; $inicial = $npage * $numreg;

$dsearch = mysql_query("SELECT D.*, C.char_name FROM ".DBNAME.".site_donations AS D LEFT JOIN ".DBNAME.".characters AS C ON C.charId = D.personagem ".(!empty($buscar) ? "WHERE D.protocolo = '".$buscar."' OR D.account LIKE '%".$buscar."%' OR C.char_name LIKE '%".$buscar."%'" : "")." ORDER BY data DESC LIMIT ".$inicial.", ".$numreg."", $conexao);
$queryselect_count = mysql_query("SELECT * FROM ".DBNAME.".site_donations", $conexao);
$quantreg = mysql_num_rows($queryselect_count);

if(!empty($buscar)) { $link_pg .= "&buscar=".$buscar; echo "<br />Exibindo resultados da sua busca por \"<b>".$buscar."\"</b>."; }

if(mysql_num_rows($dsearch) > 0) {
	
	echo "<br /><br />";
	
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
		<div style='display:table;width:90%;padding:0 0 0;'>
			<div style='float:right;'><a style='float:right;' target='_blank' href='pages/donates_public.php?id=".$d['protocolo']."&account=".$d['account']."' class='atualstudio_button'>Link público &raquo;</a></div>
		</div>
		<br />
		";
		
		$i++;
	}
	
	echo "<hr />";
	
	include("./engine/paginacao.php");

} else { echo "<br><br><br><center><b>Nenhuma doação.</b></center><br><br><br>"; }

