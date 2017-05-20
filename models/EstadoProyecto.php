<?php 

class EstadoProyecto{
	
	private $idEstadoProyecto;
	private $nombre;

	
	public function EstadoProyecto(){
		$parametros = func_get_args();//toma todos los parametros que ele envian y los guarda en un vector
		$cantidad = func_num_args();//cuenta cant de parametrs enviados
		$funcionConstructor = '_constructor'.$cantidad;//crea un string que va a tener el nombre del metodo + cantidad de parametros
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}
	}

	public function _constructor1($idEstadoProyecto){
		$this->idEstadoProyecto=$idEstadoProyecto;
	}

	public function getId(){
		return $this->idEstadoProyecto;
	}
}

?>