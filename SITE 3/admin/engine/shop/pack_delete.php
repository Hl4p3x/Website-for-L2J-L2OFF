<?php

$pack = !empty($_GET['pack']) ? intval($_GET['pack']) : 0;
$newPack = !empty($_POST['newPack']) ? intval($_POST['newPack']) : 0;

require('private/classes/classShop.php');

$consulta1 = Shop::findPack($pack);
if(count($consulta1) == 0){
	fim('Pacote inexistente!');
}

$consulta2 = Shop::findPack($newPack);
if(count($consulta2) == 0){
	fim('Pacote inexistente!');
}

$delete = Shop::deletePack($pack, $newPack);
if($delete) {

	if(!empty($consulta1[0]['imagem']) && file_exists($admref_ucp.'imgs/shop/'.$consulta1[0]['imagem'])) {
		unlink($admref_ucp.'imgs/shop/'.$consulta1[0]['imagem']);
	}
	
	adminLog("Excluiu o pacote de ID ".$pack." e moveu seus itens para o pacote de ID ".$newPack." no shop"); // Admin Log

	fim('Pacote excluído com sucesso!', 'OK', './?page=pack_list&module=shop');

} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}
