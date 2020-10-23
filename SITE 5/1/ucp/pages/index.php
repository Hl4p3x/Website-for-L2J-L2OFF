<?php

if(!$indexing) { exit; }

$dirCache = 'cache/';
$filesCache = glob("$dirCache{*.txt}", GLOB_BRACE);
foreach($filesCache as $file){
	if(filemtime($file) < (time()-86400)) {
		unlink($file);
	}
}

require('private/classes/classIndex.php');

$accData = Index::accData($_SESSION['acc']);
if(count($accData) == 0) {
	require("private/classes/classAccess.php");
	Access::logout();
}

$lastLogins = Index::lastLogins($_SESSION['acc']);

$lastLogin[0]['ip'] = !empty($lastLogins[0]['ip']) ? $lastLogins[0]['ip'] : '-';
$lastLogin[0]['date'] = !empty($lastLogins[0]['logdate']) ? date('F d, Y \a\t H:i', $lastLogins[0]['logdate']) : '-';

$lastLogin[1]['ip'] = !empty($lastLogins[1]['ip']) ? $lastLogins[1]['ip'] : '-';
$lastLogin[1]['date'] = !empty($lastLogins[1]['logdate']) ? date('F d, Y \a\t H:i', $lastLogins[1]['logdate']) : '-';

$lastLogin[2]['ip'] = !empty($lastLogins[2]['ip']) ? $lastLogins[2]['ip'] : '-';
$lastLogin[2]['date'] = !empty($lastLogins[2]['logdate']) ? date('F d, Y \a\t H:i', $lastLogins[2]['logdate']) : '-';

$lastLogin[3]['ip'] = !empty($lastLogins[3]['ip']) ? $lastLogins[3]['ip'] : '-';
$lastLogin[3]['date'] = !empty($lastLogins[3]['logdate']) ? date('F d, Y \a\t H:i', $lastLogins[3]['logdate']) : '-';

$lastLogin[4]['ip'] = !empty($lastLogins[4]['ip']) ? $lastLogins[4]['ip'] : '-';
$lastLogin[4]['date'] = !empty($lastLogins[4]['logdate']) ? date('F d, Y \a\t H:i', $lastLogins[4]['logdate']) : '-';


?>

<ul class="breadcrumb">
	<li><a href="./"><i class='fa fa-home'></i> Home</a></li>
</ul>

<div class='twoBox'>
	
	<div class='box'>
		<h1><i class='fa fa-info-circle'></i><?php echo $LANG[39044]; ?></h1>
		<div class='lines'>
			<div>Account<span><?php echo $accData[0]['login']; ?></span></div>
			<div class='two'>E-mail<span><?php echo $accData[0]['email']; ?></span></div>
			<div><?php echo $LANG[16003]; ?><span><?php echo (!empty($accData[0]['created_time']) && is_numeric($accData[0]['created_time']) ? date('F d, Y \a\t H:i', ($accData[0]['created_time'])) : $LANG[16004]); ?></span></div>
			<div class='two'><?php echo $LANG[16002]; ?><span><?php echo (!empty($accData[0]['lastactive']) ? date('F d, Y \a\t H:i', ($accData[0]['lastactive']/1000)) : $LANG[16004]); ?></span></div>
			<div><?php echo $LANG[16005]; ?><span><?php echo (!empty($accData[0]['lastIP']) ? $accData[0]['lastIP'] : '-'); ?></span></div>
			<div class='two'><?php echo $LANG[39046]; ?><span><?php echo intval($accData[0]['chars']); ?></span></div>
		</div>
	</div>
	
	<div class='box'>
		<h1><i class='fa fa-history'></i><?php echo $LANG[39045]; ?></h1>
		<div class='lines logs'>
			<div style='background: #e3e3e3;'>IP<span><?php echo $LANG[10116]; ?></span></div>
		</div>
		<div class='lines logs'>
			<?php
			echo "
			<div>".$lastLogin[0]['ip']."<span>".$lastLogin[0]['date']."</span></div>
			<div class='two'>".$lastLogin[1]['ip']."<span>".$lastLogin[1]['date']."</span></div>
			<div>".$lastLogin[2]['ip']."<span>".$lastLogin[2]['date']."</span></div>
			<div class='two'>".$lastLogin[3]['ip']."<span>".$lastLogin[3]['date']."</span></div>
			<div>".$lastLogin[4]['ip']."<span>".$lastLogin[4]['date']."</span></div>
			";
			?>
		</div>
	</div>
	
</div>

<div class='box'>
	<h1><i class='fa fa-users'></i><?php echo $LANG[39046]; ?></h1>
	<div class='mult'>
		<div class='selec'>
			<?php
			
			$findChars = Index::findChars($_SESSION['acc']);
			if(count($findChars) > 0) {
				for($i=0, $c=count($findChars); $i < $c; $i++) {
					echo "
					<div".($i == 0 ? " class='actived'" : "")." data-id='".$findChars[$i]['obj_Id']."'>
						<img src='imgs/avatar/".genAvatar($findChars[$i]['base_class'], $findChars[$i]['sex'])."' />
						<div>".$findChars[$i]['char_name']."</div>
					</div>
					";
				}
			}
			for($i=1; $i <= intval(7-count($findChars)); $i++) {
				echo "<span></span>";
			}
			?>
		</div>
		
		<?php
		if(count($findChars) == 0) {
			echo "
			<div class='infos actived'>
				<div class='lines'>
					<div>".$LANG[12013]."<span>-</span></div>
					<div class='two'>".$LANG[39047]."Título<span>-</span></div>
					<div>".$LANG[39048]."<span>-</span></div>
					<div class='two'>Online<span>-</span></div>
					<div>Base Class<span>-</span></div>
					<div class='two'>Sub-class 1<span>-</span></div>
					<div>Sub-class 2<span>-</span></div>
					<div class='two'>Sub-class 3<span>-</span></div>
					<div>".$LANG[39049]."<span>-</span></div>
				</div>
				<div class='lines'>
					<div class='two'>".$LANG[39050]."<span>-</span></div>
					<div>PvP<span>-</span></div>
					<div class='two'>Pk<span>-</span></div>
					<div>Karma<span>-</span></div>
					<div class='two'>Clan<span>-</span></div>
					<div>".$LANG[39051]."<span>-</span></div>
					<div class='two'>".$LANG[39052]."<span>-</span></div>
					<div>Hero<span>-</span></div>
					<div class='two'>".$LANG[39053]."<span>-</span></div>
				</div>
			</div>
			";
		} else {
			for($i=0, $c=count($findChars); $i < $c; $i++) {
				
				if(!empty($findChars[$i]['onlinetime'])) {
					$dias = intval(intval($findChars[$i]['onlinetime']) / 86400); $marcador = intval($findChars[$i]['onlinetime']) % 86400; $hora = intval($marcador / 3600); $marcador = $marcador % 3600; $minuto = intval($marcador / 60); $segundos = $marcador % 60;
					$onlineTime = '';
					if(!empty($dias)) { $onlineTime .= $dias.' '.$LANG[12014].'s, '; }
					if(!empty($hora)) { $onlineTime .= $hora.' hrs, '; }
					if(!empty($minuto)) { $onlineTime .= $minuto.' min'; }
				} else {
					$onlineTime = $LANG[16004];
				}
				
				echo "
				<div class='infos".($i == 0 ? " actived" : "")."' data-id='".$findChars[$i]['obj_Id']."'>
					<div class='lines'>
						<div>".$LANG[12013]."<span>".trim($findChars[$i]['char_name'])."</span></div>
						<div class='two'>".$LANG[39047]."<span>".(!empty($findChars[$i]['title']) ? trim($findChars[$i]['title']) : "-")."</span></div>
						<div>".$LANG[39048]."<span>".(!empty($findChars[$i]['lastAccess']) ? date('F d, Y \a\t H:i', (trim($findChars[$i]['lastAccess'])/1000)) : $LANG[16004])."</span></div>
						<div class='two'>Online<span>".($findChars[$i]['online'] != 0 ? $LANG[40008] : $LANG[40009])."</span></div>
						<div>Base Class<span>".getClassName($findChars[$i]['base_class'])."</span></div>
						<div class='two'>Sub-class 1<span>".(!empty($findChars[$i]['subclass1']) ? getClassName($findChars[$i]['subclass1']) : "-")."</span></div>
						<div>Sub-class 2<span>".(!empty($findChars[$i]['subclass2']) ? getClassName($findChars[$i]['subclass2']) : "-")."</span></div>
						<div class='two'>Sub-class 3<span>".(!empty($findChars[$i]['subclass3']) ? getClassName($findChars[$i]['subclass3']) : "-")."</span></div>
						<div>".$LANG[39049]."<span>".$findChars[$i]['level']."</span></div>
					</div>
					<div class='lines'>
						<div class='two'>".$LANG[39050]."<span>".($findChars[$i]['sex'] != 0 ? "Feminino" : "Masculino")."</span></div>
						<div>PvP<span>".$findChars[$i]['pvpkills']."</span></div>
						<div class='two'>Pk<span>".$findChars[$i]['pkkills']."</span></div>
						<div>Karma<span>".$findChars[$i]['karma']."</span></div>
						<div class='two'>Clan<span>".(!empty($findChars[$i]['clan_name']) ? trim($findChars[$i]['clan_name']) : "-")."</span></div>
						<div>".$LANG[39051]."<span>".(!empty($findChars[$i]['ally_name']) ? $findChars[$i]['ally_name'] : "-")."</span></div>
						<div class='two'>".$LANG[39052]."<span>".($findChars[$i]['nobless'] > 0 ? $LANG[40008] : $LANG[40009])."</span></div>
						<div>Hero<span>".(!empty($findChars[$i]['hero_end']) ? ($findChars[$i]['hero_end'] > (time()*1000) ? $LANG[40008] : $LANG[40009]) : $LANG[40009])."</span></div>
						<div class='two'>".$LANG[39053]."<span>".$onlineTime."</span></div>
					</div>
				</div>
				";
			}
		}
		?>
		
	</div>
</div>

<?php if(count($findChars) > 7) { ?>
<script>
	$(function(){
		
		var divsCount = $('.mult .selec > div').length;
		if((divsCount * 103) > 718) {
			var newWidth = ((718 / divsCount) - 23);
			$('.mult .selec > div, .mult .selec > div > img').css({ 'width': newWidth+'px' });
			$('.mult .selec > div > div').css({ 'width': (newWidth-8)+'px' });
		}
		
	});
</script>
<?php } ?>