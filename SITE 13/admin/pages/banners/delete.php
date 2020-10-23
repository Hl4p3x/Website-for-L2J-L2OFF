<?php

$bid = !empty($_GET['bid']) ? intval($_GET['bid']) : 0;

require('private/classes/classBanners.php');

$findBanner = Banners::findBanner($bid);
if(count($findBanner) == 0){
	fim('Banner inexistente!');
}
?>

<section class="content-header">
	<h1>
		Excluir Banner
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-object-group"></i> Banners</li>
		<li class="active">Excluir</li>
	</ol>
</section>

<section class="content">
	<div class="box">
		
		<div class="box-body">
				
			Você tem certeza que deseja excluir o banner abaixo?<br /><br />
			
			<table class="table table-bordered">
				<tr>
					<th style='width:180px;'>Versão Português</th>
					<th style='width:180px;'>Versão Inglês</th>
					<th style='width:180px;'>Versão Espanhol</th>
					<th>Link</th>
					<th>Target</th>
					<th>Exibição</th>
				</tr>

				<?php
				echo"
				<tr>
					<td>".((strlen(trim($findBanner[0]['imgurl_pt'])) > 0 && file_exists('../'.$dir_banners.trim($findBanner[0]['imgurl_pt']))) ? "<a href='../".$dir_banners.trim($findBanner[0]['imgurl_pt'])."' target='_blank'><img width='180' src='../".$dir_banners.trim($findBanner[0]['imgurl_pt'])."' /></a>" : "")."</td>
					<td>".((strlen(trim($findBanner[0]['imgurl_en'])) > 0 && file_exists('../'.$dir_banners.trim($findBanner[0]['imgurl_en']))) ? "<a href='../".$dir_banners.trim($findBanner[0]['imgurl_en'])."' target='_blank'><img width='180' src='../".$dir_banners.trim($findBanner[0]['imgurl_en'])."' /></a>" : "")."</td>
					<td>".((strlen(trim($findBanner[0]['imgurl_es'])) > 0 && file_exists('../'.$dir_banners.trim($findBanner[0]['imgurl_es']))) ? "<a href='../".$dir_banners.trim($findBanner[0]['imgurl_es'])."' target='_blank'><img width='180' src='../".$dir_banners.trim($findBanner[0]['imgurl_es'])."' /></a>" : "")."</td>
					<td>".$findBanner[0]['link']."</td>
					<td>".($findBanner[0]['target'] == '1' ? 'Nova aba' : 'Mesma aba')."</td>
					<td>".($findBanner[0]['vis'] == '1' ? 'Visível' : '<span style="color: red;">Oculto</span>')."</td>
				</tr>
				";
				?>
			</table>
			
			<br />

			<a class='btn btn-info' href='javascript:history.back();'>&laquo; Voltar</a>
			<a class='btn btn-danger usarJquery' href='./?engine=delete&module=banners&bid=<?php echo $bid; ?>'>Excluir permanentemente</a>

		</div>
		
	</div>
</section>



