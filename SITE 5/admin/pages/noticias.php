<?php if($indexing == 1) { ?>

<h1>Notícias</h1>



<?php

	if((isset($_GET['ver']))||(isset($_GET['excluir']))||(isset($_GET['editar']))) {
		
		echo "
		<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=noticias' class='atualstudio_button'>&laquo; Voltar</a></div>
		";

		if(isset($_GET['ver'])) {

			if(!is_numeric($_GET['ver'])) { echo "<script type='text/javascript'>document.location.replace('?id=noticias');</script>"; exit; }
			require('pages/noticias_visualizando.php');

		} elseif(isset($_GET['excluir'])) {

			if(!is_numeric($_GET['excluir'])) { echo "<script type='text/javascript'>document.location.replace('?id=noticias');</script>"; exit; }
			require('pages/noticias_excluindo.php');

		} else {

			if(!is_numeric($_GET['editar'])) { echo "<script type='text/javascript'>document.location.replace('?id=noticias');</script>"; exit; }
			require('pages/noticias_editando.php');

		}

	} elseif(isset($_GET['inserir'])) {

		echo "
		<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=noticias' class='atualstudio_button'>&laquo; Voltar</a></div>
		";

		require('pages/noticias_inserindo.php');
	
	} else {

	echo "<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=noticias&inserir' class='atualstudio_button'>Inserir Notícia &raquo;</a></div>";

	if(isset($_GET['success'])) { echo "<div class='notificacao'>Notícia inserida com sucesso!</div>"; }
	if(isset($_GET['successdel'])) { echo "<div class='notificacao'>Notícia excluída com sucesso!</div>"; }
	echo "Abaixo são exibidas todas as notícias já existentes.";
	

	$link_pg = "?id=noticias";
	if(!isset($_GET['pg'])) { $_GET['pg'] = 1; } elseif(!is_numeric($_GET['pg'])) { $_GET['pg'] = 1; } $npage = addslashes(($_GET['pg'] - 1));
	$numreg = 5; $inicial = $npage * $numreg;
	
	$searchnews = mysql_query("SELECT * FROM ".DBNAME.".site_news ORDER BY ndate DESC LIMIT ".$inicial.", ".$numreg."", $conexao);
	$queryselect_count = mysql_query("SELECT nid FROM ".DBNAME.".site_news", $conexao);
	$quantreg = mysql_num_rows($queryselect_count);
	
	echo "<div style='padding: 20px 0 0 0;'>";
	
	if(mysql_num_rows($searchnews) > 0) {
		
		echo "<div style='min-height:210px'>";
	
		while($snw=mysql_fetch_array($searchnews)) {
			if($snw['nvis'] == '0') { $adtclass = ' invis'; } else { $adtclass = ''; }
			echo "
			<div class='news_line".$adtclass."'>
				<a class='islink' href='?id=noticias&ver=".$snw['nid']."'>
					<div class='title'>".$snw['ntitle']."</div>
					<div class='date'>Postada em ".date("d/m/Y \à\s H:i",$snw['ndate'])."</div>
				</a>
				<div class='aopcs'>
					<a href='?id=noticias&editar=".$snw['nid']."' class='atualstudio_button isicon'><img src='imgs/icon_editar.png' /></a>
					<a href='?id=noticias&excluir=".$snw['nid']."' class='atualstudio_button isicon'><img src='imgs/icon_X.png' /></a>
				</div>
			</div>
			";
		}
		
		echo "</div>";
	
		include("./engine/paginacao.php");
	
	} else {
		echo "<br /><br /><br /><br /><center><b>Nenhuma notícia encontrada!</b></center>";
	}
	echo "</div>";
	
	
	}



?>


<?php } ?>