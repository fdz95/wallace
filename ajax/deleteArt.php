<?php
	if (!empty($_POST['id_delete_art_id'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_delete_art_id = intval($_POST['id_delete_art_id']);
		
		// DELETE FROM database
		$query_delete = "DELETE FROM t_articulos WHERE estado = 'A' AND Id = '$id_delete_art_id';";
		$result_query_delete = mysqli_query($conexion,$query_delete);
		if ($result_query_delete) {
			$messages[] = "Borrado con &eacute;xito.";
		}else{
			$errors[] = "No se pudo borrar. Por favor, vuelva a intentarlo.</br>";
			$errors[] = mysqli_error($conexion);
		}
	}else{
		$errors[] = "ERROR id_delete_art_id";
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