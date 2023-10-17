<?php
	$output = "";
	if (empty($_POST['config_cant_mesas'])){
		$output = "Debe ingresar la cantidad";
	} else if (!empty($_POST['config_cant_mesas'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$config_cant_mesas = mysqli_real_escape_string($conexion,(strip_tags($_POST["config_cant_mesas"],ENT_QUOTES)));
		
		if(empty($config_cant_mesas)){
			$output = "Debe ingresar la cantidad";
		}else if($config_cant_mesas <= 0){
			$output = "Debe ingresar la cantidad";
		}else{
			$query_update_config = "UPDATE t_config SET cant_mesas = '$config_cant_mesas' WHERE Id = '1';";
			$result_update_config = mysqli_query($conexion,$query_update_config);
			if ($result_update_config) {
				 $output = "Guardado con &eacute;xito.";
			}else{
				$output = "No se pudo guardar. Por favor, vuelva a intentarlo. result_update_config</br>". mysqli_error($conexion);
			}
		}
	}else{
		$output = "Debe ingresar la cantidad";
	}
	echo $output;
?>