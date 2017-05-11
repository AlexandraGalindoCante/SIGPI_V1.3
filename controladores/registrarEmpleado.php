<?php

include ("models/Empleado.php");

crear($_REQUEST[nombre],$_REQUEST[documento],$_REQUEST[telefono],
	 	$_REQUEST[celular],$_REQUEST[email],$_REQUEST[direccion],$_REQUEST[idRol]);


	header('Location: ../gestionEmpleados.php');
?>

