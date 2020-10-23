<?php if(!$indexing) { exit; }

if(!file_exists("cache")) { @mkdir("cache", 0775, true); @chmod("cache", 0775); }
if(!file_exists("cache/index.html")) { $secIndexFile = fopen("cache/index.html","w+"); @fclose($secIndexFile); }
if(!file_exists("cache/.htaccess")) { $secHtacsFile = fopen("cache/.htaccess","w+"); @fwrite($secHtacsFile, "Options -Indexes\ndeny from all"); @fclose($secHtacsFile); }

$wFile = fopen($cacheFile,"w+");

$updated = time();
$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n</configs>";

require_once('private/classes/classStats.php');
$query = Stats::PlayersOnline();
if(count($query) > 0) {
	$line .= "\n<players>\n<online>".intval($query[0]['quant'])."</online>\n</players>";
} else {
	$deleteCache = 1;
}

@fwrite($wFile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<playerson>".$line."\n</playerson>");
@fclose($wFile);

$xml = simplexml_load_file($cacheFile);

if(isset($deleteCache) && file_exists($cacheFile)) {
	unlink($cacheFile);
}
