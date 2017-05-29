<?php
session_start();
if (isset($_REQUEST['idProyecto'])){
	$_SESSION['idProyecto']=$_REQUEST['idProyecto'];
	if ($_SESSION['idRol'] == '2') {
		header('Location: ../gestionEquipo.php');
	}
	if ($_SESSION['idRol'] == '1') {
	header('Location: ../gestionEquipoJp.php');
	}
	
}



if (isset($_REQUEST['idMaterial'])){
	$_SESSION['idMaterial']=$_REQUEST['idMaterial'];
	
	
	if ($_SESSION['idRol'] == '5') {
		header('Location: ../gestionDirectorioAl.php');
	}
	if ($_SESSION['idRol'] == '2') {
		header('Location: ../gestionDirectorio.php');
	}
}

if (isset($_REQUEST['numProyecto'])){

	$_SESSION['idProyecto']=$_REQUEST['numProyecto'];
		if ($_SESSION['idRol']== '4'){
			header('Location: ../gestionPlanoEj.php');
		}
		if ($_SESSION['idRol']== '2'){
			header('Location: ../gestionPlano.php');
		}
		if ($_SESSION['idRol'] == '1') {
			header('Location: ../gestionPlanoJp.php');
		}
		if ($_SESSION['idRol'] == '3') {
			header('Location: ../gestionPlanoDi.php');
		}
	
}

if (isset($_REQUEST['idPlano'])){
	$_SESSION['idPlano']=$_REQUEST['idPlano'];
	
	if ($_SESSION['idRol'] == '2') {
		header('Location: ../gestionOrden.php');
		}
	if ($_SESSION['idRol'] == '1') {
	header('Location: ../gestionOrdenJp.php');
	}
	if ($_SESSION['idRol'] == '3') {
	header('Location: ../gestionOrdenDi.php');
	}

}

if (isset($_REQUEST['infProyecto'])){
	$_SESSION['idProyecto']=$_REQUEST['infProyecto'];
	
	if ($_SESSION['idRol']== '2'){
		header('Location: ../gestionInforme.php');
	}
	if ($_SESSION['idRol']== '4'){
		header('Location: ../gestionInformeEj.php');
	}
	if ($_SESSION['idRol']== '1'){
		header('Location: ../gestionInformeJp.php');
	}

}


?>

