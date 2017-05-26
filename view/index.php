<!doctype html>
<html lang ="es">
<head>
<meta charset ="utf-8">
	<title>SIGPI</title>
	<link	rel="stylesheet" type="text/css" href="../css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link	rel="stylesheet" type="text/css" href="../css/estilos.css">

	<link 	rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../js/log.js"></script>
</head>

<body onload="move()" >
<header>	
<div class="jumbotron" >
<div class="templatemo_title"><span>SI</span>GPI</div>
<div class="templatemo_subtitle"><center><p><B>SISTEMA DE INFORMACION PARA </p><p>LA GESTION DE PROYECTOS</p><p> E INVENTARIOS</B></p></center></div>
</div> 
</header>


<div id="container"   >
                <div >
                    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
                
                        <div class="panel panel-default" id="panel1">
                            <div class="panel-heading" id="panel2">                                
                                <div class="row-fluid user-row">
                                    <img src="../imagenes/logofinal4.png" class="img-responsive" alt="Conxole Admin"/>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="../controladores/controladorEmpleado.php" id="signup" class="form-signin" >
                                    <fieldset>
                                        <label class="panel-login">
                                            <div class="login_result"></div>
                                        </label>
                                        <input class="form-control" placeholder="Correo electronico" name="email" type="email" autofocus>
                                        <input class="form-control" placeholder="Contraseña" name="password" type="password">
                                        <br></br>
                                        <button type="submit" class="btn btn-tema btn-lg btn-block pull-right" width="200">Iniciar sesion</button>
                    
                    </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
           

<footer>
<div id="m-soc2">

 <div id="copyright"><h5>Sistema de Informaciòn para la Gestión de Proyectos e Inventarios | Todos Los Derechos Reservados | </h5><span class="fa fa-copyright"> </span> Copyright 2016 </div>
   
 </div>

</footer>
<script >
        function move(){
            var elem = document.getElementById("container");
            var pos= -120;
            varid = setInterval(frame, 5);
            function frame(){
                if (pos == -20) {
                    clearInterval(id);

                }else{
                    pos++;
                    elem.style.top = pos + 'px';
                }
            }
        }
    </script>
</body>

</html>