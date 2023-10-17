<?php
	$output = "";
	if (empty($_GET['comanda_add_mesa'])){
		$errors[] = "ERROR comanda_add_mesa";
	} else if (!empty($_GET['comanda_add_mesa'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_comanda = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_add_random"],ENT_QUOTES)));
		$comanda_show = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_show"],ENT_QUOTES)));
		$comanda_add_mesa = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_add_mesa"],ENT_QUOTES)));
		$comanda_add_cliente = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_add_cliente"],ENT_QUOTES)));
		$comanda_add_articulo = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_add_articulo"],ENT_QUOTES)));
		$comanda_add_cantidad = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_add_cantidad"],ENT_QUOTES)));
		$comanda_add_nota = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_add_nota"],ENT_QUOTES)));
		$fecha_add = date('Y-m-d');
		$hora_add = date('H:i');
		$new_cant = 0;
		$comanda_add_rubro = null;
		$comanda_add_importe = null;
		
		if(empty($comanda_add_cliente) || ($comanda_add_cliente == "Seleccione un cliente")){
			$output = "Debe seleccionar un cliente";
		}else if(empty($comanda_add_articulo) || ($comanda_add_articulo == "Seleccione un articulo")){
			$output = "Debe seleccionar un articulo";
		}else if(empty($comanda_add_cantidad)){
			$output = "Debe ingresar la cantidad";
		}else if($comanda_add_cantidad <= 0){
			$output = "Debe ingresar la cantidad";
		}else{
			$query_search_comanda = "SELECT * FROM t_comanda WHERE id_comanda = '$id_comanda' AND estado_comanda = 'T' AND estado = 'T' AND num_mesa = '$comanda_add_mesa' AND articulo = '$comanda_add_articulo';";
			$result_query_search_comanda = mysqli_query($conexion,$query_search_comanda);
			if($result_query_search_comanda){
				if(mysqli_num_rows($result_query_search_comanda) > 0){
					// si el articulo ya estaba agregado, hago update de cantidad
					$row = mysqli_fetch_assoc($result_query_search_comanda);
					$old_cant = $row['cant_articulo'];
					$new_cant = $comanda_add_cantidad + $old_cant;
					$query_search_update = "UPDATE t_comanda SET cant_articulo = '$new_cant' WHERE id_comanda = '$id_comanda' AND estado_comanda = 'T' AND estado = 'T' AND num_mesa = '$comanda_add_mesa' AND articulo = '$comanda_add_articulo';";
					$result_search_update = mysqli_query($conexion,$query_search_update);
					if (!$result_search_update) {
						$output = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_update_comanda</br>";
					}
				}else{
					$query_select_importe = "SELECT rubro, articulo, precio FROM t_articulos WHERE articulo = '$comanda_add_articulo';";
					$result_select_importe = mysqli_query($conexion,$query_select_importe);
					if($result_select_importe){
						$row = mysqli_fetch_assoc($result_select_importe);
						$comanda_add_rubro = $row['rubro'];
						$comanda_add_importe = $row['precio'];
					}else{
						$output = "No se pudo agregar. Por favor, vuelva a intentarlo. result_select_importe</br>";
					}
					
					$query_insert = "INSERT INTO t_comanda(id_comanda, estado_comanda, comanda_show, estado, cod_cliente, num_mesa, articulo, rubro, cant_articulo, cant_nueva, importe, notas, fecha_abm, hora_abm)
					VALUES('$id_comanda', 'T', '$comanda_show', 'T', '$comanda_add_cliente', '$comanda_add_mesa', '$comanda_add_articulo', '$comanda_add_rubro', '$comanda_add_cantidad', '$comanda_add_cantidad', '$comanda_add_importe', '$comanda_add_nota', '$fecha_add', '$hora_add');";
					$result_query_insert_comanda = mysqli_query($conexion,$query_insert);
					if (!$result_query_insert_comanda) {
						$output = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_insert_comanda</br>". mysqli_error($conexion);
					}
				}
			}else{
				$output = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_search_comanda</br>". mysqli_error($conexion);
			}
		}
	}else{
		$output = "ERROR comanda_add_mesa";
	}
	
	echo $output;
?>