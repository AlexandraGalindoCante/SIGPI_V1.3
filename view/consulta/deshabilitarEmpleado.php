<?php

include ("libSigpi.php");

$mysql=conectar();

$registro = $mysql->query("select Usuario_idUsuario
	from empleado where idEmpleado = '$_REQUEST[idEmpleado]'");
$vector = $registro->fetch_array();
$mysql->query("update empleado set visibilidad = '0' where idEmpleado='$_REQUEST[idEmpleado]'") or 
die ($mysql->error);

$mysql->query("update usuario set visibilidad = '0' where idUsuario = '$vector[Usuario_idUsuario]'") or 
die ($mysql->error);


$mysql->close();

header('Location: ../gestionEmpleados.php');

?>