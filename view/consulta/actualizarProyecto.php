<?php

include ("libSigpi.php");

$mysql = conectar();
$avance = (int)$_REQUEST['avance'];
$mysql->query("update Proyecto set nombre = '$_REQUEST[nombre]', fechaInicio = '$_REQUEST[inicio]', fechaEntrega = '$_REQUEST[fin]', porcentajeAvance = '$avance',Cliente_idCliente ='$_REQUEST[cliente]', estadoProyecto_idEstadoProyecto = '$_REQUEST[estado]' where idProyecto = '$_REQUEST[idProyecto]'")
	or die($mysql->error);
$mysql->close();


	header('Location: ../gestionProyecto.php');
?>

