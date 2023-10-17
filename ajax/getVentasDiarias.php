<?php
	require_once ("conexion.php");
	require_once ("../funciones.php");
	$ingreso_total_diario = 0;
	$fecha_hoy = date('Y-m-d');
	$table_head = null;
	$table_body = null;
	
	$query_select_fecha = "SELECT DISTINCT(fecha) FROM t_pedidos_c WHERE estado = 'C' ORDER BY fecha DESC;";
	$result_select_fecha = mysqli_query($conexion,$query_select_fecha);
	if($result_select_fecha){
		if(mysqli_num_rows($result_select_fecha) > 0){
			$table_head = "
			<div class='card-body'>
				<table  class='table table-bordered table-hover'>
					<thead>
						<tr>
							<th class='text-center'>Fecha</th>
							<th class='text-center'>Cantidad de ventas</th>
							<th class='text-center'>Total</th>
						</tr>
					</thead>
					<tbody>";
					
			while($row1 = mysqli_fetch_array($result_select_fecha)){
				$query_fecha = $row1['fecha'];
				
				$query_select_ventas_dia = "SELECT * FROM t_pedidos_c WHERE estado = 'C' AND fecha = '$query_fecha' ORDER BY fecha DESC;";
				$result_select_ventas_dia = mysqli_query($conexion,$query_select_ventas_dia);
				if($result_select_ventas_dia){
					$numrows2 = mysqli_num_rows($result_select_ventas_dia);
					if ($numrows2 > 0){
						
						while($row2 = mysqli_fetch_array($result_select_ventas_dia)){
							$getID = $row2['Id'];
							$getImporte = $row2['pagado'];
							$ingreso_total_diario = $ingreso_total_diario + $getImporte;
						}
						
						$table_body .= "
							<tr>
								<td class='text-center'>";
									$fecha_hoy_format = date_format(date_create($fecha_hoy), 'd/m');
									if($fecha_hoy == $query_fecha){
										$table_body .= $fecha_hoy_format ." (hoy)";
									}else{
										$fecha_format = date_format(date_create($query_fecha), 'd/m');
										$table_body .= $fecha_format;
									}
								$table_body .= "</td>
								<td class='text-center'>$numrows2</td>
								<td class='text-center'>$ ";
									$table_body .= moneyFormat($ingreso_total_diario) ."</td>
							</tr>";
							
						$ingreso_total_diario = 0;
							
					}else{
						$table_body = "<div class='card-body'>No hay registros";
					}
				}else{
					$table_body = "No se pudieron cargar las ventas diarias. result_select_ventas_dia: ". mysqli_error($conexion);
				}
			}
		}else{
			$table_body = "<div class='card-body'>No hay registros";
		}			
	}else{
		$table_body = "No se pudieron cargar las ventas diarias. result_select_fecha: ". mysqli_error($conexion);
	}
	
	echo $table_head . $table_body ."</tbody></table></div>";
?>