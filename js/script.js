		$(function() {
			load();
		});
		
		function load(){
			$.ajax({
				url:'ajax/getMesas.php',
				beforeSend: function(objeto){
					$('#loader').html("Cargando...");
				},
				success:function(data){
					$('.outer_div').html(data);
					$('#loader').html("");
				}
			});
		}
		
		$('#comandaModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var num_mesa = button.data('mesa')
			var name_mesa = button.data('name')
			$('#comanda_select_cliente').html("Seleccione una mesa");
			$('#comanda_select_rubro').html("Seleccione un cliente");
			$("#comanda_add_articulo").empty();
			$('#comanda_add_cantidad').val("1");
			$('#comanda_add_nota').val("");
			$('#comanda_temp').html("");
			
			$.ajax({
				type: 'POST',
				url: 'ajax/getMesasSelect.php?num_mesa='+ num_mesa +'&name_mesa='+ name_mesa,
				success: function(datos){
					$('#comanda_select_mesa').html(datos);
					getClienteMesa(num_mesa);
				}
			});
		})
		
		function getClienteMesa(num_mesa){
			$.ajax({
				type: 'POST',
				url: 'ajax/getClientesSelect.php?num_mesa='+ num_mesa,
				success: function(datos){
					$('#comanda_select_cliente').html(datos);
					getIdComanda(num_mesa);
				}
			});
		}
		
		function getIdComanda(num_mesa){
			// getIdComandaMesa
			$.ajax({
				type: 'POST',
				url: 'ajax/getIdComanda.php?num_mesa='+ num_mesa,
				success: function(datos){
					if(datos == ''){
						var randomnumber = Math.floor(Math.random() * 1000) + 10;
						var comanda_random = getDateTime() +''+ randomnumber;
						$('#comanda_random').val(comanda_random);
						console.log("create comanda_random: "+ comanda_random);
					}else{
						$('#comanda_random').val(datos);
						console.log("get comanda_random: "+ datos);
					}
				}
			});
			
			// getComandaShowMesa
			var randomnumber2 = Math.floor(Math.random() * 1000) + 10;
			var comanda_show = getDateTime() +''+ randomnumber2;
			$('#comanda_show').val(comanda_show);
			console.log("create comanda_show: "+ comanda_show);
		}
		
		function getDateTime() {
			var now     = new Date(); 
			var year    = now.getFullYear();
			var month   = now.getMonth()+1; 
			var day     = now.getDate();
			var hour    = now.getHours();
			var minute  = now.getMinutes();
			var second  = now.getSeconds(); 
			if(month.toString().length == 1) {
				 month = '0'+month;
			}
			if(day.toString().length == 1) {
				 day = '0'+day;
			}   
			if(hour.toString().length == 1) {
				 hour = '0'+hour;
			}
			if(minute.toString().length == 1) {
				 minute = '0'+minute;
			}
			if(second.toString().length == 1) {
				 second = '0'+second;
			}   
			var dateTime = year+''+month+''+day+''+hour+''+minute+''+second;   
			
			return dateTime;
		}
		
		// SELECT2
		$('#comanda_add_articulo').select2({
			ajax: {
				url: "ajax/getArticulosSelect2.php",
                type: "POST",
                dataType: "JSON",
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
				processResults: function (data) {
					console.log(data)
					return {
						results: $.map(data, function(obj) {
							return { id: obj.id, text: obj.text };
						})
					};
				},
                cache: true
			},
			placeholder: 'Seleccione un articulo',
			theme: "classic",
            casesensitive: false
        });
		
		function agregarComandaTemp(){
			var e_comanda_mesa = document.getElementById("comanda_add_mesa");
			var comanda_add_mesa = e_comanda_mesa.options[e_comanda_mesa.selectedIndex].value;
			
			var e_comanda_cliente = document.getElementById("comanda_add_cliente");
			var comanda_add_cliente = e_comanda_cliente.options[e_comanda_cliente.selectedIndex].value;
			
			var e_comanda_art = document.getElementById("comanda_add_articulo");
			var comanda_add_articulo = e_comanda_art.options[e_comanda_art.selectedIndex].value;
			
			var comanda_add_cantidad = document.getElementById("comanda_add_cantidad").value;
			var comanda_add_nota = document.getElementById("comanda_add_nota").value;
			var comanda_add_random = document.getElementById("comanda_random").value;
			var comanda_show = document.getElementById("comanda_show").value;
			
			$.ajax({
				type: 'POST',
				url: 'ajax/addComandaTemp.php?comanda_add_random='+ comanda_add_random +'&comanda_add_mesa='+ comanda_add_mesa +'&comanda_add_cliente='+ comanda_add_cliente +'&comanda_add_articulo='+ comanda_add_articulo +'&comanda_add_cantidad='+ comanda_add_cantidad +'&comanda_add_nota='+ comanda_add_nota+'&comanda_show='+ comanda_show,
				success: function(datos){
					console.log(datos);
					if(isEmpty(datos)){
						loadComandaTemp(comanda_add_random,comanda_add_mesa);
					}else{
						$('#comanda_temp').html(datos);
					}	
				}
			});
		}
		
		function isEmpty(str) {
			return (!str || 0 === str.length);
		}
		
		function loadComandaTemp(comanda_add_random,comanda_add_mesa){
			$.ajax({
				type: 'POST',
				url: 'ajax/loadComandaTemp.php?comanda_add_random='+ comanda_add_random +'&comanda_add_mesa='+ comanda_add_mesa,
				success: function(datos){
					$('#comanda_temp').html(datos);
					$('#comanda_add_cantidad').val("1");
					$('#comanda_add_nota').val("");
				}
			});
		}
		
		$(document).on('click','#delete_art_temp',function(event) {
			var id_comanda = $(this).data('comanda');
			var comanda_temp_mesa = $(this).data('mesa');
			var comanda_temp_art = $(this).data('articulo');
			deleteArtComandaTemp(id_comanda,comanda_temp_mesa,comanda_temp_art);
		});
		
		function deleteArtComandaTemp(id_comanda,comanda_temp_mesa,comanda_temp_art){
			$.ajax({
				type: 'POST',
				url: 'ajax/deleteArtComanda.php?id_comanda='+ id_comanda + '&comanda_temp_mesa='+ comanda_temp_mesa +'&comanda_temp_art='+ comanda_temp_art,
				success: function(datos){
					console.log(datos);
					loadComandaTemp(id_comanda,comanda_temp_mesa);
				}
			});
		}
		
		$('#comanda_modal').submit(function( event ) {
			var check = false;
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/addPedido.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#response').html('Espere, por favor...');
				},
				success: function(datos){
					/*if($('input[type=checkbox]').prop('checked')){
						check = true;
					}
					
					if(check){
						printComanda();
					}*/
					
					$('#response').html(datos);
					$('#comandaModal').modal('hide');
					load();
				}
			});
			event.preventDefault();
		});
		
		/*function printComanda(){
			var id_comanda = document.getElementById("comanda_random").value;
			var comanda_add_mesa = document.getElementById("comanda_add_mesa").value;
			window.open("http://localhost/php/wallace/ajax/printComanda.php?id_comanda="+ id_comanda +"&comanda_add_mesa="+ comanda_add_mesa,"_blank");
			//window.open("http://190.211.222.103/php/wallace/ajax/printComanda.php?id_comanda="+ id_comanda +"&comanda_add_mesa="+ comanda_add_mesa,"_blank");
		}*/
		
		// editar articulo de la mesa
		/*$('#editModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var mesa = button.data('mesa')
			$('#id_edit_mesa').val(mesa)
			var articulo = button.data('articulo')
			$('#id_edit_articulo').val(articulo)
			$('#id_edit_articulo_title').html(articulo +" - Mesa "+ mesa +" - Editar")
			var cantedit = button.data('cantedit')
			$('#edit_cantidad').val(cantedit)
			var notasedit = button.data('notasedit')
			$('#edit_nota').val(notasedit)
		});
		
		$('#edit_modal').submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/edit.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#response').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#editModal').modal('hide');
					load();
				}
			});
			event.preventDefault();
		});*/
		
		// quitar articulo de la mesa
		$('#deleteModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var comanda_show = button.data('comandashow')
			var num_mesa = button.data('mesa')
			var articulo = button.data('articulo')
			var cantidad = button.data('cantidad')
			$('#id_delete_title_mesa').html("Mesa "+ num_mesa +" - Borrar articulo")
			$('#id_comanda_show').val(comanda_show)
			console.log(comanda_show);
			$('#id_delete_mesa').val(num_mesa)
			$('#id_delete_articulo').val(articulo)
			$('#id_detail_articulo').html(articulo +" x"+ cantidad)
		})
		
		$('#delete_modal').submit(function(event){
			var parametros = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'ajax/delete.php',
				data: parametros,
				beforeSend: function(objeto){
					$('#response').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#deleteModal').modal('hide');
					load();
				}
			});
			event.preventDefault();
		});
		
		// cambiar mesa
		$('#changeModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var id_comanda = button.data('comanda');
			var name_mesa = button.data('name');
			$('#id_change_comanda').val(id_comanda);
			$('#id_label_change_mesa').html("Cambiar "+ name_mesa + " a:");
			$('#label_change_response').html("");
			
			$.ajax({
				type: 'POST',
				url: 'ajax/getMesasSelectChange.php',
				success: function(datos){
					$('#change_select_mesa').html(datos);
				}
			});
		})
		
		$('#change_modal').submit(function(event){
			var e_comanda_mesa = document.getElementById("comanda_mesa_change");
			var mesa_nueva = e_comanda_mesa.options[e_comanda_mesa.selectedIndex].value;
			var id_change_comanda = document.getElementById("id_change_comanda").value;
			
			console.log("id_comanda: "+ id_change_comanda);
			console.log("mesa_nueva: "+ mesa_nueva);
			
			$.ajax({
				type: 'POST',
				url: 'ajax/changeMesa.php?id_change_comanda='+ id_change_comanda +'&mesa_nueva='+ mesa_nueva,
				beforeSend: function(objeto){
					$('#label_change_response').html('Espere, por favor...');
				},
				success: function(datos){
					$('#response').html(datos);
					$('#changeModal').modal('hide');
					load();
				}
			});
			event.preventDefault();
		});
		
		$('#logout_modal').submit(function(event){
			$.ajax({
				type: 'POST',
				url: 'logout.php?logout',
				beforeSend: function(objeto){},
				success: function(datos){
					window.location.reload();
				}
			});
			event.preventDefault();
		});
		
		$('#reciptModalMobile').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var num_mesa = button.data('mesa');
			var name_mesa = button.data('name');
			var id_comanda = button.data('comanda');
			var cliente_comanda = button.data('cliente');
			var desc_comanda = button.data('desc');
			$('#id_recipt_title_mesa_mobile').html("Cuenta "+ name_mesa);
			$('#id_recipt_mesa_mobile').val(num_mesa);
			$('#id_comanda_recipt_mobile').val(id_comanda);
			$('#id_num_cliente_recipt_mobile').val(cliente_comanda);
			
			$.ajax({
				type: 'POST',
				url: 'ajax/getClienteRecipt.php?id_cliente='+ cliente_comanda,
				success: function(datos){
					$('#id_recipt_cliente_mobile').html(datos);
				}
			});
			
			$.ajax({
				type: 'POST',
				url: 'ajax/recipt.php?recipt_mesa='+ num_mesa,
				success: function(datos){
					$('#id_recipt_articulos_mobile').html(datos);
				}
			});
			
			$.ajax({
				type: 'POST',
				url: 'ajax/reciptImporte.php?recipt_mesa='+ num_mesa,
				success: function(importe){
					$('#id_importe_original_mobile').val(importe);
					$('#id_importe_final_mobile').val(importe);
				}
			});
		});

		$('#reciptModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var num_mesa = button.data('mesa');
			var name_mesa = button.data('name');
			var id_comanda = button.data('comanda');
			var cliente_comanda = button.data('cliente');
			var desc_comanda = button.data('desc');
			$('#id_recipt_title_mesa').html("Cerrar "+ name_mesa);
			$('#id_label_recipt_desc').html("");
			$('#id_recipt_mesa').val(num_mesa);
			$('#recipt_desc').val(desc_comanda);
			$('#id_comanda_recipt').val(id_comanda);
			$('#id_num_cliente_recipt').val(cliente_comanda);
			
			$.ajax({
				type: 'POST',
				url: 'ajax/getClienteRecipt.php?id_cliente='+ cliente_comanda,
				success: function(datos){
					$('#id_recipt_cliente').html(datos);
				}
			});
			
			$.ajax({
				type: 'POST',
				url: 'ajax/recipt.php?recipt_mesa='+ num_mesa,
				success: function(datos){
					$('#id_recipt_articulos').html(datos);
				}
			});
			
			$.ajax({
				type: 'POST',
				url: 'ajax/reciptImporte.php?recipt_mesa='+ num_mesa,
				success: function(importe){
					$('#id_importe_original').val(importe);
					$('#id_importe_final').val(importe);
				}
			});
		});
		
		function getDiscount(){
			var recipt_descuento = document.getElementById("recipt_desc").value;
			var recipt_importe = document.getElementById("id_importe_original").value;
			
			var descuento = recipt_importe - (recipt_importe * recipt_descuento / 100);
			$('#id_label_recipt_desc').html("Total a pagar: $"+ descuento);
			$('#id_importe_final').val(descuento);
		}
		
		function printRecipt(){
			var id_recipt_mesa = document.getElementById("id_recipt_mesa").value;
			var recipt_cliente = document.getElementById("id_num_cliente_recipt").value;
			var recipt_importe = document.getElementById("id_importe_original").value;
			var recipt_pagado = document.getElementById("id_importe_final").value;
			var recipt_desc = document.getElementById("recipt_desc").value;
			var e = document.getElementById("recipt_met_pago");
			var recipt_met_pago = e.options[e.selectedIndex].value;
			var recipt_nota = document.getElementById("recipt_nota").value;
			var id_comanda_recipt = document.getElementById("id_comanda_recipt").value;
			
			window.open("/php/wallace/ajax/printRecipt.php?id_comanda="+ id_comanda_recipt +"&id_recipt_mesa="+ id_recipt_mesa +"&recipt_cliente="+ recipt_cliente +"&recipt_importe="+ recipt_importe +"&recipt_pagado="+ recipt_pagado +"&recipt_met_pago="+ recipt_met_pago +"&recipt_nota="+ recipt_nota +"&recipt_desc="+ recipt_desc,"_blank");
			$('#id_recipt_alert').html('');
			$('#reciptModal').modal('hide');
			$('#reLoadMesasModal').modal('show');
		}
		
		$('#reLoadMesasModal').on('show.bs.modal', function (event) {
			$('#MymodalPreventScript').modal({
				backdrop: 'static',
				keyboard: false
			});
		})
		
		$('#reload_modal').submit(function( event ) {
			load();
			$('#reLoadMesasModal').modal('hide');
			event.preventDefault();
		});