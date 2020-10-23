<?php

if(!$indexing) { exit; }

if($logged != 1) { fim('Access denied!', 'RELOAD'); }

if($funct['trnsf3'] != 1) { fim($LANG[40003], 'ERROR', './'); }

$count = !empty($_POST['count']) ? intval(trim($_POST['count'])) : 0;
$personagem = !empty($_POST['char']) ? intval(trim($_POST['char'])) : 0;
$captcha = !empty($_POST['captcha']) ? vCode($_POST['captcha']) : '';

if(empty($count) || empty($personagem)) {
	fim($LANG[12058]);
}

if($count < 0) {
	fim($LANG[12055].' #INVALIDNUMBER');
}

require_once('captcha/securimage.php');
$securimage = new Securimage();
if($securimage->check($captcha) == false) {
	fim($LANG[12057]);
}

require('private/classes/classDonate.php');

$findChar = Donate::findChar($_SESSION['acc'], $personagem);
if(count($findChar) == 0) { fim($LANG[10026], 'ERROR', './?module=donate&page=transfer'); }

if($findChar[0]['online'] == '1') { fim($LANG[10174].' '.$findChar[0]['char_name'].' '.$LANG[10175]); }

$checkExistCount = Donate::checkExistCount($coinID, $personagem);
if(intval(trim($checkExistCount[0]['count'])) < $count) {
	fim($LANG[10097]);
}

$removeCoins = Donate::removeIngameCoins($coinID, $count, $personagem);
if(!$removeCoins) {
	fim($LANG[12055].' #REMOVE');
}

$insertBalance = Donate::insertBalance($_SESSION['acc'], $count);
if(!$insertBalance) {
	fim($LANG[12055].' #INSERT');
} else {
	@Donate::convertOnlineLog($count, $_SESSION['acc'], $personagem);
	fim($LANG[12056], 'OK', './?module=donate&page=transfer');
}
