<?php

$link = !empty($_POST['link']) ? vCode($_POST['link']) : '';
$vis = !empty($_POST['vis']) ? intval($_POST['vis']) : '';

if($vis != '1') { $vis = '0'; }

if(strlen($link) > 255){
	fim('Você inseriu um link longo demais! (máximo 255 caracteres)');
}

if(strpos($link, 'v=') !== false) {
	
	$xpld1 = explode('v=', $link);
	$xpld2 = explode('&', $xpld1[1]);
	$VID = $xpld2[0];
	
} else if(strpos($link, 'youtu.be/') !== false) {
	
	$xpld1 = explode('youtu.be/', $link);
	$xpld2 = explode('/', $xpld1[1]);
	$VID = $xpld2[0];
	
} else if(strpos($link, 'embed/') !== false) {
	
	$xpld1 = explode('embed/', $link);
	$xpld2 = explode('"', $xpld1[1]);
	$VID = $xpld2[0];
	
} else {
	
	$VID = $link;
	
}

if(strlen($VID) < 8 || strlen($VID) > 14){
	fim('Link irregular! Por favor, informe o link correto!');
}

$thumbUrl = "http://img.youtube.com/vi/".$VID."/mqdefault.jpg";

require('private/wideImage/WideImage.php');
@WideImage::load($thumbUrl)->resize(150, 150, 'outside')->crop('center', 'center', 150, 150)->saveToFile('../'.$dir_gallery.'thumbnail/'.$VID.'.jpg', 90);

require('private/classes/classGallery.php');

@Gallery::reorderAllGallery();

$inserir = Gallery::insertGallery($VID, 1, 1, $vis);
if($inserir){
	adminLog("Adicionou um vídeo à galeria (ID ".DB::$lastInsertID.")"); // Admin Log
	fim('Vídeo adicionado com sucesso!', 'OK', './?page=list&module=gallery');
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}
