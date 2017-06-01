<?php
session_start();
include ("libSigpi.php");

	# conectare la base de datos
    $con = conectar();
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		include ('pagination.php'); //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 8; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM Orden where estado = '1'");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'gestionDirectorio.php';
		//consulta principal para recuperar los datos
		$query = mysqli_query($con,"select idOrden, cantidadRequerida, cantidadDisponible, descripcion, nombre, cantidadConsumida, estado, Orden.Material_idMaterial, Plano_idPlano, referencia, especificaciones from Orden inner join Material on Orden.Material_idMaterial = idMaterial inner join Plano on Plano.idPlano = Orden.Plano_idPlano inner join Proyecto on Proyecto.idProyecto = Plano.Proyecto_idProyecto inner join OrdenTramitada on OrdenTramitada.Orden_idOrden = Orden.idOrden inner join Tramite on OrdenTramitada.Tramite_idTramite =  Tramite.idTramite where (estado = '1')  LIMIT $offset,$per_page");
		
		if ($numrows>0){
			?>
		<table class="table table-bordered">
			  <thead>
			  	<tr>
			  		<td> Proyecto</td>
			  		<td> Plano </td>
				    <td> Material</td>
				    <td> Cantidad asignada </td>
				    <td> Cantidad consumida </td>
				    <td> Devolucion </td>
			  	</tr>
			</thead>
			<tbody>
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['nombre'];?></td>
					<td><?php echo $row['descripcion'];?></td>
					<td><?php echo $row['referencia'];?></td>
					<td><?php echo $row['cantidadRequerida'];?></td>
					<td><?php echo $row['cantidadConsumida'];?></td>
					<td>
						<?php 
							echo '<button type="button" class="btn btn-tema pull-right" data-toggle="modal" data-target="#devolucion" data-ord="'.$row["idOrden"].'" data-mat="'.$row["Material_idMaterial"].'" data-con="'.$row["cantidadConsumida"].'" data-disp="'.$row["cantidadDisponible"].'" data-emp="'.$_SESSION["idEmpleado"].'"><span class="fa fa-indent"></span></i> Devolver </button>';
						?>


					</td>

				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<div class="table-pagination pull-right">
			<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
		</div>
		
			<?php
			
		} else {
			?>
			<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}
	}
?>

