<?php 

class Directorio{
	private $idMaterial;
	private $idProveedor;

	public function Directorio(){
		$parametros = func_get_args();
		$cantidad = func_num_args();
		$funcionConstructor = '_constructor'.$cantidad;
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}		
	}

	public function _constructor2($idMaterial, $idProveedor){
		$this->idMaterial=$idMaterial;
		$this->idProveedor=$idProveedor;
	}

	public function agregarDirectorio(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL nuevoDirectorio('$this->idMaterial','$this->idProveedor')") or die($mysql->error);
		$mysql = $datos->Desconectar($mysql);
	}

	public function eliminarDirectorio(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL eliminarDirectorio('$this->idMaterial','$this->idProveedor')");
		$mysql = $datos->Desconectar($mysql);
	}



}

?>