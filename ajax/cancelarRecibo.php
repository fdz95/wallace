<?php
	if (empty($_POST['id_num_recibo'])){
		$errors[] = "ERROR id_num_recibo";
	} else if (!empty($_POST['id_num_recibo'])){
		require_once ("conexion.php");
		$id_num_recibo = mysqli_real_escape_string($conexion,(strip_tags($_POST["id_num_recibo"],ENT_QUOTES)));
		$id_comanda_recibo = mysqli_real_escape_string($conexion,(strip_tags($_POST["id_comanda_recibo"],ENT_QUOTES)));
		
		$query_cancel_recibo = "UPDATE t_pedidos_c SET estado = 'B' WHERE recibo = '$id_num_recibo';";
		$result_cancel_recibo = mysqli_query($conexion,$query_cancel_recibo);
		if ($result_cancel_recibo) {
			$query_cancel_pedido = "UPDATE t_pedidos SET estado = 'B' WHERE id_comanda = '$id_comanda_recibo';";
			$result_cancel_pedido = mysqli_query($conexion,$query_cancel_pedido);
			if ($result_cancel_pedido) {
				 $messages[] = "Recibo cancelado.";
			}else{
				$errors[] = "No se pudo cancelar. Por favor, vuelva a intentarlo.</br> result_cancel_pedido ";
				$errors[] = mysqli_error($conexion);
			}
		}else{
			$errors[] = "No se pudo cancelar. Por favor, vuelva a intentarlo.</br> result_cancel_recibo ";
			$errors[] = mysqli_error($conexion);
		}
	}
	
	if (isset($errors)){
		?>
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error!</strong> 
			<?php
				foreach ($errors as $error) {
					echo $error;
				}
			?>
		</div>
		<?php
	}
	if (isset($messages)){
		?>
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php
				foreach ($messages as $message) {
					echo $message;
				}
			?>
		</div>
		<?php
	}
?>	