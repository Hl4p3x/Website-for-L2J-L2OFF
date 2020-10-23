<?php

class Donate {

	public static function countDonations( $buscar='', $status='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			$whereAdd .= " AND (D.protocolo LIKE '%".$buscar."%' OR D.metodo_pgto LIKE '%".$buscar."%' OR D.account LIKE '%".$buscar."%' OR C.char_name LIKE '%".$buscar."%' OR (D.quant_coins + D.coins_bonus) = '".$buscar."' OR D.quant_coins = '".$buscar."' OR D.valor = '".(intval($buscar) > 0 ? save_preco($buscar) : 0)."')";
		}

		if(!empty($status)) {
			$whereAdd .= " AND D.status = '".$status."'";
		}
		
		$sql = "SELECT COUNT(*) AS quant FROM site_donations AS D LEFT JOIN characters AS C ON C.obj_Id = D.personagem WHERE D.status <> '2' ".$whereAdd;
		return DB::Executa($sql);
		
	}

	public static function listDonations($pgBeg, $pgMax, $buscar='', $status='') {
		
		$whereAdd = "";

		if(!empty($buscar)) {
			$whereAdd .= " AND (D.protocolo LIKE '%".$buscar."%' OR D.metodo_pgto LIKE '%".$buscar."%' OR D.account LIKE '%".$buscar."%' OR C.char_name LIKE '%".$buscar."%' OR (D.quant_coins + D.coins_bonus) = '".$buscar."' OR D.quant_coins = '".$buscar."' OR D.valor = '".(intval($buscar) > 0 ? save_preco($buscar) : 0)."')";
		}

		if(!empty($status)) {
			$whereAdd .= " AND D.status = '".$status."'";
		}
		
		$sql = "SELECT D.*, C.char_name FROM site_donations AS D LEFT JOIN characters AS C ON C.obj_Id = D.personagem WHERE D.status <> '2' ".$whereAdd." ORDER BY D.data DESC LIMIT ".$pgBeg.", ".$pgMax;
		return DB::Executa($sql);
		
	}

	public static function findConcluidas() {
		
		$sql = "SELECT COUNT(*) AS quant FROM site_donations WHERE status = '3' OR status = '4'";
		return DB::Executa($sql);
		
	}

	public static function searchValTotal() {
		
		$sql = "SELECT SUM(valor) AS val, currency FROM site_donations WHERE status = '3' OR status = '4' GROUP BY currency";
		return DB::Executa($sql);
		
	}

	public static function countPending($buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			$whereAdd .= " AND (D.protocolo LIKE '%".$buscar."%' OR D.metodo_pgto LIKE '%".$buscar."%' OR D.account LIKE '%".$buscar."%' OR C.char_name LIKE '%".$buscar."%' OR (D.quant_coins + D.coins_bonus) = '".$buscar."' OR D.quant_coins = '".$buscar."' OR D.valor = '".(intval($buscar) > 0 ? save_preco($buscar) : 0)."')";
		}

		$sql = "SELECT COUNT(*) AS quant FROM site_donations AS D LEFT JOIN characters AS C ON C.obj_Id = D.personagem WHERE (D.status = '1' OR D.status = '3') ".$whereAdd;
		return DB::Executa($sql);
		
	}

	public static function listPending($pgBeg, $pgMax, $buscar='') {
		
		$whereAdd = "";

		if(!empty($buscar)) {
			$whereAdd .= " AND (D.protocolo LIKE '%".$buscar."%' OR D.metodo_pgto LIKE '%".$buscar."%' OR D.account LIKE '%".$buscar."%' OR C.char_name LIKE '%".$buscar."%' OR (D.quant_coins + D.coins_bonus) = '".$buscar."' OR D.quant_coins = '".$buscar."' OR D.valor = '".(intval($buscar) > 0 ? save_preco($buscar) : 0)."')";
		}

		$sql = "SELECT D.*, C.char_name FROM site_donations AS D LEFT JOIN characters AS C ON C.obj_Id = D.personagem WHERE (D.status = '1' OR D.status = '3') ".$whereAdd." ORDER BY D.status DESC, D.data DESC LIMIT ".$pgBeg.", ".$pgMax;
		return DB::Executa($sql);
		
	}

	public static function findDonation($protocolo) {
		
		$sql = "SELECT D.*, C.char_name FROM site_donations AS D LEFT JOIN characters AS C ON C.obj_Id = D.personagem WHERE D.status <> '2' AND protocolo = '".$protocolo."' LIMIT 1";
		return DB::Executa($sql);
		
	}

	public static function paidDonation($protocolo, $data, $coinsEntregues) {
		
		$sql = "UPDATE site_donations SET status = '4', coins_entregues = '".$coinsEntregues."', ultima_alteracao = '".$data."' WHERE protocolo = '".$protocolo."' AND status <> '2' LIMIT 1";
		return DB::Executa($sql);
		
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

	public static function deleteDonation($protocolo) {
		
		$sql = "UPDATE site_donations SET status = '2' WHERE protocolo = '".$protocolo."' AND status <> '2' LIMIT 1";
		return DB::Executa($sql);
		
	}

}
