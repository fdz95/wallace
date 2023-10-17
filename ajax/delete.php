<?php
	if (!empty($_POST['id_delete_articulo'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_delete_mesa = intval($_POST['id_delete_mesa']);
		$id_delete_articulo = mysqli_real_escape_string($conexion,(strip_tags($_POST["id_delete_articulo"],ENT_QUOTES)));
		$comanda_show = mysqli_real_escape_string($conexion,(strip_tags($_POST["id_comanda_show"],ENT_QUOTES)));
		$fecha_del = date('Y-m-d');
		$hora_del = date('H:i');
		
		// DELETE FROM database
		$query_delete = "DELETE FROM t_pedidos WHERE estado = 'A' AND num_mesa = '$id_delete_mesa' AND articulo = '$id_delete_articulo';";
		$result_query_delete = mysqli_query($conexion,$query_delete);
		if ($result_query_delete) {
			$query_delete_comanda = "DELETE FROM t_comanda WHERE estado = 'P' AND num_mesa = '$id_delete_mesa' AND articulo = '$id_delete_articulo';";
			$result_delete_comanda = mysqli_query($conexion,$query_delete_comanda);
			if ($result_delete_comanda) {
				
				$query_select_detalle_comanda = "SELECT * FROM t_comanda WHERE comanda_show = '$comanda_show';";
				$result_detalle_comanda = mysqli_query($conexion,$query_select_detalle_comanda);
				if($result_detalle_comanda){
					if(mysqli_num_rows($result_detalle_comanda) <= 0){
						
						$query_delete_comanda_c = "DELETE FROM t_comanda_c WHERE comanda_show = '$comanda_show';";
						$result_delete_comanda_c = mysqli_query($conexion,$query_delete_comanda_c);
						if ($result_delete_comanda_c) {
							$messages[] = "Borrado con &eacute;xito c.";
						}else{
							$errors[] = "No se pudo borrar. Por favor, vuelva a intentarlo. result_delete_comanda_c: </br>";
							$errors[] = mysqli_error($conexion);
						}
					}else{
						$messages[] = "Borrado con &eacute;xito.";
					}
				}
				
			}else{
				$errors[] = "No se pudo borrar. Por favor, vuelva a intentarlo. result_delete_comanda: </br>";
				$errors[] = mysqli_error($conexion);
			}
		}else{
			$errors[] = "No se pudo borrar. Por favor, vuelva a intentarlo. result_query_delete: </br>";
			$errors[] = mysqli_error($conexion);
		}		
	}else{
		$errors[] = "desconocido.";
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