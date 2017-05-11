<?php 
include ("Datos.php");
include ("Usuario.php");
class Empleado {
	private $idEmpleado;
	private $nombreCompleto;
	private $documento;
	private $telefonoFijo;
	private $telefonoCelular;
	private $correoElectronico;
	private $direccion;
	private $idRol;
	private $idUsuario;
	private $visibilidad;


	public function crear($nombreCompleto,$documento,$telefonoFijo,$telefonoCelular,$correoElectronico,$direccion,$idRol){
	$this->nombreCompleto=$nombreCompleto;
	$this->documento=$documento;
	$this->telefonoFijo=$telefonoFijo;
	$this->telefonoCelular=$telefonoCelular;
	$this->correoElectronico=$correoElectronico;
	$this->direccion,=$direccion;
	$this->idRol=$idRol;
	$this->idUsuario="";
	$this->visibilidad="";
	$this->idEmpleado="";



	}


	public function crear(){
	$mysql = conectar();
	$contrasena = generarContrasena();
	$mysql->query("CALL registrarEmpleado('$this->nombreCompleto','$this->contrasena','$this->documento','$this->telefonoFijo','$this->telefonoCelular','$this->correoElectronico','$this->direccion','$this->idRol')");
	$mysql = Desconectar($mysql);
	}

}



 ?>