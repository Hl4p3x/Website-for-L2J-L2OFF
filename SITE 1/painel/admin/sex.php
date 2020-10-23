<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Alterar Sexo</div>
<br />
<form action="" method="post" name="sex" id="do">

<table width="450" border="0">
  <tr>
    <td>Usuario:</td>
  </tr>
  <tr>
    <td><label for="user_sex"></label>
      <input type="text" name="user_sex" id="user_sex" /></td>
  </tr>
  <tr>
    <td>Nome:</td>
  </tr>
  <tr>
    <td><label for="sex_name"></label>
      <input type="text" name="sex_name" id="sex_name" /></td>
  </tr>
  <tr>
    <td>Sexo:</td>
  </tr>
  <tr>
    <td>
    <select name="sexs" id="select">
    <option value="0">Masculino</option>
    <option value="1">Feminino</option>    
    </select>
    </td>
  </tr>
  <tr>
    <td>
    <input type="hidden" name="sex" value="ok" />
    <input name="button" type="submit" class="btn" id="button" value="Alterar" /></td>
  </tr>
</table>
</form>

<?php
 
if(isset($_POST['sex'])){


$select_sex = mysql_query("SELECT * FROM characters WHERE account_name = '$_POST[user_sex]' AND char_name = '$_POST[sex_name]'") or die (mysql_error());

if(@mysql_num_rows($select_sex) == '1'){
	
	$up_sex = mysql_query("UPDATE characters SET sex = '$_POST[sexs]' WHERE account_name = '$_POST[user_sex]' AND char_name = '$_POST[sex_name]'") or die (mysql_error());
	if($up_sex >= '1'){
		echo "<script>alert('Sexo alterado com sucesso!')</script>";	
	}else{
		echo "<script>alert('Error ao alterar sexo!')</script>";	
	}
}else{

echo "<script>alert('Usuario Ou Nome Incorretos!')</script>";

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