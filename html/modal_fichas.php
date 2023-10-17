<div id="fichasModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="fichas_modal" id="fichas_modal">
				<div class="modal-header">
					<h4 class="modal-title"><label id="id_fichas_title"></label></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
				
					<input type="hidden" name="fichas_mesa" id="fichas_mesa">
					<input type="hidden" name="fichas_comanda" id="fichas_comanda">
					<input type="hidden" name="fichas_precio" id="fichas_precio">
					
					<div class="form-group">
						<div id="id_recipt_cliente_fichas" class="form-group"></div>
					</div>
					</br>
					<div class="input-group mb-3">
						<label>Cantidad de fichas</label>&nbsp;&nbsp;&nbsp;
						<input type="number" name="fichas_cantidad" id="fichas_cantidad" placeholder="Fichas" class="form-control" />&nbsp;&nbsp;&nbsp;
						<label id="label_precio_fichas"></label>
					</div>
					<div class="modal-footer justify-content-between">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-success" value="Agregar">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>