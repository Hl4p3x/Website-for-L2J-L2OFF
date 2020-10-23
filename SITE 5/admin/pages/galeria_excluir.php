<?php if($indexing == 1) {

if(!is_numeric($_GET['delete'])) { exit; }

$searchexcluir = mysql_query("SELECT * FROM ".DBNAME.".site_galeria WHERE g_gid = '".$_GET['delete']."' LIMIT 1", $conexao);
if(mysql_num_rows($searchexcluir) > 0) {

if(isset($_GET['go'])) {

if(file_exists('../'.DIRGAL.mysql_result($searchexcluir, 0, 1))) {
	if(mysql_result($searchexcluir, 0, 3) != '1') {
		$unlink = unlink('../'.DIRGAL.mysql_result($searchexcluir, 0, 1));
		unlink('../'.DIRGAL.'thumbnail/'.mysql_result($searchexcluir, 0, 1));
	} else { $unlink=1; }
} else { $unlink=1; }

if($unlink == 1) {
	
	$excluirnew = mysql_query("DELETE FROM ".DBNAME.".site_galeria WHERE g_gid = '".$_GET['delete']."'", $conexao);
	
	if($excluirnew == 1) {
		echo "<script type='text/javascript'>document.location.href='?id=galeria&success=1';</script>";
	} else {
		echo "<script type='text/javascript'>alert('Ops, ocorreu algum erro!');history.back();</script>";
	}
	
} else {
	echo "<script type='text/javascript'>alert('Ops, ocorreu um erro ao tentar excluir a imagem!');history.back();</script>";
}

} else { ?>

<h2>&raquo; Excluindo</h2>

<div class="notificacao" style="background: #c70000;font-size:16px;font-weight:bold;">
	Você tem certeza que deseja excluir <?php if(mysql_result($searchexcluir, 0, 3) != '1') { echo "esta imagem?"; } else { echo "este vídeo?"; } ?>
	
	<div style="padding: 10px 0; display:table;width:100%;"><div style="display:table;margin: 0 auto;">
	<input class="atualstudio_button" value="« Não! Voltar para galeria" onclick="document.location.href='?id=galeria';" type="submit">
	<input class="atualstudio_button" value="Sim! Excluir »" onclick="document.location.href='?id=galeria&delete=<?php echo $_GET['delete']; ?>&go=1';" type="submit">
	</div></div>
	
</div>

<div class='pre_c_excl'>
	<?php if(mysql_result($searchexcluir, 0, 3) != '1') {
		echo "<img src='../".DIRGAL.mysql_result($searchexcluir, 0, 1)."' class='' />";
	} else {
		echo "<iframe width=\"540\" height=\"304\" src=\"http://www.youtube.com/embed/".mysql_result($searchexcluir, 0, 1)."\" frameborder=\"0\" allowfullscreen></iframe>";
	} ?>
</div>

</div>





<?php
}
} else { echo "Dados inválidos!"; }
}
?>
