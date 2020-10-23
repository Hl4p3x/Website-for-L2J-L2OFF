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

require('../private/includes/params.php');

if(!isset($_SERVER['HTTP_USER_AGENT'])) { $_SERVER['HTTP_USER_AGENT'] = ''; }

session_name(md5($_SERVER['HTTP_USER_AGENT'].$uniqueKey.'admin'));
session_cache_expire(60);
session_start();

require('private/functions.php');

require('../private/configs.php');

if(!isset($port)) { $port = ''; }

require('../private/classes/DB.php');
new DB($conMethod, $host, $user, $pass, $dbnm, $port);


if(isset($_GET['logout'])) {
	$_SESSION['pass_adm'] = '';
	$_SESSION['ses_adm'] = '';
	unset($_SESSION['pass_adm']);
	unset($_SESSION['ses_adm']);
	header("Location: ./");
	exit;
}

if(isset($_GET['login'])) {
	
	$pass = md5($_POST['pass']);
	if($pass == md5($admpass)) {
		$_SESSION['ses_adm'] = md5($_SERVER['HTTP_USER_AGENT'].md5($uniqueKey).'adminsession');
		$_SESSION['pass_adm'] = $pass;
		adminLog("Login efetuado com sucesso"); // Admin Log
		fim('Login efetuado com sucesso!', 'OK');
	} else {
		fim('Senha incorreta!');
	}
	
	exit;
}

$admin_access=0;

if(!empty($_SESSION['pass_adm']) && !empty($_SESSION['ses_adm'])) {
	if(md5($_SESSION['pass_adm']) == md5(md5($admpass)) && vCode($_SESSION['ses_adm']) === vCode(md5($_SERVER['HTTP_USER_AGENT'].md5($uniqueKey).'adminsession')) && isset($host) && isset($dbnm) && isset($user) && isset($pass)){
		$admin_access=1;
	} else {
		$_SESSION['pass_adm'] = '';
		$_SESSION['ses_adm'] = '';
		unset($_SESSION['pass_adm']);
		unset($_SESSION['ses_adm']);
		header("Location: ./");
		exit;
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
