<?php

/*

	Devido а grande quantidade de нcones existentes no Lineage 2, eles nгo sгo enviados juntos ao site, mas estгo hospedados numa hospedagem da Atualstudio
	Este script tem como funзгo trazer estes нcones e armazenar no cache para que possam ser carregados rapidamente

*/


$defaultURL = 'http://dev.atualstudio.com/ucp_icons/';
$type = intval($_GET['type']);
$id = intval($_GET['id']);

if($type == '1') {
	$dir = 'itens';
} else if($type == '2') {
	$dir = 'skills';
} else {
	goto FINALERROR;
}

if(!file_exists("../cache")) { @mkdir("../cache", 0775, true); @chmod("../cache", 0775); }
if(!file_exists("../cache/index.html")) { $secIndexFile = fopen("../cache/index.html","w+"); @fclose($secIndexFile); }
if(!file_exists("../cache/.htaccess")) { $secHtacsFile = fopen("../cache/.htaccess","w+"); @fwrite($secHtacsFile, "Options -Indexes"); @fclose($secHtacsFile); }

function SaveImg($img) {
	if(!file_exists($img)) {
		@mkdir($img, 0775, true);
		@chmod($img, 0775);
		
	}
}

if(file_exists('../cache/'.$dir.'_'.$id.'.png')) {
	
	$im = @imagecreatefrompng('../cache/'.$dir.'_'.$id.'.png');
	
} else {
	
	if($id < 1000) {
		$variation = '1-999';
	} else {
		$idLeng = strlen($id);
		$idMult = substr($id, 0, ($idLeng-3));
		$variation = $idMult.'000-'.$idMult.'999';
	}
	
	$im = @imagecreatefrompng($defaultURL.$dir.'/'.$variation.'/'.$id.'.png');
	if(!is_resource($im)) {
		
		unset($im);
		$im = @imagecreatefrompng($defaultURL.$dir.'/'.$variation.'/'.$id.'.png');
		
		if(!is_resource($im)) {
			
			unset($im);
			$im = @imagecreatefrompng($defaultURL.$dir.'/'.$variation.'/'.$id.'.png');
			
			if(!is_resource($im)) {
				goto FINALERROR;
			}
			
		}
	}
}

// Criar imagem
@imagepng($im, '../cache/'.$dir.'_'.$id.'.png');

// Gerar prй-visualizaзгo
header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);

exit;

FINALERROR:

if(isset($im)) {
	unset($im);
}

if(file_exists('../cache/noicon.png')) {
	$im = imagecreatefrompng('../cache/noicon.png');
} else {
	$im = imagecreatefrompng($defaultURL.'noicon.png');
}

// Criar imagem
@imagepng($im, '../cache/noicon.png');

// Gerar prй-visualizaзгo
header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);
