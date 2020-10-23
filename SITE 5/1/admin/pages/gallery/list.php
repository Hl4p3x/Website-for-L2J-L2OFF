<section class="content-header">
	<h1>
		Gallery
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-image"></i> Galeria</li>
		<li class="active">Visualizar</li>
	</ol>
</section>

<section class="content">

	<div class='box-footer'>
		<a href='?page=addimg&module=gallery' class='btn btn-primary'>Adicionar Imagem</a> &nbsp;
		<a href='?page=addvideo&module=gallery' class='btn btn-primary'>Adicionar Vídeo</a>
	</div>
	
	<div class="box">

		<!-- Resultados -->
		<div class="box-body">
			
			<style type='text/css'>
				.gallery { width: 100%; font-size: 0px; padding: 0; margin: 0; }
				.gallery > div { position: relative; font-size: 14px; width: 150px; height: 214px; padding: 10px; display: inline-block; transition: border-color 0.4s; background: #fff; border: 1px solid #f4f4f4; margin: 0 5px 5px 0; }
				.gallery > div:hover { border: 1px solid #cacaca; }
				.gallery > div > * { display: table; margin: 0 auto; }
				.gallery > div .sortHandle { cursor: move; width: 30px; height: 30px; line-height: 30px; text-align: center; transition: background-color 0.4s; background: rgba(0,0,0,0.2); color: #fff; border-radius: 15px; position: absolute; left: 5px; top: 5px; }
				.gallery > div:hover .sortHandle { background: rgba(0,0,0,0.6); }
				.gallery > div .vis { text-align: center; width: 124px; padding: 3px 0; font-size: 12px; background: rgba(0,0,0,0.1); box-sizing: border-box; margin: 4px auto; }
				.gallery > div img { width: 124px; height: 124px; }
				.gallery > div a.usarJquery { width: 40px !important; height: 34px !important; overflow: hidden; }
				.gallery > div .play { width: 100%; text-align: center; position: absolute; top: 22px; left: 0; font-size: 70px; color: rgba(255,255,255,0.6); transition: color 0.4s; }
				.gallery > div:hover .play { color: rgba(255,255,255,1); }
			</style>
			
			<div class='gallery item-list ui-sortable'>
				
				<?php
				
				require('private/classes/classGallery.php');
				
				$consulta = Gallery::listGallery();

				if(count($consulta) > 0) {
					
					for($i=0, $c=count($consulta); $i < $c; $i++) {
						
						$imgName = trim($consulta[$i]['url']).($consulta[$i]['isvideo'] == '1' ? '.jpg' : '');
						echo"
						<div id='item_".$consulta[$i]['gid']."'>
							<div>".(file_exists('../'.$dir_gallery.'thumbnail/'.$imgName) ? "<a href='".($consulta[$i]['isvideo'] != '1' ? "../".$dir_gallery.$imgName : "//www.youtube.com/watch?v=".$consulta[$i]['url']."&rel=0")."' target='_blank'><img width='124' height='124' src='../".$dir_gallery.'thumbnail/'.$imgName."' />".($consulta[$i]['isvideo'] == '1' ? "<div class='play'><i class='fa fa-play-circle-o'></i></div>" : "")."</a>" : "")."</div>
							<div class='vis'>".($consulta[$i]['vis'] == '1' ? 'Visível' : ($consulta[$i]['vis'] == '2' ? '<span style="color: #4ac600;">Pendente</span>' : '<span style="color: red;">Oculto</span>'))."</div>
							<div>
								<a href='?page=edit&module=gallery&gid=".$consulta[$i]['gid']."' title='Editar' class='btn btn-default'><i class='fa fa-edit'></i></a>
								";
								if($consulta[$i]['vis'] == '1') {
									echo "<a href='?engine=change&module=gallery&gid=".$consulta[$i]['gid']."&vis=0' title='Tornar oculto' class='btn btn-default usarJquery'><i class='fa fa-eye-slash'></i></a>";
								} else {
									echo "<a href='?engine=change&module=gallery&gid=".$consulta[$i]['gid']."&vis=1' title='Tornar visível' class='btn btn-success usarJquery'><i class='fa fa-eye'></i></a>";
								}
								echo "
								<a href='?page=delete&module=gallery&gid=".$consulta[$i]['gid']."' title='Excluir' class='btn btn-danger'><i class='fa fa-remove'></i></a>
							</div>
							<div class='sortHandle handle'><span class='ui-sortable-handle'><i class='fa fa-ellipsis-v'></i> <i class='fa fa-ellipsis-v'></i></span></div>
						</div>
						";
						
					}
					
				}
				?>
				
			</div>
			
			<?php
			if(count($consulta) == 0) {
				echo 'Nenhum item na galeria!';
			}
			?>

		</div>

	</div>

	<div class='box-footer'>
		<a href='?page=addimg&module=gallery' class='btn btn-primary'>Adicionar Imagem</a> &nbsp;
		<a href='?page=addvideo&module=gallery' class='btn btn-primary'>Adicionar Vídeo</a>
	</div>
	
</section>

<script>
$(function() {
	$(".gallery").sortable({
		placeholder: "sort-highlight",
		handle: ".handle",
		forcePlaceholderSize: true,
		zIndex: 999999,
		update: function() {
			var order = $(this).sortable("serialize");
			$.ajax({
				type: 'POST',
				url: './?engine=reorder&module=gallery',
				cache: false,
				data: $(this).sortable("serialize")+'&isJS=1',
				dataType: 'json',
				timeout: 5000,
				async: false,
				success: function(data)
				{
					
					if(data.act != 'OK') {
						atualAlert(data.msg, data.act, data.url);
					}
					
				},
			    error: function(jqXHR, textStatus){
			    	if(textStatus == 'timeout') {
				        atualAlert('Por favor, verifique sua conexão com a internet. A página está demorando demais para responder.');
			    	} else if(textStatus != 'abort') {
				        atualAlert('Desculpe, ocorreu algum erro! Por favor, tente novamente. #2');
				    }
			    }
			});
			
		}
	});
});
</script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
