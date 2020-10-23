<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Listar Clans</div>
<br />

<table width="620" border="0" cellpadding="1" cellspacing="1" id="on">
  <tr>
    <td width="97" align="center" bgcolor="#333333">Clan Name:</td>
    <td width="93" align="center" bgcolor="#333333">Clan LvL:</td>
    <td width="95" align="center" bgcolor="#333333">Reputação</td>
    <td width="95" align="center" bgcolor="#333333">Lider</td>
    </tr>
    <?php
	$clans = mysql_query("SELECT * FROM clan_data") or die (mysql_error());
	while($res_clan = mysql_fetch_object($clans)){
		
	$lider = mysql_query("SELECT * FROM characters WHERE obj_Id = '$res_clan->leader_id'") or die (mysql_error());
	$res_lider = mysql_fetch_object($lider);
	?>
  	<tr>
    <td align="center" bgcolor="#333333"><?php echo $res_clan->clan_name ?></td>
    <td align="center" bgcolor="#333333"><?php echo $res_clan->clan_level ?></td>
    <td align="center" bgcolor="#333333"><?php echo $res_clan->reputation_score ?></td>
    <td align="center" bgcolor="#333333"><?php echo $res_lider->char_name ?></td>
    </tr>
    <?php
	}
	?>
</table>
<br />
</div><!--conte-->

</div><!--conteudo-->

</div><!--content-->

<div id="footer">

</div><!--footer-->

</div><!--box-->

</body>
</html>