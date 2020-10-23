<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">Paginas &raquo; Players Online</div>
<br />
<table width="620" border="0" id="on">
  <tr>
    <td width="166" align="center" bgcolor="#333333">Nome:</td>
    <td width="111" align="center" bgcolor="#333333">Clan:</td>
    <td width="118" align="center" bgcolor="#333333">PvPs</td>
    <td width="101" align="center" bgcolor="#333333">Pks</td>
    <td width="102" align="center" bgcolor="#333333">Level</td>
    </tr>
    <?php
	
	$sele_on = mysql_query("SELECT * FROM characters WHERE online = '1'");
	while($res_on = mysql_fetch_object($sele_on)){
	$clans = mysql_query("SELECT * FROM clan_data WHERE clan_id = '$res_on->clanid'") or die ("error");
	$clan = mysql_fetch_object($clans);
	?>
  	<tr class="baixo">
    <td align="center" bgcolor="#333333"><?php echo $res_on->char_name ?></td>
    <td align="center" bgcolor="#333333">
	<?php 
	if($clan->clan_name == ''){
		echo "Sem Clan";
	}else{
		echo "$clan->clan_name";
	}
	?> 
    </td>
    <td align="center" bgcolor="#333333"><?php echo $res_on->pvpkills ?></td>
    <td align="center" bgcolor="#333333"><?php echo $res_on->pkkills ?></td>
    <td align="center" bgcolor="#333333"><?php echo $res_on->level ?></td>
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