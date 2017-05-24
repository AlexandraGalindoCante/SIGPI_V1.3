<?php

include ("libSigpi.php");

$mysql = conectar();
$mysql->query("insert into Proveedor (nombre,asesor,telefono,correoElectronico,direccion,visibilidad)
	values('$_REQUEST[nombre]','$_REQUEST[asesor]','$_REQUEST[telefono]','$_REQUEST[email]','$_REQUEST[direccion]','1')")
	or die($mysql->error);
$mysql->close();


	header('Location: ../gestionProveedor.php');
?>

