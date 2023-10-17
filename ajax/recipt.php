<?php
	$output = "";
	if (empty($_GET['recipt_mesa'])){
		$output = "ERROR recipt_mesa";
	} else if (!empty($_GET['recipt_mesa'])){
		$importe_total = 0;
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$recipt_mesa = mysqli_real_escape_string($conexion,(strip_tags($_GET["recipt_mesa"],ENT_QUOTES)));
		$fecha_recipt = date('Y-m-d');
		$hora_recipt = date('H:i');
		
		$query_select = "SELECT * FROM t_pedidos WHERE estado = 'A' AND num_mesa = '$recipt_mesa';";
		$result_query_select = mysqli_query($conexion,$query_select);
		if($result_query_select){
			if(mysqli_num_rows($result_query_select) > 0){
				while($row = mysqli_fetch_assoc($result_query_select)){
					$articulo = $row['articulo'];
					$cantidad_art = $row['cant_articulo'];
					$importe_art = $row['importe'];
					$importe1 = $importe_art * $cantidad_art;
					$importe_total = $importe_total + ($importe_art * $cantidad_art);
					
					$output .= "<h4><b>". $cantidad_art ."x</b> ". $articulo . " $". $importe_art ." -> $". $importe1 ."</h4></br>";
				}
				
				$output .= "</br><h3>Importe total: <b>$". $importe_total ."</b></h3>";
				
			}else{
				$output .= "No se encontraron articulos. Por favor, vuelva a intentarlo. num_rows</br>";
			}
		}else{
			$output .= "ERROR result_query_select";
		}
	}else{
		$output .= "ERROR recipt_mesa";
	}
	
	echo $output;
?>	