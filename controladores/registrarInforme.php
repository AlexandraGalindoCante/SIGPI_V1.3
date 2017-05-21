<?php

session_start();
include ("../models/Datos.php");
include ("../models/Informe.php");

	$nombre = $_FILES['informe']['name'];
	$nombre_tmp = $_FILES['informe']['tmp_name'];
	$ruta = "archivos/".$nombre;
	$tipo = $_FILES['informe']['type'];
	$tamano = $_FILES['informe']['size'];
	$descripcion = $_REQUEST['desc'];
	$limite = 500 * 1024;
 
	if( $tipo =='application/pdf' && $tamano <= $limite ){
		$informe = new Informe($descripcion, $tipo, $tamano, $ruta, $_SESSION['idEmpleado'], $_SESSION['idProyecto']);
		$informe->registrarInforme();

		move_uploaded_file($nombre_tmp, "../archivos/".$nombre);
	}

/*
if ($_SESSION['idRol']==4) {
    header('Location: ../gestionInformeEj.php');

}


if ($_SESSION['idRol']==2) {
    header('Location: ../gestionInforme.php');

}
*/
?>

