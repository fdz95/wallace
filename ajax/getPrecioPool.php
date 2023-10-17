<?php
	$output = "";
	require_once ("conexion.php");
	$query_select_precio_pool = "SELECT * FROM t_config WHERE Id = '1';";
	$result_precio_pool = mysqli_query($conexion,$query_select_precio_pool);
	if($result_precio_pool){
		if (mysqli_num_rows($result_precio_pool) > 0){
			$row = mysqli_fetch_array($result_precio_pool);
			$output = $row['precio_pool'];
		}else{
			$output = "No hay registros agregados";
		}
	}else{
		$output = "No se pudo cargar. result_precio_pool: ". mysqli_error($conexion);
	}
	echo $output;
?>