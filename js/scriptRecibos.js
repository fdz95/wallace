		$(function() {
			loadRecibos();
		});
		
		function loadRecibos(){
			$.ajax({
				url:'ajax/getRecibos.php',
				beforeSend: function(objeto){
					$('#loader').html("Cargando...");
				},
				success:function(data){
					$('.outer_div').html(data);
					$('#loader').html('');
				}
			});
		}
		
		$('#infoReciboModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id_comanda = button.data('comanda')
			$.ajax({
				url:'ajax/getInfoRecibos.php?id_comanda='+ id_comanda,
				beforeSend: function(objeto){
					$('#id_label_info_recibo').html("Cargando...");
				},
				success:function(datos){
					$('#id_label_info_recibo').html(datos);
				}
			});
		})
		
		function rePrintRecipt(id_comanda_recipt){
			window.open("http://localhost/php/wallace/ajax/reprint.php?id_comanda="+ id_comanda_recipt,"_blank");
		}
		
		$('#cancelReciboModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var recibo = button.data('recibo')
			var comanda = button.data('comanda')
			$('#id_num_recibo').val(recibo)
			$('#id_comanda_recibo').val(comanda)
			$('#id_label_cancel_recibo').html("¿Seguro que quieres cancelar el recibo N° "+ recibo +"?");
		})
		
		$('#cancel_recibo_modal').submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/cancelarRecibo.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#response').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#cancelReciboModal').modal('hide');
					loadRecibos();
				}
			});
			event.preventDefault();
		});