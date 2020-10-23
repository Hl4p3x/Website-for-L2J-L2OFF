<?php

if(!$indexing) { exit; }

if($logged != 1) { fim('Access denied!', 'RELOAD'); }

if($funct['trnsf1'] != 1) { fim($LANG[40003], 'ERROR', './'); }

$count = !empty($_POST['count']) ? intval(trim($_POST['count'])) : '';
$dest = !empty($_POST['dest']) ? vCode($_POST['dest']) : '';
$captcha = !empty($_POST['captcha']) ? vCode($_POST['captcha']) : '';

if(empty($count) || empty($dest) || empty($captcha)) {
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

$findChar = Donate::findChar($_SESSION['acc'], $dest);
if(count($findChar) == 0) { fim($LANG[10026], 'ERROR', './?module=donate&page=transfer'); }

if($findChar[0]['online'] == '1') { fim($LANG[10174].' '.$findChar[0]['char_name'].' '.$LANG[10175]); }

if(debitBalance($_SESSION['acc'], $count) != 'OK') {
	fim($LANG[10097]);
}

$searchCoinExist = Donate::searchCoinExist($dest, $coinID);
if(count($searchCoinExist) > 0) {
	$object_id = $searchCoinExist[0]['object_id'];
} else {
	$object_id = 0;
}

$insert = Donate::insertCoinInGame($dest, $coinID, $count, $object_id);
if(!$insert) {
	fim($LANG[12055]);
} else {
	@Donate::convertLog($count, $_SESSION['acc'], $dest);
	fim($LANG[12056], 'OK', './?module=donate&page=transfer');
}

