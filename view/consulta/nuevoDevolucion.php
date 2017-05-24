
<?php

include ("libSigpi.php");
$idOrden = $_REQUEST['idOrden'];
$idMaterial = $_REQUEST['idMaterial'];
$cantidadConsumida = $_REQUEST['cantidadConsumida'];
$cantidadDisponible = $_REQUEST['cantidadDisponible'];
$cantidadDevuelta = $_REQUEST['cantidadDevuelta'];
$cantidadDiferencia = $cantidadConsumida - $cantidadDevuelta;
$cantidadNueva = $cantidadDisponible + $cantidadDevuelta;
$idEmpleado = $_REQUEST['idEmpleado'];
if ($cantidadConsumida >= $cantidadDevuelta ) {
	$mysql = conectar();
	if ($cantidadDevuelta > 0) {
		$mysql->query("insert into Tramite (fecha, cantidadAsignada, tipo, Empleado_idEmpleado, Material_idMaterial,visibilidad) 
			values (CURDATE(),'$cantidadDevuelta','Devolucion', '$idEmpleado','$idMaterial','1')")
			or die($mysql->error);
	}


	$mysql->query("update Material set cantidadDisponible = '$cantidadNueva' where idMaterial = '$idMaterial'") or die($mysql->error);
	$mysql->query("update Orden set cantidadConsumida = '$cantidadDiferencia', estado = '2' where idOrden = '$idOrden'") or die($mysql->error);
	$mysql->close();

}

header('Location: ../gestionDevolucion.php');

?>

