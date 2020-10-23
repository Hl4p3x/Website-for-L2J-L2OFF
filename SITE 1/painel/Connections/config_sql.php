<?php

include("config.php");

$co = mysql_connect("$hostname_config", "$username_config", "$password_config") or die (mysql_error());
$db = mysql_select_db("$database_config", $co) or die (mysql_error());

?>