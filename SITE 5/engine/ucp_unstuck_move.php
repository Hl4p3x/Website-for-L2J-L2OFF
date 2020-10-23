<?php

if(!$indexing) { exit; }

if($logged != 1) { fim('', 'ERROR', './'); }

$cid = intval($_POST['cid']);

if(empty($cid)) {
	fim($LANG[12101].'!');
}

require('private/classes/classAccount.php');
$check = Account::checkAccChar($_SESSION['acc'], $cid);
if(count($check) == 0) {
	fim($LANG[12100]);
}

if($check[0]['karma'] != 0) {
	fim($LANG[12098]);
}

if($check[0]['online'] != 0) {
	fim($LANG[12099]);
}

if($check[0]['curHp'] < $check[0]['maxHp'] || $check[0]['curCp'] < $check[0]['maxCp']) {
	fim($LANG[12097]);
}

require('private/classes/classAction.php');
$unstuck = Action::Unstuck($cid, $unstuck_loc_x, $unstuck_loc_y, $unstuck_loc_z);
if(!$unstuck) {
	fim($LANG[12055]);
} else {
	fim($LANG[12056], 'OK');
}
