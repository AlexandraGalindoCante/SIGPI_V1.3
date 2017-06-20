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

	public function setContrasena($pass){
		$this->contrasena = $pass;
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
		if ($vector['Usuario'] == 1){
			$datos = new Datos();
			$mysql = $datos->conectar();	
			$this->contrasena =  $this->generarContrasena();
			//$this->contrasena = '234';//Todas los cambios de contraseñas seran 234 mientras se hacen pruebas
			$enc_contrasena = password_hash($this->contrasena, PASSWORD_DEFAULT);
			$mysql->query("CALL cambiarContrasena('$this->nombreUsuario', '$enc_contrasena')");
			
				$asunto = "Sigpi- inicio";
				$mensaje = "Usuario: ".$this->nombreUsuario."\n"."Contraseña: $this->contrasena";
				$cab = 'From: caflorez23@misena.edu.co' . "\n".
				'Reply-To: remitente@dominio.com'."\n".
				'X-Mailer: PHP/'.phpversion();
				mail("$this->nombreUsuario", $asunto, $mensaje, $cab);

			
			$mysql = $datos->Desconectar($mysql);
		} 

	}

	public function validarContrasena(){
		session_start();
		$datos = new Datos();
		$mysql = $datos->conectar();	
		$idEmpleado = $_SESSION['idEmpleado'];	
		$consulta=$mysql->query("CALL buscarUsuario('$idEmpleado')");
		$mysql = $datos->Desconectar($mysql);
		if ($vector=mysqli_fetch_array($consulta) ) {
			if(password_verify($this->contrasena, $vector['contrasena'])){
				$this->setNombreUsuario($vector['nombreUsuario']);
				return True;
			}
			else {
				return false;
			}
		}
		else{
			return False;
		}
	}

	public function cambiarContrasena(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$enc_contrasena = password_hash($this->contrasena, PASSWORD_DEFAULT);
		$mysql->query("CALL cambiarContrasena('$this->nombreUsuario', '$enc_contrasena')");
		$mysql = $datos->Desconectar($mysql);
	}


}



 ?>