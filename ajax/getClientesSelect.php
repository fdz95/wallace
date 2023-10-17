<?php
	if (empty($_GET['num_mesa'])){
		$output = "Error num_mesa";
	} else if (!empty($_GET['num_mesa'])){
		$getNombre = null;
		$getApellido = null;
		require_once ("conexion.php");
		$num_mesa = mysqli_real_escape_string($conexion,(strip_tags($_GET["num_mesa"],ENT_QUOTES)));
		$output = "";
		$output = "<select class='form-control' name='comanda_add_cliente' id='comanda_add_cliente'>";
		
		$query_select_cliente_mesa = "SELECT Id, cod_cliente FROM t_pedidos WHERE estado = 'A' AND num_mesa = '$num_mesa';";
		$result_cliente_mesa = mysqli_query($conexion,$query_select_cliente_mesa);
		if($result_cliente_mesa){
			if (mysqli_num_rows($result_cliente_mesa) > 0){
				$row = mysqli_fetch_array($result_cliente_mesa);
				$getID = $row['Id'];
				$getCliente = $row['cod_cliente'];

				$query_s_clientes = "SELECT Id, nombre, apellido FROM t_clientes WHERE Id = '$getCliente';";
				$result_s_clientes = mysqli_query($conexion,$query_s_clientes);
				if($result_s_clientes){
					if (mysqli_num_rows($result_s_clientes) > 0){
						$row1 = mysqli_fetch_array($result_s_clientes);
						$getID = $row1['Id'];
						$getNombre = $row1['nombre'];
						$getApellido = $row1['apellido'];
					}else{
						$output = "No hay registros agregados";
					}
				}else{
					$output = "No se pudieron cargar los clientes. result_s_clientes: ". mysqli_error($conexion);
				}
				
				$output .= "<option value='$getID'>$getNombre $getApellido</option>";
			}else{
				$query_select_clientes = "SELECT Id, nombre, apellido FROM t_clientes WHERE estado = 'A' ORDER BY nombre;";
				$result_select_clientes = mysqli_query($conexion,$query_select_clientes);
				if($result_select_clientes){
					if (mysqli_num_rows($result_select_clientes) > 0){
						$output .= "<option value='Seleccione un cliente'>Seleccione un cliente</option>";
						$output .= "<option value='1' selected>CONSUMIDOR FINAL</option>";
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
			}
			$output .= "</select>";
		}else{
			$output = "No se pudieron cargar los clientes. result_cliente_mesa: ". mysqli_error($conexion);
		}
	}else{
		$output = "Error num_mesa";
	}
	echo $output;
?>