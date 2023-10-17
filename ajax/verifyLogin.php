<?php
    session_start();
	$output = "";
	if (empty($_POST['user'])){
		$output = "Debe ingresar un usuario";
	} else if (!empty($_POST['user'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$login_user = mysqli_real_escape_string($conexion,(strip_tags($_POST["user"],ENT_QUOTES)));
		$login_pass = mysqli_real_escape_string($conexion,(strip_tags($_POST["password"],ENT_QUOTES)));
		$fecha_login = date('Y-m-d');
		$hora_login = date('H:i');
		
		if(empty($login_pass)){
			$output = "Debe ingresar la contrase&ntilde;a";
		}else{
			$query_select_user = "SELECT * FROM t_users WHERE user = '$login_user';";
			$result_select_user = mysqli_query($conexion,$query_select_user);
			if($result_select_user){
				if(mysqli_num_rows($result_select_user) > 0){
					$row_users = mysqli_fetch_assoc($result_select_user);
					if($row_users['estado'] == "A"){
						if($row_users['password'] === $login_pass){
							$query_update_login = "UPDATE t_users SET fecha_ingreso = '$fecha_login', hora_ingreso = '$hora_login' WHERE user = '$login_user'";
							$result_update_login = mysqli_query($conexion,$query_update_login);
							if($result_update_login){
								$_SESSION['user_wallace'] = $login_user;
								$output = "";
							}else{
								$output = "No se pudo ingresar. Por favor, vuelva a intentarlo.</br>result_update_login: ".  mysqli_error($conexion);
							}
						}else{
							$output = "Contrase&ntilde;a incorrecta. Intente de nuevo";
						}
					}else{
						$output = "No se puede ingresar. El usuario $login_user esta desactivado.";
					}
				}else{
					$output = "Usuario incorrecto. Intente de nuevo";
				}
			}else{
				$output = "No se pudo ingresar. Por favor, vuelva a intentarlo.</br>result_select_user: ".  mysqli_error($conexion);
			}
		}
	}else{
		$output = "Debe ingresar un usuario";
	}
	
	echo $output;
?>