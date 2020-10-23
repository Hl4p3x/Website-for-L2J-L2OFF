<?php

class Action {

	public static function Unstuck($cid, $x, $y, $z) {
		
		$sql = DB::Executa("UPDATE characters SET x = '".$x."', y = '".$y."', z = '".$z."' WHERE charId = '".$cid."' AND online = '0' AND karma = '0' AND curHp = maxHp AND curCp = maxCp LIMIT 1");
		return $sql;
		
	}
	
}
