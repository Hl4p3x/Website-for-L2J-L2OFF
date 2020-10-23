<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; }

require('private/classes/classAccount.php');

Account::deleteEmailExpiredCodes();

if(!isset($_GET['acc']) || !isset($_GET['code'])) {
	fim('teste', 'ERROR', './');
}

$acc = vCode($_GET['acc']);
$code = vCode($_GET['code']);

$checkCode = Account::checkEmailCode($acc, $code);
if(count($checkCode) == 0) {
	fim($LANG[12046], 'ERROR', './');
} else {
	
	$updateEmail = Account::updateEmail($checkCode[0]['newemail'], $acc);
	if($updateEmail) {
		Account::deleteEmailCode($acc);
		fim($LANG[12056], 'OK', './');
	} else {
		fim($LANG[12055], 'ERROR', './');
	}

}
