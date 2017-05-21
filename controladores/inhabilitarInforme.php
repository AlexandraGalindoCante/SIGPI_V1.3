<?php

include ("../models/Datos.php");
include ("../models/Informe.php");


	$informe = new Informe($_REQUEST['idInforme']);
	$informe->inhabilitarInforme();

/*
if ($_SESSION['idRol']==4) {
    header('Location: ../gestionInformeEj.php');

}


if ($_SESSION['idRol']==2) {
    header('Location: ../gestionInforme.php');

}
*/
?>

