<?php
	require_once ('conexion.php');
	$output = "";
	$query_select_comandas = "SELECT * FROM t_comanda_c WHERE estado = 'T';";
	$result_select_comandas = mysqli_query($conexion,$query_select_comandas);
	if($result_select_comandas){
		if(mysqli_num_rows($result_select_comandas) > 0){
			while($rowComandas = mysqli_fetch_assoc($result_select_comandas)){
				$id_comanda = $rowComandas['id_comanda'];
				$comanda_show = $rowComandas['comanda_show'];
				$num_mesa = $rowComandas['num_mesa'];
				$fecha_comanda = date_create($rowComandas['fecha']);
				$hora_comanda = date_create($rowComandas['hora']);
				$fecha_format = date_format($fecha_comanda, 'd/m/y');
				$time_format = date_format($hora_comanda, 'H:i');
				
				switch($num_mesa){
					case "90":   // mesa de pool 1 ==> 90
						$card_colorE = "card-info";
						$card_title = "Pool 1";
						break;
					case "91":   // mesa de pool 2 ==> 91
						$card_colorE = "card-info";
						$card_title = "Pool 2";
						break;
					case "92":   // sillon ==> 92
						$card_colorE = "card-danger";
						$card_title = "Sillon";
						break;
					case "93":   // barra afuera ==> 93
						$card_colorE = "card-success";
						$card_title = "Barra afuera";
						break;
					case "94":   // barril ==> 94
						$card_colorE = "card-success";
						$card_title = "Barril";
						break;
					case "95":   // mesas abajo ==> 95
						$card_colorE = "card-success";
						$card_title = "Mesa Abajo";
						break;
					default:     // mesas
						$card_colorE = "card-success";
						$card_title = "Mesa $num_mesa";
						break;
				}
									
				$query_select_detalle_comanda = "SELECT * FROM t_comanda WHERE comanda_show = '$comanda_show' AND rubro = 'COMIDAS';";
				$result_detalle_comanda = mysqli_query($conexion,$query_select_detalle_comanda);
				if($result_detalle_comanda){
					if(mysqli_num_rows($result_detalle_comanda) > 0){
						
						$output .= "<div class='col-lg-3 col-6'>
									<div class='card $card_colorE'>
										<div class='card-header'>
											<a href='#' class='btn btn-tool' data-card-widget='collapse'><h3 class='card-title'>$card_title</h3></a>
											<div class='card-tools'>
												<h4><a href='#' data-target='#okComandaModal' class='info' data-toggle='modal' data-comandashow='$comanda_show' data-name='$card_title'><i class='fas fa-check'></i></a>
											</div>
										</div>
										<div class='card-body'>
											<div class='card-tools'>
											<h4>$fecha_format $time_format</h4></br>";
											
						while($rowMesasExt = mysqli_fetch_assoc($result_detalle_comanda)){
							$num_mesa = $rowMesasExt['num_mesa'];
							$articulo = $rowMesasExt['articulo'];
							$rubro_articulo1 = $rowMesasExt['rubro'];
							$cant_articulo = $rowMesasExt['cant_articulo'];
							$importe = $rowMesasExt['importe'];
							$notas = $rowMesasExt['notas'];
							
							if($rubro_articulo1 == "COMIDAS"){
								$output .= "<h3><b>". $cant_articulo ."</b>x <b>". $articulo ."</b></h3><h4>". $notas ."</h4></br></br>";
							}
						}
						$output .= "</div></div></div></div>";
					}
				}else{
					$output = "No se pudieron cargar las mesas. result_detalle_comanda: ". mysqli_error($conexion);
				}
			}
		}else{
			$output = "No hay comandas pendientes";
		}
	}else{
		$output = "No se pudieron cargar las mesas. result_select_comandas: ". mysqli_error($conexion);
	}
	
	echo "<section class='content'><div class='row'>". $output ."</div></section>";
?>