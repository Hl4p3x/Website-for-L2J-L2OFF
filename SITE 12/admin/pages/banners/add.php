<!-- iCheck -->
<link rel="stylesheet" href="layout/plugins/iCheck/flat/blue.css">

<section class="content-header">
	<h1>
		Adicionar Banner
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-object-group"></i> Banners</li>
		<li class="active">Adicionar</li>
	</ol>
</section>

<section class="content">

	<div class="box box-primary">

		<form class='atualstudio' method='POST' action='./?engine=add&module=banners' enctype='multipart/form-data'>

			<div class="box-body">
				
				Instruções e restrições:<br />
				<ul>
					<li>Formatos permitidos: <b>JPG, JPEG e PNG</b>.</li>
					<li>É recomendável não selecionar imagens maiores que <b>4 MB</b>.</li>
					<li>Independente do tamanho da imagem, ela será redimensionada para o formato de <b><?php echo $bnWidth.'x'.$bnHeight; ?></b> pixels.</li>
					<li>Selecione o idioma e faça upload da respectiva imagem. O banner em português é obrigatório, os outros são opcionais.</li>
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
									<label>
										<div class='desc'>Imagem</div>
										<input type='file' name='img_pt' />
									</label>
								</div>
								
							</div>
							
							<div class="tab-pane" id="tab_2">
								
								<div class='form-group'>
									<label>
										<div class='desc'>Imagem (opcional)</div>
										<input type='file' name='img_en' />
									</label>
								</div>
								
							</div>
							
							<div class="tab-pane" id="tab_3">
								
								<div class='form-group'>
									<label>
										<div class='desc'>Imagem (opcional)</div>
										<input type='file' name='img_es' />
									</label>
								</div>
								
							</div>
							
						</div>
					</div>
				</div>
				
				<div class='form-group'>
					<label>
						<div class='desc'>Link</div>
						<input type='text' name='link' maxlength='100' class='form-control' placeholder='(opcional)' />
					</label>
				</div>
				
				<div class='form-group'>
					<b>Link Target</b>
					<div class='radchk'>
						<label>
							<input type='radio' name='target' value='1' class='flat-blue' checked />
							Abre o link em nova aba
						</label>
						&nbsp;&nbsp;
						<label>
							<input type='radio' name='target' value='0' class='flat-blue' />
							Abre na mesma aba
						</label>
					</div>
				</div>
				
				<div class='form-group'>
					<b>Exibição</b>
					<div class='radchk'>
						<label>
							<input type='radio' name='vis' value='1' class='flat-blue' checked />
							Visível
						</label>
						&nbsp;&nbsp;
						<label>
							<input type='radio' name='vis' value='0' class='flat-blue' />
							Oculto
						</label>
					</div>
				</div>
				
				<div class='box-footer'>
					<input type='submit' class='btn btn-primary' value='Adicionar' />
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
