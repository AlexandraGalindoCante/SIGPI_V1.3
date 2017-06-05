<?php

include ("../models/Datos.php");
include ("../models/Material.php");

/**
* 
*/
class controladorMaterial{

	private $model;

	public function registrar(){

		$model =new Material($_REQUEST['referencia'],
		$_REQUEST['especificaciones'],
		$_REQUEST['unidad'],
		$_REQUEST['cantidad']);
		$model->registrarMaterial();
}


	private function actualizar(){


$model=new Material($_REQUEST['idMaterial'],$_REQUEST['referencia'],$_REQUEST['especificaciones'],$_REQUEST['unidadMedida'],0);
$model->actualizarMaterial();

?>