<?php
	$output = "";
	$break = "\r\n</br>";
	if (empty($_GET['id_comanda'])){
		$output = "ERROR id_comanda";
	} else if (!empty($_GET['id_comanda'])){
		$importe_total = 0;
		$nombre_cliente = "";
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_comanda = mysqli_real_escape_string($conexion,(strip_tags($_GET["id_comanda"],ENT_QUOTES)));
		$numero_recibo = mysqli_real_escape_string($conexion,(strip_tags($_GET["num_recibo"],ENT_QUOTES)));
		$num_cliente = mysqli_real_escape_string($conexion,(strip_tags($_GET["cod_cliente"],ENT_QUOTES)));
		$importe_pagado = mysqli_real_escape_string($conexion,(strip_tags($_GET["pagado"],ENT_QUOTES)));
		$fecha_recipt_print = date('d/m/y');
		$hora_recipt_print = date('H:i');
		
		$query_select = "SELECT * FROM t_pedidos WHERE id_comanda = '$id_comanda';";
		$result_query_select = mysqli_query($conexion,$query_select);
		if($result_query_select){
			if(mysqli_num_rows($result_query_select) > 0){
				
				// select datos cliente
				$query_select_cliente = "SELECT * FROM t_clientes WHERE Id = '$num_cliente';";
				$result_select_cliente = mysqli_query($conexion,$query_select_cliente);
				if($result_select_cliente){
					if(mysqli_num_rows($result_select_cliente) > 0){
						$row_cliente = mysqli_fetch_assoc($result_select_cliente);
						$nombre_cliente = $row_cliente['nombre'] ." ".  $row_cliente['apellido'];
					}
				}else{
					$output .= "ERROR result_select_cliente: ". mysqli_error($conexion);
				}
				
				$output .= ".$break";
				$output .= ".$break";
				$output .= ".$break";
				$output .= "Wallace - Mas que un bar$break";
				$output .= "Rec 00". $numero_recibo ." ". $fecha_recipt_print ." ". $hora_recipt_print ."$break";
				$output .= $nombre_cliente ."$break";
				$output .= ".$break";
				$output .= "Cant. Articulo Precio$break";
				
				while($row = mysqli_fetch_assoc($result_query_select)){
					$articulo = $row['articulo'];
					$cantidad_art = $row['cant_articulo'];
					$importe_art = $row['importe'];
					
					$output .= $cantidad_art ."x ". $articulo . " $". $importe_art ."$break";
				}
				
				$output .= ".$break";
				$output .= "</br>Total pagado: <b>$". $importe_pagado ."</b>$break";
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
		}else{
			$output .= "ERROR result_query_select";
		}
	}else{
		$output .= "ERROR id_comanda";
	}
	echo $output;
?>	