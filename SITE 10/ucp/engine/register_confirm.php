<?php if(!$indexing) { exit; }

require('private/classes/classAccount.php');

Account::deleteRegExpiredCodes();

if(!isset($_GET['acc']) || !isset($_GET['code'])) {
	fim($LANG[12046], 'ERROR', './');
}

$acc = vCode($_GET['acc']);
$code = vCode($_GET['code']);

$checkCode = Account::checkRegCode($acc, $code);
if(count($checkCode) == 0) {
	fim($LANG[12046], 'ERROR', './');
} else {
	
	$confirmACC = Account::updateAccessLevel('0', $acc);
	if($confirmACC) {
		Account::deleteRegCode($acc);
		fim($LANG[12080], 'OK', './');
	} else {
		fim($LANG[12081], 'ERROR', './');
	}

}
