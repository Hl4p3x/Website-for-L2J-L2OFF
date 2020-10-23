<div class='paginacao'>

<?php
$quant_pg = ceil($quantreg/$numreg);
$quant_pg++;
	
	if ($npage > 0) {
		echo "<a title='Primeira página' href='".$link_pg."&pg=1'>&laquo;</a>";
		echo "<a title='Página anterior' href='".$link_pg."&pg=".$npage."'>&lsaquo;</a>";
	} else { 
		echo "<a onclick='return false;' class='desatived'>&laquo;</a>";
		echo "<a onclick='return false;' class='desatived'>&laquo;</a>";
	}

	if(($npage == $quant_pg)||($npage > ($quant_pg - 5))) {
		$ii = $quant_pg - 7;
		$quant_pg2 = $quant_pg;
	} elseif($npage < 4) {
		$ii = 1;
		$quant_pg2 = 6;
	} elseif($npage == 4) {
		$ii = 2;
		$quant_pg2 = 8;
	} elseif($npage < 9) {
		$ii = 2;
		$quant_pg2 = 13;
	} elseif($npage == 9) {
		$ii = 6;
		$quant_pg2 = 17;
	} else {
		$ii = $npage - 2;
		$quant_pg2 = $npage + 7;
	}

	for($i_pg=$ii;$i_pg<$quant_pg2;$i_pg++) {
		if($i_pg > 0) {
			if ($npage == ($i_pg-1)) {
				echo "<a onclick='return false;' class='atual'>".$i_pg."</a>";
			} else {
				echo "<a href='".$link_pg."&pg=".$i_pg."'>".$i_pg."</a>";
			}
		}
	}

	if (($npage+2) < $quant_pg) {
		echo "<a title='Próxima página' href='".$link_pg."&pg=".($npage+2)."'>&rsaquo;</a>";
		echo "<a title='Ultima página' href='".$link_pg."&pg=".($quant_pg-1)."'>&raquo;</a>";
	} else {
		echo "<a onclick='return false;' class='desatived'>&rsaquo;</a>";
		echo "<a onclick='return false;' class='desatived'>&rsaquo;</a>";
	}

?>

</div>