<?php

include ("../models/Datos.php");
include ("../models/Material.php");

$material=new Material($_REQUEST['referencia'],$_REQUEST['especificaciones'],$_REQUEST['unidad'],$_REQUEST['cantidad']);
$material->registrarMaterial();


 //header('Location: ../gestionMaterial.php');


?>