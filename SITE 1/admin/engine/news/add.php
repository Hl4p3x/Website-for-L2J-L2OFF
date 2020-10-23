<?php

$post_date = !empty($_POST['post_date']) ? vCode($_POST['post_date']) : '';
$post_hour = !empty($_POST['post_hour']) ? vCode($_POST['post_hour']) : '';
$vis = !empty($_POST['vis']) ? vCode($_POST['vis']) : '';
$title_pt = !empty($_POST['title_pt']) ? vCode($_POST['title_pt']) : '';
$content_pt = !empty($_POST['content_pt']) ? addslashes(trim($_POST['content_pt'])) : '';
$title_en = !empty($_POST['title_en']) ? vCode($_POST['title_en']) : '';
$content_en = !empty($_POST['content_en']) ? addslashes(trim($_POST['content_en'])) : '';
$title_es = !empty($_POST['title_es']) ? vCode($_POST['title_es']) : '';
$content_es = !empty($_POST['content_es']) ? addslashes(trim($_POST['content_es'])) : '';

if($vis != '1') { $vis = '0'; }

if(empty($post_date) || empty($post_hour) || empty($title_pt) || empty($content_pt)){
	fim('É obrigatório informar a data, hora e a notícia em português!');
}

if(!preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $post_date)) {
	fim('A data está num formato inválido!');
}

if(!preg_match("/[0-9]{2}\:[0-9]{2}/", $post_hour)) {
	fim('A hora está num formato inválido!');
}

if(strlen($title_pt) > 150){
	fim('Você ultrapassou a quantidade de caracteres permitidos!');
}

if(!empty($title_en)){
	if(strlen($title_en) > 150){
		fim('Você ultrapassou a quantidade de caracteres permitidos!');
	}
}

if(!empty($title_es)){
	if(strlen($title_es) > 150){
		fim('Você ultrapassou a quantidade de caracteres permitidos!');
	}
}

$e_date = explode('/', $post_date);
$e_hour = explode(':', $post_hour);
$e_dia = $e_date[0];
$e_mes = $e_date[1];
$e_ano = $e_date[2];
$e_hr = $e_hour[0];
$e_min = $e_hour[1];
$post_date = mktime($e_hr, $e_min, '0', $e_mes, $e_dia, $e_ano);

if(!empty($_FILES['img']['tmp_name'])) {
	$uploadArq = uploadImagem($_FILES['img']['size'], strtolower($_FILES['img']['type']), $_FILES['img']['tmp_name'], strtolower($_FILES['img']['name']), 4000000, 4000, 4000, '../'.$dir_newsimg);
	if(substr($uploadArq, 0, 3) != '_OK') {
		fim($uploadArq);
	} else {
		$imagem = explode('-', $uploadArq); $imagem = $imagem[1];
		$ext = explode('.', $imagem);
		if(!empty($imagem)) {
			require('private/wideImage/WideImage.php');
			WideImage::load('../'.$dir_newsimg.$imagem)->resize(142, 142, 'outside')->crop('center', 'center', 142, 142)->saveToFile('../'.$dir_newsimg.$imagem, ($ext[1] == 'png' ? 9 : 90));
		}
	}
} else {
	$imagem = '';
}

require('private/classes/classNews.php');

$inserir = News::insertNew($post_date, $vis, $title_pt, $content_pt, $title_en, $content_en, $title_es, $content_es, $imagem);
if($inserir){
	adminLog("Adicionou uma notícia (ID ".DB::$lastInsertID.")"); // Admin Log
	fim('Notícia inserida com sucesso!', 'OK', './?page=list&module=news');
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}

