<?php if($indexing == 1) { ?>


O que voc� deseja inserir?
<br /><br />
<h2>&raquo; Inserir Imagem(ns)</h2>

Selecione a(s) imagem(ns) no seu computador para fazer upload e enviar para a galeria. � poss�vel selecionar v�rias ao mesmo tempo!<br />
<br />
<ul>
	<li>Formatos permitidos: <b>JPG, JPEG, PNG e GIF</b>.</li>
	<li>� recomend�vel n�o selecionar imagens maiores que <b>2 MB</b>, pois s�o grandes, demoradas para carregar.</li>
</ul>

<br />

<!--
<label class='formpadrao'>
	<div class='camp'>
		
		<div id="swfupload-control">
		<table border='0' cellpadding='0' cellspacing='0' style='width: auto;'><tr class='inputs'><td><input type="button" id="button" /></td></tr></table>
		<div class='uploadlog'>
			<ol id="log"></ol>
		</div>
		</div>
		
	</div>
</label> -->

<iframe width="520" scrolling="auto" height="500" frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" src="engine/up/index.html" style='border:10px solid #dbdbdb;'></iframe>

<br /><br /><br /><br />
<h2>&raquo; Inserir V�deo do YouTube</h2>

<form method='POST' action='?id=galeria&send'>
Copie a URL(link) do v�deo e cole abaixo. <b>Obs: S� � permitido v�deos do YouTube!</b>
<br /><br />
<label class='formpadrao'>
	<div class='desc'>Link:</div>
	<div class='camp'><input type='text' maxlength='255' name='glink' style='width:435px;' /></div>
</label>
<div style='padding: 20px 0; display:table;width:100%;'><div style='display:table;margin: 0 28px 0 0; float: right;'>
<input type="submit" class='atualstudio_button' value="Inserir &raquo;" />
</div></div>
</form>

<?php } ?>