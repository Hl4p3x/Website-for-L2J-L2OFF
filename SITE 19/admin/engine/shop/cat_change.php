<?php

$cat = !empty($_GET['cat']) ? intval($_GET['cat']) : 0;

$nome = vCode($_POST['nome']);
$data = time();

if(empty($nome)) {
	fim('Por favor, insira o nome da categoria!');
}

if(strlen($nome) > 70) {
	fim('Você ultrapassou a quantidade de caracteres permitidos!');
}

require('private/classes/classShop.php');

$checkCatNameExists = Shop::checkCatNameExists($nome, $cat);
if(count($checkCatNameExists) > 0) {
	fim('Já existe uma outra categoria com esse nome!');
}

$update = Shop::updateCat($cat, $nome);
if($update) {
	adminLog("Alterou a categoria de ID ".$cat." do shop"); // Admin Log
	fim('Categoria alterada com sucesso!', 'OK', '?page=cat_list&module=shop');
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}

