<div id="changeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="change_modal" id="change_modal">
				<div class="modal-header">						
					<h4 class="modal-title">Cambiar de mesa</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p><label id="id_label_change_mesa"></label></p>
					<input type="hidden" name="id_change_comanda" id="id_change_comanda">
					<div name="change_select_mesa" id="change_select_mesa" class="form-group"></div>
					<label id="label_change_response"></label>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-success" value="Cambiar">
				</div>
			</form>
		</div>
	</div>
</div>