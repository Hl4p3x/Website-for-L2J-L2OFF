<?php

error_reporting(0);

if(isset($indexing)) { echo "<script type='text/javascript'>document.location.replace('./');</script>"; exit; }

if(!function_exists('vCode')) {
	function vCode($content) {
		return addslashes(htmlentities(trim(utf8_decode($content)), ENT_QUOTES, 'ISO-8859-1'));
	}
}

require('../configs.php');
$conexao = @mysql_connect($host, $user, $pass);
require('../engine/language.php');


if((!isset($_GET['acc']))||(!isset($_GET['code']))) { echo "<script type='text/javascript'>document.location.replace('../');</script>"; exit; }

$acc = vCode(urldecode($_GET['acc']));
$code = vCode($_GET['code']);

$search_if_expired = mysql_query("SELECT account, code FROM ".$db.".site_forgotpass WHERE account = '".$acc."' AND code = '".$code."' LIMIT 1", $conexao);
if(mysql_num_rows($search_if_expired) == 0) {
	echo "<script type='text/javascript'>alert('".$LANG[12046]."');document.location.replace('../');</script>"; exit;
}

$post_pass = vCode($_POST['password']);
$post_passr = vCode($_POST['passwordr']);

if((empty($_POST['password']))||(empty($_POST['passwordr']))) {
	echo "<script type='text/javascript'>alert('".$LANG[12051]."');document.location.replace('../?page=forgot_confirm&acc=".$acc."&code=".$code."');</script>"; exit;
}

if(preg_match("/[^a-zA-Z0-9]/", $post_pass.$post_passr)) {
	echo "<script type='text/javascript'>alert('".$LANG[12052]."');document.location.replace('../?page=forgot_confirm&acc=".$acc."&code=".$code."');</script>"; exit;
}

if($post_pass != $post_passr) {
	echo "<script type='text/javascript'>alert('".$LANG[12053]."');document.location.replace('../?page=forgot_confirm&acc=".$acc."&code=".$code."');</script>"; exit;
}

if((strlen($post_pass) > 16)||(strlen($post_passr) > 16)) {
	echo "<script type='text/javascript'>alert('".$LANG[12054]."');document.location.replace('../?page=forgot_confirm&acc=".$acc."&code=".$code."');</script>"; exit;
}

if(preg_match('/^all_/', $acc)) {
	$select1 = mysql_query("SELECT login FROM ".$db.".accounts WHERE email = '".substr($acc, 4)."'", $conexao);
	if(mysql_num_rows($select1) == 0) { echo "<script type='text/javascript'>alert('".$LANG[12055]." #F01');document.location.replace('../?page=forgot_confirm&acc=".$acc."&code=".$code."');</script>"; exit; }
	$accs=''; while($dadoss1=mysql_fetch_array($select1)) { $accs .= "'".$dadoss1['login']."', "; }
	$login_or_email = 'email';
} else {
	$select1 = mysql_query("SELECT login FROM ".$db.".accounts WHERE login = '".$acc."' LIMIT 1", $conexao);
	if(mysql_num_rows($select1) == 0) { echo "<script type='text/javascript'>alert('".$LANG[12055]." #F02');document.location.replace('../?page=forgot_confirm&acc=".$acc."&code=".$code."');</script>"; exit; }
	$login_or_email = 'login';
}

if($passEncode != 0) {
	$post_pass = base64_encode(pack('H*', sha1(trim($_POST['password']))));
	$post_passr = base64_encode(pack('H*', sha1(trim($_POST['passwordr']))));
}


$delete_code = mysql_query("DELETE FROM ".$db.".site_forgotpass WHERE account = '".$acc."'", $conexao);
if($delete_code == 1) {
	
	if($login_or_email == 'email') {
		$insert1 = mysql_query("UPDATE ".$db.".accounts SET password = '".$post_pass."' WHERE login IN (".substr($accs, 0, -2).")", $conexao);
	} else {
		$insert1 = mysql_query("UPDATE ".$db.".accounts SET password = '".$post_pass."' WHERE login = '".$acc."'", $conexao);
	}
	if($insert1 == 1) {
		echo "<script type='text/javascript'>alert('".$LANG[12056]."');document.location.replace('../');</script>"; exit;
	} else {
		echo "<script type='text/javascript'>alert('".$LANG[12055]." #F03');document.location.replace('../?page=forgot');</script>"; exit;
	}
	
} else { echo "<script type='text/javascript'>alert('".$LANG[12055]." #F04');document.location.replace('../?page=forgot_confirm&acc=".$acc."&code=".$code."');</script>"; exit; }


@mysql_close($conexao);
