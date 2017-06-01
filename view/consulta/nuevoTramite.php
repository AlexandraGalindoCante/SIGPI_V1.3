
<?php

include ("libSigpi.php");
$idOrden = $_REQUEST['idOrden'];
$idMaterial = $_REQUEST['idMaterial'];
$cantidadRequerida = $_REQUEST['cantidadRequerida'];
$cantidadDisponible = $_REQUEST['cantidadDisponible'];
$cantidadDiferencia = $cantidadDisponible - $cantidadRequerida;
$idEmpleado = $_REQUEST['idEmpleado'];
if ($cantidadDisponible>= $cantidadRequerida) {
	$mysql = conectar();
		$mysql->query("insert into Tramite (fecha, cantidadAsignada, tipo, Empleado_idEmpleado, Material_idMaterial,visibilidad) 
			values (CURDATE(),'$cantidadRequerida','Salida', '$idEmpleado','$idMaterial','1')")
			or die($mysql->error);

	$mysql->query("insert into OrdenTramitada (Orden_idOrden, Tramite_idTramite,visibilidad) values ('$idOrden', (select max(idTramite) as idTramite from tramite),'1')")
	or die($mysql->error);

	$mysql->query("update Material set cantidadDisponible = '$cantidadDiferencia' where idMaterial = '$idMaterial'") or die($mysql->error);
	$mysql->query("update Orden set estado = '1', cantidadConsumida = '$cantidadRequerida' where idOrden = '$idOrden'") or die($mysql->error);
	$mysql->close();

}

header('Location: ../gestionAsignar.php');

?>
