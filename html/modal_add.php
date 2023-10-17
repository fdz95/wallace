<div id="addModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_modal" id="add_modal">
				<div class="modal-header">
					<h4 class="modal-title"><label id="id_add_title_mesa"></label></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div name="add_select_mesa" id="add_select_mesa" class="form-group"></div>
					<input type="hidden" name="add_cliente" id="add_cliente">
					<div name='add_select_articulo' id='add_select_articulo' class="form-group"></div>
					<div class="form-group">
						<label id="label_cantidad">Cantidad</label>
						<input type="number" name="add_cantidad" id="add_cantidad" placeholder="Ingrese la cantidad..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Notas</label>
						<textarea id="add_nota" name="add_nota" rows="4" cols="50" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-success" value="Agregar">
				</div>
			</form>
		</div>
	</div>
</div>