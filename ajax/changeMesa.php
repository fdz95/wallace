<?php
	if (empty($_GET['id_change_comanda'])){
		$errors[] = "ERROR id_change_comanda";
	} else if (!empty($_GET['id_change_comanda'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_change_comanda = mysqli_real_escape_string($conexion,(strip_tags($_GET["id_change_comanda"],ENT_QUOTES)));
		$mesa_nueva = mysqli_real_escape_string($conexion,(strip_tags($_GET["mesa_nueva"],ENT_QUOTES)));
									
		if(empty($mesa_nueva)){
			$errors[] = "Debe seleccionar una mesa";
		}else if($mesa_nueva == "Seleccione una mesa"){
			$errors[] = "Debe seleccionar una mesa";
		}else{
			$query_update_comanda = "UPDATE t_pedidos SET id_comanda = '$id_change_comanda' WHERE num_mesa = '$mesa_nueva' AND estado = 'A';";
			$result_update_comanda = mysqli_query($conexion,$query_update_comanda);
			if ($result_update_comanda) {
				$query_update_num_mesa = "UPDATE t_pedidos SET num_mesa = '$mesa_nueva' WHERE estado = 'A' AND id_comanda = '$id_change_comanda';";
				$result_update_num_mesa = mysqli_query($conexion,$query_update_num_mesa);
				if ($result_update_num_mesa) {
					 $messages[] = "Mesa cambiada con &eacute;xito.";
				}else{
					$errors[] = "No se pudo cambiar. Por favor, vuelva a intentarlo.</br> result_update_num_mesa ";
					$errors[] = mysqli_error($conexion);
				}
			}else{
				$errors[] = "No se pudo cambiar. Por favor, vuelva a intentarlo.</br> result_update_comanda ";
				$errors[] = mysqli_error($conexion);
			}
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