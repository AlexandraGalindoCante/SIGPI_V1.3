<?php

include ("../models/Datos.php");
include ("../models/Proveedor.php");

class controladorProveedor{

	private $model;

	public function actualizar(){
		$model = new Proveedor($_REQUEST['nombre'],$_REQUEST['asesor'],$_REQUEST['telefono'],$_REQUEST['email'],$_REQUEST['direccion'],$_REQUEST['idProveedor']);
		$model->actualizarProveedor();
	}

	public function registrar(){
		$model = new Proveedor($_REQUEST['nombre'],$_REQUEST['asesor'],$_REQUEST['telefono'],$_REQUEST['email'],$_REQUEST['direccion']);
		$model->registrarProveedor();
	}

	public function inhabilitar(){
		$model = new Proveedor($_REQUEST['idProveedor']);
		$model->inhabilitarProveedor();
	}


}

//seccion de control para determinar que funcion se debe utilizar

$controlador = new controladorProveedor;

if(isset($_REQUEST['nombre']) && isset($_REQUEST['idProveedor'])){
	$funcion = 'actualizar';
}elseif(isset($_REQUEST['nombre'])){
	$funcion = 'registrar';
}elseif(isset($_REQUEST['idProveedor'])){
	$funcion = 'inhabilitar';
}

if(method_exists($controlador, $funcion)){
	call_user_func(array($controlador, $funcion));
}


?>