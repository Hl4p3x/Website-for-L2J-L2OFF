<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Editar Usuario:</div>
<br />

<?php
$pegaid = $_GET['id'];
?>

<?php
if(isset($_POST['atu']) && $_POST['atu'] == 'ok'){

$update = mysql_query("UPDATE painel_users SET nome = '$_POST[nome]', email = '$_POST[email]', status = '$_POST[status]', avatar = '$_POST[avatar]' WHERE id = '$pegaid'") or die (mysql_error());
if($update == '1'){
	echo "<script>alert('Atualizado com Sucesso!')</script>";	
}else{
	echo "<script>alert('Error ao Atualizar!')</script>";
}
}
?>

<?php

$sele = mysql_query("SELECT * FROM painel_users WHERE id = '$pegaid'") or die(mysql_error());
while($res = mysql_fetch_object($sele)){
?>

<form action="" method="post" name="ed" id="do">

<table width="600" border="0">
  <tr>
    <td>Nome:</td>
  </tr>
  <tr>
    <td><label for="nome"></label>
      <input type="text" name="nome" id="nome" value="<?php echo $res->nome ?>"/></td>
  </tr>
  <tr>
    <td>Email:</td>
  </tr>
  <tr>
    <td><label for="email"></label>
      <input type="text" name="email" id="email" value="<?php echo $res->email ?>" /></td>
  </tr>
  <tr>
    <td>Nivel:</td>
  </tr>
  <tr>
    <td>
    <?php
	if($res->status == 'admin'){
	?>
    <select name="status" id="select">
    <option value="admin">Administrador</option>
    <option value="gm">Game Master</option>
    </select>
    <?php
	}else{	
	?>
    <select name="status" id="select">
    <option value="gm">Game Master</option>
    <option value="admin">Administrador</option>
    </select>
    <?php
	}
	?>
    </td>
  </tr>
  <tr>
    <td>Avatar:</td>
  </tr>
  <tr>
    <td><label for="avatar"></label>
      <input type="text" name="avatar" id="avatar" value="<?php echo $res->avatar ?>"/></td>
  </tr>
  <tr>
    <td>
    <input type="hidden" name="atu" value="ok" />
    <input name="button" type="submit" class="btn" id="button" value="Atualizar" /></td>
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