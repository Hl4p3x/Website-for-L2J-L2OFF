<?php

class DB {
	
	private static $con;

	private static $dbnm;

	private static $conMethod;

	public static $lastInsertID;

	function __construct($conMethod, $host='', $user='', $pass='', $dbnm='', $port='') {
		
		if(!empty($host) && !empty($user) && !empty($dbnm)) {
			
			DB::$conMethod = $conMethod;
			
			if($conMethod == 1) {
				
				# MySQL
				
				DB::$con = @mysql_connect($host, $user, $pass) or die("Failed to connect! #MySQL");
				if(!@mysql_select_db(DB::$con, $dbnm)) {
					DB::$dbnm = $dbnm;
				}
				
			} else if($conMethod == 2) {
				
				# MySQLi
				
				DB::$con = @mysqli_connect($host, $user, $pass) or die("Failed to connect! #MySQLi");
				if(!@mysqli_select_db(DB::$con, $dbnm)) {
					DB::$dbnm = $dbnm;
				}
				
			} else if($conMethod == 3) {
				
				# PDO-MySQL
				
				try {
					DB::$con = new PDO("mysql:host=".$host.";dbname=".$dbnm."", $user, $pass);
				} catch (PDOException $e) {
					echo "Failed to connect! #PDO-MySQL";
					exit;
				}
				
			} else {
				return false;
			}
			
		} else {
			return false;
		}
		
	}
	
	public static function Executa($sql, $key='') {
		
		if(!empty(DB::$con) && !empty($sql)) {
			
			$sql_ini = strtoupper(substr(trim($sql), 0, 6));
			
			if(DB::$conMethod == 1) {
				
				# MySQL
				
				if(!empty(DB::$dbnm)) {
					@mysql_select_db("".DB::$dbnm."", DB::$con) or die("Failed connection to database! #MySQL");
				}
				
				$query = @mysql_query(DB::$con, $sql);
				if(!$query) {
					return false;
				}
				
				if($sql_ini == 'SELECT') {
					
					$array = array();
					while ($result = mysql_fetch_assoc($query)) {
						$array[] = $result;
					}
					
					return $array;
					
				} else if($sql_ini == 'INSERT') {
					
					DB::$lastInsertID = mysql_insert_id(DB::$con);
					
					return true;
					
				} else {
					
					return true;
					
				}
				
			} else if(DB::$conMethod == 2) {
				
				# MySQLi
				
				if(!empty(DB::$dbnm)) {
					@mysqli_select_db(DB::$con, DB::$dbnm) or die("Failed connection to database! #MySQLi");
				}
				
				$query = @mysqli_query(DB::$con, $sql);
				if(!$query) {
					return false;
				}
				
				if($sql_ini == 'SELECT') {
					
					$array = array();
					while ($result = mysqli_fetch_assoc($query)) {
						$array[] = $result;
					}
					
					return $array;
					
				} else if($sql_ini == 'INSERT') {
					
					DB::$lastInsertID = mysqli_insert_id(DB::$con);
					
					return true;
					
				} else {
					
					return true;
					
				}
				
			} else if(DB::$conMethod == 3) {
				
				# PDO-MySQL
				
				$query = DB::$con->prepare($sql);
				$query->execute();
				
				if(empty($query) || $query->errorCode() != 0) {
					return false;
				}

				if($sql_ini == 'SELECT') {

					$array = array();
					while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
						$array[] = $result;
					}

					return $array;

				} else if($sql_ini == 'INSERT') {

					DB::$lastInsertID = @DB::$con->lastInsertId();

					if(empty(DB::$lastInsertID)) {

						$query = DB::$con->prepare("SELECT @@IDENTITY AS lastInsertID");
						$query->execute();
						$result = $query->fetch(PDO::FETCH_ASSOC);

						DB::$lastInsertID = $result['lastInsertID'];

					}

					return true;

				} else {

					return true;

				}
				
			} else {
				return false;
			}
			
		}
		
		return false;
	}

	public static function close() {
		if(DB::$conMethod == 1) {
			@mysql_close(DB::$con);
		} else if(DB::$conMethod == 2) {
			@mysqli_close(DB::$con);
		}
		DB::$con = '';
	}
	
}
