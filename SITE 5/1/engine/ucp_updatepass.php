<?php

if(!$indexing) { exit; }

if($logged != 1) { fim('', 'ERROR', './'); }

if(empty($_POST['oldpass']) || empty($_POST['newpass']) || empty($_POST['newpass2'])) {
	fim($LANG[12058]);
}

$oldpass = addslashes(trim($_POST['oldpass']));
$newpass = vCode($_POST['newpass']);
$newpass2 = vCode($_POST['newpass2']);

if(preg_match("/[^a-zA-Z0-9]/", $newpass)) {
	fim($LANG[12045]);
}

if($newpass != $newpass2) {
	fim($LANG[12092]);
}

require('private/classes/classAccess.php');
$login = Access::login($_SESSION['acc'], $oldpass);
if(count($login) == 0) {
	fim($LANG[12091]);
}

require('private/classes/classAccount.php');
$updatePass = Account::updatePass($newpass, $_SESSION['acc']);
if(!$updatePass) {
	fim($LANG[12055]);
} else {
	fim($LANG[12056], 'OK', './');
}

