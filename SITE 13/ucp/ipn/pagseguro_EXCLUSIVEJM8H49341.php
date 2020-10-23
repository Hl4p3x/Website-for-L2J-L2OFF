<?php

error_reporting(0);
ini_set('error_reporting', 0);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
ini_set('default_charset', 'UTF-8');
date_default_timezone_set('America/Sao_Paulo');
header('HTTP/1.1 200 OK');

function saveLog($text, $dump=0) {
	$xpldName = explode('.', basename( __FILE__ ));
	$secretName = explode('_', $xpldName[0]);
	$f = fopen("logs/".$secretName[0]."_".date('m-Y')."__".md5($secretName[1]).".txt","a+");
	$t = date('d/m/Y H:i').": ".$text.($dump==1 ? " - Dump: ".strtr(print_r($_POST, true), array('  ' => ' ')) : "")."\r\n";
	fwrite($f, $t, strlen($t));
	fclose($f);
}

function vCode($content) {
	return addslashes(htmlentities(trim($content), ENT_QUOTES, 'ISO-8859-1'));
}

if(empty($_POST['notificationType']) || empty($_POST['notificationCode'])){
	saveLog("RAW POSTs incompletos!", 1);
	exit;
}

if($_POST['notificationType'] != 'transaction'){
	saveLog("Type inválido!", 1);
	exit;
}

if(file_exists('../private/configs.php')) {
	require('../private/configs.php');
} else {
	saveLog("Require configs!", 0);
}

if(file_exists('../../private/configs.php') && (!isset($host) || !isset($dbnm) || !isset($user) || !isset($pass))) {
	require('../../private/configs.php');
}

$notCode = vCode($_POST['notificationCode']);

$email = $PagSeguro['email'];
$token = ($PagSeguro['testando'] == 1 ? $PagSeguro['token_sandbox'] : $PagSeguro['token']);

$url = 'https://' . ($PagSeguro['testando'] == 1 ? 'ws.sandbox.pagseguro.uol.com.br' : 'ws.pagseguro.uol.com.br') . '/v2/transactions/notifications/' . $notCode . '?email=' . $email . '&token=' . $token;

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$transaction= curl_exec($curl);
curl_close($curl);

if(trim($transaction) == 'Unauthorized' || trim($transaction) == 'Not Found') {
	saveLog("Transação não autorizada!", 1);
	exit;
}

$transaction = simplexml_load_string($transaction);

$tid = trim($transaction->code);
$status = trim($transaction->status);
$ref = trim($transaction->reference);
$price = trim($transaction->grossAmount);

if(empty($tid) || empty($status) || empty($ref) || empty($price)) {
	saveLog("Algum dos parâmetros importantes está vazio! ".strtr(print_r($transaction, true), array('  ' => ' '))."", 1);
	exit;
}

if(file_exists('../private/classes/DB.php')) {
	require('../private/classes/DB.php');
} else {
	require('../../private/classes/DB.php');
}

new DB($conMethod, $host, $user, $pass, $dbnm);

$d = DB::Executa("SELECT * FROM site_donations WHERE protocolo = '".$ref."' LIMIT 1");
if(count($d) == 0) {
	saveLog("Protocolo inexistente! ".strtr(print_r($transaction, true), array('  ' => ' '))."", 1);
	exit;
}

$account = trim($d[0]['account']);
$coinsEntregar = intval(trim($d[0]['quant_coins']) + trim($d[0]['coins_bonus']));
$coinsEntregues = intval(trim($d[0]['coins_entregues']));
$personagem = trim($d[0]['personagem']);
$valor = trim($d[0]['valor']);
$currentStatus = intval(trim($d[0]['status']));

$status = strtolower($status);
switch($status) {
	case 3: $finalStatus = 3; break; // Pago
	case 4: $finalStatus = 3; break; // Pago (Real: Disponível)
	case 5: $finalStatus = 3; break; // Pago (Real: Em disputa)
	case 6: $finalStatus = 5; break; // Cancelada (Real: Devolvida)
	case 7: $finalStatus = 5; break; // Cancelada (Real: Cancelada)
	default: $finalStatus = 1; break; // Pendente
}

if($currentStatus == 4 && $finalStatus == 3) {
	$finalStatus = 4;
}

if($currentStatus == 2 && $finalStatus != 3) {
	$finalStatus = 2;
}

$updateOrder = DB::Executa("UPDATE site_donations SET ultima_alteracao = '".time()."', transaction_code = '".$tid."', status = '".$finalStatus."', status_real = '".$status."' WHERE protocolo = '".$ref."' LIMIT 1");
if(!$updateOrder) {
	saveLog("Não foi possível atualizar o status da transação! #1", 1);
	exit;
}

if($autoDelivery != 1) {
	saveLog("Transação recebida e processada com sucesso! #1", 1);
	exit;
}

if($coinsEntregues != $coinsEntregar && $finalStatus == 3) {
	
	if(number_format(($price), 2, '.', '') < number_format($valor, 2, '.', '')) {
		saveLog("O valor pago é inferior ao valor registrado! ".strtr(print_r($transaction, true), array('  ' => ' '))."", 1);
		exit;
	}
	
	$updateOrder = DB::Executa("UPDATE site_donations SET coins_entregues = '".$coinsEntregar."', status = '4' WHERE protocolo = '".$ref."' LIMIT 1");
	if(!$updateOrder) {
		saveLog("Não foi possível atualizar o status da transação! #2", 1);
		exit;
	}

	$checkExists = DB::Executa("SELECT * FROM site_balance WHERE account = '".$account."' LIMIT 1");
	if(count($checkExists) > 0) {
		$addBalance = DB::Executa("UPDATE site_balance SET saldo = (saldo+".$coinsEntregar.") WHERE account = '".$account."' LIMIT 1");
	} else {
		$addBalance = DB::Executa("INSERT INTO site_balance (account, saldo) VALUES ('".$account."', '".$coinsEntregar."')");
	}
	
	if($addBalance) {
		saveLog("Transação recebida e saldo entregue com sucesso!", 1);
		exit;
	} else {
		saveLog("Não foi possível concluir e entregar o saldo da transação!", 1);
		exit;
	}

}

saveLog("Transação recebida e processada com sucesso! #2", 1);

