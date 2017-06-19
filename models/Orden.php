<?php 


class Orden{
	
	private $idOrden;
	private $cantidadRequerida;
	private $cantidadConsumida;
	private $estado;
	private $material;
	private $plano;

	
	public function Orden(){
		$parametros = func_get_args();//toma todos los parametros que ele envian y los guarda en un vector
		$cantidad = func_num_args();//cuenta cant de parametrs enviados
		$funcionConstructor = '_constructor'.$cantidad;//crea un string que va a tener el nombre del metodo + cantidad de parametros
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}
	}


	public function consultarAlerta(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$consulta=$mysql->query("Select * from alertaOrden");
		$mysql = $datos->Desconectar($mysql);
		return $consulta;
	}


}

?>