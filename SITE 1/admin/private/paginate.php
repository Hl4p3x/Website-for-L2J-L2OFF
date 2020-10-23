<?php

if($pagin['total_results'] > $pagin['max_results']) {

	echo "<div class='box-footer clearfix'><ul class='pagination pagination-sm no-margin pull-right'>";

	$pagin['quant_pages'] = ceil($pagin['total_results']/$pagin['max_results']);

	if($pagin['atual'] > 1) {
		echo "<li><a title='Primeira página' href='".$pagin['link']."&pg="."1".(isset($pagin['pos_link']) ? $pagin['pos_link'] : '')."'>&laquo;</a></li>";
	} else {
		echo "<li class='disabled'><a onclick='return false;' class='disabled'>&laquo;</a></li>";
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
				echo "<li class='active'><a onclick='return false;'>".$i."</a></li>";
			} else {
				echo "<li><a href='".$pagin['link']."&pg=".$i.(isset($pagin['pos_link']) ? $pagin['pos_link'] : '')."'>".$i."</a></li>";
			}
		}
	}

	if ($pagin['atual'] != $pagin['quant_pages']) {
		echo "<li><a title='Ultima página' href='".$pagin['link']."&pg=".$pagin['quant_pages'].(isset($pagin['pos_link']) ? $pagin['pos_link'] : '')."'>&raquo;</a></li>";
	} else {
		echo "<li class='disabled'><a onclick='return false;'>&raquo;</a></li>";
	}

	echo "</ul></div>";

}

?>
