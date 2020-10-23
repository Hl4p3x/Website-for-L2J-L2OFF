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
	echo json_encode(200);
}

function vCode($content) {
	return addslashes(htmlentities(trim($content), ENT_QUOTES, 'ISO-8859-1'));
}

if(empty($_GET['id']) || empty($_GET['topic'])) {
	saveLog("RAW GETs incompletos!", 1);
	exit;
}

require_once "../private/mp/mercadopago.php";

if(file_exists('../private/configs.php')) {
	require('../private/configs.php');
} else {
	saveLog("Require configs!", 0);
}

if(file_exists('../../private/configs.php') && (!isset($host) || !isset($dbnm) || !isset($user) || !isset($pass))) {
	require('../../private/configs.php');
}

$mp = new MP($MercadoPago['client_id'], $MercadoPago['client_secret']);

if($MercadoPago['testando'] == 1) {
	$mp->sandbox_mode(TRUE);
}

$params = ["access_token" => $mp->get_access_token()];

if(empty($params)) {
	saveLog("Validação 01 má sucedida! PARAMS: ".(is_array($params) ? '#P1: '.strtr(print_r($params, true), array('  ' => ' ')) : '#P2: '.$params)."", 1);
	exit;
}

if(!isset($_GET["id"]) || !isset($_GET["topic"]) || !ctype_digit($_GET["id"])) {
	saveLog("Validação 02 má sucedida!", 1);
	exit;
}

if($_GET["topic"] == 'payment'){
	
	if(empty($params)) {
		saveLog('params vazio!', 1);
		exit;
	}
	
	$payment_info = $mp->get("/collections/notifications/" . $_GET["id"], $params, false);
	if(empty($payment_info["response"]["collection"]["merchant_order_id"])) {
		saveLog('Merchant Order ID vazio!', 1);
		exit;
	}
	
	$merchant_order_info = $mp->get("/merchant_orders/" . $payment_info["response"]["collection"]["merchant_order_id"], $params, false);
	
} else {
	saveLog("Recebemos uma notificação, mas ela não é relacionada a um pagamento.", 1);
	exit;
}

/*
if($MercadoPago['testando'] != 1) {
	
	if($merchant_order_info["status"] == 200) {
		
		$transaction_amount_payments = 0;
		$transaction_amount_order = $merchant_order_info["response"]["total_amount"];
		$payments=$merchant_order_info["response"]["payments"];
		foreach ($payments as $payment) {
			if($payment['status'] == 'approved'){
				$transaction_amount_payments += $payment['transaction_amount'];
			}
		}
		if($transaction_amount_payments < $transaction_amount_order){
			saveLog("O valor pago é inferior ao valor registrado! #1 transaction_amount_payments = ".$transaction_amount_payments." / transaction_amount_order = ".$transaction_amount_order." / STRING: ".(is_array($merchant_order_info) ? '#P1: '.strtr(print_r($merchant_order_info, true), array('  ' => ' ')) : '#P2: '.$merchant_order_info)."", 1);
			exit;
		}
		
	} else {
		
		saveLog("Validação 03 má sucedida! STRING: ".(is_array($merchant_order_info) ? '#P1: '.strtr(print_r($merchant_order_info, true), array('  ' => ' ')) : '#P2: '.$merchant_order_info)."", 1);
		exit;
		
	}
	
} */

$tid = trim($payment_info['response']['collection']['id']);
$status = trim($payment_info['response']['collection']['status']);
$price = trim($payment_info['response']['collection']['total_paid_amount']);
$ref = trim($payment_info['response']['collection']['external_reference']);
$curr = trim($payment_info['response']['collection']['currency_id']);

if(empty($tid) || empty($status) || empty($price) || empty($ref) || empty($curr)) {
	saveLog("Algum dos parâmetros importantes está vazio! ".strtr(print_r($payment_info, true), array('  ' => ' '))."", 1);
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
	saveLog("Protocolo inexistente! REF: ".$ref."", 1);
	exit;
}

$account = trim($d[0]['account']);
$coinsEntregar = intval(trim($d[0]['quant_coins']) + trim($d[0]['coins_bonus']));
$coinsEntregues = intval(trim($d[0]['coins_entregues']));
$personagem = trim($d[0]['personagem']);
$valor = trim($d[0]['valor']);
$currentStatus = intval(trim($d[0]['status']));

/*

pending
    O usuário ainda não completou o processo de pagamento.
approved
    O pagamento foi aprovado e acreditado.
in_process
    O pagamento estão em revisão.
in_mediation
    Os usuários tem começada uma disputa.
rejected
    O pagamento foi rejeitado. O usuário pode tentar novamente.
cancelled
    O pagamento foi cancelado por uma das parte ou porque o tempo expirou.
refunded
    O pagamento foi devolvido ao usuário.
charged_back
    Foi feito um chargeback no cartão do comprador.
    
    */

$status = strtolower($status);
switch($status) {
	case 'approved': $finalStatus = 3; break; // Pago
	case 'in_mediation': $finalStatus = 3; break; // Pago (Real: Em disputa)
	case 'cancelled': $finalStatus = 5; break; // Cancelada (Real: Cancelada)
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
	saveLog("Transação recebida e processada com sucesso! #1 ".strtr(print_r($payment_info, true), array('  ' => ' '))."", 1);
	exit;
}

if($coinsEntregues != $coinsEntregar && $finalStatus == 3) {
	
	if(number_format($price, 2, '.', '') < number_format($valor, 2, '.', '')) {
		saveLog("O valor pago é inferior ao valor registrado! #2 (".number_format($price, 2, '.', '')." < ".number_format($valor, 2, '.', '').")", 1);
		exit;
	}
	
	if($curr != 'BRL') {
		saveLog("O pagamento foi efetuado numa moeda diferente da que foi registrada inicialmente na transação! CUR: ".$curr."", 1);
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

saveLog("Transação recebida e processada com sucesso! #2 ".strtr(print_r($payment_info, true), array('  ' => ' '))."", 1);

