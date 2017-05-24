
<?php

include ("libSigpi.php");

	$mysql = conectar();
	$mysql->query("update  Material set referencia= '$_REQUEST[referencia]',especificaciones='$_REQUEST[especificaciones]' where idMaterial = '$_REQUEST[idMaterial]'")
	or die($mysql->error);
	$mysql->close();
	header('Location: ../gestionMaterial.php');
?>
