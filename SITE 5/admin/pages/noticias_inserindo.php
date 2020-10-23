<?php if($indexing == 1) {

	if(isset($_GET['go'])) {


		$f_data = isset($_POST['ndata']) ? vCode($_POST['ndata']) : '';
		$f_t = isset($_POST['ntitle']) ? vCode($_POST['ntitle']) : '';
		$f_t_EN = isset($_POST['ntitle_en']) ? vCode($_POST['ntitle_en']) : '';
		$f_t_ES = isset($_POST['ntitle_es']) ? vCode($_POST['ntitle_es']) : '';
		$f_c = isset($_POST['nconteudo']) ? addslashes(trim($_POST['nconteudo'])) : '';
		$f_c_EN = isset($_POST['nconteudo_en']) ? addslashes(trim($_POST['nconteudo_en'])) : '';
		$f_c_ES = isset($_POST['nconteudo_es']) ? addslashes(trim($_POST['nconteudo_es'])) : '';
		$f_vis = isset($_POST['nvis']) ? vCode($_POST['nvis']) : '';
		$f_hora = isset($_POST['nhr']) ? vCode($_POST['nhr']) : '';
		
		if( empty($f_data) || empty($f_hora) || empty($f_t) || empty($f_c) ) { echo "<script type='text/javascript'>alert('Preencha todos os campos do formulário!');history.back();</script>"; exit; }


		if(strlen($f_data) != 10) { echo "<script type='text/javascript'>alert('Data inválida! Insira no formato: dd/mm/yyyy');history.back();</script>"; exit; }
		if(strlen($f_hora) != 5) { echo "<script type='text/javascript'>alert('Hora inválida! Insira no formato: hh:mm');history.back();</script>"; exit; }

		$f_data = explode('/', $f_data);
		$f_hora = explode(':', $f_hora);

		$f_dia = $f_data[0];
		$f_mes = $f_data[1];
		$f_ano = $f_data[2];

		$f_hr = $f_hora[0];
		$f_min = $f_hora[1];

		if($f_vis != '1') { $f_vis = '0'; }

		if(strlen($f_t) > 150 || strlen($f_t_EN) > 150 || strlen($f_t_ES) > 150) { echo "<script type='text/javascript'>alert('Você ultrapassou o limite de caracteres permitidos no título da notícia!');history.back();</script>"; exit; }

		if((!is_numeric($f_min))||(!is_numeric($f_hr))||(!is_numeric($f_mes))||(!is_numeric($f_ano))||(!is_numeric($f_dia))) { echo "<script type='text/javascript'>alert('Ops, algo está errado!');history.back();</script>"; exit; }

		$date = mktime($f_hr, $f_min, '0', $f_mes, $f_dia, $f_ano);
		
		
		
		
		$arquivo = '';
		if(strlen($_FILES['imgupd']['name']) != 0) {
			
			$extensao = substr($_FILES['imgupd']['name'], -4);
			if(substr($extensao, 0, 1) != '.') { $extensao = '.'.$extensao; }
			$extensao = strtolower($extensao);
			
			if(($extensao != '.jpg')&&($extensao != '.jpeg')&&($extensao != '.gif')&&($extensao != '.png')) {
				echo "<script type='text/javascript'>alert('O procedimento irá continuar, mas a imagem não foi enviada!\nA imagem deve ter um dos seguintes formatos: JPG, JPEG, PNG e GIF!');</script>";
			}
			
			$nomeMD5 = md5(time().rand());
			$arquivo = $nomeMD5.$extensao;
			
			if(!move_uploaded_file($_FILES['imgupd']['tmp_name'], '../'.DIRNEW.$arquivo)){
				echo "<script type='text/javascript'>alert('O procedimento irá continuar, mas a imagem não foi enviada!\nOcorreu um erro ao enviar a imagem! Por favor, verifique o tamanho e formato e tente novamente.');</script>";
			} else {
				require('../engine/wideImage/WideImage.php');
				WideImage::load('../'.DIRNEW.$arquivo)->resize(98, 98, 'outside')->crop('center', 'center', 98, 98)->saveToFile('../'.DIRNEW.$arquivo, 90);

			}
			
		}



		$insernew = mysql_query("INSERT INTO ".DBNAME.".site_news (ntitle, ndate, ncontent, nvis, ntitle_en, ntitle_es, ncontent_en, ncontent_es, imagem) VALUES ('".$f_t."', '".$date."', '".$f_c."', '".$f_vis."', '".$f_t_EN."', '".$f_t_ES."', '".$f_c_EN."', '".$f_c_ES."', '".$arquivo."')", $conexao);

		if($insernew == 1) {
			echo "<script type='text/javascript'>document.location.href='?id=noticias&success=1';</script>";
		} else {
			echo "<script type='text/javascript'>alert('Ops, ocorreu algum erro!');history.back();</script>";
		}

	} else { ?>

		<h2>&raquo; Inserindo Notícia</h2>


		Preencha os campos do formulário abaixo para inserir uma nova notícia.


		<br /><br />

		<form method="POST" action="?id=noticias&inserir&go=1" enctype="multipart/form-data">


			<div class='newsin'>

				<div style='display:table;width:100%;'>

					<div class='formpadrao centeralign' style='width:250px;float:left;'>
						<div class='desc'>Data:</div>
						<div class='camp'>
							<input style='width:70px;' type='text' maxlength='10' name='ndata' value='<?php echo date('d/m/Y', time()-GMTF); ?>' onKeyDown='mask(this,fdata);' onKeyPress='mask(this,fdata);' onKeyUp='mask(this,fdata);' onBlur="if(this.value=='')this.value='__/__/__'" onFocus="if(this.value=='__/__/__')this.value=''" />
							&nbsp;às&nbsp;
							<input style='width:40px;' type='text' maxlength='5' name='nhr' value='<?php echo date('H:i', time()-GMTF); ?>' onKeyDown='mask(this,fhora);' onKeyPress='mask(this,fhora);' onKeyUp='mask(this,fhora);' onBlur="if(this.value=='')this.value='__:__'" onFocus="if(this.value=='__:__')this.value=''" />
						</div>
					</div>

					<div class='formpadrao centeralign' style='width:248px;float:left;margin: 0 0 0 2px;'>
						<div class='camp2'><div style='width:200px;padding: 8px 0 6px 20px;'>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<label><input class='chk' type='radio' name='nvis' value='1' checked /> Visível</label>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<label><input class='chk' type='radio' name='nvis' value='0' /> Oculta</label>
						</div>
					</div>
				</div>

			</div>
			
			<br />
			<div class='grayCabecalho'>Versão Obrigatória (Português):</span></div>
			<label class='formpadrao'>
				<div class='desc'>Título:</div>
				<div class='camp'><input type='text' maxlength='100' name='ntitle' style='width:435px;' /></div>
			</label>

			<label class='formpadrao nonepadding'>
				<textarea class='ckeditor' id="nconteudo" name="nconteudo" style="width:100%"></textarea>
			</label>

			<br />
			<div class='grayCabecalho'>Versão em Inglês: <span>(deixe em branco para usar a mesma da obrigatória)</span></div>
			<label class='formpadrao'>
				<div class='desc'>Título:</div>
				<div class='camp'><input type='text' maxlength='100' name='ntitle_en' style='width:435px;' /></div>
			</label>

			<label class='formpadrao nonepadding'>
				<textarea class='ckeditor' id="nconteudo_en" name="nconteudo_en" style="width:100%"></textarea>
			</label>

			<br />
			<div class='grayCabecalho'>Versão em Espanhol: <span>(deixe em branco para usar a mesma da obrigatória)</span></div>
			<label class='formpadrao'>
				<div class='desc'>Título:</div>
				<div class='camp'><input type='text' maxlength='100' name='ntitle_es' style='width:435px;' /></div>
			</label>

			<label class='formpadrao nonepadding'>
				<textarea class='ckeditor' id="nconteudo_es" name="nconteudo_es" style="width:100%"></textarea>
			</label>


			<br />
			<div class='grayCabecalho'>Imagem (JPG, PNG ou GIF - de preferência 98x98) <span>(opcional)</span></div>
			<label class='formpadrao'>
				<div class='camp'><input type='file' name='imgupd' style='width: 479px;' /></div>
			</label>

		</div>

		<div style='padding: 20px 0; display:table;width:100%;'><div style='display:table;margin: 0 28px 0 0; float: right;'>
			<input type="submit" class='atualstudio_button' value="Inserir notícia &raquo;" />
		</div></div>

	</form>


<?php
} }
