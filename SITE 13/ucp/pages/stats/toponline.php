<?php if((!$indexing) || ($logged != 1)) { exit; } 
if($funct['gamst4'] != 1) { fim($LANG[40003], 'ERROR', './'); }
?>

<ul class="breadcrumb">
	<li><b><i class='fa fa-bar-chart'></i> Game Stats</b></li>
	<li>Top Online</li>
</ul>

<h1>Top Online</h1>

<?php

$cacheFile = "cache/toponline.xml";
$genNew = 0;

if(!file_exists($cacheFile)) {
	$genNew = 1;
} else {
	
	$xml = simplexml_load_file($cacheFile);
	$configs = $xml->configs;
	$updated = intval($configs->updated);
	$delay = $cacheDelayMin;
	$rcount = intval($configs->rcount);
	
	if(($updated+($delay*60)) < time()) {
		$genNew = 1;
	}
	
	if($rcount != $countTopON) {
		$genNew = 1;
	}
	
}

$dateReg = mktime($reg['hr'],$reg['min'],0,$reg['mes'],$reg['dia'],$reg['ano']);
if($showRankReg == 0 && time() < $dateReg) {
	$genNew = 1;
}

if($genNew) {
	
	if(!file_exists("cache")) { @mkdir("cache", 0775, true); @chmod("cache", 0775); }
	if(!file_exists("cache/index.html")) { $secIndexFile = fopen("cache/index.html","w+"); @fclose($secIndexFile); }
	if(!file_exists("cache/.htaccess")) { $secHtacsFile = fopen("cache/.htaccess","w+"); @fwrite($secHtacsFile, "Options -Indexes\ndeny from all"); @fclose($secHtacsFile); }
	
	$wFile = fopen($cacheFile,"w+");
	
	$updated = time();
	$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n<delay>".$cacheDelayMin."</delay>\n<rcount>".$countTopON."</rcount>\n</configs>";
	
	if($showRankReg == 1 || ($showRankReg == 0 && time() > $dateReg)) {
		
		require_once('private/classes/classStats.php');
		
		$query = Stats::TopOnline($countTopON);
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

	@fwrite($wFile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<ranking>".$line."\n</ranking>");
	@fclose($wFile);
	
	$xml = simplexml_load_file($cacheFile);
	
	if(isset($deleteCache) && file_exists($cacheFile)) {
		unlink($cacheFile);
	}
	
}

?>

<div class='pddInner' style='padding-bottom:0;'>
	<?php echo $LANG[30505]."<br />".$LANG[30500]." <b>".date('d/m/Y', $updated)."</b> ".$LANG[30501]." <b>".date('H:i', $updated)."</b>."; ?><br /><br />
</div>

<table cellspacing="0" cellpadding="0" border="0" class='default'>
	
	<tr>
		<th class='pos'></th>
		<th><?php echo $LANG[12013]; ?></th>
		<th>Clan</th>
		<th>PVP's</th>
		<th>PK's</th>
		<th title='<?php echo $LANG[29006]; ?>'><?php echo $LANG[12016]; ?></th>
	</tr>
	
	<?php
	
	$line = $xml->line;
	
	$countView = (!empty($countTopON) ? intval($countTopON) : 100);
	if(count($line) < $countView) { $countView = count($line); }
	for($i=0, $c=$countView; $i < $c; $i++) {
		
		echo "
		<tr".(($i % 2 == 0) ? " class='two'" : "").">
			<td class='pos'>".$line[$i]->pos."&ordm;</td>
			<td><b>".$line[$i]->name."</b></td>
			<td>".$line[$i]->clan."</td>
			<td style='color: #006202;'>".$line[$i]->pvp."</td>
			<td style='color: #ba0d0d;'>".$line[$i]->pk."</td>
			<td class='foco' title='".$line[$i]->otdays." ".$LANG[12014]."s, " .$line[$i]->othrs." hrs ".$LANG[12015]." ".$line[$i]->otmin." min'>".$line[$i]->otdays."d, " .$line[$i]->othrs."h ".$line[$i]->otmin."m</td>
		</tr>
		";
		
	}
	
	?>

</table>
