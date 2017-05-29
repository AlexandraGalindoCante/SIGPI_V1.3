<?php

include ("../models/Datos.php");
include ("../models/ArchivoPlano.php");

class controladorArchivoPlano{

	private $model;

	public function registrar(){	
		include ("../models/Rol.php");
		session_start();
		$nombre = $_FILES['plano']['name'];
		$nombre_tmp = $_FILES['plano']['tmp_name'];
		$ruta = "../archivos/".$nombre;
		$tipo = $_FILES['plano']['type'];
		$tamano = $_FILES['plano']['size'];
		$descripcion = $_REQUEST['desc'];
		$limite = 500 * 1024;
	 
		if( $tipo =='application/pdf' && $tamano <= $limite ){
			$model = new ArchivoPlano($descripcion, $tipo, $tamano, $ruta, $_SESSION['idEmpleado'], $_SESSION['idProyecto']);
			$model->registrarPlano();

			move_uploaded_file($nombre_tmp, "../archivos/".$nombre);
		}

		$rol = new Rol;
		switch ($_SESSION['idRol']) {
			case $rol->consultarId('gerente'):
					header('Location: ../view/gestionPlano.php');
				break;
			case $rol->consultarId('disenador'):
					header('Location: ../view/gestionPlanoDi.php');
				break;
		}
	}

	public function inhabilitar(){

		$model = new ArchivoPlano($_REQUEST['idPlano']);
		$model->inhabilitarPlano();
	}
}

//seccion de control para determinar que funcion se debe utilizar

$controlador = new controladorArchivoPlano;

if(isset($_REQUEST['desc'])){
	$funcion = 'registrar';
}elseif(isset($_REQUEST['idPlano'])){
	$funcion = 'inhabilitar';
}

if(method_exists($controlador, $funcion)){
	call_user_func(array($controlador, $funcion));
}


?>