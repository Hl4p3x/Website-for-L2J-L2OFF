<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Hero Status</div>
<br />

<?php
if(isset($_POST['nbs']) && $_POST['nbs'] == 'ok'){

$nb_user = $_POST['nb_user'];
$nb_nome = $_POST['nb_name'];
$bovl = $_POST['nbo'];

$verificar_nb = mysql_query("SELECT * FROM characters WHERE account_name = '$nb_user' AND char_name = '$nb_nome'") or die (mysql_error());

if(@mysql_num_rows($verificar_nb) == '1'){
	
	$alterar_nb = mysql_query("UPDATE characters SET nobless = '$bovl' WHERE account_name = '$nb_user' AND char_name = '$nb_nome'") or die (mysql_error());

if($_POST['nbo'] == '1'){
	$re = "$nb_nome Agora e Nobles!";
}elseif($_POST['nbo'] == '0'){	
	$re = "$nb_nome Não E Mais Nobles";	
}

if($alterar_nb == '1'){
	
	echo "<script>alert('$re')</script>";	
}else{
	
	echo "Error ao dar status";	
}

}else{
	echo "<script>alert('Character Não Existe!')</script>";
}
}
?>

<form action="" method="post" name="nobles" id="do">

<table width="450" border="0">
  <tr>
    <td>Usuario</td>
  </tr>
  <tr>
    <td><label for="nb_user"></label>
      <input type="text" name="nb_user" id="nb_user" /></td>
  </tr>
  <tr>
    <td>Nome:</td>
  </tr>
  <tr>
    <td><label for="nb_name"></label>
      <input type="text" name="nb_name" id="nb_name" /></td>
  </tr>
  <tr>
    <td>Nobles</td>
  </tr>
  <tr>
    <td>
    <select name="nbo" id="select">
    <option value="" selected="selected">Escolher Opções</option>
    <option value="1">Adicionar Nobles Status</option>
    <option value="0">Remover Nobles Status</option>
    </select>
    </td>
  </tr>
  <tr>
    <td>
    <input type="hidden" name="nbs" value="ok" />
    <input name="button" type="submit" class="btn" id="button" value="Atualizar" /></td>
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