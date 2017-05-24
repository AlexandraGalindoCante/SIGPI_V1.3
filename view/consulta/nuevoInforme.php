<?php
session_start();
 
include ("libSigpi.php");
 
  $nombre = $_FILES['informe']['name'];
  $nombre_tmp = $_FILES['informe']['tmp_name'];
  $ruta = "archivos/".$nombre;
  $tipo = $_FILES['informe']['type'];
  $tamano = $_FILES['informe']['size'];
  $descripcion = $_REQUEST['desc'];

  $limite = 500 * 1024;
 
  if( $tipo =='application/pdf' && $tamano <= $limite ){
        $mysql = conectar();
       
      $mysql->query("insert into informe (nombre,tipoArchivo,tamano,ruta,empleado_idEmpleado,Proyecto_idProyecto,visibilidad) 
        values ('$descripcion','$tipo','$tamano','$ruta','$_SESSION[idEmpleado]','$_SESSION[idProyecto]','1')")
        or die($mysql->error);

      $mysql->close();



        move_uploaded_file($nombre_tmp,
          "../archivos/" . $nombre);
    }
  



if ($_SESSION['idRol']==4) {
    header('Location: ../gestionInformeEj.php');

}


if ($_SESSION['idRol']==2) {
    header('Location: ../gestionInforme.php');

}






?>