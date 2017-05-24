<?php

include ("libSigpi.php");
$contrasena = generarContrasena();
$mysql = conectar();
$mysql->query("insert into usuario(nombreUsuario,contrasena,visibilidad) 
	values('$_REQUEST[email]','$contrasena','1')")
	or die($mysql->error);
$mysql->close();
$mysql=conectar();
$usuario=$mysql->query("select idUsuario from usuario 
	where nombreUsuario = '$_REQUEST[email]'");
$vec=$usuario->fetch_array();
	$mysql->query("insert into empleado(nombreCompleto,documento,telefonoFijo,
	telefonoCelular,correoElectronico,direccion,usuario_idUsuario,Rol_idRol,visibilidad)
	 values ('$_REQUEST[nombre]','$_REQUEST[documento]','$_REQUEST[telefono]',
	 	'$_REQUEST[celular]','$_REQUEST[email]','$_REQUEST[direccion]','$vec[idUsuario]',
	 	'$_REQUEST[idRol]','1')") or die($mysql->error);



	$mysql->close();

	header('Location: ../gestionEmpleados.php');
?>

