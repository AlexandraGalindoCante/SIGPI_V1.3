<?php 
include('Cliente.php');
include('EstadoProyecto.php');

class Proyecto {
	
	private $idProyecto;
	private $nombre;
	private $fechaInicio;
	private $fechaEntrega;
	private $porcentajeAvance;
	private $cliente;
	private $estadoProyecto;
	
	public function Proyecto(){
		$parametros = func_get_args();//toma todos los parametros que ele envian y los guarda en un vector
		$cantidad = func_num_args();//cuenta cant de parametrs enviados
		$funcionConstructor = '_constructor'.$cantidad;//crea un string que va a tener el nombre del metodo + cantidad de parametros
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}
	}

	public function _constructor1($idProyecto){
		$this->idProyecto=$idProyecto;
	}

	public function _constructor6($nombre,$fechaInicio,$fechaEntrega,$porcentajeAvance,$idCliente,$idEstadoProyecto){
		$this->nombre=$nombre;
		$this->fechaInicio=$fechaInicio;
		$this->fechaEntrega=$fechaEntrega;
		$this->porcentajeAvance=$porcentajeAvance;
		$this->cliente= new Cliente($idCliente);
		$this->estadoProyecto= new EstadoProyecto($idEstadoProyecto);
	}

	public function _constructor7($nombre,$fechaInicio,$fechaEntrega,$porcentajeAvance,$idCliente,$idEstadoProyecto,$idProyecto){
		$this->nombre=$nombre;
		$this->fechaInicio=$fechaInicio;
		$this->fechaEntrega=$fechaEntrega;
		$this->porcentajeAvance=$porcentajeAvance;
		$this->cliente= new Cliente($idCliente);
		$this->estadoProyecto= new EstadoProyecto($idEstadoProyecto);
		$this->idProyecto= $idProyecto;
	}

	public function registrarProyecto(){
		session_start();
		$datos = new Datos();
		$mysql = $datos->conectar();
		$idCliente = $this->cliente->getId();
		$idEstadoProyecto = $this->estadoProyecto->getId();
		$mysql->query("CALL registrarProyecto('$this->nombre','$this->fechaInicio','$this->fechaEntrega','$this->porcentajeAvance','$idCliente','$idEstadoProyecto','$_SESSION[idEmpleado]')") or die($mysql->error);
		$mysql = $datos->Desconectar($mysql);
	}

	public function actualizarProyecto(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$idCliente = $this->cliente->getId();
		$idEstadoProyecto = $this->estadoProyecto->getId();
		$mysql->query("CALL actualizarProyecto('$this->nombre','$this->fechaInicio','$this->fechaEntrega','$this->porcentajeAvance','$idCliente','$idEstadoProyecto','$this->idProyecto')") or die($mysql->error);
		$mysql = $datos->Desconectar($mysql);
	}

	public function inhabilitarProyecto(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL inhabilitarProyecto('$this->idProyecto')") or die($mysql->error);
		$mysql = $datos->Desconectar($mysql);
	}
}

?>