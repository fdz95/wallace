<?php
	require_once ("conexion.php");
	require_once ("../funciones.php");
	$ingreso_total = 0;
	$fecha_hoy = date('Y-m');
	$anio_actual = date('Y');
	
	
	echo "
		<div class='card-body'>
			<table  class='table table-bordered table-hover'>
				<thead>
					<tr>
						<th class='text-center'>Fecha</th>
						<th class='text-center'>Cantidad de ventas</th>
						<th class='text-center'>Total</th>
						<!--<th class='text-center'>Opciones</th>-->
				</tr>
				</thead>
				<tbody>";
						
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
			
		$query_select_ventas_fecha = "SELECT * FROM t_pedidos_c WHERE estado = 'C' AND fecha LIKE '$fecha_mes_numero%';";
		$result_select_ventas_fecha = mysqli_query($conexion,$query_select_ventas_fecha);
		if($result_select_ventas_fecha){
			$numrows1 = mysqli_num_rows($result_select_ventas_fecha);
			if ($numrows1 > 0){
				
				while($row1 = mysqli_fetch_array($result_select_ventas_fecha)){
					$getID = $row1['Id'];
					$getRecibido = $row1['pagado'];
					$ingreso_total = $ingreso_total + $getRecibido;
				}
				
				echo "
				<tr><td class='text-center'>";
					if($fecha_hoy == $fecha_mes_numero){
						echo $fecha_mes_nombre ." ". $anio_actual ." (actual)";
					}else{
						echo $fecha_mes_nombre ." ". $anio_actual;
					}
					echo "</td><td class='text-center'>$numrows1</td>
					<td class='text-center'>$". moneyFormat($ingreso_total) ."</td>
				</tr>";
			}
		}else{
			echo "No se pudieron cargar las ventas mensuales. result_select_ventas_fecha: ". mysqli_error($conexion);
		}
		
		$ingreso_total = 0;
	}
	
	echo "</tbody></table></div>";
?>