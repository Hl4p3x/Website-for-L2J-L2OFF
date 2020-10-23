<?php if($indexing == 1) { ?>

<h1>Galeria</h1>

<?php
if(isset($_GET['inserir'])) {
	echo "<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=galeria' class='atualstudio_button'>&laquo; Voltar</a></div>";
	require('pages/galeria_inserir.php');
} elseif(isset($_GET['send'])) {
	require('pages/galeria_send.php');
	exit;
} elseif(isset($_GET['delete'])) {
	echo "<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=galeria' class='atualstudio_button'>&laquo; Voltar</a></div>";
	require('pages/galeria_excluir.php');
} else {
?>

<div style='position: absolute; top: 20px; right: 70px;'><a href='?id=galeria&inserir' class='atualstudio_button'>Inserir imagem ou vídeo &raquo;</a></div>

<?php

if(isset($_GET['success'])) { echo "<div class='notificacao'>Operação realizada com sucesso!</div>"; }

?>

Abaixo são exibidas as imagens e vídeos existentes na galeria.<br /><br />
<ul>
	<li>Para <b>visualizar</b> ou <b>excluir</b>, passe o mouse sob o item e clique na respectiva opção.</li>
	<li>Para <b>alterar a ordem</b>, basta mover(puxar) os itens para a ordem desejada.</li>
</ul>
<br />

<br />

<div class='faltaprv' style='display:none;'>
	Existem <b>0</b> itens enviados pelos usuários aguardando aprovação. Eles estão sendo destacados por uma tarja vermelha!
</div>

<div id="gallery">
<ul id='galeria' class='gaadmin'>

<?php
$aprovcount=0;
$searchgallery = mysql_query("SELECT * FROM ".DBNAME.".site_galeria ORDER BY g_position ASC", $conexao);
if(mysql_num_rows($searchgallery) > 0) {
while($gdados=mysql_fetch_array($searchgallery)) {
	
	if($gdados['g_visivel'] == 0) { $aprovcount+=1; }
	
	if($gdados['g_isvideo'] != '1') {
		echo "
		<li id=\"recordsArray_".$gdados['g_gid']."\">
			<div class='opts'>
				<a target='blank' href='../".DIRGAL.$gdados['g_id']."'>Visualizar</a>
				&nbsp;&nbsp;&nbsp;
				<a href='?id=galeria&delete=".$gdados['g_gid']."'>Excluir</a>
			</div>
			<div class='img' style='background-image: url(../".DIRGAL."thumbnail/".$gdados['g_id'].");'></div>
			".($gdados['g_visivel'] == 1 ? '' : '<div class="nproved" data-gid="'.$gdados['g_gid'].'"></div><div class="aproveOpt" data-gid="'.$gdados['g_gid'].'">Aprovar</div>')."
		</li>";
	} else {
		echo "
		<li id=\"recordsArray_".$gdados['g_gid']."\">
			<div class='opts'>
				<a target='blank' href='http://www.youtube.com/watch?v=".$gdados['g_id']."'>Visualizar</a>
				&nbsp;&nbsp;&nbsp;
				<a href='?id=galeria&delete=".$gdados['g_gid']."'>Excluir</a>
			</div>
			<div class='img video'>
				<div class='play'></div>
				<img src='http://i1.ytimg.com/vi/".$gdados['g_id']."/mqdefault.jpg' />
			</div>
			".($gdados['g_visivel'] == 1 ? '' : '<div class="nproved" data-gid="'.$gdados['g_gid'].'"></div><div class="aproveOpt" data-gid="'.$gdados['g_gid'].'">Aprovar</div>')."
		</li>";
	}
	
}

if($aprovcount > 0) { echo "<script>$(document).ready(function(){ $('.faltaprv b, .aGallery span').text('".$aprovcount."'); $('.faltaprv, .aGallery span').show(); });</script>"; }

} else { echo "<br><br><br><center><b>Nenhuma imagem na galeria.</b></center><br><br><br>"; }
?>

</ul></div>

<script>
	$(document).ready(function(){

		$('.aproveOpt').click(function(e){
			
			var gid = $(this).attr('data-gid');
			
			var thisA = $(this);
			
			if($(thisA).text() != 'Aguarde...') {
				
				$(thisA).text('Aguarde...');
				
				$.ajax({
					type: 'POST',
					url: './?id=galeria_aprovar&nolayout=1',
					cache: false,
					data: { gid: gid },
					dataType: 'json',
					timeout: 300000,
					async: false,
					success: function(data)
					{
						if(data.act == 'OK') {
							$(thisA).remove(); $('.nproved[data-gid="'+gid+'"]').remove();
							var newNum = parseInt($('.aGallery span').text() - 1);
							$('.faltaprv b, .aGallery span').text(''+newNum+'');
							if(newNum == '0') { $('.faltaprv, .aGallery span').hide(); }
						} else {
							alert(data.msg);
							$(thisA).text('Aprovar');
						}
					},
				    error: function(jqXHR, textStatus){
				    	if(textStatus == 'timeout') {
					        alert('Por favor, verifique sua conexão com a internet.\nA página está demorando demais para responder.');
				    	} else if(textStatus != 'abort') {
					        alert('Desculpe, ocorreu algum erro!\nPor favor, tente novamente.');
					    }
					    document.location.reload(false);
				    }
				});
			}
		});
		
	});
</script>


<?php } } ?>