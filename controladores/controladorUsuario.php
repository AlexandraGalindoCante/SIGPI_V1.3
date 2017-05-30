<?php

include ("../models/Datos.php");
include ("../models/Usuario.php");

class controladorUsuario{

	private $model;

	public function recuperarContrasena(){
		$model = new Usuario;
		$model->setNombreUsuario($_REQUEST['email']);
		$model->recuperarContrasena();
		header('Location: ../index.php');
	}

	public function cambiarContrasena(){
		$model = new Usuario;
		$model->setContrasena($_REQUEST['passVieja']);
		if($model->validarContrasena()){
			$model->setContrasena($_REQUEST['passNueva']);
			$model->cambiarContrasena();
		}
	}

}

//seccion de control para determinar que funcion se debe utilizar

$controlador = new controladorUsuario;

if(isset($_REQUEST['email'])){
	$funcion = 'recuperarContrasena';
}elseif(isset($_REQUEST['passNueva']) && isset($_REQUEST['passVieja'])){
	$funcion = 'cambiarContrasena';
}

if(method_exists($controlador, $funcion)){
	call_user_func(array($controlador, $funcion));
}


?>