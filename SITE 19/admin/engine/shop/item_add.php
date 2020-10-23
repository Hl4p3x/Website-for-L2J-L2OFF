<?php

$id_ingame = intval(trim($_POST['id_ingame']));
$pack = intval($_POST['spack_id']);
$nome = vCode($_POST['nome']);
$sa = vCode($_POST['sa']);
$valor = intval(trim($_POST['valor']));
$amount = intval(trim($_POST['amount']));
$cumulativo = intval($_POST['cumulativo']);
$enchant = intval($_POST['enchant']);
$data = time();

if($cumulativo != 1) { $cumulativo = '0'; }

if(empty($id_ingame) || empty($pack) || empty($nome) || empty($valor) || empty($amount)) {
	fim('Por favor, preencha todos os campos do formulário!');
}

if(strlen($id_ingame) > 11) {
	fim('Você ultrapassou a quantidade de caracteres permitidos! #1');
}

if($amount > 2147483647) {
	fim('Você ultrapassou a quantidade máxima permitida! O máximo é 2147483647!');
}

if(strlen($nome) > 70) {
	fim('Você ultrapassou a quantidade de caracteres permitidos! #2');
}

if(!empty($sa)) {
	if(strlen($sa) > 40) {
		fim('Você ultrapassou a quantidade de caracteres permitidos! #4');
	}
}

if(strlen($valor) > 11) {
	fim('Você ultrapassou a quantidade de caracteres permitidos! #3');
}

if(strlen($enchant) > 5) {
	fim('Você ultrapassou a quantidade de caracteres permitidos! #5');
}

require('private/classes/classShop.php');

$findPack = Shop::findPack($pack);
if(count($findPack) == 0) {
	fim('Pacote inexistente!');
}

$findLastItem = Shop::findLastItem();
$newCatOrdem = intval(!empty($findLastItem[0]['ordem']) ? $findLastItem[0]['ordem'] : 0)+1;

$inserir = Shop::insertItem($id_ingame, $pack, $nome, $amount, $cumulativo, $sa, $enchant, $valor, $newCatOrdem, $data);
if($inserir){
	adminLog("Adicionou um item (ID ".DB::$lastInsertID.") ao pacote de ID ".$pack." do shop"); // Admin Log
	fim('Item cadastrado com sucesso!', 'OK', './?page=pack_change&module=shop&pack='.$pack.'&lupd='.time().'#itens');
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}

