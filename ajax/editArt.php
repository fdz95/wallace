<?php
	if (empty($_POST['id_edit_art'])){
		$errors[] = "ERROR id_edit_art";
	} else if (!empty($_POST['id_edit_art'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_edit_art = mysqli_real_escape_string($conexion,(strip_tags($_POST["id_edit_art"],ENT_QUOTES)));
		$edit_art_rubro = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_art_rubro"],ENT_QUOTES)));
		$edit_art_subrubro = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_art_subrubro"],ENT_QUOTES)));
		$edit_art_tipo = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_art_tipo"],ENT_QUOTES)));
		$edit_art_articulo = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_art_articulo"],ENT_QUOTES)));
		$edit_art_descrip = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_art_descrip"],ENT_QUOTES)));
		$edit_art_precio = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_art_precio"],ENT_QUOTES)));
		$edit_art_prov = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_art_prov"],ENT_QUOTES)));
		$edit_art_stock = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_art_stock"],ENT_QUOTES)));
		$edit_art_img = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_art_img"],ENT_QUOTES)));
		$fecha_edit = date('Y-m-d');
		$hora_edit = date('H:i');
		
		if(empty($edit_art_rubro)){
			$errors[] = "Debe ingresar el rubro";
		}else if(empty($edit_art_subrubro)){
			$errors[] = "Debe ingresar el subrubro";
		}else if(empty($edit_art_tipo)){
			$errors[] = "Debe ingresar el tipo";
		}else if(empty($edit_art_articulo)){
			$errors[] = "Debe ingresar el articulo";
		}else if(empty($edit_art_descrip)){
			$errors[] = "Debe ingresar la descripcion";
		}else if($edit_art_precio < 0){
			$errors[] = "Debe ingresar el precio";
		}else{
			$query_update = "UPDATE t_articulos SET rubro = '$edit_art_rubro', tipo = '$edit_art_subrubro', tipo = '$edit_art_tipo', articulo = '$edit_art_articulo', descripcion = '$edit_art_descrip', precio = '$edit_art_precio', proveedor = '$edit_art_prov', stock = '$edit_art_stock', img = '$edit_art_img', fecha = '$fecha_edit', hora = '$hora_edit' WHERE Id = '$id_edit_art';";
			$result_query_update = mysqli_query($conexion,$query_update);
			if ($result_query_update) {
				 $messages[] = "Editado con &eacute;xito.";
			}else{
				$errors[] = "No se pudo editar. Por favor, vuelva a intentarlo.</br>";
				$errors[] = mysqli_error($conexion);
			}
		}
	}else{
		$errors[] = "ERROR id_edit_art";
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