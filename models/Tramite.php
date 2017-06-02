<?php 
 include ("Material.php");
 include ("Empleado.php");

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

	public function setMaterial($idMaterial){
		$this->material = new Material($idMaterial);
	}

	public function buscarEntradaMaterial(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$idMaterial = $this->material->getId();		
		$consulta=$mysql->query("CALL reporteEntradaMaterial('$idMaterial')");
		$mysql = $datos->Desconectar($mysql);
		$vector=mysqli_fetch_array($consulta);
		return $vector;
	}

 }


 ?>