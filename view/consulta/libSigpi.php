<?php

	function conectar(){
		$mysql = new mysqli("localhost","root","","sigpi");
		if ($mysql->connect_error)
			die('Problemas con la conexion a la base de datos');

		return $mysql;
	}

	function generarContrasena(){
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,10);
	}

	function validarUsuario(){
		if ($_SESSION['sesion']== 1){
			header('Location: gestionProyecto.php' );
		}
		
	}


?>
