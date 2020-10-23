<?php

class Index {

	public static function News($pgBeg=0, $pgMax=3) {
		
		$sql = DB::Executa("SELECT * FROM site_news WHERE vis = '1' ORDER BY post_date DESC, nid DESC LIMIT ".$pgBeg.", ".$pgMax);
		return $sql;
		
	}
	
	public static function CountNews() {
		
		$sql = DB::Executa("SELECT COUNT(*) AS quant FROM site_news WHERE vis = '1'");
		return $sql;
		
	}
	
	public static function NewsExcept($limit=3, $newID) {
		
		$sql = DB::Executa("SELECT * FROM site_news WHERE vis = '1' AND nid <> '".$newID."' ORDER BY post_date DESC LIMIT ".$limit."");
		return $sql;
		
	}
	
	public static function ViewNew($newID) {
		
		$sql = DB::Executa("SELECT * FROM site_news WHERE vis = '1' AND nid = '".$newID."' LIMIT 1");
		return $sql;
		
	}
	
	public static function Banners() {
		
		$sql = DB::Executa("SELECT * FROM site_banners WHERE vis = '1' ORDER BY pos ASC");
		return $sql;
		
	}
	
}
