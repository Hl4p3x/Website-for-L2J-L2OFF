<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; } ?>
<h1><?php echo $LANG[13005]; ?></h1>

<div class='pddInner'>
	<?php echo $LANG[12084]; ?><br /><br />
	<?php echo "Click no botão abaixo e converse com nossa equipe."; ?><br /><br />
	<a style='display:table;margin: 0 auto;' href='http://m.me/L2Varkas' target='_blank' class='default dbig'><?php echo "Mensseger"; ?></a><br />

	<?php echo "Esta é a única pagina de comunicação entre a equipe e os jogadores.
	Se você estiver sendo atendido através de outro pagina ou por alguém que se diz ser da nossa equipe,
	esteja ciente que <b>NÃO SOMOS NÓS!</b>
	É alguém tentando se beneficiar de maneira ilícita."; ?><br /><br />

</div>

<?php if(!empty($facePage)) {
	
	echo "<hr />";
	
	if(!empty($facePage) && $faceBoxOn != 1) {
		echo "
		<div id=\"fb-root\"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = \"//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.7&appId=577018195656213\";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		";
	}
	
	?>
	
	<h1><?php echo $LANG[29002]; ?></h1>
	<div class='pddInner'>
		<?php echo $LANG[12998]; ?>
	</div>
	<style>
		.faceIndex { width: <?php echo $fbWidth; ?>px !important; }
	</style>
	<div class='faceIndex'>
		<div class="fb-page" data-href="<?php echo $facePage; ?>" data-width="<?php echo $fbWidth; ?>" data-height="<?php echo $fbHeight; ?>" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo $facePage; ?>"><a href="<?php echo $facePage; ?>"></a></blockquote></div></div>
	</div>

<?php } ?>
