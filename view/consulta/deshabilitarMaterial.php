<?php

include ("libSigpi.php");

$mysql=conectar();

$registro = $mysql->query("select cantidadDisponible
	from Material where idMaterial = '$_REQUEST[idMaterial]'");
$vector = $registro->fetch_array();
if ($vector['CantidadDisponible']== '0') {
	$mysql->query("update Material set visibilidad ='0' where idMaterial= '$_REQUEST[idMaterial]' ") or 
		die ($mysql->error);
}



$mysql->close();

header('Location: ../gestionMaterial.php');

?>