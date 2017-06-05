<?php


include ("../models/Datos.php");
include ("../models/Tramite.php");

class controladorTramite{

	private $model;

	public function reporteEntradaMaterial($idMaterial){
		$model = new Tramite;
		$model->setMaterial($idMaterial);
		$consulta = $model->buscarEntradaMaterial();
		
		return $consulta;
	}

	public function reporteSalidaMaterial($idMaterial){
		$model = new Tramite;
		$model->setMaterial($idMaterial);
		$consulta = $model->buscarSalidaMaterial();
		
		return $consulta;
	}

	public function reporteDevolucionMaterial($idMaterial){
		$model = new Tramite;
		$model->setMaterial($idMaterial);
		$consulta = $model->buscarDevolucionMaterial();
		
		return $consulta;
	}

	public function reporteConteoEntrada($idMaterial){
		$model = new Tramite;
		$model->setMaterial($idMaterial);
		$consulta = $model->contarEntrada();
		
		return $consulta;
	}

	public function reporteConteoSalida($idMaterial){
		$model = new Tramite;
		$model->setMaterial($idMaterial);
		$consulta = $model->contarSalida();
		
		return $consulta;
	}

	public function reporteConteoDevolucion($idMaterial){
		$model = new Tramite;
		$model->setMaterial($idMaterial);
		$consulta = $model->contarDevolucion();
		
		return $consulta;
	}

	public function reporteConsultaMaterial($idMaterial){
		$model = new Tramite;
		$model->setMaterial($idMaterial);
		$consulta = $model->consultarMaterial();
		return $consulta;
	}

}

//seccion de control para determinar que funcion se debe utilizar



?>