<?php

class Stats {

	public static function TopPvP($limit) {
		
		$sql = DB::Executa("SELECT C.char_name, C.pvpkills, C.pkkills, C.online, C.onlinetime, D.clan_name FROM characters AS C LEFT JOIN clan_data AS D ON D.clan_id = C.clanid WHERE C.accesslevel = '0' ORDER BY pvpkills DESC, pkkills DESC, onlinetime DESC, char_name ASC LIMIT ".$limit);
		return $sql;
		
	}
	
	public static function TopPk($limit) {
		
		$sql = DB::Executa("SELECT C.char_name, C.pvpkills, C.pkkills, C.online, C.onlinetime, D.clan_name FROM characters AS C LEFT JOIN clan_data AS D ON D.clan_id = C.clanid WHERE C.accesslevel = '0' ORDER BY pkkills DESC, pvpkills DESC, onlinetime DESC, char_name ASC LIMIT ".$limit);
		return $sql;
		
	}
	
	public static function TopOnline($limit) {
		
		$sql = DB::Executa("SELECT C.char_name, C.pvpkills, C.pkkills, C.online, C.onlinetime, D.clan_name FROM characters AS C LEFT JOIN clan_data AS D ON D.clan_id = C.clanid WHERE C.accesslevel = '0' ORDER BY onlinetime DESC, pvpkills DESC, pkkills DESC, char_name ASC LIMIT ".$limit);
		return $sql;
		
	}
	
	public static function TopClan($limit) {
		
		$sql = DB::Executa("
			SELECT
				C.clan_name,
				C.clan_level,
				C.reputation_score,
				C.ally_name,
				P.char_name,
				(SELECT COUNT(*) FROM characters WHERE clanid = C.clan_id) AS membros
			FROM
				clan_data AS C
			LEFT JOIN
				characters AS P ON P.obj_Id = C.leader_id
			ORDER BY
				C.clan_level DESC, C.reputation_score DESC, membros DESC
			LIMIT ".$limit."
		");
		return $sql;
		
	}
	
	public static function OlympiadRanking() {
		
		$sql = DB::Executa("
			SELECT 
				C.char_name, 
				C.online, 
				D.clan_name, 
				O.class_id AS base, 
				O.olympiad_points
			FROM
				olympiad_nobles AS O
			LEFT JOIN
				characters AS C ON C.obj_Id = O.charId
			LEFT JOIN
				clan_data AS D ON D.clan_id = C.clanid 
			ORDER BY olympiad_points DESC
		");
		return $sql;
		
	}
	
	public static function OlympiadAllHeroes() {
		
		$sql = DB::Executa("
			SELECT 
				C.char_name, 
				C.online, 
				D.clan_name, 
				D.ally_name, 
				H.class_id AS base, 
				H.count AS count
			FROM
				heroes AS H
			LEFT JOIN
				characters AS C ON C.obj_Id = H.charId
			LEFT JOIN
				clan_data AS D ON D.clan_id = C.clanid 
			WHERE
				H.played > 0 AND H.count > 0
			ORDER BY count DESC, base ASC, char_name ASC
		");
		return $sql;
		
	}
	
	public static function OlympiadCurrentHeroes() {
		
		$sql = DB::Executa("
			SELECT 
				C.char_name, 
				C.online, 
				D.clan_name, 
				D.ally_name, 
				H.class_id AS base
			FROM
				heroes AS H
			LEFT JOIN
				characters AS C ON C.obj_Id = H.charId
			LEFT JOIN
				clan_data AS D ON D.clan_id = C.clanid 
			WHERE
				H.played > 0 AND H.count > 0
			ORDER BY base ASC
		");
		return $sql;
		
	}
	
	public static function GrandbossStatus() {
		
		$sql = DB::Executa("
			SELECT 
				B.boss_id, 
				B.respawn_time AS respawn, 
				N.name, 
				N.level
			FROM
				grandboss_data AS B
			INNER JOIN
				site_bosses AS N ON N.id = B.boss_id
			ORDER BY respawn DESC, level DESC, name ASC
		");
		return $sql;
		
	}
	
	public static function RaidbossStatus() {
		
		$sql = DB::Executa("
			SELECT 
				B.boss_id, 
				B.respawn_time AS respawn, 
				N.name, 
				N.level
			FROM
				raidboss_spawnlist AS B
			INNER JOIN
				site_bosses AS N ON N.id = B.boss_id
			ORDER BY respawn DESC, level DESC, name ASC
		");
		return $sql;
		
	}
	
	public static function Siege() {
		
		$sql = DB::Executa("
			SELECT
				W.id, 
				W.name, 
				W.siegeDate AS sdate, 
				W.taxPercent AS stax, 
				P.char_name, 
				C.clan_name, 
				C.ally_name
			FROM
				castle AS W
			LEFT JOIN
				clan_data AS C ON C.hasCastle = W.id
			LEFT JOIN
				characters AS P ON P.obj_Id = C.leader_id
		");
		return $sql;
		
	}
	
	public static function SiegeParticipants($castle_id) {
		
		$sql = DB::Executa("
			SELECT
				S.type, 
				C.clan_name
			FROM
				siege_clans AS S
			LEFT JOIN
				clan_data AS C ON C.clan_id = S.clan_id
			WHERE
				S.castle_id = '".$castle_id."'
		");
		return $sql;
		
	}
	
}
