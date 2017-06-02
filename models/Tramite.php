<?php 
 include ("material.php");
 include ("empleado.php");

 class Tramite{

private $idTramite;
private $fecha;
private $cantidadAsignada;
private $tipo;
private $empleado;
private $material;

	public function Tramite(){

		$parametros = func_get_args();//toma todos los parametros que ele envian y los guarda en un vector
		$cantidad = func_num_args();//cuenta cant de parametrs enviados
		$funcionConstructor = '_constructor'.$cantidad;//crea un string que va a tener el nombre del metodo + cantidad de parametros
		if (method_exists($this, $funcionConstructor))
		{
			call_user_func_array(array($this,$funcionConstructor), $parametros);
		}
	}

	public function _constructor3($cantidadAsignada,$idEmpleado,$idMaterial){

		$this->cantidadAsignada=$cantidad;
		$this->empleado=new Empleado($idEmpleado);
		$this->material=new Material($idMaterial);
	}


 }


 ?>