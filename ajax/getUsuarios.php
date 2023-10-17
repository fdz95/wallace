<?php
	require_once ("conexion.php");
	// DEFINO EL FORMATO DE MONEDA
	setlocale(LC_MONETARY, 'es_ES');
	
	//main query to fetch the data
	$query_select_usuarios = "SELECT * FROM t_users WHERE estado = 'A';";
	$result_select_usuarios = mysqli_query($conexion,$query_select_usuarios);
	if($result_select_usuarios){
	?>
		
              <div class="card-body">
				<table  class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class='text-center'>ID</th>
							<th class='text-center'>Tipo</th>
							<th class='text-center'>Usuario</th>
							<th class='text-center'>Nombre</th>
							<th class='text-center'>Apellido</th>
							<th class='text-center'>Telefono</th>
							<th class='text-center'>Ult. ingreso</th>
							<th class='text-center'>Opciones</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if ($numrows = mysqli_num_rows($result_select_usuarios) > 0){
						while($row = mysqli_fetch_array($result_select_usuarios)){
							$getID = $row['Id'];
							$getTipo = $row['tipo'];
							$getUser = $row['user'];
							$getPassword = $row['password'];
							$getNombre = $row['nombre'];
							$getApellido = $row['apellido'];
							$getTelefono = $row['telefono'];
							$getDireccion = $row['direccion'];
							$getLocalidad = $row['localidad'];
							$getFechaAlta = $row['fecha_alta'];
							$getFechaIng = $row['fecha_ingreso'];
							$getHoraIng = $row['hora_ingreso'];
							
								?>
								<tr>
									<td class='text-center'><?php echo $getID;?></td>
									<td class='text-center'><?php echo $getTipo;?></td>
									<td class='text-center'><?php echo $getUser;?></td>
									<td class='text-center'><?php echo $getNombre;?></td>
									<td class='text-center'><?php echo $getApellido;?></td>
									<td class='text-center'><?php echo $getTelefono;?></td>
									<td class='text-center'><?php echo $getFechaIng ." ". $getHoraIng;?></td>
									<td align="center" width="15%"><?php
										echo "<a href='#' data-target='#infoUserModal' class='info' data-toggle='modal' data-id='$getID' data-nombre='$getNombre' data-apellido='$getApellido' data-direccion='$getDireccion' data-localidad='$getLocalidad' data-falta='$getFechaAlta'><i class='fas fa-info-circle'></i></a>&nbsp;&nbsp;&nbsp;";
										echo "<a href='#' data-target='#editUserModal' class='edit' data-toggle='modal' data-id='$getID' data-tipo='$getTipo' data-user='$getUser' data-password='$getPassword' data-nombre='$getNombre' data-apellido='$getApellido' data-telefono='$getTelefono' data-direccion='$getDireccion' data-localidad='$getLocalidad'><font color='blue'><i class='fas fa-edit'></i></a>&nbsp;&nbsp;&nbsp;";
										echo "<a href='#' data-target='#deleteUserModal' class='delete' data-toggle='modal' data-id='$getID' data-user='$getUser'><font color='red'><i class='fas fa-trash'></i></a>";
									?></td>
								</tr>
					<?php }?>
					</tbody>
				</table>
			</div>
					<?php
					}else{
						echo "No hay usuarios agregados";
					}
	}else{
		echo "No se pudieron cargar los articulos . Error result_select_usuarios";
	}
?>