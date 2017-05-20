<?php

include ("../models/Datos.php");
include ("../models/Proyecto.php");

$proyecto = new Proyecto($_REQUEST['nombre'],$_REQUEST['inicio'],$_REQUEST['fin'],$_REQUEST['avance'],$_REQUEST['cliente'],$_REQUEST['estado'],$_REQUEST['idProyecto']);
$proyecto->actualizarProyecto();

//header('Location: ../gestionProyecto.php');
?>
