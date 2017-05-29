<?php

include ("../models/Datos.php");
include ("../models/Informe.php");

class controladorInforme{

	private $model;

	public function registrar(){
		include ("../models/Rol.php");
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

		$rol = new Rol;
		switch ($_SESSION['idRol']) {
			case $rol->consultarId('gerente'):
					header('Location: ../view/gestionInforme.php');
				break;
			case $rol->consultarId('jefe de proyecto'):
					header('Location: ../view/gestionInformeJp.php');
				break;
			case $rol->consultarId('ejecutor'):
					header('Location: ../view/gestionInformeEj.php');
				break;
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