
<html lang ="es">
<head>
<meta charset ="utf-8">
<title>SIGPI</title>

<link   rel="stylesheet" type="text/css" href="css/estilosS.css">
<link   rel="stylesheet" type="text/css" href="css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">


<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body >
<header>    
  <nav class="navbar navbar-inv">
  <div class="container-fluid">
    <div class="navbar-header">
     
      <a class="navbar-brand" href="#">
        
      </a>
       </div>
  </div>
</nav>



</header>


<?php
include('view/modals/md_recuperacionContrasena.php');
?>




  <div class="container-fluid">
    <div class="row">


<div class="body"></div>

    <div class="grad"></div>

  <div class="header">
    <form method="post" action="controladores/controladorEmpleado.php" id="signup" class="form-login" >
    <div id="templatemo_title" ><span>SI</span>GPI</div>
  </div>
    <br>
    <div class="login"> <center><h4>Ingreso al sistema</h4></center>
      <div id="mensaje0" class="errores">Ingrese su correo </div>
      <div id="mensaje3" class="errores"> Correo electrónico no válido</div>

      <input type="text" id="correo" placeholder="correo electrónico" name="email"><br>
      <div id="mensaje2" class="errores"> Ingrese su contraseña </div>
      <input type="password" placeholder="Contraseña" name="password" id="pass"><br>

      <button type="submit" name="button" value="Registrar" class="button" id="boton" width="200">Iniciar sesion</button>

      <div style="text-align: center" class="panel-footer" id="recPass">
          <a href="#" data-toggle="modal" data-target="#recuperarContrasena" style="color:#BBBBBB"> ¿Olvidó su contraseña? </a>
      </div>
    </div>
    </form>



    </div>
  </div>
</div>
<div class"container-fluid">
  <div class="row">
     <footer >
  
    <div id="copyright">Sistema de Información para la Gestión de Proyectos e Inventarios | Todos Los Derechos Reservados <br><span class="fa fa-copyright"> Copyright 2017</span>  </div>
  

  </footer>
  </div>
</div>



</body>
<script type="text/javascript" src="js/jquery-1.11.1.min.js" ></script>
<script type="text/javascript" src="js/vali.js" ></script>


</html> 