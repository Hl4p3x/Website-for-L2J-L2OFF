<?php

if(!$indexing) { exit; }

if($logged != 1) { fim('Access denied!', 'RELOAD', './'); }

if($delFatura != 1) {
	fim($LANG[10126]);
}

$protocolo = intval(trim($_POST['oid']));

if(empty($protocolo)) {
	fim('Invalid ID!', 'ERROR', './?module=donate&page=add');
}

require('private/classes/classDonate.php');

$searcheExists = Donate::findDonation($_SESSION['acc'], $protocolo);
if(count($searcheExists) == 0) {
	fim($LANG[10125]);
}

if($searcheExists[0]['status'] != '1') {
	fim($LANG[10126]);
}

$excluirnew = Donate::deleteDonation($_SESSION['acc'], $protocolo);
if($excluirnew) {
	fim($LANG[12056], 'OK', './?module=donate&page=orders');
} else {
	fim($LANG[12055]);
}

