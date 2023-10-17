<?php
	require_once ("conexion.php");
	$output = "";
	$query_select_rubros = "SELECT * FROM t_rubros;";
	$result_select_rubros = mysqli_query($conexion,$query_select_rubros);
	if($result_select_rubros){
		$output = "
		<label>Rubros</label>
		<select class='form-control' onchange='getAddRubros(this);' name='select_rubro_name' id='select_rubro_name'>
			<option selected>Seleccione un rubro</option>";
		if (mysqli_num_rows($result_select_rubros) > 0){
			while($row = mysqli_fetch_array($result_select_rubros)){
				$getID = $row['Id'];
				$getRubro = $row['rubro'];
				
				$output .= "<option value='$getRubro'>$getRubro</option>";
			}
			$output .= "</select>";
		}else{
			$output = "No hay rubros agregados";
		}
	}else{
		$output = "No se pudieron cargar los articulos. result_select_rubros: ". mysqli_error($conexion);
	}
	echo $output;
?>