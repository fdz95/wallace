<?php
	$output = "";
	if (empty($_GET['id_cliente'])){
		$output = "Error id_cliente";
	} else if (!empty($_GET['id_cliente'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_cliente = mysqli_real_escape_string($conexion,(strip_tags($_GET["id_cliente"],ENT_QUOTES)));
		require_once ("conexion.php");
		$query_select_cliente_recipt = "SELECT nombre, apellido FROM t_clientes WHERE Id = '$id_cliente';";
		$result_cliente_recipt = mysqli_query($conexion,$query_select_cliente_recipt);
		if($result_cliente_recipt){
			if (mysqli_num_rows($result_cliente_recipt) > 0){
				$row = mysqli_fetch_array($result_cliente_recipt);
				$getNombre = $row['nombre'];
				$getApellido = $row['apellido'];
				
				$output = "<h3>Cliente <b>$getNombre $getApellido</b></h3>";
			}else{
				$output = "No hay registros agregados";
			}
		}else{
			$output = "No se pudieron cargar los clientes. result_cliente_recipt: ". mysqli_error($conexion);
		}
	}else{
		$output = "Error id_cliente";
	}
	echo $output;
?>