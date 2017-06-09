<?php


require_once("../models/Datos.php");
require_once("../models/Orden.php");

class controladorOrden{

	private $model;

	public function consultarAlertaOrden(){
		$model = new Orden;
		$consulta = $model->consultarAlerta();
		return $consulta;
	}

}

//seccion de control para determinar que funcion se debe utilizar



?>