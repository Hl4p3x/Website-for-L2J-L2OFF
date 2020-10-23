<?php if($indexing == 1) {
	
	if(!is_numeric($_GET['altlinksend'])) { exit; }
	
	if(isset($_POST['bannerlink'])) {
		$bannerlink = addslashes(htmlentities(trim($_POST['bannerlink'])));
	}
	
	if(isset($_POST['linktarget'])) {
		$linktarget = addslashes(htmlentities(trim($_POST['linktarget'])));
	}
	
	if(!isset($bannerlink)) { $bannerlink = ''; }
	if(!isset($linktarget)) { $linktarget = '0'; }
	if($linktarget != '1') { $linktarget = '0'; }
	
	$updlink = mysql_query("UPDATE ".DBNAME.".site_banners SET b_link = '".$bannerlink."', b_target = '".$linktarget."' WHERE b_bid = '".$_GET['altlinksend']."' LIMIT 1", $conexao);
	if($updlink == 1) {
		echo "<script type='text/javascript'>document.location.replace('?id=banners&success');</script>";
	} else {
		echo "<script type='text/javascript'>alert('Ops, ocorreu algum erro! Entre em contato com a Atualstudio!');history.back();</script>";
	}

	
}