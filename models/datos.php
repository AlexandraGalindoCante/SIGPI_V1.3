<?php
class Datos{

	private $host="localhost";
	private $password="";
	private $user="root";
	private $dbName="sigpi";

	public  function conectar(){

		$mysql = new mysqli($host,$user,$password,$dbName);
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
