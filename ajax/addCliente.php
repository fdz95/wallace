<?php
	if (empty($_POST['add_cliente_nombre'])){
		$errors[] = "Debe ingresar el nombre";
	} else if (!empty($_POST['add_cliente_nombre'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$add_cliente_nombre = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_cliente_nombre"],ENT_QUOTES)));
		$add_cliente_apellido = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_cliente_apellido"],ENT_QUOTES)));
		$add_cliente_descuento = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_cliente_descuento"],ENT_QUOTES)));
		$add_cliente_celular = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_cliente_celular"],ENT_QUOTES)));
		$add_cliente_direccion = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_cliente_direccion"],ENT_QUOTES)));
		$add_cliente_localidad = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_cliente_localidad"],ENT_QUOTES)));
		$fecha_add = date('Y-m-d');
		$hora_add = date('H:i');
		
		if(empty($add_cliente_nombre)){
			$errors[] = "Debe ingresar el nombre";
		}else if($add_cliente_descuento < 0){
			$errors[] = "Debe ingresar el descuento";
		}else{
			$query_search_cliente = "SELECT * FROM t_clientes WHERE estado = 'A' AND nombre = '$add_cliente_nombre' AND apellido = '$add_cliente_apellido';";
			$result_search_cliente = mysqli_query($conexion,$query_search_cliente);
			if($result_search_cliente){
				if(mysqli_num_rows($result_search_cliente) > 0){
					$errors[] = "El cliente <b>$add_cliente_nombre $add_cliente_apellido</b> ya esta agregado";
				}else{
					$query_insert = "INSERT INTO t_clientes(estado, nombre, apellido, descuento, telefono, direccion, localidad, fecha_alta, hora_alta, fecha, hora)
					VALUES('A', '$add_cliente_nombre', '$add_cliente_apellido', '$add_cliente_descuento', '$add_cliente_celular', '$add_cliente_direccion', '$add_cliente_localidad', '$fecha_add', '$hora_add', '$fecha_add', '$hora_add');";
					$result_query_insert = mysqli_query($conexion,$query_insert);
					if ($result_query_insert) {
						 $messages[] = "Agregado con &eacute;xito.";
					}else{
						$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_insert</br>";
						$errors[] = mysqli_error($conexion);
					}
				}
			}else{
				$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_search_cliente</br>";	
				$errors[] = mysqli_error($conexion);
			}
		}
	}else{
		$errors[] = "Debe ingresar el nombre";
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