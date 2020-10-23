<?php

class Account {

	public static function checkLoginExists($login) {
		
		$sql = DB::Executa("SELECT * FROM accounts WHERE login = '".$login."' LIMIT 1");
		return $sql;
		
	}
	
	public static function checkEmailExists($email) {
		
		$sql = DB::Executa("SELECT login, email FROM accounts WHERE email = '".$email."'");
		return $sql;
		
	}
	
	public static function insertRegCode($login, $confirm_code) {
		
		$sql = DB::Executa("INSERT INTO site_reg_code (account, code, date) VALUES ('".$login."', '".$confirm_code."', '".time()."')");
		return $sql;
		
	}
	
	public static function Register($login, $pass, $accLvl, $email) {
		
		$pass = base64_encode(pack('H*', sha1($pass)));
		$sql = DB::Executa("INSERT INTO accounts (login, password, access_level, email, created_time) VALUES ('".$login."', '".$pass."', '".$accLvl."', '".$email."', '".time()."')");
		return $sql;
		
	}
	
	public static function insertForgotCode($val, $code) {
		
		$sql = DB::Executa("INSERT INTO site_forgotpass VALUES ('".$val."', '".$code."', '".time()."')");
		return $sql;
		
	}
	
	public static function deleteForgotExpiredCodes() {
		
		$sql = DB::Executa("DELETE FROM site_forgotpass WHERE date < '".(time()-86400)."'");
		return $sql;
		
	}
	
	public static function checkForgotCode($acc, $code) {
		
		$sql = DB::Executa("SELECT account, code FROM site_forgotpass WHERE account = '".$acc."' AND code = '".$code."' LIMIT 1");
		return $sql;
		
	}
	
	public static function deleteForgotCode($val) {
		
		$sql = DB::Executa("DELETE FROM site_forgotpass WHERE account = '".$val."' LIMIT 1");
		return $sql;
		
	}
	
	public static function updatePass($pass, $login) {
		
		$pass = base64_encode(pack('H*', sha1($pass)));
		$sql = DB::Executa("UPDATE accounts SET password = '".$pass."' WHERE login = '".$login."' LIMIT 1");
		return $sql;
		
	}
	
	public static function updatePassGroup($pass, $logins) {
		
		$pass = base64_encode(pack('H*', sha1($pass)));
		$sql = DB::Executa("UPDATE accounts SET password = '".$pass."' WHERE login IN (".$logins.")");
		return $sql;
		
	}
	
	public static function deleteRegExpiredCodes() {
		
		$expireds = DB::Executa("SELECT account FROM site_reg_code WHERE date < '".(time()-86400)."'");
		if(count($expireds) > 0) {
			
			$sql = DB::Executa("DELETE FROM site_reg_code WHERE date < '".(time()-86400)."'");
			if(!$sql) { return false; }
			
			$accs="";
			for($i=0; $i < count($expireds); $i++) {
				$accs .= "'".$expireds[$i]['account']."', ";
			}
			$accs = substr($accs, 0, -2);
			
			$sql = DB::Executa("DELETE FROM accounts WHERE login IN (".$accs.") AND access_level < 0 AND (lastactive IS NULL OR lastactive = '')");
			if(!$sql) { return false; }
			
		}
		
		return true;
		
	}

	public static function checkRegCode($acc, $code) {
		
		$sql = DB::Executa("SELECT account, code FROM site_reg_code WHERE account = '".$acc."' AND code = '".$code."' LIMIT 1");
		return $sql;
		
	}
	
	public static function deleteRegCode($val) {
		
		$sql = DB::Executa("DELETE FROM site_reg_code WHERE account = '".$val."' LIMIT 1");
		return $sql;
		
	}
	
	public static function updateAccessLevel($access, $login) {
		
		$sql = DB::Executa("UPDATE accounts SET access_level = '".$access."' WHERE login = '".$login."' LIMIT 1");
		return $sql;
		
	}
	
}
