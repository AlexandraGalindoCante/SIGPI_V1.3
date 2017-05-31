<?php
class Datos{

	private $host="localhost";
	private $password="sena2017*";
	private $user="id1827931_administrador";
	private $dbName="id1827931_sigpi";

	public  function conectar(){
		$mysql = new mysqli($this->host,$this->user,$this->password,$this->dbName);
		if ($mysql->connect_error)
			die('Problemas con la conexion a la base de datos');

		return $mysql;
	}

	public function desconectar($mysql){
		$mysql->close();
		return $mysql;
	}

	function validarUsuario(){
		if ($_SESSION['sesion']== 1){
			header('Location: gestionProyecto.php' );
		}	
	}
}

?>
