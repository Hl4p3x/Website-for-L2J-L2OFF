<?php if($indexing == 1) { ?>

<h2>&raquo; Inserir Banner</h2>

Selecione a imagem em seu computador para fazer upload e enviá-lo ao site.<br />
<br />
<ul>
	<li>Formatos permitidos: <b>JPG, JPEG, PNG e GIF</b>.</li>
	<li>É recomendável não selecionar imagens maiores que <b>1 MB</b>, pois são grandes, demoradas para carregar.</li>
	<li>É necessário utilizar o formato de <b>428x174 pixels</b>. Caso contrário, a imagem será redimensionada.</li>
</ul>

<br /><br />

<form method='POST' action='?id=banners&send' enctype='multipart/form-data'>
	
	<div class='grayCabecalho'>Banner Obrigatório (Português):</div>
	<div class='formpadrao'>
		<div class='desc'>Imagem:</div>
		<div class='camp'>
			<div style='display:table; padding: 3px 0;'><input type='file' name='imgupd' style='padding: 2px;width: 420px;' /></div>
		</div>
	</div>
	
	<div class='grayCabecalho'>Banner em Inglês: <span>(deixe em branco para usar o mesmo do obrigatório)</span></div>
	<div class='formpadrao'>
		<div class='desc'>Imagem:</div>
		<div class='camp'>
			<div style='display:table; padding: 3px 0;'><input type='file' name='imgupd_en' style='padding: 2px;width: 420px;' /></div>
		</div>
	</div>
	
	<div class='grayCabecalho'>Banner em Espanhol: <span>(deixe em branco para usar o mesmo do obrigatório)</span></div>
	<div class='formpadrao'>
		<div class='desc'>Imagem:</div>
		<div class='camp'>
			<div style='display:table; padding: 3px 0;'><input type='file' name='imgupd_es' style='padding: 2px;width: 420px;' /></div>
		</div>
	</div>
	
	<div class='formpadrao'>
		<div class='desc'>Link:</div>
		<div class='camp'>
			<input type='text' maxlength='255' name='bannerlink' style='width:435px;' />
			<div style='padding: 10px 0 0 0;'>
				<label><input type='checkbox' name='linktarget' value='1' /> Abrir em nova aba</label>
			</div>
		</div>
	</div>
	
	<div style='padding: 20px 0; display:table;width:100%;'><div style='display:table;margin: 0 28px 0 0; float: right;'>
	<input type="submit" class='atualstudio_button' value="Inserir &raquo;" />
	</div></div>
</form>

<?php }