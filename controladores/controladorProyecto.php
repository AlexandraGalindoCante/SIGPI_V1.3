<?php

include ("../models/Datos.php");
include ("../models/Proyecto.php");

class controladorProyecto{

	private $model;

	public function actualizar(){
		$model = new Proyecto($_REQUEST['nombre'],$_REQUEST['inicio'],$_REQUEST['fin'],$_REQUEST['avance'],$_REQUEST['cliente'],$_REQUEST['estado'],$_REQUEST['idProyecto']);
		$model->actualizarProyecto();
	}

	public function registrar(){
		$model = new Proyecto($_REQUEST['nombre'],$_REQUEST['inicio'],$_REQUEST['fin'],$_REQUEST['avance'],$_REQUEST['cliente'],$_REQUEST['estado']);
		$model->registrarProyecto();
	}

	public function inhabilitar(){
		$empleado = new Proyecto($_REQUEST['idProyecto']);
		$empleado->inhabilitarProyecto();
	}
}

//seccion de control para determinar que funcion se debe utilizar

$controlador = new controladorProyecto;

if(isset($_REQUEST['nombre']) && isset($_REQUEST['idProyecto'])){
	$funcion = 'actualizar';
}elseif(isset($_REQUEST['nombre'])){
	$funcion = 'registrar';
}elseif(isset($_REQUEST['idProyecto'])){
	$funcion = 'inhabilitar';
}

if(method_exists($controlador, $funcion)){
	call_user_func(array($controlador, $funcion));
}


?>