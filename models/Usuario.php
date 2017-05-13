<?php 
include ("Datos.php");
class Usuario {
	private $idUsuario;
	private $nombreUsuario;
	protected $contrasena;

	public function Usuario(){
		$this->contrasena = $this->generarContrasena();
	}
	
	public function generarContrasena(){
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,10);
	}
}



 ?>