<?php

$nome = vCode($_POST['nome']);
$data = time();

if(empty($nome)) {
	fim('Por favor, insira o nome da categoria!');
}

if(strlen($nome) > 70) {
	fim('Você ultrapassou a quantidade de caracteres permitidos!');
}

require('private/classes/classShop.php');

$checkCatNameExists = Shop::checkCatNameExists($nome);
if(count($checkCatNameExists) > 0) {
	fim('Já existe uma categoria com esse nome!');
}

$findLastCat = Shop::findLastCat();
$newCatOrdem = intval(!empty($findLastCat[0]['ordem']) ? $findLastCat[0]['ordem'] : 0)+1;

$inserir = Shop::insertCat($nome, $newCatOrdem, $data);
if($inserir){
	adminLog("Cadastrou uma nova categoria (ID ".DB::$lastInsertID.") ao shop"); // Admin Log
	fim('Categoria cadastrada com sucesso!', 'OK', '?page=cat_list&module=shop');
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}