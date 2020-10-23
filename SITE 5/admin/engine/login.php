<?php

require('../../configs.php');

if(ADPACT != 1) { header('Location: desativado.php'); exit; }

session_start();

if(md5(ADPPSS) == md5($_POST['form_pass'])) {
	echo "1";
	$_SESSION['logged'] = 1;
} else {
	echo "2";
	session_destroy();
}