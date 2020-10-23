<?php if(!$indexing) { exit; }

if($admin_access != 1) { ?>

<!DOCTYPE html>
<html>
<head>
	<!--
	
	Desenvolvido pela Atualstudio
	www.atualstudio.com
	
	          ##########
	       ################
	    ######          ######
	   #####              #####
	  ####         ....    ####
	 ####        ########  ####
	 ####       ########## ####
	  ####      ########## ####
	  #####       ######## ####
	   #####        ****** ####
	     ######################
	         ################
			 
	-->
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta name="description" content="Painel Administrativo de sites de Lineage 2 desenvolvidos pela Atualstudio.com"/>
	<meta http-equiv="content-language" content="pt-br" />
	<title>Atualstudio Web Admin 3.0</title>
	<meta name="author" content="Atualstudio" />
	<meta name="reply-to" content="contato@atualstudio.com" />
	<meta name="language" content="Portuguese" />
	<meta name="copyright" content="Atualstudio" />
	<meta name="distribution" content="Global" />
	<meta name="google" content="notranslate" />
	<meta property="og:title" content="Atualstudio Web Admin 3.0" />
	<meta property="og:site_name" content="Atualstudio Web Admin 3.0" />
	<meta property="og:description" content="Painel Administrativo de sites de Lineage 2 desenvolvidos pela Atualstudio.com" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="layout/dist/img/image_src.jpg" />
	<link rel="shortcut icon" href="layout/dist/img/favicon.ico">
	<link rel="image_src" href="layout/dist/img/image_src.jpg" />
	<link rel="stylesheet" href="layout/dist/css/global.css">
	<script src="layout/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	

</head>
<body class='login'>
	
	<div class='passArea'>
		<div>
			<div class='wadm30'></div>
			<div class='ball'></div>
			<input id='password' type='password' placeholder='Senha' autocomplete='off' />
			<div title='Acessar' id='submit'></div>
		</div>
	</div>
	
	<div class='copyright'>
		&copy; <?php echo date('Y'); ?> <a href='http://www.atualstudio.com' target='_blank'>Atualstudio</a> - All rights reserved 
	</div>
	
	<script src="layout/dist/js/login.js"></script>
	
</body>
</html>

<?php
} else {
?>

<!DOCTYPE html>
<html>
<head>
	<!--
	
	Desenvolvido pela Atualstudio
	www.atualstudio.com
	
	          ##########
	       ################
	    ######          ######
	   #####              #####
	  ####         ....    ####
	 ####        ########  ####
	 ####       ########## ####
	  ####      ########## ####
	  #####       ######## ####
	   #####        ****** ####
	     ######################
	         ################
			 
	-->
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="imagetoolbar" content="no" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta http-equiv="content-language" content="pt-br" />
	<title>Atualstudio Web Admin 3.0</title>
	<meta name="author" content="Atualstudio" />
	<meta name="reply-to" content="contato@atualstudio.com" />
	<meta name="language" content="Portuguese" />
	<meta name="copyright" content="Atualstudio" />
	<meta name="distribution" content="Global" />
	<meta name="google" content="notranslate" />
	
	<link rel="shortcut icon" href="layout/dist/img/favicon.ico">
	<link rel="image_src" href="layout/dist/img/image_src.jpg" />

	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="layout/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="layout/dist/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="layout/dist/css/ionicons.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="layout/plugins/select2/select2.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="layout/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins -->
	<link rel="stylesheet" href="layout/dist/css/skin-blue.min.css">
 	<!-- Global CSS -->
	<link rel="stylesheet" href="layout/dist/css/global.css">
	
	<!-- jQuery 2.1.4 -->
	<script src="layout/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	
	<style type="text/css">
		@media all and (max-width: 960px){
			.wrapper { overflow: auto !important; } 
		}
	</style>

</head>
<body class="hold-transition skin-blue sidebar-mini<?php echo (!empty($_COOKIE['sidebarCollapse']) ? (intval($_COOKIE['sidebarCollapse']) == 1 ? ' sidebar-collapse' : '') : '') . (!empty($_COOKIE['layoutBoxed']) ? (intval($_COOKIE['layoutBoxed']) == 1 ? ' layout-boxed' : '') : ''); ?>">
	
	<div class="wrapper">

		<header class="main-header">

			<a href="./" class="logo">
				<span class="logo-mini"><img src='layout/dist/img/awa3_mini.png' /></span>
				<span class="logo-lg"><img src='layout/dist/img/awa3.png' /></span>
			</a>

			<nav class="navbar navbar-static-top" role="navigation">
				
				<!-- Botão que minimiza menu lateral -->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span></a>
				
				<!-- Opções visuais do painel -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="layout/dist/img/avatar.png" class="user-image" />
								<span class="hidden-xs">Administrador</span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="layout/dist/img/avatar.png" class="img-circle" />
									<p>
										Usuário Administrador
										<small>Desenvolvido por <a style='color: #fff;' href='http://www.atualstudio.com' target='_blank'>Atualstudio.com</a></small>
									</p>
								</li>
							</ul>
						</li>
						<li>
							<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
						</li>
					</ul>
				</div>

			</nav>
			
		</header>
		
		<!-- Menu lateral -->
		<aside class="main-sidebar">

			<section class="sidebar">

				<!-- Opções -->
				<ul class="sidebar-menu">
					
					<li class="header">MENU</li>
					
					<li class="<?php echo ($m == '' && $p == 'index' ? ' active' : ''); ?>">
						<a href="./"><i class="fa fa-home"></i> <span>Dashboard</span></a>
					</li> 

					<li class="treeview<?php echo ($m == 'donate/' ? ' active' : ''); ?>">
						<a href="#"><i class="fa fa-money"></i> <span>Doações</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href='?page=list_all&module=donate'>Visualizar Doações</a></li>
							<li><a href='?page=list_pending&module=donate'>Doações Pendentes</a></li>
							<li><a href='?page=list_relat&module=donate'>Relatório</a></li>
						</ul>
					</li>
					
					<li class="treeview<?php echo ($m == 'news/' ? ' active' : ''); ?>">
						<a href="#"><i class="fa fa-newspaper-o"></i> <span>Notícias</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href='?page=list&module=news'>Visualizar Notícias</a></li>
							<li><a href='?page=add&module=news'>Adicionar Notícia</a></li>
						</ul>
					</li>

					<li class="treeview<?php echo ($m == 'banners/' ? ' active' : ''); ?>">
						<a href="#"><i class="fa fa-object-group"></i> <span>Banners</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href='?page=list&module=banners'>Visualizar Banners</a></li>
							<li><a href='?page=add&module=banners'>Adicionar Banner</a></li>
						</ul>
					</li>

					<?php
					$countNotifis = DB::Executa("SELECT COUNT(*) AS quant FROM site_gallery WHERE vis = '0'");
					$countNotifis = intval($countNotifis[0]['quant']);
					if($countNotifis > 99) { $countNotifis = '99'; }
					?>
					<li class="treeview<?php echo ($m == 'gallery/' ? ' active' : ''); ?>">
						<a href="#"><i class="fa fa-image"></i> <span>Galeria<?php echo ($countNotifis > 0 ? "<div>".$countNotifis."</div>" : ""); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href='?page=list&module=gallery'>Visualizar Galeria <?php echo ($countNotifis > 0 ? "(".$countNotifis.")" : ""); ?></a></li>
							<li><a href='?page=addimg&module=gallery'>Adicionar Imagem</a></li>
							<li><a href='?page=addvideo&module=gallery'>Adicionar Vídeo</a></li>
						</ul>
					</li>

					<li class="treeview<?php echo ($m == 'logs/' ? ' active' : ''); ?>">
						<a href="#"><i class="fa fa-file-text-o"></i> <span>Logs</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href='?page=donate&module=logs'>Doações</a></li>
							<li><a href='?page=admin&module=logs'>Admin</a></li>
						</ul>
					</li>

					<li>
						<a href="../"><i class="fa fa-reply"></i> <span>Seu site</span></a>
					</li> 

					<li>
						<a href="./?logout"><i class="fa fa-lock"></i> <span>Sair</span></a>
					</li> 

				</ul>
			</section>
			
		</aside>

		<div class="content-wrapper">
			
			<?php require('./pages/'.$p.'.php'); ?>
			
		</div>

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				Layout design by <strong>Almsaeed Studio</strong>
			</div>
			Atualstudio Web Admin 3.0 &nbsp;&bull;&nbsp; Developed by <strong>Atualstudio.com</strong>
		</footer>
		
		<aside class="control-sidebar control-sidebar-dark">
			<div class="tab-content">
				<div class="tab-pane" id="control-sidebar-home-tab"></div>
			</div>
		</aside>
		
	</div>
	
 	<!-- Select2 -->
	<script src="layout/plugins/select2/select2.full.min.js"></script>
	<script>$(function () { $(".select2").select2(); });</script>
	
    <!-- Bootstrap 3.3.5 -->
    <script src="layout/bootstrap/js/bootstrap.min.js"></script>
	
	<!-- AdminLTE App -->
	<script src="layout/dist/js/app.min.js"></script>
	
	<!-- AdminLTE JS -->
	<script src="layout/dist/js/AdminLTE.js"></script>
	
	<!-- JQuery Cookie -->
	<script src="layout/dist/js/jquery.cookie.js"></script>

	<!-- Global scripts -->
	<script src="layout/dist/js/global.js"></script>

	<?php
	if(!empty($_SESSION['aAlert_msg'])) {
		echo "<script>atualAlert('".$_SESSION['aAlert_msg']."', '".$_SESSION['aAlert_act']."', '');</script>";
		$_SESSION['aAlert_msg'] = ''; $_SESSION['aAlert_act'] = ''; unset($_SESSION['aAlert_msg']); unset($_SESSION['aAlert_act']);
	}
	?>

</body>
</html>

<?php } ?>