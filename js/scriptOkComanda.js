		$(function() {
			loadComanda();
		});
		
		function loadComanda(){
			$.ajax({
				url:'ajax/getComandas.php',
				beforeSend: function(objeto){
					$('#response_ok_comanda').html("Cargando...");
				},
				success:function(data){
					$('.outer_div_ok_comanda').html(data);
					$('#response_ok_comanda').html('');
				}
			});
		}
		
		$('#okComandaModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id_comanda_show = button.data('comandashow')
			var nombre_mesa = button.data('name')
			$('#id_comanda_show').val(id_comanda_show)
			console.log(id_comanda_show);
			$('#id_title_ok_comanda').html("Confirmar comanda - "+ nombre_mesa)
		})
		
		$('#ok_comanda_modal').submit(function(event){
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/updateOkComanda.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#response_ok_comanda').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response_ok_comanda').html(datos);
					console.log(datos);
					$('#okComandaModal').modal('hide');
					loadComanda();
				}
			});
			event.preventDefault();
		});