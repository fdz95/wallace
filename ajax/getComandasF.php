<?php
	require_once ("conexion.php");
	$output = "";
	$nombre_cliente = "";
	$getMesaName = "";
	
	$query_select_comandasF = "SELECT * FROM t_comanda_c WHERE estado = 'P';";
	$result_select_comandasF = mysqli_query($conexion,$query_select_comandasF);
	if($result_select_comandasF){
		if ($numrows = mysqli_num_rows($result_select_comandasF) > 0){
			$output = "<div class='card-body'>
				<table  class='table table-bordered table-hover'>
					<thead>
						<tr>
							<th class='text-center'>Cliente</th>
							<th class='text-center'>Mesa</th>
							<th class='text-center'>Articulo</th>
							<th class='text-center'>Cantidad</th>
							<th class='text-center'>Fecha</th>
							<th class='text-center'>Hora</th>
						</tr>
					</thead>
					<tbody>";
					
			while($row = mysqli_fetch_assoc($result_select_comandasF)){
				$comanda_show = $row['comanda_show'];
				$query_select_detalle_comandaF = "SELECT * FROM t_comanda WHERE comanda_show = '$comanda_show' AND rubro = 'COMIDAS';";
				$result_detalle_comandaF = mysqli_query($conexion,$query_select_detalle_comandaF);
				if($result_detalle_comandaF){
					if(mysqli_num_rows($result_detalle_comandaF) > 0){
						while($rowComandasF = mysqli_fetch_array($result_detalle_comandaF)){
							$getID = $rowComandasF['Id'];
							$getMesa = $rowComandasF['num_mesa'];
							$getArticulo = $rowComandasF['articulo'];
							$getCant = $rowComandasF['cant_articulo'];
							$fecha_comanda = date_create($rowComandasF['fecha_abm']);
							$hora_comanda = date_create($rowComandasF['hora_abm']);
							$fecha_format = date_format($fecha_comanda, 'd/m/y');
							$hora_format = date_format($hora_comanda, 'H:i');
							
							$getCliente = $rowComandasF['cod_cliente'];
							$query_select_cliente = "SELECT * FROM t_clientes WHERE Id = '$getCliente';";
							$result_select_cliente = mysqli_query($conexion,$query_select_cliente);
							if($result_select_cliente){
								if(mysqli_num_rows($result_select_cliente) > 0){
									$row_cliente = mysqli_fetch_assoc($result_select_cliente);
									$nombre_cliente = $row_cliente['nombre'] ." ".  $row_cliente['apellido'];
								}
							}else{
								$nombre_cliente = "ERROR result_select_cliente: ". mysqli_error($conexion);
							}
							
							switch($getMesa){
								case "90":   // mesa de pool 1 ==> 90
									$getMesaName = "Pool 1";
									break;
								case "91":   // mesa de pool 2 ==> 91
									$getMesaName = "Pool 2";
									break;
								case "92":   // sillon ==> 92
									$getMesaName = "Sillon";
									break;
								case "93":   // barra afuera ==> 93
									$getMesaName = "Barra afuera";
									break;
								case "94":   // barril ==> 94
									$getMesaName = "Barril";
									break;
								case "95":   // mesas abajo ==> 95
									$getMesaName = "Mesa Abajo";
									break;
								default:     // mesas
									$getMesaName = "Mesa $getMesa";
									break;
							}
							
							$output .= "
							<tr>
								<td class='text-center'>$nombre_cliente</td>
								<td class='text-center'>$getMesaName</td>
								<td class='text-center'>$getArticulo</td>
								<td class='text-center'>$getCant</td>
								<td class='text-center'>$fecha_format</td>
								<td class='text-center'>$hora_format</td>
							</tr>";
						}
					}else{
						//$output = "No hay registros result_detalle_comandaF";
					}
				}else{
					$output = "No se pudieron cargar las comandas. Error result_detalle_comandaF";
				}
			}
			$output .= "</tbody></table></div>";
		}else{
			$output = "No hay registros result_select_comandasF";
		}
	}else{
		$output = "No se pudieron cargar las comandas. Error result_select_comandasF";
	}
	
	echo $output;
?>