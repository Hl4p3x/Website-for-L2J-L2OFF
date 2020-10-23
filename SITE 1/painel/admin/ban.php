<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Ban e Unban</div>
<br />

<?php
if(isset($_POST['ban']) && $_POST['ban'] == 'banido'){
	
	$selecionar = mysql_query("SELECT * FROM characters WHERE char_name = '$_POST[usuario]'");
	if(@mysql_num_rows($selecionar) >= '1'){
	$fetc = mysql_fetch_object($selecionar);
	$alterar = mysql_query("UPDATE accounts SET access_level = '$_POST[assao]' WHERE login = '$fetc->account_name'");
	if($_POST['assao'] == '-100'){
		$retorno = "Banido Com Sucesso!";
	}elseif($_POST['assao'] == '0'){
		$retorno = "Desbanido Com Sucesso!";
	}
	if($alterar >= '1'){
		echo "<script>alert('$retorno')</script>";	
	}else{
		echo "Error ao banir character";	
	}
	
}else{
	echo "<script>alert('Character não existe')</script>";		
}
}
?>
<form action="" method="post" name="va" id="do">
<table width="450" border="0">
  <tr>
    <td>Nome:</td>
  </tr>
  <tr>
    <td><label for="usuario"></label>
      <input type="text" name="usuario" id="usuario" /></td>
  </tr>
  <tr>
    <td>Status:</td>
  </tr>
  <tr>
    <td>
    <select name="assao" id="select">
	<option value="-100">Banir</option>   
    <option value="0">Desbanir</option>   
    </select>
    </td>
  </tr>
  <tr>
    <td>
    <input type="hidden" name="ban" value="banido" />
    <input type="submit" name="button" id="button" value="Atualizar" class="btn"/></td>
  </tr>
</table>

</form>
</div><!--conte-->

</div><!--conteudo-->

</div><!--content-->

<div id="footer">

</div><!--footer-->

</div><!--box-->

</body>
</html>