<aside>
			
				<div class='box'>
					<div class='title'>Ajude-nos Votando</div>
					<div class='ct vote'>
						<a href='https://top.l2jbrasil.com/index.php?a=in&u=lineage2free' target='_blank' title='Vote on Top L2JBrasil'><img src='imgs/l2jbrasil.jpg' /></a>
						<a href='https://vgw.hopzone.net/site/vote/100823/1' target='_blank' title='Vote on Hopzone'><img src='imgs/hopzone.jpg' /></a>
						<a href='https://l2topzone.com/vote/id/13432' target='_blank' title='Vote on L2Topzone'><img src='imgs/l2topzone.jpg' /></a>
						<a href='https://l2network.eu/index.php?a=in&u=l2free' target='_blank' title='Vote on L2Network'><img src='imgs/l2network.jpg' /></a>
					</div>
				</div>
				
			<div class='box'>
					<div class='title'>TOP STATS</div>
					<div class='ct'>
						
						<div class='multitables'>

						<?php
			if($dpage['toppvp'] == 1) {
							$xml = @simplexml_load_file("cache/toppvp.xml"); $line = @$xml->line;
							if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
							if($asideRankCount > 0) {
								for($i=0, $c=$asideRankCount; $i < $c; $i++) {
									echo "<table border='2' cellpadding='2' cellspacing='2' class='pvp'>
								<tr>
									<th><font color=#ff00ff>Player</font></th>
									<th><font color=#ff00ff>PvP</font></th>
								</tr>
								<tr class='two'>
								<td>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name."</td> <td>".$line[$i]->pvp."</td></tr> </table>";
								}
							} else {			
								for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 5); $i <= $c; $i++) {
									echo "<div>".$i."&ordm;&nbsp;&nbsp; Player <span>0 pvps</span></div>";
								}
							}
				}?>
<div class='multitables'>

						<?php
				if($dpage['toppkp'] == 1) {
							$xml = @simplexml_load_file("cache/toppk.xml"); $line = @$xml->line;
							if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
							if($asideRankCount > 0) {
								for($i=0, $c=$asideRankCount; $i < $c; $i++) {
									echo "<table border='2' cellpadding='0' cellspacing='0' class='pk'>
								<tr>
									<th><font color=#ff0000>Player</font></th>
									<th><font color=#ff0000>PK</font></th>
								</tr>
								<tr class='two'>
								<td>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name."</td> <td>".$line[$i]->pk."</td></tr> </table>";
								}
							} else {
								for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 3); $i <= $c; $i++) {
									echo "<div>".$i."&ordm;&nbsp;&nbsp; Player <span>0 pks</span></div>";
								}
							}
				}?>
				<div class='multitables'>

						<?php
				if($dpage['topcla'] == 1) {
							$xml = @simplexml_load_file("cache/topclan.xml"); $line = @$xml->line;
							if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
							if($asideRankCount > 0) {
								for($i=0, $c=$asideRankCount; $i < $c; $i++) {
								echo "<table border='2' cellpadding='0' cellspacing='0' class='clan'>
								<tr>
									<th><font color=#fffe30>Clan</font></th>
									<th><font color=#fffe30>Lv</font></th>
								</tr>
								<tr class='two'>
								<td>".$line[$i]->pos."&ordm;&nbsp;&nbsp; ".$line[$i]->name."</td> <td>".$line[$i]->level."</td> </tr></table>";
								}
							} else {
								for($i=1, $c=(!empty($asideRankCount) ? intval($asideRankCount) : 3); $i <= $c; $i++) {
									echo "<div>".$i."&ordm;&nbsp;&nbsp; Clan <span>0 lvl</span></div>";
								}
							}
				}

				?>
				</div></div></div>


				<a class='moreranks' href='./?page=toppvp'>Ver mais rankings</a>
			</div>
		</div>
		<!-- Ranking -->
						
				<!-- Gallery -->
			
				<div class='box'>
						<div class='title'>Galeria</div>
						<div class='ct'>
							<div style='display:table; margin: 0 auto;'>
								<div class='galleryBox'>
				<?php
				
				if($dpage['galler'] == 1) {
							$xml = @simplexml_load_file("cache/gallery.xml");
							$line = @$xml->line;
							$asideRankCount = (!empty($galleCount) ? intval($galleCount) : 6);
							if(count($line) < $asideRankCount) { $asideRankCount = count($line); }
							if($asideRankCount > 0) {
								for($i=0, $c=$asideRankCount; $i < $c; $i++) {
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
							}
							for($i=$asideRankCount, $c=(!empty($galleCount) ? intval($galleCount) : 6); $i < $c; $i++) {
								echo "<a href='javascript:void(0)'></a>";
							}
				}
				?>
				<div></div>
													<span></span>
												</a>
												
								</div>
								<a class='moregallery' href='./?page=gallery'></a>
							</div>
						</div>
					</div>							
				
			
		
				
				<div class='box'>
					<div class='title'>Live Streams</div>
					<div class='ct'>
						<iframe src="https://player.twitch.tv/?channel=dannyllo" frameborder="1" allowfullscreen="true" scrolling="no" muted="true" height="200" width="240" style="center: 15px;">></iframe>
						<iframe src="https://player.twitch.tv/?channel=pigtorres" frameborder="1" allowfullscreen="true" scrolling="no" muted="true" height="200" width="240" style="center: 15px;">></iframe>
					<!--	<a href='./?page=livestream' class='livestreams'><span></span></a> -->
					</div>
				</div>
				
			</aside>
		
			<script type='text/javascript'>
			$(document).ready(function(){
				var aside = ($('aside').height()+100);
				$('article').css({ 'min-height': ''+(aside)+'px' });
			});
			</script>
