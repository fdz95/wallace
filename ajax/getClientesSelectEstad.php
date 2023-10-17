<?php
	require_once ("conexion.php");
	$output = "<select class='form-control' name='select_cliente_estad' id='select_cliente_estad'>";
	$query_select_clientes = "SELECT Id, nombre, apellido FROM t_clientes WHERE estado = 'A' ORDER BY nombre;";
	$result_select_clientes = mysqli_query($conexion,$query_select_clientes);
	if($result_select_clientes){
		if (mysqli_num_rows($result_select_clientes) > 0){
			$output .= "<option selected>Seleccione un cliente</option>";
			while($row2 = mysqli_fetch_array($result_select_clientes)){
				$getID = $row2['Id'];
				$getNombre = $row2['nombre'];
				$getApellido = $row2['apellido'];
				
				$output .= "<option value='$getID'>$getNombre $getApellido</option>";
			}
		}else{
			$output = "No hay registros agregados";
		}
	}else{
		$output = "No se pudieron cargar los clientes. result_select_clientes: ". mysqli_error($conexion);
	}
	echo $output ."</select>";
?>