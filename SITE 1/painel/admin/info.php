<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Informações do Servidor</div>
<br />

<?php
$on = mysql_query("SELECT * FROM characters WHERE online = '1'");
$count_co = mysql_num_rows($on);

$perso = mysql_query("SELECT * FROM characters");
$count_perso = mysql_num_rows($perso);


$contas = mysql_query("SELECT * FROM accounts");
$count_contas = mysql_num_rows($contas);

$clans = mysql_query("SELECT * FROM clan_data");
$count_clan = mysql_num_rows($clans);

$persoban = mysql_query("SELECT * FROM characters WHERE accesslevel = '-100'");
$count_persoban = mysql_num_rows($persoban);

$contasban = mysql_query("SELECT * FROM accounts WHERE access_level = '-100'");
$count_contasban = mysql_num_rows($contasban);

$heross = mysql_query("SELECT * FROM heroes");
$count_hero = mysql_num_rows($heross);

$nobleses = mysql_query("SELECT * FROM characters WHERE nobless = '1'");
$cont_nobles = mysql_num_rows($nobleses);

$adm = mysql_query("SELECT * FROM characters WHERE accesslevel >= 1");
$count_adm = mysql_num_rows($adm);
?>
<li>Players Online: <?php echo $count_co ?></li>
<li>Contas Criadas: <?php echo  $count_contas ?></li>
<li>Personagens: <?php echo $count_perso ?></li>
<li>Clans Criados: <?php echo $count_clan ?></li>
<li>Players Banidos: <?php echo $count_persoban ?></li>
<li>Contas Banidas: <?php echo $count_contasban ?></li>
<li>Player Heros: <?php echo $count_hero ?></li>
<li>Players Nobles: <?php echo $cont_nobles ?></li>
<li>administradores / gms: <?php echo $count_adm ?></li>

</div><!--conte-->

</div><!--conteudo-->

</div><!--content-->

<div id="footer">

</div><!--footer-->

</div><!--box-->

</body>
</html>