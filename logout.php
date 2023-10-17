<?php
	require_once ("ajax/conexion.php");
	$query_select_sesion = "SELECT * FROM t_config WHERE Id = '1';";
	$result_select_sesion = mysqli_query($conexion,$query_select_sesion);
	if($result_select_sesion){
		$row_config = mysqli_fetch_assoc($result_select_sesion);
		$new_num_sesion = $row_config['num_sesion'] + 1;
		$query_update_sesion = "UPDATE t_config SET num_sesion = '$new_num_sesion' WHERE Id = '1';";
		$result_update_sesion = mysqli_query($conexion,$query_update_sesion);
		if(!$result_update_sesion){
			echo "ERROR result_update_sesion. ". mysqli_error($conexion);
		}
	}else{
		echo "ERROR result_select_sesion. ". mysqli_error($conexion);
	}
	
	session_start();
	if (isset($_GET['logout'])) {
		unset($_SESSION['user_wallace']);
		session_unset();
		session_destroy();
	}
?>