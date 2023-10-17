<?php
	require_once ("conexion.php");
	$output = "";
	$numrows = 0;
	if(empty($_GET['num_mesa'])){
		$query_select_mesas = "SELECT Id, cant_mesas FROM t_config;";
		$result_select_mesas = mysqli_query($conexion,$query_select_mesas);
		if($result_select_mesas){
			$output = "
			<select class='form-control' onchange='getMesaItems(this);' name='comanda_add_mesa' id='comanda_add_mesa'>
				<option value='' selected>Seleccione una mesa</option>
				<option value='90'>POOL 1</option>
				<option value='91'>POOL 2</option>
				<option value='92'>SILLON</option>
				<option value='93'>BARRA AFUERA</option>
				<option value='94'>BARRIL</option>
				<option value='95'>ABAJO</option>";
			if ($numrows = mysqli_num_rows($result_select_mesas) > 0){
				$row = mysqli_fetch_assoc($result_select_mesas);
				$getID = $row['Id'];
				$config_cant_mesas = $row['cant_mesas'];
				
				for ($i = 1; $i <= $config_cant_mesas; $i++){
					$output .= "<option value='$i'>MESA $i</option>";
				}
				
				$output .= "</select>";
			}else{
				$output = "No hay mesas agregadas";
			}
		}else{
			$output = "No se pudieron cargar las mesas. Error result_select_mesas_config";
		}
	}else{
		$num_mesa = $_GET['num_mesa'];
		$name_mesa = $_GET['name_mesa'];
		$output = "
		<select class='form-control' onchange='getMesaItems(this);' name='comanda_add_mesa' id='comanda_add_mesa'>
			<option value='$num_mesa'>$name_mesa</option>
		</select>";
	}
	echo $output;
?>