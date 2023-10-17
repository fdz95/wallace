<div id="deleteModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="delete_modal" id="delete_modal">
				<div class="modal-header">						
					<h4 class="modal-title"><label id="id_delete_title_mesa"></label></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>¿Seguro que quieres borrar este item?</p>
					<input type="hidden" name="id_delete_mesa" id="id_delete_mesa">
					<input type="hidden" name="id_delete_articulo" id="id_delete_articulo">
					<input type="hidden" name="id_comanda_show" id="id_comanda_show">
					<label id="id_detail_articulo"></label>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-danger" value="Borrar">
				</div>
			</form>
		</div>
	</div>
</div>