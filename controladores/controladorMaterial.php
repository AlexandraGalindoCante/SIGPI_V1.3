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


	public function actualizar(){
		$model=new Material($_REQUEST['idMaterial'],$_REQUEST['referencia'],$_REQUEST['especificaciones'],$_REQUEST['unidadMedida'],0);
		$model->actualizarMaterial();

	}

	public function inhabilitar(){
		$model=new Material($_REQUEST['idMaterial']);
		$model->inhabilitarMaterial();
	}
}


$controlador = new controladorMaterial;

if(isset($_REQUEST['nombre']) && isset($_REQUEST['idMaterial'])){
	$funcion = 'actualizar';
}elseif(isset($_REQUEST['nombre'])){
	$funcion = 'registrar';
}elseif(isset($_REQUEST['idMaterial'])){
	$funcion = 'inhabilitar';
}

if(method_exists($controlador, $funcion)){
	call_user_func(array($controlador, $funcion));
}
	




?>