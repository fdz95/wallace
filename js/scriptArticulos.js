		$(function() {
			loadArticulos();
		});
		
		function loadArticulos(){
			$.ajax({
				url:'ajax/getArticulos.php',
				beforeSend: function(objeto){
					$('#loader').html("Cargando...");
				},
				success:function(data){
					$('.outer_div').html(data);
					$('#loader').html('');
				}
			});
		}
		
		$('#add_art_modal').submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/addArt.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#loader').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#loader').html('');
					$('#addArtModal').modal('hide');
					loadArticulos();
				}
			});
			event.preventDefault();
		});
		
		$('#addArtModal').on('show.bs.modal', function (event) {
			$.ajax({
				type: 'POST',
				url: 'ajax/getRubrosSelect.php',
				success: function(datos){
					$('#add_rubro_select').html(datos);
				}
			});
		});
		
		function getAddRubros(selection){
			var add_rubro = selection.value;
			
			$.ajax({
				type: 'POST',
				url: 'ajax/getAddSubrubrosSelect.php?add_rubro='+ add_rubro,
				success: function(datos){
					$('#add_subrubro_select').html(datos);
				}
			});
		}
		
		$('#editArtModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id = button.data('id')
			$('#id_edit_art').val(id)
			var rubro = button.data('rubro')
			$('#edit_art_rubro').val(rubro)
			var subr = button.data('subr')
			$('#edit_art_subrubro').val(subr)
			var tipo = button.data('tipo')
			$('#edit_art_tipo').val(tipo)
			var articulo = button.data('articulo')
			$('#edit_art_articulo').val(articulo)
			var descrip = button.data('descrip')
			$('#edit_art_descrip').val(descrip)
			var precio = button.data('precio')
			$('#edit_art_precio').val(precio)
			var prov = button.data('prov')
			$('#edit_art_prov').val(prov)
			var stock = button.data('stock')
			$('#edit_art_stock').val(stock)
			var img = button.data('img')
			$('#edit_art_img').val(img)
		});
		
		$('#edit_art_modal').submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/editArt.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#loader').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#loader').html('');
					$('#editArtModal').modal('hide');
					loadArticulos();
				}
			});
			event.preventDefault();
		});
		
		$('#deleteArtModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id_articulo = button.data('id')
			var articulo = button.data('articulo')
			$('#id_delete_art_id').val(id_articulo)
			$('#id_delete_title_art').html("¿Seguro que quieres borrar el articulo "+ articulo +"?")
		})
		
		$('#delete_art_modal').submit(function(event){
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/deleteArt.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#loader').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#loader').html('');
					$('#deleteArtModal').modal('hide');
					loadArticulos();
				}
			});
			event.preventDefault();
		});
		
		$('#add_rubro_modal').submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/addRubro.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#loader').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#loader').html('');
					$('#addRubroModal').modal('hide');
					$('#add_rubro_name').val("");
				}
			});
			event.preventDefault();
		});
		
		$('#addSubrubroModal').on('show.bs.modal', function (event) {
			$.ajax({
				type: 'POST',
				url: 'ajax/getRubrosSelect.php',
				success: function(datos){
					$('#select_subrubro_rubro').html(datos);
				}
			});
		})
		
		$('#add_subrubro_modal').submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/addSubrubro.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#loader').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#loader').html('');
					$('#addSubrubroModal').modal('hide');
					$('#add_subrubro_name').val("");
				}
			});
			event.preventDefault();
		});