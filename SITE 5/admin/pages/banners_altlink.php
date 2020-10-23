<?php if($indexing == 1) {

if(!is_numeric($_GET['altlink'])) { exit; }

$searchlink = mysql_query("SELECT * FROM ".DBNAME.".site_banners WHERE b_bid = '".$_GET['altlink']."' LIMIT 1", $conexao);
if(mysql_num_rows($searchlink) > 0) {

?>

<h2>&raquo; Alterar Link de Banner</h2>

<div style='display:table;margin: 0 auto 20px auto;'>
	<?php echo "<img src='../".DIRBAN.mysql_result($searchlink, 0, 1)."' width='428' height='174' />"; ?>
</div>

<form method='POST' action='?id=banners&altlinksend=<?php echo $_GET['altlink']; ?>'>
Insira a URL(link) no campo abaixo.
<br /><br />
<div class='formpadrao'>
	<div class='desc'>Link:</div>
	<div class='camp'>
		<input type='text' maxlength='255' name='bannerlink' style='width:435px;' value='<?php echo mysql_result($searchlink, 0, 3); ?>' />
		<div style='padding: 10px 0 0 0;'>
			<label><input type='checkbox' name='linktarget' value='1' <?php if(mysql_result($searchlink, 0, 4) == '1') { echo "checked "; } ?>/> Abrir em nova aba</label>
		</div>
	</div>
</div>
<div style='padding: 20px 0; display:table;width:100%;'><div style='display:table;margin: 0 28px 0 0; float: right;'>
<input type="submit" class='atualstudio_button' value="Atualizar &raquo;" />
</div></div>
</form>

<?php } } ?>