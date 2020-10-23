<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; } ?>

<section>
<h1>Downloads</h1>

<div class='pddInner'>
	
	<?php echo $LANG[12038]; ?>
	
	<br /><br /><br /><hr />
	
	<h2>Download <?php echo $LANG[11001]; ?></h2>
	<br />
	
	
	<?php
	$desativarReg = 0;
	$dateReg = mktime($reg['hr'],$reg['min'],0,$reg['mes'],$reg['dia'],$reg['ano']);
	if($dateReg > time()) {
		echo "<div class='rmsg error'>".$LANG[12977]."<br /> ".date('d F, Y \- H:i', $dateReg)."</div>";
		$desativarReg = 1;
	}
	?>

	<div style='display:table;margin: 0 auto;'><a target='_blank' href="http://download1382.mediafire.com/x1a30v0yg1ig/gvda8sy4kbw5bgf/Files+La2Varkas.rar" class='default dbig'>Direct</a></div>
	<br>
	
	<div style='display:table;margin: 0 auto;'><a target='_blank' href="https://www.mediafire.com/file/gvda8sy4kbw5bgf/Files%20La2Varkas.rar" class='default dbig'>Media Fire</a></div>
	<br>
		<div style='display:table;margin: 0 auto;'><a target='_blank' href="https://yadi.sk/d/F8nWpwqU3NsqW6" class='default dbig'>Yandex Disk</a></div>
	<br>
		<div style='display:table;margin: 0 auto;'><a target='_blank' href="http://www42.zippyshare.com/v/KWipaTXA/file.html" class='default dbig'>Zippyshare</a></div>		
	<br>
		<div style='display:table;margin: 0 auto;'><a target='_blank' href="https://mega.nz/#!EWwyzILa!vX_ZmwcTlP7DkFLCmA5u3ArxFoa3Vt_49O-mV2l1ljA" class='default dbig'>Mega</a></div>		
		
	
	
	<br /><br /><br /><hr />
	
	<h2>Download <?php echo $server_chronicle; ?> Client</h2>
	<br />
	<div style='display:table;margin: 0 auto;'><a target='_blank' href='https://mega.nz/#!apEWEJ6Y!NHvpzRPxsJGAbGuSXgEc16JfeuEVjtsW0X1_znQh5AI' class='default dbig'>MEGA</a></div>
	<div style='display:table;margin: 0 auto;'><a target='_blank' href='http://www.ausgamers.com/files/download/59001/lineage-2-the-chaotic-throne--interlude-client' class='default dbig'>Ausgamers</a></div>
	<br />
<hr />
</div>   
</section>