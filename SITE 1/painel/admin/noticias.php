<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Postar Noticias</div>
<br />
<form action="" method="post" name="cad" id="do">

<table width="600" border="0">
  <tr>
    <td colspan="3">Titulo:</td>
  </tr>
  <tr>
    <td colspan="3"><label for="titulo"></label>
      <input type="text" name="titulo" id="titulo" /></td>
  </tr>
  <tr>
    <td colspan="3">Noticia:</td>
  </tr>
  <tr>
    <td colspan="3"><label for="noticia"></label>
      <textarea name="noticia" id="noticia" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td width="160"><input name="button" type="submit" class="btn" id="button" value="Postar" /></td>
    <td width="196"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <div id="edit">
    <td width="230"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    </div>
  </tr>
</table>
</form>

<?php
if(isset($_POST['button']) && $_POST['button'] == 'Postar'){

$date = date('d/m/Y - H:i');

$in = mysql_query("INSERT INTO painel_noticias (titulo, autor, noticia, hora) VALUES
						('$_POST[titulo]', '$_SESSION[user]', '$_POST[noticia]', '$date')") or die (mysql_error());
	if($in == '1'){
		echo "<script>alert('Cadastrada com sucesso!')</script>";
	}else{
		echo "<script>alert('Error ao postar noticia!')</script>";	
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