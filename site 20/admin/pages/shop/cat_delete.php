<?php
$cat = !empty($_GET['cat']) ? intval($_GET['cat']) : '';

require('private/classes/classShop.php');

$consulta = Shop::findCat($cat);
if(count($consulta) == 0){
	fim('Categoria inexistente!');
}

$otherCats = Shop::listCats();

?>

<section class="content-header">
	<h1>
		Excluir categoria
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-shopping-cart"></i> Shop</li>
		<li class="active">Excluir categoria</li>
	</ol>
</section>

<section class="content">
	<div class="box">
		
		<div class="box-body">
				
			Você tem certeza que deseja excluir a categoria "<b><?php echo $consulta[0]['nome']; ?></b>"?<br />
			
			<?php if(count($otherCats) > 1) { ?>
			
			Se sim, para onde vão os pacotes cadastrados nesta categoria?<br /><br />
			
			<form role="form" class='atualstudio usarJquery' id='formExcluir' action='?engine=cat_delete&module=shop&cat=<?php echo $cat; ?>' method='POST'>
				<div class='form-group'>
					<label>
						<div class='desc'>Selecione a nova categoria:</div>
						<select name='newCat' class='form-control select2'>
							<?php
							for($i=0, $c=count($otherCats); $i < $c; $i++) {
								if($otherCats[$i]['scat_id'] != $cat) {
									echo '<option value="'.$otherCats[$i]['scat_id'].'">'.$otherCats[$i]['nome'].'</option>';
								}
							}
							?>
						</select>
					</label>
				</div>
			</form>
			
			<a class='btn btn-info' href='javascript:history.back();'>&laquo; Voltar</a>
			<a class='btn btn-danger formExcluir' href='#'>Excluir e mover pacotes para nova categoria</a>
			
			<br />
			
			<?php } ?>

			<br />
			
			Ou deseja excluir a categoria "<b><?php echo $consulta[0]['nome']; ?></b>" permanentemente, incluindo seus pacotes e itens?
			
			<br /><br />
			<a class='btn btn-info' href='javascript:history.back();'>&laquo; Voltar</a>
			<a class='btn btn-danger usarJquery' href='./?engine=cat_delete_brute&module=shop&cat=<?php echo $cat; ?>'>Excluir permanentemente</a>

		</div>
		
	</div>
</section>
