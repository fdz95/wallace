<?php
	if (empty($_POST['add_subrubro_name'])){
		$errors[] = "Debe ingresar el subrubro";
	} else if (!empty($_POST['add_subrubro_name'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$add_rubro_name = mysqli_real_escape_string($conexion,(strip_tags($_POST["select_rubro_name"],ENT_QUOTES)));
		$add_subrubro_name = mysqli_real_escape_string($conexion,(strip_tags($_POST["add_subrubro_name"],ENT_QUOTES)));
		
		if($add_rubro_name == "Seleccione un rubro"){
			$errors[] = "Debe seleccionar un rubro";
		}else{
			$query_search_subrubro = "SELECT * FROM t_subrubros WHERE rubro = '$add_rubro_name' AND subrubro = '$add_subrubro_name';";
			$result_search_subrubro = mysqli_query($conexion,$query_search_subrubro);
			if($result_search_subrubro){
				if(mysqli_num_rows($result_search_subrubro) > 0){
					$errors[] = "El subrubro <b>$add_subrubro_name</b> ya esta agregado";
				}else{
					$query_insert_subrubro = "INSERT INTO t_subrubros(rubro,subrubro) VALUES('$add_rubro_name','$add_subrubro_name');";
					$result_insert_subrubro = mysqli_query($conexion,$query_insert_subrubro);
					if ($result_insert_subrubro) {
						 $messages[] = "Agregado con &eacute;xito.";
					}else{
						$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_insert_subrubro</br>";
						$errors[] = mysqli_error($conexion);
					}
				}
			}else{
				$errors[] = "No se pudo agregar. Por favor, vuelva a intentarlo. result_search_subrubro</br>";	
				$errors[] = mysqli_error($conexion);
			}
		}
	}else{
		$errors[] = "Debe ingresar el subrubro";
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