<?php

if(!$indexing) { exit; }

if($logged != 1) { fim('Access denied!', 'RELOAD'); }

if($funct['trnsf2'] != 1) { fim($LANG[40003], 'ERROR', './'); }

$count = !empty($_POST['count']) ? intval(trim($_POST['count'])) : '';
$count2 = !empty($_POST['count2']) ? intval(trim($_POST['count2'])) : '';
$dest = !empty($_POST['dest']) ? vCode($_POST['dest']) : '';
$dest2 = !empty($_POST['dest2']) ? vCode($_POST['dest2']) : '';
$captcha = !empty($_POST['captcha']) ? vCode($_POST['captcha']) : '';

if(empty($count) || empty($count2) || empty($dest) || empty($dest2) || empty($captcha)) {
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

if($count !== $count2) { fim($LANG[10171]); }

if($dest !== $dest2) { fim($LANG[10172]); }

require('private/classes/classDonate.php');

$findReceptor = Donate::findReceptor($dest);
if(count($findReceptor) == 0) { fim($LANG[12000]); }

$receptor = $findReceptor[0]['account_name'];
$receptorON = $findReceptor[0]['online'];

if($receptorON == '1') { fim($LANG[10174].' '.$dest.' '.$LANG[10175]); }

if(debitBalance($_SESSION['acc'], $count) != 'OK') {
	fim($LANG[10097]);
}

$insertBalance = Donate::insertBalance($receptor, $count);
if(!$insertBalance) {
	fim($LANG[12055]);
} else {
	@Donate::transferLog($count, $_SESSION['acc'], $receptor, $findReceptor[0]['obj_Id']);
	fim($LANG[12056], 'OK', './?module=donate&page=transfer');
}

