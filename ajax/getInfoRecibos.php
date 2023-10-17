<?php
	$output = "";
	$mesa = "";
	if (empty($_GET['id_comanda'])){
		$errors[] = "ERROR id_comanda";
	} else if (!empty($_GET['id_comanda'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_comanda = mysqli_real_escape_string($conexion,(strip_tags($_GET["id_comanda"],ENT_QUOTES)));
		
		$query_select_pedido = "SELECT * FROM t_pedidos WHERE id_comanda = '$id_comanda';";
		$result_select_pedido = mysqli_query($conexion,$query_select_pedido);
		if($result_select_pedido){
			if(mysqli_num_rows($result_select_pedido) > 0){
				while($row = mysqli_fetch_assoc($result_select_pedido)){
					$num_mesa = $row['num_mesa'];
					$articulo = $row['articulo'];
					$cant_articulo = $row['cant_articulo'];
					$importe = $row['importe'];
					$notas = $row['notas'];
					
					$output .= "<b>". $cant_articulo ."</b>x ". $articulo ." $". $importe ." ". $notas ."</br></br>";
				}
				$output = "id_comanda $id_comanda</br></br><b>Mesa ". $num_mesa ."</br></br>". $output;
				
			}else{
				$output = "No se encontro el detalle del pedido</br>";
			}
		}else{
			$output = "No se pudo cargar. Por favor, vuelva a intentarlo. result_select_pedido</br>";
		}
	}else{
		$output = "ERROR id_comanda";
	}
	echo $output;
?>