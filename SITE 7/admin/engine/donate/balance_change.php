<?php

$account = !empty($_POST['account']) ? vCode($_POST['account']) : '';
$saldo = !empty($_POST['saldo']) ? intval($_POST['saldo']) : 0;

if(empty($account)) {
	fim('Por favor, preencha todos os campos do formulário!');
}

if(strlen($account) > 25) {
	fim('A conta não pode ultrapassar 25 caracteres!');
}

if(strlen($saldo) > 11) {
	fim('O saldo não pode ultrapassar 11 caracteres!');
}

require('private/classes/classDonate.php');

$findAccount = Donate::findAccount($account);
if(count($findAccount) == 0) {
	fim('Não existe nenhuma conta com o login "'.$account.'"!');
}

$checkBalance = Donate::checkBalance($account);
if(count($checkBalance) == 0) {
	
	$result = Donate::addBalance($account, $saldo);
	
} else {
	
	$result = Donate::updateBalance($account, $saldo);
	
}

if($result) {
	
	adminLog("Alterou o saldo da conta ".$account." para ".$saldo); // Admin Log
	
	fim('Saldo inserido com sucesso!', 'OK', '?page=balance_list&module=donate');
	
} else {
	
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
	
}

