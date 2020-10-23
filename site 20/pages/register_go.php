<?php

error_reporting(0);

if(isset($indexing)) { echo "<script type='text/javascript'>document.location.replace('./');</script>"; exit; }

if(!function_exists('vCode')) {
	function vCode($content) {
		return addslashes(htmlentities(trim(utf8_decode($content)), ENT_QUOTES, 'ISO-8859-1'));
	}
}

require('../configs.php');
require('../engine/language.php');

if(empty($_POST['login']) || empty($_POST['newpass']) || empty($_POST['newpass2']) || empty($_POST['email']) || empty($_POST['email2'])) {
	header('Location: ../?page=register&l='.base64_encode($_POST['login']).'&e='.base64_encode($_POST['email']).'&err=NULL851#accLoc');
	exit;
}

$r_login = vCode($_POST['login']);
$r_email = vCode($_POST['email']);
$r_email2 = vCode($_POST['email2']);

if($captcha_register_on == 1) {
	$captcha = vCode($_POST['captcha']);
	require_once '../engine/captcha/securimage.php';
	$securimage = new Securimage();
	if ($securimage->check($captcha) == false) {
		header('Location: ../?page=register&l='.base64_encode($r_login).'&e='.base64_encode($r_email).'&err=CODE864#accLoc');
		exit;
	}
}

if($r_email != $r_email2) {
	header('Location: ../?page=register&l='.base64_encode($r_login).'&e='.base64_encode($r_email).'&err=ENSI1245#accLoc');
	exit;
}

if($passEncode == 0) {
	$newpass = vCode($_POST['newpass']);
	$newpass2 = vCode($_POST['newpass2']);
} else {
	$newpass = base64_encode(pack('H*', sha1(trim($_POST['newpass']))));
	$newpass2 = base64_encode(pack('H*', sha1(trim($_POST['newpass2']))));
}

if($newpass != $newpass2) {
	header('Location: ../?page=register&l='.base64_encode($r_login).'&e='.base64_encode($r_email).'&err=PASS389#accLoc');
	exit;
}

if((strlen($r_login) > 16)||(strlen($_POST['newpass']) > 16)||(strlen($r_email) > 100)) {
	header('Location: ../?page=register&l='.base64_encode($r_login).'&e='.base64_encode($r_email).'&err=CHARS953#accLoc');
	exit;
}

if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $r_email)) {
	header('Location: ../?page=register&l='.base64_encode($r_login).'&e='.base64_encode($r_email).'&err=FEMAIL541#accLoc');
	exit;
}

$conexao = @mysql_connect($host, $user, $pass);

$searchacc = mysql_query("SELECT login FROM ".$db.".accounts WHERE login = '".$r_login."' LIMIT 1", $conexao);
if(mysql_num_rows($searchacc) > 0) {
	header('Location: ../?page=register&l='.base64_encode($r_login).'&e='.base64_encode($r_email).'&err=LOGIN479#accLoc');
	exit;
}

if($vcmemail != 1) {
	$searchemail = mysql_query("SELECT email FROM ".$db.".accounts WHERE email = '".$r_email."' LIMIT 1", $conexao);
	if(mysql_num_rows($searchemail) > 0) {
		header('Location: ../?page=register&l='.base64_encode($r_login).'&e='.base64_encode($r_email).'&err=UEMAIL221#accLoc');
		exit;
	}
}

$accLvl=0;

if($cofemail == 1) {
	
	$accLvl="-1";
	
	$confirm_code = md5($r_login.$r_email.time());
	
	$salvandoCode = mysql_query("INSERT INTO ".$db.".site_reg_code (account, code, date) VALUES ('".$r_login."', '".$confirm_code."', '".time()."')", $conexao);
	if($salvandoCode != 1) {
		header('Location: ../?page=register&l='.base64_encode($r_login).'&e='.base64_encode($r_email).'&err=ENOTSEND743#accLoc');
		exit;
	}
	
	if($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
		if(substr($server_url, 0, 7) == 'http://') { $server_url = substr($server_url, 7); }
		if(substr($server_url, 0, 8) == 'https://') { $server_url = substr($server_url, 8); }
		if(substr($server_url, -1) == '/') { $server_url = substr($server_url, 0, -1); }
		
		$content_e = $LANG[12113]."<br />
		<ul style='margin-bottom:2px;padding-bottom:0;'><li><b>Login:</b> ".$r_login."</li><li><b>Email:</b> ".$r_email."</li></ul>
		<div style='padding:10px;background:#ffffd5;display:table;'>
		<a href='http://".$server_url."/?page=register_confirm&acc=".$r_login."&code=".$confirm_code."' target='_blank'>http://".$server_url."/?page=register_confirm&acc=".$r_login."&code=".$confirm_code."</a>
		</div><br /><br />
		<a href='http://".$server_url."' target='_blank'>".$server_name."</a>";
		$headers = "MIME-Version: 1.1\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "From: ".$server_email ."\n";
		$headers .= "Return-Path: ".$server_email ."\n";
		$send_email = mail($r_email, $LANG[12083]." - ".$server_name, $content_e, $headers);

		if($send_email != 1) {
			header('Location: ../?page=register&l='.base64_encode($r_login).'&e='.base64_encode($r_email).'&err=ENOTSEND743#accLoc');
			exit;
		}
	}
	
}

$createacc = mysql_query("INSERT INTO ".$db.".accounts (login, password, accessLevel, email) VALUES ('".$r_login."', '".$newpass."', '".$accLvl."', '".$r_email."')", $conexao);
if($createacc != 1) {
	header('Location: ../?page=register&l='.base64_encode($r_login).'&e='.base64_encode($r_email).'&err=INVALID#accLoc');
	exit;
} else {
	header('Location: ../?page=register&success&eConf='.base64_encode($r_email).'#accLoc');
	exit;
}


