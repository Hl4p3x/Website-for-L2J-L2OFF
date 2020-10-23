<?php

$usuario = $_POST['user'];
$senha = $_POST['senha'];
$online = $_POST['sele'];

$select = mysql_query("SELECT * FROM painel_users WHERE usuario = '$usuario' AND senha = '$senha'") or die (mysql_error());
if(@mysql_num_rows($select) >= '1'){

?>

<?php

$query = mysql_query("UPDATE painel_users SET online = '$online' WHERE usuario = '$usuario'") or die (mysql_error());
$ultimo_login = date ('d/m/Y - H:i');
$data_login = mysql_query("UPDATE painel_users SET ultimo_login = '$ultimo_login' WHERE usuario = '$usuario'") or die (mysql_error());
$ip = $_SERVER['REMOTE_ADDR'];
$ip_login = mysql_query("UPDATE painel_users SET ultimo_login_ip = '$ip' WHERE usuario = '$usuario'") or die (mysql_error());

$_SESSION['user'] = $usuario;
$_SESSION['senha'] = $senha;

?>

<img src="img/sucess_login.gif">
<meta http-equiv="refresh" content="2; url=admin/">

<?php
}else{
	echo "<img src=\"img/error_login.jpg\">";	
}
?>
