<?php

include ("../models/Datos.php");
include ("../models/Informe.php");

class controladorInforme{

	private $model;

	public function registrar(){
		session_start();
		$nombre = $_FILES['informe']['name'];
		$nombre_tmp = $_FILES['informe']['tmp_name'];
		$ruta = "../archivos/".$nombre;
		$tipo = $_FILES['informe']['type'];
		$tamano = $_FILES['informe']['size'];
		$descripcion = $_REQUEST['desc'];
		$limite = 500 * 1024;
	 
		if( $tipo =='application/pdf' && $tamano <= $limite ){
			$informe = new Informe($descripcion, $tipo, $tamano, $ruta, $_SESSION['idEmpleado'], $_SESSION['idProyecto']);
			$informe->registrarInforme();

			move_uploaded_file($nombre_tmp, "../archivos/".$nombre);
		}
	}

	public function inhabilitar(){
		$model = new Informe($_REQUEST['idInforme']);
		$model->inhabilitarInforme();
	}
}

//seccion de control para determinar que funcion se debe utilizar

$controlador = new controladorInforme;

if(isset($_REQUEST['desc'])){
	$funcion = 'registrar';
}elseif(isset($_REQUEST['idInforme'])){
	$funcion = 'inhabilitar';
}

if(method_exists($controlador, $funcion)){
	call_user_func(array($controlador, $funcion));
}


?>