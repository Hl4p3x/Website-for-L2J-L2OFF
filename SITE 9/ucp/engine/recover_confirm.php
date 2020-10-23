<?php

if(!isset($indexing)) { exit; }

if(!isset($_GET['acc']) || !isset($_GET['code'])) {
	fim($LANG[12058]);
}

$acc = vCode(urldecode($_GET['acc']));
$code = vCode($_GET['code']);

require('private/classes/classAccount.php');

$checkCode = Account::checkForgotCode($acc, $code);
if(count($checkCode) == 0) {
	fim($LANG[12046]);
}

if(empty($_POST['pass']) || empty($_POST['passr'])) {
	fim($LANG[12051]);
}

$pass = vCode($_POST['pass']);
$passr = vCode($_POST['passr']);

if(preg_match("/[^a-zA-Z0-9]/", $pass)) {
	fim($LANG[12045]);
}

if($pass != $passr) {
	fim($LANG[12053]);
}

if(preg_match('/^all_/', $acc)) {
	$login_or_email = 'email';
	$query = Account::checkEmailExists(substr($acc, 4));
	if(count($query) == 0) { fim($LANG[12055].' #F1'); }
	$accs=''; for($i=0, $c=count($query); $i < $c; $i++) { $accs .= "'".$query[$i]['login']."', "; }
} else {
	$login_or_email = 'login';
	$query = Account::checkLoginExists($acc);
	if(count($query) == 0) { fim($LANG[12055].' #F2'); }
}

$delete_code = Account::deleteForgotCode($acc);
if(!$delete_code) {
	fim($LANG[12055].' #F3');
}

if($login_or_email == 'email') {
	$updatePass = Account::updatePassGroup($pass, substr($accs, 0, -2));
} else {
	$updatePass = Account::updatePass($pass, $acc);
}

if(!$updatePass) {
	fim($LANG[12055].' #F4');
} else {
	fim($LANG[12056], 'OK', './');
}
