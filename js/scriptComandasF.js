		$(function() {
			loadComandasF();
		});
		
		function loadComandasF(){
			$.ajax({
				url:'ajax/getComandasF.php',
				beforeSend: function(objeto){
					$('#response_comandasF').html("Cargando...");
				},
				success:function(data){
					$('.outer_div_comandasF').html(data);
					$('#response_comandasF').html('');
				}
			});
		}