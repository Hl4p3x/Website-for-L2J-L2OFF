<?php

$bid = !empty($_GET['bid']) ? intval($_GET['bid']) : 0;

require('private/classes/classBanners.php');

$findBanner = Banners::findBanner($bid);
if(count($findBanner) == 0){
	fim('Banner inexistente!');
}

$delete = Banners::deleteBanner($bid);
if($delete) {
	
	if(file_exists('../'.$dir_banners.$findBanner[0]['imgurl_pt']) && !empty($findBanner[0]['imgurl_pt'])) {
		@unlink('../'.$dir_banners.$findBanner[0]['imgurl_pt']);
	}
	
	if(file_exists('../'.$dir_banners.$findBanner[0]['imgurl_en']) && !empty($findBanner[0]['imgurl_en'])) {
		@unlink('../'.$dir_banners.$findBanner[0]['imgurl_en']);
	}
	
	if(file_exists('../'.$dir_banners.$findBanner[0]['imgurl_es']) && !empty($findBanner[0]['imgurl_es'])) {
		@unlink('../'.$dir_banners.$findBanner[0]['imgurl_es']);
	}
	
	adminLog("Excluiu o banner de ID ".$bid); // Admin Log
	fim('Banner excluído com sucesso!', 'OK', './?page=list&module=banners');
	
} else {
	fim('Desculpe, ocorreu algum erro. Por favor, tente mais tarde.');
}
