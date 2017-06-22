<html lang ="es">
    <head>
    <meta charset ="utf-8">
    <title>SIGPI</title>
    <link   rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link   rel="stylesheet" type="text/css" href="css/estilos.css">
     <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    

    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon">
   
  
    </head>

    <body >
    <header>    
    <div class="jumbotron" >
    <div class="templatemo_title"><span>SI</span>GPI</div>
    <div class="templatemo_subtitle"><center><p><B>SISTEMA DE INFORMACION PARA </p><p>LA GESTION DE PROYECTOS</p><p> E INVENTARIOS</B></p></center></div>
     
    </header>

    <?php
    include('view/modals/md_recuperacionContrasena.php');
    ?>
    <div id="container">

    <div class="wrapper">
          <div class="panel panel-default" id="panel1">
            <div class="panel-heading" id="panel2">                                
                <div class="row-fluid user-row">
                    <img src="imagenes/logofinal4.png" class="img-responsive" alt="Conxole Admin"/>
                </div>
            </div>
         <div class="panel-body">
                        <form method="post" action="controladores/controladorEmpleado.php" id="signup" class="form-login" >
                            <fieldset>
                                <label class="panel-login">
                                    <div class="login_result"></div>
                                </label>
                                <input  placeholder="Correo electronico" name="email" id="correo" class="form-control" type="email" autofocus>
                                 <div id="mensaje0" class="errores"> Ingrese correo electronico</div>
                                <div id="mensaje3" class="errores"> Correo electrónico no válido</div>
                                <input id="pass" class="form-control" placeholder="Contraseña" name="password" type="password">
                                <div id="mensaje2" class="errores"> Ingrese su contraseña </div>
                                <br></br>


                                <button type="submit" name="submit" id="boton" value="Registrar" class="btn btn-tema btn-lg btn-block pull-right" width="200">Iniciar sesion</button>

                    <div style="text-align: center">
                        <a href="#" data-toggle="modal" data-target="#recuperarContrasena" > ¿Olvidó su contraseña? </a>
                    </div>
                            
                            
                            </fieldset>
                        </form>
                    </div>

    </div>
    </div>
    </div>
    </div>
    <footer >
    <div id="m-soc2">

    <div id="copyright"><h5>Sistema de Informaciòn para la Gestión de Proyectos e Inventarios | Todos Los Derechos Reservados | </h5><span class="fa fa-copyright"> </span> Copyright 2017 </div>

   

    </footer>
     <script type="text/javascript" src="js/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="js/vali.js" ></script>
 


</body>

</html> 