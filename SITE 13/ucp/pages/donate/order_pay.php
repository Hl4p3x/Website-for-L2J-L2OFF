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
		            <input name='itemAmount1' value='".number_format(trim($donation[0]['price']), 2, '.', '')."' type='hidden' />  
		            <input name='itemQuantity1' value='".$donation[0]['quant_coins']."' type='hidden' />  
		            <input name='reference' value='".$donation[0]['protocolo']."' type='hidden' />
		            <input type='submit' value='".$LANG[10042]."' class='default big' style='margin-left:20px;' />
		        </form>
				<br /><br />
				<div class='rmsg warn'>".$LANG[15004].": <b>".$donateEmail."</b></div>
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
				<br /><br />
				<div class='rmsg warn'>".$LANG[15004].": <b>".$donateEmail."</b></div>
				";
				
			break;
		
			case 'paypal':
			
				echo "
				<form target='_blank' method='POST' action='https://www.paypal.com/cgi-bin/webscr'>
					<input type='hidden' name='cmd' value='_xclick' />
					<input type='hidden' name='business' value='".$PayPal['business_email']."' />
					<input type='hidden' name='currency_code' value='".$donation[0]['currency']."' />
					<input type='hidden' name='item_name' value='".$donateDesc."' />
					<input type='hidden' name='amount' value='".number_format(trim($donation[0]['price']), 2, '.', '')."' />
					<input type='hidden' name='quantity' value='".$donation[0]['quant_coins']."' />
					<input type='hidden' name='custom' value='".$donation[0]['protocolo']."' />
					<input type='submit' value='".$LANG[10042]."' class='default big' style='margin-left:20px;' />
				</form>
				<br /><br />
				<div class='rmsg warn'>".$LANG[15004].": <b>".$donateEmail."</b></div>
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
							"quantity" => ceil($donation[0]['quant_coins']),
							"currency_id" => "".$donation[0]['currency']."",
							"unit_price" => ceil($donation[0]['price'])
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
					<!-- start CheckoutForm -->
					<div id=\"checkoutForm\">
						<!-- start CheckoutForm -->
						<div id=\"checkoutForm\">
							<script src=\"https://checkout.pay.g2a.com/index/checkout\"
								data-id=\"pay-g2a-script\"
								data-key=\"".$G2APay['api_hash']."\"
								data-amount=\"".trim($donation[0]['valor'])."\"
								data-currency=\"".$donation[0]['currency']."\"
								data-order-id=\"".$donation[0]['protocolo']."\"
								data-items[0][sku]=\"999999999\"
								data-items[0][name]=\"".trim($coinName)."\"
								data-items[0][id]=\"".$donation[0]['protocolo']."\"
								data-items[0][amount]=\"".trim($donation[0]['valor'])."\"
								data-items[0][qty]=\"".$donation[0]['quant_coins']."\"
								data-items[0][price]=\"".number_format(trim($donation[0]['price']), 2, '.', '')."\"
								data-items[0][url]=\"http://".$panel_url."/?module=donate&page=order_g2apay&f=".$donation[0]['protocolo']."\">
							</script>
						</div>
					</div>
				    
				</div>
				";
				
		}
		
	}

} else {
	
	echo $LANG[10046]."
	<div style='display:table;width:100%;'>
		<a href='./?module=donate&page=add' class='default' style='float:right;margin-right:30px'>".$LANG[10047]."</a>
	</div>
	";
}
