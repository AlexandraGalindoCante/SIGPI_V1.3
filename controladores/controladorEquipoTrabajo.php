<?php

include ("../models/Datos.php");
include ("../models/EquipoTrabajo.php");

class controladorEquipoTrabajo{

	private $model;

	public function registrar(){
		$model = new EquipoTrabajo($_REQUEST['idEmpleado'],$_REQUEST['idProyecto']);
		$model->agregarEquipo();
	}

	public function inhabilitar(){
		$model = new EquipoTrabajo($_REQUEST['idEmpleado'],$_REQUEST['idProyecto']);
		$model->eliminarEquipo();
	}


}

//seccion de control para determinar que funcion se debe utilizar

$controlador = new controladorEquipoTrabajo;

if(isset($_REQUEST['funcion'])){
	$funcion = $_REQUEST['funcion'];
}

if(method_exists($controlador, $funcion)){
	call_user_func(array($controlador, $funcion));
}


?>