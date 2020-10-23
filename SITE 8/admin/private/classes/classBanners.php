<?php

class Banners {

	public static function listBanners() {
		
		$sql = "SELECT * FROM site_banners ORDER BY pos ASC";
		return DB::Executa($sql);
		
	}

	public static function findLastBannerPos() {
		
		$sql = "SELECT pos FROM site_banners ORDER BY pos DESC LIMIT 1";
		return DB::Executa($sql);
		
	}

	public static function insertBanner($imgurl_pt, $imgurl_en, $imgurl_es, $link, $target, $vis, $pos) {
		
		$sql = "INSERT INTO site_banners (imgurl_pt, imgurl_en, imgurl_es, pos, link, target, vis) VALUES ('".$imgurl_pt."', '".$imgurl_en."', '".$imgurl_es."', '".$pos."', '".$link."', '".$target."', '".$vis."')";
		return DB::Executa($sql);
		
	}

	public static function editBanner($bid, $imgurl_pt, $imgurl_en, $imgurl_es, $link, $target, $vis) {
		
		$sql = "UPDATE site_banners SET ".((!empty($imgurl_pt)) ? "imgurl_pt = '".$imgurl_pt."'," : "")." ".((!empty($imgurl_en)) ? "imgurl_en = '".$imgurl_en."'," : "")." ".((!empty($imgurl_es)) ? "imgurl_es = '".$imgurl_es."'," : "")." link = '".$link."', target = '".$target."', vis = '".$vis."' WHERE bid = '".$bid."' LIMIT 1";
		return DB::Executa($sql);
		
	}

	public static function findBanner($bid) {
		
		$sql = "SELECT * FROM site_banners WHERE bid = '".$bid."' LIMIT 1";
		return DB::Executa($sql);
		
	}

	public static function deleteBanner($bid) {
		
		$sql = "DELETE FROM site_banners WHERE bid = '".$bid."' LIMIT 1";
		return DB::Executa($sql);
		
	}

	public static function reorder($pos, $itemID) {
		
		$sql = "UPDATE site_banners SET pos = '".$pos."' WHERE bid = '".$itemID."' LIMIT 1";
		return DB::Executa($sql);
		
	}

}
