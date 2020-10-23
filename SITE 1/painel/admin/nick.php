<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Trocar Nick</div>
<br />
<form action="" method="post" name="forme" id="do">
<table width="350" border="0">
  <tr>
    <td><strong>Usuario:</strong></td>
  </tr>
  <tr>
    <td><label>
      <input type="text" name="account" id="account" />
    </label></td>
  </tr>
  <tr>
    <td><strong>Nome Antigo:</strong></td>
  </tr>
  <tr>
    <td><label>
      <input type="text" name="nome" id="nome" />
    </label></td>
  </tr>
  <tr>
    <td><strong>Novo Nome:</strong></td>
  </tr>
  <tr>
    <td><label>
      <input type="text" name="new" id="new" />
    </label></td>
  </tr>
  <tr>
    <td>
    <input type="hidden" name="walker" value="ok" />
    <input type="submit" name="button" id="button" value="Alterar Nick" class="btn"/></td>
  </tr>
</table>
</form>

<?php

if(isset($_POST['walker']) && $_POST['walker'] == 'ok'){

$veri = mysql_query("SELECT * FROM characters WHERE account_name = '$_POST[account]' AND char_name = '$_POST[nome]'") 	
						or die (mysql_error());
						
if(@mysql_num_rows($veri) == '1'){
	
$koa = mysql_query("SELECT * FROM characters WHERE char_name = '$_POST[new]'") 
			or die (mysql_error());
	
	if(@mysql_num_rows($koa) == '0'){
		
		$up = mysql_query("UPDATE characters SET char_name = '$_POST[new]' WHERE char_name = '$_POST[nome]'") or die (mysql_error());	
		
	if($up >= '1'){
		echo "<script>alert('Nome Alterado Com Sucesso')</script>";	
	}
	}else{
		echo "<script>alert('Nome Ja Existente')</script>";	
	}
}else{
	
	echo "<script>alert('Dados Incorretos')</script>";	
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