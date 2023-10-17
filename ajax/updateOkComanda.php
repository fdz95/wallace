<?php
	if (empty($_POST['id_comanda_show'])){
		$errors[]  = "Debe comanda_show";
	} else if (!empty($_POST['id_comanda_show'])){
		require_once ("conexion.php");
		$comanda_show = mysqli_real_escape_string($conexion,(strip_tags($_POST["id_comanda_show"],ENT_QUOTES)));
		$query_update_ok_comanda = "UPDATE t_comanda_c SET estado = 'P' WHERE comanda_show = '$comanda_show';";
		$result_ok_comanda = mysqli_query($conexion,$query_update_ok_comanda);
		if(!$result_ok_comanda){
			$errors[]  = "Error. Por favor vuelva a intentarlo. result_ok_comanda</br>". mysqli_error($conexion);
		}
	}else{
		$errors[]  = "Error id_comanda_show";
	}
	
	if(isset($errors)){
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
?>