<?php
	require_once ("conexion.php");
	$output = "";
	$getNombreCliente = "";
	
	//main query to fetch the data
	$query_select_pedidos_pool = "SELECT * FROM t_pedidos WHERE estado = 'C' AND articulo = 'POOL';";
	$result_pedidos_pool = mysqli_query($conexion,$query_select_pedidos_pool);
	if($result_pedidos_pool){
		if ($numrows = mysqli_num_rows($result_pedidos_pool) > 0){
			$output = "<div class='card-body'>
						<table  class='table table-bordered table-hover'>
							<thead>
								<tr>
									<th class='text-center'>Fecha</th>
									<th class='text-center'>Cliente</th>
									<th class='text-center'>Tiempo jugado</th>
									<th class='text-center'>Total</th>
								</tr>
							</thead>
							<tbody>";
			while($row = mysqli_fetch_array($result_pedidos_pool)){
				$getID = $row['Id'];
				
				$getClientePool = $row['cod_cliente'];
				$query_select_cliente_pool = "SELECT nombre, apellido FROM t_clientes WHERE Id = '$getClientePool';";
				$result_cliente_pool = mysqli_query($conexion,$query_select_cliente_pool);
				if($result_cliente_pool){
					if (mysqli_num_rows($result_cliente_pool) > 0){
						$row1 = mysqli_fetch_array($result_cliente_pool);
						$getNombreCliente = $row1['nombre']. " " .$row1['apellido'];
					}else{
						$getNombreCliente = $getClientePool;
					}
				}else{
					$getNombreCliente = "No se pudieron cargar los clientes. result_cliente_pool: ". mysqli_error($conexion);
				}
				
				$getCantidad = $row['cant_articulo'];
				$getImportePool = $row['importe'] * $getCantidad;
				$getNotasPool = $row['notas'];
				$getFechaPool = $row['fecha_abm'];
				$getHoraPool = $row['hora_abm'];
				
				$output .= "<tr><td class='text-center'>$getFechaPool $getHoraPool</td>
					<td class='text-center'>$getNombreCliente</td>
					<td class='text-center'>$getCantidad minutos</td>
					<td class='text-center'>$ $getImportePool</td></tr>";
			}
			$output .= "</tbody></table></div>";
		}else{
			$output = "No hay registros";
		}
	}else{
		$output = "No se pudieron cargar los datos. result_pedidos_pool: ". mysqli_error($conexion);
	}
	echo $output;
?>