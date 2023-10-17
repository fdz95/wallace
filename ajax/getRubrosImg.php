<?php
	require_once ("conexion.php");
	$output = "";
	$query_select_rubros = "SELECT * FROM t_rubros;";
	$result_select_rubros = mysqli_query($conexion,$query_select_rubros);
	if($result_select_rubros){
		if (mysqli_num_rows($result_select_rubros) > 0){
			while($row = mysqli_fetch_array($result_select_rubros)){
				$getID = $row['Id'];
				$getRubro = $row['rubro'];
				
				$output .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='#' id='imagen_rubros' data-rubroimg='". $getRubro ."'><img src='img/rubros/$getRubro.png' alt='$getRubro' class='brand-image img-circle elevation-3' style='opacity: .8'></a>&nbsp;&nbsp;&nbsp;";
			}
		}else{
			$output = "No hay rubros agregados";
		}
	}else{
		$output = "No se pudieron cargar los articulos. result_select_rubros: ". mysqli_error($conexion);
	}
	echo $output;
?>