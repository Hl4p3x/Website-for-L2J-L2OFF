<?php
require('private/classes/classDonate.php');

$protocolo = !empty($_GET['protocolo']) ? intval($_GET['protocolo']) : 0;

$consulta = Donate::findDonation($protocolo);
if(count($consulta) == 0){
	fim('Doação inexistente!');
}

$data = time();

$update = Donate::paidDonation($protocolo, $data, ($consulta[0]['quant_coins']+$consulta[0]['coins_bonus']));
if($update) {
	
	$insertBalance = Donate::insertBalance(trim($consulta[0]['account']), (intval($consulta[0]['quant_coins'])+intval($consulta[0]['coins_bonus'])));
	if($insertBalance) {
		adminLog("Entregou e concluiu a doação de protocolo ".$protocolo); // Admin Log
		fim('Doação entregue com sucesso!', 'OK', './?page=list_pending&module=donate');
	} else {
		fim('A doação foi setada como entregue, no entanto, não foi possível inserir o saldo. Entre em contato com a Atualstudio urgentemente!');
	}
	
} else {
	fim('Desculpe, ocorreu um erro. Por favor, tente novamente mais tarde.');
}
