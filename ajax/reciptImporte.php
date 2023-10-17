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
		
		$query_select_importe = "SELECT * FROM t_pedidos WHERE estado = 'A' AND num_mesa = '$recipt_mesa';";
		$result_query_select_importe = mysqli_query($conexion,$query_select_importe);
		if($result_query_select_importe){
			if(mysqli_num_rows($result_query_select_importe) > 0){
				while($row = mysqli_fetch_assoc($result_query_select_importe)){
					$cantidad_art = $row['cant_articulo'];
					$importe_art = $row['importe'];
					$importe_total = ceil($importe_total + ($importe_art * $cantidad_art));
				}
			}else{
				$output .= "No se encontraron articulos. Por favor, vuelva a intentarlo. num_rows</br>";
			}
		}else{
			$output .= "ERROR result_query_select_importe";
		}
	}else{
		$output .= "ERROR recipt_mesa";
	}
	
	echo $importe_total;
?>