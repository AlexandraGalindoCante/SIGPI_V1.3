<?php 

class Usuario {
	
	protected $idUsuario;
	protected $nombreUsuario;
	protected $contrasena;

	public function Usuario(){
		$this->contrasena = $this->generarContrasena();
	}
	
	public function setNombreUsuario($email){
		$this->nombreUsuario = $email;
	}

	public function generarContrasena(){
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,10);
	}

	public function recuperarContrasena(){
		$datos = new Datos();
		$mysql = $datos->conectar();		
		$consulta=$mysql->query("CALL buscarCorreo('$this->nombreUsuario')");
		$mysql = $datos->Desconectar($mysql);
		$vector=mysqli_fetch_array($consulta);
		if ($vector['usuario'] == 1){
			$datos = new Datos();
			$mysql = $datos->conectar();	
			$contrasena =  $this->generarContrasena();
			$this->contrasena = '234';//Todas los cambios de contraseñas seran 234 mientras se hacen pruebas
			$enc_contrasena = password_hash($this->contrasena, PASSWORD_DEFAULT);
			$mysql->query("CALL cambiarContrasena('$this->nombreUsuario', '$enc_contrasena')");
			/*
				$asunto = "Sigpi- inicio";
				$mensaje = "Usuario: ".$this->correoElectronico."\n"."Contraseña: $this->contrasena";
				$cab = 'From: caflorez23@misena.edu.co' . "\n".
				'Reply-To: remitente@dominio.com'."\n".
				'X-Mailer: PHP/'.phpversion();
				mail("$this->correoElectronico", $asunto, $mensaje, $cab);

			*/
			$mysql = $datos->Desconectar($mysql);
		} 

	}

}



 ?>