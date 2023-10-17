<?php
	if (empty($_GET['id_change_mesa'])){
		$errors[] = "ERROR id_change_mesa";
	} else if (!empty($_GET['id_change_mesa'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$old_mesa = mysqli_real_escape_string($conexion,(strip_tags($_GET["id_change_mesa"],ENT_QUOTES)));
		$new_mesa = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_add_mesa"],ENT_QUOTES)));
		
		if($new_mesa == "Seleccione una mesa"){
			$output = "Debe seleccionar una mesa";
		}else{
			$query_update = "UPDATE t_pedidos SET num_mesa = '$new_mesa' WHERE estado = 'A' AND num_mesa = '$old_mesa';";
			$result_query_update = mysqli_query($conexion,$query_update);
			if ($result_query_update) {
				 $messages[] = "Mesa cambiada con &eacute;xito.";
			}else{
				$errors[] = "No se pudo cambiar. Por favor, vuelva a intentarlo.</br>";
				$errors[] = mysqli_error($conexion);
			}
		}
	}else{
		$errors[] = "ERROR id_change_mesa";
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