<?php

class Index {
	
	public static function accData($login) {
		
		$sql = DB::Executa("SELECT *, (SELECT COUNT(*) FROM characters WHERE account_name = '".$login."') AS chars FROM accounts WHERE login = '".$login."' LIMIT 1");
		return $sql;
		
	}
	
	public static function lastLogins($login) {
		
		$sql = DB::Executa("SELECT * FROM site_ucp_lastlogins WHERE login = '".$login."' ORDER BY logdate DESC LIMIT 5");
		return $sql;
		
	}
	
	public static function findChars($login) {
		
		$sql = DB::Executa("
		SELECT
			C.*, 
			S1.class_id AS subclass1, 
			S2.class_id AS subclass2, 
			S3.class_id AS subclass3, 
			CLAN.clan_name, 
			CLAN.ally_name
		FROM
			characters AS C
		LEFT JOIN
			clan_data AS CLAN ON CLAN.clan_id = C.clanid
		LEFT JOIN
			character_subclasses AS S1 ON S1.char_obj_id = C.obj_Id AND S1.class_index = '1'
		LEFT JOIN
			character_subclasses AS S2 ON S2.char_obj_id = C.obj_Id AND S2.class_index = '2'
		LEFT JOIN
			character_subclasses AS S3 ON S3.char_obj_id = C.obj_Id AND S3.class_index = '3'
		WHERE
			C.account_name = '".$login."'
		LIMIT 7");
		return $sql;
		
	}
	
}
