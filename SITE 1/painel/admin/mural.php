<?php include"paginas/header.php"; ?>
<div id="content">

<?php
if(isset($_POST['ec']) && $_POST['ec'] == 'ok'){
	
$delete = mysql_query("DELETE FROM painel_recados WHERE id = '$_POST[id_recado]'") or die (mysql_error());
if($delete >= '1'){
?>
<meta http-equiv="refresh" content="0; url=mural.php" />
<?php
}
}
?>
<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Comunicação &raquo; Mural De Recados</div>
<br />
<?php
if(isset($_POST['comentar']) && $_POST['comentar'] == 'ok'){

$data = date('d/m/Y - H:i');

$cadastrar_comentario = mysql_query("INSERT INTO painel_recados (usuario, recado, data) VALUES ('$_SESSION[user]', '$_POST[post]', '$data')") or die (mysql_error());
if($cadastrar_comentario == '1'){
?>

<meta http-equiv="refresh" content="0; url=mural.php" />

<?php
}
?>
<?php
}
?>

<form action="" method="post" name="coment" id="do">
<table width="400" border="0">
  <tr>
    <td><label for="post"></label>
      <textarea name="post" id="post" cols="45" rows="5"></textarea></td>
    </tr>
  <tr>
    <td>
    <input type="hidden" name="comentar" value="ok" />
    <input type="submit" name="button" id="button" value="Postar" class="btn"/></td>
    </tr>
</table>
</form>
<br />
<br />

<div class="recados">
<?php
$exibe_recados = mysql_query("SELECT * FROM painel_recados ORDER BY id DESC") or die (mysql_error());
if(@mysql_num_rows($exibe_recados) == '0'){
	echo "Nenhum Recado No Mural , Deixe O Seu !";	
}else{
while($res_recados = mysql_fetch_array($exibe_recados)){

$exibe_img = mysql_query("SELECT * FROM painel_users WHERE usuario = '$res_recados[usuario]'");
$res_img = mysql_fetch_array($exibe_img);

$selecrionar_e = mysql_query("SELECT * FROM painel_users WHERE usuario = '$_SESSION[user]'");
$exiv = mysql_fetch_object($selecrionar_e);
?>
<table width="624" border="0">
  <tr>
    <td width="44" rowspan="2" align="left" valign="top"><img src="<?php echo "$res_img[avatar]"; ?> width=" width="30"" height="30"/></td>
    <td width="500" valign="top"><h1><a href="profile.php?usuario=<?php echo "$res_recados[usuario]" ?>"><a href="profile.php?usuario=<?php echo "$res_recados[usuario]" ?>"><font style="font-size:16px"><?php echo "$res_recados[usuario]" ?></font></a></a> Disse Dia <?php echo "$res_recados[data]" ?></h1></td>
    <td width="66" align="right" valign="top">
    <?php
   	if($res_recados['usuario'] == $exiv->usuario){
	?>
    <form action="" method="post" name="exc" id="ds">
    <input type="submit" name="excluir_post" id="exdf" value="Excluir" class="btn"/>
    <input type="hidden" name="id_recado" value="<?php echo $res_recados['id'] ?>" />
    <input type="hidden" name="ec" value="ok" />
    </form>
    <?php
	}
    ?>
    </td>
    </tr>
  <tr>
    <td><h2><?php echo "$res_recados[recado]" ?></h2></td>
    <td>&nbsp;</td>
  </tr>
  </table>
<hr />
<?php
}
}
?>
</div><!--recados-->
<br />

</div><!--conte-->

</div><!--conteudo-->

</div><!--content-->

<div id="footer">

</div><!--footer-->

</div><!--box-->

</body>
</html>