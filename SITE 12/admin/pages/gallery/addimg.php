<section class="content-header">
	<h1>
		Adicionar Imagem
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-image"></i> Galeria</li>
		<li class="active">Adicionar Imagem</li>
	</ol>
</section>

<section class="content">
	
	<div class="box box-primary">
		
		<form class='atualstudio' method='POST' action='./?engine=add&module=gallery' enctype='multipart/form-data'>
			
			<div class="box-body">
				
				Instruções e restrições:<br />
				<ul>
					<li>Selecione em seu computador as imagens que deseja enviar. É possível selecionar várias ao mesmo tempo!</li>
					<li>Formatos permitidos: <b>JPG, JPEG, PNG e GIF</b>.</li>
					<li>É recomendável não selecionar imagens maiores que <b>4 MB</b>.</li>
					<li>Se a imagem possuir dimensões grandes demais, ela será redimensionada para no máximo <b>1600 pixels</b> de altura e largura.</li>
				</ul>
				
				<div style='display:table; width: 100%; padding: 10px; box-sizing: border-box;'>
					<iframe scrolling="no" marginwidth="0" marginheight="0" allowtransparency="true" src="layout/plugins/jQueryFileUpload/index.php" frameborder="0" style="height:500px;width: 100%;"></iframe>
				</div>
				
			</div>
			
		</form>
		
	</div>
	
</section>
