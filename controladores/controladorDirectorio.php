<?php

include ("../models/Datos.php");
include ("../models/Directorio.php");

class controladorDirectorio{

	private $model;

	public function registrar(){
		$model = new Directorio($_REQUEST['idMaterial'],$_REQUEST['idProveedor']);
		$model->agregarDirectorio();
	}

	public function inhabilitar(){
		$model = new Directorio($_REQUEST['idMaterial'],$_REQUEST['idProveedor']);
		$model->eliminarDirectorio();
	}


}

//seccion de control para determinar que funcion se debe utilizar

$controlador = new controladorDirectorio;

if(isset($_REQUEST['funcion'])){
	$funcion = $_REQUEST['funcion'];
}

if(method_exists($controlador, $funcion)){
	call_user_func(array($controlador, $funcion));
}


?>