<?php
session_start();
if(!isset($_SESSION['user'])){
	header("location: ../index.php");		
	exit;
}
?>
<?php

$session_user = $_SESSION['user'];

?>