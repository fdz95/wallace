<?php
	$output = "";
	$break = "\r\n</br>";
	if (empty($_GET['id_comanda'])){
		$output = "ERROR id_comanda";
	} else if (!empty($_GET['id_comanda'])){
		$importe_total = 0;
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_comanda = mysqli_real_escape_string($conexion,(strip_tags($_GET["id_comanda"],ENT_QUOTES)));
		$comanda_add_mesa = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_add_mesa"],ENT_QUOTES)));
		$fecha_comanda_print = date('d/m/Y');
		$hora_comanda_print = date('H:i');
		
		switch($comanda_add_mesa){
			case "90":
				$mesa_name = "POOL 1";
				break;
			case "91":
				$mesa_name = "POOL 2";
				break;
			case "92":
				$mesa_name = "SILLON";
				break;
			case "93":
				$mesa_name = "BARRA AFUERA";
				break;
			case "94":
				$mesa_name = "BARRIL";
				break;
			case "95":
				$mesa_name = "MESAS ABAJO";
				break;
			default:
				$mesa_name = $comanda_add_mesa;
				break;
		}
		
		$query_select_comanda_print = "SELECT * FROM t_comanda WHERE id_comanda = '$id_comanda';";
		$result_comanda_print = mysqli_query($conexion,$query_select_comanda_print);
		if($result_comanda_print){
			if(mysqli_num_rows($result_comanda_print) > 0){
				
				$output .= ".$break.$break.$break". $fecha_comanda_print ." ". $hora_comanda_print ."$break";
				$output .= "Mesa ". $mesa_name ."$break";
				$output .= ".$break";
				
				while($row = mysqli_fetch_assoc($result_comanda_print)){
					$rubro_art = $row['rubro'];
					$articulo = $row['articulo'];
					$cantidad_art = $row['cant_articulo'];
					$notas_art = $row['notas'];
					
					if($rubro_art == "COMIDAS"){
						$output .= $cantidad_art ."x ". $articulo ."$break";
						if(!empty($notas_art)){
							$output .= $notas_art;
							$output .= ".$break";
							$output .= ".$break";
						}
					}
				}
				
				$output .= ".$break.$break.$break.$break.$break.$break
						<style>
							@media print{
								.hidden-print{
									display:none;
								}
							}
						</style>
						<button class='hidden-print' onclick='window.print();'>Imprimir</button>";
						
			}else{
				$output = "No se encontraron articulos. Por favor, vuelva a intentarlo.</br>";
			}
		}else{
			$output = "No se pudieron cargar los articulos. Por favor, vuelva a intentarlo. result_comanda_print</br>";
		}
	}else{
		$output .= "ERROR id_comanda";
	}
	echo $output;
?>	