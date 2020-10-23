<?php if((!$indexing) || ($logged != 1)) { exit; }
require('private/classes/classDonate.php');
?>

<ul class="breadcrumb">
	<li><a href='./?module=donate&page=add'><i class='fa fa-money'></i> <?php echo $LANG[12039]; ?></a></li>
	<li><a href='./?module=donate&page=orders'><?php echo $LANG[10015]; ?></a></li>
	<li><?php echo $LANG[10052]; ?></li>
</ul>

<?php

$protocolo = !empty($_GET['f']) ? intval($_GET['f']) : 0;

if(empty($protocolo)) { echo "<script>document.location.replace('./?module=donate&page=orders');</script>"; exit; }

$donation = Donate::findDonation($_SESSION['acc'], $protocolo);
if(count($donation) > 0) {
	
	$mpxpl = explode('_', $donation[0]['metodo_pgto']);
	$metodo_pgto = $mpxpl[0];
	
	echo "
	<h1>".$LANG[10052]."</h1>
	<div class='pddInner'>
		<b>".$LANG[10029].":</b> ".$donation[0]['protocolo']."<br />
		<b>".$LANG[10030].":</b> ".$donation[0]['quant_coins']."<br />
		<b>".$LANG[10031].":</b> ".$donation[0]['coins_bonus']."<br />
		<b>".$LANG[10032].":</b> ".($donation[0]['quant_coins']+$donation[0]['coins_bonus'])."<br />
		<b>".$LANG[10034].":</b> ".obtainCurrencySymbol($donation[0]['currency'])." ".number_format(trim($donation[0]['valor']), 2, ',', '.')." (".$donation[0]['currency'].")<br />
		<b>".$LANG[10035].":</b> ".date('d F, Y H:i', $donation[0]['data'])."<br />
		<b>".$LANG[10036].":</b> ".(!empty($donation[0]['ultima_alteracao']) ? date('d/m/Y H:i', $donation[0]['ultima_alteracao']) : $LANG[10039])."<br />
		<b>".$LANG[10037].":</b> ".$metodo_pgto."<br />
		<b>".$LANG[10038].":</b> ".obtainOrderStatusName($donation[0]['status'])."<br /><br />
		".$LANG[10045]."
	</div>
	";
	
	if($donation[0]['status'] == 1) {
		
		$donateDesc = $LANG[10052]." ".$donation[0]['protocolo']." - ".$donation[0]['quant_coins']." ".$coinName;
		
		switch(strtolower($metodo_pgto)) {
			
			case 'pagseguro':
			
				echo "
			    <form target='_blank' method='POST' action='".($PagSeguro['testando'] == 1 ? 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html' : 'https://pagseguro.uol.com.br/v2/checkout/payment.html')."'>  
		            <input name='receiverEmail' value='".$PagSeguro['email']."' type='hidden' />  
		            <input name='currency' value='".$donation[0]['currency']."' type='hidden' />  
		            <input name='itemId1' value='1' type='hidden' />  
		            <input name='itemDescription1' value='".$donateDesc."' type='hidden' />  
		            <input name='itemAmount1' value='".number_format(trim($donation[0]['valor']), 2, '.', '')."' type='hidden' />  
		            <input name='itemQuantity1' value='1' type='hidden' />  
		            <input name='reference' value='".$donation[0]['protocolo']."' type='hidden' />
		            <input type='submit' value='".$LANG[10042]."' class='default big' style='margin-left:20px;' />
		        </form>
		        ";
				
			break;
		
			case 'banking':
			
				echo "
				<h1>".$LANG[10040]."</h1>
				<div class='pddInner'>
					".$LANG[15005].":<br /><br />
					".$Banking['bank_dados']."
					<br /><br />
					<div class='rmsg warn'>".$LANG[15004].": <b>".$donateEmail."</b></div>
				</div>
				";
				
			break;
		
			case 'paypal':
			
				echo "
				<form target='_blank' method='POST' action='https://www.paypal.com/cgi-bin/webscr'>
					<input type='hidden' name='cmd' value='_xclick' />
					<input type='hidden' name='business' value='".$PayPal['business_email']."' />
					<input type='hidden' name='currency_code' value='".$donation[0]['currency']."' />
					<input type='hidden' name='item_name' value='".$donateDesc."' />
					<input type='hidden' name='amount' value='".number_format(trim($donation[0]['valor']), 2, '.', '')."' />
					<input type='hidden' name='quantity' value='1' />
					<input type='hidden' name='custom' value='".$donation[0]['protocolo']."' />
					<input type='submit' value='".$LANG[10042]."' class='default big' style='margin-left:20px;' />
				</form>
				";
				
			break;
		
			case 'mercadopago':
			
				require_once('private/mp/mercadopago.php');
				
				$mp = new MP($MercadoPago['client_id'], $MercadoPago['client_secret']);
				
				$preference_data = array(
					"external_reference" => $donation[0]['protocolo'],
					"items" => array(
						array(
							"title" => "".$donateDesc."",
							"quantity" => 1,
							"currency_id" => "".$donation[0]['currency']."",
							"unit_price" => ceil(trim($donation[0]['valor']))
						)
					)
				);
				
				$preference = $mp->create_preference($preference_data);
		
				echo "
				<a href='".$preference['response']['init_point']."' name='MP-Checkout' class='default big' style='margin-left:20px;'>".$LANG[10042]."</a>
				<script type='text/javascript' src='//resources.mlstatic.com/mptools/render.js'></script>
				";
				
			break;
		
			case 'paygol':
			
				echo "
				<form target='_blank' method='POST' action='https://www.paygol.com/pay' >
					<input type='hidden' name='pg_serviceid' value='".($donation[0]['currency'] == 'USD' ? $PayGol['USD']['service_id'] : ($donation[0]['currency'] == 'EUR' ? $PayGol['EUR']['service_id'] : $PayGol['BRL']['service_id']))."'>
					<input type='hidden' name='pg_currency' value='".$donation[0]['currency']."'>
					<input type='hidden' name='pg_name' value='".$donateDesc."'>
					<input type='hidden' name='pg_custom' value='".$donation[0]['protocolo']."'>
					<input type='hidden' name='pg_price' value='".number_format(ceil($donation[0]['valor']), 2, '.', '')."'>
					<input type='submit' value='".$LANG[10042]."' class='default big' style='margin-left:20px;' />
				</form>
				";
				
			break;
		
			case 'webmoney':
				
				echo "
				<form target='_blank' method='POST' action='https://merchant.wmtransfer.com/lmi/payment.asp'>
					<input type='hidden' name='LMI_PAYMENT_AMOUNT' value='".number_format($donation[0]['valor'], 2, '.', '')."'>
					<input type='hidden' name='LMI_PAYMENT_DESC' value='".$donateDesc."'>
					<input type='hidden' name='LMI_PAYMENT_NO' value='".$donation[0]['protocolo']."'>
					<input type='hidden' name='LMI_PAYEE_PURSE' value='".$WebMoney['merch_purse']."'>
					<input type='submit' value='".$LANG[10042]."' class='default big' style='margin-left:20px;' />
				</form>
				<br /><br />
				<div class='rmsg warn'>".$LANG[15004].": <b>".$donateEmail."</b></div>
				";
				
			break;
		
			case 'payza':
				
				echo "
				<form target='_blank' method='POST' action='https://secure.payza.com/checkout' >
					<input type='hidden' name='ap_merchant' value='".$Payza['email']."'/>
					<input type='hidden' name='ap_purchasetype' value='item'/>
					<input type='hidden' name='ap_itemname' value='".$donation[0]['quant_coins']." ".trim($coinName)."'/>
					<input type='hidden' name='ap_description' value='".$donateDesc."'/>
					<input type='hidden' name='ap_amount' value='".number_format($donation[0]['valor'], 2, '.', '')."'/>
					<input type='hidden' name='ap_currency' value='".$donation[0]['currency']."'/>
					<input type='hidden' name='ap_itemcode' value='".$donation[0]['protocolo']."'/>
					<input type='submit' value='".$LANG[10042]."' class='default big' style='margin-left:20px;' />
				</form>
				";
				
			break;
		
			case 'skrill':
				
				echo "
				<form target='_blank' method='POST' action='https://pay.skrill.com'>
					<input type='hidden' name='pay_to_email' value='".$Skrill['email']."'>
					<input type='hidden' name='language' value='EN'>
					<input type='hidden' name='amount' value='".number_format($donation[0]['valor'], 2, '.', '')."'>
					<input type='hidden' name='currency' value='".$Skrill['currency']."'>
					<input type='hidden' name='detail1_description' value='".$donateDesc."'>
					<input type='hidden' name='merchant_fields' value='protocol'>
					<input type='hidden' name='protocol' value='".$donation[0]['protocolo']."'>
					<input type='submit' value='".$LANG[10042]."' class='default big' style='margin-left:20px;' />
				</form>
				<br /><br />
				<div class='rmsg warn'>".$LANG[15004].": <b>".$donateEmail."</b></div>
				";
				
			break;
		
			default:
			
				// g2apay
				
				
				echo "
				<h1>".$LANG[10040]."</h1>
				<div class='pddInner'>
				    ".$LANG[39013]."<br /><br />
				    
					<form id='G2A' method='POST'>

						<input type='hidden' name='api_hash' value='".trim($G2APay['api_hash'])."'>
						<input type='hidden' name='hash' value='".hash('sha256', trim($donation[0]['protocolo']).trim($donation[0]['valor']).trim($donation[0]['currency']).$G2APay['api_secret'])."'>
						<input type='hidden' name='order_id' value='".trim($donation[0]['protocolo'])."'>
						<input type='hidden' name='amount' value='".trim($donation[0]['valor'])."'>
						<input type='hidden' name='currency' value='".$donation[0]['currency']."'>
						<input type='hidden' name='url_failure' value='http://".$panel_url."/?module=donate&page=order_pay&f=".trim($donation[0]['protocolo'])."'>
						<input type='hidden' name='url_ok' value='http://".$panel_url."/?module=donate&page=order_pay&f=".trim($donation[0]['protocolo'])."'>
						
						<input type='hidden' name='items[0][sku]' value='99999'>
						<input type='hidden' name='items[0][name]' value='".trim($coinName)."'>
						<input type='hidden' name='items[0][amount]' value='".trim($donation[0]['valor'])."'>
						<input type='hidden' name='items[0][type]' value='digital'>
						<input type='hidden' name='items[0][qty]' value='".trim($donation[0]['quant_coins'])."'>
						<input type='hidden' name='items[0][price]' value='".round(trim(trim($donation[0]['valor'])/$donation[0]['quant_coins']), 2)."'>
						<input type='hidden' name='items[0][id]' value='".trim($donation[0]['protocolo'])."'>
						<input type='hidden' name='items[0][url]' value='http://".$panel_url."/?module=donate&page=add'>

						<input type='submit' value='".$LANG[10042]."' class='default big' style='margin-left:20px;' />
						
					</form>
				    
				</div>
				";
				
				?>
				
				<script>
					
					$('form#G2A').submit(function(){
						
						var theForm = $('form#G2A');
						var submitButton = $(this).find("input[type='button']");
						var l11015 = $('#l11015').val();
						var l11016 = $('#l11016').val();
						var l20001 = $('#l20001').val();
						
						if(!$(submitButton).hasClass('loading') && !$(submitButton).hasClass('sucesso')) {
							
							$(submitButton).attr('data-oldtext', ''+$(submitButton).val()+'').addClass('loading').val(l20001);
							
							$.ajax({
								type: 'POST',
								url: 'https://checkout.pay.g2a.com/index/createQuote',
								cache: false,
								data: $(theForm).serialize(),
								dataType: 'json',
								timeout: 15000,
								async: false,
								success: function(data)
								{
									
									$(submitButton).val(''+$(submitButton).attr('data-oldtext')+'').removeClass('loading');
									
									if(data.status == 'ok') {
										document.location.href='https://checkout.pay.g2a.com/index/gateway?token='+data.token;
										return false;
									} else {
										atualAlert(data.message, 'ERROR', '');
									}
									
								},
							    error: function(jqXHR, textStatus){
							    	$(submitButton).val(''+$(submitButton).attr('data-oldtext')+'').removeClass('loading');
							    	if(textStatus == 'timeout') {
								        atualAlert(l11015+' #1');
							    	} else if(textStatus != 'abort') {
								        atualAlert(l11016+' #2');
								    }
							    }
							});
							
							return false;
							
						}
						
					});

				</script>
				
				<?php
				
		}
		
	}

} else {
	
	echo $LANG[10046]."
	<div style='display:table;width:100%;'>
		<a href='./?module=donate&page=add' class='default' style='float:right;margin-right:30px'>".$LANG[10047]."</a>
	</div>
	";
}
