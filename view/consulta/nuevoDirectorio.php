<?php

include ("libSigpi.php");

$mysql = conectar();
$mysql->query("insert into directorioproveedor (Material_idMaterial, Proveedor_idProveedor,visibilidad)
	values('$_REQUEST[idMaterial]','$_REQUEST[idProveedor]','1')")
	or die($mysql->error);
$mysql->close();

header('Location: ../gestionDirectorio.php');

	
?>

