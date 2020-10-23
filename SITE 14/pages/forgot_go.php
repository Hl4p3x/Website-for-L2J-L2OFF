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

// Captcha
if($captcha_forgotpass_on == 1) {
$captcha = vCode($_POST['captcha']);
require_once '../engine/captcha/securimage.php';
$securimage = new Securimage();
if ($securimage->check($captcha) == false) {
  echo "<script type='text/javascript'>alert('".$LANG[12057]."');document.location.replace('../?page=forgot#accLoc');</script>"; exit;
} }

$post_email = vCode($_POST['email']);

if(!$post_email) { echo "<script type='text/javascript'>alert('".$LANG[12059]."');history.back();</script>"; exit; }

if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $post_email)) { echo "<script type='text/javascript'>alert('".$LANG[12060]."');history.back();</script>"; exit; }

$search_email = mysql_query("SELECT login, email FROM ".$db.".accounts WHERE email = '".$post_email."'", $conexao);
if(mysql_num_rows($search_email) == 0) { echo "<script type='text/javascript'>alert('".$LANG[12061]."');history.back();</script>"; exit; }

if(mysql_num_rows($search_email) == 1) {
	$content_e = $LANG[12110];
} else {
	$content_e = $LANG[12111];
}

$error = 0;

if(substr($server_url, 0, 7) == 'http://') { $server_url = substr($server_url, 7); }
if(substr($server_url, 0, 8) == 'https://') { $server_url = substr($server_url, 8); }
if(substr($server_url, -1) == '/') { $server_url = substr($server_url, 0, -1); }


while($dade=mysql_fetch_array($search_email)) {
	$code = md5($dade['login'].time());
	$content_e .= "<ul style='margin-bottom:2px;padding-bottom:0;'><li><b>Login:</b> ".$dade['login']."</li></ul>
	<div style='padding:10px;background:#ffffd5;display:table;'>
	<a href='http://".$server_url."/?page=forgot_confirm&acc=".$dade['login']."&code=".$code."' target='_blank'>http://".$server_url."/?page=forgot_confirm&acc=".$dade['login']."&code=".$code."</a>
	</div><br /><br />";
	$insert_code = mysql_query("INSERT INTO ".$db.".site_forgotpass VALUES ('".$dade['login']."', '".$code."', '".time()."')", $conexao);
	if($insert_code != 1) { $error .= 1; }
}

if(mysql_num_rows($search_email) > 1) {
	$codeall = md5($dade['email'].time());
	$content_e .= $LANG[12112]."<div style='padding: 2px 10px 10px 10px;background:#ffffd5;display:table;'>
	<a href='http://".$server_url."/?page=forgot_confirm&acc=all_".urlencode(strtolower($post_email))."&code=".$codeall."' target='_blank'>http://".$server_url."/?page=forgot_confirm&acc=all_".urlencode(strtolower($post_email))."&code=".$codeall."</a>
	</div>
	<br /><br />
	";
	$insert_codeall = mysql_query("INSERT INTO ".$db.".site_forgotpass VALUES ('all_".strtolower($post_email)."', '".$codeall."', '".time()."')", $conexao);
	if($insert_codeall != 1) { $error .= 1; }
}

if($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
	$content_e .= "<a href='http://".$server_url."' target='_blank'>".$server_name."</a>";
	$headers = "MIME-Version: 1.1\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "From: ".$server_email ."\n";
	$headers .= "Return-Path: ".$server_email ."\n";
	$send_email = mail($post_email, $LANG[12040]." - ".$server_name, $content_e, $headers);
} else {
	$send_email=1;
}

if($send_email) {
	if($error == 0) {
		echo  "<script type='text/javascript'>document.location.replace('../?page=forgot&success');</script>"; exit;
	} else { echo  "<script type='text/javascript'>alert('".$LANG[12055]." #FG10');document.location.replace('../?page=forgot');</script>"; exit; }
} else { echo  "<script type='text/javascript'>alert('".$LANG[12055]." #FG11');document.location.replace('../?page=forgot');</script>"; exit; }


@mysql_close($conexao);
