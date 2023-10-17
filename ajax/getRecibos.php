<?php
	require_once ("conexion.php");
	require_once ("../funciones.php");
	
	$nombre_cliente = "";
	//main query to fetch the data
	$query_select_pedidos = "SELECT * FROM t_pedidos_c;";
	$result_select_pedidos = mysqli_query($conexion,$query_select_pedidos);
	if($result_select_pedidos){
		if ($numrows = mysqli_num_rows($result_select_pedidos) > 0){
		
			echo "<div class='card-body'>
				<table  class='table table-bordered table-hover'>
					<thead>
						<tr>
							<th class='text-center'>ID</th>
							<th class='text-center'>Recibo N°</th>
							<th class='text-center'>Cliente</th>
							<th class='text-center'>Importe</th>
							<th class='text-center'>Recibido</th>
							<th class='text-center'>Descuento</th>
							<th class='text-center'>Fecha cierre</th>
							<th class='text-center'>Hora cierre</th>
							<th class='text-center'>Opciones</th>
						</tr>
					</thead>
					<tbody>";
			
				while($row = mysqli_fetch_array($result_select_pedidos)){
					$getID = $row['Id'];
					$getEstado = $row['estado'];
					$tdProp = "class='text-center'";
					if($getEstado == "B"){
						$tdProp = "style='background-color:#FFD8D8' class='text-center'";
					}
					
					$getComandaID = $row['id_comanda'];
					$getRecibo = $row['recibo'];
					
					$getCliente = $row['cod_cliente'];
					// select datos cliente
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
				
					$getImporte = $row['importe'];
					$getPagado = $row['pagado'];
					$getDescuento = $row['descuento'];
					$getFecha = $row['fecha'];
					$fecha_format = date_format(date_create($getFecha), 'd/m/Y');
					$getHora = $row['hora'];
					
					$importe_format = moneyFormat($getImporte);
					$pagado_format = moneyFormat($getPagado);
					
					echo "<tr>
						<td $tdProp>$getID</td>";
						if($getEstado == "B"){
							echo "<td $tdProp>$getRecibo (cancelado)</td>";
						}else{
							echo "<td $tdProp>$getRecibo</td>";
						}
						echo "<td $tdProp>$nombre_cliente</td>
						<td $tdProp>$ $importe_format</td>
						<td $tdProp>$ $pagado_format</td>
						<td $tdProp>$getDescuento %</td>
						<td $tdProp>$fecha_format</td>
						<td $tdProp>$getHora</td>
						<td $tdProp align='center' width='15%'>
							<a href='#' data-target='#infoReciboModal' class='info' data-toggle='modal' data-comanda='$getComandaID'><i class='fas fa-info-circle'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href='http://localhost/php/wallace/ajax/reprint.php?id_comanda=$getComandaID&num_recibo=$getRecibo&cod_cliente=$getCliente&pagado=$getPagado' target='_blank'><font color='black'><i class='fas fa-print'></i></font></a>&nbsp;&nbsp;&nbsp;&nbsp;";
							if($getEstado != "B"){
								echo "<a href='#' data-target='#cancelReciboModal' class='danger' data-toggle='modal' data-recibo='$getRecibo' data-comanda='$getComandaID'><font color='red'><i class='fas fa-trash'></i></font></a>";
							}
						echo "</td></tr>";
				}
				echo "</tbody></table></div>";
		}else{
			echo "No hay registros";
		}
	}else{
		echo "No se pudieron cargar los pedidos. Error result_select_pedidos";
	}
?>