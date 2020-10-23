<?php

if(!$indexing) { exit; }

if($logged != 1) { fim('Access denied!', 'RELOAD'); }

if($funct['donate'] != 1) { fim($LANG[40003], 'ERROR', './'); }

$qtdCoins = !empty($_POST['qtdCoins']) ? intval(trim($_POST['qtdCoins'])) : '';
$metodo_pgto = !empty($_POST['metodo_pgto']) ? vCode($_POST['metodo_pgto']) : '';
//$personagem = !empty($_POST['personagem']) ? intval(trim($_POST['personagem'])) : '';

if(empty($qtdCoins) || empty($metodo_pgto)) { fim($LANG[10024]); }

if(!is_numeric($qtdCoins)) { fim($LANG[10025], 'ERROR', './?module=donate&page=add'); }

if($qtdCoins < 0) {
	fim($LANG[12055].' #INVALIDNUMBER');
}

//if(!is_numeric($personagem)) { fim($LANG[10026], 'ERROR', './?module=donate&page=add'); }

require('private/classes/classDonate.php');

/*
$findChar = Donate::findChar($_SESSION['acc'], $personagem);
if(count($findChar) == 0) { fim($LANG[10026], 'ERROR', './?module=donate&page=add'); }
*/

if(!empty($G2APay['actived'])) { $metodos[] = 'G2APay'; }
if(!empty($PagSeguro['actived'])) { $metodos[] = 'PagSeguro'; }
if(!empty($PayPal['actived'])) { $metodos[] = 'PayPal_USD'; $metodos[] = 'PayPal_EUR'; $metodos[] = 'PayPal_BRL'; }
if(!empty($Banking['actived'])) { $metodos[] = 'Banking'; }
if(!empty($MercadoPago['actived'])) { $metodos[] = 'MercadoPago'; }
if(!empty($PayGol['BRL']['actived'])) { $metodos[] = 'PayGol_BRL'; }
if(!empty($PayGol['EUR']['actived'])) { $metodos[] = 'PayGol_EUR'; }
if(!empty($PayGol['USD']['actived'])) { $metodos[] = 'PayGol_USD'; }
if(!empty($WebMoney['actived'])) { $metodos[] = 'WebMoney'; }
if(!empty($Payza['actived'])) { $metodos[] = 'Payza'; }
if(!empty($Skrill['actived'])) { $metodos[] = 'Skrill'; }

if($metodo_pgto == 'PagSeguro') {
	$coinPrice = $PagSeguro['coin_price'];
	$curr = 'BRL';
} else if($metodo_pgto == 'Banking') {
	$coinPrice = $Banking['coin_price'];
	$curr = $Banking['currency'];
} else if($metodo_pgto == 'PayPal_USD') {
	$coinPrice = $PayPal['USD']['coin_price'];
	$curr = 'USD';
} else if($metodo_pgto == 'PayPal_BRL') {
	$coinPrice = $PayPal['BRL']['coin_price'];
	$curr = 'BRL';
} else if($metodo_pgto == 'PayPal_EUR') {
	$coinPrice = $PayPal['EUR']['coin_price'];
	$curr = 'EUR';
} else if($metodo_pgto == 'MercadoPago') {
	$coinPrice = $MercadoPago['coin_price'];
	$curr = 'BRL';
} else if($metodo_pgto == 'PayGol_USD') {
	$coinPrice = $PayGol['USD']['coin_price'];
	$curr = 'USD';
} else if($metodo_pgto == 'PayGol_BRL') {
	$coinPrice = $PayGol['BRL']['coin_price'];
	$curr = 'BRL';
} else if($metodo_pgto == 'PayGol_EUR') {
	$coinPrice = $PayGol['EUR']['coin_price'];
	$curr = 'EUR';
} else if($metodo_pgto == 'WebMoney') {
	$coinPrice = $WebMoney['coin_price'];
	$curr = $WebMoney['currency'];
} else if($metodo_pgto == 'Payza') {
	$coinPrice = $Payza['coin_price'];
	$curr = $Payza['currency'];
} else if($metodo_pgto == 'Skrill') {
	$coinPrice = $Skrill['coin_price'];
	$curr = $Skrill['currency'];
} else {
	$coinPrice = $G2APay['coin_price'];
	$curr = $G2APay['currency'];
}

if(!in_array($metodo_pgto, $metodos)) {
	fim($LANG[10027], 'ERROR', './?module=donate&page=add');
}

$qtdBonus = 0;

if($bonusActived == 1) {
	
	$count1 = (isset($buyCoins['bonus_count'][1]) ? intval($buyCoins['bonus_count'][1]) : 0);
	$count2 = (isset($buyCoins['bonus_count'][2]) ? intval($buyCoins['bonus_count'][2]) : 0);
	$count3 = (isset($buyCoins['bonus_count'][3]) ? intval($buyCoins['bonus_count'][3]) : 0);
	
	if($qtdCoins >= $count3) { $bonus = (isset($buyCoins['bonus_percent'][3]) ? intval($buyCoins['bonus_percent'][3]) : 0); }
	else if($qtdCoins >= $count2) { $bonus = (isset($buyCoins['bonus_percent'][2]) ? intval($buyCoins['bonus_percent'][2]) : 0); }
	else if($qtdCoins >= $count1) { $bonus = (isset($buyCoins['bonus_percent'][1]) ? intval($buyCoins['bonus_percent'][1]) : 0); }
	else { $bonus = '0'; }
	if($bonus > 0) {
		$qtdBonus = intval(($qtdCoins*$bonus)/100);
	}
	
}

$valor = (intval(trim($qtdCoins)) * number_format(trim($coinPrice), 2, '.', ''));

$insertDonation = Donate::insertDonation($_SESSION['acc'], '', $metodo_pgto, $qtdCoins, $qtdBonus, $valor, $coinPrice, $curr);
if($insertDonation) {
	fim('', 'OK', './?module=donate&page=order_pay&f='.intval(DB::$lastInsertID));
} else {
	fim($LANG[12055], 'ERROR', './?module=donate&page=add');
}
