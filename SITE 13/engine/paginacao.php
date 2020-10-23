<div class='paginacao'>

<?php
if(!isset($link_pos)) { $link_pos=''; }
$npage = addslashes($_GET['pg']);
if(!isset($npage)) { $npage = 0; }
$quant_pg = ceil($quantreg/$numreg);
$quant_pg++;
	
	if($npage > 0) {
		echo "<a href='".$link_pg."&pg=0".$link_pos."'>&laquo;</a>";
		echo "<a href='".$link_pg."&pg=".($npage-1).$link_pos."'>&lsaquo;</a>";
	} else {
		echo "<a onclick='return false;' class='desatived'>&laquo;</a>";
		echo "<a onclick='return false;' class='desatived'>&laquo;</a>";
	}
	
	$min_pg = $npage - 3;
	$max_pg = $npage + 6;
	
	if($npage < 4) {
		$max_pg += (4 - $npage);
	}

	if($npage > ($quant_pg - 6)) {
		$min_pg += ($quant_pg - 6) - $npage;
	}

	if($min_pg < 1) { $min_pg=1; }
	if($max_pg > $quant_pg) { $max_pg=$quant_pg; }


	for($i_pg=$min_pg; $i_pg < $max_pg; $i_pg++) {
		if ($npage == ($i_pg-1)) {
			echo "<a onclick='return false;' class='atual'>".$i_pg."</a>";
		} else {
			$i_pg2 = $i_pg-1;
			echo "<a href='".$link_pg."&pg=".$i_pg2.$link_pos."'>".$i_pg."</a>";
		}
	}
	
	if (($npage+2) < $quant_pg) { 
		echo "<a href='".$link_pg."&pg=".($npage+1).$link_pos."'>&rsaquo;</a>";
		echo "<a href='".$link_pg."&pg=".($quant_pg-2).$link_pos."'>&raquo;</a>";
	} else { 
		echo "<a onclick='return false;' class='desatived'>&rsaquo;</a>";
		echo "<a onclick='return false;' class='desatived'>&raquo;</a>";
	}

?>

</div>