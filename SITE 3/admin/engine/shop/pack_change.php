<?php

$pack = !empty($_GET['pack']) ? intval($_GET['pack']) : 0;

$nome = vCode($_POST['nome']);
$cat = intval($_POST['scat_id']);
$valor = intval(trim($_POST['valor']));
$data = time();

if(empty($nome) || empty($cat)){
	fim('Por favor, preencha todos os campos do formulário!');
}

if(strlen($nome) > 70) {
	fim('Você ultrapassou a quantidade de caracteres permitidos! #1');
}

if(strlen($valor) > 11) {
	fim('Você ultrapassou a quantidade de caracteres permitidos! #2');
}

require('private/classes/classShop.php');

$findPack = Shop::findPack($pack);
if(count($findPack) == 0) {
	fim('Pacote inexistente!');
}

$findCat = Shop::findCat($cat);
if(count($findCat) == 0) {
	fim('Categoria inexistente!');
}

$checkPackNameExists = Shop::checkPackNameExists($nome, $pack);
if(count($checkPackNameExists) > 0) {
	fim('Já existe outro pacote com esse nome!');
}

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

$update = Shop::updatePack($pack, $nome, $cat, $imagem, $data, $valor);
if($update) {

	// Caso exista uma imagem antiga, vamos excluí-la!
	if(!empty($imagem) && !empty($findPack[0]['imagem']) && file_exists($admref_ucp.'imgs/shop/'.$findPack[0]['imagem'])) {
		unlink($admref_ucp.'imgs/shop/'.$findPack[0]['imagem']);
	}
	
	adminLog("Alterou o pacote de ID ".$pack." do shop"); // Admin Log

	fim('Pacote alterado com sucesso!', 'OK', '?page=pack_list&module=shop');

} else {

	// Houve um erro ao efetuar o update, então vamos excluir a nova imagem que já foi feita upload...
	if(!empty($imagem) && file_exists($admref_ucp.'imgs/shop/'.$imagem)) {
		unlink($admref_ucp.'imgs/shop/'.$imagem);
	}

	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');

}

