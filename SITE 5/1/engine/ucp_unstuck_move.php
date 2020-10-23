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

if($check[0]['align'] != 0) {
	fim($LANG[12098]);
}

if(($check[0]['login'] > $check[0]['logout'] || empty($check[0]['logout'])) && !empty($check[0]['login'])) {
	fim($LANG[12099]);
}

require('private/classes/classAction.php');

Action::Unstuck($cid, $unstuck_loc_x, $unstuck_loc_y, $unstuck_loc_z);

require('private/cacheD.php');

if(!is_resource(l2_cached_open())) {
	fim($LANG[12055].' #CacheD');
}

l2_cached_close();

$cached_op = pack("cVVVVV", 2, intval($cid), intval($check[0]['world']), intval($unstuck_loc_x), intval($unstuck_loc_y), intval($unstuck_loc_z));
$result = l2_cached_push(pack("s", strlen($cached_op)+2).$cached_op.ansi2unicode('site-atualstudio'));
if($result === '1') {
	fim($LANG[12056], 'OK');
} else {
	fim($LANG[12055]);
}
