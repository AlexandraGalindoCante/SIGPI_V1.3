<?php 
class Material {


	private $idMaterial;
	private $referencia;
	private $especificaciones;
	private $unidadMedida;
	private $cantDisponible;

public function Material(){
		$parametros = func_get_args();//toma todos los parametros que ele envian y los guarda en un vector
		$cantidad = func_num_args();//cuenta cant de parametrs enviados
		$funcionConstructor = '_constructor'.$cantidad;//crea un string que va a tener el nombre del metodo + cantidad de parametros
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}
	}

	public function _constructor4 ($referencia,$especificaciones,$unidadMedida,$cantDisponible){
		$this->referencia=$referencia;
		$this->especificaciones=$especificaciones;
		$this->unidadMedida=$unidadMedida;
		$this->cantDisponible=$cantDisponible;

	}









}

?>