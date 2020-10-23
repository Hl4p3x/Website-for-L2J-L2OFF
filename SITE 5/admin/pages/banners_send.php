<?php

if(!$indexing) { exit; }

if(strlen($_FILES['imgupd']['name']) == 0) {
	echo "<script type='text/javascript'>alert('É necessário inserir o banner obrigatório!');history.back();</script>";
	exit;
}

$extensao = substr($_FILES['imgupd']['name'], -4);
if(substr($extensao, 0, 1) != '.') { $extensao = '.'.$extensao; }

$extensao = strtolower($extensao);

if(
($extensao != '.jpg')&&
($extensao != '.jpeg')&&
($extensao != '.gif')&&
($extensao != '.png')
) {
	echo "<script type='text/javascript'>alert('A imagem deve ter um dos seguintes formatos: JPG, JPEG, PNG e GIF!');history.back();</script>";
	exit;
}

$nomeMD5 = md5(time().rand());
$arquivo = $nomeMD5.$extensao;

if(move_uploaded_file($_FILES['imgupd']['tmp_name'], '../'.DIRBAN.$arquivo)){

	if(isset($_POST['bannerlink'])) {
		$bannerlink = vCode($_POST['bannerlink']);
	}

	if(isset($_POST['linktarget'])) {
		$linktarget = vCode($_POST['linktarget']);
	}

	if(!isset($bannerlink)) { $bannerlink = ''; }
	if(!isset($linktarget)) { $linktarget = '0'; }
	if($linktarget != '1') { $linktarget = '0'; }

	$arquivo_EN = '';
	if(strlen($_FILES['imgupd_en']['name']) != 0) {

		$extensao_EN = substr($_FILES['imgupd_en']['name'], -4);
		if(substr($extensao_EN, 0, 1) != '.') { $extensao_EN = '.'.$extensao_EN; }

		if(($extensao_EN != '.jpg')&&($extensao_EN != '.jpeg')&&($extensao_EN != '.gif')&&($extensao_EN != '.png')) {
			echo "<script type='text/javascript'>alert('O processo irá continuar normalmente, mas o banner inglês não foi enviado pois a imagem deve ter um dos seguintes formatos: JPG, JPEG, PNG e GIF!');</script>";
		} else {
			$arquivo_EN = $nomeMD5.'_en'.$extensao_EN;
			if(!move_uploaded_file($_FILES['imgupd_en']['tmp_name'], '../'.DIRBAN.$arquivo_EN)){
				echo "<script type='text/javascript'>alert('O processo irá continuar normalmente, mas ocorreu um erro ao enviar o banner inglês!');</script>";
			}

		}

	}

	$arquivo_ES = '';
	if(strlen($_FILES['imgupd_es']['name']) != 0) {

		$extensao_ES = substr($_FILES['imgupd_es']['name'], -4);
		if(substr($extensao_ES, 0, 1) != '.') { $extensao_ES = '.'.$extensao_ES; }

		if(($extensao_ES != '.jpg')&&($extensao_ES != '.jpeg')&&($extensao_ES != '.gif')&&($extensao_ES != '.png')) {
			echo "<script type='text/javascript'>alert('O processo irá continuar normalmente, mas o banner espanhol não foi enviado pois a imagem deve ter um dos seguintes formatos: JPG, JPEG, PNG e GIF!');</script>";
		} else {

			$arquivo_ES = $nomeMD5.'_es'.$extensao_ES;
			if(!move_uploaded_file($_FILES['imgupd_es']['tmp_name'], '../'.DIRBAN.$arquivo_ES)){
				echo "<script type='text/javascript'>alert('O processo irá continuar normalmente, mas ocorreu um erro ao enviar o banner espanhol!');</script>";
			}

		}

	}

	$countBanners = mysql_num_rows(mysql_query("SELECT * FROM ".DBNAME.".site_banners", $conexao));
	$insertBanner = mysql_query("INSERT INTO ".DBNAME.".site_banners (b_id, b_position, b_link, b_target, b_id_en, b_id_es) VALUES ('".$arquivo."', '".($countBanners+1)."', '".$bannerlink."', '".$linktarget."', '".$arquivo_EN."', '".$arquivo_ES."')", $conexao);
	if($insertBanner == 1) {
		echo "<script type='text/javascript'>document.location.replace('?id=banners&success');</script>";
	} else {
		echo "<script type='text/javascript'>alert('Ops, ocorreu algum erro! Entre em contato com a Atualstudio!');history.back();</script>";
	}


} else {
	echo "<script type='text/javascript'>alert('Ocorreu um erro ao enviar a imagem! Por favor, verifique o tamanho e formato e tente novamente.');history.back();</script>";
}
