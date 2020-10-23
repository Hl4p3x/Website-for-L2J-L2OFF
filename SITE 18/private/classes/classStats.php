<?php

class Stats {

	public static function PlayersOnline() {
		
		$sql = DB::Executa("SELECT COUNT(*) AS quant FROM characters WHERE online > 0");
		return $sql;
		
	}
	public static function TopPvP1($limit) {
		
		$sql = DB::Executa("SELECT C.char_name, C.pvpkills, C.pkkills, C.online, C.onlinetime, D.clan_name FROM characters AS C LEFT JOIN clan_data AS D ON D.clan_id = C.clanid WHERE C.accesslevel = '0' ORDER BY pvpkills DESC, pkkills DESC, onlinetime DESC, char_name ASC LIMIT ".$limit);
		return $sql;
		
	}
	
	public static function TopPk1($limit) {
		
		$sql = DB::Executa("SELECT C.char_name, C.pvpkills, C.pkkills, C.online, C.onlinetime, D.clan_name FROM characters AS C LEFT JOIN clan_data AS D ON D.clan_id = C.clanid WHERE C.accesslevel = '0' ORDER BY pkkills DESC, pvpkills DESC, onlinetime DESC, char_name ASC LIMIT ".$limit);
		return $sql;
		
	}
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
	
	public static function TopLevel($limit) {
		
		$sql = DB::Executa("SELECT C.char_name, C.pvpkills, C.pkkills, C.online, C.onlinetime, C.level, D.clan_name FROM characters AS C LEFT JOIN clan_data AS D ON D.clan_id = C.clanid WHERE C.accesslevel = '0' ORDER BY level DESC, exp DESC, onlinetime DESC, char_name ASC LIMIT ".$limit);
		return $sql;
		
	}
	
	public static function TopAdena($limit, $adnBillionItem) {
		$sql = "
		SELECT 
			C.char_name, 
			C.online, 
			C.onlinetime, 
			C.level, 
			D.clan_name, 
			(";
		
		if($adnBillionItem != 0) {
			$sql .= "
					IFNULL( (SELECT (SUM(I2.count) * 1000000000) FROM items AS I2 WHERE I2.owner_id = C.charId AND I2.item_id = '".$adnBillionItem."' GROUP BY I2.owner_id) , 0)
					+
				";
		}
				
		$sql .= "
				IFNULL( (SELECT SUM(I1.count) FROM items AS I1 WHERE I1.owner_id = C.charId AND I1.item_id = '57' GROUP BY I1.owner_id) , 0)
			) AS adenas
		FROM 
			characters AS C 
		LEFT JOIN 
			clan_data AS D ON D.clan_id = C.clanid WHERE C.accesslevel = '0'
		ORDER BY
			adenas DESC, onlinetime DESC, char_name ASC
		LIMIT ".$limit;
		return DB::Executa($sql);
		
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
				characters AS P ON P.charId = C.leader_id
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
				characters AS C ON C.charId = O.charId
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
				characters AS C ON C.charId = H.charId
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
				characters AS C ON C.charId = H.charId
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
				grandboss_intervallist AS B
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
				characters AS P ON P.charId = C.leader_id
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
				clan_data AS C ON C.clanid = S.clanid
			WHERE
				S.castle_id = '".$castle_id."'
		");
		return $sql;
		
	}
	
	public static function BossJwlLoc($bossJwlIds) {
		
		$sql = DB::Executa("
		SELECT
			I.owner_id, 
			I.item_id, 
			SUM(I.count) AS count, 
			C.char_name, 
			P.clan_name
		FROM
			items AS I
		INNER JOIN
			characters AS C ON C.charId = I.owner_id
		LEFT JOIN
			clan_data AS P ON P.clan_id = C.clanid
		WHERE
			I.item_id IN (".$bossJwlIds.")
		GROUP BY
			I.owner_id, C.char_name, P.clan_name, I.item_id
		ORDER BY
			count DESC, C.char_name ASC

		");
		return $sql;
		
	}
	
}
