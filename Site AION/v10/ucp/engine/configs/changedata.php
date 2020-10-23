<?php

if(!$indexing) { exit; }

if($funct['config'] != 1) { fim($LANG[40003], 'ERROR', './'); }

if($logged != 1) { fim('Access denied!', 'RELOAD'); }

$oldpass = addslashes(trim($_POST['oldpass']));
$newpass = vCode($_POST['newpass']);
$newpass2 = vCode($_POST['newpass2']);

if(empty($oldpass) || empty($newpass) || empty($newpass2)) {
	fim($LANG[12058]);
}

if($newpass != $newpass2) {
	fim($LANG[12092]);
}

if(strlen(vCode($_POST['newpass'])) > 16) {
	fim($LANG[12093]);
}

require('private/classes/classAccess.php');

$login = Access::login($_SESSION['acc'], $oldpass);
if(!$login) {
	fim($LANG[12091]);
}

require('private/classes/classConfigs.php');

$updatepass = Configs::changeData($_SESSION['acc'], $newpass);
if(!$updatepass) {
	fim($LANG[12055]);
} else {
	fim($LANG[12056], 'OK', './');
}

