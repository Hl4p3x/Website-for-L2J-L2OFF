<?php include"paginas/header.php"; ?>
<div id="content">

<div id="conteudo">

<div id="sidebar">
<?php include"paginas/menu.php"; ?>
</div><!--sidebar-->

<div id="contee">
<?php

$select_perfil = mysql_query("SELECT * FROM painel_users WHERE usuario = '$_GET[usuario]'") or die (mysql_error());
while($res_pro = mysql_fetch_object($select_perfil)){
	
if($res_pro->online == 'Online'){
	$retorno_on = "<font color=\"#00FF00\">Online</font>";
}elseif($res_pro->online == 'ocupado'){
	$retorno_on = "<font color=\"#FF0000\">Ocupado</font>";
}elseif($res_pro->online == 'ausente'){
	$retorno_on = "<font color=\"#E87400\">Ausente</font>";
}elseif($res_pro->online == 'invis'){
	$retorno_on = "<font color=\"#333333\">Não Esta Online</font>";	
}elseif($res_pro->online == 'off'){
	$retorno_on = "<font color=\"#333333\">Não Esta Online</font>";	
}

if($res_pro->status == 'admin'){
	$stat = "http://i.imgur.com/d3EL2.png";	
}elseif($res_pro->status == 'gm'){
	$stat = "http://i.imgur.com/XysMV.png";
}

$select_posts = mysql_query("SELECT * FROM painel_recados WHERE usuario = '$_GET[usuario]'");
$exibe_posts = mysql_num_rows($select_posts);

?>

<div id="profile">

<div id="info">

<div id="um">
<div class="info">
Perfil De - <?php echo "$res_pro->usuario" ?>
</div><!--infoclass-->

<div id="info_img">
<br />
<br />
<center><img src="<?php echo $res_pro->avatar ?>" class="avatar" width="135" height="135"/></center>
<center><img src="<?php echo "$stat" ?>" /></center>
</div><!--info_img-->
</div><!--um-->

<div id="infa">
Informações
</div><!--infa-->
<br />
<br />

<div id="info_conteudo">
Nome: <font style="font-weight:normal"><?php echo "$res_pro->nome" ?></font>
<p>
Email: <font style="font-weight:normal"><?php echo "$res_pro->email" ?></font>
<p>
Cadastrado Em: <font style="font-weight:normal"><?php echo "$res_pro->cadastrado_em" ?></font>
<p>
Atualmente: <?php echo "$retorno_on" ?>
<p>
Pots No Mural: <font style="font-weight:normal"><?php echo "$exibe_posts" ?></font>
<p>
Grupo: <font style="font-weight:normal"><?php echo "$res_pro->status" ?></font>
<p>
Ultimo login: <font style="font-weight:normal"><?php echo "$res_pro->ultimo_login" ?></font>
<p>
Ip do Ultimo Login: <font style="font-weight:normal"><?php echo $res_pro->ultimo_login_ip ?></font>
<p>
</div><!--info_conteudo-->

</div><!--info-->

</div><!--profile-->


<?php
}
?>
</div><!--contee-->

</div><!--conteudo-->

</div><!--content-->

<div id="footer">

</div><!--footer-->

</div><!--box-->

</body>
</html>