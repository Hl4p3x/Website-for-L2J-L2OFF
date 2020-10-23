<?php if(!$indexing || $dpage['topadn'] != 1) { echo "<script>document.location.replace('./');</script>"; exit; } ?>
<h1>Top Adenas</h1>
<div class='horMenu ranks'>
	
<a href='./?page=toppvp'>Top PvP</a>
				<a href='./?page=toppk' class='ativa'>Top Pk</a>
				<a href='./?page=toponline'>Top Online</a>
				<a href='./?page=toplevel'>Top level</a>
				<a href='./?page=topadena'class='act'>>Top Adenas</a>
				<a href='./?page=boss_jewels_loc'>Player Joia Boss</a>
				<a href='./?page=topclan'>Top Clan</a>
				<a href='./?page=oly_heroes'>Heroes</a>
				<a href='./?page=oly_rank'>Top Olly</a>
				<a href='./?page=boss'>Boss Respawn</a>
	<a href='./?page=siege'>Castle & Siege</a>
	</div>


<div class='rankings_options'>
	Rankings <span class='rankings_arrow'></span>
	<div>
		
	<a href='./?page=toppvp'>Top PvP</a>
				<a href='./?page=toppk' class='ativa'>Top Pk</a>
				<a href='./?page=toponline'>Top Online</a>
				<a href='./?page=toplevel'>Top level</a>
				<a href='./?page=topadena'>Top Adenas</a>
				<a href='./?page=boss_jewels_loc'>Player Joia Boss</a>
				<a href='./?page=topclan'>Top Clan</a>
				<a href='./?page=oly_heroes'>Heroes</a>
				<a href='./?page=oly_rank'>Top Olly</a>
				<a href='./?page=boss'>Boss Respawn</a>
				<a href='./?page=siege'>Castle Siege</a>
			</div>
</div>
<?php



if($cacheDelayMin < 1) { $cacheDelayMin = 1; }

$cacheFile = "cache/topadena.xml";
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
	
	if($rcount != $countTopPlayers) {
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
	if(!file_exists("cache/.htaccess")) { $secHtacsFile = fopen("cache/.htaccess","w+"); @fwrite($secHtacsFile, "Options -Indexes"); @fclose($secHtacsFile); }
	
	$wFile = fopen($cacheFile,"w+");
	
	$updated = time();
	$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n<delay>".$cacheDelayMin."</delay>\n<rcount>".$countTopPlayers."</rcount>\n</configs>";
	
	if($showRankReg == 1 || ($showRankReg == 0 && time() > $dateReg)) {
		
		require_once('private/classes/classStats.php');
		
		$query = Stats::TopAdena($countTopPlayers, $adnBillionItem);
		if(count($query) > 0) {
			
			for($i=0, $c=count($query); $i < $c; $i++) {
				
				$dias = intval($query[$i]['onlinetime'] / 86400); $marcador = $query[$i]['onlinetime'] % 86400; $hora = intval($marcador / 3600); $marcador = $marcador % 3600; $minuto = intval($marcador / 60);
				
				$line .= "\n<line>\n";
				$line .= "<pos>".($i+1)."</pos>\n";
				$line .= "<name>".$query[$i]['char_name']."</name>\n";
				$line .= "<clan>".(empty($query[$i]['clan_name']) ? '-' : $query[$i]['clan_name'])."</clan>\n";
				$line .= "<adenas>".$query[$i]['adenas']."</adenas>\n";
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
	
	$xml = simplexml_load_file($cacheFile);
	
	if(isset($deleteCache) && file_exists($cacheFile)) {
		unlink($cacheFile);
	}
	
}

?>

<div class='pddInner'>
	<?php echo $LANG[30513]."<br />".$LANG[30500]." <b>".date('d/m/Y', $updated)."</b> ".$LANG[30501]." <b>".date('H:i', $updated)."</b>."; ?><br /><br />
</div>

<table cellspacing="0" cellpadding="0" border="0" class='default'>
	
	<tr>
		<th class='pos'></th>
		<th><?php echo $LANG[12013]; ?></th>
		<th>Clan</th>
		<th>Adenas</th>
		<th title='<?php echo $LANG[29006]; ?>'><?php echo $LANG[12016]; ?></th>
	</tr>
	
	<?php
	
	$line = $xml->line;
	
	$countView = (!empty($countTopPlayers) ? intval($countTopPlayers) : 100);
	if(count($line) < $countView) { $countView = count($line); }
	for($i=0, $c=$countView; $i < $c; $i++) {
		
		echo "
		<tr".(($i % 2 == 0) ? " class='two'" : "").">
			<td class='pos'>".$line[$i]->pos."&ordm;</td>
			<td><b>".$line[$i]->name."</b></td>
			<td>".$line[$i]->clan."</td>
			<td class='foco'>".number_format(trim($line[$i]->adenas), 0, '', '.')."</td>
			<td title='".$line[$i]->otdays." ".$LANG[12014]."s, " .$line[$i]->othrs." hrs ".$LANG[12015]." ".$line[$i]->otmin." min'>".$line[$i]->otdays."d, " .$line[$i]->othrs."h ".$line[$i]->otmin."m</td>
		</tr>
		";
		
	}
	
	?>

</table>
