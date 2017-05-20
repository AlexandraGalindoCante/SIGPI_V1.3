<?php 


class Proveedor {
	private $idProveedor;
	private $nombre;
	private $asesor;
	private $telefono;
	private $correoElectronico;
	private $direccion;
	
	public function Proveedor(){
		$parametros = func_get_args();
		$cantidad = func_num_args();
		$funcionConstructor = '_constructor'.$cantidad;
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}
	}

	public function _constructor1($idProveedor){
		$this->idProveedor=$idProveedor;
	}

	public function _constructor5($nombre,$asesor,$telefono,$correoElectronico,$direccion){
		$this->nombre=$nombre;
		$this->asesor=$asesor;
		$this->telefono=$telefono;
		$this->correoElectronico=$correoElectronico;
		$this->direccion=$direccion;
	}

	public function _constructor6($nombre,$asesor,$telefono,$correoElectronico,$direccion,$idProveedor){
		$this->nombre=$nombre;
		$this->asesor=$asesor;
		$this->telefono=$telefono;
		$this->correoElectronico=$correoElectronico;
		$this->direccion=$direccion;
		$this->idProveedor=$idProveedor;
	}

	public function registrarProveedor(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL registrarProveedor('$this->nombre','$this->asesor','$this->telefono','$this->correoElectronico','$this->telefonoCelular','$this->correoElectronico','$this->direccion')");
		$mysql = $datos->Desconectar($mysql);
	}

	public function actualizarProveedor(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL actualizarProveedor('$this->nombre','$this->asesor','$this->telefono','$this->correoElectronico','$this->telefonoCelular','$this->correoElectronico','$this->direccion')");
		$mysql = $datos->Desconectar($mysql);
	}

	public function inhabilitarProveedor(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL inhabilitarProveedor('$this->idProveedor')");
		$mysql = $datos->Desconectar($mysql);
	}

}

?>