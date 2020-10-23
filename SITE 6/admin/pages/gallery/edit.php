<?php

$gid = !empty($_GET['gid']) ? intval($_GET['gid']) : 0;

require('private/classes/classGallery.php');

$findGallery = Gallery::findGallery($gid);
if(count($findGallery) == 0){
	fim('Item inexistente na galeria!');
}
?>

<!-- iCheck -->
<link rel="stylesheet" href="layout/plugins/iCheck/flat/blue.css">

<section class="content-header">
	<h1>
		Editar <?php echo ($findGallery[0]['isvideo'] == '1' ? 'Vídeo' : 'Imagem'); ?>
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-image"></i> Galeria</li>
		<li class="active">Editar <?php echo ($findGallery[0]['isvideo'] == '1' ? 'Vídeo' : 'Imagem'); ?></li>
	</ol>
</section>

<section class="content">

	<div class="box box-primary">

		<form class='atualstudio usarJquery' method='POST' action='./?engine=change&module=gallery&gid=<?php echo $gid; ?>'>

			<div class="box-body">
				
				<div style='padding: 10px;'>
					<?php if($findGallery[0]['isvideo'] != '1') { ?>
						<a href='<?php echo '../'.$dir_gallery.trim($findGallery[0]['url']); ?>' target='_blank'><img style='max-width:400px;' src='<?php echo '../'.$dir_gallery.trim($findGallery[0]['url']); ?>' /></a>
					<?php } else { ?>
						<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $findGallery[0]['url']; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
					<?php } ?>
				</div>
				
				<div class='form-group'>
					<b>Visibilidade</b>
					<div class='radchk'>
						<label>
							<input type='radio' name='vis' value='1' class='flat-blue' <?php if($findGallery[0]['vis'] == '1') { echo "checked"; } ?> />
							Visível
						</label>
						&nbsp;&nbsp;
						<label>
							<input type='radio' name='vis' value='0' class='flat-blue' <?php if($findGallery[0]['vis'] != '1') { echo "checked"; } ?> />
							Oculta
						</label>
					</div>
				</div>

				<div class='box-footer'>
					<input type='submit' class='btn btn-primary' value='Concluir edição' />
					<div style='float:right;'>
						<a href='javascript:history.back();' class='btn btn-default'>&laquo; Voltar</a>
						<a href='?page=delete&module=gallery&gid=<?php echo $gid; ?>' title='Excluir' class='btn btn-danger'>Excluir</a>
					</div>
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
