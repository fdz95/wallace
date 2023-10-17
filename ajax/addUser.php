<?php
	$output = "";
	if (empty($_POST['user'])){
		$output = "Debe ingresar el usuario";
	} else if (!empty($_POST['user'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$add_user = mysqli_real_escape_string($conexion,(strip_tags($_POST["user"],ENT_QUOTES)));
		$add_password = mysqli_real_escape_string($conexion,(strip_tags($_POST["password"],ENT_QUOTES)));
		$add_user_tipo = mysqli_real_escape_string($conexion,(strip_tags($_POST["user_tipo"],ENT_QUOTES)));
		$add_user_name = mysqli_real_escape_string($conexion,(strip_tags($_POST["user_name"],ENT_QUOTES)));
		$add_user_lastname = mysqli_real_escape_string($conexion,(strip_tags($_POST["user_lastname"],ENT_QUOTES)));
		$add_user_telephone = mysqli_real_escape_string($conexion,(strip_tags($_POST["user_telephone"],ENT_QUOTES)));
		$add_user_address = mysqli_real_escape_string($conexion,(strip_tags($_POST["user_address"],ENT_QUOTES)));
		$add_user_city = mysqli_real_escape_string($conexion,(strip_tags($_POST["user_city"],ENT_QUOTES)));
		$fecha_add_art = date('Y-m-d');
		$hora_add_art = date('H:i');
		$date_alta = $fecha_add_art ." ". $hora_add_art;
		
		if(empty($add_user)){
			$output = "Debe ingresar el usuario";
		}else if(strlen($add_user) <= 5){
			$output = "El usuario debe tener al menos 5 caracteres";
		}else if(empty($add_password)){
			$output = "Debe ingresar la contrase&ntilde;a";
		}else if(strlen($add_password) <= 5){
			$output = "La contrase&ntilde;a debe tener al menos 5 caracteres";
		}else if(empty($add_user_tipo) || ($add_user_tipo == "Seleccione el tipo de usuario")){
			$output = "Debe seleccionar el tipo de usuario";
		}else if(empty($add_user_name)){
			$output = "Debe ingresar el nombre";
		}else if(empty($add_user_lastname)){
			$output = "Debe ingresar el apellido";
		}else{
			$query_search_user = "SELECT * FROM t_users WHERE estado = 'A' AND user = '$add_user';";
			$result_search_user = mysqli_query($conexion,$query_search_user);
			if($result_search_user){
				if(mysqli_num_rows($result_search_user) > 0){
					$output = "El usuario <b>$add_user</b> ya esta agregado";
				}else{
					$query_insert_user = "INSERT INTO t_users(estado, tipo, user, password, nombre, apellido, telefono, direccion, localidad, fecha_alta)
					VALUES('A', '$add_user_tipo', '$add_user', '$add_password', '$add_user_name', '$add_user_lastname', '$add_user_telephone', '$add_user_address', '$add_user_city', '$date_alta');";
					$result_insert_user = mysqli_query($conexion,$query_insert_user);
					if ($result_insert_user) {
						 $output = "ok";
					}else{
						$output = "No se pudo agregar. Por favor, vuelva a intentarlo. result_insert_user</br>". mysqli_error($conexion);
					}
				}
			}else{
				$output = "No se pudo agregar. Por favor, vuelva a intentarlo. result_search_user</br>". mysqli_error($conexion);
			}
		}
	}else{
		$output = "Debe ingresar el usuario";
	}
	echo $output;
?>