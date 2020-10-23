<?php if($indexing == 1) {

if(!is_numeric($_GET['excluir'])) { exit; }

$searchexcluir = mysql_query("SELECT * FROM ".DBNAME.".site_news WHERE nid = '".$_GET['excluir']."' LIMIT 1", $conexao);
if(mysql_num_rows($searchexcluir) > 0) {

if(isset($_GET['go'])) {
	
$excluirnew = mysql_query("DELETE FROM ".DBNAME.".site_news WHERE nid = '".$_GET['excluir']."'", $conexao);

if($excluirnew == 1) {
	echo "<script type='text/javascript'>document.location.href='?id=noticias&successdel=1';</script>";
} else {
	echo "<script type='text/javascript'>alert('Ops, ocorreu algum erro!');history.back();</script>";
}

} else { ?>

<h2>&raquo; Excluindo Notícia</h2>


<div class='notificacao' style='background: #c70000;font-size:16px;font-weight:bold;'>
	Você tem certeza que deseja excluir esta notícia?
	
	<div style='padding: 10px 0; display:table;width:100%;'><div style='display:table;margin: 0 auto;'>
	<input type="submit" class='atualstudio_button' value="&laquo; Não! Voltar para a lista" onclick="document.location.href='?id=noticias';" />
	<input type="submit" class='atualstudio_button' value="Sim! Excluir notícia &raquo;" onclick="document.location.href='?id=noticias&excluir=<?php echo $_GET['excluir']; ?>&go=1';" />
	</div></div>
	
</div>

<div class='newsin'>

<div style='display:table;width:100%;'>

	<div class='formpadrao centeralign' style='width:250px;float:left;'>
		<div class='desc'>Data:</div>
		<div class='camp'>
			<div style='height: 30px;line-height: 30px;'>
				<?php echo date('d/m/Y \à\s H:i', mysql_result($searchexcluir, 0, 2)); ?>
			</div>
		</div>
	</div>
	<?php $thisvis = mysql_result($searchexcluir, 0, 4); ?>
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
			<?php echo strip_tags(stripslashes(mysql_result($searchexcluir, 0, 1)), 'font'); ?>
		</div>
	</div>
</div>

<div class='formpadrao nonepadding'>
    <div style='padding: 20px;'><div style='width: 500px;overflow: hidden;'><?php echo stripslashes(mysql_result($searchexcluir, 0, 3)); ?></div></div>
</div>



</div>





<?php
}
} else { echo "Notícia não encontrada!"; }
}
?>