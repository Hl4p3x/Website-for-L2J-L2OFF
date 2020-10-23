<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; } ?>

<h1><?php echo $LANG[12039]; ?></h1>

<div class='pddInner'>
	
	<?php echo $LANG[12102]; ?>
	<br /><br />
	<p class='cbold'><?php echo $LANG[12106]; ?></p>
	
	<?php echo $LANG[12103]; ?><br />
	<?php echo $LANG[12104]; ?>
	
	<br /><br />
	<ul style='font-size:15px;'>
		<li><?php echo $LANG[20000]; ?></li>
	</ul>
	
	<br /><br />
	<p class='cbold'><?php echo $LANG[12107]; ?>:</p>
	
	<?php
	if(file_exists('ucp/')) {
		echo $LANG[29003]."<br /><a href='./ucp/' class='default dbig' style='margin: 20px auto;'>".$LANG[30507]." &raquo;</a>";
	} else {
	?>
	
	<?php echo $LANG[12105]; ?><br /><br />
	
	<!-- INSIRA BOTOES AQUI - INICIO -->
	
	******* Insira os botões do PayPal, PagSeguro, etc, aqui *******<br />
	******* Enter the buttons of PayPal, PagSeguro, etc, here *******<br />
	
	<!-- INSIRA BOTOES AQUI - FIM -->
	
	<?php
	}
	?>

</div>
