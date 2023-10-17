<?php
	if (empty($_POST['comanda_random'])){
		$errors[] = "ERROR comanda_random";
	} else if (!empty($_POST['comanda_random'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_comanda = mysqli_real_escape_string($conexion,(strip_tags($_POST["comanda_random"],ENT_QUOTES)));
		$comanda_show = mysqli_real_escape_string($conexion,(strip_tags($_POST["comanda_show"],ENT_QUOTES)));
		$fecha_add = date('Y-m-d');
		$hora_add = date('H:i');
		$new_cant = 0;
		
		$query_search_comanda = "SELECT * FROM t_comanda WHERE id_comanda = '$id_comanda' AND estado_comanda = 'T' AND estado = 'T';";
		$result_query_search_comanda = mysqli_query($conexion,$query_search_comanda);
		if($result_query_search_comanda){
			if(mysqli_num_rows($result_query_search_comanda) > 0){
				while($row = mysqli_fetch_assoc($result_query_search_comanda)){
					$add_num_mesa = $row['num_mesa'];
					$add_cliente = $row['cod_cliente'];
					$add_articulo = $row['articulo'];
					$add_articulo_rubro = $row['rubro'];
					$add_cantidad = $row['cant_articulo'];
					$add_cant_nueva = $row['cant_nueva'];
					$add_importe = $row['importe'];
					$add_nota = $row['notas'];
					
					$query_search_pedidos = "SELECT * FROM t_pedidos WHERE estado = 'A' AND num_mesa = '$add_num_mesa' AND articulo = '$add_articulo';";
					$result_query_search_pedidos = mysqli_query($conexion,$query_search_pedidos);
					if($result_query_search_pedidos){
						if(mysqli_num_rows($result_query_search_pedidos) > 0){
							$row_pedidos = mysqli_fetch_assoc($result_query_search_pedidos);
							$old_cant = $row_pedidos['cant_articulo'];
							$new_cant = $add_cantidad + $old_cant;
							$query_search_update_pedidos = "UPDATE t_pedidos SET cant_articulo = '$new_cant', cant_nueva = '$add_cantidad' WHERE estado = 'A' AND num_mesa = '$add_num_mesa' AND articulo = '$add_articulo';";
							$result_search_update_pedidos = mysqli_query($conexion,$query_search_update_pedidos);
							if (!$result_search_update_pedidos){
								$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_search_update_pedidos</br>";
								$errors[] = mysqli_error($conexion);
							}
						}else{
							$query_insert_pedidos = "INSERT INTO t_pedidos(id_comanda, estado_comanda, comanda_show, estado, cod_cliente, num_mesa, articulo, rubro, cant_articulo, cant_nueva, importe, notas, fecha_abm, hora_abm)
							VALUES('$id_comanda', 'T', '$comanda_show', 'A', '$add_cliente', '$add_num_mesa', '$add_articulo', '$add_articulo_rubro', '$add_cantidad', '$add_cantidad', '$add_importe', '$add_nota', '$fecha_add', '$hora_add');";
							$result_query_insert_pedidos = mysqli_query($conexion,$query_insert_pedidos);
							if (!$result_query_insert_pedidos){
								$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_insert_pedidos</br>";
								$errors[] = mysqli_error($conexion);
							}
						}
					}else{
						$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_search_pedidos</br>";	
						$errors[] = mysqli_error($conexion);
					}
				}
				
				updateComanda($conexion,$id_comanda,$comanda_show,$add_num_mesa,$fecha_add,$hora_add);
				
			}else{
				$errors[] = "No hay articulos para agregar.</br>";
			}
		}else{
			$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_search_comanda</br>";	
			$errors[] = mysqli_error($conexion);
		}
	}else{
		$errors[] = "ERROR comanda_random";
	}
	
	function updateComanda($conexion,$id_comanda, $comanda_show, $add_num_mesa, $fecha_add, $hora_add){
		$query_update_comanda = "UPDATE t_comanda SET estado = 'P' WHERE id_comanda = '$id_comanda';";
		$result_update_comanda = mysqli_query($conexion,$query_update_comanda);
		if ($result_update_comanda){
			// INSERT t_comanda_c
			$query_insert_comanda_c = "INSERT INTO t_comanda_c(estado, id_comanda, comanda_show, num_mesa, fecha, hora)
			VALUES('T', '$id_comanda', '$comanda_show', '$add_num_mesa', '$fecha_add', '$hora_add');";
			$result_insert_comanda_c = mysqli_query($conexion,$query_insert_comanda_c);
			if (!$result_insert_comanda_c) {
				$output = "No se pudo agregar. Por favor, vuelva a intentarlo. result_insert_comanda_c</br>". mysqli_error($conexion);
			}
		}else{
			$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_update_comanda</br>";
			$errors[] = mysqli_error($conexion);
		}
	}
	
	if(isset($errors)){
		?>
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error!</strong> 
			<?php
				foreach ($errors as $error) {
					echo $error;
				}
			?>
		</div>
		<?php
	}
	if (isset($messages)){
		?>
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php
				foreach ($messages as $message) {
					echo $message;
				}
			?>
		</div>
		<?php
	}
?>	