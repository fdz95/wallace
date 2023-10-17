<?php
	if (empty($_POST['fichas_comanda'])){
		$errors[] = "ERROR fichas_comanda";
	} else if (!empty($_POST['fichas_comanda'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_comanda = mysqli_real_escape_string($conexion,(strip_tags($_POST["fichas_comanda"],ENT_QUOTES)));
		$fichas_mesa = mysqli_real_escape_string($conexion,(strip_tags($_POST["fichas_mesa"],ENT_QUOTES)));
		$fichas_cliente = mysqli_real_escape_string($conexion,(strip_tags($_POST["fichas_cliente"],ENT_QUOTES)));
		$fichas_cantidad = mysqli_real_escape_string($conexion,(strip_tags($_POST["fichas_cantidad"],ENT_QUOTES)));
		$fichas_precio = mysqli_real_escape_string($conexion,(strip_tags($_POST["fichas_precio"],ENT_QUOTES)));
		$fecha_add = date('Y-m-d');
		$hora_add = date('H:i');
		
		if(empty($fichas_cliente) || ($fichas_cliente == "Seleccione un cliente")){
			$errors[] = "Debe seleccionar un cliente";
		}else if(empty($fichas_cantidad)){
			$errors[] = "Debe ingresar la cantidad";
		}else if($fichas_cantidad <= 0){
			$errors[] = "Debe ingresar la cantidad";
		}else{
			$query_insert_fichas = "INSERT INTO t_pedidos(id_comanda, estado_comanda, estado, cod_cliente, num_mesa, articulo, cant_articulo, importe, notas, fecha_abm, hora_abm)
			VALUES('$id_comanda', 'T', 'A', '$fichas_cliente', '$fichas_mesa', 'FICHAS', '$fichas_cantidad', '$fichas_precio', '', '$fecha_add', '$hora_add');";
			$result_insert_fichas = mysqli_query($conexion,$query_insert_fichas);
			if ($result_insert_fichas){
				$messages[] = "Agregado con exito.";
			}else{
				$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_insert_fichas</br>";
				$errors[] = mysqli_error($conexion);
			}
		}
	}else{
		$errors[] = "ERROR fichas_comanda";
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