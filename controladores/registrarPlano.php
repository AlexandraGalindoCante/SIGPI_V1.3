<?php

session_start();
include ("../models/Datos.php");
include ("../models/ArchivoPlano.php");

	$nombre = $_FILES['informe']['name'];
	$nombre_tmp = $_FILES['informe']['tmp_name'];
	$ruta = "archivos/".$nombre;
	$tipo = $_FILES['informe']['type'];
	$tamano = $_FILES['informe']['size'];
	$descripcion = $_REQUEST['desc'];
	$limite = 500 * 1024;
 
	if( $tipo =='application/pdf' && $tamano <= $limite ){
		$plano = new ArchivoPlano($descripcion, $tipo, $tamano, $ruta, $_SESSION['idEmpleado'], $_SESSION['idProyecto']);
		$plano->registrarPlano();

		move_uploaded_file($nombre_tmp, "../archivos/".$nombre);
	}
/*
	header('Location: ../gestionPlano.php');
*/
?>

