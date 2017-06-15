<?php 
class Cliente {
	private $idCliente;
	private $nombre;
	private $telefonoFijo;
	private $telefonoCelular;
	private $correoElectronico;
	private $nit;
	
	public function Cliente(){
		$parametros = func_get_args();
		$cantidad = func_num_args();
		$funcionConstructor = '_constructor'.$cantidad;
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}
	}
	public function _constructor1($idCliente){
		$this->idCliente=$idCliente;
	}
	public function _constructor5($nombre,$telefonoFijo,$telefonoCelular,$correoElectronico,$nit){
		$this->nombre=$nombre;
		$this->telefonoFijo=$telefonoFijo;
		$this->telefonoCelular=$telefonoCelular;
		$this->correoElectronico=$correoElectronico;
		$this->nit=$nit;
	}
	public function _constructor6($nombre,$telefonoFijo,$telefonoCelular,$correoElectronico,$nit,$IdCliente){
		$this->nombre=$nombre;
		$this->telefonoFijo=$telefonoFijo;
		$this->telefonoCelular=$telefonoCelular;
		$this->correoElectronico=$correoElectronico;
		$this->nit=$nit;
		$this->IdCliente=$IdCliente;
	}
	public function registrarCliente(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL registrarCliente('$this->nombre','$this->telefonoFijo','$this->telefonoCelular','$this->correoElectronico','$this->nit')");
		$mysql = $datos->Desconectar($mysql);
	}
	public function actualizarCliente(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL actualizarCliente('$this->nombre','$this->telefonoFijo','$this->telefonoCelular','$this->correoElectronico','$this->nit','$this->idCliente')");
		$mysql = $datos->Desconectar($mysql);
	}
	public function inhabilitarCliente(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL inhabilitarCliente('$this->idCliente')");
		$mysql = $datos->Desconectar($mysql);
	}
}
?>
