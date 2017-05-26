<?php

include ("../models/Datos.php");
include ("../models/Empleado.php");

class controladorEmpleado{

	private $model;

	public function login(){
		session_start();
		$this->model = new Empleado($_REQUEST['email'],$_REQUEST['password']);

		if ($this->model->login()){
			if ($_SESSION['idRol'] == '2'){
				header('Location: ../view/lobby.php');
			}

			if ($_SESSION['idRol'] == '4'){
				header('Location: ../view/lobbyEj.php');
			}
			if ($_SESSION['idRol']== '1'){
				header('Location: ../view/lobbyJp.php');
			}
			if ($_SESSION['idRol']== '3'){
				header('Location: ../view/lobbyDi.php');
			}
			if ($_SESSION['idRol'] == '5'){
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