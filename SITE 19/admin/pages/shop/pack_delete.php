<?php
$pack = !empty($_GET['pack']) ? intval($_GET['pack']) : '';

require('private/classes/classShop.php');

$consulta = Shop::findPack($pack);
if(count($consulta) == 0){
	fim('Pacote inexistente!');
}

$otherPacks = Shop::listPacks();

?>

<section class="content-header">
	<h1>
		Excluir pacote
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-shopping-cart"></i> Shop</li>
		<li class="active">Excluir pacote</li>
	</ol>
</section>

<section class="content">
	<div class="box">
		
		<div class="box-body">
				
			Você tem certeza que deseja excluir o pacote "<b><?php echo $consulta[0]['nome']; ?></b>"?<br />
			
			<?php if(count($otherPacks) > 1) { ?>
			
			Se sim, para onde vão os itens cadastrados neste pacote?<br /><br />
			
			<form role="form" class='atualstudio usarJquery' id='formExcluir' action='?engine=pack_delete&module=shop&pack=<?php echo $pack; ?>' method='POST'>
				<div class='form-group'>
					<label>
						<div class='desc'>Selecione o novo pacote:</div>
						<select name='newPack' class='form-control select2'>
							<?php
							for($i=0, $c=count($otherPacks); $i < $c; $i++) {
								if($otherPacks[$i]['spack_id'] != $pack) {
									echo '<option value="'.$otherPacks[$i]['spack_id'].'">'.$otherPacks[$i]['nome'].'</option>';
								}
							}
							?>
						</select>
					</label>
				</div>
			</form>
			
			<a class='btn btn-info' href='javascript:history.back();'>&laquo; Voltar</a>
			<a class='btn btn-danger formExcluir' href='#'>Excluir e mover itens para novo pacote</a>
			
			<br /><br />
			
			Ou deseja excluir o pacote "<b><?php echo $consulta[0]['nome']; ?></b>" permanentemente, incluindo seus itens?
			
			<br />
			
			<?php } ?>

			<br />
			
			<a class='btn btn-info' href='javascript:history.back();'>&laquo; Voltar</a>
			<a class='btn btn-danger usarJquery' href='./?engine=pack_delete_brute&module=shop&pack=<?php echo $pack; ?>'>Excluir permanentemente</a>

		</div>
		
	</div>
</section>



