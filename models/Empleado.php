<?php 
include ("Usuario.php");

class Empleado extends Usuario {
	private $idEmpleado;
	private $nombreCompleto;
	private $documento;
	private $telefonoFijo;
	private $telefonoCelular;
	private $correoElectronico;
	private $direccion;
	private $idRol;
	
	public function Empleado(){
		$parametros = func_get_args();
		$cantidad = func_num_args();
		$funcionConstructor = '_constructor'.$cantidad;
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}
	}

	public function _constructor1($idEmpleado){
		$this->idEmpleado=$idEmpleado;
	}
	public function _constructor2($email, $password){
		$this->correoElectronico=$email;
		$this->contrasena=$password;
	}

	public function _constructor7($nombreCompleto,$documento,$telefonoFijo,$telefonoCelular,$correoElectronico,$direccion,$idRol){
		$this->Usuario();
		$this->nombreCompleto=$nombreCompleto;
		$this->documento=$documento;
		$this->telefonoFijo=$telefonoFijo;
		$this->telefonoCelular=$telefonoCelular;
		$this->correoElectronico=$correoElectronico;
		$this->direccion=$direccion;
		$this->idRol=$idRol;
	}

	public function _constructor9($nombreCompleto,$documento,$telefonoFijo,$telefonoCelular,$correoElectronico,$direccion,$idRol,$idEmpleado,$idUsuario){
		$this->nombreCompleto=$nombreCompleto;
		$this->documento=$documento;
		$this->telefonoFijo=$telefonoFijo;
		$this->telefonoCelular=$telefonoCelular;
		$this->correoElectronico=$correoElectronico;
		$this->direccion=$direccion;
		$this->idRol=$idRol;
		$this->idUsuario=$idUsuario;
		$this->idEmpleado=$idEmpleado;
	}

	public function registrarEmpleado(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL registrarEmpleado('$this->nombreCompleto','$this->contrasena','$this->documento','$this->telefonoFijo','$this->telefonoCelular','$this->correoElectronico','$this->direccion','$this->idRol')");
		$mysql = $datos->Desconectar($mysql);
	}

	public function actualizarEmpleado(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL actualizarEmpleado('$this->nombreCompleto','$this->documento','$this->telefonoFijo','$this->telefonoCelular','$this->correoElectronico','$this->direccion','$this->idRol','$this->idUsuario','$this->idEmpleado')");
		$mysql = $datos->Desconectar($mysql);
	}

	public function inhabilitarEmpleado(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL inhabilitarEmpleado('$this->idEmpleado')");
		$mysql = $datos->Desconectar($mysql);
	}

	public function login(){
		$datos = new Datos();
		$mysql = $datos->conectar();		
		$login=$mysql->query("CALL login('$this->correoElectronico','$this->contrasena')");
		$mysql = $datos->Desconectar($mysql);
		if ($vectorLogin=mysqli_fetch_array($login) ) {
			$_SESSION['sesion']=1;
			$_SESSION['idEmpleado'] = $vectorLogin['idEmpleado'];
			$_SESSION['empleado'] = $vectorLogin['nombreCompleto'];
			$_SESSION['idRol'] = $vectorLogin['Rol_idRol'];
			$_SESSION['rol'] = $vectorLogin['rol'];
			return True;
		}

		else{
			return False;
		}
	
		
	}
}

?>