<?php
	$output = "";
	require_once ("conexion.php");
	$query_select_precio_fichas = "SELECT * FROM t_config WHERE Id = '1';";
	$result_precio_fichas = mysqli_query($conexion,$query_select_precio_fichas);
	if($result_precio_fichas){
		if (mysqli_num_rows($result_precio_fichas) > 0){
			$row = mysqli_fetch_array($result_precio_fichas);
			$output = $row['precio_fichas'];
		}else{
			$output = "No hay registros agregados";
		}
	}else{
		$output = "No se pudo cargar. result_precio_fichas: ". mysqli_error($conexion);
	}
	echo $output;
?>