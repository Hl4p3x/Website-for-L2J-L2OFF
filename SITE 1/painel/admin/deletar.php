<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Deletar Characters Lv 1</div>
<form action="" method="post" name="de" id="do">
<input type="submit" name="excluir" value="Deletar" class="btn"/>
</form>
<br />
<?php

if(isset($_POST['excluir']) && $_POST['excluir'] == 'Deletar'){

$sele_d = mysql_query("SELECT * FROM characters WHERE level = '1'") or die (mysql_error());
$co = mysql_num_rows($sele_d);

$deles = mysql_query("DELETE FROM characters WHERE level = '1'") or die (mysql_error());
if($deles == '1'){
	echo "<script>alert('$co Characters Foram excluidos')</script>";	
}else{
	echo "<script>alert('error ao excluir characters')</script>";	
}

}
?>

</div><!--conte-->

</div><!--conteudo-->

</div><!--content-->

<div id="footer">

</div><!--footer-->

</div><!--box-->

</body>
</html>