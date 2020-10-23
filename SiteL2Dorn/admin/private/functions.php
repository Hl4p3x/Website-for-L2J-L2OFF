<?php

function vCode($content) {
	return addslashes(htmlentities(trim(utf8_decode($content)), ENT_QUOTES, 'ISO-8859-1'));
}

function atualAlert($msg, $msg_link='') {
	$filterBR = array('&lt;br /&gt;' => '<br />', '&lt;br&gt;' => '<br />', '&lt;b&gt;' => '<b>', '&lt;/b&gt;' => '</b>', '\\n' => '<br />');
	return "<script>atualAlert('".strtr(addslashes(htmlentities(trim($msg), ENT_QUOTES, 'ISO-8859-1')), $filterBR)."', '".$msg_link."');</script>";
}

function fim($msg='', $act='', $url='') {
	if(isset($_POST['isJS'])) {
	    die(json_encode(array('msg' => $msg, 'act' => $act, 'url' => $url)));
	} else {
		if(!empty($msg)) { $_SESSION['aAlert_msg'] = $msg; $_SESSION['aAlert_act'] = $act; }
		echo "<script type='text/javascript'>".(!empty($url) ? "document.location.replace('".$url."');" : "history.back();")."</script>";
	}
	exit;
}


function adminLog($text) {
	DB::Executa("INSERT INTO site_log_admin (log_value, log_ip, log_date) VALUES ('".vCode($text)."', '".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d H:i:s', time())."')"); // Admin Log
}


function save_preco($price) {
	// Retorna o preço num formato válido para ser salvo no banco de dados
	if(count(explode(',', $price)) < 2) { $price = $price.',00'; } $price = str_replace('.', '', $price); $price = str_replace(',', '.', $price); return number_format($price, 2, '.', '');
}

function uploadImagem($size, $type, $tname, $name, $maxSize, $maxWidth, $maxHeight, $dir) {
	if($size > $maxSize) { return "A imagem ultrapassa o tamanho permitido! (".$maxSize." bytes)"; }
	if($type != 'image/jpg' && $type != 'image/jpeg' && $type != 'image/png') { return "Só é permitido imagem JPG/JPEG ou PNG! #1"; }
	$getImage = @getimagesize($tname); $imgType = $getImage['mime']; $imgWidth = $getImage['0']; $imgHeight = $getImage['1'];
	if($imgType != 'image/jpg' && $imgType != 'image/jpeg' && $imgType != 'image/png') { return "Só é permitido imagem JPG/JPEG ou PNG! #2"; }
	if($imgWidth > $maxWidth) { return "A imagem tem largura maior que ".$maxWidth."px!"; }
	if($imgHeight > $maxHeight) { return "A imagem tem altura maior que ".$maxHeight."px!"; }
	$ext = explode('.', $name); if(count($ext) > 1) { $ext = $ext[(count($ext)-1)]; } else { $ext = ""; }
	if($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png') { return "Só é permitido imagem JPG/JPEG ou PNG! #3"; }
	$arqName = md5(time().$name).'.'.$ext;
	if(move_uploaded_file($tname, $dir.$arqName)) { return "_OK-".$arqName; } else { return "Erro ao enviar imagem!"; }
}

function obtainCurrencySymbol($moeda) {
	switch($moeda) {
		case 'BRL': return 'R$'; break;
		case 'USD': return '$'; break;
		case 'EUR': return '€'; break;
		default: return '$';
	}
}

function obtainOrderStatusName($status) {
	switch($status) {
		case 1: return 'Pendente'; break; // Pendente
		case 2: return 'Deleted'; break; // Excluída (não aparece em nenhum local)
		case 3: return 'Pago'; break; // Pago
		case 4: return 'Entregue'; break; // Entregue
		case 5: return 'Cancelada'; break; // Cancelada
		default: return 'Pendente'; break; // Pendente
	}
}
