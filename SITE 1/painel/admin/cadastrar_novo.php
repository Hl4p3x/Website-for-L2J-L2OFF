<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">
<div id="local">Usuarios &raquo; Cadastrar Novo</div>
<br />
<?php
if(isset($_POST['cadastra']) && $_POST['cadastra'] == 'ok'){
	
$select = mysql_query("SELECT * FROM painel_users WHERE usuario = '$_POST[user]'") or die(mysql_error());
if(@mysql_num_rows($select) >= '1'){
	echo "<script>alert('Usuario Ja existente')</script>";	
}else{
	
	$retorno = "Preencha Todos os campos";
	
	if($_POST['nome'] == ''){
		echo "<script>alert('$retorno')</script>";
		
	}elseif($_POST['email'] == ''){
		echo "<script>alert('$retorno')</script>";
		
	}elseif($_POST['user'] == ''){
		echo "<script>alert('$retorno')</script>";
		
	}elseif($_POST['senha'] == ''){
		echo "<script>alert('$retorno')</script>";
	}else{
		
	$data = date ("d/m/Y");
	$cadastrar_novo = mysql_query("INSERT INTO painel_users (nome,email,usuario,senha,status,online,cadastrado_em, avatar) VALUES ('$_POST[nome]', '$_POST[email]', '$_POST[user]', '$_POST[senha]', '$_POST[status]', 'off', '$data', 'http://i.imgur.com/YqhO1.jpg')") or die (mysql_error());
	
if($cadastrar_novo >= '1'){
	echo "<script>alert('Cadastrado Com Sucesso')</script>";	
}else{
	echo "<script>alert('Error ao Cadastrar usuario')</script>";
}
}
}
}
?>
<form action="" method="post" name="change" id="change_perfil">
<table width="400" border="0">
  <tr>
    <td>Nome:</td>
  </tr>
  <tr>
    <td><label for="nome"></label>
      <input type="text" name="nome" id="nome" /></td>
  </tr>
  <tr>
    <td> Email:</td>
  </tr>
  <tr>
    <td><label for="email"></label>
      <input type="text" name="email" id="email" /></td>
  </tr>
  <tr>
    <td>Usuario:</td>
  </tr>
  <tr>
    <td><label for="user"></label>
      <input type="text" name="user" id="user" />      <label for="senha"></label></td>
  </tr>
  <tr>
    <td>Senha:</td>
  </tr>
  <tr>
    <td><label for="senha2"></label>
      <input type="password" name="senha" id="senha2" /></td>
  </tr>
  <tr>
    <td>Status:</td>
  </tr>
  <tr>
    <td>
    <select name="status" id="status5">
    <option value="admin">Administrador</option>    
    <option value="gm">Game Master</option>  
    </select>
    </td>
  </tr>
  <tr>
    <td>
    <input type="hidden" name="cadastra" value="ok" />
    <input name="button" type="submit" class="btn" id="button" value="Cadastrar" /></td>
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