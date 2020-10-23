<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Dar Wipe No Servidor</div>
<form action="" method="post" name="de" id="do">
<input type="submit" name="excluir" value="Wipe" class="btn"/>
</form>


<?php
if(isset($_POST['excluir']) && $_POST['excluir'] == 'Wipe'){


$deleta = mysql_query("DELETE FROM accounts") or die (mysql_error());
$deletaq = mysql_query("DELETE FROM characters") or die (mysql_error());
$deletaa = mysql_query("DELETE FROM clan_data") or die (mysql_error());
$deletaz = mysql_query("DELETE FROM items") or die (mysql_error());
$deletaw = mysql_query("DELETE FROM character_skills") or die (mysql_error());
$deletas = mysql_query("DELETE FROM clan_notices") or die (mysql_error());
$deletax = mysql_query("DELETE FROM clan_privs") or die (mysql_error());
$deletae = mysql_query("DELETE FROM clan_skills") or die (mysql_error());
$deletad = mysql_query("DELETE FROM clan_subpledges") or die (mysql_error());
$deletec = mysql_query("DELETE FROM clan_wars") or die (mysql_error());
$deleter = mysql_query("DELETE FROM clanhall") or die (mysql_error());
$deletef = mysql_query("DELETE FROM clanhall_functions") or die (mysql_error());
$deletev = mysql_query("DELETE FROM clanhall_siege") or die (mysql_error());
$deletet = mysql_query("DELETE FROM olympiad_nobles") or die (mysql_error());
$deleteg = mysql_query("DELETE FROM heroes") or die (mysql_error());

echo "<script>alert('Wipe efetuado com sucesso!')</script>";

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