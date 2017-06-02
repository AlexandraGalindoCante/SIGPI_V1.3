<?php


include ("../../models/Datos.php");
include ("../../models/Tramite.php");

class controladorTramite{

	private $model;

	public function reporteEntradaMaterial($idMaterial){
		$model = new Tramite;
		$model->setMaterial($idMaterial);
		$tabla = $model->buscarEntradaMaterial();
		return $tabla;
	}

	public function inhabilitar(){
		$model = new Directorio($_REQUEST['idMaterial'],$_REQUEST['idProveedor']);
		$model->eliminarDirectorio();
	}


}

//seccion de control para determinar que funcion se debe utilizar



?>