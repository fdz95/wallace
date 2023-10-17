<?php
	$output = "";
	$break = "\r\n</br>";
	if (empty($_GET['id_recipt_mesa'])){
		$output = "ERROR id_recipt_mesa";
	} else if (!empty($_GET['id_recipt_mesa'])){
		$importe_total = 0;
		$nombre_cliente = "";
		$numero_recibo = 0;
		$numero_sesion = 0;
		$format_met_pago = "";
		require_once ("conexion.php");
		
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_comanda = mysqli_real_escape_string($conexion,(strip_tags($_GET["id_comanda"],ENT_QUOTES)));
		$recipt_print_mesa = mysqli_real_escape_string($conexion,(strip_tags($_GET["id_recipt_mesa"],ENT_QUOTES)));
		$recipt_print_cliente = mysqli_real_escape_string($conexion,(strip_tags($_GET["recipt_cliente"],ENT_QUOTES)));
		$recipt_print_importe = mysqli_real_escape_string($conexion,(strip_tags($_GET["recipt_importe"],ENT_QUOTES)));
		$recipt_print_pagado = mysqli_real_escape_string($conexion,(strip_tags($_GET["recipt_pagado"],ENT_QUOTES)));
		$recipt_print_met_pago = mysqli_real_escape_string($conexion,(strip_tags($_GET["recipt_met_pago"],ENT_QUOTES)));
		$recipt_print_nota = mysqli_real_escape_string($conexion,(strip_tags($_GET["recipt_nota"],ENT_QUOTES)));
		$recipt_desc = mysqli_real_escape_string($conexion,(strip_tags($_GET["recipt_desc"],ENT_QUOTES)));
		$fecha_recipt_print = date('d/m/y');
		$fecha_recipt_print_db = date('Y-m-d');
		$hora_recipt_print = date('H:i');
		
		// select datos cliente
		$query_select_cliente = "SELECT * FROM t_clientes WHERE Id = '$recipt_print_cliente';";
		$result_select_cliente = mysqli_query($conexion,$query_select_cliente);
		if($result_select_cliente){
			if(mysqli_num_rows($result_select_cliente) > 0){
				$row_cliente = mysqli_fetch_assoc($result_select_cliente);
				$nombre_cliente = $row_cliente['nombre'] ." ".  $row_cliente['apellido'];
			}
		}else{
			$output .= "ERROR result_select_cliente: ". mysqli_error($conexion);
		}
		
		// select num_recibo, num_sesion
		$query_select_num_recibo = "SELECT * FROM t_config WHERE Id = '1';";
		$result_select_num_recibo = mysqli_query($conexion,$query_select_num_recibo);
		if($result_select_num_recibo){
			if(mysqli_num_rows($result_select_num_recibo) > 0){
				$row_config = mysqli_fetch_assoc($result_select_num_recibo);
				$numero_recibo = $row_config['num_recibo'];
				$numero_sesion = $row_config['num_sesion'];
			}
		}
		
		switch($recipt_print_met_pago){
			case "EFECT":
				$format_met_pago = "EFECTIVO";
				break;
			case "TDEBI":
				$format_met_pago = "TARJ. DEBITO";
				break;
			case "TCRED":
				$format_met_pago = "TARJ. CREDITO";
				break;
		}
		
		$query_select = "SELECT * FROM t_pedidos WHERE estado = 'A' AND num_mesa = '$recipt_print_mesa';";
		$result_query_select = mysqli_query($conexion,$query_select);
		if($result_query_select){
			if(mysqli_num_rows($result_query_select) > 0){
				$output .= ".$break";
				$output .= ".$break";
				$output .= ".$break";
				$output .= "Wallace - Mas que un bar$break";
				$output .= "Rec. 00". $numero_recibo ." ". $fecha_recipt_print ." ". $hora_recipt_print ."$break";
				$output .= $nombre_cliente ."$break";
				$output .= ".$break";
				$output .= "Cant. Articulo Precio$break";
				
				while($row = mysqli_fetch_assoc($result_query_select)){
					$articulo = $row['articulo'];
					$cantidad_art = $row['cant_articulo'];
					$importe_art = $row['importe'];
					$importe_total = $importe_total + ($importe_art * $cantidad_art);
					
					$output .= $cantidad_art ."x ". $articulo . " $". $importe_art ."$break";
				}
				
				$output .= ".$break";
				$output .= $format_met_pago ."$break";
				$output .= "Total: <b>$". $recipt_print_pagado ."</b>$break";
				$output .= ".$break";
				$output .= ".$break";
				
				if(!empty($recipt_print_nota)){
					$output .= $recipt_print_nota ."$break";
				}
				
				$output .= "===========================$break";
				$output .= "== Gracias por su compra ==$break";
				$output .= "===========================$break";
				
				$output .= ".$break.$break.$break.$break.$break.$break.$break
						<style>
							@media print{
								.hidden-print{
									display:none;
								}
							}
						</style>
						<button class='hidden-print' onclick='window.print();'>Imprimir</button>";
			}else{
				$output .= "No se encontraron articulos. Por favor, vuelva a intentarlo. num_rows</br>";
			}
			
			updateReciptMesa($conexion,$recipt_print_mesa,$id_comanda,$recipt_print_cliente,$importe_total,$recipt_print_pagado,$recipt_desc,$format_met_pago,$fecha_recipt_print_db,$hora_recipt_print,$numero_recibo,$numero_sesion);
		}else{
			$output .= "ERROR result_query_select: ". mysqli_error($conexion);
		}
	}else{
		$output .= "ERROR recipt_mesa";
	}
	
	function updateReciptMesa($conexion,$recipt_mesa, $id_comanda, $recipt_print_cliente, $importe_total, $recipt_print_pagado, $recipt_desc, $format_met_pago, $fecha_recipt_print_db, $hora_recipt_print, $numero_recibo, $numero_sesion){
		$query_insert_pedidosC = "INSERT INTO t_pedidos_c(estado,id_comanda, sesion, recibo, cod_cliente, importe, pagado, descuento, met_pago, fecha, hora)
		VALUES('C','$id_comanda', '$numero_sesion', '$numero_recibo', '$recipt_print_cliente', '$importe_total', '$recipt_print_pagado','$recipt_desc', '$format_met_pago', '$fecha_recipt_print_db', '$hora_recipt_print');";
		$result_insert_pedidosC = mysqli_query($conexion,$query_insert_pedidosC);
		if ($result_insert_pedidosC){
			$query_update_recipt = "UPDATE t_pedidos SET estado = 'C' WHERE estado = 'A' AND num_mesa = '$recipt_mesa';";
			$result_query_update_recipt = mysqli_query($conexion,$query_update_recipt);
			if($result_query_update_recipt){
				
				$query_update_comanda = "UPDATE t_comanda SET estado_comanda = 'P' WHERE estado_comanda = 'T' AND estado = 'P' AND num_mesa = '$recipt_mesa';";
				$result_update_comanda = mysqli_query($conexion,$query_update_comanda);
				if($result_update_comanda){
					updateNumRecibo($conexion,$numero_recibo);
				}else{
					$output = "ERROR result_update_comanda. ". mysqli_error($conexion);
				}
			}else{
				$output = "ERROR result_query_update_recipt. ". mysqli_error($conexion);
			}
		}else{
			$output = "ERROR result_insert_pedidosC. ". mysqli_error($conexion);
		}
	}
	
	function updateNumRecibo($conexion,$numero_recibo){
		$new_num_recibo = $numero_recibo + 1;
		$query_update_num_recibo = "UPDATE t_config SET num_recibo = '$new_num_recibo' WHERE Id = '1';";
		$result_update_num_recibo = mysqli_query($conexion,$query_update_num_recibo);
		if(!$result_update_num_recibo){
			$output = "ERROR result_update_num_recibo. ". mysqli_error($conexion);
		}
	}
	echo $output;
?>	