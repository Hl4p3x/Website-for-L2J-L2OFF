<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Usuarios &raquo; Listar Usuarios:</div>
<br />

<?php
if(isset($_POST['ex2']) && $_POST['ex2'] == 'Excluir'){

$delete = mysql_query("DELETE FROM painel_users WHERE id = '$_POST[id_ex]' AND usuario != '$_SESSION[user]'") or die (mysql_error());
if($delete >= '1'){
	
	echo "<script>alert('Excluido Com Sucesso!')</script>";

}else{
	echo "<script>alert('Error')</script>";
}

}
?>

<?php

$selecio_us = mysql_query("SELECT * FROM painel_users") or die (mysql_error());
while($res_user = mysql_fetch_object($selecio_us)){
	
?>

<table width="600" border="0" id="users" class="baixa">
  <tr>
    <td width="49" rowspan="2"><img src="<?php echo $res_user->avatar ?>" width="40" height="40" class="imgs"/></td>
    <td width="367"><?php echo $res_user->usuario ?></td>
    <td width="90" rowspan="2">
    <form action="" method="post" name="ex" id="ex">
      <input type="submit" name="ex2" id="ex2" value="Excluir" />
      <input type="hidden" name="eddd" value="ok" />
      <input type="hidden" name="id_ex" value="<?php echo $res_user->id ?>" />
    </form>
    </td>
    <td width="74" rowspan="2">
    <div id="edit">
	  <a href="edit.php?id=<?php echo $res_user->id ?>">Editar </a></tr>
    </div>
  <tr>
    <td valign="top"><?php echo $res_user->email ?></td>
    </tr>
</table>

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