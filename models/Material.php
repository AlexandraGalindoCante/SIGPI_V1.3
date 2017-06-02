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

	public function _constructor1($idMaterial){
		$this->idMaterial=$idMaterial;
	}

	public function _constructor4 ($referencia,$especificaciones,$unidadMedida,$cantDisponible){
		$this->referencia=$referencia;
		$this->especificaciones=$especificaciones;
		$this->unidadMedida=$unidadMedida;
		$this->cantDisponible=$cantDisponible;

	}
		public function _constructor5($idMaterial,$referencia,$especificaciones,$unidadMedida,$cantDisponible){
		$this->referencia=$referencia;
		$this->especificaciones=$especificaciones;
		$this->unidadMedida=$unidadMedida;
		$this->cantDisponible=$cantDisponible;
		$this->idMaterial=$idMaterial;
	}

	public function getId(){
		return $this->idMaterial;
	}

	public function registrarMaterial(){


		session_start();
		$datos = new Datos();
		$mysql = $datos->conectar();
		$idEmpleado=$_SESSION['idEmpleado'];
		$mysql->query("CALL registrarMaterial('$this->referencia','$this->especificaciones','$this->unidadMedida','$this->cantDisponible','$idEmpleado')")
			or die($mysql->error);
		$mysql = $datos->Desconectar($mysql);
	}

public function actulizarMaterial(){
		$datos = new Datos();
		$mysql = $datos->conectar();
		$idEmpleado=$_SESSION['idEmpleado'];
		$mysql->query("CALL actualizarMaterial('$this->idMaterial',$this->referencia','$this->especificaciones','$this->unidadMedida')")
		or die($mysql->error);
		$mysql = $datos->Desconectar($mysql);
	}










}

?>