<?php

class Index {

	public static function countNews() {
		
		$sql = "SELECT COUNT(*) AS quant FROM site_news";
		return DB::Executa($sql);
		
	}

	public static function countBanners() {
		
		$sql = "SELECT COUNT(*) AS quant FROM site_banners";
		return DB::Executa($sql);
		
	}

	public static function countGallery() {
		
		$sql = "SELECT COUNT(*) AS quant FROM site_gallery";
		return DB::Executa($sql);
		
	}

	public static function countAccounts() {
		
		$sql = "SELECT COUNT(*) AS quant FROM accounts";
		return DB::Executa($sql);
		
	}

	public static function countChars() {
		
		$sql = "SELECT COUNT(*) AS quant FROM characters";
		return DB::Executa($sql);
		
	}

	public static function countOnline() {
		
		$sql = "SELECT COUNT(*) AS quant FROM characters WHERE online > '0'";
		return DB::Executa($sql);
		
	}

	public static function countClans() {
		
		$sql = "SELECT COUNT(*) AS quant FROM clan_data";
		return DB::Executa($sql);
		
	}

	public static function donates($perBegin, $perEnd) {
		
		$sql = "SELECT * FROM site_donations WHERE data > '".$perBegin."' AND data < '".$perEnd."'";
		return DB::Executa($sql);
		
	}

	public static function beginDonateYear() {
		
		$sql = "SELECT data FROM site_donations ORDER BY data ASC LIMIT 1";
		return DB::Executa($sql);
		
	}

}
