<?php
session_start();
include ("libSigpi.php");

$mysql = conectar();
$avance = (int)$_REQUEST['avance'];
$mysql->query("insert into Proyecto (nombre,fechaInicio,fechaEntrega,porcentajeAvance,Cliente_idCliente,estadoProyecto_idEstadoProyecto,visibilidad)
	values('$_REQUEST[nombre]','$_REQUEST[inicio]','$_REQUEST[fin]','$avance','$_REQUEST[cliente]','$_REQUEST[estado]','1')")
	or die($mysql->error);
$mysql->query("insert into equipoTrabajo (Empleado_idEmpleado, Proyecto_idProyecto,visibilidad)
values('$_SESSION[idEmpleado]', (select max(idProyecto) from proyecto) ,'1')")
or die($mysql->error);

$mysql->close();


	header('Location: ../gestionProyecto.php');
?>
