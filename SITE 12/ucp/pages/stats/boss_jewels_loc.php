<?php if((!$indexing) || ($logged != 1)) { exit; } 
if($funct['gams10'] != 1) { fim($LANG[40003], 'ERROR', './'); }
?>

<ul class="breadcrumb">
	<li><b><i class='fa fa-bar-chart'></i> Game Stats</b></li>
	<li>Boss Jewels Location</li>
</ul>

<h1>Boss Jewels Location</h1>

<?php

$cacheFile = "cache/boss_jewels_loc.xml";
$genNew = 0;

if(!file_exists($cacheFile)) {
	$genNew = 1;
} else {
	
	$xml = simplexml_load_file($cacheFile);
	$configs = $xml->configs;
	$updated = intval($configs->updated);
	$delay = $cacheDelayMin;
	
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
	
	if($showRankReg == 1 || ($showRankReg == 0 && time() > $dateReg)) {
		
		require_once('private/classes/classStats.php');
		
		$query = Stats::BossJwlLoc($bossJwlIds);
		if(count($query) > 0) {
			
			require_once('private/includes/itemlist.php');
			
			for($i=0, $c=count($query); $i < $c; $i++) {
				
				$id = $query[$i]['item_id'];
				
				$line .= "\n<line>\n";
				$line .= "<player>".$query[$i]['char_name']."</player>\n";
				$line .= "<clan>".$query[$i]['clan_name']."</clan>\n";
				$line .= "<itemid>".$id."</itemid>\n";
				$line .= "<itemname>".$item[$id][0]."</itemname>\n";
				$line .= "<amount>".$query[$i]['count']."</amount>\n";
				$line .= "</line>";
				
			}
			
		} else {
			$deleteCache = 1;
		}
	
	} else {
		$deleteCache = 1;
	}
	
	@fwrite($wFile, utf8_encode("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<locs>".$line."\n</locs>"));
	@fclose($wFile);
	
	$xml = simplexml_load_file($cacheFile);
	
	if(isset($deleteCache) && file_exists($cacheFile)) {
		unlink($cacheFile);
	}
	
}

?>

<div class='pddInner' style='padding-bottom:0;'>
	<?php echo $LANG[40061]."<br />".$LANG[30500]." <b>".date('d/m/Y', $updated)."</b> ".$LANG[30501]." <b>".date('H:i', $updated)."</b>."; ?><br /><br />
</div>

<style>
	table img { width: 32px; height: 32px; border-radius: 2px; }
</style>

<table cellspacing='0' cellpadding='0' border='0' class='default'>
	
	<tr>
		<th style='width:32px;'></th>
		<th>Item <?php echo $LANG[12013]; ?></th>
		<th>Player <?php echo $LANG[12013]; ?></th>
		<th>Clan</th>
	</tr>

	<?php
	
	$line = $xml->line;
	
	for($i=0, $c=count($line); $i < $c; $i++) {
		
		echo "
		<tr".(($i % 2 == 0) ? " class='two'" : "").">
			<td><img width='32' height='32' src='imgs/icons.php?type=1&id=".$line[$i]->itemid."' /></td>
			<td>".$line[$i]->itemname." (".$line[$i]->amount.")</td>
			<td>".$line[$i]->player."</td>
			<td>".(!empty(trim($line[$i]->clan)) ? $line[$i]->clan : '-')."</td>
		</tr>
		";
		
	}
	
	?>

</table>