<?php

class Services {
	
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
			character_subclasses AS S1 ON S1.charId = C.charId AND S1.class_index = '1'
		LEFT JOIN
			character_subclasses AS S2 ON S2.charId = C.charId AND S2.class_index = '2'
		LEFT JOIN
			character_subclasses AS S3 ON S3.charId = C.charId AND S3.class_index = '3'
		WHERE
			C.account_name = '".$login."'
		LIMIT 7");
		return $sql;
		
	}
	
	public static function checkChar($acc, $cid) {
		
		$sql = DB::Executa("SELECT * FROM characters WHERE account_name = '".$cid.[account]"' AND char_name = '".$acc.[nome]"'");
		return $sql;
		
	}
	
	public static function cleanKarma($acc, $cid) {
		
		$sql = DB::Executa("UPDATE user_data SET align = '0' WHERE char_id = '".$cid."' AND account_name = '".$acc."'", "WORLD");
		return $sql;
		
	}
	
	public static function checkNameExists($name) {
		
		$sql = DB::Executa("SELECT TOP 1 * FROM user_data WHERE char_name = '".$name."'", "WORLD");
		return $sql;
		
	}
	
	public static function changeNickname($acc, $cid, $name) {
		
		$sql = DB::Executa("UPDATE user_data SET char_name = '".$name."' WHERE char_id = '".$cid."' AND account_name = '".$acc."'", "WORLD");
		return $sql;
		
	}
	
	public static function logServices($acc, $cid, $key, $values, $price) {
		
		$sql = DB::Executa("INSERT INTO site_log_services (log_account, log_cid, log_key, log_value, log_price, log_date) VALUES ('".$acc."', '".$cid."', '".$key."', '".$values."', '".$price."', '".date('Y-m-d H:i:s', time())."')", "SITE");
		return $sql;
		
	}
	
	public static function checkClanExists($cid, $clanID) {
		
		$sql = DB::Executa("SELECT TOP 1 * FROM Pledge WHERE pledge_id = '".$cid."' AND ruler_id = '".$clanID."'", "WORLD");
		return $sql;
		
	}
	
	public static function checkClanNameExists($name) {
		
		$sql = DB::Executa("SELECT TOP 1 * FROM Pledge WHERE name = '".$name."'", "WORLD");
		return $sql;
		
	}
	
	public static function changeClanName($cid, $clanID, $name) {
		
		$sql = DB::Executa("UPDATE Pledge SET name = '".$name."' WHERE pledge_id = '".$clanID."' AND ruler_id = '".$cid."'", "WORLD");
		return $sql;
		
	}
	
	public static function changeClanNameLog($cid, $clanID, $name_old, $name_new) {
		
		$sql = DB::Executa("INSERT INTO site_log_changeclanname (cid, clanid, name_old, name_new, changedate) VALUES ('".$cid."', '".$clanID."', '".$name_old."', '".$name_new."', '".date('Y-m-d H:i:s', time())."')", "SITE");
		return $sql;
		
	}
	
	public static function findAccs($acc) {
		
		$sql = DB::Executa("SELECT TOP 1 ssn.*, ssn.name AS login, ACC.uid AS accid FROM ssn INNER JOIN user_account AS ACC ON ACC.account = ssn.name WHERE ssn.email = (SELECT email FROM ssn WHERE name = '".$acc."') AND ssn.name <> '".$acc."'", "DB");
		return $sql;
		
	}
	
	public static function Unstuck($acc, $cid, $x, $y, $z) {
		$sql = "UPDATE user_data SET xloc = '".$x."', yloc = '".$y."', zloc = '".$z."' WHERE char_id = '".$cid."' AND account_name = '".$acc."'";
		return DB::Executa($sql, "WORLD");
		
	}
	
	public static function deleteSkills($cid) {
		$sql = "DELETE FROM user_skill WHERE char_id = '".$cid."' AND (subjob_id = '0' OR subjob_id IS NULL)";
		return DB::Executa($sql, "WORLD");
	}

	public static function deleteHennas($cid) {
		
		$sql = DB::Executa("UPDATE user_henna SET henna_1 = '0', henna_2 = '0', henna_3 = '0' WHERE char_id = '".$cid."' AND (subjob_id = '0' OR subjob_id IS NULL)", "WORLD");
		if(!$sql) { return false; }
		
		$sql = DB::Executa("UPDATE user_subjob SET henna_1 = '0', henna_2 = '0', henna_3 = '0' WHERE char_id = '".$cid."' AND (subjob_id = '0' OR subjob_id IS NULL)", "WORLD");
		if(!$sql) { return false; }
		
		return true;
		
	}

	public static function deleteShortcuts($cid) {
		$sql = "DELETE FROM shortcut_data WHERE char_id = '".$cid."' AND (subjob_id = '0' OR subjob_id IS NULL)";
		return DB::Executa($sql, "WORLD");
	}

	public static function listClassesSkills($classes) {
		$sql = "SELECT skill_id, MAX(level) AS level FROM site_skills_classes WHERE class IN (".$classes.") GROUP BY skill_id";
		return DB::Executa($sql, "SITE");
	}
	
	public static function addSkills($newSkills) {
		$sql = "INSERT INTO user_skill (char_id, skill_id, skill_lev, to_end_time, subjob_id) VALUES ".$newSkills;
		return DB::Executa($sql, "WORLD");
	}

	public static function updClassInOlympiad($class, $cid) {
		
		$sql = DB::Executa("UPDATE olympiad_match SET class = '".$class."' WHERE char_id = '".$cid."'", "WORLD");
		if(!$sql) { return false; }
		
		$sql = DB::Executa("UPDATE olympiad_result SET class = '".$class."' WHERE char_id = '".$cid."'", "WORLD");
		if(!$sql) { return false; }
		
		return true;
		
	}

	public static function updBaseClass($class, $cid, $lvl=78, $exp=1511275834, $race) {
		$sql = "UPDATE user_data SET class = '".$class."', subjob0_class = '".$class."', face_index = '0', hair_shape_index = '0', hair_color_index = '0' ".($lvl < 78 ? ", Lev = '78'" : "")." ".($exp < 1511275834 ? ", Exp = '1511275834'" : "").", race = '".$race."' WHERE char_id = '".$cid."'";
		return DB::Executa($sql, "WORLD");
	}
	
	public static function moveAllPaperdoll($cid) {
		$sql = "UPDATE user_data SET 
	      ST_underware = '0', 
	      ST_right_ear = '0', 
	      ST_left_ear = '0', 
	      ST_neck = '0', 
	      ST_right_finger = '0', 
	      ST_left_finger = '0', 
	      ST_head = '0', 
	      ST_right_hand = '0', 
	      ST_left_hand = '0', 
	      ST_gloves = '0', 
	      ST_chest = '0', 
	      ST_legs = '0', 
	      ST_feet = '0', 
	      ST_back = '0', 
	      ST_both_hand = '0'
	      WHERE char_id = '".$cid."'";
		return DB::Executa($sql, "WORLD");
	}
	
	public static function countNewAccChars($acc) {
		$sql = "SELECT COUNT(*) AS quant FROM user_data WHERE account_name = '".$acc."'";
		return DB::Executa($sql, "WORLD");
		
	}

	public static function checkHasClassInSub($cid, $classes) {
		$sql = "SELECT TOP 1 * FROM user_data WHERE char_id = '".$cid."' AND (subjob0_class IN (".$classes.") OR subjob1_class IN (".$classes.") OR subjob2_class IN (".$classes.") OR subjob3_class IN (".$classes."))";
		return DB::Executa($sql, "WORLD");
		
	}

}

