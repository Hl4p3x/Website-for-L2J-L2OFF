<?php
session_start();
if(isset($_SESSION['user'])){
	header("location: admin/");	
	exit;
}
?>
<?php include("Connections/config_sql.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/estrutura.css" rel="stylesheet" type="text/css" />
<link href="img/favicon.png" rel="shortcut icon" />
<title>Painel De Controle</title>
</head>
<body>

<div id="box">



<div id="login">

<div id="logo">
<img src="img/logo.png" />
</div><!--logo-->

<div id="conteudo">
<form method="POST" name="logar" id="logar" action="">
<table width="300" border="0">
  <tr>
    <td colspan="2">&raquo; Nome De Usuario:</td>
  </tr>
  <tr>
    <td height="50" colspan="2" valign="top"><label for="user2"></label>
 <input type="text" name="user" id="usuario" /></td>
  </tr>
  <tr>
    <td colspan="2">&raquo; Senha:</td>
  </tr>
  <tr>
    <td colspan="2"><label for="senha"></label>
      <input type="password" name="senha" id="senha" /></td>
  </tr>
  <tr>
    <td width="177" height="50" valign="bottom">
    <input type="hidden" name="log" value="ok" />
    <input type="submit" name="button" id="button" value=" " /></td>
    <td width="113" valign="bottom">
    <select name="sele" id="sele">
    <option value="Online">Disponivel</option>
    <option value="ocupado">Ocupado</option>
    <option value="ausente">Ausente</option>
    <option value="invis">Invisivel</option>
    </select>
    </td>
  </tr>
</table>
</form>
</div><!--conteudo-->

</div><!--login-->


<?php if(isset($_POST['log']) && $_POST['log'] == 'ok')
{
include("functions/func_session.php");
}
?>
</div><!--box-->
</body>
</html>