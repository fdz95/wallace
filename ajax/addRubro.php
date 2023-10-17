<?php
	if (empty($_POST['add_rubro_name'])){
		$errors[] = "Debe ingresar el rubro";
	} else if (!empty($_POST['add_rubro_name'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$add_rubro_name = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_rubro_name"],ENT_QUOTES)));

		$query_search_rubro = "SELECT * FROM t_rubros WHERE rubro = '$add_rubro_name';";
		$result_search_rubro = mysqli_query($conexion,$query_search_rubro);
		if($result_search_rubro){
			if(mysqli_num_rows($result_search_rubro) > 0){
				$errors[] = "El rubro <b>$add_rubro_name</b> ya esta agregado";
			}else{
				$query_insert_rubro = "INSERT INTO t_rubros(rubro) VALUES('$add_rubro_name');";
				$result_insert_rubro = mysqli_query($conexion,$query_insert_rubro);
				if ($result_insert_rubro) {
					 $messages[] = "Agregado con &eacute;xito.";
				}else{
					$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_insert_rubro</br>";
					$errors[] = mysqli_error($conexion);
				}
			}
		}else{
			$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_search_rubro</br>";	
			$errors[] = mysqli_error($conexion);
		}
	}else{
		$errors[] = "Debe ingresar el rubro";
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