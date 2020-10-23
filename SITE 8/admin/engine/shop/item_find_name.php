<?php
$itemid = intval(trim($_GET['itemid']));
if($itemid < 17 || $itemid > 21990) { die(json_encode(array('name' => '', 'sa' => ''))); }

require('../private/includes/itemlist.php');

if(!empty($item[$itemid])) {
	die(json_encode(array('name' => ''.$item[$itemid][0].'', 'sa' => ''.(!empty($item[$itemid][1]) ? $item[$itemid][1] : '').'')));
}