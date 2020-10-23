<?php

if(!is_array($_POST['item'])) { fim('Desculpe, ocorreu alguma falha inesperada! Por favor, atualize a página e tente novamente. #1'); }

require('private/classes/classGallery.php');

$itens = $_POST['item'];

$erros = 0;
$i = 1;
foreach ($itens as $itemID) {
	if(!Gallery::reorder($i, intval($itemID))) {
		$erros += 1;
	} else {
		$i += 1;
	}
}

if($erros == 0) {
	adminLog("Reordenou os itens da galeria!"); // Admin Log
	fim('', 'OK');
} else {
	fim('Desculpe, ocorreu alguma falha inesperada! Por favor, atualize a página e tente novamente. #2');
}