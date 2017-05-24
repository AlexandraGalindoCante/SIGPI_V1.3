<?php
session_start();
 
include ("libSigpi.php");
 
  $nombre = $_FILES['plano']['name'];
  $nombre_tmp = $_FILES['plano']['tmp_name'];
  $ruta = "archivos/".$nombre;
  $tipo = $_FILES['plano']['type'];
  $tamano = $_FILES['plano']['size'];
  $descripcion = $_REQUEST['desc'];

  $limite = 500 * 1024;
 
  if( $tipo =='application/pdf' && $tamano <= $limite ){
        $mysql = conectar();
        $mysql->query("insert into plano (descripcion,Proyecto_idProyecto,visibilidad) 
            values ('$_REQUEST[desc]','$_SESSION[idProyecto]','1')")
            or die($mysql->error);

      $plano=$mysql->query("select max(idPlano) as idPlano from plano");
      $vec=$plano->fetch_array();
      $mysql->query("insert into archivoPlano (tipoArchivo,tamano,ruta,empleado_idEmpleado,plano_idPlano,visibilidad) 
        values ('$tipo','$tamano','$ruta','$_SESSION[idEmpleado]','$vec[idPlano]','1')")
        or die($mysql->error);

      $mysql->close();



        move_uploaded_file($nombre_tmp,
          "../archivos/" . $nombre);
    }
  







	header('Location: ../gestionPlano.php');



?>