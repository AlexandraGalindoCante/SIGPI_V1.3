<?php 

class Rol {
	
	protected $idRol;
	protected $nombre;

	public function setNombre ($nombre){
		$this->nombre = $nombre;
	}
	
	public function consultarId($nombre){
		$this->setNombre($nombre);
		$datos = new Datos();
		$mysql = $datos->conectar();		
		$consulta=$mysql->query("CALL consultarIdRol('$this->nombre')");
		$mysql = $datos->Desconectar($mysql);
		$vector=mysqli_fetch_array($consulta);
		$this->idRol = $vector['idRol'];
		return $this->idRol;
	}
}



 ?>