<?

date_default_timezone_set('America/Sao_Paulo');
ini_set('error_reporting', 0);
ini_set('default_charset', 'ISO-8859-1');

require('../../configs.php');

function vCode($content) {
	return addslashes(htmlentities(trim($content), ENT_QUOTES, 'ISO-8859-1'));
}

if(ADPACT != 1) { header('Location: ../desativado.php'); exit; }

$conexao = @mysql_connect(DBHOST, DBUSER, DBPASS);
?>

<div style='display:table; margin: 0 auto; padding: 40px;'>
	
<h1>Visualizando transação</h1>

<?
$protocolo = (isset($_GET['id']) ? vCode($_GET['id']) : 0);
$account = (isset($_GET['account']) ? vCode($_GET['account']) : 0);

$dsearch = mysql_query("SELECT D.*, C.char_name FROM ".DBNAME.".site_donations AS D LEFT JOIN ".DBNAME.".characters AS C ON C.charId = D.personagem WHERE protocolo = '".$protocolo."' AND account = '".$account."' LIMIT 1", $conexao);
if(mysql_num_rows($dsearch) > 0) {
	
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
			<b>".$LANG[10029].":</b> ".$d['protocolo']."<br />
			<b>".$LANG[10030].":</b> ".$d['quant_coins']."<br />
			<b>".$LANG[10031].":</b> ".$d['coins_bonus']."<br />
			<b>".$LANG[10032].":</b> ".($d['quant_coins']+$d['coins_bonus'])."<br />
			<b>".$LANG[10033].":</b> ".$d['char_name']."<br />
			<b>Account:</b> ".$d['account']."<br />
			<b>".$LANG[10034].":</b> ".$d['valor'].",00 ".(trim($d['metodo_pgto']) == 'PayPal' ? $PayPal['currency'] : 'R$')."<br />
			<b>".$LANG[10035].":</b> ".date('d/m/Y H:i', $d['data'])."<br />
			<b>".$LANG[10036].":</b> ".(!empty($d['ultima_alteracao']) ? date('d/m/Y H:i', $d['ultima_alteracao']) : $LANG[10039])."<br />
			<b>".$LANG[10037].":</b> ".$d['metodo_pgto']."<br />
			<b>".$LANG[10038].":</b> ".(isset($status[$thisStatus]) ? $status[$thisStatus] : $d['status_text'])."
		";
		
	}
	
}
?>

</div>