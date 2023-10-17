<?php
	$output = "";
	require_once ("conexion.php");
	$query_precio_ping_pong = "SELECT * FROM t_config WHERE Id = '1';";
	$result_precio_ping_pong = mysqli_query($conexion,$query_precio_ping_pong);
	if($result_precio_ping_pong){
		if (mysqli_num_rows($result_precio_ping_pong) > 0){
			$row = mysqli_fetch_array($result_precio_ping_pong);
			$output = $row['precio_ping_pong'];
		}else{
			$output = "No hay registros agregados";
		}
	}else{
		$output = "No se pudo cargar. result_precio_ping_pong: ". mysqli_error($conexion);
	}
	echo $output;
?>