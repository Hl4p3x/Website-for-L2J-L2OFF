<?php

function ansi2unicode($ansi_str) {
	return (iconv('CP1250', 'UCS-2LE', $ansi_str).chr(0).chr(0));
}

function l2_cached_open() {
	if(!isset($GLOBALS["cached_fptr"]) || empty($GLOBALS["cached_fptr"]) || !is_resource($GLOBALS["cached_fptr"])) {
		$cached_fptr = @fsockopen($GLOBALS["cachedIP"], $GLOBALS["cachedPort"], $errno, $errstr, 1);
		if($cached_fptr == false) {
			$GLOBALS["cached_fptr"] = $errstr;
		} else {
			$GLOBALS["cached_fptr"] = $cached_fptr;
		}
	}
	return (isset($GLOBALS["cached_fptr"]) ? $GLOBALS["cached_fptr"] : '');
}

function l2_cached_close() {
	if(isset($GLOBALS["cached_fptr"]) && !empty($GLOBALS["cached_fptr"])) {
		@fclose($GLOBALS["cached_fptr"]);
	}
}

function l2_cached_push($cached_packet) {
	$cached_fptr = l2_cached_open();
	if(!is_resource($cached_fptr)) {
		return "Error connecting to cached! (".$cached_fptr.")";
	}
	fwrite($cached_fptr,  $cached_packet);
	$array_ret_length = unpack("v", fread($cached_fptr, 2));
	$ret_id = unpack("c", fread($cached_fptr, 1));
	$ret_string = "";
	for($i = 0; $i < (($array_ret_length[1]-4)/4); $i++){
		$array_read = unpack("i", fread($cached_fptr, 4));
		$ret_string .= $array_read[1];
	}
	l2_cached_close();
	return $ret_string;
}
