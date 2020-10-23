<?php if(!$indexing) { exit; }

if(!file_exists("cache")) { @mkdir("cache", 0775, true); @chmod("cache", 0775); }
if(!file_exists("cache/index.html")) { $secIndexFile = fopen("cache/index.html","w+"); @fclose($secIndexFile); }
if(!file_exists("cache/.htaccess")) { $secHtacsFile = fopen("cache/.htaccess","w+"); @fwrite($secHtacsFile, "Options -Indexes"); @fclose($secHtacsFile); }

require_once('private/classes/classStats.php');
require_once('private/classes/classGallery.php');

$dateReg = mktime($reg['hr'],$reg['min'],0,$reg['mes'],$reg['dia'],$reg['ano']);



// RECACHE PARAMS
$wFile = fopen($recacheFile,"w+");
$updated = time();
$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n</configs>";
if(fwrite($wFile, utf8_encode("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<recache>".$line."\n</recache>")) === FALSE) {
	die("Unable to generate cache! (Não foi possível gerar cache!)");
} else {
	@fclose($wFile);
}



// TOP PVP
unset($deleteCache);
$cacheFile = "cache/toppvp.xml";
$wFile = fopen($cacheFile,"w+");
$updated = time();
$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n<delay>".$cacheDelayMin."</delay>\n<rcount>".$countTopPlayers."</rcount>\n</configs>";
if($showRankReg == 1 || ($showRankReg == 0 && time() > $dateReg)) {
	$query = Stats::TopPvP($countTopPlayers);
	if(count($query) > 0) {
		for($i=0, $c=count($query); $i < $c; $i++) {
			$dias = intval($query[$i]['onlinetime'] / 86400); $marcador = $query[$i]['onlinetime'] % 86400; $hora = intval($marcador / 3600); $marcador = $marcador % 3600; $minuto = intval($marcador / 60);
			$line .= "\n<line>\n";
			$line .= "<pos>".($i+1)."</pos>\n";
			$line .= "<name>".$query[$i]['char_name']."</name>\n";
			$line .= "<clan>".(empty($query[$i]['clan_name']) ? '-' : $query[$i]['clan_name'])."</clan>\n";
			$line .= "<pvp>".$query[$i]['pvpkills']."</pvp>\n";
			$line .= "<pk>".$query[$i]['pkkills']."</pk>\n";
			$line .= "<otdays>".$dias."</otdays>\n";
			$line .= "<othrs>".$hora."</othrs>\n";
			$line .= "<otmin>".$minuto."</otmin>\n";
			$line .= "</line>";
		}
	} else {
		$deleteCache = 1;
	}
} else {
	$deleteCache = 1;
}
@fwrite($wFile, utf8_encode("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<ranking>".$line."\n</ranking>"));
@fclose($wFile);
if(isset($deleteCache) && file_exists($cacheFile)) {
	unlink($cacheFile);
}


// TOP PK
unset($deleteCache);
$cacheFile = "cache/toppk.xml";
$wFile = fopen($cacheFile,"w+");
$updated = time();
$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n<delay>".$cacheDelayMin."</delay>\n<rcount>".$countTopPlayers."</rcount>\n</configs>";
if($showRankReg == 1 || ($showRankReg == 0 && time() > $dateReg)) {
	$query = Stats::TopPk($countTopPlayers);
	if(count($query) > 0) {
		for($i=0, $c=count($query); $i < $c; $i++) {
			$dias = intval($query[$i]['onlinetime'] / 86400); $marcador = $query[$i]['onlinetime'] % 86400; $hora = intval($marcador / 3600); $marcador = $marcador % 3600; $minuto = intval($marcador / 60);
			$line .= "\n<line>\n";
			$line .= "<pos>".($i+1)."</pos>\n";
			$line .= "<name>".$query[$i]['char_name']."</name>\n";
			$line .= "<clan>".(empty($query[$i]['clan_name']) ? '-' : $query[$i]['clan_name'])."</clan>\n";
			$line .= "<pvp>".$query[$i]['pvpkills']."</pvp>\n";
			$line .= "<pk>".$query[$i]['pkkills']."</pk>\n";
			$line .= "<otdays>".$dias."</otdays>\n";
			$line .= "<othrs>".$hora."</othrs>\n";
			$line .= "<otmin>".$minuto."</otmin>\n";
			$line .= "</line>";
		}
	} else {
		$deleteCache = 1;
	}
} else {
	$deleteCache = 1;
}
@fwrite($wFile, utf8_encode("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<ranking>".$line."\n</ranking>"));
@fclose($wFile);
if(isset($deleteCache) && file_exists($cacheFile)) {
	unlink($cacheFile);
}


// TOP CLAN
unset($deleteCache);
$cacheFile = "cache/topclan.xml";
$wFile = fopen($cacheFile,"w+");
$updated = time();
$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n<delay>".$cacheDelayMin."</delay>\n<rcount>".$countTopClan."</rcount>\n</configs>";
if($showRankReg == 1 || ($showRankReg == 0 && time() > $dateReg)) {
	$query = Stats::TopClan($countTopClan);
	if(count($query) > 0) {
		for($i=0, $c=count($query); $i < $c; $i++) {
			$line .= "\n<line>\n";
			$line .= "<pos>".($i+1)."</pos>\n";
			$line .= "<name>".$query[$i]['clan_name']."</name>\n";
			$line .= "<leader>".$query[$i]['char_name']."</leader>\n";
			$line .= "<members>".$query[$i]['membros']."</members>\n";
			$line .= "<ally>".(empty($query[$i]['ally_name']) ? '-' : $query[$i]['ally_name'])."</ally>\n";
			$line .= "<level>".$query[$i]['clan_level']."</level>\n";
			$line .= "<reputation>".$query[$i]['reputation_score']."</reputation>\n";
			$line .= "</line>";
		}
	} else {
		$deleteCache = 1;
	}
} else {
	$deleteCache = 1;
}
@fwrite($wFile, utf8_encode("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<ranking>".$line."\n</ranking>"));
@fclose($wFile);
if(isset($deleteCache) && file_exists($cacheFile)) {
	unlink($cacheFile);
}


// GALLERY
unset($deleteCache);
$cacheFile = "cache/gallery.xml";
$wFile = fopen($cacheFile,"w+");
$updated = time();
$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n</configs>";
$gallery = Gallery::listAll();
if(count($gallery) > 0) {
	for($i=0, $c=count($gallery); $i < $c; $i++) {
		$line .= "\n<line>\n";
		$line .= "<url>".$gallery[$i]['url']."</url>\n";
		$line .= "<isvideo>".$gallery[$i]['isvideo']."</isvideo>\n";
		$line .= "</line>";
	}
} else {
	$deleteCache = 1;
}
@fwrite($wFile, utf8_encode("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<gallery>".$line."\n</gallery>"));
@fclose($wFile);
if(isset($deleteCache) && file_exists($cacheFile)) {
	unlink($cacheFile);
}
