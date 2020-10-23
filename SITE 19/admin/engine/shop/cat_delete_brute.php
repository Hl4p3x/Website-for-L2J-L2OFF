<?php

$cat = !empty($_GET['cat']) ? intval($_GET['cat']) : 0;

require('private/classes/classShop.php');

$consulta = Shop::findCat($cat);
if(count($consulta) == 0){
	fim('Categoria inexistente!');
}

$delete = Shop::deleteCatPermanent($cat);
if($delete) {
	adminLog("Excluiu do shop a categoria de ID ".$cat." e todos os seus pacotes"); // Admin Log
	fim('Categoria excluída com sucesso!', 'OK', './?page=cat_list&module=shop');
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}
