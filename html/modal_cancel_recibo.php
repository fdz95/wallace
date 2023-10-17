<div id="cancelReciboModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="cancel_recibo_modal" id="cancel_recibo_modal">
				<div class="modal-header">						
					<h4 class="modal-title">Cancelar recibo</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<label id="id_label_cancel_recibo"></label>
					<input type="hidden" name="id_num_recibo" id="id_num_recibo">
					<input type="hidden" name="id_comanda_recibo" id="id_comanda_recibo">
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
					<input type="submit" class="btn btn-danger" value="Cancelar recibo">
				</div>
			</form>
		</div>
	</div>
</div>