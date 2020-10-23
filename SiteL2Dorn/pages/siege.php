<?php if(!$indexing || $dpage['csiege'] != 1) { echo "<script>document.location.replace('./');</script>"; exit; } ?>

<h1>Castle & Siege</h1>

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

<div style='display:table;width:100%;'>
	
	<?php
	
	if(substr($gmt, 0, 1) == '-') { $gmtn = substr($gmt, 1); } else { $gmtn = "-".$gmt; } $gmtf = $gmtn*3600;
	
	$cacheFile = "cache/siege.xml";
	$genNew = 0;
	
	if(!file_exists($cacheFile)) {
		$genNew = 1;
	} else {
		
		$xml = simplexml_load_file($cacheFile);
		$configs = $xml->configs;
		$updated = intval($configs->updated);
		$delay = 1;
		
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
		$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n</configs>";
		
		require_once('private/classes/classStats.php');
		
		$query = Stats::Siege();
		if(count($query) > 0) {
			
			for($i=0, $c=count($query); $i < $c; $i++) {
				
				$clan_leader = (!empty($query[$i]['char_name']) ? $query[$i]['char_name'] : 'No Leader');
				$clan_owner = (!empty($query[$i]['clan_name']) ? $query[$i]['clan_name'] : 'No Owner');
				$alliance = (!empty($query[$i]['ally_name']) ? $query[$i]['ally_name'] : 'No Alliance');
				$war_day = (strlen($query[$i]['sdate']) > 11 ? date('d F, Y H:i', ($query[$i]['sdate']/1000)-$gmtf) : date('d F, Y H:i', ($query[$i]['sdate'])-$gmtf));
				$castle_tax = (!empty($query[$i]['stax']) ? $query[$i]['stax'] : '0');
				
				$castle_attacks = 0; $castle_def = 0; $castle_attacks_name = ''; $castle_def_name = '';
				$partps = Stats::SiegeParticipants($query[$i]['id']);
				if(count($partps) > 0) {
					for($ii=0, $cc=count($partps); $ii < $cc; $ii++) {
						if($partps[$ii]['type'] == '1') {
							$castle_attacks += 1;
							$castle_attacks_name .= $partps[$ii]['clan_name'].', ';
						} else {
							$castle_def += 1;
							$castle_def_name .= $partps[$ii]['clan_name'].', ';
						}
					}
					if(!empty($castle_attacks_name)) { $castle_attacks_name = substr($castle_attacks_name, 0, -2); }
					if(!empty($castle_def_name)) { $castle_def_name = substr($castle_def_name, 0, -2); }
				} else {
					$castle_attacks = '0'; $castle_def = '0';
				}
				
				$line .= "\n<line>\n";
				$line .= "<castle>".$query[$i]['name']."</castle>\n";
				$line .= "<owner>".$clan_owner."</owner>\n";
				$line .= "<leader>".$clan_leader."</leader>\n";
				$line .= "<ally>".$alliance."</ally>\n";
				$line .= "<nextwar>".$war_day."</nextwar>\n";
				$line .= "<tax>".$castle_tax."</tax>\n";
				$line .= "<attacks>".$castle_attacks."</attacks>\n";
				$line .= "<attacksname>".$castle_attacks_name."</attacksname>\n";
				$line .= "<defs>".$castle_def."</defs>\n";
				$line .= "<defsname>".$castle_def_name."</defsname>\n";
				$line .= "</line>";
				
			}
			
		} else {
			$deleteCache = 1;
		}
		
		@fwrite($wFile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<siege>".$line."\n</siege>");
		@fclose($wFile);
		
		$xml = simplexml_load_file($cacheFile);
		
		if(isset($deleteCache) && file_exists($cacheFile)) {
			unlink($cacheFile);
		}
		
	}
	
	$line = $xml->line;
	
	if(count($line) > 0) {
		
		for($i=0, $c=count($line); $i < $c; $i++) {
			
			echo "
				<hr />
				<div class='castled'>
					<div class='ct'>".ucwords(strtolower($line[$i]->castle))." Castle</div>
					<div>
						<div class='imgc ".strtolower($line[$i]->castle)."'><span></span></div>
						<div class='ci'>
							<div class='co'>".$LANG[11003].":</div>
							<div class='cc'>".$line[$i]->owner."</div>
							<div class='co'>".$LANG[11004].":</div>
							<div class='cc'>".$line[$i]->leader."</div>
							<div class='co'>".$LANG[11005].":</div>
							<div class='cc'>".$line[$i]->ally."</div>
						</div>
					</div>
					<div class='nwar'>
						<div style='padding:0 0 7px;'><b>".$LANG[11006].":</b> ".$line[$i]->nextwar." &nbsp;&nbsp;&nbsp; <b>".$LANG[11011].":</b> ".$line[$i]->tax."%</div>
						<div style='padding:0 0 7px;'><b>".$LANG[11007].":</b> ".$line[$i]->attacks." ".($line[$i]->attacks == 0 ? '' : '('.$line[$i]->attacksname.')')."</div>
						<div style='padding:0 0 7px;'><b>".$LANG[11008].":</b> ".$line[$i]->defs." ".($line[$i]->defs == 0 ? '' : '('.$line[$i]->defsname.')')."</div>
					</div>
				</div>
			";
			
		}
	}
	
	?>

</div>

<br />