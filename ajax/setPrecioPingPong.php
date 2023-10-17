<?php
	$output = "";
	if (empty($_POST['config_precio_ping_pong'])){
		$output = "Debe ingresar el precio";
	} else if (!empty($_POST['config_precio_ping_pong'])){
		require_once ("conexion.php");
		$config_precio_ping_pong = mysqli_real_escape_string($conexion,(strip_tags($_POST["config_precio_ping_pong"],ENT_QUOTES)));
		
		if(empty($config_precio_ping_pong)){
			$output = "Debe ingresar el precio";
		}else if($config_precio_ping_pong <= 0){
			$output = "Debe ingresar el precio";
		}else{
			$query_update_config = "UPDATE t_config SET precio_ping_pong = '$config_precio_ping_pong' WHERE Id = '1';";
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