<?php

if(!$indexing) { exit; }

$lkey = isset($_POST['lkey']) ? vCode($_POST['lkey']) : '';
if($lkey != $_SESSION['lkey']) { fim('', 'SESSION', './'); }

if(empty($_POST['ucp_login']) || empty($_POST['ucp_passw']) || empty($_POST['captcha'])) {
	fim($LANG[12058]);
}

$user_login = vCode($_POST['ucp_login']);
$user_passw = addslashes(trim(utf8_decode($_POST['ucp_passw'])));

$captcha = vCode($_POST['captcha']);
require('captcha/securimage.php');
$securimage = new Securimage();
if($securimage->check($captcha) == false) {
	fim($LANG[11979]);
}

require_once('private/classes/classAccess.php');

$login = Access::login($user_login, $user_passw);
if($login) {
	
	@Access::registerAccess($user_login);
	
	$_SESSION['acc'] = $user_login;
	$_SESSION['ses'] = md5($_SERVER['HTTP_USER_AGENT'].$uniqueKey.'logged');
	
	if(isset($_GET['fromsite'])) {
		fim('', 'OK', './ucp/');
	} else {
		fim('', 'OK', './');
	}

} else {
	
	fim($LANG[11990]);
	
}
