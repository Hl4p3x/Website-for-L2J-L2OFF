<?php

class News {

	public static function countNews( $buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			$whereAdd .= "WHERE (title_pt LIKE '%".$buscar."%' OR title_en LIKE '%".$buscar."%' OR title_es LIKE '%".$buscar."%' OR content_pt LIKE '%".$buscar."%' OR content_en LIKE '%".$buscar."%' OR content_es LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT COUNT(*) AS quant FROM site_news ".$whereAdd;
		return DB::Executa($sql);
		
	}

	public static function listNews($pgBeg, $pgMax, $buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			$whereAdd .= "WHERE (title_pt LIKE '%".$buscar."%' OR title_en LIKE '%".$buscar."%' OR title_es LIKE '%".$buscar."%' OR content_pt LIKE '%".$buscar."%' OR content_en LIKE '%".$buscar."%' OR content_es LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT * FROM site_news ".$whereAdd." ORDER BY post_date DESC LIMIT ".$pgBeg.", ".$pgMax;
		return DB::Executa($sql);
		
	}

	public static function insertNew($post_date, $vis, $title_pt, $content_pt, $title_en, $content_en, $title_es, $content_es, $imagem) {
		
		$sql = "INSERT INTO site_news (img, post_date, vis, title_pt, title_en, title_es, content_pt, content_en, content_es) VALUES ('".$imagem."', '".$post_date."', '".$vis."', '".$title_pt."', '".$title_en."', '".$title_es."', '".$content_pt."', '".$content_en."', '".$content_es."')";
		return DB::Executa($sql);
		
	}

	public static function editNew($nid, $post_date, $vis, $title_pt, $content_pt, $title_en, $content_en, $title_es, $content_es, $imagem) {
		
		$sql = "UPDATE site_news SET ".((!empty($imagem)) ? "img = '".$imagem."'," : "")." post_date = '".$post_date."', vis = '".$vis."', title_pt = '".$title_pt."', title_en = '".$title_en."', title_es = '".$title_es."', content_pt = '".$content_pt."', content_en = '".$content_en."', content_es = '".$content_es."' WHERE nid = '".$nid."' LIMIT 1";
		return DB::Executa($sql);
		
	}

	public static function findNew($nid) {
		
		$sql = "SELECT * FROM site_news WHERE nid = '".$nid."' LIMIT 1";
		return DB::Executa($sql);
		
	}

	public static function deleteNew($nid) {
		
		$sql = "DELETE FROM site_news WHERE nid = '".$nid."' LIMIT 1";
		return DB::Executa($sql);
		
	}

}
