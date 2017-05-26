<?php

include ("../models/Datos.php");
include ("../models/Empleado.php");

class controladorEmpleado{

	private $model;

	public function actualizar(){
		$model = new Empleado($_REQUEST['nombre'],$_REQUEST['documento'],$_REQUEST['telefono'],$_REQUEST['celular'],$_REQUEST['email'],$_REQUEST['direccion'],$_REQUEST['idRol'],$_REQUEST['idEmpleado'],$_REQUEST['idUsuario']);
		$model->actualizarEmpleado();
	}

	public function registrar(){
		$model = new Empleado($_REQUEST['nombre'],$_REQUEST['documento'],$_REQUEST['telefono'],$_REQUEST['celular'],$_REQUEST['email'],$_REQUEST['direccion'],$_REQUEST['idRol']);
		$model->registrarEmpleado();
	}

	public function inhabilitar(){
		$empleado = new Empleado($_REQUEST['idEmpleado']);
		$empleado->inhabilitarEmpleado();
	}

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

//seccion de control para determinar que funcion se debe utilizar

$controlador = new controladorEmpleado;

if(isset($_REQUEST['nombre']) && isset($_REQUEST['idUsuario'])){
	$funcion = 'actualizar';
}elseif(isset($_REQUEST['email']) && isset($_REQUEST['password'])){
	$funcion = 'login';
}elseif(isset($_REQUEST['nombre'])){
	$funcion = 'registrar';
}elseif(isset($_REQUEST['idEmpleado'])){
	$funcion = 'inhabilitar';
}

if(method_exists($controlador, $funcion)){
	call_user_func(array($controlador, $funcion));
}


?>