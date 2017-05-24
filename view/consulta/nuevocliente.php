<?php

include ("libSigpi.php");

$mysql = conectar();
$mysql->query("insert into cliente (nombre,telefonoFijo,telefonoCelular,correoElectronico,nit,visibilidad)
	values('$_REQUEST[nombre]','$_REQUEST[fijo]','$_REQUEST[celular]','$_REQUEST[email]','$_REQUEST[nit]','1')")
	or die($mysql->error);
$mysql->close();


	header('Location: ../gestionCliente.php');
?>



