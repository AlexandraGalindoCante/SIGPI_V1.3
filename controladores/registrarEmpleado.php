<?php

include ("../models/Empleado.php");

	$empleado = new Empleado($_REQUEST[nombre],$_REQUEST[documento],$_REQUEST[telefono],$_REQUEST[celular],$_REQUEST[email],$_REQUEST[direccion],$_REQUEST[idRol]);
	$empleado->registrarEmpleado();

	//header('Location: ../gestionEmpleados.php');
?>

