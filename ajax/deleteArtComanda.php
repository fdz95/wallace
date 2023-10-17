<?php
	$output = "";
	if (!empty($_GET['comanda_temp_mesa'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_comanda = mysqli_real_escape_string($conexion,(strip_tags($_GET["id_comanda"],ENT_QUOTES)));
		$comanda_temp_mesa = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_temp_mesa"],ENT_QUOTES)));
		$comanda_temp_art = mysqli_real_escape_string($conexion,(strip_tags($_GET["comanda_temp_art"],ENT_QUOTES)));
		$fecha_del = date('Y-m-d');
		$hora_del = date('H:i');
		
		// DELETE FROM database
		$query_delete_art_temp = "DELETE FROM t_comanda WHERE estado = 'T' AND num_mesa = '$comanda_temp_mesa' AND articulo = '$comanda_temp_art';";
		$result_query_delete_temp = mysqli_query($conexion,$query_delete_art_temp);
		if (!$result_query_delete_temp) {
			$output = "No se pudo borrar. Vuelva a intentarlo. ERROR result_query_delete_temp: ". mysqli_error($conexion);
		}
	}else{
		$output = "No se pudo borrar. Vuelva a intentarlo. ERROR comanda_temp_mesa";
	}
?>