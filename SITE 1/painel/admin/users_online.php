<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="conte">

<div id="local">
Paginas &raquo; Usuarios Onlines
</div><!--locau-->

<?php

$select = mysql_query("SELECT * FROM painel_users WHERE online = 'Online' OR online = 'ocupado' OR online = 'ausente'") or die (mysql_error());
while($res_usuario = mysql_fetch_array($select)){
	
?>
<li>Usuario(S) Online: <?php echo $res_usuario['usuario'] ?></li>

<?php
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