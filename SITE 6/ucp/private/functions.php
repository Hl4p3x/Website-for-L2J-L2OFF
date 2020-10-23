<?php

function atualAlert($msg, $msg_link='') {
	$filterBR = array('&lt;br /&gt;' => '<br />', '&lt;br&gt;' => '<br />', '&lt;b&gt;' => '<b>', '&lt;/b&gt;' => '</b>', '\\n' => '<br />');
	return "<script>atualAlert('".strtr(addslashes(htmlentities(trim($msg), ENT_QUOTES, 'ISO-8859-1')), $filterBR)."', '".$msg_link."');</script>";
}

function fim($msg='', $act='', $url='', $debit=0) {
	if(isset($_POST['isJS'])) {
	    die(json_encode(array('msg' => $msg, 'act' => $act, 'url' => $url, 'debit' => $debit)));
	} else {
		if(!empty($msg)) { $_SESSION['aAlert_msg'] = $msg; $_SESSION['aAlert_act'] = $act; }
		echo "<script type='text/javascript'>".(!empty($url) ? "document.location.replace('".$url."');" : "history.back();")."</script>";
	}
	exit;
}

function debitBalance($acc, $count){
	
	$count = intval(trim($count));
	
	$checkCount = DB::Executa("SELECT saldo FROM site_balance WHERE account = '".$acc."' LIMIT 1");
	$saldo = !empty($checkCount[0]['saldo']) ? intval(trim($checkCount[0]['saldo'])) : 0;
	
	if($saldo >= $count) {
		
		if(DB::Executa("UPDATE site_balance SET saldo = (saldo-".$count.") WHERE account = '".$acc."' LIMIT 1")) {
			return 'OK';
		}
		
	}
	
	return 'ERROR';
	
}

function getClassName($classID) {
	switch(trim($classID))
	{
		//HUMANS
		case 0: $class='Human Fighter'; break;
		case 1: $class='Human Warrior'; break;
		case 2: $class='Gladiator'; break;
		case 3: $class='Warlord'; break;
		case 4: $class='Human Knight'; break;
		case 5: $class='Paladin'; break;
		case 6: $class='Dark Avenger'; break;
		case 7: $class='Rogue'; break;
		case 8: $class='Treasure Hunter'; break;
		case 9: $class='Hawkeye'; break;
		case 10: $class='Human Mage'; break;
		case 11: $class='Human Wizard'; break;
		case 12: $class='Sorcerer'; break;
		case 13: $class='Necromancer'; break;
		case 14: $class='Warlock'; break;
		case 15: $class='Cleric'; break;
		case 16: $class='Bishop'; break;
		case 17: $class='Prophet'; break;
		//ELVES
		case 18: $class='Elven Fighter'; break;
		case 19: $class='Elven Knight'; break;
		case 20: $class='Temple Knight'; break;
		case 21: $class='Swordsinger'; break;
		case 22: $class='Elven Scout'; break;
		case 23: $class='Plainswalker'; break;
		case 24: $class='Silver Ranger'; break;
		case 25: $class='Elven Mage'; break;
		case 26: $class='Elven Wizard'; break;
		case 27: $class='Spellsinger'; break;
		case 28: $class='Elemental Summoner'; break;
		case 29: $class='Elven Oracle'; break;
		case 30: $class='Elven Elder'; break;
		//DARK ELVES
		case 31: $class='Dark Elven Fighter'; break;
		case 32: $class='Pallus Knight'; break;
		case 33: $class='Shillien Knight'; break;
		case 34: $class='Bladedancer'; break;
		case 35: $class='Assasin'; break;
		case 36: $class='Abyss Walker'; break;
		case 37: $class='Phantom Ranger'; break;
		case 38: $class='Dark Elven Mage'; break;
		case 39: $class='Dark Wizard'; break;
		case 40: $class='Spellhowler'; break;
		case 41: $class='Phantom Summoner'; break;
		case 42: $class='Shillien Oracle'; break;
		case 43: $class='Shillien Elder'; break;
		//ORCS
		case 44: $class='Orc Fighter'; break;
		case 45: $class='Orc Raider'; break;
		case 46: $class='Destroyer'; break;
		case 47: $class='Monk'; break;
		case 48: $class='Tyrant'; break;
		case 49: $class='Orc Mage'; break;
		case 50: $class='Orc Shaman'; break;
		case 51: $class='Overlord'; break;
		case 52: $class='Warcryer'; break;
		//DWARVES
		case 53: $class='Dwarven Fighter'; break;
		case 54: $class='Scavenger'; break;
		case 55: $class='Bounty Hunter'; break;
		case 56: $class='Artisan'; break;
		case 57: $class='Warsmith'; break;
		//HUMANS 3rd Professions
		case 88: $class='Duelist'; break;
		case 89: $class='Dread Nought'; break;
		case 90: $class='Phoenix Knight'; break;
		case 91: $class='Hell Knight'; break;
		case 92: $class='Sagittarius'; break;
		case 93: $class='Adventurer'; break;
		case 94: $class='Archmage'; break;
		case 95: $class='Soultaker'; break;
		case 96: $class='Arcane Lord'; break;
		case 97: $class='Cardinal'; break;
		case 98: $class='Hierophant'; break;
		//ELVES 3rd Professions
		case 99: $class='Evas Templar'; break;
		case 100: $class='Sword Muse'; break;
		case 101: $class='Wind Rider'; break;
		case 102: $class='Moonlight Sentinel'; break;
		case 103: $class='Mystic Muse'; break;
		case 104: $class='Elemental Master'; break;
		case 105: $class='Evas Saint'; break;
		//DARK ELVES 3rd Professions
		case 106: $class='Shillien Templar'; break;
		case 107: $class='Spectral Dancer'; break;
		case 108: $class='Ghost Hunter'; break;
		case 109: $class='Ghost Sentinel'; break;
		case 110: $class='Storm Screamer'; break;
		case 111: $class='Spectral Master'; break;
		case 112: $class='Shillien Saint'; break;
		//ORCS 3rd Professions
		case 113: $class='Titan'; break;
		case 114: $class='Grand Khauatari'; break;
		case 115: $class='Dominator'; break;
		case 116: $class='Doomcryer'; break;
		//DWARVES 3rd Professions
		case 117: $class='Fortune Seeker'; break;
		case 118: $class='Maestro'; break;
		// KAMAEL Classes
		case 123: $class='Male Kamael Soldier'; break;
		case 124: $class='Female Kamael Soldier'; break;
		case 125: $class='Trooper'; break;
		case 126: $class='Warder'; break;
		case 127: $class='Berserker'; break;
		case 128: $class='Male Soul Breaker'; break;
		case 129: $class='Female Soul Breaker'; break;
		case 130: $class='Arbalester'; break;
		case 131: $class='Doombringer'; break;
		case 132: $class='Male Soul Hound'; break;
		case 133: $class='Female Soul Hound'; break;
		case 134: $class='Trickster'; break;
		case 135: $class='Inspector'; break;
		case 136: $class='Judicator'; break;
		default: $class='Unknow';
	}
	return $class;
}


function genAvatar($classID, $gender=0) {
	/* 1 = human fighter / 2 = human mage / 3 = elf / 4 = dark / 5 = orc figther / 6 = orc mage / 7 = dwarf / 8 = kamael */
	$ids = array(0 => '1', 1 => '1', 2 => '1', 3 => '1', 4 => '1', 5 => '1', 6 => '1', 7 => '1', 8 => '1', 9 => '1', 10 => '2', 11 => '2', 12 => '2', 13 => '2', 14 => '2', 15 => '2', 16 => '2', 17 => '2', 18 => '3', 19 => '3', 20 => '3', 21 => '3', 22 => '3', 23 => '3', 24 => '3', 25 => '3', 26 => '3', 27 => '3', 28 => '3', 29 => '3', 30 => '3', 31 => '4', 32 => '4', 33 => '4', 34 => '4', 35 => '4', 36 => '4', 37 => '4', 38 => '4', 39 => '4', 40 => '4', 41 => '4', 42 => '4', 43 => '4', 44 => '5', 45 => '5', 46 => '5', 47 => '5', 48 => '5', 49 => '6', 50 => '6', 51 => '6', 52 => '6', 53 => '7', 54 => '7', 55 => '7', 56 => '7', 57 => '7', 88 => '1', 89 => '1', 90 => '1', 91 => '1', 92 => '1',    93 => '1', 94 => '2', 95 => '2', 96 => '2', 97 => '2', 98 => '2', 99 => '3', 100 => '3', 101 => '3', 102 => '3', 103 => '3', 104 => '3', 105 => '3', 106 => '4', 107 => '4', 108 => '4', 109 => '4', 110 => '4', 111 => '4', 112 => '4', 113 => '5', 114 => '5', 115 => '6', 116 => '6', 117 => '7', 118 => '7');
	$ref = !empty($ids[$classID]) ? $ids[$classID] : 8;
	if($ref == 1) { if($gender == 0) { return "human_male_fighter.jpg"; } else { return "human_female_fighter.jpg"; } }
	elseif($ref == 2) { if($gender == 0) { return "human_male_mage.jpg"; } else { return "human_female_mage.jpg"; } }
	elseif($ref == 3) { if($gender == 0) { return "elf_male.jpg"; } else { return "elf_female.jpg"; } }
	elseif($ref == 4) { if($gender == 0) { return "dark_male.jpg"; } else { return "dark_female.jpg"; } }
	elseif($ref == 5) { if($gender == 0) { return "orc_male_fighter.jpg"; } else { return "orc_female_fighter.jpg"; } }
	elseif($ref == 6) { if($gender == 0) { return "orc_male_mage.jpg"; } else { return "orc_female_mage.jpg"; } }
	elseif($ref == 7) { if($gender == 0) { return "dwarf_male.jpg"; } else { return "dwarf_female.jpg"; } }
	else { if($gender == 0) { return "kamael_male.jpg"; } else { return "kamael_female.jpg"; } }
}


function uploadImagem($size, $type, $tname, $name, $maxSize, $maxWidth, $maxHeight, $dir) {
	$LANG = $GLOBALS['LANG'];
	if($size > $maxSize) { return $LANG[40023]." (".$maxSize." bytes)"; }
	$types = array('image/jpg', 'image/jpeg', 'image/png', 'image/bmp', 'image/x-bmp', 'image/x-bitmap', 'image/x-xbitmap', 'image/x-win-bitmap', 'image/x-windows-bmp', 'image/ms-bmp', 'image/x-ms-bmp', 'application/bmp', 'application/x-bmp', 'application/x-win-bitmap');
	if(!in_array($type, $types)) { return $LANG[40024]." #1"; }
	$getImage = @getimagesize($tname); $imgType = $getImage['mime']; $imgWidth = $getImage['0']; $imgHeight = $getImage['1'];
	if(!in_array($imgType, $types)) { return $LANG[40024]." #2"; }
	if($imgWidth > $maxWidth) { return $LANG[40025]." ".$maxWidth."px!"; }
	if($imgHeight > $maxHeight) { return $LANG[40026]." ".$maxHeight."px!"; }
	$ext = explode('.', $name); if(count($ext) > 1) { $ext = $ext[(count($ext)-1)]; } else { $ext = ""; }
	if($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'bmp') { return $LANG[40024]." #3"; }
	$arqName = md5(time().$name).'.'.$ext;
	if(move_uploaded_file($tname, $dir.$arqName)) { return "_OK-".$arqName; } else { return $LANG[40027]; }
}

function obtainCurrencySymbol($moeda) {
	switch($moeda) {
		case 'BRL': return 'R$'; break;
		case 'USD': return '$'; break;
		case 'EUR': return '€'; break;
		default: return '$';
	}
}

function obtainOrderStatusName($status) {
	$LANG = $GLOBALS['LANG'];
	switch($status) {
		case 1: return $LANG[39001]; break; // Pendente
		case 2: return 'Deleted'; break; // Excluída (não aparece em nenhum local)
		case 3: return $LANG[39002]; break; // Pago
		case 4: return $LANG[39003]; break; // Entregue
		case 5: return $LANG[39004]; break; // Cancelada
		default: return $LANG[39001]; break; // Pendente
	}
}

