<?php

$pack = !empty($_GET['pack']) ? intval($_GET['pack']) : 0;

require('private/classes/classShop.php');

$cons = Shop::findPack($pack);
if(count($cons) == 0){
	fim('Pacote inexistente!');
}
?>

<section class="content-header">
	<h1>
		Alterar Pacote
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-shopping-cart"></i> Shop</li>
		<li class="active">Alterar Pacote</li>
	</ol>
</section>

<section class="content">
	
	<div class="box box-primary">
		
		<form method='POST' class='atualstudio' action='?engine=pack_change&module=shop&pack=<?php echo $pack; ?>' enctype='multipart/form-data'>
			
			<div class="box-body">
	
				<div class='form-group'>
					<label>
						<div class='desc'>Nome</div>
						<input type='text' name='nome' maxlength='70' class='form-control' value='<?php echo $cons[0]['nome']; ?>'/>
					</label>
				</div>
				
				<div class='form-group'>
					<label>
						<div class='desc'>Categoria</div>
						<select name='scat_id' class='form-control select2'>
							<?php
							$consulta = Shop::listCats();
							for($i=0, $c=count($consulta); $i < $c; $i++) {
								echo "<option value='".$consulta[$i]['scat_id']."'".($consulta[$i]['scat_id'] == $cons[0]['scat_id'] ? ' selected' : '').">".$consulta[$i]['nome']."</option>";
							}
							?>
						</select>
					</label>
				</div>
	
				<div class='form-group'>
					<label>
						<div class='desc'>Imagem</div>
						<img src='<?php echo $admref_ucp; ?>imgs/shop/<?php echo (!empty($cons[0]['imagem']) ? (file_exists($admref_ucp.'imgs/shop/'.$cons[0]['imagem']) ? $cons[0]['imagem'] : 'unknow.jpg') : 'unknow.jpg'); ?>' /><br />Caso queira alterar a imagem, selecione uma nova imagem clicando no campo abaixo. Caso contrário, deixe em branco.<br />
						<input type="file" name="imagem" />
					</label>
				</div>
	
				<div class='form-group'>
					<label>
						<div class='desc'>Valor (<?php echo "em ".strtolower($coinName)."'s"; ?>)</div>
						<input type='text' name='valor' maxlength='11' class='form-control' value='<?php echo intval($cons[0]['valor']); ?>' />
					</label>
					<p class='help-block' style='font-size: 13px;'>Caso insira um valor, o usuário poderá comprar todos os itens do pacote duma vez só pelo valor informado. Deixe "0" para cancelar essa possibilidade.</p>
				</div>
				
				<div class='box-footer'>
					<input type='submit' class='btn btn-primary' value='Alterar Pacote' />
					<div style='float:right;'>
						<a href='javascript:history.back();' class='btn btn-default'>&laquo; Voltar</a>
						<a href='?page=pack_delete&module=shop&pack=<?php echo $pack; ?>' title='Excluir' class='btn btn-danger'>Excluir</a>
					</div>
				</div>
				
			</div>
	
		</form>
		
	</div>

</section>


<span id='itens'></span>
<section class="content-header">
	<h1>
		Itens neste pacote
	</h1>
</section>

<section class="content">

	<div class="box">

		<!-- listagem -->
		<div class="box-body">

			<table class="table table-bordered item-list ui-sortable">

				<tr>
					<th class='sortHandle'></th>
					<th style='width:32px;'></th>
					<th>Nome</th>
					<th>ID in-game</th>
					<th>Valor</th>
					<th>Cumul.</th>
					<th>Data de cadastro</th>
					<th>Última Alteração</th>
					<th style='width:50px;'>Opções</th>
				</tr>
				
				<tbody>
				<?php
				$consulta = Shop::listItens($pack);
				if(count($consulta) == 0) {
					echo'<tr><td colspan="8">Nenhum item encontrado.</td></tr>';
				} else {
					for($i =0, $c=count($consulta);$i < $c; $i++) {
						echo"
						<tr id='item_".$consulta[$i]['sitem_id']."'>
							<td class='sortHandle handle'><span class='ui-sortable-handle'><i class='fa fa-ellipsis-v'></i> <i class='fa fa-ellipsis-v'></i></span></td>
							<td>".(file_exists($admref_ucp.'icons/itens/'.intval($consulta[$i]['id_ingame']).'.png') ? "<img width='32' height='32' src='".$admref_ucp."icons/itens/".intval($consulta[$i]['id_ingame']).".png' />" : "<img width='32' height='32' src='".$admref_ucp."imgs/icons.php?type=1&id=".intval($consulta[$i]['id_ingame'])."' />")."</td>
							<td>".$consulta[$i]['nome'] . "&nbsp;" . (!empty($consulta[$i]['sa']) ? " <b>".$consulta[$i]['sa']."</b>&nbsp;" : "") . (!empty($consulta[$i]['enchant']) ? " <b>+".$consulta[$i]['enchant']."</b>&nbsp;" : "") . (!empty($consulta[$i]['amount']) ? " (".$consulta[$i]['amount'].")" : "")."</td>
							<td>".$consulta[$i]['id_ingame']."</td>
							<td>".$consulta[$i]['valor']."</td>
							<td>".($consulta[$i]['cumulativo'] == '0' ? 'Não' : 'Sim')."</td>
							<td>".date('d/m/Y \à\s H:i', ($consulta[$i]['data_c']))."</td>
							<td>".(empty($consulta[$i]['data_a']) ? 'Ainda não houve' : date('d/m/Y \à\s H:i', ($consulta[$i]['data_a'])))."</td>
							<td>
								<a class='btn btn-danger usarJquery' href='./?engine=item_delete&module=shop&pack=".$consulta[$i]['spack_id']."&item=".$consulta[$i]['sitem_id']."' title='Excluir' class='btn btn-danger'> <i class='fa fa-remove'></i></a>
							</td>
						</tr>
						";
					}
				}
				?>
				</tbody>

			</table>
			
			<div class='box-footer'>
				<a href='./?page=item_add&module=shop&pack=<?php echo $pack; ?>' class='btn btn-primary'>Adicionar item</a>
			</div>
			
		</div>
		
	</div>
	
</section>

<script>
$(function() {
	$("table.item-list tbody").sortable({
		placeholder: "sort-highlight",
		handle: ".handle",
		forcePlaceholderSize: true,
		zIndex: 999999,
		update: function() {
			var order = $(this).sortable("serialize");
			$.ajax({
				type: 'POST',
				url: './?engine=item_reorder&module=shop&pack=<?php echo $pack; ?>',
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
<script src="layout/plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

