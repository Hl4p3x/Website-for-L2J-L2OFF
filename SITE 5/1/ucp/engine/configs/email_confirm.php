<?php

if(!$indexing) { exit; }

if($funct['config'] != 1) { fim($LANG[40003], 'ERROR', './'); }

if($chaemail != 1) { fim('', 'ERROR', './'); }

require('private/classes/classConfigs.php');

Configs::deleteEmailExpiredCodes();

if(!isset($_GET['acc']) || !isset($_GET['code'])) {
	fim('teste', 'ERROR', './');
}

$acc = vCode($_GET['acc']);
$code = vCode($_GET['code']);

$checkCode = Configs::checkEmailCode($acc, $code);
if(count($checkCode) == 0) {
	fim($LANG[12046], 'ERROR', './');
} else {
	
	$updateEmail = Configs::updateEmail($checkCode[0]['newemail'], $acc);
	if($updateEmail) {
		Configs::deleteEmailCode($acc);
		fim($LANG[12056], 'OK', './');
	} else {
		fim($LANG[12055], 'ERROR', './');
	}

}
