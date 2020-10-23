<?php

$protocolo 	= !empty($_GET['protocolo']) ? intval($_GET['protocolo']) : 0;

require('private/classes/classDonate.php');

$consulta = Donate::findDonation($protocolo);
if(count($consulta) == 0){
	fim('Doação inexistente!');
}

$delete = Donate::deleteDonation($protocolo);
if($delete) {
	adminLog("Excluiu a doação de protocolo ".$protocolo); // Admin Log
	fim('Doação excluída com sucesso!', 'OK', './?page=list_all&module=donate');
} else {
	fim('Desculpe, ocorreu algum erro! Tente novamente.');
}
