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
	private $idUsuario;
	
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
}

?>