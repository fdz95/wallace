<?php
	if (empty($_POST['comanda_add_mesa'])){
		$errors[] = "ERROR comanda_add_mesa";
	} else if (!empty($_POST['comanda_add_mesa'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$add_num_mesa = mysqli_real_escape_string($conexion,(strip_tags($_POST["comanda_add_mesa"],ENT_QUOTES)));
		$fecha_add = date('Y-m-d');
		$hora_add = date('H:i');
		$new_cant = 0;
		
		$query_search_comanda = "SELECT * FROM t_comanda WHERE estado = 'T' AND num_mesa = '$add_num_mesa';";
		$result_query_search_comanda = mysqli_query($conexion,$query_search_comanda);
		if($result_query_search_comanda){
			if(mysqli_num_rows($result_query_search_comanda) > 0){
				while($row = mysqli_fetch_assoc($result_query_search_comanda)){
					$add_cliente = $row['cod_cliente'];
					$add_articulo = $row['articulo'];
					$add_cantidad = $row['cant_articulo'];
					$add_importe = $row['importe'];
					$add_nota = $row['notas'];
					
					$query_search_pedidos = "SELECT * FROM t_pedidos WHERE estado = 'A' AND num_mesa = '$add_num_mesa' AND articulo = '$add_articulo';";
					$result_query_search_pedidos = mysqli_query($conexion,$query_search_pedidos);
					if($result_query_search_pedidos){
						if(mysqli_num_rows($result_query_search_pedidos) > 0){
							$row_pedidos = mysqli_fetch_assoc($result_query_search_pedidos);
							$old_cant = $row_pedidos['cant_articulos'];
							$new_cant = $add_cantidad + $old_cant;
							
							$query_search_update_pedidos = "UPDATE t_pedidos SET cant_articulo = '$new_cant' WHERE estado = 'A' AND num_mesa = '$add_num_mesa' AND articulo = '$add_articulo';";
							$result_search_update_pedidos = mysqli_query($conexion,$query_search_update_pedidos);
							if ($result_search_update_pedidos){
								updateComanda($add_num_mesa,$add_articulo);
							}else{
								$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_search_update_pedidos</br>";
								$errors[] = mysqli_error($conexion);
							}
						}else{
							$query_insert_pedidos = "INSERT INTO t_pedidos(estado, cod_cliente, num_mesa, articulo, cant_articulo, importe, notas, fecha_abm, hora_abm)
							VALUES('A', '$add_cliente', '$add_num_mesa', '$add_articulo', '$add_cantidad', '100', '$add_nota', '$fecha_add', '$hora_add');";
							$result_query_insert_pedidos = mysqli_query($conexion,$query_insert_pedidos);
							if ($result_query_insert_pedidos){
								updateComanda($add_num_mesa,$add_articulo);
							}else{
								$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_insert_pedidos</br>";
								$errors[] = mysqli_error($conexion);
							}
						}
					}else{
						$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_search_pedidos</br>";	
						$errors[] = mysqli_error($conexion);
					}
				}
			}else{
				$errors[] = "No hay articulos para agregar.</br>";
			}
		}else{
			$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_search_comanda</br>";	
			$errors[] = mysqli_error($conexion);
		}
	}else{
		$errors[] = "ERROR comanda_add_mesa";
	}
	
	function 		($add_mesa,$add_articulo){
		$query_update_comanda = "UPDATE t_pedidos SET cant_articulo = '$new_cant' WHERE estado = 'A' AND num_mesa = '$add_num_mesa' AND articulo = '$add_articulo';";
		$result_update_comanda = mysqli_query($conexion,$query_update_comanda);
		if (!$result_update_comanda){
			$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_update_comanda</br>";
			$errors[] = mysqli_error($conexion);
		}
	}
	
	if (isset($errors)){
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