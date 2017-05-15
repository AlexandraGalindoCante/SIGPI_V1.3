<?php 
include ("Datos.php");
class EquipoTrabajo {
	private $idEmpleado;
	private $idProyecto;

	public function EquipoTrabajo(){
		$parametros = func_get_args();
		$cantidad = func_num_args();
		$funcionConstructor = '_constructor'.$cantidad;
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}		
	}

	public function _constructor2($idEmpleado, $idProyecto){
		$this->idEmpleado=$idEmpleado;
		$this->idProyecto=$idProyecto;
	}

	public function agregarEquipo(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL nuevoEquipo('$this->idEmpleado','$this->idProyecto')");
		$mysql = $datos->Desconectar($mysql);
	}

	public function eliminarEquipo(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL eliminarEquipo('$this->idEmpleado','$this->idProyecto')");
		$mysql = $datos->Desconectar($mysql);
	}



}

?>