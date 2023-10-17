		$(function() {
			loadVentas();
			loadVentasPool();
			loadClientes();
		});
		
		function loadVentas(){
			$.ajax({
				url:'ajax/getVentasDiarias.php',
				beforeSend: function(objeto){
					$('#loader_diarias').html("Cargando...");
				},
				success:function(data){
					$('.outer_div_diarias').html(data);
					$('#loader_diarias').html("");
				}
			});
			
			$.ajax({
				url:'ajax/getVentasMensuales.php',
				beforeSend: function(objeto){
					$('#loader_mensuales').html("Cargando...");
				},
				success:function(data){
					$('.outer_div_mensuales').html(data);
					$('#loader_mensuales').html("");
				}
			});
		}
		
		function loadVentasPool(){
			$.ajax({
				url:'ajax/getVentasMensualesPool.php',
				beforeSend: function(objeto){
					$('#loader_pool').html("Cargando...");
				},
				success:function(data){
					$('.outer_div_pool').html(data);
					$('#loader_pool').html("");
				}
			});
		}
		
		$('#infoVentasModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var ventas_fecha = button.data('fecha')
			$('#title_info_ventas').html("Ingresos del dia "+ ventas_fecha);
			
			$.ajax({
				url:'ajax/getInfoVentas.php?ventas_fecha='+ ventas_fecha,
				beforeSend: function(objeto){
					$('#response_info_ventas').html("Cargando...");
				},
				success:function(data){
					$('#response_info_ventas').html(data);
				}
			});
		})
		
		$('#infoPoolModal').on('show.bs.modal', function (event) {
			$.ajax({
				url:'ajax/getInfoPool.php',
				beforeSend: function(objeto){
					$('#response_info_pool').html("Cargando...");
				},
				success:function(data){
					$('#response_info_pool').html(data);
				}
			});
		})
		
		function loadClientes(){
			$.ajax({
				url:'ajax/getClientesSelectEstad.php',
				beforeSend: function(objeto){
					$('#estad_select_cliente').html("Cargando...");
				},
				success:function(data){
					$('#estad_select_cliente').html(data);
				}
			});
		}
		
		function loadVentasClientes(){
			var id_cliente = document.getElementById("select_cliente_estad").value;
			$.ajax({
				url:'ajax/getVentasCliente.php?id_cliente='+ id_cliente,
				beforeSend: function(objeto){
					$('#loader_clientes').html("Cargando...");
				},
				success:function(data){
					console.log(data);
					$('.outer_div_clientes').html(data);
					$('#loader_clientes').html("");
				}
			});
		}
		
		function rePrintRecipt(id_comanda_recipt){
			//window.open("http://localhost/php/wallace/ajax/reprint.php?id_comanda="+ id_comanda_recipt,"_blank");
			//window.open("http://190.211.222.103/php/wallace/ajax/reprint.php?id_comanda="+ id_comanda_recipt,"_blank");
		}