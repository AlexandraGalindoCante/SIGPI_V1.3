<?php

session_start();
include ("../models/Datos.php");
include ("../models/ArchivoPlano.php");


		$plano = new ArchivoPlano($_REQUEST['idPlano']);
		$plano->inhabilitarPlano();

/*
	header('Location: ../gestionPlano.php');
*/
?>

