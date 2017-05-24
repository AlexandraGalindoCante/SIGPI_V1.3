<?php

include ("libSigpi.php");

$mysql = conectar();
$mysql->query("insert into equipoTrabajo (Empleado_idEmpleado, Proyecto_idProyecto,visibilidad)
	values('$_REQUEST[idEmpleado]','$_REQUEST[idProyecto]','1')")
	or die($mysql->error);
$mysql->close();


	header('Location: ../gestionProyecto.php');
?>

