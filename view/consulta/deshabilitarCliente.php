<?php

include ("libSigpi.php");

$mysql=conectar();


$mysql->query("Update cliente set visibilidad = '0' where idCliente= '$_REQUEST[idCliente]' ") or 
die ($mysql->error);



$mysql->close();

header('Location: ../gestionCliente.php');

?>