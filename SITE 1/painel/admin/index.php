<?php
session_start();
if(!isset($_SESSION['user'])){
	header("location: ../index.php");		
	exit;
}
?>
<?php include"paginas/header.php"; ?>

<div id="content">

<div id="conteudo">

<?php

if(isset($_GET['limpar']) && $_GET['limpar'] == 'mural'){
	
$del = mysql_query("DELETE FROM painel_recados") or die ("error");	
if($del >= '1'){
	echo "<script>alert('Mural Limpo Com Sucesso!')</script>";	
}
}
?>

<?php

if(isset($_GET['deletar_c']) && $_GET['deletar_c'] == 'cha'){

$sele_d = mysql_query("SELECT * FROM characters WHERE level = '1'") or die (mysql_error());
$co = mysql_num_rows($sele_d);

$deles = mysql_query("DELETE FROM characters WHERE level = '1'") or die (mysql_error());
if($deles == '1'){
	echo "<script>alert('$co Characters Foram excluidos')</script>";	
}else{
	echo "<script>alert('error ao excluir characters')</script>";	
}
echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
}
?>
<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">
<?php include"paginas/home.php"; ?>
</div><!--conte-->

</div><!--conteudo-->

</div><!--content-->

<div id="footer">

</div><!--footer-->

</div><!--box-->

</body>
</html>