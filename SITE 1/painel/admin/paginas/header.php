<?php include("functions/acesso_restrito.php"); ?>
<?php
include"../Connections/config_sql.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Painel De Controle By: Walker</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="box">

<div id="header">

<div id="tex">
<?php
$data = date('d/m/Y');
$hora = date('H');
$minutos = date('i');

if($hora >= '00' && $hora < '12'){
	echo ("Bom Dia Hoje e $data as $hora:$minutos");
}elseif($hora >= '12' && $hora < '18'){
	echo ("Boa Tarde Hoje e $data as $hora:$minutos");
}elseif($hora >= '18' && $hora < '00'){
	echo ("Boa Noite Hoje e $data as $hora:$minutos");
}
?>
</div><!--tex-->
</div><!--header--->

<div id="menu">
<?php

$select_menu = mysql_query("SELECT * FROM painel_users WHERE usuario = '$_SESSION[user]'") or die (mysql_error());
while($res_menu = mysql_fetch_object($select_menu)){
?>
<div class="img"><img src="<?php echo "$res_menu->avatar"; ?>" width="22" height="22"/></div>
<a href="profile.php?usuario=<?php echo "$res_menu->usuario" ?>">Logado como: <?php echo $session_user ?></a>
<img src="img/separador_menu.jpg" />
<a href="alterar_perfil.php">Alterar Meus Dados</a>
<img src="img/separador_menu.jpg" />
<a href="../functions/logoff.php">Sair</a>

<?php
}
?>
</div><!--menu-->