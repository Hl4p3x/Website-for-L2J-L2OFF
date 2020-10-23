<?php
session_start();
include("../Connections/config_sql.php");
$nome = $_SESSION['user'];

$update = mysql_query("UPDATE painel_users SET online = 'off' WHERE usuario = '$nome'") or die (mysql_error());

unset($_SESSION['user']);
unset($_SERVER['senha']);
header("location: ../");

?>