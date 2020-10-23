<?php
require("../../configs.php");
$conexao = mysql_connect(DBHOST, DBUSER, DBPASS);

if(!is_array($_POST['recordsArray'])) { exit; }

$updateRecordsArray = $_POST['recordsArray'];

	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
		
		$query = "UPDATE ".DBNAME.".site_galeria SET g_position = '".$listingCounter."' WHERE g_gid = '".$recordIDValue."'";
		mysql_query($query, $conexao) or die('Erro!');
		$listingCounter = $listingCounter + 1;	
	}

@mysql_close($conexao);
