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
	$t = date('d/m/Y H:i').": ".$text.($dump==1 ? " - Dump: ".strtr(print_r($_GET, true), array('  ' => ' ')) : "")."\r\n";
	fwrite($f, $t, strlen($t));
	fclose($f);
}

function vCode($content) {
	return addslashes(htmlentities(trim($content), ENT_QUOTES, 'ISO-8859-1'));
}

if(
empty($_GET['transaction_id']) || 
empty($_GET['service_id']) || 
empty($_GET['custom']) || 
empty($_GET['price']) || 
empty($_GET['currency'])
) {
	saveLog("RAW GETs incompletos! TRANSACTION_ID = ".$_GET['transaction_id']." / SERVICE_ID = ".$_GET['service_id']." / CUSTOM = ".$_GET['custom']." / PRICE = ".$_GET['price']." / CURRENCY = ".$_GET['currency']." ", 1);
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

$tid = vCode($_GET['transaction_id']);
$service_id = vCode($_GET['service_id']);
$ref = vCode($_GET['custom']);
$price = vCode($_GET['price']);
$curr = vCode($_GET['currency']);

$getXML = "https://www.paygol.com/api/check-payment?service=".$service_id."&id=".$tid."&format=xml";
$xml = @simplexml_load_file($getXML);

if(trim($xml->response) != 'OK') {
	saveLog("Validação má sucedida! #1", 1);
	exit;
}

$status = vCode($xml->status);

if(empty($tid) || empty($service_id) || empty($ref) || empty($price) || empty($curr) || empty($status)) {
	saveLog("Algum dos parâmetros importantes está vazio! (TID: ".$tid.", SERVICE_ID: ".$service_id.", PRICE: ".$price.", REF: ".$ref.", CURR: ".$curr.", STATUS: ".$status.")", 1);
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
	saveLog("Protocolo inexistente!", 1);
	exit;
}

$account = trim($d[0]['account']);
$coinsEntregar = intval(trim($d[0]['quant_coins']) + trim($d[0]['coins_bonus']));
$coinsEntregues = intval(trim($d[0]['coins_entregues']));
$personagem = trim($d[0]['personagem']);
$valor = trim($d[0]['valor']);
$currentStatus = intval(trim($d[0]['status']));
$mpgto = strtolower(trim($d[0]['metodo_pgto']));

$status = strtolower($status);
switch($status) {
	case 'completed': $finalStatus = 3; break; // Pago
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
	
	if(number_format($price, 2, '.', '') < number_format($valor, 2, '.', '')) {
		saveLog("O valor pago é inferior ao valor registrado!", 1);
		exit;
	}
	
	if($mpgto == 'paygol_brl') {
		$moeda = 'BRL';
	} else if($mpgto == 'paygol_usd') {
		$moeda = 'USD';
	} else {
		$moeda = 'EUR';
	}
	
	if($curr != $moeda) {
		saveLog("O pagamento foi efetuado numa moeda diferente da que foi registrada inicialmente na transação!", 1);
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

