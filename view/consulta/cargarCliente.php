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
		$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM cliente where visibilidad = '1' ");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'gestionCliente.php';
		//consulta principal para recuperar los datos
		$query = mysqli_query($con,"SELECT * FROM Cliente where visibilidad = '1' order by nombre asc LIMIT $offset,$per_page");
		
		if ($numrows>0){
			?>
		<table class="table table-bordered">
			  <thead>
				<tr>
				    <th>Nombre</th>
				    <th>Telefono fijo</th>
				    <th>Celular</th>
				    <th>Correo electronico</th>
				    <th>Nit</th>
				    <th>Acciones</th>
			    </tr>
			</thead>
			<tbody>
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['nombre'];?></td>
					<td><?php echo $row['telefonoFijo'];?></td>
					<td><?php echo $row['telefonoCelular'];?></td>
					<td><?php echo $row['correoElectronico'];?></td>
					<td><?php echo $row['nit'];?></td>
					<td>
						<button type="button" class="btn btn-tema" data-toggle="modal" data-target="#modificarCliente" data-id="<?php echo $row['idCliente']?>" data-nombre="<?php echo $row['nombre']?>" data-fijo="<?php echo $row['telefonoFijo']?>" data-celular="<?php echo $row['telefonoCelular']?>" data-correo="<?php echo $row['correoElectronico']?>" data-nit="<?php echo $row['nit']?>"><i class='glyphicon glyphicon-edit'></i> Modificar</button>
						<button type="button" class="btn btn-tema" data-toggle="modal" data-target="#eliminarCliente" data-id="<?php echo $row['idCliente']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button>
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
