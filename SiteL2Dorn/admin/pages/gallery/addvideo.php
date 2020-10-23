<!-- iCheck -->
<link rel="stylesheet" href="layout/plugins/iCheck/flat/blue.css">

<section class="content-header">
	<h1>
		Adicionar Vídeo
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-image"></i> Galeria</li>
		<li class="active">Adicionar Vídeo</li>
	</ol>
</section>

<section class="content">

	<div class="box box-primary">

		<form class='atualstudio' method='POST' action='./?engine=addvideo&module=gallery'>

			<div class="box-body">
				
				Nosso sistema é integrado ao <a href='http://youtube.com' target='_blank'>YouTube</a>. Basta informar o link ou ID do vídeo hospedado no site do YouTube que faremos a vinculação!<br /><br />
				
				<div class='form-group'>
					<label>
						<div class='desc'>Link YouTube</div>
						<input type='text' name='link' maxlength='100' class='form-control' placeholder='Insira aqui o link ou ID do vídeo' />
					</label>
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
