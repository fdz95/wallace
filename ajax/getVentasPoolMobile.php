<?php
	require_once ("conexion.php");
	require_once ("../funciones.php");
	$output = "";
	$importe_total = 0;
	
	//main query to fetch the data
	$query_select_pedidos_pool = "SELECT * FROM t_pedidos WHERE estado = 'C' AND articulo = 'POOL';";
	$result_pedidos_pool = mysqli_query($conexion,$query_select_pedidos_pool);
	if($result_pedidos_pool){
		if ($numrows = mysqli_num_rows($result_pedidos_pool) > 0){
			while($row = mysqli_fetch_array($result_pedidos_pool)){
				$getID = $row['Id'];
				$getCantidad = $row['cant_articulo'];
				$getImporte = $row['importe'] * $getCantidad;
				$importe_total = $importe_total + $getImporte;
			}
			$importe_format = moneyFormat($importe_total);
			$output = "<h2>$ ". $importe_format ."</h2>";
		}else{
			$output = "No hay registros";
		}
	}else{
		$output = "No se pudieron cargar los pedidos. result_pedidos_pool: ". mysqli_error($conexion);
	}
	echo $output;
?>