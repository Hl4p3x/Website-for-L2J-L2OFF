<?php if($indexing == 1) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--

	Painel desenvolvido por Ramon Costa
	Atualstudio - www.atualstudio.com

-->

<?php
/* **********************************************************
 *   Não modifique nada! Você não tem permissão para isso.  * 
 ********************************************************** */
?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="description" content="Painel Administrativo - Gerenciamento de funcionalidades do site do cliente Atualstudio"/>
<link rel="shortcut icon" href="imgs/favicon.ico">
<title>Atualstudio Web Admin 2.0 - atualstudio.com</title>
<meta property="og:title" content="Atualstudio Web Admin 2.0 - atualstudio.com" />
<meta property="og:site_name" content="Atualstudio Web Admin 2.0" />
<meta property="og:type" content="website" />
<meta property="og:description" content="Painel Administrativo - Gerenciamento de funcionalidades do site do cliente Atualstudio" />
<link rel="stylesheet" type="text/css" href="css/global.css" media="screen" />
<meta name="robots" content="noindex,nofollow,noarchive" />

<?php if(($id == 'galeria')&&(isset($_GET['inserir']))) { ?>
	
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">

$(function(){
	$("#swfupload-control").swfupload({
		upload_url: "./engine/up/upload-file.php",
		file_post_name: "uploadfile",
		file_size_limit : 0,
		file_types : "*.jpg;*.png;*.gif;*.bmp;",
		file_types_description : "Image files",
		file_upload_limit : 0,
		flash_url : "./engine/up/js/swfupload/swfupload.swf",
		button_image_url : "./engine/up/js/swfupload/buttons.png",
		button_width : 199,
		button_height : 32,
		button_placeholder : $("#button")[0],
		debug: false
	})
	.bind("fileQueued", function(event, file){
		var listitem="<li id=\""+file.id+"\" >"+
		"Arquivo: <em>"+file.name+"</em> ("+Math.round(file.size/1024)+" KB) <span class=\"progressvalue\" ></span>"+
		"<div class=\"progressbar\" ><div class=\"progress\" ></div></div>"+
		"</li>";
		$("#log").append(listitem);
		$(this).swfupload("startUpload");
	})
	.bind("uploadStart", function(event, file){
		$("#log li#"+file.id).find("span.progressvalue").text("0%");
	})
	.bind("uploadProgress", function(event, file, bytesLoaded){
		//Show Progress
		var percentage=Math.round((bytesLoaded/file.size)*100);
		$("#log li#"+file.id).find("div.progress").css("width", percentage+"%");
		$("#log li#"+file.id).find("span.progressvalue").text(percentage+"%");
	})
	.bind("uploadSuccess", function(event, file, serverData){
		var item=$("#log li#"+file.id);
		item.find("div.progress").css("width", "100%");
		item.find("span.progressvalue").text("100%");


		item.addClass("success");
		idfile = file.id;
	})
	.bind("uploadComplete", function(event, file){
		$(this).swfupload("startUpload");
	})
});


</script>
<script type="text/javascript" src="./engine/up/js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="./engine/up/js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="./engine/up/js/jquery.swfupload.js"></script>
<style type="text/css" >
#swfupload-control p{ margin:10px 5px; font-size:0.9em; }
#log{ margin:0; padding:0; width:500px;}
#log li{ list-style-position:inside; margin:2px; border:1px solid #ccc; padding:10px; font-size:12px; 
	font-family:Arial, Helvetica, sans-serif; color:#333; background:#fff; position:relative;}
#log li .progressbar{ border:1px solid #333; height:5px; background:#fff; }
#log li .progress{ background:#999; width:0%; height:5px; }
#log li p{ margin:0; line-height:18px; }
#log li.success{ border:1px solid #339933; background:#ccf9b9; }
</style>

<?php } elseif($id == 'galeria') { ?>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
						   
	$(function() {
		$("#galeria").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize"); 
			$.post("pages/gallery_update_db.php", order, function(theResponse){
			}); 															 
		}
		});
	});

});

</script>
<?php } elseif($id == 'banners') { ?>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
						   
	$(function() {
		$("#banners").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize"); 
			$.post("pages/banners_update_db.php", order, function(theResponse){
				var CountLis = $('ul#banners li').length;
				for(i=0; i < CountLis; i++) {
					$('ul#banners li').eq(i).children('div').children('span').text(parseInt(i+1));
				}
			});
		}								  
		});
	});

});

</script>
<?php } elseif($id == 'login') { ?>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<?php } else { ?>
<script type="text/javascript" src="js/jquery.min_1.9.1.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/mask.js"></script>
<script src="js/ckeditor/ckeditor.js"></script>
<script src="js/ckeditor/config.js"></script>
<?php } ?>

</head>
<body>
	
	<?php $conexao = @mysql_connect(DBHOST, DBUSER, DBPASS); if(substr(SITGMT, 0, 1) == '-') { define('GMTN', substr(SITGMT, 1)); } else if(substr(SITGMT, 0, 1) == '+') { define('GMTN',  "-".substr(SITGMT, 1)); } else { define('GMTN', "-".SITGMT); } define('GMTF', GMTN*3600); ?>
	
	<div class='atualstudio_web_admin'>
		
		<div class='toparea'>
			<a href='./' class='awa'></a>
		</div>
		
		<?php if($id == 'login') { ?>
		
			<div class='loginarea'>
				<div>
					<h1 style='padding: 30px 0 0 50px;color: #5a5a5a;'>Qual é a senha de acesso?</h1>
					<div style='display: table; margin: 0 auto;'>
						<input type='hidden' id='form_url' value='<?php echo urlencode(trim($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'])); ?>' />
						<input type='password' id='form_pass' class='lpass' placeholder='Digite aqui' />
						<input type='button' id='form_submit' class='atualstudio_button lsubm' value='Acessar &raquo;' />
					</div>
				</div>
			</div>
		
		<?php } else { ?>

			<div class='opcoes'>
				<a href='./' class='home'></a>
				<a href='?logout' class='sair'></a>
			</div>
			
			<div class='contentarea'>
				<div class='top_part'></div>
				<div class='main_part'>
	
					<div class='menu_lateral'>
						<a href='?id=noticias'>Administrar Notícias</a>
						<a class='aGallery' href='?id=galeria'>Administrar Galeria <span class='notify' style='display: none;'>0</span></a>
						<a href='?id=banners'>Alterar Banners</a>
						<a href='?id=donates'>Doações</a>
						<a href='../'>Ir Para Seu Site</a>
					</div>
	
					<div class='conteudo'>
						<?php require('./pages/'.$id.'.php'); ?>
					</div>
					
					<?php if($id != 'galeria') {
						$aprovcount = mysql_num_rows(mysql_query("SELECT * FROM ".DBNAME.".site_galeria WHERE g_visivel = '0'", $conexao));
						if($aprovcount > 0) { echo "<script>$(document).ready(function(){ $('.aGallery span').text('".$aprovcount."').show(); });</script>"; }
					} ?>
	
				</div>
				<div class='bottom_part'></div>
			</div>
		
		<?php } ?>
		
		<div class='copyright'>
		Atualstudio Web Admin 2.0, powered by <a href='http://www.atualstudio.com' target='_blank'>Atualstudio</a><br />
			&copy; <?php echo date('Y'); ?> - Todos os direitos reservados
		</div>

	</div>

	<?php @mysql_close($conexao); ?>

</body>
</html>
<?php } ?>