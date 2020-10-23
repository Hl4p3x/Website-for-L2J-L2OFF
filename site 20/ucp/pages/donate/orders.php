<?php if((!$indexing) || ($logged != 1)) { exit; }
require('private/classes/classDonate.php');
?>

<ul class="breadcrumb">
	<li><a href='./?module=donate&page=add'><i class='fa fa-money'></i> <?php echo $LANG[12039]; ?></a></li>
	<li><?php echo $LANG[10015]; ?></li>
</ul>

<h1><?php echo $LANG[10015]; ?></h1>

<div class='pddInner'>
	
	<?php
	$donation = Donate::findDonation($_SESSION['acc']);
	if(count($donation) > 0) {
		
		echo "
		
		<div style='padding: 0 0 15px; margin: 0 0 15px; border-bottom: 1px dotted #F5F5F5;'><b>".count($donation)."</b> ".$LANG[10119].":</div>
		
		<table cellspacing='0' cellpadding='0' border='0' class='default'>
		
			<tr>
				<th>".$LANG[10029]."</th>
				<th>".$coinName_mini."'s</th>
				<th>".$LANG[10115]."</th>
				<th>".$LANG[10116]."</th>
				<th>".$LANG[10118]."</th>
				<th>Status</th>
			</tr>
		";
		
		for($i=0, $c=count($donation); $i < $c; $i++) {
			
			$mpxpl = explode('_', $donation[$i]['metodo_pgto']);
			$metodo = $mpxpl[0];
			
			echo "
			<tr".(($i % 2 == 0) ? " class='two'" : '').">
				<td>".$donation[$i]['protocolo']."</td>
				<td>".($donation[$i]['quant_coins']+$donation[$i]['coins_bonus'])."</td>
				<td>".obtainCurrencySymbol($donation[$i]['currency'])."&nbsp;".number_format(trim($donation[$i]['valor']), 2, ',', '.')."</td>
				<td>".date('d/m/y H:i', $donation[$i]['data'])."</td>
				<td>".$metodo."</td>
				<td><a href='./?module=donate&page=order_pay&f=".$donation[$i]['protocolo']."'>".obtainOrderStatusName($donation[$i]['status'])."</a> ".($donation[$i]['status'] == 1 && $delFatura == 1 ? "(<a href='#' class='orderdelete1' data-oid='".$donation[$i]['protocolo']."'>".$LANG[10120]."</a>)" : "")."</td>
			</tr>
			";
		}
		
		echo "</table>
		
		<span id='confirm' class='invis'>
			<b>".$LANG[10122]." <span id='delProtocol'></span>?</b><br /><br />
			<a href='#' data-oid='' class='default orderdelete2' style='display: inline-block'>".$LANG[10120]."</a>
			&nbsp;
			<a href='#' class='default cancelarExclusao' style='display: inline-block'>".$LANG[10121]."</a>
		</span>
			
		<div style='text-align:center;width:100%;padding:20px 0;'>
			".$LANG[10045]."
		</div>
		";
		
	} else {
		echo "<b>".$LANG[10124].".</b>";
	}
	?>
	
	<div style='display:table;width:100%;'>
		<a href='./?module=donate&page=add' class='default' style='float:right;margin-right:30px'><?php echo $LANG[10047]; ?></a>
	</div>
	
</div>

<script>
	$(document).ready(function(){
		
		$('.cancelarExclusao').click(function(e){
			e.preventDefault();
			$('#confirm').addClass('invis');
		});
		
		$('a.orderdelete1').click(function(e){
			e.preventDefault();
			var gid = $(this).attr('data-oid');
			$('#confirm .orderdelete2').attr('data-oid', gid);
			$('#delProtocol').text(gid);
			$('#confirm').removeClass('invis');
			$('html, body').animate({ scrollTop: ''+($('#confirm').offset().top - 200)+'' }, 300);
		});
		
		$('a.orderdelete2').click(function(e){
			
			e.preventDefault();
			
			var submitButton = $(this);
			var oid = $(submitButton).attr('data-oid');
			var l11015 = $('#l11015').val();
			var l11016 = $('#l11016').val();
			var l20001 = $('#l20001').val();

			if(!$(submitButton).hasClass('loading')) {
				
				$(submitButton).attr('data-oldtext', ''+$(submitButton).text()+'').addClass('loading').text(l20001);
				
				$.ajax({
					type: 'POST',
					url: './?module=donate&engine=delete_order',
					cache: false,
					data: { oid: oid, isJS: 1 },
					dataType: 'json',
					timeout: 300000,
					async: false,
					success: function(data)
					{
						$(submitButton).text(''+$(submitButton).attr('data-oldtext')+'').removeClass('loading');
						$('#confirm').addClass('invis');
						atualAlert(data.msg, data.act, data.url);
					},
				    error: function(jqXHR, textStatus){
				    	$(submitButton).val(''+$(submitButton).attr('data-oldtext')+'').removeClass('loading');
				    	if(textStatus == 'timeout') {
					        atualAlert(l11015);
				    	} else if(textStatus != 'abort') {
					        atualAlert(l11016);
					    }
				    }
				});
				
			}
			
			return false;
			
		});
		
	});
</script>
