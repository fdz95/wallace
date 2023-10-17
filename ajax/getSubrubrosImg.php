<?php
	require_once ("conexion.php");
	$add_rubro_name = mysqli_real_escape_string($conexion,(strip_tags($_GET["select_rubro_name"],ENT_QUOTES)));
	$output = "";
	$query_select_subrubros = "SELECT * FROM t_subrubros WHERE rubro = '$add_rubro_name';";
	$result_select_subrubros = mysqli_query($conexion,$query_select_subrubros);
	if($result_select_subrubros){
		if (mysqli_num_rows($result_select_subrubros) > 0){
			while($row = mysqli_fetch_array($result_select_subrubros)){
				$getID = $row['Id'];
				$getSubrubro = $row['subrubro'];
				
				$output .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='#' id='imagen_subrubros' data-srubroimg='". $add_rubro_name ."' data-subrubroimg='". $getSubrubro ."'><img src='img/subrubros/$getSubrubro.png' alt='$getSubrubro' class='brand-image img-circle elevation-3' style='opacity: .8'></a>&nbsp;&nbsp;&nbsp;";
			}
		}else{
			$output = "No hay subrubros agregados";
		}
	}else{
		$output = "No se pudieron cargar los articulos. result_select_subrubros: ". mysqli_error($conexion);
	}
	echo $output;
?>