<?php

include ("../models/Empleado.php");

$empleado = new Empleado($_REQUEST[nombre],$_REQUEST[documento],$_REQUEST[telefono],$_REQUEST[celular],$_REQUEST[email],$_REQUEST[direccion],$_REQUEST[idRol],$_REQUEST[idEmpleado],$_REQUEST[idUsuario]);
$empleado->actualizarEmpleado();

//header('Location: ../gestionEmpleados.php');
?>

