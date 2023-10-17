<div id="pingPongModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="ping_pong_modal" id="ping_pong_modal">
				<div class="modal-header">
					<h4 class="modal-title"><label id="id_ping_pong_title"></label></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="ping_pong_mesa" id="ping_pong_mesa">
					<input type="hidden" name="ping_pong_comanda" id="ping_pong_comanda">
					<input type="hidden" name="config_precio_ping_pong" id="config_precio_ping_pong">
					<div class="form-group">
						<div id="id_cliente_ping_pong" class="form-group"></div>
					</div>
					<div class="form-group">
						<label>Minutos jugados</label>
						<input type="number" name="ping_pong_minutos" id="ping_pong_minutos" placeholder="Minutos" class="form-control" /></br>
						<p><input type="button" class="btn btn-info" onclick="getPingPongPrice()" value="Calcular" />
						<input type="hidden" name="ping_pong_importe_total" id="ping_pong_importe_total">
						<label id="response_ping_pong"></label></p>
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