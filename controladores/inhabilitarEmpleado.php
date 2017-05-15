<?php

include ("../models/Empleado.php");

$empleado = new Empleado($_REQUEST[idEmpleado]);
$empleado->inhabilitarEmpleado();

//header('Location: ../gestionEmpleados.php');
?>
