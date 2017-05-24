
<?php
session_start();

include ("libSigpi.php");

$mysql = conectar();
$cantidadEntrada = $_REQUEST['cantidad'];
$consulta= $mysql->query("select cantidadDisponible from Material where idMaterial = '$_REQUEST[idMaterial]'") or die($mysql->error);
$vec = mysqli_fetch_array($consulta);
$cantidadDisponible = $vec['cantidadDisponible'];
$cantidadActualizada = $cantidadDisponible + $cantidadEntrada;
$mysql ->query("insert into Tramite (fecha, cantidadAsignada, tipo, Empleado_idEmpleado,Material_idMaterial,visibilidad) values (CURDATE(),'$_REQUEST[cantidad]','Entrada','$_SESSION[idEmpleado]', '$_REQUEST[idMaterial]','1')") or die($mysql->error);
$mysql->query("update  Material set cantidadDisponible = '$cantidadActualizada' where idMaterial = '$_REQUEST[idMaterial]'")
	or die($mysql->error);
$mysql->close();


	header('Location: ../gestionEntrada.php');
?>

