		$(function() {
			$('#loader_Mestadistica').html("Cargando...");
			loadVentasMobile();
			loadVentasPoolMobile();
		});
		
		function loadVentasMobile(){
			$.ajax({
				url:'ajax/getVentasMobile.php',
				beforeSend: function(objeto){
					$('#loader').html("Cargando...");
				},
				success:function(data){
					$('.outer_div_mensuales').html(data);
					$('#loader').html("");
				}
			});
		}
		
		function loadVentasPoolMobile(){
			$.ajax({
				url:'ajax/getVentasMensualesPool.php',
				beforeSend: function(objeto){
					$('#loader_pool').html("Cargando...");
				},
				success:function(data){
					$('.outer_div_pool').html(data);
					$('#loader_pool').html("");
					$('#loader_Mestadistica').html("");
				}
			});
		}