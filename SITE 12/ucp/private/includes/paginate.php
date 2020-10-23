<?php

if($pagin['total_results'] > $pagin['max_results']) {

	echo "<div class='paginate'>";

	$pagin['quant_pages'] = ceil($pagin['total_results']/$pagin['max_results']);

	if($pagin['atual'] > 1) {
		echo "<a title='Primeira página' href='".$pagin['link']."&pg="."1".(isset($pagin['pos_link']) ? $pagin['pos_link'] : '')."'>&laquo;</a>";
	} else {
		echo "<a onclick='return false;' class='desatived'>&laquo;</a>";
	}

	$pagin['first_option'] = ($pagin['atual']-2) < 0 ? 1 : ($pagin['atual']-2);
	$pagin['quant_opcoes'] = ($pagin['atual']+2) > $pagin['quant_pages'] ? $pagin['quant_pages'] : ($pagin['atual']+2);

	if($pagin['atual'] < 3) {
		$pagin['quant_opcoes'] = 5;
	} else if(($pagin['atual']+2) > $pagin['quant_opcoes']) {
		$pagin['quant_opcoes'] = $pagin['atual'] + ($pagin['quant_opcoes'] - $pagin['atual']);
		$pagin['first_option'] = $pagin['quant_opcoes'] - 4;
	}

	if($pagin['quant_opcoes'] > $pagin['quant_pages']) { $pagin['quant_opcoes'] = $pagin['quant_pages']; }

	for($i=$pagin['first_option'], $c=$pagin['quant_opcoes']; $i <= $c; $i++) {
		if($i > 0) {
			if($pagin['atual'] == $i) {
				echo "<a onclick='return false;' class='atual'>".$i."</a>";
			} else {
				echo "<a href='".$pagin['link']."&pg=".$i.(isset($pagin['pos_link']) ? $pagin['pos_link'] : '')."'>".$i."</a>";
			}
		}
	}

	if ($pagin['atual'] != $pagin['quant_pages']) {
		echo "<a title='Ultima página' href='".$pagin['link']."&pg=".$pagin['quant_pages'].(isset($pagin['pos_link']) ? $pagin['pos_link'] : '')."'>&raquo;</a>";
	} else {
		echo "<a onclick='return false;' class='desatived'>&raquo;</a>";
	}

	echo "</div>";

}

?>
