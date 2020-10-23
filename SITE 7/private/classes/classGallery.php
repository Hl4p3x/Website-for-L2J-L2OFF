<?php

class Gallery {

	public static function listAll() {
		
		$sql = DB::Executa("SELECT * FROM site_gallery WHERE vis = '1' ORDER BY pos ASC");
		return $sql;
		
	}
	
	public static function Show($pgBeg=3, $pgMax='') {
		
		$sql = DB::Executa("SELECT * FROM site_gallery WHERE vis = '1' ORDER BY pos ASC LIMIT ".$pgBeg.", ".$pgMax);
		return $sql;
		
	}
	
	public static function CountItens() {
		
		$sql = DB::Executa("SELECT COUNT(*) AS quant  FROM site_gallery WHERE vis = '1'");
		return $sql;
		
	}
	
}
