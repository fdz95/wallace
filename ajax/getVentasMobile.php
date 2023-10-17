<?php
	require_once ("conexion.php");
	require_once ("../funciones.php");
	$ingreso_total = 0;
	$fecha_hoy = date('Y-m');
	$anio_actual = date('Y');
	
	//main query to fetch the data
	$query_select_ventas = "SELECT DISTINCT fecha FROM t_pedidos_c WHERE estado = 'C' ORDER BY fecha DESC;";
	$result_select_ventas = mysqli_query($conexion,$query_select_ventas);
	if($result_select_ventas){
		if (mysqli_num_rows($result_select_ventas) > 0){
		?>
			<div class="card-body">
				<table  class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class='text-center'>Fecha</th>
							<th class='text-center'>Total</th>
						</tr>
					</thead>
					<tbody>
		<?php
		
			for($i = 1; $i <= 12; $i++){
				
				if($i <= 9){
					$i = "0". $i;
				}
				
				switch($i){
					case "01":
						$fecha_mes_nombre = "Enero";
						break;
					case "02":
						$fecha_mes_nombre = "Febrero";
						break;
					case "03":
						$fecha_mes_nombre = "Marzo";
						break;
					case "04":
						$fecha_mes_nombre = "Abril";
						break;
					case "05":
						$fecha_mes_nombre = "Mayo";
						break;
					case "06":
						$fecha_mes_nombre = "Junio";
						break;
					case "07":
						$fecha_mes_nombre = "Julio";
						break;
					case "08":
						$fecha_mes_nombre = "Agosto";
						break;
					case "09":
						$fecha_mes_nombre = "Septiembre";
						break;
					case "10":
						$fecha_mes_nombre = "Octubre";
						break;
					case "11":
						$fecha_mes_nombre = "Noviembre";
						break;
					case "12":
						$fecha_mes_nombre = "Diciembre";
						break;
				}
				
				$fecha_mes_numero = $anio_actual ."-". $i;
				
				$query_select_ventas_fecha = "SELECT DISTINCT * FROM t_pedidos_c WHERE estado = 'C' AND fecha LIKE '$fecha_mes_numero%';";
				$result_select_ventas_fecha = mysqli_query($conexion,$query_select_ventas_fecha);
				if($result_select_ventas_fecha){
					$numrows1 = mysqli_num_rows($result_select_ventas_fecha);
					if ($numrows1 > 0){
						while($row1 = mysqli_fetch_array($result_select_ventas_fecha)){
							$getID = $row1['Id'];
							$getRecibido = $row1['pagado'];
							$ingreso_total = $ingreso_total + $getRecibido;
						}
						?>
						<tr>
							<td class='text-center'><?php
								if($fecha_hoy == $fecha_mes_numero){
									echo $fecha_mes_nombre ." ". $anio_actual ." (actual)";
								}else{
									echo $fecha_mes_nombre ." ". $anio_actual;
								}
								?>
							</td>
							<td class='text-center'>$
							<?php
								$importe_format = moneyFormat($ingreso_total);
								echo $importe_format;
							?></td>
						</tr>
						<?php
					}
				}else{
					echo "No se pudieron cargar las ventas. result_select_ventas_fecha: ". mysqli_error($conexion);
				}
				$ingreso_total = 0;
			}?>
					</tbody>
				</table>
			</div>
			<?php
		}else{
			echo "No hay registros result_select_ventas";
		}
	}else{
		echo "No se pudieron cargar las ventas. result_select_ventas: ". mysqli_error($conexion);
	}
?>