<section class="content-header">
	<h1>
		Categorias
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-shopping-cart"></i> Shop</li>
		<li class="active">Categorias</li>
	</ol>
</section>

<section class="content">
	
	<div class='box-footer'>
		<a href='?page=cat_add&module=shop' class='btn btn-primary'>Criar nova categoria</a>
	</div>
	
	<?php
	require('private/classes/classShop.php');
	?>

	<div class="box">
		
		<!-- listagem -->
		<div class="box-body">

			<table class="table table-bordered item-list ui-sortable">

				<tr>
					<th class='sortHandle'></th>
					<th>Nome</th>
					<th style='width:260px;'>Opções</th>
				</tr>
				<tbody>
				<?php
				$consulta = Shop::listCats();
				if(count($consulta) == 0) {
					echo'<tr><td colspan="3">Nenhuma categoria encontrada.</td></tr>';
				} else {
					for($i =0, $c=count($consulta);$i < $c; $i++) {
						echo"
						<tr id='item_".$consulta[$i]['scat_id']."'>
							<td class='sortHandle handle'><span class='ui-sortable-handle'><i class='fa fa-ellipsis-v'></i> <i class='fa fa-ellipsis-v'></i></span></td>
							<td><a href='?page=cat_change&module=shop&cat=".$consulta[$i]['scat_id']."'>".$consulta[$i]['nome']."</a></td>
							<td class='opcs'>
								<a href='?page=cat_change&module=shop&cat=".$consulta[$i]['scat_id']."' class='btn btn-default'>Alterar</a>
								<a href='?page=pack_list&module=shop&cat=".$consulta[$i]['scat_id']."&catnome=".base64_encode($consulta[$i]['nome'])."' class='btn btn-default'>Visualizar Pacotes</a>
								<a href='?page=cat_delete&module=shop&cat=".$consulta[$i]['scat_id']."' title='Excluir' class='btn btn-danger'><i class='fa fa-remove'></i></a>
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
				url: './?engine=cat_reorder&module=shop',
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

