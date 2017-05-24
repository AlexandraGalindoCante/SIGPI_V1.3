<?php
 
if( !isset($_FILES['plano']) ){
  echo 'Ha habido un error, tienes que elegir un plano<br/>';
  echo '<a href="gestionPlano.php">Subir plano</a>';
}else{
 
  $nombre = $_FILES['plano']['name'];
  $nombre_tmp = $_FILES['plano']['tmp_name'];
  $tipo = $_FILES['plano']['type'];
  $tamano = $_FILES['plano']['size'];
 
  $ext_permitidas = array('jpg','jpeg','gif','png');
  $partes_nombre = explode('.', $nombre);
  $extension = end( $partes_nombre );
  $ext_correcta = in_array($extension, $ext_permitidas);
 
  $tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png)$/', $tipo);
 
  $limite = 500 * 1024;
 
  if( $ext_correcta && $tipo_correcto && $tamano <= $limite ){
    if( $_FILES['plano']['error'] > 0 ){
      echo 'Error: ' . $_FILES['plano']['error'] . '<br/>';
    }else{
      echo 'Nombre: ' . $nombre . '<br/>';
      echo 'Tipo: ' . $tipo . '<br/>';
      echo 'Tamaño: ' . ($tamano / 1024) . ' Kb<br/>';
      echo 'Guardado en: ' . $nombre_tmp;
 
      if( file_exists( 'subidas/'.$nombre) ){
        echo '<br/>El plano ya existe: ' . $nombre;
      }else{
        move_uploaded_file($nombre_tmp,
          "../archivos/" . $nombre);
 
        echo "<br/>Guardado en: " . "archivos/" . $nombre;
        echo "<br><img src=\"../archivos/".$nombre."\">";      }
    }
  }else{
    echo 'plano inválido';
  }
}
?>