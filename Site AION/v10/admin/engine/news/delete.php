<?php

$nid = !empty($_GET['nid']) ? intval($_GET['nid']) : 0;

require('private/classes/classNews.php');

$findNew = News::findNew($nid);
if(count($findNew) == 0){
	fim('Notícia inexistente!');
}

$delete = News::deleteNew($nid);
if($delete) {
	if(file_exists('../'.$dir_newsimg.$findNew[0]['img']) && !empty($findNew[0]['img'])) {
		unlink('../'.$dir_newsimg.$findNew[0]['img']);
	}
	adminLog("Excluiu a notícia de ID ".$nid); // Admin Log
	fim('Notícia excluída com sucesso!', 'OK', './?page=list&module=news');
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}
