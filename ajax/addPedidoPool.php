<?php
	if (empty($_POST['calc_comanda'])){
		$errors[] = "ERROR calc_comanda";
	} else if (!empty($_POST['calc_comanda'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_comanda = mysqli_real_escape_string($conexion,(strip_tags($_POST["calc_comanda"],ENT_QUOTES)));
		$pool_mesa = mysqli_real_escape_string($conexion,(strip_tags($_POST["calc_mesa"],ENT_QUOTES)));
		$pool_minutos = mysqli_real_escape_string($conexion,(strip_tags($_POST["calc_pool_minutos"],ENT_QUOTES)));
		$comanda_add_cliente = mysqli_real_escape_string($conexion,(strip_tags($_POST["comanda_add_cliente"],ENT_QUOTES)));
		$pool_importe_total = mysqli_real_escape_string($conexion,(strip_tags($_POST["pool_importe_total"],ENT_QUOTES)));
		$fecha_add = date('Y-m-d');
		$hora_add = date('H:i');
		$new_cant = 0;
		
		if(empty($comanda_add_cliente) || ($comanda_add_cliente == "Seleccione un cliente")){
			$errors[] = "Debe seleccionar un cliente";
		}
		$query_insert_pool = "INSERT INTO t_pedidos(id_comanda, estado_comanda, estado, cod_cliente, num_mesa, articulo, cant_articulo, importe, notas, fecha_abm, hora_abm)
		VALUES('$id_comanda', 'T', 'A', '$comanda_add_cliente', '$pool_mesa', 'POOL', '1', '$pool_importe_total', '$pool_minutos minutos', '$fecha_add', '$hora_add');";
		$result_insert_pool = mysqli_query($conexion,$query_insert_pool);
		if ($result_insert_pool){
			$messages[] = "Agregado con exito.";
		}else{
			$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_insert_pool</br>";
			$errors[] = mysqli_error($conexion);
		}
	}else{
		$errors[] = "ERROR calc_comanda";
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