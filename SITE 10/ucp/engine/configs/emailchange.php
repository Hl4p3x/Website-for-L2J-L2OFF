<?php

if(!$indexing) { exit; }

if($funct['config'] != 1) { fim($LANG[40003], 'ERROR', './'); }

if($logged != 1 || $chaemail != 1) { fim('', 'ERROR', './'); }

if(empty($_POST['newemail']) || empty($_POST['newemail2'])) {
	fim($LANG[12058]);
}

$newemail = strtolower(vCode($_POST['newemail']));
$newemail2 = strtolower(vCode($_POST['newemail2']));

if($newemail != $newemail2) {
	fim($LANG[12984]);
}

if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $newemail)) {
	fim($LANG[12073]);
}

require('private/classes/classConfigs.php');

$acc = Configs::checkLoginExists($_SESSION['acc']);
if(count($acc) == 0) {
	fim($LANG[12076]);
}

if($vcmemail != 1) {
	$searchEmail = Configs::checkEmailExists($newemail);
	if(count($searchEmail) > 0) {
		fim($LANG[12074]);
	}
}

if(!empty($acc[0]['email']) && $chaemail_confirm == 1) {
	
	if(!empty($_COOKIE['atualstudio_emailchange'])) {
		if(strtolower(vCode($_COOKIE['atualstudio_emailchange'])) == strtolower($_SESSION['acc'].'_'.$newemail)) {
			fim($LANG[12041].' <b>'.$acc[0]['email'].'</b> <br />'.$LANG[12042].' #2', 'OK');
		}
	}
	
	$code = md5($newemail.rand(100,999).$uniqueKey);
	
	if($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
		$contentEmail = $LANG[12114]."<ul style='margin-bottom:2px; padding-bottom:0;'><li><b>Login:</b> ".$acc[0]['login']."</li><li><b>E-mail:</b> ".$acc[0]['email']."</li><li><b>".$LANG[12988].":</b> ".$newemail."</li></ul><br /><div style='margin: 10px 0 0 0; padding:10px; background:#f5f5f5; border:1px solid #d8d8d8; border-radius:5px; display:table;'><a href='http://".$panel_url."/?engine=email_confirm&module=configs&acc=".$_SESSION['acc']."&code=".$code."' target='_blank'>http://".$panel_url."/?engine=email_confirm&acc=".$_SESSION['acc']."&code=".$code."</a></div><br />";
		require('private/classes/classEmail.php');
		if(!Email::sendEmail($contentEmail, $server_email, $LANG[11014]." - ".$server_name, $acc[0]['email'])) {
			fim($LANG[12075]);
		}
	}
	
	$insertCode = Configs::insertEmailCode($newemail, $code, $_SESSION['acc']);
	if(!$insertCode) {
		fim($LANG[12055]);
	} else {
		setcookie('atualstudio_emailchange', strtolower($_SESSION['acc'].'_'.$newemail), (time()+600), '/');
		fim($LANG[12041].' <b>'.$acc[0]['email'].'</b> <br />'.$LANG[12042], 'OK', './');
	}
	
} else {
	
	$updateEmail = Configs::updateEmail($newemail, $_SESSION['acc']);
	if(!$updateEmail) {
		fim($LANG[12055]);
	} else {
		fim($LANG[12056], 'OK', './');
	}
	

	
}