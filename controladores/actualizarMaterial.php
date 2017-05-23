<?php

include ("../models/Datos.php");
include ("../models/Material.php");

$material=new Material($_REQUEST['idMaterial'],$_REQUEST['referencia'],$_REQUEST['especificaciones'],$_REQUEST['unidadMedida'],0);
$material->actualizarMaterial();

//	header('Location: ../gestionMaterial.php');
?>