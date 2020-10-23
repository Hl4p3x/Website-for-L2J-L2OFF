<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Hero Status</div>
<br />
<form action="" method="post" name="hero" id="do" enctype="multipart/form-data">

  <table width="450" border="0">
    <tr>
      <td>Usuario:</td>
    </tr>
    <tr>
      <td><label for="rec_usuarios"></label>
        <input type="text" name="rec_usuarios" id="rec_usuarios" /></td>
    </tr>
    <tr>
      <td>Nome:</td>
    </tr>
    <tr>
      <td><label for="rec_nome"></label>
        <input type="text" name="rec_nome" id="rec_nome" /></td>
    </tr>
    <tr>
      <td>Recomendações</td>
    </tr>
    <tr>
      <td><label for="rec"></label>
        <input name="rec" type="text" id="rec" maxlength="3" /></td>
    </tr>
    <tr>
      <td>
      <input type="hidden" name="reco" value="su" />
      <input name="button" type="submit" class="btn" id="button" value="Atualizar" /></td>
    </tr>
  </table>
</form>


<?php
if(isset($_POST['reco']) && $_POST['reco'] == 'su'){
	
$rec_user = $_POST['rec_usuarios'];
$rec_nome = $_POST['rec_nome'];
$recs = $_POST['rec'];

$verificar_re = mysql_query("SELECT * FROM characters WHERE account_name = '$rec_user' AND char_name = '$rec_nome'") or die (mysql_error());

if(@mysql_num_rows($verificar_re) >= '1'){

$alterar_recs = mysql_query("UPDATE characters SET rec_have = '$recs' WHERE account_name = '$rec_user' AND char_name = '$rec_nome'") or die (mysql_error());

if($alterar_recs == '1'){
	echo "<script>alert('$rec_nome Agora Tem $recs Recs')</script>";
}else{
	echo "<script>alert('Não foi possivel Alterar os recs de $rec_nome!')</script>";	
}

}else{

	echo "<script>alert('Character Não Existe!')</script>";

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