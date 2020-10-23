<section class="content-header">
	<h1>
		Pacotes
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-shopping-cart"></i> Shop</li>
		<li class="active">Pacotes</li>
	</ol>
</section>

<section class="content">
	
	<div class='box-footer'>
		<a href='?page=pack_add&module=shop' class='btn btn-primary'>Criar novo pacote</a>
	</div>
	
	<div class="box">
		
		<!-- listagem -->
		<div class="box-body">
			
			<?php
			$catnome = !empty($_GET['catnome']) ? base64_decode(vCode($_GET['catnome'])) : '';
			if(!empty($catnome)) { echo "Você está visualizando apenas os pacotes da categoria <b>".$catnome."</b>.<br /><br />"; }
			?>
			
			<table class="table table-bordered item-list ui-sortable">
		
				<tr>
					<th class='sortHandle'></th>
					<th style='width:60px;'>Imagem</th>
					<th>Nome</th>
					<th>Categoria</th>
					<th>Itens</th>
					<th>Valor</th>
					<th style='width:250px;'>Opções</th>
				</tr>
				
				<tbody>
				<?php
				
				$cat = !empty($_GET['cat']) ? intval($_GET['cat']) : 0;
				
				require('private/classes/classShop.php');
				
				$consulta = Shop::listPacks($cat, 1);
				if(count($consulta) == 0) {
					echo'<tr><td colspan="7">Nenhum pacote encontrado.</td></tr>';
				} else {
					for($i=0, $c=count($consulta); $i < $c; $i++){
						echo "
						<tr id='item_".$consulta[$i]['spack_id']."'>
							<td class='sortHandle handle'><span class='ui-sortable-handle'><i class='fa fa-ellipsis-v'></i> <i class='fa fa-ellipsis-v'></i></span></td>
							<td><a href='?page=pack_change&module=shop&pack=".$consulta[$i]['spack_id']."'><img src='".$admref_ucp."imgs/shop/".(!empty($consulta[$i]['imagem']) ? (file_exists($admref_ucp.'imgs/shop/'.$consulta[$i]['imagem']) ? $consulta[$i]['imagem'] : 'unknow.jpg') : 'unknow.jpg')."' width='50' height='50' /></a></td>
							<td><a href='?page=pack_change&module=shop&pack=".$consulta[$i]['spack_id']."'>".$consulta[$i]['nome']."</a></td>
							<td>".$consulta[$i]['cat']."</td>
							<td>".$consulta[$i]['itens']."</td>
							<td>".intval($consulta[$i]['valor'])."</td>
							<td>
								<a href='?page=pack_change&module=shop&pack=".$consulta[$i]['spack_id']."' class='btn btn-default'>Editar</a>
								<a href='?page=item_add&module=shop&pack=".$consulta[$i]['spack_id']."' class='btn btn-info'>Adicionar item</a>
								<a href='?page=pack_delete&module=shop&pack=".$consulta[$i]['spack_id']."' title='Excluir' class='btn btn-danger'> <i class='fa fa-remove'></i></a>
							</td>
						</tr>
						";
	
					}
				}
				?>
				</tbody>
					
			</table>

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
				url: './?engine=pack_reorder&module=shop',
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
