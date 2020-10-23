<?php

/*

	Desenvolvido pela Atualstudio
	www.atualstudio.com
	
	          ##########
	       ################
	    ######          ######
	   #####              #####
	  ####         ....    ####
	 ####        ########  ####
	 ####       ########## ####
	  ####      ########## ####
	  #####       ######## ####
	   #####        ****** ####
	     ######################
	         ################		 
	
	Scripts Version 4.0
	
*/


error_reporting(0);
ini_set('error_reporting', 0);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
ini_set('default_charset', 'UTF-8');
date_default_timezone_set('America/Sao_Paulo');

require('private/params.php');

session_name(md5($_SERVER['HTTP_USER_AGENT'].$uniqueKey));
session_cache_expire(60);
session_start();

require('private/configs.php');

if(file_exists('../private/configs.php') && (!isset($host) || !isset($dbnm) || !isset($user) || !isset($pass))) {
	require('../private/configs.php');
}

$server_url = trim($server_url); $panel_url = trim($panel_url); $dir_gallery = trim($dir_gallery);
if(substr($server_url, 0, 7) == 'http://') { $server_url = substr($server_url, 7); } if(substr($server_url, 0, 8) == 'https://') { $server_url = substr($server_url, 8); } if(substr($server_url, -1) == '/') { $server_url = substr($server_url, 0, -1); }
if(substr($panel_url, 0, 7) == 'http://') { $panel_url = substr($panel_url, 7); } if(substr($panel_url, 0, 8) == 'https://') { $panel_url = substr($panel_url, 8); } if(substr($panel_url, -1) == '/') { $panel_url = substr($panel_url, 0, -1); }
if(substr($dir_gallery, -1) != '/') { $dir_gallery .= '/'; }

if(isset($server_url)) { $dir_gallery = '../'.$dir_gallery; }

function vCode($content) {
	return addslashes(htmlentities(trim(utf8_decode($content)), ENT_QUOTES, 'ISO-8859-1'));
}

if(isset($_GET['changelang'])) {
	switch(strtolower(vCode($_GET['changelang']))) {
		case 'pt': $language = 'pt'; break;
		case 'es': $language = 'es'; break;
		default: $language = 'en';
	}
	setcookie('atualstudio_language', $language, time()+2592000, '/');
	$url = urldecode(addslashes(trim($_GET['url'])));
	if(!empty($url) && strpos($url, 'changelang') === false) {
	    header('Location: '.$url);
	} else {
		header('Location: ./');
	}
	exit;
}

$cookieLang = (!empty($_COOKIE['atualstudio_language']) ? strtolower(vCode($_COOKIE['atualstudio_language'])) : '');
if($cookieLang == 'pt' || $cookieLang == 'en' || $cookieLang == 'es') {
	$language = $cookieLang;
} else {
	switch(strtolower(trim($defaultLang))) {
		case 'pt': $defaultLang = 'pt'; break;
		case 'es': $defaultLang = 'es'; break;
		default: $defaultLang = 'en';
	}
	$nativeLang = strlen(trim($_SERVER["HTTP_ACCEPT_LANGUAGE"])) > 1 ? strtolower(substr(trim($_SERVER["HTTP_ACCEPT_LANGUAGE"]), 0, 2)) : '';
	if(!empty($nativeLang)) {
		switch(strtolower(vCode($nativeLang))) {
			case 'pt': $language = 'pt'; break;
			case 'es': $language = 'es'; break;
			case 'en': $language = 'en'; break;
			default: $language = $defaultLang;
		}
	} else {
		$language = $defaultLang;
	}
	setcookie('atualstudio_language', $language, time()+2592000, '/');
}

require('lang/'.$language.'.php');

require('private/functions.php');

$atualMin = date('i');
if(!isset($_SESSION['minAccess'][$atualMin])) {
	$_SESSION['minAccess'][$atualMin] = 0;
} else if(count($_SESSION['minAccess']) > 1) {
	unset($_SESSION['minAccess']);
	$_SESSION['minAccess'][$atualMin] = 0;
}
if($_SESSION['minAccess'][$atualMin] > 30) {
	echo '<h1>SECURITY BLOCK</h1>'.$LANG[30506].' #001';
	exit;
}
$_SESSION['minAccess'][$atualMin] += 1;


if(!isset($_SESSION['lastAccess'])) { $_SESSION['lastAccess'] = 0; }
if($_SESSION['lastAccess'] > (time() - 3)){
	if(empty($_SESSION['countAccess'])){
		$_SESSION['countAccess'] = 1;
	} elseif($_SESSION['countAccess'] < 5){
		$_SESSION['countAccess'] += 1;
	} elseif($_SESSION['countAccess'] >= 5){
		echo '<h1>SECURITY BLOCK</h1>'.$LANG[30506].' #002';
		exit;
	}
} else {
	$_SESSION['countAccess'] = 1;
}
$_SESSION['lastAccess'] = time();


require('private/classes/DB.php');
new DB($conMethod, $host, $user, $pass, $dbnm);

$logged=0;
if(!empty($_SESSION['acc']) && !empty($_SESSION['ses'])) {
	if(vCode($_SESSION['ses']) === vCode(md5($_SERVER['HTTP_USER_AGENT'].$uniqueKey.'logged'))){
		$_SESSION['acc'] = vCode($_SESSION['acc']);
		$logged=1;
	} else {
		require("private/classes/classAccess.php");
		Access::logout();
	}
}

$indexing=1;

$p = isset($_GET['page']) ? vCode($_GET['page']) : 'index';

if(isset($_GET['engine'])) {
	$p = vCode($_GET['engine']);
	$isEngine=1;
}

if(!preg_match("/^[a-zA-Z0-9_-]{1,25}$/", $p)) { $p = '404'; }

$m = isset($_GET['module']) ? vCode($_GET['module']) : '';
if(!empty($m)) {
	if(preg_match("/^[a-zA-Z0-9_-]{1,25}$/", $m)) {
		$m = $m.'/';
	} else {
		$m = '';
	}
}

if(!isset($isEngine)) {
	
	if(file_exists('pages/'.$m.$p.'.php')) {
		$p = $m.$p;
	} else {
		$p = '404';
	}
	
} else {
	
	if(file_exists('engine/'.$m.$p.'.php')) {
		require('engine/'.$m.$p.'.php');
		exit;
	} else {
		$p = '404';
	}

}

require('private/layout.php');

@DB::close();
