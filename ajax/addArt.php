<?php
	if (empty($_POST['add_art_articulo'])){
		$errors[] = "Debe ingresar el articulo";
	} else if (!empty($_POST['add_art_articulo'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$add_art_rubro = mysqli_real_escape_string($conexion,(strip_tags($_POST["select_rubro_name"],ENT_QUOTES)));
		$add_art_subrubro = mysqli_real_escape_string($conexion,(strip_tags($_POST["select_subrubro_name"],ENT_QUOTES)));
		$add_art_tipo = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_art_tipo"],ENT_QUOTES)));
		$add_art_articulo = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_art_articulo"],ENT_QUOTES)));
		$add_art_descrip = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_art_descrip"],ENT_QUOTES)));
		$add_art_precio = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_art_precio"],ENT_QUOTES)));
		$add_art_prov = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_art_prov"],ENT_QUOTES)));
		$add_art_stock = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_art_stock"],ENT_QUOTES)));
		$fecha_add_art = date('Y-m-d');
		$hora_add_art = date('H:i');
		
		if(empty($add_art_rubro) || ($add_art_rubro == "Seleccione un rubro")){
			$errors[] = "Debe ingresar el rubro";
		}else if(empty($add_art_subrubro) || ($add_art_subrubro == "Seleccione un subrubro")){
			$errors[] = "Debe ingresar el subrubro";
		}else if(empty($add_art_tipo)){
			$errors[] = "Debe ingresar el tipo";
		}else if(empty($add_art_articulo)){
			$errors[] = "Debe ingresar el articulo";
		}else if(empty($add_art_descrip)){
			$errors[] = "Debe ingresar la descripcion";
		}else if($add_art_precio < 0){
			$errors[] = "Debe ingresar el precio";
		}else{
			$query_search = "SELECT * FROM t_articulos WHERE estado = 'A' AND subrubro = '$add_art_subrubro' AND articulo = '$add_art_articulo';";
			$result_query_search = mysqli_query($conexion,$query_search);
			if($result_query_search){
				if(mysqli_num_rows($result_query_search) > 0){
					$errors[] = "El articulo <b>$add_art_tipo  $add_art_articulo</b> ya esta agregado";
				}else{
					$query_insert = "INSERT INTO t_articulos(estado, rubro, subrubro, tipo, articulo, descripcion, precio, proveedor, stock, img, fecha, hora)
					VALUES('A', '$add_art_rubro', '$add_art_subrubro', '$add_art_tipo', '$add_art_articulo', '$add_art_descrip', '$add_art_precio', '$add_art_prov', '$add_art_stock', '', '$fecha_add_art', '$hora_add_art');";
					$result_query_insert = mysqli_query($conexion,$query_insert);
					if ($result_query_insert) {
						 $messages[] = "Agregado con &eacute;xito.";
					}else{
						$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_insert</br>";
						$errors[] = mysqli_error($conexion);
					}
				}
			}else{
				$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_search</br>";	
				$errors[] = mysqli_error($conexion);
			}
		}
	}else{
		$errors[] = "Debe ingresar el articulo";
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