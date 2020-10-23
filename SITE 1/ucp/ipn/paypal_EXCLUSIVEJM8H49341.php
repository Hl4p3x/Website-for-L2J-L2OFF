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

if(
empty($_POST['txn_id']) || 
empty($_POST['payment_status']) || 
empty($_POST['mc_gross']) || 
empty($_POST['custom']) || 
empty($_POST['mc_currency']) || 
empty($_POST['payer_email'])
) {
	saveLog("RAW POSTs incompletos! #1", 1);
	exit;
}

if(empty($_POST['receiver_email']) && empty($_POST['business'])) {
	saveLog("RAW POSTs incompletos! #2", 1);
	exit;
}

/*
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}

$header = "POST /cgi-bin/webscr HTTP/1.1\r\n";

$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

if($PayPal['testando'] == 1) {
	$header .= "Host: www.sandbox.paypal.com:443\r\n";
	$fp = fsockopen('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
} else {
	$header .= "Host: www.paypal.com:443\r\n";
	$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
}

fputs($fp, $header . $req);

$countWhile = 0;

while(!feof($fp)) {
	
	$countWhile += 1;
	
	$res = fgets($fp, 1024);
	
	if(strcmp($res, "VERIFIED") != 0) {
		saveLog("Transação inválida! #1", 1);
		exit;
	}

	fclose ($fp);
	
}

if($countWhile == 0) {
	saveLog("Transação inválida! #2", 1);
	exit;
}
*/

/*
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
	$keyval = explode ('=', $keyval);
	if (count($keyval) == 2)
	$myPost[$keyval[0]] = urldecode($keyval[1]);
}

$req = 'cmd=_notify-validate';
if (function_exists('get_magic_quotes_gpc')) {
	$get_magic_quotes_exists = true;
}

foreach ($myPost as $key => $value) {
	if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
		$value = urlencode(stripslashes($value));
	} else {
		$value = urlencode($value);
	}
	$req .= "&$key=$value";
}


if($PayPal['testando'] == 1) {
	$cURL_page = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
} else {
	$cURL_page = 'https://www.paypal.com/cgi-bin/webscr';
}

$ch = curl_init($cURL_page);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

if ( !($res = curl_exec($ch)) ) {
	saveLog("Processo encerrado por falha no cURL!", 1);
	curl_close($ch);
	exit;
}
curl_close($ch);

if(strcmp($res, "VERIFIED") != 0) {
	saveLog("Transação inválida!", 1);
	exit;
}
*/

if(file_exists('../private/configs.php')) {
	require('../private/configs.php');
} else {
	saveLog("Require configs!", 0);
}

if(file_exists('../../private/configs.php') && (!isset($host) || !isset($dbnm) || !isset($user) || !isset($pass))) {
	require('../../private/configs.php');
}

$tid = vCode($_POST['txn_id']);
$status = vCode($_POST['payment_status']);
$ref = vCode($_POST['custom']);
$curr = vCode($_POST['mc_currency']);
$email = !empty($_POST['receiver_email']) ? vCode($_POST['receiver_email']) : '';
$email2 = !empty($_POST['business']) ? vCode($_POST['business']) : '';
$payer_email = vCode($_POST['payer_email']);
$price = vCode($_POST['mc_gross']);

if(empty($tid) || empty($status) || empty($price) || empty($ref) || empty($curr) || empty($payer_email)) {
	saveLog("Algum dos parâmetros importantes está vazio! #1", 1);
	exit;
}

if(empty($email) && empty($email2)) {
	saveLog("Algum dos parâmetros importantes está vazio! #2", 1);
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

/*
Canceled_Reversal: A reversal has been canceled. For example, you won a dispute with the customer, and the funds for the transaction that was reversed have been returned to you.
Completed: The payment has been completed, and the funds have been added successfully to your account balance.
Created: A German ELV payment is made using Express Checkout.
Denied: The payment was denied. This happens only if the payment was previously pending because of one of the reasons listed for the pending_reason variable or the Fraud_Management_Filters_x variable.
Expired: This authorization has expired and cannot be captured.
Failed: The payment has failed. This happens only if the payment was made from your customer's bank account.
Pending: The payment is pending. See pending_reason for more information.
Refunded: You refunded the payment.
Reversed: A payment was reversed due to a chargeback or other type of reversal. The funds have been removed from your account balance and returned to the buyer. The reason for the reversal is specified in the ReasonCode element.
Processed: A payment has been accepted.
Voided: This authorization has been voided.
*/

$status = strtolower($status);
switch($status) {
	case 'canceled_reversal': $finalStatus = 3; break; // Pago
	case 'completed': $finalStatus = 3; break; // Pago
	case 'processed': $finalStatus = 3; break; // Pago
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
	
	if($PayPal['testando'] != 1) {
		
		if(number_format($price, 2, '.', '') < number_format($valor, 2, '.', '')) {
			saveLog("O valor pago é inferior ao valor registrado!", 1);
			exit;
		}
		
		if($mpgto == 'paypal_brl') {
			$moeda = 'BRL';
		} else if($mpgto == 'paypal_usd' || $mpgto == 'paypal') {
			$moeda = 'USD';
		} else {
			$moeda = 'EUR';
		}
		
		if($curr != $moeda) {
			saveLog("O pagamento foi efetuado numa moeda diferente da que foi registrada inicialmente na transação!", 1);
			exit;
		}
		
		if($email != $PayPal['business_email'] && $email2 != $PayPal['business_email']) {
			saveLog("O pagamento foi efetuado para uma conta que não é equivalente a que está na configuração!", 1);
			exit;
		}
		
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

