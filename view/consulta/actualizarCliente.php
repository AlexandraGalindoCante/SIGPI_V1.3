<?php

include ("libSigpi.php");

$mysql=conectar();


$mysql->query("update Cliente set nombre = '$_REQUEST[nombre]',
	nit = '$_REQUEST[nit]',telefonoFijo = '$_REQUEST[telefono]',
	telefonoCelular = '$_REQUEST[celular]',correoElectronico = '$_REQUEST[email]'
	where idCliente = '$_REQUEST[idCliente]' ") or die($mysql->error);
$mysql->close();



header('Location: ../gestionCliente.php');
?>