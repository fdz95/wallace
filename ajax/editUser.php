<?php
	$output = "";
	if (empty($_POST['edit_user'])){
		$output = "ERROR edit_user";
	} else if (!empty($_POST['edit_user'])){
		require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$edit_user = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_user"],ENT_QUOTES)));
		$edit_password = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_password"],ENT_QUOTES)));
		$edit_user_tipo = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_user_tipo"],ENT_QUOTES)));
		$edit_user_name = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_user_name"],ENT_QUOTES)));
		$edit_user_lastname = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_user_lastname"],ENT_QUOTES)));
		$edit_user_telephone = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_user_telephone"],ENT_QUOTES)));
		$edit_user_address = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_user_address"],ENT_QUOTES)));
		$edit_user_city = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_user_city"],ENT_QUOTES)));
		$fecha_edit = date('Y-m-d');
		$hora_edit = date('H:i');
		
		if(empty($edit_user)){
			$output = "Debe ingresar el usuario";
		}else if(strlen($edit_user) <= 5){
			$output = "El usuario debe tener al menos 5 caracteres";
		}else if(empty($edit_password)){
			$output = "Debe ingresar la contrase&ntilde;a";
		}else if(strlen($edit_password) <= 5){
			$output = "La contrase&ntilde;a debe tener al menos 5 caracteres";
		}else if(empty($edit_user_tipo) || ($edit_user_tipo == "Seleccione el tipo de usuario")){
			$output = "Debe seleccionar el tipo de usuario";
		}else if(empty($edit_user_name)){
			$output = "Debe ingresar el nombre";
		}else if(empty($edit_user_lastname)){
			$output = "Debe ingresar el apellido";
		}else{
			$query_update_user = "UPDATE t_users SET tipo = '$edit_user_tipo', user = '$edit_user', password = '$edit_password', nombre = '$edit_user_name', apellido = '$edit_user_lastname', telefono = '$edit_user_telephone', direccion = '$edit_user_address', localidad = '$edit_user_city' WHERE user = '$edit_user';";
			$result_update_user = mysqli_query($conexion,$query_update_user);
			if ($result_update_user) {
				 $output = "ok";
			}else{
				$output = "No se pudo editar. Por favor, vuelva a intentarlo. result_update_user</br>". mysqli_error($conexion);
			}
		}
	}else{
		$output = "ERROR edit_user";
	}
	echo $output;
?>	