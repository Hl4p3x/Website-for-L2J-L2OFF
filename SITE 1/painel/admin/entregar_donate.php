<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Entregar Doaçoes</div>
<br />
<?php
if($_POST['radioss'] == 'sim'){
?>

<form action="" method="post" name="do" id="do">
<table width="400" border="0">
  <tr>
    <td colspan="2">Nome:</td>
    </tr>
  <tr>
    <td colspan="2"><label for="nome"></label>
      <input type="text" name="nome" id="nome" value="<?php echo $_POST['nome'] ?>"/></td>
    </tr>
  <tr>
    <td colspan="2">Iten ID:</td>
    </tr>
  <tr>
    <td colspan="2"><label for="id">
      <input type="text" name="iten_id" id="iten_id" value="<?php echo $_POST['iten_id'] ?>"/>
    </label></td>
    </tr>
  <tr>
    <td colspan="2">Quantidade:</td>
    </tr>
  <tr>
    <td colspan="2">
      <input type="text" name="count" id="count" value="<?php echo $_POST['count'] ?>"/>
   	</td>
    </tr>
  <tr>
    <td colspan="2">Enchant:</td>
    </tr>
  <tr>
    <td colspan="2"><label for="count">
      <input type="text" name="enchant" id="enchant" value="<?php echo $_POST['enchant'] ?>"/>
    </label></td>
    </tr>
  <tr>
    <td width="124"><input type="hidden" name="cad" value="oks" /> 
    <input type="submit" name="button" id="button" value="Entregar" class="btn"/></td>
    <td width="266">Salvar Dados? 
    <input type="radio" name="radioss" id="radio" value="sim" checked="checked"/>
    Sim
    <input type="radio" name="radioss" id="radio" value="nao" ch/>
    Não
    </td>
    </tr>
</table>
</form>

<?php
}else{
?>

<form action="" method="post" name="do" id="do">
<table width="400" border="0">
  <tr>
    <td colspan="2">Nome:</td>
    </tr>
  <tr>
    <td colspan="2">
      <input type="text" name="nome" id="nome" /></td>
    </tr>
  <tr>
    <td colspan="2">Iten ID:</td>
    </tr>
  <tr>
    <td colspan="2">
      <input type="text" name="iten_id" id="iten_id" />
   </td>
    </tr>
  <tr>
    <td colspan="2">Quantidade:</td>
    </tr>
  <tr>
    <td colspan="2">
      <input type="text" name="count" id="count" />
    </td>
    </tr>
  <tr>
    <td colspan="2">Enchant:</td>
    </tr>
  <tr>
    <td colspan="2">
      <input type="text" name="enchant" id="enchant" />
    </td>
    </tr>
  <tr>
    <td width="124"><input type="hidden" name="cad" value="oks" /> 
    <input type="submit" name="button" id="button" value="Entregar" class="btn"/></td>
    <td width="266">Salvar Dados? 
    <input type="radio" name="radioss" id="radio" value="sim" />
    Sim
    <input type="radio" name="radioss" id="radio" value="nao" checked="checked"/>
    Não
    </td>
    </tr>
</table>
</form>


<?php
}
?>

<?php
if(isset($_POST['cad']) && $_POST['cad'] == 'oks'){

$veri = mysql_query("SELECT * FROM items WHERE object_id = '$_POST[id]'") or die (mysql_error());
if(@mysql_num_rows($veri) >= '1'){
	echo "<script>alert('ID ja existe')</script>";	
}else{
$select = mysql_query("SELECT * FROM characters WHERE char_name = '$_POST[nome]'") or die (mysql_error());
if(@mysql_num_rows($select) >= '1'){
	
while($res = mysql_fetch_array($select)){	
	$id_owner = $res['obj_Id'];	

$sele = mysql_query("SELECT * FROM items ORDER BY object_id DESC");
$res_sele = mysql_fetch_object($sele);
$geraid = $res_sele->object_id + 1000;
}
?>

<?php
$insert = mysql_query("INSERT INTO items VALUES ('$id_owner', '$geraid', '$_POST[iten_id]', '$_POST[count]', '$_POST[enchant]',  'INVENTORY', 0, 0, 0, NULL, 0, 0, -1)") or die (mysql_error());
if($insert >= '1'){
	echo "<script>alert('Entregue Com Sucesso!')</script>";	
}else{
	echo "<script>alert('Error ao entregar Itens tente novamente')</script>";	
}
?>

<?php	
}else{
	echo "<script>alert('Usuario Não Existe')</script>";	
}
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