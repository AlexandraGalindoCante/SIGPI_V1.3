<?php

include ("libSigpi.php");

$mysql=conectar();


$registro = $mysql->query("select estado
	from Orden where idOrden = '$_REQUEST[idOrden]'");
$vector = $registro->fetch_array();
if ($vector['estado']== '0') {
	$mysql->query("update orden set visibilidad ='0' where idOrden= '$_REQUEST[idOrden]' ") or 
		die ($mysql->error);
}





$mysql->close();

header('Location: ../gestionOrden.php');

?>