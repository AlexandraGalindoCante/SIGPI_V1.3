<?php

include ("../models/EquipoTrabajo.php");

	$EquipoTrabajo = new EquipoTrabajo($_Request[idEmpleado],$_REQUEST[idProyecto]);
	$EquipoTrabajo->agregarEquipo();

	//header('Location: ../gestionEmpleados.php');
?>