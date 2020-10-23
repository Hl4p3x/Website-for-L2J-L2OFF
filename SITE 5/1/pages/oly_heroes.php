<?php if(!$indexing || $dpage['olyher'] != 1) { echo "<script>document.location.replace('./');</script>"; exit; } ?>

<span id='ollyLoc'></span>

<h1>Grand Olympiad</h1>

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

$cacheFile = "cache/oly_heroes.xml";
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
	
}

if($genNew) {
	
	if(!file_exists("cache")) { @mkdir("cache", 0775, true); @chmod("cache", 0775); }
	if(!file_exists("cache/index.html")) { $secIndexFile = fopen("cache/index.html","w+"); @fclose($secIndexFile); }
	if(!file_exists("cache/.htaccess")) { $secHtacsFile = fopen("cache/.htaccess","w+"); @fwrite($secHtacsFile, "Options -Indexes\ndeny from all"); @fclose($secHtacsFile); }
	
	$wFile = fopen($cacheFile,"w+");
	
	$updated = time();
	$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n<delay>".$cacheDelayMin."</delay>\n</configs>";
	
	require_once('private/classes/classStats.php');
	
	$query = Stats::OlympiadCurrentHeroes();
	if(count($query) > 0) {

		function get3Job($val) {
			$to3Job = array(2 => 88, 3 => 89, 5 => 90, 6 => 91, 8 => 93, 9 => 92, 12 => 94, 13 => 95, 14 => 96, 16 => 97, 17 => 98, 20 => 99, 21 => 100, 23 => 101, 24 => 102, 27 => 103, 28 => 104, 30 => 105, 33 => 106, 34 => 107, 36 => 108, 37 => 109, 40 => 110, 41 => 111, 43 => 112, 46 => 113, 48 => 114, 51 => 115, 52 => 116, 55 => 117, 57 => 118, 127 => 131, 128 => 132, 129 => 133, 130 => 134, 135 => 136);
			$class = array(88 => 'Duelist', 89 => 'Dreadnought', 90 => 'Phoenix Knight', 91 => 'Hell Knight', 92 => 'Sagittarius', 93 => 'Adventurer', 94 => 'Archmage', 95 => 'Soultaker', 96 => 'Arcana Lord', 97 => 'Cardinal', 98 => 'Hierophant', 99 => 'Eva Templar', 100 => 'Sword Muse', 101 => 'Wind Rider', 102 => 'Moonlight Sentinel', 103 => 'Mystic Muse', 104 => 'Elemental Master', 105 => 'Eva Saint', 106 => 'Shillien Templar', 107 => 'Spectral Dancer', 108 => 'Ghost Hunter', 109 => 'Ghost Sentinel', 110 => 'Storm Screamer', 111 => 'Spectral Master', 112 => 'Shillien Saint', 113 => 'Titan', 114 => 'Grand Khauatari', 115 => 'Dominator', 116 => 'Doomcryer', 117 => 'Fortune Seeker', 118 => 'Maestro', 131 => 'Doombringer', 132 => 'Soulhound', 133 => 'Soulhound', 134 => 'Trickster', 135 => 'Inspector', 136 => 'Judicator');
			if(isset($to3Job[$val])) {
				$job3 = $to3Job[$val];
			} else {
				$job3 = $val;
			}
			return $class[$job3];
		}
		
		for($i=0, $c=count($query); $i < $c; $i++) {
			
			$line .= "\n<line>\n";
			$line .= "<name>".$query[$i]['char_name']."</name>\n";
			$line .= "<class>".get3Job($query[$i]['base'])."</class>\n";
			$line .= "<clan>".(empty($query[$i]['clan_name']) ? '-' : $query[$i]['clan_name'])."</clan>\n";
			$line .= "<ally>".(empty($query[$i]['ally_name']) ? '-' : $query[$i]['ally_name'])."</ally>\n";
			$line .= "</line>";
			
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

$line = $xml->line;

if((intval($dpage['olyrak'])+intval($dpage['olyher'])+intval($dpage['olyall'])) > 1) {
	echo "
	<div class='horMenu'>
		".($dpage['olyrak'] == 1 ? "<a href='?page=oly_rank#ollyLoc'>Ranking</a>" : "")."
		".($dpage['olyher'] == 1 ? "<a href='?page=oly_heroes#ollyLoc' class='act'>".$LANG[12999]."</a>" : "")."
		".($dpage['olyall'] == 1 ? "<a href='?page=oly_allheroes#ollyLoc'>".$LANG[12025]."</a>" : "")."
	</div>
	";
}

?>

<div style='text-align:center; margin: 0 0 20px 0;'><?php echo $LANG[12064]; ?></div>

<table cellspacing="0" cellpadding="0" border="0" class='default'>
	
	<tr>
		<th><?php echo $LANG[12013]; ?></th>
		<th>Class</th>
		<th>Clan</th>
		<th>Ally</th>
	</tr>
	
	<?php
	if(count($line) > 0) {
		
		for($i=0, $c=count($line); $i < $c; $i++) {
			echo "
			<tr".(($i % 2 == 0) ? " class='two'" : "").">
				<td>".$line[$i]->name."</td>
				<td class='foco'>".$line[$i]->class."</td>
				<td>".$line[$i]->clan."</td>
				<td>".$line[$i]->ally."</td>
			</tr>
			";
		}
		
	} else {
		
		$class = array(88 => 'Duelist', 89 => 'Dreadnought', 90 => 'Phoenix Knight', 91 => 'Hell Knight', 92 => 'Sagittarius', 93 => 'Adventurer', 94 => 'Archmage', 95 => 'Soultaker', 96 => 'Arcana Lord', 97 => 'Cardinal', 98 => 'Hierophant', 99 => 'Eva Templar', 100 => 'Sword Muse', 101 => 'Wind Rider', 102 => 'Moonlight Sentinel', 103 => 'Mystic Muse', 104 => 'Elemental Master', 105 => 'Eva Saint', 106 => 'Shillien Templar', 107 => 'Spectral Dancer', 108 => 'Ghost Hunter', 109 => 'Ghost Sentinel', 110 => 'Storm Screamer', 111 => 'Spectral Master', 112 => 'Shillien Saint', 113 => 'Titan', 114 => 'Grand Khauatari', 115 => 'Dominator', 116 => 'Doomcryer', 117 => 'Fortune Seeker', 118 => 'Maestro', 131 => 'Doombringer', 132 => 'Soulhound', 133 => 'Soulhound', 134 => 'Trickster', 135 => 'Inspector', 136 => 'Judicator');
		
		$i=88;
		while(118 >= $i) {
			
			echo "
			<tr".(($i % 2 == 0) ? " class='two'" : "").">
				<td>-</td>
				<td class='foco'>".$class[$i]."</td>
				<td>-</td>
				<td>-</td>
			</tr>
			";
			$i++;
			
		}
		
	}
	
	?>

</table>
<br>
