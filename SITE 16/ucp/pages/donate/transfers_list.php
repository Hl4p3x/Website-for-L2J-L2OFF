<?php if((!$indexing) || ($logged != 1)) { exit; }
require('private/classes/classDonate.php');
?>

<ul class="breadcrumb">
	<li><a href='./?module=donate&page=add'><i class='fa fa-money'></i> <?php echo $LANG[12039]; ?></a></li>
	<li><?php echo $LANG[40037]; ?></li>
</ul>

<h1><?php echo $LANG[40037]; ?></h1>

<div class='pddInner'>
	
	<?php
	
	if($funct['trnsf1'] == 1) {
		
		echo "<h3>".$LANG[40038]."</h3>
		
		<table cellspacing='0' cellpadding='0' border='0' class='default'>
		
			<tr>
				<th>#</th>
				<th>".$LANG[10168]."</th>
				<th>".$LANG[10167]."</th>
				<th>".$LANG[10116]."</th>
			</tr>
		";
	
		$transfs = Donate::listConverts($_SESSION['acc']);
		if(count($transfs) > 0) {
			
			
			for($i=0, $c=count($transfs); $i < $c; $i++) {
				
				echo "
				<tr".(($i % 2 == 0) ? " class='two'" : '').">
					<td>".($i+1)."</td>
					<td>".$transfs[$i]['quantidade']."</td>
					<td>".$transfs[$i]['char_name']."</td>
					<td>".date('d/m/Y H:i', strtotime($transfs[$i]['cdata']))."</td>
				</tr>
				";
			}
			
			
		} else {
			echo "<tr><td colspan='4'>".$LANG[40040]."</td></tr>";
		}
		
		echo "</table><br />";
		
	}
	
	if($funct['trnsf2'] == 1) {
		
		echo "<h3>".$LANG[40039]."</h3>
		
		<table cellspacing='0' cellpadding='0' border='0' class='default'>
		
			<tr>
				<th>#</th>
				<th>".$LANG[10168]."</th>
				<th>".$LANG[10167]."</th>
				<th>".$LANG[10116]."</th>
			</tr>
		";
	
		$transfs = Donate::listTransfers($_SESSION['acc']);
		if(count($transfs) > 0) {
			
			
			for($i=0, $c=count($transfs); $i < $c; $i++) {
				
				echo "
				<tr".(($i % 2 == 0) ? " class='two'" : '').">
					<td>".($i+1)."</td>
					<td>".$transfs[$i]['quantidade']."</td>
					<td>".$transfs[$i]['char_name']."</td>
					<td>".date('d/m/Y H:i', strtotime($transfs[$i]['tdata']))."</td>
				</tr>
				";
			}
			
			
		} else {
			echo "<tr><td colspan='4'>".$LANG[40040]."</td></tr>";
		}
		
		echo "</table>";
		
	}
	
	?>
	
</div>
