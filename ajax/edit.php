<?php
	if (empty($_POST['id_edit_mesa'])){
		$errors[] = "ERROR id_edit_mesa";
	} else if (!empty($_POST['id_edit_mesa'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$edit_num_mesa = mysqli_real_escape_string($conexion,(strip_tags($_POST["id_edit_mesa"],ENT_QUOTES)));
		$edit_articulo = mysqli_real_escape_string($conexion,(strip_tags($_POST["id_edit_articulo"],ENT_QUOTES)));
		$edit_cantidad = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_cantidad"],ENT_QUOTES)));
		$edit_nota = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_nota"],ENT_QUOTES)));
		$fecha_edit = date('Y-m-d');
		$hora_edit = date('H:i');
		
		if(empty($edit_articulo)){
			$errors[] = "Debe seleccionar un articulo";
		}else if(empty($edit_cantidad)){
			$errors[] = "Debe ingresar la cantidad";
		}else if($edit_cantidad <= 0){
			$errors[] = "Debe ingresar la cantidad";
		}else{
			$query_update = "UPDATE t_pedidos SET cant_articulo = '$edit_cantidad', notas = '$edit_nota', fecha_abm = '$fecha_edit', hora_abm = '$hora_edit' WHERE estado = 'A' AND num_mesa = '$edit_num_mesa' AND articulo = '$edit_articulo';";
			$result_query_update = mysqli_query($conexion,$query_update);
			if ($result_query_update) {
				 $messages[] = "Editado con &eacute;xito.";
			}else{
				$errors[] = "No se pudo editar. Por favor, vuelva a intentarlo.</br>";
				$errors[] = mysqli_error($conexion);
			}
		}
	}else{
		$errors[] = "ERROR id_edit_mesa";
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