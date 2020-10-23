<!-- iCheck -->
<link rel="stylesheet" href="layout/plugins/iCheck/flat/blue.css">

<section class="content-header">
	<h1>
		Adicionar Notícia
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-newspaper-o"></i> Notícias</li>
		<li class="active">Adicionar</li>
	</ol>
</section>

<section class="content">

	<div class="box box-primary">

		<form class='atualstudio' method='POST' action='./?engine=add&module=news' enctype='multipart/form-data'>

			<div class="box-body">
				
				<div style='display:table;width:100%;'>
					<div style='float:left;width:50%;box-sizing: border-box; padding: 0 20px 0 0;'>
						<div class='form-group'>
							<label>
								<div class='desc'>Data</div>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input name="post_date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask type="text" value="<?php echo date('d/m/Y'); ?>">
								</div>
							</label>
						</div>
					</div>
					<div style='float:left;width:50%;'>
						<div class='form-group'>
							<label>
								<div class='desc'>Hora</div>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
									<input name="post_hour" class="form-control" data-inputmask="'mask': '99:99'" data-mask type="text" value="<?php echo date('H:i'); ?>">
								</div>
							</label>
						</div>
					</div>
				</div>
					
				<div class='form-group'>
					<b>Visibilidade</b>
					<div class='radchk'>
						<label>
							<input type='radio' name='vis' value='1' class='flat-blue' checked />
							Visível
						</label>
						&nbsp;&nbsp;
						<label>
							<input type='radio' name='vis' value='0' class='flat-blue' />
							Oculta
						</label>
					</div>
				</div>
				
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
										<div class='desc'>Título</div>
										<input type='text' name='title_pt' maxlength='100' class='form-control' />
									</label>
								</div>
								
								<div class='form-group'>
									<label>
										<div class='desc'>Conteúdo</div>
										<textarea class='ckeditor' name="content_pt" style="width:100%"></textarea>
									</label>
								</div>
								
							</div>
							
							<div class="tab-pane" id="tab_2">
								
								<div class='form-group'>
									<label>
										<div class='desc'>Título</div>
										<input type='text' name='title_en' maxlength='100' class='form-control' />
									</label>
								</div>
								
								<div class='form-group'>
									<label>
										<div class='desc'>Conteúdo</div>
										<textarea class='ckeditor' name="content_en" style="width:100%"></textarea>
									</label>
								</div>
								
							</div>
							
							<div class="tab-pane" id="tab_3">
								
								<div class='form-group'>
									<label>
										<div class='desc'>Título</div>
										<input type='text' name='title_es' maxlength='100' class='form-control' />
									</label>
								</div>
								
								<div class='form-group'>
									<label>
										<div class='desc'>Conteúdo</div>
										<textarea class='ckeditor' name="content_es" style="width:100%"></textarea>
									</label>
								</div>
								
							</div>
							
						</div>
					</div>
				</div>
				
				<div class='form-group'>
					<label>
						<div class='desc'>Imagem (opcional)</div>
						<input type='file' name='img' />
					</label>
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

<!-- Inputmask -->
<script src="layout/plugins/input-mask/jquery.inputmask.js"></script>
<script src="layout/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="layout/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- Inputmask -->
<script src="layout/plugins/ckeditor/ckeditor.js"></script>
<script src="layout/plugins/ckeditor/config.js"></script>

<script>
	$(function () {
		
		$("[data-mask]").inputmask();
		
		$('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
		});
		
	});
</script>
