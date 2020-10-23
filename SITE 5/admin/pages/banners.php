<?php if($indexing == 1) { ?>

<h1>Banners</h1>

<?php
if(isset($_GET['inserir'])) {
	echo "<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=banners' class='atualstudio_button'>&laquo; Voltar</a></div>";
	require('pages/banners_inserir.php');
} elseif(isset($_GET['send'])) {
	require('pages/banners_send.php');
	exit;
} elseif(isset($_GET['delete'])) {
	echo "<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=banners' class='atualstudio_button'>&laquo; Voltar</a></div>";
	require('pages/banners_excluir.php');
} elseif(isset($_GET['altlink'])) {
	echo "<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=banners' class='atualstudio_button'>&laquo; Voltar</a></div>";
	require('pages/banners_altlink.php');
} elseif(isset($_GET['altlinksend'])) {
	require('pages/banners_altlinksend.php');
	exit;
} else {
?>

<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=banners&inserir' class='atualstudio_button'>Inserir novo banner &raquo;</a></div>

<?php

if(isset($_GET['success'])) { echo "<div class='notificacao'>Operação realizada com sucesso!</div>"; }

?>

Abaixo são exibidos os banners já existentes no site.<br /><br />
<ul>
	<li>Para <b>alterar link</b> ou <b>excluir</b>, passe o mouse no banner e clique na respectiva opção.</li>
	<li>Para <b>alterar a ordem</b>, basta mover(puxar) os banners para a ordem desejada.</li>
</ul>
<br /><br />


<div>
<ul id='banners'>
<?php
$searchbanners = mysql_query("SELECT * FROM ".DBNAME.".site_banners ORDER BY b_position ASC", $conexao);
if(mysql_num_rows($searchbanners) > 0) {
$i=1;
while($bdados=mysql_fetch_array($searchbanners)) {
	
	echo "
	<li id=\"recordsArray_".$bdados['b_bid']."\">
		<div>
			<span>".$i."</span>
			<img src='../".DIRBAN.$bdados['b_id']."' width='428' height='174' />
			<div class='opts'>
				<a href='?id=banners&altlink=".$bdados['b_bid']."'>Alterar Link</a>
				&nbsp;
				<a href='?id=banners&delete=".$bdados['b_bid']."'>Excluir</a>
			</div>
		</div>
	</li>
	";
	
	$i++;
}
} else { echo "<br><br><br><center><b>Nenhum banner cadastrado.</b></center><br><br><br>"; }
?>

</ul>
</div>

<?php } } ?>