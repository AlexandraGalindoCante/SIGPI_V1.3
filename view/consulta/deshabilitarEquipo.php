<?php

include ("libSigpi.php");

$mysql=conectar();


$mysql->query("delete from  equipoTrabajo  where (Empleado_idEmpleado= '$_REQUEST[idEmpleado]') && ( proyecto_idProyecto='$_REQUEST[idProyecto]' )") or 
die ($mysql->error);


$mysql->close();

header('Location: ../gestionEquipo.php');

?>