<?php

$bid = !empty($_GET['bid']) ? intval($_GET['bid']) : 0;

require('private/classes/classBanners.php');

$findBanner = Banners::findBanner($bid);
if(count($findBanner) == 0){
	fim('Banner inexistente!');
}
?>

<!-- iCheck -->
<link rel="stylesheet" href="layout/plugins/iCheck/flat/blue.css">

<section class="content-header">
	<h1>
		Editar Banner
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-object-group"></i> Banners</li>
		<li class="active">Editar</li>
	</ol>
</section>

<section class="content">

	<div class="box box-primary">

		<form class='atualstudio' method='POST' action='./?engine=change&module=banners&bid=<?php echo $bid; ?>' enctype='multipart/form-data'>

			<div class="box-body">
				
				Instruções e restrições:<br />
				<ul>
					<li>Formatos permitidos: <b>JPG, JPEG e PNG</b>.</li>
					<li>É recomendável não selecionar imagens maiores que <b>4 MB</b>.</li>
					<li>Independente do tamanho da imagem, ela será redimensionada para o formato de <b><?php echo $bnWidth.'x'.$bnHeight; ?></b> pixels.</li>
					<li>Selecione o idioma e faça upload da respectiva imagem. O banner em português é obrigatório, os outros são opcionais.</li>
					<li>Caso não queira alterar os banners atuais, deixe os respectivos campos de upload vazios.</li>
				</ul>
				
				<div style='display:table;width:100%;margin: 20px 0 0 0;'>
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab">Português</a></li>
							<li><a href="#tab_2" data-toggle="tab">Inglês</a></li>
							<li><a href="#tab_3" data-toggle="tab">Espanhol</a></li>
						</ul>
						<div class="tab-content">
							
							<div class="tab-pane active" id="tab_1">
								
								<div class='form-group'>
									<div>
										<div class='desc'>Imagem</div>
										<?php echo ((strlen(trim($findBanner[0]['imgurl_pt'])) > 0 && file_exists('../'.$dir_banners.trim($findBanner[0]['imgurl_pt']))) ? "<div style='padding:10px;'><a href='../".$dir_banners.trim($findBanner[0]['imgurl_pt'])."' target='_blank'><img width='300' src='../".$dir_banners.trim($findBanner[0]['imgurl_pt'])."' /></a></div>" : ""); ?>
										<input type='file' name='img_pt' />
									</div>
								</div>
								
							</div>
							
							<div class="tab-pane" id="tab_2">
								
								<div class='form-group'>
									<div>
										<div class='desc'>Imagem (opcional)</div>
										<?php echo ((strlen(trim($findBanner[0]['imgurl_en'])) > 0 && file_exists('../'.$dir_banners.trim($findBanner[0]['imgurl_en']))) ? "<div style='padding:10px;'><a href='../".$dir_banners.trim($findBanner[0]['imgurl_en'])."' target='_blank'><img width='300' src='../".$dir_banners.trim($findBanner[0]['imgurl_en'])."' /></a></div>" : ""); ?>
										<input type='file' name='img_en' />
									</div>
								</div>
								
							</div>
							
							<div class="tab-pane" id="tab_3">
								
								<div class='form-group'>
									<div>
										<div class='desc'>Imagem (opcional)</div>
										<?php echo ((strlen(trim($findBanner[0]['imgurl_es'])) > 0 && file_exists('../'.$dir_banners.trim($findBanner[0]['imgurl_es']))) ? "<div style='padding:10px;'><a href='../".$dir_banners.trim($findBanner[0]['imgurl_es'])."' target='_blank'><img width='300' src='../".$dir_banners.trim($findBanner[0]['imgurl_es'])."' /></a></div>" : ""); ?>
										<input type='file' name='img_es' />
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
				</div>
				
				<div class='form-group'>
					<label>
						<div class='desc'>Link</div>
						<input type='text' name='link' maxlength='100' class='form-control' placeholder='(opcional)' value='<?php echo $findBanner[0]['link']; ?>' />
					</label>
				</div>
				
				<div class='form-group'>
					<b>Link Target</b>
					<div class='radchk'>
						<label>
							<input type='radio' name='target' value='1' class='flat-blue' <?php echo ($findBanner[0]['target'] == '1' ? 'checked' : '') ?> />
							Abre o link em nova aba
						</label>
						&nbsp;&nbsp;
						<label>
							<input type='radio' name='target' value='0' class='flat-blue' <?php echo ($findBanner[0]['target'] != '1' ? 'checked' : '') ?> />
							Abre na mesma aba
						</label>
					</div>
				</div>
				
				<div class='form-group'>
					<b>Exibição</b>
					<div class='radchk'>
						<label>
							<input type='radio' name='vis' value='1' class='flat-blue' <?php echo ($findBanner[0]['vis'] == '1' ? 'checked' : '') ?> />
							Visível
						</label>
						&nbsp;&nbsp;
						<label>
							<input type='radio' name='vis' value='0' class='flat-blue' <?php echo ($findBanner[0]['vis'] != '1' ? 'checked' : '') ?> />
							Oculto
						</label>
					</div>
				</div>
				
				<div class='box-footer'>
					<input type='submit' class='btn btn-primary' value='Concluir edição' />
				</div>

			</div>

		</form>

	</div>

</section>


<!-- iCheck 1.0.1 -->
<script src="layout/plugins/iCheck/icheck.min.js"></script>

<script>
	$(function () {
		
		$('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
		});
		
	});
</script>
