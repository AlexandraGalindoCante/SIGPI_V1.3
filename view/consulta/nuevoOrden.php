
<?php

include ("libSigpi.php");

$mysql = conectar();
$mysql->query("insert into Orden (cantidadRequerida, cantidadConsumida, estado, Material_idMaterial, Plano_idPlano,visibilidad) 
	values ('$_REQUEST[cantidad]','0','0','$_REQUEST[idMaterial]', '$_REQUEST[idPlano]','1')")
	or die($mysql->error);
$mysql->close();


	header('Location: ../gestionOrden.php');
?>
