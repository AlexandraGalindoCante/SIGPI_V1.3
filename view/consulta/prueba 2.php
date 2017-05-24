<?php

include ("libSigpi.php");

$mysql=conectar();


$mysql->query("Update Proyecto set visibilidad = '0' where idProyecto= '$_REQUEST[idProyecto]' ") or 
die ($mysql->error);
$mysql->query("Update Plano set visibilidad = '0' where Proyecto_idProyecto= '$_REQUEST[idProyecto]' ") or 
die ($mysql->error);
$resultado=$mysql->query("select idPlano from Plano where Proyecto_idProyecto= '$_REQUEST[idProyecto]' ") or 
die ($mysql->error);
while ($vec = $resultado->fetch_array()) {
	$mysql->query("Update ArchivoPlano set visibilidad = '0' where Plano_idPlano= '$vec[idPlano]' ") or 
die ($mysql->error);
}

while ($vec = $resultado->fetch_array()) {
	$mysql->query("Update Orden set visibilidad = '0' where Plano_idPlano= '$vec[idPlano]' ") or 
die ($mysql->error);
}
$mysql->query("Delete from equipoTrabajo where Proyecto_idProyecto= '$_REQUEST[idProyecto]' ") or 
die ($mysql->error);


$mysql->close();

header('Location: ../gestionProyecto.php');

?>