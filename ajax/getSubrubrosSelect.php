<?php
	require_once ("conexion.php");
	$add_rubro_name = mysqli_real_escape_string($conexion,(strip_tags($_POST["select_rubro_name"],ENT_QUOTES)));
	$output = "";
	$query_select_subrubros = "SELECT * FROM t_subrubros WHERE rubro = '$add_rubro_name';";
	$result_select_subrubros = mysqli_query($conexion,$query_select_subrubros);
	if($result_select_subrubros){
		$output = "
		<label>Subrubros</label>
		<select class='form-control' name='select_subrubro_name' id='select_subrubro_name'>
			<option selected>Seleccione un subrubro</option>";
		if (mysqli_num_rows($result_select_subrubros) > 0){
			while($row = mysqli_fetch_array($result_select_subrubros)){
				$getID = $row['Id'];
				$getSubrubro = $row['subrubro'];
				
				$output .= "<option value='$getSubrubro'>$getSubrubro</option>";
			}
			$output .= "</select>";
		}else{
			$output = "No hay subrubros agregados";
		}
	}else{
		$output = "No se pudieron cargar los articulos. result_select_subrubros: ". mysqli_error($conexion);
	}
	echo $output;
?>