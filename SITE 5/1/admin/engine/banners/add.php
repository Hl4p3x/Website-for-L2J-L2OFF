<?php

$img_pt = !empty($_FILES['img_pt']) ? $_FILES['img_pt'] : '';
$img_en = !empty($_FILES['img_en']) ? $_FILES['img_en'] : '';
$img_es = !empty($_FILES['img_es']) ? $_FILES['img_es'] : '';
$link = !empty($_POST['link']) ? vCode($_POST['link']) : '';
$target = !empty($_POST['target']) ? intval($_POST['target']) : '';
$vis = !empty($_POST['vis']) ? intval($_POST['vis']) : '';

if($target != '1') { $target = '0'; }
if($vis != '1') { $vis = '0'; }

if(strlen($link) > 255){
	fim('Você inseriu um link longo demais! (máximo 255 caracteres)');
}

if(!is_array($img_pt)){
	fim('É obrigatório inserir o banner em português! #1');
}

if(empty($img_pt['name'])){
	fim('É obrigatório inserir o banner em português! #2');
}

$ext = substr($img_pt['name'], -4);
if(substr($ext, 0, 1) != '.') { $ext = '.'.strtolower($ext); }

if($ext != '.jpg' && $ext != '.jpeg' && $ext != '.png') {
	fim('Selecione uma imagem num formato válido!<br />Formatos permitidos: JPG, JPEG e PNG');
}

require('private/wideImage/WideImage.php');

$uploadArq = uploadImagem($img_pt['size'], strtolower($img_pt['type']), $img_pt['tmp_name'], strtolower($img_pt['name']), 4000000, 4000, 4000, '../'.$dir_banners);
if(substr($uploadArq, 0, 3) != '_OK') {
	fim($uploadArq);
} else {
	$imgurl_pt = explode('-', $uploadArq); $imgurl_pt = $imgurl_pt[1];
	$ext = explode('.', $imgurl_pt);
	if(!empty($imgurl_pt)) {
		WideImage::load('../'.$dir_banners.$imgurl_pt)->resize($bnWidth, $bnHeight, 'outside')->crop('center', 'center', $bnWidth, $bnHeight)->saveToFile('../'.$dir_banners.$imgurl_pt, ($ext[1] == 'png' ? 9 : 90));
	}
}


$imgurl_en = '';
if(!empty($img_en['name'])){
	
	$ext = substr($img_en['name'], -4);
	if(substr($ext, 0, 1) != '.') { $ext = '.'.strtolower($ext); }
	
	if($ext != '.jpg' && $ext != '.jpeg' && $ext != '.png') {
		if(file_exists('../'.$dir_banners.$imgurl_pt) && !empty($imgurl_pt)) { @unlink('../'.$dir_banners.$imgurl_pt); }
		fim('Selecione uma imagem num formato válido!<br />Formatos permitidos: JPG, JPEG e PNG');
	}
	
	$uploadArq = uploadImagem($img_en['size'], strtolower($img_en['type']), $img_en['tmp_name'], strtolower($img_en['name']), 4000000, 4000, 4000, '../'.$dir_banners);
	if(substr($uploadArq, 0, 3) != '_OK') {
		if(file_exists('../'.$dir_banners.$imgurl_pt) && !empty($imgurl_pt)) { @unlink('../'.$dir_banners.$imgurl_pt); }
		fim($uploadArq);
	} else {
		$imgurl_en = explode('-', $uploadArq); $imgurl_en = $imgurl_en[1];
		$ext = explode('.', $imgurl_en);
		if(!empty($imgurl_en)) {
			WideImage::load('../'.$dir_banners.$imgurl_en)->resize($bnWidth, $bnHeight, 'outside')->crop('center', 'center', $bnWidth, $bnHeight)->saveToFile('../'.$dir_banners.$imgurl_en, ($ext[1] == 'png' ? 9 : 90));
		}
	}
	
}


$imgurl_es = '';
if(!empty($img_es['name'])){
	
	$ext = substr($img_es['name'], -4);
	if(substr($ext, 0, 1) != '.') { $ext = '.'.strtolower($ext); }
	
	if($ext != '.jpg' && $ext != '.jpeg' && $ext != '.png') {
		if(file_exists('../'.$dir_banners.$imgurl_pt) && !empty($imgurl_pt)) { @unlink('../'.$dir_banners.$imgurl_pt); }
		if(file_exists('../'.$dir_banners.$imgurl_en) && !empty($imgurl_en)) { @unlink('../'.$dir_banners.$imgurl_en); }
		fim('Selecione uma imagem num formato válido!<br />Formatos permitidos: JPG, JPEG e PNG');
	}
	
	$uploadArq = uploadImagem($img_es['size'], strtolower($img_es['type']), $img_es['tmp_name'], strtolower($img_es['name']), 4000000, 4000, 4000, '../'.$dir_banners);
	if(substr($uploadArq, 0, 3) != '_OK') {
		if(file_exists('../'.$dir_banners.$imgurl_pt) && !empty($imgurl_pt)) { @unlink('../'.$dir_banners.$imgurl_pt); }
		if(file_exists('../'.$dir_banners.$imgurl_en) && !empty($imgurl_en)) { @unlink('../'.$dir_banners.$imgurl_en); }
		fim($uploadArq);
	} else {
		$imgurl_es = explode('-', $uploadArq); $imgurl_es = $imgurl_es[1];
		$ext = explode('.', $imgurl_es);
		if(!empty($imgurl_es)) {
			WideImage::load('../'.$dir_banners.$imgurl_es)->resize($bnWidth, $bnHeight, 'outside')->crop('center', 'center', $bnWidth, $bnHeight)->saveToFile('../'.$dir_banners.$imgurl_es, ($ext[1] == 'png' ? 9 : 90));
		}
	}
	
}

require('private/classes/classBanners.php');

$findLast = Banners::findLastBannerPos();
$pos = !empty($findLast[0]['pos']) ? (intval($findLast[0]['pos'])+1) : 1;

$inserir = Banners::insertBanner($imgurl_pt, $imgurl_en, $imgurl_es, $link, $target, $vis, $pos);
if($inserir){
	
	adminLog("Adicionou um banner (ID ".DB::$lastInsertID.")"); // Admin Log
	fim('Banner inserido com sucesso!', 'OK', './?page=list&module=banners');
	
} else {
	
	if(file_exists('../'.$dir_banners.$imgurl_pt) && !empty($imgurl_pt)) { @unlink('../'.$dir_banners.$imgurl_pt); }
	if(file_exists('../'.$dir_banners.$imgurl_en) && !empty($imgurl_en)) { @unlink('../'.$dir_banners.$imgurl_en); }
	if(file_exists('../'.$dir_banners.$imgurl_es) && !empty($imgurl_es)) { @unlink('../'.$dir_banners.$imgurl_es); }
	
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
	
}
