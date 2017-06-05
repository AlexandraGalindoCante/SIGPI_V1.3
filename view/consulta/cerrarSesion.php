<?php
	session_start();
	$_SESSION['sesion']=0;
	session_destroy();
	header('Location: ../../index.php')

?>