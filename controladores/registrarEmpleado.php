<?php

include ("../models/Datos.php");
include ("../models/Empleado.php");

	//$empleado = new Empleado($_REQUEST['nombre'],$_REQUEST['documento'],$_REQUEST['telefono'],$_REQUEST['celular'],$_REQUEST['email'],$_REQUEST['direccion'],$_REQUEST['idRol']);
	$empleado = new Empleado('Gerente','1234','42342','98121','gerente@gmail.com','calle 3','2');
	$empleado->registrarEmpleado();

	//header('Location: ../gestionEmpleados.php');
?>

