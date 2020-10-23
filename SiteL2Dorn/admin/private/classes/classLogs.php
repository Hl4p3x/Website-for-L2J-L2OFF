<?php

class Logs {

	public static function countShopLogs($buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			if(is_numeric($buscar)) { $buscarN = $buscar; } else { $buscarN = 0; }
			$whereAdd .= "WHERE (C.char_name LIKE '%".$buscar."%' OR S.log_cid = '".$buscarN."' OR S.log_item_id = '".$buscarN."' OR S.log_item_name LIKE '%".$buscar."%' OR S.log_item_sa LIKE '%".$buscar."%' OR S.log_pack_id = '".$buscarN."' OR S.log_amount = '".$buscarN."' OR S.log_price = '".$buscarN."' OR S.log_item_objs_id LIKE '%".$buscar."%' OR S.log_account LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT COUNT(*) AS quant FROM site_log_shop AS S ".((!empty($buscar)) ? "LEFT JOIN characters AS C ON C.obj_Id = S.log_cid" : "")." ".$whereAdd;
		return DB::Executa($sql);
		
	}

	public static function listShopLogs($pgBeg, $pgMax, $buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			if(is_numeric($buscar)) { $buscarN = $buscar; } else { $buscarN = 0; }
			$whereAdd .= "WHERE (C.char_name LIKE '%".$buscar."%' OR S.log_cid = '".$buscarN."' OR S.log_item_id = '".$buscarN."' OR S.log_item_name LIKE '%".$buscar."%' OR S.log_item_sa LIKE '%".$buscar."%' OR S.log_pack_id = '".$buscarN."' OR S.log_amount = '".$buscarN."' OR S.log_price = '".$buscarN."' OR S.log_item_objs_id LIKE '%".$buscar."%' OR S.log_account LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT S.*, C.char_name FROM site_log_shop AS S LEFT JOIN characters AS C ON C.obj_Id = S.log_cid ".$whereAdd." ORDER BY S.log_date DESC LIMIT ".$pgBeg.", ".$pgMax;
		return DB::Executa($sql);
		
	}

	public static function countServicesLogs($buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			if(is_numeric($buscar)) { $buscarN = $buscar; } else { $buscarN = 0; }
			$whereAdd .= "WHERE (C.char_name LIKE '%".$buscar."%' OR S.log_cid = '".$buscarN."' OR S.log_account LIKE '%".$buscar."%' OR S.log_value LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT COUNT(*) AS quant FROM site_log_services AS S ".((!empty($buscar)) ? "LEFT JOIN characters AS C ON C.obj_Id = S.log_cid" : "")." ".$whereAdd;
		return DB::Executa($sql);
		
	}

	public static function listServicesLogs($pgBeg, $pgMax, $buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			if(is_numeric($buscar)) { $buscarN = $buscar; } else { $buscarN = 0; }
			$whereAdd .= "WHERE (C.char_name LIKE '%".$buscar."%' OR S.log_cid = '".$buscarN."' OR S.log_account LIKE '%".$buscar."%' OR S.log_value LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT S.*, C.char_name FROM site_log_services AS S LEFT JOIN characters AS C ON C.obj_Id = S.log_cid ".$whereAdd." ORDER BY S.log_date DESC LIMIT ".$pgBeg.", ".$pgMax;
		return DB::Executa($sql);
		
	}

	public static function countTransfDonateLogs($buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			if(is_numeric($buscar)) { $buscarN = $buscar; } else { $buscarN = 0; }
			$whereAdd .= "WHERE (T.quantidade = '".$buscarN."' OR T.remetente LIKE '%".$buscar."%' OR C.char_name LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT COUNT(*) AS quant FROM site_log_transfercoins AS T INNER JOIN characters AS C ON C.obj_Id = T.destinatario_char ".$whereAdd;
		return DB::Executa($sql);
		
	}

	public static function listTransfDonateLogs($pgBeg, $pgMax, $buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			if(is_numeric($buscar)) { $buscarN = $buscar; } else { $buscarN = 0; }
			$whereAdd .= "WHERE (T.quantidade = '".$buscarN."' OR T.remetente LIKE '%".$buscar."%' OR C.char_name LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT * FROM site_log_transfercoins AS T INNER JOIN characters AS C ON C.obj_Id = T.destinatario_char ".$whereAdd." ORDER BY T.tdata DESC LIMIT ".$pgBeg.", ".$pgMax;
		return DB::Executa($sql);
		
	}

	public static function countConvDonateLogs($buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			if(is_numeric($buscar)) { $buscarN = $buscar; } else { $buscarN = 0; }
			$whereAdd .= "WHERE (T.quantidade = '".$buscarN."' OR T.account LIKE '%".$buscar."%' OR C.char_name LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT COUNT(*) AS quant FROM site_log_convertcoins AS T INNER JOIN characters AS C ON C.obj_Id = T.destinatario ".$whereAdd;
		return DB::Executa($sql);
		
	}

	public static function listConvDonateLogs($pgBeg, $pgMax, $buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			if(is_numeric($buscar)) { $buscarN = $buscar; } else { $buscarN = 0; }
			$whereAdd .= "WHERE (T.quantidade = '".$buscarN."' OR T.account LIKE '%".$buscar."%' OR C.char_name LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT * FROM site_log_convertcoins AS T INNER JOIN characters AS C ON C.obj_Id = T.destinatario ".$whereAdd." ORDER BY T.cdata DESC LIMIT ".$pgBeg.", ".$pgMax;
		return DB::Executa($sql);
		
	}

	public static function countAdminLogs($buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			$whereAdd .= "WHERE (log_value LIKE '%".$buscar."%' OR log_ip LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT COUNT(*) as quant FROM site_log_admin ".$whereAdd;
		return DB::Executa($sql);
		
	}

	public static function listAdminLogs($pgBeg, $pgMax, $buscar='') {
		
		$whereAdd = "";
		
		if(!empty($buscar)) {
			$whereAdd .= "WHERE (log_value LIKE '%".$buscar."%' OR log_ip LIKE '%".$buscar."%')";
		}
		
		$sql = "SELECT * FROM site_log_admin ".$whereAdd." ORDER BY log_date DESC LIMIT ".$pgBeg.", ".$pgMax;
		return DB::Executa($sql);
		
	}

}
