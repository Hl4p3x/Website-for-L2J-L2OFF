<?php

$ucp_access=0;

if((isset($_COOKIE['usercp_login']))&&(isset($_COOKIE['usercp_pass']))) {

	$cookie_user = vCode($_COOKIE['usercp_login']);
	$cookie_pass = vCode($_COOKIE['usercp_pass']);
	
	if(!$conexao) { $conexao = mysql_connect($host, $user, $pass); $conStep=1; }
	
	if($passEncode == 1) {
		$select_login = mysql_query("SELECT * FROM ".$db.".accounts WHERE login = '".$cookie_user."' AND password = '".$cookie_pass."' LIMIT 1", $conexao);
	} else {
		$select_login = mysql_query("SELECT * FROM ".$db.".accounts WHERE login = '".$cookie_user."' LIMIT 1", $conexao);
	}
	
	if(mysql_num_rows($select_login) > 0) {
		
		while($dados = mysql_fetch_array($select_login)) {
		    $acc_login = $dados['login'];
		    $acc_pass = md5($dados['password']);
		    $acc_email = $dados['email'];
		}
		
		if($passEncode == 1) {
			$ucp_access=1;
		} else if($acc_pass == $cookie_pass) {
			$ucp_access=1;
		} else {
			unset($acc_login);
			unset($acc_pass);
			unset($acc_email);
		}
		
	}

}