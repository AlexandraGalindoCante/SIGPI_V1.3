<?php

include ("libSigpi.php");

$mysql=conectar();


$mysql->query("delete from directorioproveedor where (Material_idMaterial= '$_REQUEST[idMaterial]') && ( Proveedor_idProveedor='$_REQUEST[idProveedor]' )") or 
die ($mysql->error);


$mysql->close();

header('Location: ../gestionDirectorio.php');

?>