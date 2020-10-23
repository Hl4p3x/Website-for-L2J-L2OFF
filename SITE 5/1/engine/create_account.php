<?php

if(!isset($indexing)) { exit; }

$key = isset($_POST['key']) ? vCode($_POST['key']) : '';
if($key != $_SESSION['key']) { fim('', 'SESSION', './?page=register'); }

$dateReg = mktime($reg['hr'],$reg['min'],0,$reg['mes'],$reg['dia'],$reg['ano']);
if($dateReg > time()) {
	fim($LANG[12977].' '.date('d F, Y \- H:i', $dateReg).'.');
}

if(empty($_POST['login']) || empty($_POST['pass']) || empty($_POST['pass2']) || empty($_POST['email']) || empty($_POST['email2'])) {
	fim($LANG[12058]);
}

$login = vCode($_POST['login']);
$email = strtolower(vCode($_POST['email']));
$email2 = strtolower(vCode($_POST['email2']));
$pass = vCode($_POST['pass']);
$pass2 = vCode($_POST['pass2']);

if($captcha_register_on == 1) {
	$captcha = vCode($_POST['captcha']);
	require_once('captcha/securimage.php');
	$securimage = new Securimage();
	if($securimage->check($captcha) == false) {
		fim($LANG[12057]);
	}
}

$nosuffix = !isset($_POST['nosuffix']) ? '0' : intval($_POST['nosuffix']);
$suffix = !empty($_POST['suffix']) ? vCode($_POST['suffix']) : '';
if($nosuffix != '1' && !empty($suffix)) {
	$login .= $suffix;
} else if($suffixActive == 1 && $forceSuffix == 1) {
	fim($LANG[12076]);
}

if($email != $email2) {
	fim($LANG[12984]);
}

if(preg_match("/[^a-zA-Z0-9]/", $pass.$login)) {
	fim($LANG[12045]);
}

if($pass != $pass2) {
	fim($LANG[12070]);
}

if(strlen($login) > 14 || strlen($email) > 100) {
	fim($LANG[12071]);
}

if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)) {
	fim($LANG[12073]);
}

require('private/classes/classAccount.php');

$searchacc = Account::checkLoginExists($login);
if(count($searchacc) > 0) {
	fim($LANG[12072]);
}

if($vcmemail != 1) {
	$searchEmail = Account::checkEmailExists($email);
	if(count($searchEmail) > 0) {
		fim($LANG[12074]);
	}
}

$accLvl=0;

if($cofemail == 1) {
	
	$accLvl="-1";
	
	$confirmCode = md5($login.rand(100,999).$uniqueKey);
	
	$insertCode = Account::insertRegCode($login, $confirmCode);
	if($insertCode != 1) {
		fim($LANG[12075]);
	}
	
	if($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
		
		$contentEmail = $LANG[12113]."<ul style='margin-bottom:2px; padding-bottom:0;'><li><b>Login:</b> ".$login."</li><li><b>E-mail:</b> ".$email."</li></ul><div style='margin: 10px 0 0 0; padding:10px; background:#f5f5f5; border:1px solid #d8d8d8; border-radius:5px; display:table;'><a href='http://".$server_url."/?page=register_confirm&acc=".$login."&code=".$confirmCode."' target='_blank'>http://".$server_url."/?page=register_confirm&acc=".$login."&code=".$confirmCode."</a></div>";

		require('private/classes/classEmail.php');
		
		if(!Email::sendEmail($contentEmail, $server_email, $LANG[12083]." - ".$server_name, $email)) {
			fim($LANG[12075]);
		}
		
	}
	
}

$register = Account::Register($login, $pass, $accLvl, $email);
if(!$register) {
	fim($LANG[12076]);
} else {
	
	if($downRegfile == 1) {
		
		if(!file_exists("cache")) { @mkdir("cache", 0775, true); @chmod("cache", 0775); }
		if(!file_exists("cache/index.html")) { $secIndexFile = fopen("cache/index.html","w+"); @fclose($secIndexFile); }
		if(!file_exists("cache/.htaccess")) { $secHtacsFile = fopen("cache/.htaccess","w+"); @fwrite($secHtacsFile, "Options -Indexes\ndeny from all"); @fclose($secHtacsFile); }
		
		$_SESSION['download_key'] = md5($login.$uniqueKey);
		
		$file = "cache/".$LANG[29008]." (".$login.").txt";
		$f = fopen(''.$file.'',"w+");
		$t = $LANG[29010].$server_name."!\r\n\r\nLogin: ".$login.($passRegfile == 1 ? "\r\n".$LANG[12049].": ".addslashes(trim(utf8_decode($_POST['pass']))) : "")."\r\nE-mail: ".$email."\r\n".$LANG[29009].": ".date('d F, Y H:i')."\r\n\r\n".$server_url;
		fwrite($f, $t, strlen($t)); fclose($f);
		
		function genJSON($txt, $act, $url, $email, $login) {
			return die(json_encode(array('msg' => $txt, 'act' => $act, 'url' => $url, 'email' => $email, 'login' => $login)));
		}
		
		$_SESSION['aAlert_act'] = 'OK';
		$_SESSION['aAlert_url'] = './?engine=download_account_txt&eConf='.base64_encode($email).'&lConf='.base64_encode($login);
		
		if($cofemail != 1) {
			
			if(isset($_POST['isJS'])) {
				genJSON($LANG[12068].' <br />Login: <b>'.$login.'</b>', 'OK', './?engine=download_account_txt&eConf='.base64_encode($email).'&lConf='.base64_encode($login), base64_encode($email), base64_encode($login));
			} else {
				$_SESSION['aAlert_msg'] = $LANG[12068].' Login: <b>'.$login.'</b>';
				fim('', 'OK', './');
			}
			
		} else {
			
			if(isset($_POST['isJS'])) {
				genJSON($LANG[12069].' <b>'.$email.'</b>', 'OK', './?engine=download_account_txt&eConf='.base64_encode($email).'&lConf='.base64_encode($login), base64_encode($email), base64_encode($login));
			} else {
				$_SESSION['aAlert_msg'] = $LANG[12069].' <b>'.$email.'</b>';
				fim('', 'OK', './');
			}
			
		}
		
	} else {
	
		if($cofemail != 1) {
			
			fim($LANG[12068].' Login: <b>'.$login.'</b>', 'OK', './');
			
		} else {
			
			fim($LANG[12069].' <b>'.$email.'</b>', 'OK', './');
			
		}
	
	}
	
}

