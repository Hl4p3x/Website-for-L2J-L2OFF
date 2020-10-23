<?php

$item = !empty($_GET['item']) ? intval($_GET['item']) : 0;
$pack = !empty($_GET['pack']) ? intval($_GET['pack']) : 0;

require('private/classes/classShop.php');

$consulta1 = Shop::findPack($pack);
if(count($consulta1) == 0){
	fim('Pacote inexistente!');
}

$consulta2 = Shop::findItem($item);
if(count($consulta2) == 0){
	fim('Item inexistente!');
}

$delete = Shop::deleteItem($item);
if($delete) {
	adminLog("Excluiu o item de ID ".$item." do pacote de ID ".$pack." do shop"); // Admin Log
	fim('Item excluído com sucesso!', 'OK', './?page=pack_change&module=shop&pack='.$pack.'&lupd='.time().'#itens');
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}
