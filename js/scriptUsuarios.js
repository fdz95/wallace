		$(function() {
			loadUsuarios();
		});
		
		function loadUsuarios(){
			$.ajax({
				url:'ajax/getUsuarios.php',
				beforeSend: function(objeto){
					$('#loader').html("Cargando...");
				},
				success:function(data){
					$('.outer_div').html(data);
					$('#loader').html('');
				}
			});
		}
		
		$('#addUserModal').on('show.bs.modal', function (event) {
			$('#user').val("");
			$('#password').val("");
			$('#user_tipo').val("Seleccione el tipo de usuario");
			$('#user_name').val("");
			$('#user_lastname').val("");
			$('#user_telephone').val("");
			$('#user_address').val("");
			$('#user_city').val("");
			$('#response_add_user').html("");
		})
		
		$('#add_user_modal').submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/addUser.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#loader').html('Espere, por favor...');
				},
				success: function(datos){
					$('#loader').html('');
					if(datos == "ok"){
						$('#addUserModal').modal('hide');
						$('#response').html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Agregado con exito</div>");
						loadUsuarios();
					}else{
						$('#response_add_user').html(datos);
					}
				}
			});
			event.preventDefault();
		});
				
		$('#infoUserModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var user_nombre = button.data('nombre')
			var user_apellido = button.data('apellido')
			var user_direccion = button.data('direccion')
			var user_localidad = button.data('localidad')
			var user_falta = button.data('falta')
			$('#id_label_info_user').html(user_nombre +" "+ user_apellido +"</br></br>Direccion: "+ user_direccion +"</br>Localidad: "+ user_localidad +"</br>Fecha de alta: "+ user_falta);
		})
		
		$('#editUserModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id = button.data('id')
			var tipo = button.data('tipo')
			$('#edit_user_tipo').val(tipo)
			var user = button.data('user')
			$('#edit_user').val(user)
			var pass = button.data('password')
			$('#edit_password').val(pass)
			var nombre = button.data('nombre')
			$('#edit_user_name').val(nombre)
			var apellido = button.data('apellido')
			$('#edit_user_lastname').val(apellido)
			var telefono = button.data('telefono')
			$('#edit_user_telephone').val(telefono)
			var direccion = button.data('direccion')
			$('#edit_user_address').val(direccion)
			var localidad = button.data('localidad')
			$('#edit_user_city').val(localidad)
		});
		
		$('#edit_user_modal').submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/editUser.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#loader').html('Espere, por favor...');
				},
				success: function(datos){
					$('#loader').html('');
					if(datos == "ok"){
						$('#editUserModal').modal('hide');
						$('#response').html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Editado con exito</div>");
						loadUsuarios();
					}else{
						$('#response_edit_user').html(datos);
					}
				}
			});
			event.preventDefault();
		});
		
		$('#deleteUserModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id_user = button.data('id')
			var user = button.data('user')
			$('#id_delete_user').val(id_user)
			$('#id_delete_title_user').html("¿Seguro que quieres borrar el usuario "+ user +"?")
		})
		
		$('#delete_user_modal').submit(function(event){
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/deleteUser.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#loader').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#loader').html('');
					$('#deleteUserModal').modal('hide');
					loadUsuarios();
				}
			});
			event.preventDefault();
		});