<?php if($indexing == 1) {

if(!is_numeric($_GET['editar'])) { exit; }

$searchnedit = mysql_query("SELECT * FROM ".DBNAME.".site_news WHERE nid = '".$_GET['editar']."' LIMIT 1", $conexao);
if(mysql_num_rows($searchnedit) > 0) {

	$atualimg = mysql_result($searchnedit, 0, 9);
	
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
				unlink('../'.DIRNEW.$atualimg);
			}
			
		}



		$insernew = mysql_query("UPDATE ".DBNAME.".site_news SET ntitle = '".$f_t."', ndate = '".$date."', ncontent = '".$f_c."', nvis = '".$f_vis."', ntitle_en = '".$f_t_EN."', ntitle_es = '".$f_t_ES."', ncontent_en = '".$f_c_EN."', ncontent_es = '".$f_c_ES."'".(!empty($arquivo) ? ", imagem = '".$arquivo."'" : "")." WHERE nid = '".$_GET['editar']."'", $conexao);

		if($insernew == 1) {
			echo "<script type='text/javascript'>document.location.href='?id=noticias&success=1';</script>";
		} else {
			echo "<script type='text/javascript'>alert('Ops, ocorreu algum erro!');history.back();</script>";
		}

	} else { ?>

		<h2>&raquo; Editando Notícia</h2>


		Preencha os campos do formulário abaixo para editar a notícia.


		<br /><br />

		<form method="POST" action="?id=noticias&editar&go=1&editar=<?php echo $_GET['editar']; ?>" enctype="multipart/form-data">


			<div class='newsin'>
			
			<div style='display:table;width:100%;'>
			
				<div class='formpadrao centeralign' style='width:250px;float:left;'>
					<div class='desc'>Data:</div>
					<div class='camp'>
						<?php $thisdate = mysql_result($searchnedit, 0, 2); ?>
						<input style='width:70px;' type='text' maxlength='10' name='ndata' value='<?php echo date('d/m/Y', $thisdate); ?>' onKeyDown='mask(this,fdata);' onKeyPress='mask(this,fdata);' onKeyUp='mask(this,fdata);' onBlur="if(this.value=='')this.value='__/__/__'" onFocus="if(this.value=='__/__/__')this.value=''" />
						&nbsp;às&nbsp;
						<input style='width:40px;' type='text' maxlength='5' name='nhr' value='<?php echo date('H:i', $thisdate); ?>' onKeyDown='mask(this,fhora);' onKeyPress='mask(this,fhora);' onKeyUp='mask(this,fhora);' onBlur="if(this.value=='')this.value='__:__'" onFocus="if(this.value=='__:__')this.value=''" />
					</div>
				</div>
				<?php $thisvis = mysql_result($searchnedit, 0, 4); ?>
				<div class='formpadrao centeralign' style='width:248px;float:left;margin: 0 0 0 2px;'>
						<div class='camp2'><div style='width:200px;padding: 8px 0 6px 20px;'>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<?php if($thisvis == '1') { ?>
							<label><input class='chk' type='radio' name='nvis' value='1' checked /> Visível</label>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<label><input class='chk' type='radio' name='nvis' value='0' /> Oculta</label>
						<?php } else { ?>
							<label><input class='chk' type='radio' name='nvis' value='1' /> Visível</label>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<label><input class='chk' type='radio' name='nvis' value='0' checked /> Oculta</label>
						<?php } ?>
						</div>
					</div>
				</div>
			
			</div>
			<?php
			function entityAspas($conteudo) {
				$convertaspas = array("'" => "&#039;", "\"" => "&#034;");
				return strtr($conteudo, $convertaspas);
			}
			?>
			
			<br />
			<div class='grayCabecalho'>Versão Obrigatória (Português):</span></div>
			<label class='formpadrao'>
				<div class='desc'>Título:</div>
				<div class='camp'><input type='text' maxlength='100' name='ntitle' style='width:435px;' value='<?php echo strip_tags(entityAspas(stripslashes(mysql_result($searchnedit, 0, 1)), 'font')); ?>' /></div>
			</label>

			<label class='formpadrao nonepadding'>
				<textarea class='ckeditor' id="nconteudo" name="nconteudo" style="width:100%"><?php echo stripslashes(mysql_result($searchnedit, 0, 3)); ?></textarea>
			</label>


			<br />
			<label class='formpadrao'>
			<div class='grayCabecalho'>Versão em Inglês: <span>(deixe em branco para usar a mesma da obrigatória)</span></div>
			<label class='formpadrao'>
				<div class='desc'>Título:</div>
				<div class='camp'><input type='text' maxlength='100' name='ntitle_en' style='width:435px;' value='<?php echo strip_tags(entityAspas(stripslashes(mysql_result($searchnedit, 0, 5)), 'font')); ?>' /></div>
			</label>

			<label class='formpadrao nonepadding'>
				<textarea class='ckeditor' id="nconteudo_en" name="nconteudo_en" style="width:100%"><?php echo stripslashes(mysql_result($searchnedit, 0, 7)); ?></textarea>
			</label>


			<br />
			<div class='grayCabecalho'>Versão em Espanhol: <span>(deixe em branco para usar a mesma da obrigatória)</span></div>
			<label class='formpadrao'>
				<div class='desc'>Título:</div>
				<div class='camp'><input type='text' maxlength='100' name='ntitle_es' style='width:435px;' value='<?php echo strip_tags(entityAspas(stripslashes(mysql_result($searchnedit, 0, 6)), 'font')); ?>' /></div>
			</label>

			<label class='formpadrao nonepadding'>
				<textarea class='ckeditor' id="nconteudo_es" name="nconteudo_es" style="width:100%"><?php echo stripslashes(mysql_result($searchnedit, 0, 8)); ?></textarea>
			</label>


			<br />
			<div class='grayCabecalho'>Imagem (JPG, PNG ou GIF - de preferência 98x98) <span>(opcional)</span></div>
			<label class='formpadrao'>
				<div class='camp'>
					<div class='editnewimg'>
						<img src='<?php echo (empty($atualimg) ? '../imgs/no-img-new.jpg' : '../'.DIRNEW.$atualimg); ?>' width='98' height='98' />
						<div>
							<b>Apenas selecione uma imagem caso queira trocar a atual.</b><br /><br />
							<input type='file' name='imgupd' style='width: 380px;' />
						</div>
					</div>
				</div>
			</label>

		</div>

		<div style='padding: 20px 0; display:table;width:100%;'><div style='display:table;margin: 0 28px 0 0; float: right;'>
			<input type="submit" class='atualstudio_button' value="Editar notícia &raquo;" />
		</div></div>

	</form>


<?php
}
} else { echo "Notícia não encontrada!"; }
}
