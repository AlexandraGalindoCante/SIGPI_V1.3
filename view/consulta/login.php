<?php

include ("libSigpi.php");
session_start();
$con = conectar();




$registro = $con->query("select idEmpleado, Empleado.visibilidad, nombreCompleto, Rol_idRol, nombre as rol
	from Empleado inner join Usuario on Empleado.Usuario_idUsuario = Usuario.idUsuario 
	inner join rol on Empleado.Rol_idRol = Rol.idRol 
	where (nombreUsuario = '$_REQUEST[email]') && (contrasena = '$_REQUEST[password]') ") or die($mysql->error);

if($row = mysqli_fetch_array($registro)){
	$_SESSION['sesion']=1;
	$_SESSION['idEmpleado'] = $row['idEmpleado'];
	$_SESSION['empleado'] = $row['nombreCompleto'];
	$_SESSION['idRol'] = $row['Rol_idRol'];
	$_SESSION['rol'] = $row['rol'];
	if ($row['visibilidad'] == '1'){
		
		if ($row['Rol_idRol'] == '2'){
			header('Location: ../lobby.php');
		}

		if ($row['Rol_idRol'] == '4'){
			header('Location: ../lobbyEj.php');
		}
		if ($row['Rol_idRol'] == '1'){
			header('Location: ../lobbyJp.php');
		}
		if ($row['Rol_idRol'] == '3'){
			header('Location: ../lobbyDi.php');
		}
		if ($row['Rol_idRol'] == '5'){
			header('Location: ../lobbyAl.php');
		}
	}
	if ($row['visibilidad'] == '0'){
		header('Location: ../index.php');
	}
}



else{
	header('Location: ../index.php');
}


?>