$('#login_wallace').submit(function( event ) {
	var parametros = $(this).serialize();
	$.ajax({
		type: 'POST',
		url: 'ajax/verifyLogin.php',
		data: parametros,
		beforeSend: function(objeto){
			$('#response').html('Espere, por favor...');
		},
		success: function(datos){
			if(datos == ""){
				window.location.replace("/prod/wallace");
			}else{
				$('#response').html(datos);
			}
				
		}
	});
	event.preventDefault();
});