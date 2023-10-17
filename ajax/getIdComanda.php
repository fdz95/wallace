<?php
	$output = "";
	if (empty($_GET['num_mesa'])){
		$output = "Error num_mesa";
	} else if (!empty($_GET['num_mesa'])){
		require_once ("conexion.php");
		$num_mesa = mysqli_real_escape_string($conexion,(strip_tags($_GET["num_mesa"],ENT_QUOTES)));
		require_once ("conexion.php");
		$query_pedidos_id_comanda = "SELECT id_comanda FROM t_pedidos WHERE estado_comanda = 'T' AND estado = 'A' AND num_mesa = '$num_mesa';";
		$result_pedidos_id_comanda = mysqli_query($conexion,$query_pedidos_id_comanda);
		if($result_pedidos_id_comanda){
			if (mysqli_num_rows($result_pedidos_id_comanda) > 0){
				$row = mysqli_fetch_array($result_pedidos_id_comanda);
				$output = $row['id_comanda'];
			}
		}
	}
	echo $output;
?>