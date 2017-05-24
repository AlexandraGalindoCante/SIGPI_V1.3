
<?php
session_start();

include ("libSigpi.php");

$mysql = conectar();
$mysql->query("insert into Material (referencia,especificaciones,unidadMedida,cantidadDisponible,visibilidad) 
	values ('$_REQUEST[referencia]','$_REQUEST[especificaciones]','$_REQUEST[unidad]','$_REQUEST[cantidad]','1')")
	or die($mysql->error);
$mysql ->query("insert into Tramite (fecha, cantidadAsignada, tipo, Empleado_idEmpleado,Material_idMaterial,visibilidad) values (CURDATE(),'$_REQUEST[cantidad]','Entrada','$_SESSION[idEmpleado]', (select max(idMaterial) from Material),'1')") or die($mysql->error);
$mysql->close();


	header('Location: ../gestionMaterial.php');
?>
