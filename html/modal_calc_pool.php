<div id="calcPoolModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="calc_pool_modal" id="calc_pool_modal">
				<div class="modal-header">
					<h4 class="modal-title"><label id="id_pool_title"></label></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="calc_mesa" id="calc_mesa">
					<input type="hidden" name="calc_comanda" id="calc_comanda">
					<input type="hidden" name="config_precio_pool" id="config_precio_pool">
					<div class="form-group">
						<div id="id_recipt_cliente_pool" class="form-group"></div>
					</div>
					<div class="form-group">
						<label>Minutos jugados</label>
						<input type="number" name="calc_pool_minutos" id="calc_pool_minutos" placeholder="Minutos" class="form-control" /></br>
						<p><input type="button" class="btn btn-info" onclick="getPoolPrice()" value="Calcular" />
						<input type="hidden" name="pool_importe_total" id="pool_importe_total">
						<label id="response_pool"></label></p>
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