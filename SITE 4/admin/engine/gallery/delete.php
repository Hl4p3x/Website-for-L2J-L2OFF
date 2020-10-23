<?php

$gid = !empty($_GET['gid']) ? intval($_GET['gid']) : 0;

require('private/classes/classGallery.php');

$findGallery = Gallery::findGallery($gid);
if(count($findGallery) == 0){
	fim('Item inexistente na galeria!');
}

$delete = Gallery::deleteGallery($gid);
if($delete) {
	
	if(file_exists('../'.$dir_gallery.$findGallery[0]['url']) && !empty($findGallery[0]['url'])) {
		@unlink('../'.$dir_gallery.$findGallery[0]['url']);
	}
	
	if(file_exists('../'.$dir_gallery.'thumbnail/'.$findGallery[0]['url']) && !empty($findGallery[0]['url'])) {
		@unlink('../'.$dir_gallery.'thumbnail/'.$findGallery[0]['url']);
	}
	
	$withJPG = $findGallery[0]['url'].'.jpg';
	if(file_exists('../'.$dir_gallery.'thumbnail/'.$withJPG) && !empty($findGallery[0]['url'])) {
		@unlink('../'.$dir_gallery.'thumbnail/'.$withJPG);
	}
	
	adminLog("Excluiu da galeria ".($findGallery[0]['isvideo'] == '1' ? "o vídeo" : "a imagem")." de ID ".$gid); // Admin Log
	fim('Exclusão efetuada com sucesso!', 'OK', './?page=list&module=gallery');
	
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}
