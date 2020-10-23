<section class="content-header">
	<h1>
		Notícias
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-newspaper-o"></i> Notícias</li>
		<li class="active">Visualizar</li>
	</ol>
</section>

<section class="content">

	<?php
	$buscar = !empty($_GET['buscar']) ? vCode($_GET['buscar']) : '';
	require('private/classes/classNews.php');
	?>

	<div class='box-footer'>
		<a href='?page=add&module=news' class='btn btn-primary'>Adicionar Notícia</a>
	</div>
	
	<div class="box">

		<!-- Busca -->
		<div class="box-header" style="padding-bottom:0;">
			<div class="box-tools">
				<form class='default' method='GET'>
					<div class="input-group" style="width: 250px;">
						
						<input type='hidden' name='page' value='list'/>
						<input type='hidden' name='module' value='news'/>
						
						<input type="text" name='buscar' value='<?php echo $buscar; ?>' class="form-control input-sm pull-right" placeholder="Pesquisar...">
						
						<div class="input-group-btn">
							<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>

		<!-- Resultados -->
		<div class="box-body">

			<table class="table table-bordered">
				<tr>
					<th style='width:90px;'>Imagem</th>
					<th>Notícia</th>
					<th style='width: 130px'>Criada em</th>
					<th style='width: 100px'>Opções</th>
				</tr>

				<?php
				$pagin['max_results'] = 15;
				$pagin['link'] = "?page=list&module=news";
				$pagin['link'] .= (!empty($buscar) ? "&buscar=".$buscar : "");
				$pagin['atual'] = (!empty($_GET['pg']) && is_numeric($_GET['pg']) ? intval($_GET['pg']) : 1); $pagin['begin'] = ($pagin['atual']-1) * $pagin['max_results'];

				$consulta = News::countNews($buscar);

				$pagin['total_results'] = $consulta[0]['quant'];
				$consulta = News::listNews($pagin['begin'], $pagin['max_results'], $buscar);

				if(count($consulta) == 0) {
					echo'<tr><td colspan="4">Nenhuma notícia encontrada!</td></tr>';
				} else {
					for($i=0, $c=count($consulta); $i < $c; $i++) {
						
						echo"
						<tr>
							<td><img width='90' height='90' src='".((strlen(trim($consulta[$i]['img'])) > 0) ? (file_exists('../'.$dir_newsimg.trim($consulta[$i]['img'])) ? '../'.$dir_newsimg.trim($consulta[$i]['img']) : '../imgs/nm/no-img-new.jpg') : '../imgs/nm/no-img-new.jpg')."' /></td>
							<td style='cursor:pointer;' onclick='javascript:document.location.href=\"?page=edit&module=news&nid=".$consulta[$i]['nid']."\";'><b>".$consulta[$i]['title_pt']."</b><br />".trim(substr(strip_tags($consulta[$i]['content_pt']), 0, 270)).(strlen($consulta[$i]['content_pt']) > 270 ? '...' : '')."</td>
							<td>".date('d/m/Y H:i', ($consulta[$i]['post_date']))."</td>
							<td class='opcs'>
								<a href='?page=edit&module=news&nid=".$consulta[$i]['nid']."' title='Editar' class='btn btn-default'><i class='fa fa-edit'></i></a>
								<a href='?page=delete&module=news&nid=".$consulta[$i]['nid']."' title='Excluir' class='btn btn-danger'><i class='fa fa-remove'></i></a>
							</td>
						</tr>
						";
					}
				}
				?>
			</table>

		</div>
		<?php require('private/paginate.php'); ?>

	</div>

	<div class='box-footer'>
		<a href='?page=add&module=news' class='btn btn-primary'>Adicionar Notícia</a>
	</div>
	
</section>

