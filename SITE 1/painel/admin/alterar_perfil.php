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

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->


<div id="conte">
<div id="local">
Paginas &raquo; Editar Perfil
</div><!--local-->

<?php

if(isset($_POST['change']) && $_POST['change'] == 'ok'){
	
	$update = mysql_query("UPDATE painel_users SET nome = '$_POST[nome]', email = '$_POST[email]', senha = '$_POST[senha]', avatar = '$_POST[avatar]', online = '$_POST[status]' WHERE usuario = '$_SESSION[user]'") or die (mysql_error());
	if($update == '1'){
		echo "<script>alert('Alterado Com Sucesso!')</script>";	
	}else{
		echo "<script>alert('Nao Foi possivel alterar seu perfil')</script>";	
	}
}
?>

<?php
$session = $_SESSION['user'];

$select = mysql_query("SELECT * FROM painel_users WHERE usuario = '$session'") or die (mysql_error());
while($res_perfil = mysql_fetch_array($select)){
	
?>
<form action="" method="post" name="change_perfil" id="change_perfil">
<table width="400" border="0">
  <tr>
    <td>Altera Nome:</td>
  </tr>
  <tr>
    <td><label for="nome"></label>
      <input type="text" name="nome" id="nome" value="<?php echo $res_perfil['nome'] ?>"/></td>
  </tr>
  <tr>
    <td>Alterar Email:</td>
  </tr>
  <tr>
    <td><label for="email"></label>
      <input type="text" name="email" id="email" value="<?php echo $res_perfil['email'] ?>"/></td>
  </tr>
  <tr>
    <td>Alterar Senha:</td>
  </tr>
  <tr>
    <td><label for="senha"></label>
      <input type="password" name="senha" id="senha" value="<?php echo $res_perfil['senha'] ?>" /></td>
  </tr>
  <tr>
    <td>Avatar: 120x120 *<a href="http://imgur.com" target="_blank">Hospedar Imagem</a>*</td>
  </tr>
  <tr>
    <td><label for="avatar"></label>
      <input name="avatar" type="text" id="avatar" value="<?php echo $res_perfil['avatar'] ?>" /></td>
  </tr>
  <tr>
    <td>Alterar Status:</td>
  </tr>
  <tr>
    <td><select name="status" id="status5">
      <option value="<?php echo $res_perfil['online'] ?>">Atualmente <?php echo $res_perfil['online'] ?></option>
      <option value="Online">Disponivel</option>
      <option value="ocupado">Ocupado</option>
      <option value="ausente">Ausente</option>
      <option value="invis">Invisivel</option>
    </select></td>
  </tr>
  <tr>
    <td><input type="hidden" name="change" value="ok" />
      <input type="submit" name="button" id="button" value="Atualizar Dados" class="btn"/></td>
  </tr>
</table>
</form>

<?php
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