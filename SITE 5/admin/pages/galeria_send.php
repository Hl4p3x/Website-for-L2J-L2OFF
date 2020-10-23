<?php if($indexing == 1) {
	
	if(!empty($_POST['glink'])) {
		
		
		$link = trim(addslashes(htmlentities($_POST['glink'])));
		
		if(substr($link, 0, 16) == 'http://youtu.be/') {

			$videoid = substr($link, 16);

		} elseif((substr($link, 0, 7) != 'http://')&&(substr($link, 0, 12) != 'youtube.com/')&&(substr($link, 0, 16) != 'www.youtube.com/')&&(strlen($link) < 13)) {
			
			$videoid = $link;

		} else {

			$explink = explode("?v=", $link);
			if(!empty($explink[1])) {
				$trat1 = $explink[1];
			} else {
				$explink2 = explode("&v=", $link);
				$trat1 = $explink2[1];
			}
			
			$explink2 = explode("&", $trat1);
			$videoid = $explink2[0];

		}
		
		$selectgal = mysql_query("SELECT * FROM ".DBNAME.".site_galeria WHERE g_position != '0' ORDER BY g_position ASC", $conexao);
		if(mysql_num_rows($selectgal) > 0) {
			$i=1;
			while($pp1=mysql_fetch_array($selectgal)) {
				mysql_query("UPDATE ".DBNAME.".site_galeria SET g_position = '".($i+1)."' WHERE g_id = '".$pp1['g_id']."'", $conexao);
				$i++;
			}
		}
		
		$insertgalleryvideo = mysql_query("INSERT INTO ".DBNAME.".site_galeria (g_id, g_position, g_isvideo) VALUES ('".$videoid."', '1', '1')", $conexao);
		if($insertgalleryvideo == 1) {
			echo "<script type='text/javascript'>document.location.replace('?id=galeria&success');</script>";
		} else {
			echo "<script type='text/javascript'>alert('Ops, ocorreu algum erro! Entre em contato com a Atualstudio!');history.back();</script>";
		}
		
		
		
	} else {
		echo "<script type='text/javascript'>document.location.replace('?id=galeria&success');</script>";
	}
	
} ?>