<?php

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
		$per_page = 10; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM  material where visibilidad ='1'");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'gestionMaterial.php';
		//consulta principal para recuperar los datos
		$query = mysqli_query($con,"select * from  material where visibilidad = '1' LIMIT $offset,$per_page");
		
		if ($numrows>0){
			?>
		<table class="table table-bordered">
			  <thead>
			  	<tr>
				    <td> Referencia</td>
				    <td> Dimensiones</td>
				    <td> Unidad de medida</td>
				    <td> Cantidad en almacen</td>
				    <td> Proveedor</td>
				    <td> Acciones </td>
			  	</tr>
			</thead>
			<tbody>
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['referencia'];?></td>
					<td><?php echo $row['especificaciones'];?></td>
					<td><?php echo $row['unidadMedida'];?></td>
					<td><?php echo $row['cantidadDisponible'];?></td>
						<td>
						<form method="post" action="consulta/asignarSesion.php">
						<input type="hidden" name="idMaterial" value="<?php echo $row['idMaterial'] ?>">
						<button type="submit" class="bton btn-tema" ><i class='glyphicon glyphicon-user'></i> Directorio de proveedores </button>
						</form>
					</td>
					<td>
						<button type="button" class="btn btn-tema" data-toggle="modal" data-target="#modificarMaterial" data-id="<?php echo $row['idMaterial']?>" data-referencia="<?php echo $row['referencia']?>" data-cantidad="<?php echo $row['cantidadDisponible']?>" 
						data-especificaciones="<?php echo $row['especificaciones']?>">
							
							<i class='glyphicon glyphicon-edit'></i> Modificar</button>
						<button type="button" class="btn btn-tema" data-toggle="modal" data-target="#eliminarMaterial" data-id="<?php echo $row['idMaterial']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button>
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
