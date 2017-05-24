<?php

include ("libSigpi.php");

$mysql=conectar();


$mysql->query("update Proveedor set nombre = '$_REQUEST[nombre]',
	Asesor = '$_REQUEST[asesor]',telefono = '$_REQUEST[telefono]',
	correoElectronico = '$_REQUEST[email]',direccion = '$_REQUEST[direccion]'
	where idProveedor = '$_REQUEST[idProveedor]' ") or die($mysql->error);
$mysql->close();



header('Location: ../gestionProveedor.php');
?>