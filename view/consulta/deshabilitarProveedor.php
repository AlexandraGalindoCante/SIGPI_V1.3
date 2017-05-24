<?php

include ("libSigpi.php");

$mysql=conectar();


$mysql->query("update Proveedor set visibilidad = '0' where idProveedor= '$_REQUEST[idProveedor]' ") or 
die ($mysql->error);

$mysql->query("delete from directorioProveedor  where Proveedor_idProveedor= '$_REQUEST[idProveedor]' ") or 
die ($mysql->error);




$mysql->close();

header('Location: ../gestionProveedor.php');

?>