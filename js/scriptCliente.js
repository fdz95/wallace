		$(function() {
			loadClientes();
		});
		
		function loadClientes(){
			$.ajax({
				url:'ajax/getClientes.php',
				beforeSend: function(objeto){
					$('#loader').html("Cargando...");
				},
				success:function(data){
					$('.outer_div').html(data);
					$('#loader').html('');
				}
			});
		}
		
		$('#add_cliente_modal').submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/addCliente.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#loader').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#loader').html('');
					$('#addClienteModal').modal('hide');
					loadClientes();
					clear();
				}
			});
			event.preventDefault();
		});
		
		function clear(){
			$('#add_cliente_nombre').val("")
			$('#add_cliente_apellido').val("")
			$('#add_cliente_descuento').val("")
			$('#add_cliente_celular').val("")
			$('#add_cliente_direccion').val("")
			$('#add_cliente_localidad').val("")
		}
						
		$('#infoClienteModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var cliente_nombre = button.data('nombre')
			var cliente_apellido = button.data('apellido')
			var cliente_falta = button.data('falta')
			$('#id_label_info_cliente').html(cliente_nombre +" "+ cliente_apellido +"</br></br>Fecha de alta: "+ cliente_falta);
		})
		
		$('#editClienteModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id = button.data('id')
			$('#id_edit_cliente_id').val(id)
			var nombre = button.data('nombre')
			$('#edit_cliente_nombre').val(nombre)
			var apellido = button.data('apellido')
			$('#edit_cliente_apellido').val(apellido)
			var desc = button.data('desc')
			$('#edit_cliente_descuento').val(desc)
			var telefono = button.data('telefono')
			$('#edit_cliente_celular').val(telefono)
			var direccion = button.data('direccion')
			$('#edit_cliente_direccion').val(direccion)
			var localidad = button.data('localidad')
			$('#edit_cliente_localidad').val(localidad)
		});
		
		$('#edit_cliente_modal').submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/editCliente.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#loader').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#loader').html('');
					$('#editClienteModal').modal('hide');
					loadClientes();
				}
			});
			event.preventDefault();
		});
		
		$('#deleteClienteModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id_cliente = button.data('id')
			var nombre = button.data('nombre')
			var apellido = button.data('apellido')
			$('#id_delete_cliente_id').val(id_cliente)
			$('#id_delete_title_cliente').html("¿Seguro que quieres borrar al cliente "+ nombre +" " + apellido +"?")
		})
		
		$('#delete_cliente_modal').submit(function(event){
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/deleteCliente.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#loader').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#loader').html('');
					$('#deleteClienteModal').modal('hide');
					loadClientes();
				}
			});
			event.preventDefault();
		});