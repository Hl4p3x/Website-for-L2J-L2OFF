<?php if($indexing == 1) {

if(!is_numeric($_GET['delete'])) { exit; }

$searchexcluir = mysql_query("SELECT * FROM ".DBNAME.".site_banners WHERE b_bid = '".$_GET['delete']."' LIMIT 1", $conexao);
if(mysql_num_rows($searchexcluir) > 0) {

if(isset($_GET['go'])) {

if(strlen(mysql_result($searchexcluir, 0, 1)) > 0) {
	if(file_exists('../'.DIRBAN.mysql_result($searchexcluir, 0, 1))) {
		$unlink = unlink('../'.DIRBAN.mysql_result($searchexcluir, 0, 1));
	} else { $unlink=1; }
} else { $unlink=1; }

if(strlen(mysql_result($searchexcluir, 0, 5)) > 0) {
	if(file_exists('../'.DIRBAN.mysql_result($searchexcluir, 0, 5))) {
		if(!unlink('../'.DIRBAN.mysql_result($searchexcluir, 0, 5))) {
			echo "<script type='text/javascript'>alert('O processo irá continuar, mas houve um erro ao excluir a imagem do banner em inglês!');</script>";
		}
	}
}

if(strlen(mysql_result($searchexcluir, 0, 6)) > 0) {
	if(file_exists('../'.DIRBAN.mysql_result($searchexcluir, 0, 6))) {
		if(!unlink('../'.DIRBAN.mysql_result($searchexcluir, 0, 6))) {
			echo "<script type='text/javascript'>alert('O processo irá continuar, mas houve um erro ao excluir a imagem do banner em espanhol!');</script>";
		}
	}
}

if($unlink == 1) {
	$excluirnew = mysql_query("DELETE FROM ".DBNAME.".site_banners WHERE b_bid = '".$_GET['delete']."'", $conexao);
	
	if($excluirnew == 1) {
		echo "<script type='text/javascript'>document.location.href='?id=banners&success=1';</script>";
	} else {
		echo "<script type='text/javascript'>alert('Ops, ocorreu algum erro!');history.back();</script>";
	}
} else {
	echo "<script type='text/javascript'>alert('Ops, ocorreu um erro ao tentar excluir o banner!');history.back();</script>";
}

} else { ?>

<h2>&raquo; Excluindo</h2>

<div class="notificacao" style="background: #c70000;font-size:16px;font-weight:bold;">
	Você tem certeza que deseja excluir este banner?
	
	<div style="padding: 10px 0; display:table;width:100%;"><div style="display:table;margin: 0 auto;">
	<input class="atualstudio_button" value="&laquo; Não! Voltar" onclick="document.location.href='?id=banners';" type="submit">
	<input class="atualstudio_button" value="Sim! Excluir &raquo;" onclick="document.location.href='?id=banners&delete=<?php echo $_GET['delete']; ?>&go=1';" type="submit">
	</div></div>
	
</div>

<div class='pre_c_excl'>
	<img src='../<?php echo DIRBAN.mysql_result($searchexcluir, 0, 1); ?>' width='428' height='174' />
</div>

</div>





<?php
}
}
}
?>
