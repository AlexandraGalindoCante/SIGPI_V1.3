<?php

include ("libSigpi.php");

$mysql=conectar();

$mysql->query("update Usuario set nombreUsuario = '$_REQUEST[email]'
	where idUsuario = '$_REQUEST[idUsuario]'") or die($mysql->error);

$mysql->query("update Empleado set nombreCompleto = '$_REQUEST[nombre]',
	documento = '$_REQUEST[documento]',telefonoFijo = '$_REQUEST[telefono]',
	telefonoCelular = '$_REQUEST[celular]',correoElectronico = '$_REQUEST[email]',
	direccion = '$_REQUEST[direccion]',Rol_idRol = '$_REQUEST[idRol]'
	where idEmpleado = '$_REQUEST[idEmpleado]' ") or die($mysql->error);
$mysql->close();



header('Location: ../gestionEmpleados.php');
?>





