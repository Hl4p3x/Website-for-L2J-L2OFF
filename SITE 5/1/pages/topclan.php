<?php if(!$indexing || $dpage['topcla'] != 1) { echo "<script>document.location.replace('./');</script>"; exit; } ?>

<h1>Top Clan</h1>

<div class='rankings_options'>
	Rankings <span class='rankings_arrow'></span>
	<div>
		<?php
		echo "
		".($dpage['toppvp'] == 1 ? "<a href='./?page=toppvp'>Top PvP</a>" : "")."
		".($dpage['toppkp'] == 1 ? "<a href='./?page=toppk' class='ativa'>Top Pk</a>" : "")."
		".($dpage['toponl'] == 1 ? "<a href='./?page=toponline'>Top Online</a>" : "")."
		".($dpage['topcla'] == 1 ? "<a href='./?page=topclan'>Top Clan</a>" : "")."
		".($dpage['olyrak'] == 1 ? "<a href='./?page=oly_rank'>Olympiad Ranking</a>" : "")."
		".($dpage['olyher'] == 1 ? "<a href='./?page=oly_heroes'>".$LANG[12999]."</a>" : "")."
		".($dpage['olyall'] == 1 ? "<a href='./?page=oly_allheroes'>".$LANG[12025]."</a>" : "")."
		".($dpage['bosstt'] == 1 ? "<a href='./?page=boss'>Boss Status</a>" : "")."
		".($dpage['csiege'] == 1 ? "<a href='./?page=siege'>Castle & Siege</a>" : "")."
		";
		?>
	</div>
</div>

<?php

$cacheFile = "cache/topclan.xml";
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
	
	if($rcount != $countTopCLAN) {
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
	$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n<delay>".$cacheDelayMin."</delay>\n<rcount>".$countTopCLAN."</rcount>\n</configs>";
	
	if($showRankReg == 1 || ($showRankReg == 0 && time() > $dateReg)) {
		
		require_once('private/classes/classStats.php');
		
		$query = Stats::TopClan($countTopCLAN);
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

	@fwrite($wFile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<ranking>".$line."\n</ranking>");
	@fclose($wFile);
	
	$xml = simplexml_load_file($cacheFile);
	
	if(isset($deleteCache) && file_exists($cacheFile)) {
		unlink($cacheFile);
	}
	
}

?>

<div class='pddInner'>
	<?php echo $LANG[30504]."<br />".$LANG[30500]." <b>".date('d/m/Y', $updated)."</b> ".$LANG[30501]." <b>".date('H:i', $updated)."</b>."; ?><br /><br />
</div>

<table cellspacing="0" cellpadding="0" border="0" class='default'>
	
	<tr>
		<th class='pos'></th>
		<th><?php echo $LANG[12013]; ?></th>
		<th>Ally</th>
		<th title='Level / <?php echo $LANG[29005]; ?>'>Lvl / Rep.</th>
	</tr>
	
	<?php
	
	$line = $xml->line;
	
	$countView = (!empty($countTopCLAN) ? intval($countTopCLAN) : 100);
	if(count($line) < $countView) { $countView = count($line); }
	for($i=0, $c=$countView; $i < $c; $i++) {
		
		echo "
		<tr".(($i % 2 == 0) ? " class='two'" : "").">
			<td class='pos'>".$line[$i]->pos."&ordm;</td>
			<td>
				<b>".$line[$i]->name."</b>
				<br /><span style='font-size:11px;font-weight:normal;opacity:0.5;'>".$LANG[12011].": ".$line[$i]->leader." &nbsp;&bull;&nbsp; ".$line[$i]->members." ".($line[$i]->members > 1 ? $LANG[12012] : substr($LANG[12012], 0, -1))."</span>
			</td>
			<td>".$line[$i]->ally."</td>
			<td>".$line[$i]->level." / ".$line[$i]->reputation."</td>
		</tr>
		";
		
	}
	
	?>

</table>
<br>
