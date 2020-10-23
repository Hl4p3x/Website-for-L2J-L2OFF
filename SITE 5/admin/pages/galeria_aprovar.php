<?php
//error_reporting(0);

if($indexing != 1) { exit; }

if(!is_numeric($_POST['gid'])) { exit; }

$qAprovar = mysql_query("SELECT * FROM ".DBNAME.".site_galeria WHERE g_gid = '".$_POST['gid']."' LIMIT 1", $conexao);
if(mysql_num_rows($qAprovar) > 0) {

	$aUpdAprove = mysql_query("UPDATE ".DBNAME.".site_galeria SET g_visivel = '1' WHERE g_gid = '".$_POST['gid']."'", $conexao);
	
	if($aUpdAprove == 1) {
		die(json_encode(array('msg' => '', 'act' => 'OK')));
	} else {
		die(json_encode(array('msg' => ''.utf8_encode('Ops, ocorreu algum erro! Tente novamente!').'', 'act' => 'ERROR')));
	}


} else { die(json_encode(array('msg' => ''.utf8_encode('Item não encontrado!').'', 'act' => 'ERROR'))); }
