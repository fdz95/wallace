<?php
	require_once ('conexion.php');
	require_once ('../funciones.php');
	$output = "";
	$config_mesas = 0;
	$config_mesas_extras = 0;
	$num_mesa_extra = 90;
	$count_pool_1 = true;
	$count_pool_2 = true;
	$count_barraAf = true;
	$count_barril = true;
	$count_abajo = true;
	$count_sillon = true;
	$descuento_comanda = 0;
	$nombre_cliente_comanda = "";
	$apellido_cliente_comanda = "";
	$card_col = "col-6";
	$reciptIconType = "#reciptModal";
	
	if(getDeciveType() == "CELULAR"){
		$card_col = "col-12";
		$reciptIconType = "#reciptModalMobile";
	}
	
	$query_config = "SELECT * FROM t_config;";
	$result_query_config = mysqli_query($conexion,$query_config);
	if($result_query_config){
		$row_config = mysqli_fetch_assoc($result_query_config);
		$config_mesas = $row_config['cant_mesas'];
		$config_mesas_extras = $row_config['cant_mesas_extras'];
		
		// loop mesas extras
		for ($e = 90; $e <= $config_mesas_extras; $e++){
			if($count_pool_1){ 	  	 // mesa de pool 1 ==> 90
				$card_colorE = "card-info";
				$card_title = "Pool 1";
				$mesa_type = "POOL";
				$count_pool_1 = false;
			}else if($count_pool_2){  // mesa de pool 2 ==> 91
				$card_colorE = "card-info";
				$card_title = "Pool 2";
				$mesa_type = "POOL";
				$count_pool_2 = false;
			}else if($count_sillon){  // sillon ==> 92
				$card_colorE = "card-danger";
				//$card_colorE = "<div style='background-color:#e89795' class='card collapsed-card'>";
				$card_title = "Sillon";
				$mesa_type = "SILLON";
				$count_sillon = false;
			}else if($count_barraAf){ // barra afuera ==> 93
				$card_colorE = "card-success";
				$card_title = "Barra afuera";
				$mesa_type = "BARRA-AF";
				$count_barraAf = false;
			}else if($count_barril){  // barril ==> 94
				$card_colorE = "card-success";
				$card_title = "Barril";
				$mesa_type = "BARRIL";
				$count_barril = false;
			}else if($count_abajo){   // mesas abajo ==> 95
				$card_colorE = "card-success";
				$card_title = "Mesa Abajo";
				$mesa_type = "ABAJO";
				$count_abajo = false;
			}
			
			$query_select_mesas_extras = "SELECT * FROM t_pedidos WHERE estado = 'A' AND num_mesa = '$e';";
			$result_mesas_extras = mysqli_query($conexion,$query_select_mesas_extras);
			if($result_mesas_extras){
				if(mysqli_num_rows($result_mesas_extras) > 0){
					$query_select_comanda1 = "SELECT id_comanda, cod_cliente FROM t_pedidos WHERE estado = 'A' AND num_mesa = '$e';";
					$result_select_comanda1 = mysqli_query($conexion,$query_select_comanda1);
					$rowE1 = mysqli_fetch_assoc($result_select_comanda1);
					$id_comanda = $rowE1['id_comanda'];
					$id_cliente_comanda = $rowE1['cod_cliente'];
					
					$query_select_cliente_comanda = "SELECT nombre, apellido, descuento FROM t_clientes WHERE Id = '$id_cliente_comanda';";
					$result_cliente_comanda = mysqli_query($conexion,$query_select_cliente_comanda);
					if($result_cliente_comanda){
						if(mysqli_num_rows($result_cliente_comanda) > 0){
							$rowE2 = mysqli_fetch_assoc($result_cliente_comanda);
							$nombre_cliente_comanda = $rowE2['nombre'];
							$apellido_cliente_comanda = $rowE2['apellido'];
							$descuento_comanda = $rowE2['descuento'];
						}
					}else{
						$output .= mysqli_error($conexion);
					}
					/*<a href='#' data-target='#pingPongModal' class='info' data-toggle='modal' data-comanda='$id_comanda' data-mesa='$e' data-cliente='$id_cliente_comanda'><i class='fas fa-table-tennis'></i></a>&nbsp;&nbsp;&nbsp;
					<a href='#' data-target='#calcPoolModal' class='info' data-toggle='modal' data-comanda='$id_comanda' data-mesa='$e' data-cliente='$id_cliente_comanda'><i class='fas fa-calculator'></i></a>&nbsp;&nbsp;&nbsp;*/
					$output .= "<div class='col-lg-3 $card_col'>
								<div class='card $card_colorE collapsed-card'>
									<div class='card-header'>
										<a href='#' class='btn btn-tool' data-card-widget='collapse'><h3 class='card-title'>$card_title</h3></a>
										<div class='card-tools'>
											<a href='#' data-target='#changeModal' class='info' data-toggle='modal' data-comanda='$id_comanda' data-mesa='$e' data-name='$card_title'><i class='fas fa-exchange-alt'></i></a>&nbsp;&nbsp;&nbsp;
											<a href='#' data-target='$reciptIconType' class='info' data-toggle='modal' data-mesa='$e' data-name='$card_title' data-comanda='$id_comanda' data-cliente='$id_cliente_comanda' data-desc='$descuento_comanda'><i class='fas fa-sign-out-alt'></i></a>&nbsp;&nbsp;&nbsp;
											<a href='#' data-target='#comandaModal' class='info' data-toggle='modal' data-mesa='$e' data-name='$card_title'><i class='fas fa-plus'></i></a>
										</div>
									</div>
									<div class='card-body'>
										<div class='card-tools'>
										Cliente <b>$nombre_cliente_comanda $apellido_cliente_comanda</b></br></br>";
					while($rowMesasExt = mysqli_fetch_assoc($result_mesas_extras)){
						$comanda_show = $rowMesasExt['comanda_show'];
						$num_mesa = $rowMesasExt['num_mesa'];
						$articulo = $rowMesasExt['articulo']; // BUSCAR INFO DE ARTICULO
						$cant_articulo = $rowMesasExt['cant_articulo'];
						$importe = $rowMesasExt['importe'];
						$notas = $rowMesasExt['notas'];
						
						//<a href='#' data-target='#editModal' class='info' data-toggle='modal' data-mesa='$num_mesa' data-articulo='$articulo' data-cantedit='$cant_articulo' data-notasedit='$notas'><font color='blue'><i class='fas fa-edit'></i></font></a>
						$output .= "&nbsp;&nbsp;&nbsp;
									<a href='#' data-target='#deleteModal' class='info' data-toggle='modal' data-mesa='$num_mesa' data-comandashow='$comanda_show' data-articulo='$articulo' data-cantidad='$cant_articulo'><font color='red'><i class='fas fa-trash'></i></font></a>
									<b>". $cant_articulo ."</b>x <b>". $articulo ."</b> $". $importe ." ". $notas ."</br></br>";
					}
						
					$output .= "</div></div></div></div>";
				}else{
					/*<a href='#' data-target='#pingPongModal' class='info' data-toggle='modal' data-comanda='' data-mesa='$e'><i class='fas fa-table-tennis'></i></a>&nbsp;&nbsp;&nbsp;
					<a href='#' data-target='#calcPoolModal' class='info' data-toggle='modal' data-comanda='' data-mesa='$e'><i class='fas fa-calculator'></i></a>&nbsp;&nbsp;&nbsp;*/
					$output .="<div class='col-lg-3 col-12'>
								<div class='card $card_colorE collapsed-card'>
									<div class='card-header'>
										<a href='#' class='btn btn-tool' data-card-widget='collapse'><h3 class='card-title'>$card_title</h3></a>
										<div class='card-tools'>
											<a href='#comandaModal' class='btn btn-tool' data-toggle='modal' data-mesa='$e' data-name='$card_title'><i class='fas fa-plus'></i></a>
										</div>
									</div>
									<div class='card-body'>
										<div class='card-tools'>
											Mesa cerrada
										</div>
									</div>
								</div>
							</div>";
				}
			}else{
				echo "Error. No se pudieron cargar las mesas.";
			}
		}
		
		// loop mesas
		for ($i = 1; $i <= $config_mesas; $i++){
			$query_select_mesas = "SELECT * FROM t_pedidos WHERE estado = 'A' AND num_mesa = '$i';";
			$result_select_mesas = mysqli_query($conexion,$query_select_mesas);
			if($result_select_mesas){
				
				// mesas arriba
				$card_color = "card-success";
				$card_title = "Mesa $i";
				$mesa_type = "MESA";
				
				if(mysqli_num_rows($result_select_mesas) > 0){
					$query_select_comanda = "SELECT id_comanda, cod_cliente FROM t_pedidos WHERE estado = 'A' AND num_mesa = '$i';";
					$result_select_comanda = mysqli_query($conexion,$query_select_comanda);
					$row1 = mysqli_fetch_assoc($result_select_comanda);
					$id_comanda = $row1['id_comanda'];
					$id_cliente_comanda = $row1['cod_cliente'];
					
					$query_select_cliente_comanda = "SELECT nombre, apellido, descuento FROM t_clientes WHERE Id = '$id_cliente_comanda';";
					$result_cliente_comanda = mysqli_query($conexion,$query_select_cliente_comanda);
					if($result_cliente_comanda){
						if(mysqli_num_rows($result_cliente_comanda) > 0){
							$row2 = mysqli_fetch_assoc($result_cliente_comanda);
							$nombre_cliente_comanda = $row2['nombre'];
							$apellido_cliente_comanda = $row2['apellido'];
							$descuento_comanda = $row2['descuento'];
						}
					}else{
						$output .= mysqli_error($conexion);
					}
					/*<a href='#' data-target='#pingPongModal' class='info' data-toggle='modal' data-comanda='$id_comanda' data-mesa='$i' data-cliente='$id_cliente_comanda'><i class='fas fa-table-tennis'></i></a>&nbsp;&nbsp;&nbsp;
					<a href='#' data-target='#calcPoolModal' class='info' data-toggle='modal' data-comanda='$id_comanda' data-mesa='$i'><i class='fas fa-calculator'></i></a>&nbsp;&nbsp;&nbsp;*/
					$output .= "<div class='col-lg-3 col-12'>
								<div class='card $card_color collapsed-card'>
									<div class='card-header'>
										<a href='#' class='btn btn-tool' data-card-widget='collapse'><h3 class='card-title'>$card_title</h3></a>
										<div class='card-tools'>
											<a href='#' data-target='#changeModal' class='info' data-toggle='modal' data-comanda='$id_comanda' data-name='$card_title'><i class='fas fa-exchange-alt'></i></a>&nbsp;&nbsp;&nbsp;
											<a href='#' data-target='$reciptIconType' class='info' data-toggle='modal' data-mesa='$i' data-name='Mesa $i' data-comanda='$id_comanda' data-cliente='$id_cliente_comanda' data-desc='$descuento_comanda'><i class='fas fa-sign-out-alt'></i></a>
											<a href='#comandaModal' class='btn btn-tool' data-toggle='modal' data-mesa='$i' data-name='$card_title'><i class='fas fa-plus'></i></a>
										</div>
									</div>
									<div class='card-body'>
										<div class='card-tools'>
										Cliente <b>$nombre_cliente_comanda $apellido_cliente_comanda</b></br></br>";
					while($row = mysqli_fetch_assoc($result_select_mesas)){
						$comanda_show = $row['comanda_show'];
						$num_mesa = $row['num_mesa'];
						$articulo = $row['articulo']; // BUSCAR INFO DE ARTICULO
						$cant_articulo = $row['cant_articulo'];
						$importe = $row['importe'];
						$notas = $row['notas'];
						
						$output .= "&nbsp;&nbsp;&nbsp;
									<a href='#' data-target='#deleteModal' class='info' data-toggle='modal' data-mesa='$num_mesa' data-comandashow='$comanda_show' data-articulo='$articulo' data-cantidad='$cant_articulo'><font color='red'><i class='fas fa-trash'></i></font></a>
									<b>". $cant_articulo ."</b>x <b>". $articulo ."</b> $". $importe ." ". $notas ."</br></br>";
					}
						
					$output .= "</div></div></div></div>";
				}else{
					/*<a href='#' data-target='#pingPongModal' class='info' data-toggle='modal' data-comanda='' data-mesa='$i' data-cliente=''><i class='fas fa-table-tennis'></i></a>&nbsp;&nbsp;&nbsp;
					<a href='#' data-target='#calcPoolModal' class='info' data-toggle='modal' data-comanda='' data-mesa='$i'><i class='fas fa-calculator'></i></a>&nbsp;&nbsp;&nbsp;*/
					$output .="<div class='col-lg-3 col-12'>
								<div class='card $card_color collapsed-card'>
									<div class='card-header'>
										<a href='#' class='btn btn-tool' data-card-widget='collapse'><h3 class='card-title'>$card_title</h3></a>
										<div class='card-tools'>
											<a href='#comandaModal' class='btn btn-tool' data-toggle='modal' data-mesa='$i' data-name='$card_title'><i class='fas fa-plus'></i></a>
										</div>
									</div>
									<div class='card-body'>
										<div class='card-tools'>
											Mesa cerrada
										</div>
									</div>
								</div>
							</div>";
				}
			}else{
				echo "Error. No se pudieron cargar las mesas.";
			}
		}
		
		echo "<section class='content'><div class='row'>". $output. "</div></section>";
		
	}else{
		echo "Error. No se pudieron cargar las mesas --> CONFIG.";
	}
?>