<?php
	require_once ("conexion.php");
	require_once ("../funciones.php");
	$id_cliente_select = mysqli_real_escape_string($conexion,(strip_tags($_GET["id_cliente"],ENT_QUOTES)));
	
	$total_pagado_cliente = 0;
	$table_head = "";
	$table_body = "";
	$table_footer = "";
	$output = "";
	//main query to fetch the data
	$query_select_recibos_cliente = "SELECT * FROM t_pedidos_c WHERE estado = 'C' AND cod_cliente = '$id_cliente_select';";
	$result_recibos_cliente = mysqli_query($conexion,$query_select_recibos_cliente);
	if($result_recibos_cliente){
		if ($numrows = mysqli_num_rows($result_recibos_cliente) > 0){
	
			$table_head = "<div class='card-body'>
				<table  class='table table-bordered table-hover'>
					<thead>
						<tr>
							<th class='text-center'>ID</th>
							<th class='text-center'>Recibo N°</th>
							<th class='text-center'>Importe</th>
							<th class='text-center'>Pagado</th>
							<th class='text-center'>Descuento</th>
							<th class='text-center'>Fecha cierre</th>
							<th class='text-center'>Hora cierre</th>
							<!--<th class='text-center'>Opciones</th>-->
						</tr>
					</thead>
					<tbody>";
					
			while($row = mysqli_fetch_array($result_recibos_cliente)){
				$getID = $row['Id'];
				$getComandaID = $row['id_comanda'];
				$getRecibo = $row['recibo'];
				$getImporte = $row['importe'];
				
				$getPagado = $row['pagado'];
				$total_pagado_cliente = $total_pagado_cliente + $getPagado;
				
				$getDescuento = $row['descuento'];
				
				$fecha_format = date_format(date_create($row['fecha']), 'd/m/Y');
					
				$getHora = $row['hora'];
				
				$importe_format = moneyFormat($getImporte);
				$pagado_format = moneyFormat($getPagado);
				$table_body .= "
					<tr>
						<td class='text-center'>$getID</td>
						<td class='text-center'>$getRecibo</td>
						<td class='text-center'>$ $importe_format</td>
						<td class='text-center'>$ $pagado_format</td>
						<td class='text-center'>$getDescuento %</td>
						<td class='text-center'>$fecha_format</td>
						<td class='text-center'>$getHora</td>
					</tr>";
			}
			
			$table_footer = "</tbody></table></div>";
			
			$total_format = moneyFormat($total_pagado_cliente);
			$output = "</br></br><h3>Total pagado: $". $total_format ."</h3></br></br>". $table_head . $table_body . $table_footer;
		}else{
			$output = "No hay registros";
		}
	}else{
		$output = "No se pudieron cargar los pedidos. result_recibos_cliente: ". mysqli_error($conexion);
	}
	echo $output;
?>