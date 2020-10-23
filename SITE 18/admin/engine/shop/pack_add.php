<?php

$nome = vCode($_POST['nome']);
$cat = intval($_POST['scat_id']);
$valor = intval(trim($_POST['valor']));
$data = time();

if(empty($nome)|| empty($cat)){
	fim('Por favor, preencha todos os campos do formulário!');
}

if(strlen($nome) > 70) {
	fim('Você ultrapassou a quantidade de caracteres permitidos! #1');
}

if(strlen($valor) > 11) {
	fim('Você ultrapassou a quantidade de caracteres permitidos! #2');
}

require('private/classes/classShop.php');

$checkPackNameExists = Shop::checkPackNameExists($nome);
if(count($checkPackNameExists) > 0) {
	fim('Já existe um pacote com esse nome!');
}

$findCat = Shop::findCat($cat);
if(count($findCat) == 0) {
	fim('Categoria inválida!');
}

$findLastPack = Shop::findLastPack();
$newCatOrdem = intval(!empty($findLastPack[0]['ordem']) ? $findLastPack[0]['ordem'] : 0)+1;

if(!empty($_FILES['imagem']['tmp_name'])) {
	$uploadArq = uploadImagem($_FILES['imagem']['size'], strtolower($_FILES['imagem']['type']), $_FILES['imagem']['tmp_name'], strtolower($_FILES['imagem']['name']), 4000000, 4000, 4000, $admref_ucp.'imgs/shop/');
	if(substr($uploadArq, 0, 3) != '_OK') {
		fim($uploadArq);
	} else {
		$imagem = explode('-', $uploadArq); $imagem = $imagem[1];
		$ext = explode('.', $imagem);
		if(!empty($imagem)) {
			require('private/wideImage/WideImage.php');
			WideImage::load($admref_ucp.'imgs/shop/'.$imagem)->resize(140, 140, 'outside')->crop('center', 'center', 140, 140)->saveToFile($admref_ucp.'imgs/shop/'.$imagem, ($ext[1] == 'png' ? 9 : 90));
		}
	}
} else {
	$imagem = '';
}

$inserir = Shop::insertPack($nome, $imagem, $newCatOrdem, $data, $cat, $valor);
if($inserir){
	adminLog("Criou um novo pacote (ID ".DB::$lastInsertID.") no shop"); // Admin Log
	fim('Pacote criado com sucesso!', 'OK', './?page=pack_list&module=shop');
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}

