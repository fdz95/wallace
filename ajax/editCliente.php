<?php
	if (empty($_POST['id_edit_cliente_id'])){
		$errors[] = "ERROR id_edit_cliente_id";
	} else if (!empty($_POST['id_edit_cliente_id'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_edit_cliente = mysqli_real_escape_string($conexion,(strip_tags($_POST["id_edit_cliente_id"],ENT_QUOTES)));
		$edit_cliente_nombre = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_cliente_nombre"],ENT_QUOTES)));
		$edit_cliente_apellido = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_cliente_apellido"],ENT_QUOTES)));
		$edit_cliente_descuento = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_cliente_descuento"],ENT_QUOTES)));
		$edit_cliente_celular = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_cliente_celular"],ENT_QUOTES)));
		$edit_cliente_direccion = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_cliente_direccion"],ENT_QUOTES)));
		$edit_cliente_localidad = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_cliente_localidad"],ENT_QUOTES)));
		$fecha_edit = date('Y-m-d');
		$hora_edit = date('H:i');
		
		if(empty($edit_cliente_nombre)){
			$errors[] = "Debe ingresar el nombre";
		}else if(empty($edit_cliente_apellido)){
			$errors[] = "Debe ingresar el apellido";
		}else if($edit_cliente_descuento < 0){
			$errors[] = "Debe ingresar el descuento";
		}else{
			$query_update_cliente = "UPDATE t_clientes SET nombre = '$edit_cliente_nombre', apellido = '$edit_cliente_apellido', descuento = '$edit_cliente_descuento', telefono = '$edit_cliente_celular', direccion = '$edit_cliente_direccion', localidad = '$edit_cliente_localidad', fecha = '$fecha_edit', hora = '$hora_edit' WHERE Id = '$id_edit_cliente';";
			$result_update_cliente = mysqli_query($conexion,$query_update_cliente);
			if ($result_update_cliente) {
				 $messages[] = "Editado con &eacute;xito.";
			}else{
				$errors[] = "No se pudo editar. Por favor, vuelva a intentarlo.</br>";
				$errors[] = mysqli_error($conexion);
			}
		}
	}else{
		$errors[] = "ERROR id_edit_cliente_id";
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