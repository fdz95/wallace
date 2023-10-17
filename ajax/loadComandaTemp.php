<?php
	$output = "";
	if (empty($_GET['comanda_add_random'])){
		$errors[] = "ERROR comanda_add_random";
	} else if (!empty($_GET['comanda_add_random'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_comanda = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_add_random"],ENT_QUOTES)));
		$fecha_add = date('Y-m-d');
		$hora_add = date('H:i');
		
		$query_select_comanda = "SELECT * FROM t_comanda WHERE id_comanda = '$id_comanda' AND estado_comanda = 'T' AND estado = 'T';";
		$result_query_select_comanda = mysqli_query($conexion,$query_select_comanda);
		if($result_query_select_comanda){
			if(mysqli_num_rows($result_query_select_comanda) > 0){
				while($row = mysqli_fetch_assoc($result_query_select_comanda)){
					$num_mesa = $row['num_mesa'];
					$articulo = $row['articulo'];
					$cant_articulo = $row['cant_articulo'];
					$importe = $row['importe'];
					$notas = $row['notas'];
					
					// TODO: DELET ART COMANDA TEMP
					$output .= "&nbsp;&nbsp;&nbsp;
								<a href='#' id='delete_art_temp' data-comanda='$id_comanda' data-mesa='$num_mesa' data-articulo='$articulo'><font color='red'><i class='fas fa-trash'></i></font></a>
								<b>". $cant_articulo ."</b>x <b>". $articulo ."</b> $". $importe ." - ". $notas ."</br></br>";
				}
			}else{
				$output = "No se encontraron articulos</br>";
			}
		}else{
			$output = "No se pudo agregar. Por favor, vuelva a intentarlo. result_query_select_comanda</br>";
		}
	}else{
		$output = "ERROR id_comanda";
	}
	echo $output;
?>