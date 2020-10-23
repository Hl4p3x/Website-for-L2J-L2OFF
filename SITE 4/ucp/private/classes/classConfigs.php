<?php

class Configs {
	
	public static function accData($login) {
		
		$sql = DB::Executa("SELECT * FROM accounts WHERE login = '".$login."' LIMIT 1");
		return $sql;
		
	}
	
	public static function changeData($acc, $pass) {
		
		$sql = DB::Executa("UPDATE accounts SET password = '".base64_encode(pack('H*', sha1(trim($pass))))."' WHERE login = '".$acc."' LIMIT 1");
		return $sql;
		
	}
	
	public static function checkLoginExists($login) {
		
		$sql = DB::Executa("SELECT * FROM accounts WHERE login = '".$login."' LIMIT 1");
		return $sql;
		
	}
	
	public static function checkEmailExists($email) {
		
		$sql = DB::Executa("SELECT login, email FROM accounts WHERE email = '".$email."'");
		return $sql;
		
	}
	
	public static function insertEmailCode($email, $code, $acc) {
		
		$sql = DB::Executa("INSERT INTO site_emailchange VALUES ('".$acc."', '".$email."', '".$code."', '".time()."')");
		return $sql;
		
	}
	
	public static function checkEmailCode($acc, $code) {
		
		$sql = DB::Executa("SELECT * FROM site_emailchange WHERE account = '".$acc."' AND code = '".$code."' LIMIT 1");
		return $sql;
		
	}
	
	public static function deleteEmailExpiredCodes() {
		
		$expireds = DB::Executa("SELECT * FROM site_emailchange WHERE date < '".(time()-86400)."'");
		if(count($expireds) > 0) {
			
			$sql = DB::Executa("DELETE FROM site_emailchange WHERE date < '".(time()-86400)."'");
			return $sql;
			
		}
		
		return true;
		
	}

	public static function deleteEmailCode($val) {
		
		$sql = DB::Executa("DELETE FROM site_emailchange WHERE account = '".$val."' LIMIT 1");
		return $sql;
		
	}

	public static function updateEmail($email, $login) {
		
		$sql = DB::Executa("UPDATE accounts SET email = '".$email."' WHERE login = '".$login."' LIMIT 1");
		return $sql;
		
	}
	
}
