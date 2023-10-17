<?php
	require_once ("conexion.php");
	$selected_rubro = mysqli_real_escape_string($conexion,(strip_tags($_GET["selected_rubro"],ENT_QUOTES)));
	$selected_subrubro = mysqli_real_escape_string($conexion,(strip_tags($_GET["selected_subrubro"],ENT_QUOTES)));
	$output = "";
	$query_select_articulos = "SELECT * FROM t_articulos WHERE estado = 'A' AND rubro = '$selected_rubro' AND subrubro = '$selected_subrubro' ORDER BY tipo;";
	$result_select_articulos = mysqli_query($conexion,$query_select_articulos);
	if($result_select_articulos){
		$output = "<select class='form-control' name='comanda_add_articulo' id='comanda_add_articulo'>
			<option selected>Seleccione un articulo</option>";
		if ($numrows = mysqli_num_rows($result_select_articulos) > 0){
			while($row = mysqli_fetch_array($result_select_articulos)){
				$getID = $row['Id'];
				$getTipo = $row['tipo'];
				$getArticulo = $row['articulo'];
				$getDescrip = $row['descripcion'];
				$getPrecio = $row['precio'];
				
				$output .= "<option value='$getArticulo'>$getTipo - $getArticulo</option>";
			}
			$output .= "</select>";
		}else{
			$output = "No hay registros agregados";
		}
	}else{
		$output = "No se pudieron cargar los articulos. result_select_articulos: ". mysqli_error($conexion);
	}
	echo $output;
?>