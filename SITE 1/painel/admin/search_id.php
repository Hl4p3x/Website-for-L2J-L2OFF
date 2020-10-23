<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Buscar ID</div>
<br />
<form action="" method="get" name="search" id="search" enctype="multipart/form-data">
<input type="text" name="s" id="s" value="<?php echo $_GET['s'] ?>"/>

<?php
if($_GET['categoria'] == 'Armaduras'){

?>
<select name="categoria" id="search_cat">
<option>Armaduras</option>
<option>Armas</option>
<option>Itens</option>
</select>

<?php
}elseif($_GET['categoria'] == 'Armas'){
?>

<select name="categoria" id="search_cat">
<option>Armas</option>
<option>Armaduras</option>
<option>Itens</option>
</select>

<?php
}elseif($_GET['categoria'] == 'Armas'){
?>

<?php
}elseif($_GET['categoria'] == 'Itens'){
?>

<select name="categoria" id="search_cat">
<option>Itens</option>
<option>Armas</option>
<option>Armaduras</option>
</select>

<?php
}else{
?>

<select name="categoria" id="search_cat">
<option>Armaduras</option>
<option>Armas</option>
<option>Itens</option>
</select>

<?php
}
?>

<input type="submit" name="" id="" value="Pesquisar" class="btn"/>
</form>
<br />

<div id="loop">

<?php
if($_GET['categoria'] == 'Armaduras'):
?>
<?php
if($_GET['s'] == ''){
	echo "<script>alert('Digite Sua Pesquisa')</script>";
}else{
?>
<table width="600" border="0" id="efeitot">
  <tr>
    <td width="471" bgcolor="#333333">&nbsp;Nome:</td>
    <td width="119" bgcolor="#333333">&nbsp;ID:</td>
  </tr>
  <?php
  $palavra = $_GET['s'];
  $buscar = mysql_query("SELECT * FROM armor WHERE name LIKE '%$palavra%' OR item_id LIKE '%$palavra%'");
  while($res_pesquisa = mysql_fetch_object($buscar)){
  ?>
  <tr class="efeito">
    <td bgcolor="#333333">&nbsp;<?php echo $res_pesquisa->name ?></td>
    <td bgcolor="#333333">&nbsp;<?php echo $res_pesquisa->item_id ?></td>
  </tr>
  <?php
  }
  ?>
</table>

<?php
}
endif;
?>

<?php
if($_GET['categoria'] == 'Armas'):
?>
<?php
if($_GET['s'] == ''){
	echo "<script>alert('Digite Sua Pesquisa')</script>";
}else{
?>
<table width="600" border="0" id="efeitot">
  <tr>
    <td width="471" bgcolor="#333333">&nbsp;Nome:</td>
    <td width="119" bgcolor="#333333">&nbsp;ID:</td>
  </tr>
  <?php
  $palavra = $_GET['s'];
  $buscar = mysql_query("SELECT * FROM weapon WHERE name LIKE '%$palavra%' OR item_id LIKE '%$palavra%'");
  while($res_pesquisa = mysql_fetch_object($buscar)){
  ?>
  <tr class="efeito">
    <td bgcolor="#333333">&nbsp;<?php echo $res_pesquisa->name ?></td>
    <td bgcolor="#333333">&nbsp;<?php echo $res_pesquisa->item_id ?></td>
  </tr>
  <?php
  }
  ?>
</table>

<?php
}
endif;
?>


<?php
if($_GET['categoria'] == 'Itens'):
?>
<?php
if($_GET['s'] == ''){
	echo "<script>alert('Digite Sua Pesquisa')</script>";
}else{
?>
<table width="600" border="0" id="efeitot">
  <tr>
    <td width="471" bgcolor="#333333">&nbsp;Nome:</td>
    <td width="119" bgcolor="#333333">&nbsp;ID:</td>
  </tr>
  <?php
  $palavra = $_GET['s'];
  $buscar = mysql_query("SELECT * FROM etcitem WHERE name LIKE '%$palavra%' OR item_id LIKE '%$palavra%'");
  while($res_pesquisa = mysql_fetch_object($buscar)){
  ?>
  <tr class="efeito">
    <td bgcolor="#333333">&nbsp;<?php echo $res_pesquisa->name ?></td>
    <td bgcolor="#333333">&nbsp;<?php echo $res_pesquisa->item_id ?></td>
  </tr>
  <?php
  }
  ?>
</table>

<?php
}
endif;
?>



<br />
</div><!--loop-->


</div><!--conte-->

</div><!--conteudo-->

</div><!--content-->

<div id="footer">

</div><!--footer-->

</div><!--box-->

</body>
</html>

