<?php

include ("../models/Datos.php");
include ("../models/Empleado.php");

class controladorEmpleado{

	private $model;

	public function login(){
		session_start();
		include ("../models/Rol.php");
		$this->model = new Empleado($_REQUEST['email'],$_REQUEST['password']);
		$rol = new Rol;
		if ($this->model->login()){
			if ($_SESSION['idRol'] == $rol->consultarId('gerente')){
				header('Location: ../view/lobby.php');
			}

			if ($_SESSION['idRol'] == $rol->consultarId('ejecutor')){
				header('Location: ../view/lobbyEj.php');
			}
			if ($_SESSION['idRol']== $rol->consultarId('jefe de proyecto')){
				header('Location: ../view/lobbyJp.php');
			}
			if ($_SESSION['idRol']== $rol->consultarId('disenador')){
				header('Location: ../view/lobbyDi.php');
			}
			if ($_SESSION['idRol'] == $rol->consultarId('almacenista')){
				header('Location: ../lobbyAl.php');
			}
		}
		else{
			header('Location: ../view/index.php');
		}
	}


}

$controlador = new controladorEmpleado;
if(isset($_REQUEST['email']) && $_REQUEST['password']){
	$funcion = 'login';
}



if(method_exists($controlador, $funcion)){
	call_user_func(array($controlador, $funcion));
}



?>