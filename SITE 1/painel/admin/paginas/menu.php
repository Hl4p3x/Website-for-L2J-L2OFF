<?php
include"../Connections/config_sql.php";
$status_user = mysql_query("SELECT * FROM painel_users WHERE usuario = '$_SESSION[user]'") or die (mysql_error());
while($res_perfil = mysql_fetch_array($status_user)){
?>

<?php
if($res_perfil['status'] == 'admin'){
?>

<h1>Gerenciar</h1>
<h2><a href="index.php">&raquo; Home</a></h2>
<h2><a href="/" target="_new">&raquo; Visualizar Site</a></h2>

<h1>Opçoes Do Painel</h1>
<h2><a href="entregar_donate.php">&raquo; Entregar Doaçao</a></h2>
<h2><a href="vps.php">&raquo; Dar status Vip</a></h2>
<h2><a href="ban.php">&raquo; Dar e Tirar Ban</a></h2>
<h2><a href="search_id.php">&raquo; Buscar ID</a></h2>
<h2><a href="players_on.php">&raquo; Ver Players Online</a></h2>
<h2><a href="nick.php">&raquo; Trocar Nickname</a></h2>
<h2><a href="sex.php">&raquo; Trocar Sexo</a></h2>
<h2><a href="recs.php">&raquo; Adicionar / Remover Recs</a></h2>
<h2><a href="nobles.php">&raquo; Dar Status Nobles</a></h2>
<h2><a href="deletar.php">&raquo; Deletar Char LvL 1</a></h2>
<h2><a href="clan.php">&raquo; Listar Clan´s</a></h2>
<h2><a href="info.php">&raquo; Informações do Servidor</a></h2>
<h2><a href="wipe.php">&raquo; Dar Wipe</a></h2>

<h1>Gerenciar Postagens:</h1>
<h2><a href="noticias.php">&raquo; Cadastrar Noticia</a></h2>
<h2><a href="index.php?limpar=mural">&raquo; Limpar Mural</a></h2>


<h1>Gerenciar Usuarios:</h1>
<h2><a href="cadastrar_novo.php">&raquo; Cadastrar Novo</a></h2>
<h2><a href="user_list.php">&raquo; Listar Usuarios</a></h2>

<h1>Comunicação:</h1>
<h2><a href="mural.php">&raquo; Mural De Recados</a></h2>

<?php
}elseif($res_perfil['status'] == 'gm'){
	
?>



<h1>Gerenciar</h1>
<h2><a href="index.php">&raquo; Home</a></h2>
<h2><a href="/" target="_new">&raquo; Visualizar Site</a></h2>

<h1>Opçoes Do Painel</h1>
<h2><a href="vps.php">&raquo; Dar status Vip</a></h2>
<h2><a href="ban.php">&raquo; Dar e Tirar Ban</a></h2>
<h2><a href="search_id.php">&raquo; Buscar ID</a></h2>
<h2><a href="players_on.php">&raquo; Ver Players Online</a></h2>
<h2><a href="nick.php">&raquo; Trocar Nickname</a></h2>
<h2><a href="sex.php">&raquo; Trocar Sexo</a></h2>
<h2><a href="recs.php">&raquo; Adicionar / Remover Recs</a></h2>
<h2><a href="nobles.php">&raquo; Dar Status Nobles</a></h2>
<h2><a href="deletar.php">&raquo; Deletar Char LvL 1</a></h2>
<h2><a href="clan.php">&raquo; Listar Clan´s</a></h2>
<h2><a href="info.php">&raquo; Informações do Servidor</a></h2>

<h1>Gerenciar Postagens:</h1>
<h2><a href="noticias.php">&raquo; Cadastrar Noticia</a></h2>

<h1>Comunicação:</h1>
<h2><a href="mural.php">&raquo; Mural De Recados</a></h2>


<?php
}
?>
<?php
}
?>