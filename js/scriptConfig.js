$('#form_cfg_cant_mesas').submit(function( event ) {
	var parametros = $(this).serialize();
	$.ajax({
		type: 'POST',
		url: 'ajax/setCantMesas.php',
		data: parametros,
		beforeSend: function(objeto){
			$('#response_cant_mesas').html('Espere, por favor...');
		},
		success: function(datos){
			$('#response_cant_mesas').html(datos);
		}
	});
	event.preventDefault();
});

$('#form_cfg_precio_pool').submit(function( event ) {
	var parametros = $(this).serialize();
	$.ajax({
		type: 'POST',
		url: 'ajax/setPrecioPool.php',
		data: parametros,
		beforeSend: function(objeto){
			$('#response_precio_pool').html('Espere, por favor...');
		},
		success: function(datos){
			$('#response_precio_pool').html(datos);
		}
	});
	event.preventDefault();
});

$('#form_cfg_precio_fichas').submit(function( event ) {
	var parametros = $(this).serialize();
	$.ajax({
		type: 'POST',
		url: 'ajax/setPrecioFichas.php',
		data: parametros,
		beforeSend: function(objeto){
			$('#response_precio_fichas').html('Espere, por favor...');
		},
		success: function(datos){
			$('#response_precio_fichas').html(datos);
		}
	});
	event.preventDefault();
});