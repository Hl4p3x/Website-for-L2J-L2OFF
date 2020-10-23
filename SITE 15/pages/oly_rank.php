<?php if(!$indexing || $dpage['olyrak'] != 1) { echo "<script>document.location.replace('./');</script>"; exit; } ?>
<h1>Top Olly</h1>
<div class='horMenu ranks'>
	
<a href='./?page=toppvp'>Top PvP</a>
				<a href='./?page=toppk' class='ativa'>Top Pk</a>
				<a href='./?page=toponline'>Top Online</a>
				<a href='./?page=toplevel'>Top level</a>
				<a href='./?page=topadena'>Top Adenas</a>
				<a href='./?page=boss_jewels_loc'>Player Joia Boss</a>
				<a href='./?page=topclan'>Top Clan</a>
				<a href='./?page=oly_heroes'>Heroes</a>
				<a href='./?page=oly_rank'class='act'>>Top Olly</a>
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

<span id='ollyLoc'></span>



<?php

require('private/includes/rankoptions.php');

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
	if(!file_exists("cache/.htaccess")) { $secHtacsFile = fopen("cache/.htaccess","w+"); @fwrite($secHtacsFile, "Options -Indexes"); @fclose($secHtacsFile); }
	
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
			if(!isset($class[$job3])) { $class[$job3] = '-'; }
			return $class[$job3];
		}
		
		for($i=0, $c=count($query); $i < $c; $i++) {
			
			$class = get3Job($query[$i]['base']);
			
			$classLine[$class][] = array($query[$i]['char_name'], $class, $query[$i]['clan_name'], $query[$i]['olympiad_points'], $query[$i]['base']);
			
		}
		
		foreach($classLine as $key => $value) {
			
			for($i=0, $c=count($classLine[$key]); $i < $c; $i++) {
				
				$line .= "\n<line>\n";
				$line .= "<id>".$classLine[$key][$i][4]."</id>\n";
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
	
	@fwrite($wFile, utf8_encode("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<ranking>".$line."\n</ranking>"));
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
		".($dpage['olyrak'] == 1 ? "<a href='#ollyLoc' class='act'>Ranking</a>" : "")."
		".($dpage['olyher'] == 1 ? "<a href='?page=oly_heroes#ollyLoc'>".$LANG[12999]."</a>" : "")."
		".($dpage['olyall'] == 1 ? "<a href='?page=oly_allheroes#ollyLoc'>".$LANG[12025]."</a>" : "")."
	</div>
	";
}

$class = array(88 => 'Duelist', 89 => 'Dreadnought', 90 => 'Phoenix Knight', 91 => 'Hell Knight', 92 => 'Sagittarius', 93 => 'Adventurer', 94 => 'Archmage', 95 => 'Soultaker', 96 => 'Arcana Lord', 97 => 'Cardinal', 98 => 'Hierophant', 99 => 'Eva Templar', 100 => 'Sword Muse', 101 => 'Wind Rider', 102 => 'Moonlight Sentinel', 103 => 'Mystic Muse', 104 => 'Elemental Master', 105 => 'Eva Saint', 106 => 'Shillien Templar', 107 => 'Spectral Dancer', 108 => 'Ghost Hunter', 109 => 'Ghost Sentinel', 110 => 'Storm Screamer', 111 => 'Spectral Master', 112 => 'Shillien Saint', 113 => 'Titan', 114 => 'Grand Khauatari', 115 => 'Dominator', 116 => 'Doomcryer', 117 => 'Fortune Seeker', 118 => 'Maestro', 131 => 'Doombringer', 132 => 'Soulhound', 133 => 'Soulhound', 134 => 'Trickster', 135 => 'Inspector', 136 => 'Judicator');

$getClass = !empty($_GET['class']) ? intval(trim($_GET['class'])) : 0;

?>

<div style='text-align:center; margin: 0 0 20px 0;'><?php echo $LANG[12064]; ?></div>

<label class='formpadrao' id='the_suffix'>
	<div>
		<div class='desc'>Class:</div>
		<div class='camp'>
			<select id='classChange'>
				<?php
				echo "<option value='0'>".$LANG[30508]."</option>";
				foreach($class as $key => $val) {
					echo "<option value='".$key."'".($getClass == $key ? " selected" : "").">".$val."</option>";
				}
				?>
			</select>
			<script>
				$(function(){
					$('select#classChange').change(function(){
						document.location.href='./?page=oly_rank&class='+$(this).val();
					});
				});
			</script>
		</div>
	</div>
</label>

<br />

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
			
			if((!empty($getClass)) && (intval(trim($line[$i]->id)) != intval($_GET['class']))) {
				continue;
			}
			
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
