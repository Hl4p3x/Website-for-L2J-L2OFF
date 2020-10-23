<?php if((!$indexing) || ($logged != 1)) { exit; } 
if($funct['gamst5'] != 1) { fim($LANG[40003], 'ERROR', './'); }
?>

<ul class="breadcrumb">
	<li><b><i class='fa fa-bar-chart'></i> Game Stats</b></li>
	<li>Grand Olympiad</li>
	<li>Ranking</li>
</ul>

<h1>Grand Olympiad</h1>

<?php

$cacheFile = "cache/oly_rank.xml";
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
	
	$query = Stats::OlympiadRanking();
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
			
			$class = get3Job($query[$i]['base']);
			
			$classLine[$class][] = array($query[$i]['char_name'], $class, $query[$i]['clan_name'], $query[$i]['olympiad_points']);
			
		}
		
		foreach($classLine as $key => $value) {
			
			for($i=0, $c=count($classLine[$key]); $i < $c; $i++) {
				
				$line .= "\n<line>\n";
				$line .= "<name>".$classLine[$key][$i][0]."</name>\n";
				$line .= "<class>".$classLine[$key][$i][1]."</class>\n";
				$line .= "<pts>".base64_encode($classLine[$key][$i][3])."</pts>\n";
				$line .= "<clan>".(!empty($classLine[$key][$i][2]) ? $classLine[$key][$i][2] : '-')."</clan>\n";
				$line .= "</line>";
				
			}
			
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

?>

<div class='horMenu'>
	<a href='' class='act'>Ranking</a>
	<a href='?module=stats&page=oly_heroes'><?php echo $LANG[12999]; ?></a>
	<a href='?module=stats&page=oly_allheroes'><?php echo $LANG[12025]; ?></a>
</div>

<div style='text-align:center; margin: 0 0 20px 0;'><?php echo $LANG[12064]; ?></div>

<table cellspacing="0" cellpadding="0" border="0" class='default'>
	
	<tr>
		<th class='pos'></th>
		<th><?php echo $LANG[12013]; ?></th>
		<th>Class</th>
		<?php if($olyExibPoint == 1) { echo "<th>Pts</th>"; } ?>
		<th>Clan</th>
	</tr>
	
	<?php
	if(count($line) > 0) {
		
		for($i=0, $c=count($line), $cr=1; $i < $c; $i++, $cr++) {
			
			if($i != 0) {
				$i2 = $i-1;
				if(isset($anterior[$i2])) {
					if(trim($anterior[$i2]) != trim($line[$i]->class)) {
						echo "<tr class='ctype2'><td colspan='".($olyExibPoint == 1 ? '5' : '4')."'></td></tr>";
						$cr=1;
					}
				}
			}
			$anterior[$i] = $line[$i]->class;
			
			echo "
			<tr".(($i % 2 == 0) ? " class='two'" : "").">
				<td class='pos'>".$cr."&ordm;</td>
				<td>".$line[$i]->name."</td>
				<td class='foco'>".$line[$i]->class."</td>
				".($olyExibPoint == 1 ? "<td>".base64_decode($line[$i]->pts)."</td>" : "")."
				<td>".$line[$i]->clan."</td>
			</tr>
			";
			
		}
		
	} else {
		
		$class = array(88 => 'Duelist', 89 => 'Dreadnought', 90 => 'Phoenix Knight', 91 => 'Hell Knight', 92 => 'Sagittarius', 93 => 'Adventurer', 94 => 'Archmage', 95 => 'Soultaker', 96 => 'Arcana Lord', 97 => 'Cardinal', 98 => 'Hierophant', 99 => 'Eva Templar', 100 => 'Sword Muse', 101 => 'Wind Rider', 102 => 'Moonlight Sentinel', 103 => 'Mystic Muse', 104 => 'Elemental Master', 105 => 'Eva Saint', 106 => 'Shillien Templar', 107 => 'Spectral Dancer', 108 => 'Ghost Hunter', 109 => 'Ghost Sentinel', 110 => 'Storm Screamer', 111 => 'Spectral Master', 112 => 'Shillien Saint', 113 => 'Titan', 114 => 'Grand Khauatari', 115 => 'Dominator', 116 => 'Doomcryer', 117 => 'Fortune Seeker', 118 => 'Maestro', 131 => 'Doombringer', 132 => 'Soulhound', 133 => 'Soulhound', 134 => 'Trickster', 135 => 'Inspector', 136 => 'Judicator');
		
		$i=88; $cr=1;
		while(118 >= $i) {
			
			echo "
			<tr".(($i % 2 == 0) ? " class='two'" : "").">
				<td>0&ordm;</td>
				<td>-</td>
				<td class='txtmin foco'>".$class[$i]."</td>
				".($olyExibPoint == 1 ? "<td>0</td>" : "")."
				<td class='txtmin'>-</td>
			</tr>
			";
			
			$anterior[$i] = $i - 1; $separa=0; $cr++;
			if(isset($anterior[$i])) { if($anterior[$i] != $i) { $separa=1; $cr=1; } }
			if($separa == 1) { echo "<tr class='ctype2'><td></td><td></td><td></td>"; if($olyExibPoint == 1) { echo "<td></td>"; } echo"<td></td></tr>"; }
			
			$i++;
		}
		
	}
	?>

</table>
