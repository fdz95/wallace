<div id="editModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="edit_modal" id="edit_modal">
				<div class="modal-header">
					<h4 class="modal-title"><label id="id_edit_articulo_title"></label></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id_edit_mesa" id="id_edit_mesa">
					<input type="hidden" name="id_edit_articulo" id="id_edit_articulo">
					<div class="form-group">
						<label>Cantidad</label>
						<input type="number" name="edit_cantidad" id="edit_cantidad" placeholder="Ingrese la cantidad..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Notas</label>
						<textarea id="edit_nota" name="edit_nota" rows="4" cols="50" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-info" value="Guardar">
				</div>
			</form>
		</div>
	</div>
</div>