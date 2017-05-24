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
		$per_page = 8; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM proveedor where visibilidad = '1'");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'gestionProveedor.php';
		//consulta principal para recuperar los datos
		$query = mysqli_query($con,"SELECT * from Proveedor where visibilidad = '1' LIMIT $offset,$per_page");
		
		if ($numrows>0){
			?>
		<table class="table table-bordered">
			  <thead>
			  	<tr>
				    <td> Nombre del proveedor</td>
				    <td> Asesor</td>
				    <td> Telefono</td>
				    <td> Correo electronico</td>
				    <td> Direccion </td> 
				    <td> Acciones </td>
			  	</tr>
			</thead>
			<tbody>
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['nombre'];?></td>
					<td><?php echo $row['asesor'];?></td>
					<td><?php echo $row['telefono'];?></td>
					<td><?php echo $row['correoElectronico'];?></td>
					<td><?php echo $row['direccion'];?></td>
					<td>
						<button type="button" class="btn btn-tema" data-toggle="modal" data-target="#modificarProveedor" data-id="<?php echo $row['idProveedor']?>" data-nombre="<?php echo $row['nombre']?>" data-asesor="<?php echo $row['asesor']?>" data-telefono="<?php echo $row['telefono']?>" data-correo="<?php echo $row['correoElectronico']?>" data-direccion="<?php echo $row['direccion']?>"><i class='glyphicon glyphicon-edit'></i> Modificar</button>
						<button type="button" class="btn btn-tema" data-toggle="modal" data-target="#eliminarProveedor" data-id="<?php echo $row['idProveedor']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button>
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
