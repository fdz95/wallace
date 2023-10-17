<?php
	$output = "";
	if (empty($_POST['config_precio_pool'])){
		$output = "Debe ingresar el precio";
	} else if (!empty($_POST['config_precio_pool'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$config_precio_pool = mysqli_real_escape_string($conexion,(strip_tags($_POST["config_precio_pool"],ENT_QUOTES)));
		
		if(empty($config_precio_pool)){
			$output = "Debe ingresar el precio";
		}else if($config_precio_pool <= 0){
			$output = "Debe ingresar el precio";
		}else{
			$query_update_config = "UPDATE t_config SET precio_pool = '$config_precio_pool' WHERE Id = '1';";
			$result_update_config = mysqli_query($conexion,$query_update_config);
			if ($result_update_config) {
				 $output = "Guardado con &eacute;xito.";
			}else{
				$output = "No se pudo guardar. Por favor, vuelva a intentarlo. result_update_config</br>". mysqli_error($conexion);
			}
		}
	}else{
		$output = "Debe ingresar el precio";
	}
	echo $output;
?>