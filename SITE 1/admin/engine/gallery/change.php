<?php

$vis = (!empty($_POST['vis']) ? intval($_POST['vis']) : (!empty($_GET['vis']) ? intval($_GET['vis']) : ''));

if($vis != '1') { $vis = '0'; }

$gid = !empty($_GET['gid']) ? intval($_GET['gid']) : 0;

require('private/classes/classGallery.php');

$findGallery = Gallery::findGallery($gid);
if(count($findGallery) == 0){
	fim('Item inexistente na galeria!');
}

$inserir = Gallery::editGallery($gid, $vis);
if($inserir){
	adminLog("Editou ".($findGallery[0]['isvideo'] == '1' ? "um vídeo" : "uma imagem")." da galeria (ID ".$gid.")"); // Admin Log
	fim('Edição efetuada com sucesso!', 'OK', './?page=list&module=gallery');
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}
