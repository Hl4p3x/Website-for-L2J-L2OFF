<?php if($indexing == 1) {

if(!is_numeric($_GET['ver'])) { exit; }

$searchver = mysql_query("SELECT * FROM ".DBNAME.".site_news WHERE nid = '".$_GET['ver']."' LIMIT 1", $conexao);
if(mysql_num_rows($searchver) > 0) {
	
	$atualimg = mysql_result($searchver, 0, 9);
?>

<h2>&raquo; Visualizando Notícia</h2>

<div class='newsin'>

<div style='display:table;width:100%;'>

	<div class='formpadrao centeralign' style='width:250px;float:left;'>
		<div class='desc'>Data:</div>
		<div class='camp'>
			<div style='height: 30px;line-height: 30px;'>
				<?php echo date('d/m/Y \à\s H:i', mysql_result($searchver, 0, 2)); ?>
			</div>
		</div>
	</div>
	<?php $thisvis = mysql_result($searchver, 0, 4); ?>
	<div class='formpadrao centeralign' style='width:248px;float:left;margin: 0 0 0 2px;'>
			<div class='desc'>Visibilidade:</div>
			<div class='camp'>
				<div style='height: 30px;line-height: 30px;'>
				<?php if($thisvis == '1') { ?>
				Visível
			<?php } else { ?>
				Oculta
			<?php } ?>
			</div>
		</div>
	</div>

</div>

<div class='formpadrao'>
	<div class='desc'>Título:</div>
	<div class='camp'>
		<div style='padding: 7px 10px 7px 0;width: 450px;'>
			<?php echo strip_tags(stripslashes(mysql_result($searchver, 0, 1)), 'font'); ?>
		</div>
	</div>
</div>

<br />
<div class='grayCabecalho'>Versão Obrigatória (Português):</span></div>
<div class='formpadrao nonepadding'>
    <div style='padding: 20px;'><div style='width: 500px;overflow: hidden;'><?php echo stripslashes(mysql_result($searchver, 0, 3)); ?></div></div>
</div>

<br />
<div class='grayCabecalho'>Versão Inglês:</span></div>
<div class='formpadrao nonepadding'>
    <div style='padding: 20px;'><div style='width: 500px;overflow: hidden;'><?php echo stripslashes(mysql_result($searchver, 0, 7)); ?></div></div>
</div>

<br />
<div class='grayCabecalho'>Versão Espanhol:</span></div>
<div class='formpadrao nonepadding'>
    <div style='padding: 20px;'><div style='width: 500px;overflow: hidden;'><?php echo stripslashes(mysql_result($searchver, 0, 8)); ?></div></div>
</div>

<br />
<div class='grayCabecalho'>Imagem:</span></div>
<div class='formpadrao nonepadding'>
    <div style='padding: 20px;'><img src='<?php echo (empty($atualimg) ? '../imgs/no-img-new.jpg' : '../'.DIRNEW.$atualimg); ?>' width='98' height='98' /></div>
</div>




</div>





<?php

} else { echo "Notícia não encontrada!"; }
}
?>