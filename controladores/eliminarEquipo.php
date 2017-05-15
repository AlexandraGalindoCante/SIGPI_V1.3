<?php

include ("../models/EquipoTrabajo.php");

	$EquipoTrabajo = new EquipoTrabajo($_Request[idEmpleado],$_REQUEST[idProyecto]);
	$EquipoTrabajo->eliminarEquipo();

	//header('Location: ../gestionEmpleados.php');
?>