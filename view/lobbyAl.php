<?php
session_start();
include ("consulta/libSigpi.php");
    if ($_SESSION['sesion']== 0 or  $_SESSION['idRol'] != 5){
      header('Location: index.php' );
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIGPI</title>


    <link href="../css/interfaz.css" rel="stylesheet">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mensajes.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon">

    <!-- Custom CSS -->
  
   


    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <?php 

include('modals/md_cambiarContrasena.php');

?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-custom" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">.....................</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">SIGPI</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                              

                   <li><a href="consulta/cerrarSesion.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </div>
            <div class="profile" style="margin:20px; margin-bottom: -50px;">
                <!--img_2 -->
              <div class="profile_pic" style="margin-left:70px;">
                <br>
                  <img src="../imagenes/logofinal4.png" alt="..." class="img-circle profile_img" >
              </div>
              <div class="profile_info" style="margin-left:35px;">
                 <h3> <span>Bienvenido</span></h3>
                  <h5><i><?php echo $_SESSION['empleado'];?></i> / <font style="text-transform: uppercase; color:black; "><?php echo $_SESSION['rol'] ?></font></h5>
              </div>
          </div>

         

                       <div class="navbar-default sidebar" role="navigation">

                <div class="sidebar-nav navbar-collapse">

                    <ul class="nav" id="side-menu">
                     


                        <li>
                            <a href="lobbyAl.php"><i class="fa fa-home fa-fw"></i>&nbsp;&nbsp; Inicio</a>
                        </li>

                        <li>
                            <a><i class="fa fa-building-o fa-fw"></i>&nbsp;&nbsp; Inventario<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="gestionMaterialAl.php"> &nbsp;&nbsp;Materiales</a>
                                </li>
                                <li>
                                    <a href="gestionEntradaAl.php"> &nbsp;&nbsp;Ingreso de materiales</a>
                                </li>
                                <li>
                                    <a href="gestionAsignarAl.php"> &nbsp;&nbsp;Asignacion de materiales</a>
                                </li>
                                <li>
                                    <a href="gestionDevolucionAl.php"> &nbsp;&nbsp;Ordenes asignadas</a>
                                </li>
                                <li>
                                    <a href="gestionOrdenTerminadaAl.php"> &nbsp;&nbsp;Ordenes completadas</a>
                                </li>
                               
                            </ul>
                        </li>
                        <li>
                            <a><i class="fa fa-book fa-fw"></i>&nbsp;&nbsp; Contactos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="gestionProveedorAl.php"> &nbsp;&nbsp;Proveedores</a>
                                </li>
                               
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
           
          
    <div class="container-fluid">
        <div class='col-xs-12'>  

            <h3 class='text-right'>   
                <button type="button" class="btn btn-tema btn-sm" data-toggle="modal" data-target="#cambiarContrasena" >
                    Cambiar contraseña
                </button>
            </h3>

        </div>
    </div>

<?php
    require_once("../controladores/controladorOrden.php"); 
    $controlador = new controladorOrden;
    $consulta = $controlador->consultarAlertaOrden();
    
?>
<div class="container">
    <div class="row">

        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-filter" data-target="asignada">Asignada</button>
                                <button type="button" class="btn btn-warning btn-filter" data-target="noAsignada">Sin asignar</button>
                                <button type="button" class="btn btn-danger btn-filter" data-target="sinMaterial">Falta material</button>
                                <button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-filter">
                                <tbody>

                                <?php 
                                    while($tabla = mysqli_fetch_array($consulta)){
                                        if($tabla['estado'] != "0"){
                                            $estado = "asignada";
                                            $nombreEstado = "Asignada";
                                        }else if($tabla['cantidadRequerida']<=$tabla['cantidadDisponible']){
                                            $estado = "noAsignada";
                                            $nombreEstado = "Sin asignar";
                                        }else{
                                            $estado = "sinMaterial";
                                            $nombreEstado = "Falta material";
                                        }

                                 ?>
                                    <tr data-status="<?php echo $estado ?>">
                                        
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <span class="media-meta pull-right"> <?php echo $tabla['fechaEntrega'] ?> </span>
                                                    <h4 class="title">
                                                        Proyecto: <?php echo $tabla['nombre'] ?> / Plano: <?php echo $tabla['descripcion'] ?>
                                                        <span class="pull-right <?php echo $estado ?>">(<?php echo $nombreEstado?>)</span>
                                                    </h4>
                                                    <p class="summary">Requiere <?php echo $tabla['referencia'] ?></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                        } //fin while
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>



        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/pruebaMensajes.js" ></script>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>

</body>

</html>
