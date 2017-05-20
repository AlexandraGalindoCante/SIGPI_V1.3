<?php

include ("../models/Datos.php");
include ("../models/Proyecto.php");

$proyecto = new Proyecto($_REQUEST['idProyecto']);
$proyecto->inhabilitarProyecto();

//header('Location: ../gestionProyecto.php');
?>