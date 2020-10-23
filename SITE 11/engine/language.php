<?

if(isset($_GET['changelang'])) {

	$cookieLang = vCode(trim($_GET['changelang']));
	if($cookieLang == 'pt') { $language = 'pt'; }
	elseif($cookieLang == 'es') { $language = 'es'; }
	else { $language = 'en'; }
	
	setcookie("atualstudio_language", $language, time()+2592000, '/');
	
	$url = urldecode(addslashes(trim($_GET['url'])));
	if(!empty($url)) {
		if(strpos($url, 'changelang') === false) {
		    header("Location: ".$url);
		    exit;
		}
	}
	header("Location: ./");
	exit;

}

$cookieLang = isset($_COOKIE['atualstudio_language']) ? trim(vCode($_COOKIE['atualstudio_language'])) : '';

if($cookieLang == 'pt' || $cookieLang == 'en' || $cookieLang == 'es') {
	
	$language = $cookieLang;
	
} else {
	
	$nativeLang = strlen(trim($_SERVER["HTTP_ACCEPT_LANGUAGE"])) > 1 ? substr(trim($_SERVER["HTTP_ACCEPT_LANGUAGE"]), 0, 2) : '';
	
	if(!empty($nativeLang)) {
		
		if($nativeLang == 'pt') { $language = 'pt'; }
		elseif($nativeLang == 'es') { $language = 'es'; }
		else { $language = 'en'; }
		
		if(!isset($_COOKIE['atualstudio_language'])) {
			setcookie("atualstudio_language", $language, time()+2592000, '/');
		}
		
	} else {
		
		$language = 'en';
		if(!isset($_COOKIE['atualstudio_language'])) {
			setcookie("atualstudio_language", $language, time()+2592000, '/');
		}
	
	}
	
}

if(file_exists('lang/'.$language.'.php')) {
	require('lang/'.$language.'.php');
} else {
	require('../lang/'.$language.'.php');
}

