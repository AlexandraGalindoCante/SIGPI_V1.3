<?php

include ("libSigpi.php");

$mysql=conectar();


$mysql->query("Update Cliente set visibilidad = '0' where idCliente= '$_REQUEST[idCliente]' ") or 
die ($mysql->error);



$mysql->close();

header('Location: ../gestionCliente.php');

?>