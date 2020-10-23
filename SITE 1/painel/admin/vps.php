<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">


<div id="local">Paginas &raquo; Status Vip </div>
<br />
<?php
if(isset($_POST['vps']) && $_POST['vps'] == 'ok'){

$update = mysql_query("UPDATE characters SET accesslevel = '$_POST[acc]' WHERE account_name = '$_POST[user]' AND char_name = '$_POST[nome]'") or die (mysql_error());	
if($update >= '1'){
	echo "<script>alert('$_POST[nome] agora tem $_POST[acc] de accesslevel')</script>";	
}else{
	echo "<script>alert('Error Tente Novamente')</script>";	
}
}
?>
<form action="" method="post" name="vps" id="do">

<table width="450" border="0">
  <tr>
    <td>Usuario:</td>
    </tr>
  <tr>
    <td><label for="user"></label>
      <input type="text" name="user" id="user" /></td>
    </tr>
  <tr>
    <td>Nome Do Char:</td>
    </tr>
  <tr>
    <td><label for="nome"></label>
      <input type="text" name="nome" id="nome" /></td>
    </tr>
  <tr>
    <td>Accesslevel</td>
    </tr>
  <tr>
    <td><label for="acc"></label>
      <input type="text" name="acc" id="acc" /></td>
    </tr>
  <tr>
    <td>
    <input type="hidden" name="vps" value="ok" />
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