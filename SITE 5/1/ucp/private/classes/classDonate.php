<?php

class Donate {
	
	public static function listChars($acc) {
		
		$sql = DB::Executa("SELECT char_name, obj_Id FROM characters WHERE account_name = '".$acc."' LIMIT 7");
		return $sql;
		
	}
	
	public static function findChar($acc, $personagem) {
		
		$sql = DB::Executa("SELECT obj_Id, online FROM characters WHERE account_name = '".$acc."' AND obj_Id = '".$personagem."' LIMIT 1");
		return $sql;
		
	}
	
	public static function insertDonation($acc, $personagem, $metodo_pgto, $qtdCoins, $qtdBonus, $valor, $price, $curr) {
		
		$sql = DB::Executa("INSERT INTO site_donations (account, personagem, price, currency, metodo_pgto, quant_coins, coins_bonus, valor, data) VALUES ('".$acc."', '".intval($personagem)."', '".$price."', '".$curr."', '".$metodo_pgto."', '".$qtdCoins."', '".$qtdBonus."', '".$valor."', '".time()."')");
		return $sql;
		
	}
	
	public static function findDonation($acc, $protocolo='') {
		
		$sql = DB::Executa("SELECT D.*, C.char_name FROM site_donations AS D LEFT JOIN characters AS C ON C.obj_Id = D.personagem WHERE D.account = '".$acc."' ".(!empty($protocolo) ? "AND D.protocolo = '".$protocolo."'" : "")." AND D.status <> '2' ORDER BY D.data DESC");
		return $sql;
		
	}
	
	public static function listConverts($acc) {
		
		$sql = DB::Executa("SELECT T.*, C.char_name FROM site_log_convertcoins AS T INNER JOIN characters AS C ON C.obj_Id = T.destinatario WHERE T.account = '".$acc."' ORDER BY T.cdata DESC");
		return $sql;
		
	}
	
	public static function listTransfers($acc) {
		
		$sql = DB::Executa("SELECT T.*, C.char_name FROM site_log_transfercoins AS T INNER JOIN characters AS C ON C.obj_Id = T.destinatario_char WHERE T.remetente = '".$acc."' ORDER BY T.tdata DESC");
		return $sql;
		
	}
	
	public static function deleteDonation($acc, $protocolo) {
		
		$sql = DB::Executa("UPDATE site_donations SET status = '2' WHERE account = '".$acc."' AND protocolo = '".$protocolo."' LIMIT 1");
		return $sql;
		
	}
	
	public static function findReceptor($dest) {
		
		$sql = DB::Executa("SELECT account_name, online, obj_Id FROM characters WHERE char_name = '".$dest."' LIMIT 1");
		return $sql;
		
	}
	
	public static function insertBalance($dest, $count) {
		
		$checkExists = DB::Executa("SELECT * FROM site_balance WHERE account = '".$dest."' LIMIT 1");
		if(count($checkExists) > 0) {
			$sql = DB::Executa("UPDATE site_balance SET saldo = (saldo+".$count.") WHERE account = '".$dest."' LIMIT 1");
		} else {
			$sql = DB::Executa("INSERT INTO site_balance (account, saldo) VALUES ('".$dest."', '".$count."')");
		}
		
		return $sql;
		
	}
	
	public static function transferLog($count, $acc, $receptor, $dest) {
		
		$sql = DB::Executa("INSERT INTO site_log_transfercoins VALUES ('".$count."', '".$acc."', '".$receptor."', '".$dest."', '".date('Y-m-d H:i:s', time())."')");
		return $sql;
		
	}
	
	public static function convertLog($count, $acc, $receptor) {
		
		$sql = DB::Executa("INSERT INTO site_log_convertcoins VALUES ('".$count."', '".$acc."', '".$receptor."', '".date('Y-m-d H:i:s', time())."')");
		return $sql;
		
	}
	
	public static function searchCoinExist($cid, $coinID) {
		
		$sql = DB::Executa("SELECT object_id FROM items WHERE owner_id = '".$cid."' AND item_id = '".$coinID."' AND loc = 'INVENTORY' LIMIT 1");
		return $sql;
		
	}
	
	public static function insertCoinInGame($cid, $coinID, $count, $object_id=0) {
		
		if($object_id != 0) {
			
			$insert = DB::Executa("UPDATE items SET count = (count+".$count.") WHERE object_id = '".$object_id."' AND owner_id = '".$cid."' LIMIT 1");
			
		} else {
			
			$last_object_id = DB::Executa("SELECT object_id FROM items ORDER BY object_id DESC LIMIT 1");
			$last_object_id = intval(trim($last_object_id[0]['object_id']));
			
			$last_loc_data = DB::Executa("SELECT loc_data FROM items WHERE owner_id = '".$cid."' ORDER BY loc_data DESC LIMIT 1");
			$last_loc_data = intval(trim($last_loc_data[0]['loc_data']));
			
			$insert = DB::Executa("INSERT INTO items 
			(owner_id, object_id, item_id, count, enchant_level, loc, loc_data) VALUES 
			(".$cid.", ".($last_object_id+1).", ".$coinID.", ".$count.", 0, 'INVENTORY', ".($last_loc_data+1).")");
			
		}
		
		return $insert;
		
	}
	
}

