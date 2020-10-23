<?php

$pack = !empty($_GET['pack']) ? intval($_GET['pack']) : 0;

require('private/classes/classShop.php');

$findPack = Shop::findPack($pack);
if(count($findPack) == 0){
	fim('Pacote inexistente!');
}

$delete = Shop::deletePackPermanent($pack);
if($delete) {

	if(!empty($findPack[0]['imagem']) && file_exists($admref_ucp.'imgs/shop/'.$findPack[0]['imagem'])) {
		unlink($admref_ucp.'imgs/shop/'.$findPack[0]['imagem']);
	}
	
	adminLog("Excluiu o pacote de ID ".$pack." e todos os seus itens no shop"); // Admin Log

	fim('Pacote excluído com sucesso!', 'OK', './?page=pack_list&module=shop');

} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}
