<?php

$cat = !empty($_GET['cat']) ? intval($_GET['cat']) : 0;
$newCat = !empty($_POST['newCat']) ? intval($_POST['newCat']) : 0;

require('private/classes/classShop.php');

$consulta1 = Shop::findCat($cat);
if(count($consulta1) == 0){
	fim('Categoria inexistente!');
}

$consulta2 = Shop::findCat($newCat);
if(count($consulta2) == 0){
	fim('Categoria inexistente!');
}

$delete = Shop::deleteCat($cat, $newCat);
if($delete) {
	adminLog("Excluiu do shop a categoria de ID ".$cat." e moveu todos os pacotes para a de ID ".$newCat); // Admin Log
	fim('Categoria excluída com sucesso!', 'OK', './?page=cat_list&module=shop');
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}
