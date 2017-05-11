<?php 
include ("Datos.php");
class Usuario {
	private $idUsuario;
	private $nombreUsuario;
	private $contrasena;
	private $visibilidad;

	public function generarContrasena(){
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,10);
	}





}



 ?>