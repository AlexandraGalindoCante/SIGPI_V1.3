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
		$model = new Proyecto($_REQUEST['idProyecto']);
		$model->inhabilitarProyecto();
	}

	public function consultarDatosProyecto($idProyecto){
		$model = new Proyecto($idProyecto);
		$consulta = $model->consultarDatosProyecto();
		return $consulta;
	}

	public function consultarEquipoProyecto($idProyecto){
		$model = new Proyecto($idProyecto);
		$consulta = $model->consultarEquipoProyecto();
		return $consulta;
	}

	public function consultarPlanosProyecto($idProyecto){
		$model = new Proyecto($idProyecto);
		$consulta = $model->consultarPlanosProyecto();
		return $consulta;
	}

	public function conteoEquipo($idProyecto){
		$model = new Proyecto($idProyecto);
		$consulta = $model->contarEquipo();
		return $consulta;
	}

	public function conteoOrdenes($idProyecto){
		$model = new Proyecto($idProyecto);
		$consulta = $model->contarOrdenes();
		return $consulta;
	}
}

//seccion de control para determinar que funcion se debe utilizar

$controlador = new controladorProyecto;
$funcion = null;
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