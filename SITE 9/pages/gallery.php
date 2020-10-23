<?php if(!$indexing || $dpage['galler'] != 1) { echo "<script>document.location.replace('./');</script>"; exit; } ?>

<h1><?php echo $LANG[12026]; ?></h1>

<div style='padding: 0 20px 40px 20px;'>
	
	<?php
	
	$cacheFile = "cache/gallery.xml";
	$genNew = 0;
	
	if(!file_exists($cacheFile)) {
		$genNew = 1;
	} else {
		
		$xml = simplexml_load_file($cacheFile);
		$configs = $xml->configs;
		$updated = intval($configs->updated);
		$delay = 1;
		
		if(($updated+($delay*60)) < time()) {
			$genNew = 1;
		}
		
	}
	
	if($genNew) {
		
		if(!file_exists("cache")) { @mkdir("cache", 0775, true); @chmod("cache", 0775); }
		if(!file_exists("cache/index.html")) { $secIndexFile = fopen("cache/index.html","w+"); @fclose($secIndexFile); }
		if(!file_exists("cache/.htaccess")) { $secHtacsFile = fopen("cache/.htaccess","w+"); @fwrite($secHtacsFile, "Options -Indexes"); @fclose($secHtacsFile); }
		
		$wFile = fopen($cacheFile,"w+");
		
		$updated = time();
		$line = "\n<configs>\n<atualstudio>Cache script by Atualstudio.com</atualstudio>\n<updated>".$updated."</updated>\n</configs>";
		
		require_once('private/classes/classGallery.php');
		
		$gallery = Gallery::listAll();
		if(count($gallery) > 0) {
			
			for($i=0, $c=count($gallery); $i < $c; $i++) {
				
				$line .= "\n<line>\n";
				$line .= "<url>".$gallery[$i]['url']."</url>\n";
				$line .= "<isvideo>".$gallery[$i]['isvideo']."</isvideo>\n";
				$line .= "</line>";
				
			}
			
		} else {
			$deleteCache = 1;
		}
		
		@fwrite($wFile, utf8_encode("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<gallery>".$line."\n</gallery>"));
		@fclose($wFile);
		
		$xml = simplexml_load_file($cacheFile);
		
		if(isset($deleteCache) && file_exists($cacheFile)) {
			unlink($cacheFile);
		}
		
	}
	
	$line = $xml->line;
	
	?>
	
	<div class='fullGallery'>
		<div>
			
		<?php
		
		$pagin['max_results'] = $galleryMax;
		$pagin['link'] = "./?page=gallery";
		$pagin['atual'] = (!empty($_GET['pg']) && is_numeric($_GET['pg']) ? intval($_GET['pg']) : 1); $pagin['begin'] = ($pagin['atual']-1) * $pagin['max_results'];
		
		$pagin['total_results'] = 0;
		
		if(count($line) > 0) {
			
			$pagin['total_results'] = count($line);
			
			for($i=$pagin['begin'], $c=intval($pagin['begin']+$pagin['max_results']); $i < $c; $i++) {
				
				if(empty($line[$i]->url)) { continue; }
				
				if(intval($line[$i]->isvideo) != '1') {
					echo "
					<a href='".$dir_gallery.$line[$i]->url."' rel='prettyPhoto[fullGallery]'>
						<img src='".$dir_gallery."thumbnail/".$line[$i]->url."' />
						<div></div>
					</a>
					";
				} else {
					echo "
					<a href='//www.youtube.com/watch?v=".$line[$i]->url."&rel=0' class='iframe' rel='prettyPhoto[fullGallery]'>
						<img src='".$dir_gallery."thumbnail/".$line[$i]->url.".jpg' />
						<div></div>
						<span></span>
					</a>
					";
				}
				
			}
			
		} else {
			echo "<div class='rmsg error'>".$LANG[12062]."</div>";
		}
		
		?>
			
		</div>
	</div>
	
	<br /><br />
	
	<?php include("private/includes/paginate.php"); ?>
	
	<div class='rmsg' style='background: #fff2a8; color: #000;'><?php echo $LANG[11998]; ?></div>

</div>

