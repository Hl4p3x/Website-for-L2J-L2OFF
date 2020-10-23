<?php

if(!isset($indexing)) { exit; }

$key = isset($_POST['key']) ? vCode($_POST['key']) : '';
if($key != $_SESSION['key']) { fim('', 'SESSION', './?page=forgot'); }

$email = strtolower(vCode($_POST['email']));

if(empty($email)) {
	fim($LANG[12059]);
}

if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)) {
	fim($LANG[12060]);
}

if($captcha_forgotpass_on == 1) {
	$captcha = vCode($_POST['captcha']);
	require_once('captcha/securimage.php');
	$securimage = new Securimage();
	if($securimage->check($captcha) == false) {
		fim($LANG[12057]);
	}
}

if(!empty($_COOKIE['atualstudio_forgot'])) {
	if(strtolower(vCode($_COOKIE['atualstudio_forgot'])) == $email) {
		fim($LANG[12041].' <b>'.$email.'</b> <br />'.$LANG[12042].' #2', 'OK');
	}
}

require('private/classes/classAccount.php');

$checkEmail = Account::checkEmailExists($email);

if(count($checkEmail) == 0) {
	fim($LANG[12061]);
}

if(count($checkEmail) == 1) {
	$contentEmail = $LANG[12110];
} else {
	$contentEmail = $LANG[12111];
}

$error = 0;

for($i=0, $c=count($checkEmail); $i < $c; $i++) {
	$code = md5($checkEmail[$i]['login'].rand(100,999).$uniqueKey);
	$contentEmail .= "<ul style='margin-bottom:2px; padding-bottom:0;'><li><b>Login:</b> ".$checkEmail[$i]['login']."</li></ul><div style='margin: 10px 0 0 0; padding:10px; background:#f5f5f5; border:1px solid #d8d8d8; border-radius:5px; display:table;'><a href='http://".$server_url."/?page=forgot_confirm&acc=".$checkEmail[$i]['login']."&code=".$code."' target='_blank'>http://".$server_url."/?page=forgot_confirm&acc=".$checkEmail[$i]['login']."&code=".$code."</a></div><br />";
	$insert_code = Account::insertForgotCode($checkEmail[$i]['login'], $code);
	if(!$insert_code) { $error += 1; }
}

if(count($checkEmail) > 1) {
	$codeall = md5($email.rand(100,999).$uniqueKey);
	$contentEmail .= "<br />".$LANG[12112]."<div style='margin: 10px 0 0 0; padding:10px; background:#f5f5f5; border:1px solid #d8d8d8; border-radius:5px; display:table;'><a href='http://".$server_url."/?page=forgot_confirm&acc=all_".urlencode(strtolower($email))."&code=".$codeall."' target='_blank'>http://".$server_url."/?page=forgot_confirm&acc=all_".urlencode(strtolower($email))."&code=".$codeall."</a></div><br />";
	$insert_codeall = Account::insertForgotCode('all_'.strtolower($email), $codeall);
	if(!$insert_codeall) { $error += 1; }
}

if($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
	require('private/classes/classEmail.php');
	if(!Email::sendEmail($contentEmail, $server_email, $LANG[12040]." - ".$server_name, $email)) {
		fim($LANG[12075]);
	}
}

if($error == 0) {
	setcookie('atualstudio_forgot', $email, (time()+600), '/');
	fim($LANG[12041].' <b>'.$email.'</b> <br />'.$LANG[12042], 'OK', './');
} else {
	fim($LANG[12055]);
}

