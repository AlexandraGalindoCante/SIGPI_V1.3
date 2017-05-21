<?php 

include('Empleado.php');
include('Plano.php');

class ArchivoPlano extends Plano{
	
	private $idArchivo;
	private $nombre;
	private $tipoArchivo;
	private $tamano;
	private $ruta;
	private $empleado;

	
	public function ArchivoPlano(){
		$parametros = func_get_args();//toma todos los parametros que ele envian y los guarda en un vector
		$cantidad = func_num_args();//cuenta cant de parametrs enviados
		$funcionConstructor = '_constructor'.$cantidad;//crea un string que va a tener el nombre del metodo + cantidad de parametros
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}
	}

	public function _contructor1($idArchivoPlano){
		$this->idArchivo = $idArchivoPlano;
	}

	public function _constructor6($nombre, $tipoArchivo, $tamano, $ruta, $idEmpleado, $idProyecto){
		$this->Plano($nombre, $idProyecto);
		$this->tipoArchivo = $tipoArchivo;
		$this->tamano = $tamano;
		$this->ruta = $ruta;
		$this->empleado = new Empleado($idEmpleado);
	}

	public function registrarPlano(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$idProyecto = $this->proyecto->getId();
		$idEmpleado = $this->empleado->getId();
		$mysql->query("CALL registrarPlano('$this->descripcion','$this->tipoArchivo','$this->tamano','$this->ruta','$idEmpleado','$idProyecto')") or die($mysql->error);
		$mysql = $datos->Desconectar($mysql);
	}

	public function inhabilitarPlano(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$mysql->query("CALL inhabilitarPlano('$this->idArchivo')");
		$mysql = $datos->Desconectar($mysql);
	}

}

?>