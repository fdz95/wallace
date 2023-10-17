<?php
	if (empty($_GET['ventas_fecha'])){
		$output = "Error ventas_fecha getInfoVentas";
	} else if (!empty($_GET['ventas_fecha'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$ventas_fecha = mysqli_real_escape_string($conexion,(strip_tags($_GET["ventas_fecha"],ENT_QUOTES)));
		$output = "";
		$getClienteNombre = "";
		
		//main query to fetch the data
		$query_select_ventas_detalle = "SELECT * FROM t_pedidos_c WHERE estado = 'C' AND fecha = '$ventas_fecha';";
		$result_ventas_detalle = mysqli_query($conexion,$query_select_ventas_detalle);
		if($result_ventas_detalle){
			if ($numrows = mysqli_num_rows($result_ventas_detalle) > 0){
				$output = "<div class='card-body'>
						<table  class='table table-bordered table-hover'>
							<thead>
								<tr>
									<th class='text-center'>Cliente</th>
									<th class='text-center'>Importe total</th>
									<th class='text-center'>Descuento</th>
									<th class='text-center'>Recibido</th>
									<th class='text-center'>Met. pago</th>
									<th class='text-center'>Hora</th>
								</tr>
							</thead>
							<tbody>";
					
				while($row = mysqli_fetch_array($result_ventas_detalle)){
					$getID = $row['Id'];
					$getClienteVentas = $row['cod_cliente'];
					
					$query_select_cliente_ventas = "SELECT nombre, apellido FROM t_clientes WHERE Id = '$getClienteVentas';";
					$result_cliente_ventas = mysqli_query($conexion,$query_select_cliente_ventas);
					if($result_cliente_ventas){
						if (mysqli_num_rows($result_cliente_ventas) > 0){
							$row1 = mysqli_fetch_array($result_cliente_ventas);
							$getClienteNombre = $row1['nombre'] ." ". $row1['apellido'];
						}else{
							$getClienteNombre = $getClienteVentas;
						}
					}else{
						$output = "No se pudieron cargar los clientes. result_cliente_ventas: ". mysqli_error($conexion);
					}
		
					$getImporteVentas = $row['importe'];
					$getPagadoVentas = $row['pagado'];
					$getDescuentoVentas = $row['descuento'];
					$getMetPagoVentas = $row['met_pago'];
					$getHoraVentas = $row['hora'];
					
					$output .= "
						<tr><td class='text-center'>$getClienteNombre</td>
						<td class='text-center'>$ $getImporteVentas</td>
						<td class='text-center'>$getDescuentoVentas</td>
						<td class='text-center'>$ $getPagadoVentas</td>
						<td class='text-center'>$getMetPagoVentas</td>
						<td class='text-center'>$getHoraVentas</td></tr>";
				}
				
				$output .= "</tbody></table></div>";
				
			}else{
				$output = "No hay registros";
			}
		}else{
			$output = "No se pudo cargar el detalle de la venta. result_ventas_detalle: ". mysqli_error($conexion);
		}
	}else{
		$output = "Error ventas_fecha getInfoVentas";
	}
	echo $output;
?>