<?php

if(!isset($indexing)) { exit; }

if(isset($_GET['eConf']) && isset($_GET['lConf'])) {
	
	$email = vCode(base64_decode(urldecode($_GET['eConf'])));
	$login = vCode(base64_decode(urldecode($_GET['lConf'])));
	
	if(!isset($_SESSION['download_key'])) { $_SESSION['download_key']=''; }
	$doKey = $_SESSION['download_key'];
	$_SESSION['download_key']=''; unset($_SESSION['download_key']);
	
	$file = "cache/".$LANG[29008]." (".$login.").txt";
	if(file_exists($file) && $doKey == md5($login.$uniqueKey)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($file).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		readfile($file);
		if(strlen($file) > 5) {
			unlink($file);
		}
	} else {
		header('Location: ./');
	}
	
}