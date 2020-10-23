<?php if(!$indexing) { echo "<script>document.location.replace('./');</script>"; exit; } ?>
<h1><?php echo $LANG[13005]; ?></h1>

<div class='pddInner'>
	<?php echo $LANG[12084]; ?><br /><br />
	<?php echo $LANG[12085]; ?><br /><br />
	<div style='text-align:center; font-size: 20px;'><?php echo $admin_email; ?></div><br /><br />
	<?php echo $LANG[12086]; ?><br /><br />
	<?php echo $LANG[12087]; ?><br /><br /><br />
	<a style='display:table;margin: 0 auto;' href='./forum' class='default dbig'><?php echo $LANG[12088]; ?></a><br />
	<div style='text-align:center;'><?php echo $LANG[12089]; ?></div><br />
</div>

<?php if(!empty($facePage)) {
	
	echo "<a style='display:table;margin: 0 auto;' target='_blank' href='".$facePage."' class='default dbig'>Facebook</a><br /><hr />";
	
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
