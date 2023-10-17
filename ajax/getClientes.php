<?php
	require_once ("conexion.php");
	$query_value_search = "";
	$query_search = "";
	
	//main query to fetch the data
	$query_select_clientes = "SELECT * FROM t_clientes WHERE estado = 'A';";
	$result_select_clientes = mysqli_query($conexion,$query_select_clientes);
	if($result_select_clientes){
		if ($numrows = mysqli_num_rows($result_select_clientes) > 0){
		?>
        <div class="card-body">
			<table  class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class='text-center'>ID</th>
						<th class='text-center'>Nombre</th>
						<th class='text-center'>Apellido</th>
						<th class='text-center'>Descuento %</th>
						<th class='text-center'>Tel/Celular</th>
						<th class='text-center'>Opciones</th>
					</tr>
				</thead>
				<tbody>
				<?php
					while($row = mysqli_fetch_array($result_select_clientes)){
						$getID = $row['Id'];
						$getNombre = $row['nombre'];
						$getApellido = $row['apellido'];
						$getDescuento = $row['descuento'];
						$getTelefono = $row['telefono'];
						$getLocalidad = $row['localidad'];
						$getDireccion = $row['direccion'];
						$getFechaAlta = $row['fecha_alta'] ." a las ". $row['hora_alta'];
						
				?>
				<tr>
					<td class='text-center'><?php echo $getID;?></td>
					<td class='text-center'><?php echo $getNombre;?></td>
					<td class='text-center'><?php echo $getApellido;?></td>
					<td class='text-center'><?php echo $getDescuento;?></td>
					<td class='text-center'><?php echo $getTelefono;?></td>
					<td align="center" width="15%"><?php
						echo "<a href='#' data-target='#infoClienteModal' class='info' data-toggle='modal' data-id='$getID' data-nombre='$getNombre' data-apellido='$getApellido' data-falta='$getFechaAlta'><i class='fas fa-info-circle'></i></a>&nbsp;&nbsp;&nbsp;";
						echo "<a href='#' data-target='#editClienteModal' class='edit' data-toggle='modal' data-id='$getID' data-nombre='$getNombre' data-apellido='$getApellido' data-desc='$getDescuento' data-telefono='$getTelefono' data-direccion='$getDireccion' data-localidad='$getLocalidad'><font color='blue'><i class='fas fa-edit'></i></a>&nbsp;&nbsp;&nbsp;";
						echo "<a href='#' data-target='#deleteClienteModal' class='delete' data-toggle='modal' data-id='$getID' data-nombre='$getNombre' data-apellido='$getApellido'><font color='red'><i class='fas fa-trash'></i></a>";
					?></td>
				</tr>
				<?php }?>
				</tbody>
			</table>
		</div>
		<?php
		}else{
			echo "No hay registros agregados";
		}
	}else{
		echo "No se pudieron cargar los clientes . Error result_select_clientes";
	}
?>