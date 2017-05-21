<?php 
include('Empleado.php');
include('Proyecto.php');

class Informe{
	
	private $idArchivo;
	private $nombre;
	private $tipoArchivo;
	private $tamano;
	private $ruta;
	private $empleado;
	private $proyecto;

	
	public function Informe(){
		$parametros = func_get_args();//toma todos los parametros que ele envian y los guarda en un vector
		$cantidad = func_num_args();//cuenta cant de parametrs enviados
		$funcionConstructor = '_constructor'.$cantidad;//crea un string que va a tener el nombre del metodo + cantidad de parametros
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}
	}

	public function _contructor1($idInforme){
		$this->idArchivo = $idInforme;
	}

	public function _constructor6($nombre, $tipoArchivo, $tamano, $ruta, $idEmpleado, $idProyecto){
		$this->nombre = $nombre;
		$this->tipoArchivo = $tipoArchivo;
		$this->tamano = $tamano;
		$this->ruta = $ruta;
		$this->empleado = new Empleado($idEmpleado);
		$this->proyecto = new Proyecto($idProyecto);
	}

	public function registrarInforme(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$idEmpleado = $this->empleado->getId();
		$idProyecto = $this->proyecto->getId();
		$mysql->query("CALL registrarInforme('$this->nombre','$this->tipoArchivo','$this->tamano','$this->ruta','$idEmpleado','$idProyecto')") or die($mysql->error);
		$mysql = $datos->Desconectar($mysql);
	}

	public function inhabilitarInforme(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL inhabilitarInforme('$this->idArchivo')");
		$mysql = $datos->Desconectar($mysql);
	}

}

?>