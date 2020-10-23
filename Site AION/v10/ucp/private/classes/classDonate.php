<?php

class Donate {
	
	public static function listChars($acc) {
		
		$sql = DB::Executa("SELECT char_name, charId FROM characters WHERE account_name = '".$acc."' LIMIT 7");
		return $sql;
		
	}
	
	public static function findChar($acc, $personagem) {
		
		$sql = DB::Executa("SELECT charId, online FROM characters WHERE account_name = '".$acc."' AND charId = '".$personagem."' LIMIT 1");
		return $sql;
		
	}
	
	public static function insertDonation($acc, $personagem, $metodo_pgto, $qtdCoins, $qtdBonus, $valor, $price, $curr) {
		
		$sql = DB::Executa("INSERT INTO site_donations (account, personagem, price, currency, metodo_pgto, quant_coins, coins_bonus, valor, data) VALUES ('".$acc."', '".intval($personagem)."', '".$price."', '".$curr."', '".$metodo_pgto."', '".$qtdCoins."', '".$qtdBonus."', '".$valor."', '".time()."')");
		return $sql;
		
	}
	
	public static function findDonation($acc, $protocolo='') {
		
		$sql = DB::Executa("SELECT D.*, C.char_name FROM site_donations AS D LEFT JOIN characters AS C ON C.charId = D.personagem WHERE D.account = '".$acc."' ".(!empty($protocolo) ? "AND D.protocolo = '".$protocolo."'" : "")." AND D.status <> '2' ORDER BY D.data DESC");
		return $sql;
		
	}
	
	public static function listConverts($acc) {
		
		$sql = DB::Executa("SELECT T.*, C.char_name FROM site_log_convertcoins AS T INNER JOIN characters AS C ON C.charId = T.destinatario WHERE T.account = '".$acc."' ORDER BY T.cdata DESC");
		return $sql;
		
	}
	
	public static function listTransfers($acc) {
		
		$sql = DB::Executa("SELECT T.*, C.char_name FROM site_log_transfercoins AS T INNER JOIN characters AS C ON C.charId = T.destinatario_char WHERE T.remetente = '".$acc."' ORDER BY T.tdata DESC");
		return $sql;
		
	}
	
	public static function deleteDonation($acc, $protocolo) {
		
		$sql = DB::Executa("UPDATE site_donations SET status = '2' WHERE account = '".$acc."' AND protocolo = '".$protocolo."' LIMIT 1");
		return $sql;
		
	}
	
	public static function findReceptor($dest) {
		
		$sql = DB::Executa("SELECT account_name, online, charId FROM characters WHERE char_name = '".$dest."' LIMIT 1");
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
		
		$sql = DB::Executa("INSERT INTO site_log_transfercoins VALUES ('".$count."', '".$acc."', '".$receptor."', '".$dest."', NOW())");
		return $sql;
		
	}
	
	public static function convertLog($count, $acc, $receptor) {
		
		$sql = DB::Executa("INSERT INTO site_log_convertcoins VALUES ('".$count."', '".$acc."', '".$receptor."', NOW())");
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
			
			$last_object_id = DB::Executa("SELECT object_id FROM items WHERE object_id LIKE '7%' ORDER BY object_id DESC LIMIT 1");
			if(count($last_object_id) == 0) {
				$last_object_id = 700000000;
			} else {
				$last_object_id = (!empty($last_object_id[0]['object_id']) ? intval(trim($last_object_id[0]['object_id'])) : 700000000);
			}
			
			$last_loc_data = DB::Executa("SELECT loc_data FROM items WHERE owner_id = '".$cid."' ORDER BY loc_data DESC LIMIT 1");
			if(count($last_object_id) == 0) {
				$last_loc_data = 0;
			} else {
				$last_loc_data = (!empty($last_loc_data[0]['loc_data']) ? intval(trim($last_loc_data[0]['loc_data'])) : 0);
			}
			
			$insert = DB::Executa("INSERT INTO items 
			(owner_id, object_id, item_id, count, enchant_level, loc, loc_data) VALUES 
			(".$cid.", ".($last_object_id+1).", ".$coinID.", ".$count.", 0, 'INVENTORY', ".($last_loc_data+1).")");
			
		}
		
		return $insert;
		
	}
	
	public static function checkExistCount($itemID, $char) {
		
		$sql = DB::Executa("SELECT SUM(count) AS count FROM items WHERE item_id = '".$itemID."' AND owner_id = '".$char."'");
		return $sql;
		
	}
	
	public static function removeIngameCoins($coinID, $count, $char) {
		
		$countExist=0; $inINVE=0; $inWARE=0;
		$searchItemINVE = DB::Executa("SELECT count, object_id FROM items WHERE owner_id = '".$char."' AND item_id = '".$coinID."' AND loc = 'INVENTORY' LIMIT 1");
		$searchItemWARE = DB::Executa("SELECT count, object_id FROM items WHERE owner_id = '".$char."' AND item_id = '".$coinID."' AND loc = 'WAREHOUSE' LIMIT 1");
		if(count($searchItemINVE) > 0) { $countExist += intval($searchItemINVE[0]['count']); $inINVE=intval($searchItemINVE[0]['count']); }
		if(count($searchItemWARE) > 0) { $countExist += intval($searchItemWARE[0]['count']); $inWARE=intval($searchItemWARE[0]['count']); }
		if($countExist < $count) {
			return false;
		}
		
		if($inINVE > 0 && $inINVE <= $count) {
			if(!DB::Executa("DELETE FROM items WHERE object_id = '".$searchItemINVE[0]['object_id']."' LIMIT 1")) {
				return false;
			}
		} else if($inINVE > $count) {
			if(!DB::Executa("UPDATE items SET count = (count-".$count.") WHERE object_id = '".$searchItemINVE[0]['object_id']."' LIMIT 1")) {
				return false;
			}
		}
		
		if($count > $inINVE)  {
			$tirarDoWare = $count - $inINVE;
			if($tirarDoWare == $inWARE) {
				if(!DB::Executa("DELETE FROM items WHERE object_id = '".$searchItemWARE[0]['object_id']."' LIMIT 1")) {
					return false;
				}
			} else {
				if(!DB::Executa("UPDATE items SET count = (count-".$tirarDoWare.") WHERE object_id = '".$searchItemWARE[0]['object_id']."' LIMIT 1")) {
					return false;
				}
			}
		}
		
		return true;
		
	}
	
	public static function convertOnlineLog($count, $acc, $receptor) {
		
		$sql = DB::Executa("INSERT INTO site_log_convertcoins_online VALUES ('".$count."', '".$acc."', '".$receptor."', NOW())");
		return $sql;
		
	}
	
	public static function listConvertsOnline($acc) {
		
		$sql = DB::Executa("SELECT T.*, C.char_name FROM site_log_convertcoins_online AS T INNER JOIN characters AS C ON C.charId = T.personagem WHERE T.account = '".$acc."' ORDER BY T.cdata DESC");
		return $sql;
		
	}
	
}


