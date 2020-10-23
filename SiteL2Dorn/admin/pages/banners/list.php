<section class="content-header">
	<h1>
		Banners
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-object-group"></i> Banners</li>
		<li class="active">Visualizar</li>
	</ol>
</section>

<section class="content">

	<div class='box-footer'>
		<a href='?page=add&module=banners' class='btn btn-primary'>Adicionar Banner</a>
	</div>
	
	<div class="box">

		<!-- Resultados -->
		<div class="box-body">

			<table class="table table-bordered item-list ui-sortable">
				<tr>
					<th class='sortHandle'></th>
					<th style='width:180px;'>Versão Português</th>
					<th style='width:180px;'>Versão Inglês</th>
					<th style='width:180px;'>Versão Espanhol</th>
					<th>Link</th>
					<th>Target</th>
					<th>Exibição</th>
					<th style='width: 100px'>Opções</th>
				</tr>

				<?php
				
				require('private/classes/classBanners.php');
				
				$consulta = Banners::listBanners();

				if(count($consulta) == 0) {
					echo'<tr><td colspan="8">Nenhum banner encontrado!</td></tr>';
				} else {
					for($i=0, $c=count($consulta); $i < $c; $i++) {
						
						echo"
						<tr id='item_".$consulta[$i]['bid']."'>
							<td class='sortHandle handle'><span class='ui-sortable-handle'><i class='fa fa-ellipsis-v'></i> <i class='fa fa-ellipsis-v'></i></span></td>
							<td>".((strlen(trim($consulta[$i]['imgurl_pt'])) > 0 && file_exists('../'.$dir_banners.trim($consulta[$i]['imgurl_pt']))) ? "<a href='../".$dir_banners.trim($consulta[$i]['imgurl_pt'])."' target='_blank'><img width='180' src='../".$dir_banners.trim($consulta[$i]['imgurl_pt'])."' /></a>" : "")."</td>
							<td>".((strlen(trim($consulta[$i]['imgurl_en'])) > 0 && file_exists('../'.$dir_banners.trim($consulta[$i]['imgurl_en']))) ? "<a href='../".$dir_banners.trim($consulta[$i]['imgurl_en'])."' target='_blank'><img width='180' src='../".$dir_banners.trim($consulta[$i]['imgurl_en'])."' /></a>" : "")."</td>
							<td>".((strlen(trim($consulta[$i]['imgurl_es'])) > 0 && file_exists('../'.$dir_banners.trim($consulta[$i]['imgurl_es']))) ? "<a href='../".$dir_banners.trim($consulta[$i]['imgurl_es'])."' target='_blank'><img width='180' src='../".$dir_banners.trim($consulta[$i]['imgurl_es'])."' /></a>" : "")."</td>
							<td>".$consulta[$i]['link']."</td>
							<td>".($consulta[$i]['target'] == '1' ? 'Nova aba' : 'Mesma aba')."</td>
							<td>".($consulta[$i]['vis'] == '1' ? 'Visível' : '<span style="color: red;">Oculto</span>')."</td>
							<td class='opcs'>
								<a href='?page=edit&module=banners&bid=".$consulta[$i]['bid']."' title='Editar' class='btn btn-default'><i class='fa fa-edit'></i></a>
								<a href='?page=delete&module=banners&bid=".$consulta[$i]['bid']."' title='Excluir' class='btn btn-danger'><i class='fa fa-remove'></i></a>
							</td>
						</tr>
						";
					}
				}
				?>
			</table>

		</div>

	</div>

	<div class='box-footer'>
		<a href='?page=add&module=banners' class='btn btn-primary'>Adicionar Banner</a>
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
				url: './?engine=reorder&module=banners',
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
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
