<?php 

class Cliente {
	
	private $idCliente;
	private $nombre;
	private $telefonoFijo;
	private $telefonoCelular;
	private $correoElectronico;
	private $nit;
	
	public function Cliente(){
		$parametros = func_get_args();//toma todos los parametros que ele envian y los guarda en un vector
		$cantidad = func_num_args();//cuenta cant de parametrs enviados
		$funcionConstructor = '_constructor'.$cantidad;//crea un string que va a tener el nombre del metodo + cantidad de parametros
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}
	}

	public function _constructor1($idCliente){
		$this->idCliente=$idCliente;
	}

	public function getId(){
		return $this->idCliente;
	}
}

?>