<?php

include ("../models/Empleado.php");

$empleado = new Empleado($_REQUEST[email],$_REQUEST[password]);
if ($empleado->login()) {
	//header('Location: ../gestionProyecto.php');
	
}else{
	//header('Location: ../index.php');
}

?>
